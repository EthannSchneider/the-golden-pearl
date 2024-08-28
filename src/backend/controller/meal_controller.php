<?php 

require_once "model/meals.php";

$entry = [
    "MealsController()" => [
        "GET" => [
            "/api/meals" => "getAllMeals()",
            "/api/meals/:name" => "getMeals(:name)"
        ],
        "POST" => [
            "/api/meals" => "createMeals()"
        ],
        "DELETE" => [
            "/api/meals" => "deleteMeals()"
        ]
    ]
];

class MealsController {
    public function getAllMeals() {
        if(!AuthUtils::isAuthenticated()) {
            ResponseUtils::unauthorized();
            return;
        }
        echo MealsUtils::mealsArrayToString(Meals::All());
    }

    public function getMeals(string $name) {
        if(!AuthUtils::isAuthenticated()) {
            ResponseUtils::unauthorized();
            return;
        }

        try {
            echo strval(new Meals($name));
        } catch(MealsNotExistException) {
            $this->mealsNotExistException();
        }
    }

    public function createMeals() {
        if(!AuthUtils::isAuthenticated()) {
            ResponseUtils::unauthorized();
            return;
        }

        if (!(isset($_POST["name"]) && isset($_POST["description"]))) {
            ResponseUtils::badRequest();
            return;
        }
        $meals = '';

        try {
            $meals = Meals::create($_POST["name"], $_POST["description"], $_POST["calories"]);
        }catch(MealsAlreadyExistException) {
            ResponseUtils::response("Meals already exist", 409);
            return;
        }

        header("Content-Type: application/json", response_code: 201);
        echo strval($meals);
    }

    public function deleteMeals() {
        if(!AuthUtils::isAuthenticated()) {
            ResponseUtils::unauthorized();
            return;
        }

        if (!isset($_POST["name"])) {
            ResponseUtils::badRequest();
            return;
        }

        try {
            Meals::delete($_POST["name"]);
        } catch(MealsNotExistException) {
            $this->mealsNotExistException();
            return;
        }

        header("HTTP/1.1 204 No Content");
    }

    private function mealsNotExistException() {
        ResponseUtils::response("Meals does not exist", 404);
    }
}