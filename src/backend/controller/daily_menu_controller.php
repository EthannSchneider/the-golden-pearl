<?php 

require_once "model/daily_menu.php";
require_once "model/meals.php";

$entry = [
    "DailyMenuController()" => [
        "GET" => [
            "/api/daily_menu" => "latest()"
        ],
        "POST" => [
            "/api/daily_menu" => "addMeals()"
        ],
        "DELETE" => [
            "/api/daily_menu/:name" => "deleteMeals(:name)"
        ]
    ]
];

class DailyMenuController {

    public function latest() {
        $dailyMenu = $this->getLatestDailyMenu();
        if (is_null($dailyMenu)) {
            echo "[]";
            return;
        }

        echo MealsUtils::mealsArrayToString($dailyMenu->all());
    }

    public function addMeals() {
        if(!AuthUtils::isAuthenticated()) {
            ResponseUtils::unauthorized();
            return;
        }

        if (!isset($_POST["meals_name"])) {
            ResponseUtils::badRequest();
        }

        $dailyMenu = $this->getLatestDailyMenu();
        if (is_null($dailyMenu)) {
            $dailyMenu = DailyMenu::create(new DateTime());
        }

        if ($dailyMenu->getDate()->format('Y-m-d') != (new DateTime())->format('Y-m-d')) {
            $dailyMenu = DailyMenu::create(new DateTime());
        }

        $meals = "";
        try {
            $meals = new Meals($_POST["meals_name"]);
        } catch (MealsNotExistException) {
            $this->mealsNotExistException();
            return;
        }

        try {
            $dailyMenu->addMeals($meals);
        } catch (MealsAlreadyInDailyMenuException) {
            ResponseUtils::response("Meals already in Daily Menu", 409);
            return;
        }
    }

    public function deleteMeals($name) {
        if(!AuthUtils::isAuthenticated()) {
            ResponseUtils::unauthorized();
            return;
        }

        $dailyMenu = $this->getLatestDailyMenu();
        if (is_null($dailyMenu)) {
            ResponseUtils::response("Nothing in Daily Menu", 404);
            return;
        }

        $meals = "";
        try {
            $meals = new Meals($name);
        } catch (MealsNotExistException) {
            $this->mealsNotExistException();
            return;
        }

        try {
            $dailyMenu->removeMeals($meals);
        } catch (MealsNotInDailyMenuException) {
            ResponseUtils::response("Meals not in Daily Menu", 404);
            return;
        }
    }

    private function getLatestDailyMenu() {
        try {
            return DailyMenu::latest();
        }catch(NoDailyMenuException) {
            return null;
        }
    }

    private function mealsNotExistException() {
        ResponseUtils::response("Meals does not found", 404);
    }
}