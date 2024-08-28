<?php 
require_once "model/databases_connector/databases_choose.php";
require_once "exception/daily_menu_not_exist_exception.php";
require_once "exception/daily_menu_already_exist_exception.php";
require_once "exception/no_daily_menu_exception.php";
require_once "exception/meals_already_in_daily_menu_exception.php";
require_once "exception/meals_not_in_daily_menu_exception.php";

class DailyMenu {
    private DatabasesAccess $db;
    private DateTime $date;

    public function __construct(DateTime $date) {
        $databaseChoose = new DatabasesChoose();
        $this->db = $databaseChoose->getDatabase();

        if (!$this->db->isDailyMenuExist($date)) {
            $this->db->addDailyMenu($date);
        }

        $this->date = $date;
    }

    public static function create(DateTime $date): self {
        $databaseChoose = new DatabasesChoose();
        $db = $databaseChoose->getDatabase();

        if ($db->isDailyMenuExist($date)) {
            throw new MealsAlreadyExistException();
        }

        return new DailyMenu($date);

    }

    public static function latest(): self {
        $databaseChoose = new DatabasesChoose();
        $db = $databaseChoose->getDatabase();
        $date = $db->getLatestDailyMenu();

        if ($date == null) {
            throw new NoDailyMenuException();
        }

        return new DailyMenu($date);
    }

    public function getDate() {
        return $this->date;
    }

    public function all() {
        return array_map(function ($meal) {
            return new Meals($meal);
        }, $this->db->getMealsInDailyMenu($this->date));
    }

    public function addMeals(Meals $meals) {
        if ($this->db->isMealsInDailyMenu($meals->getName(), $this->date)) {
            throw new MealsAlreadyInDailyMenuException();
        }

        $this->db->addMealToDailyMenu($meals->getName(), $this->date);
    }

    public function removeMeals(Meals $meals) {
        if (!$this->db->isMealsInDailyMenu($meals->getName(), $this->date)) {
            throw new MealsNotInDailyMenuException();
        }

        $this->db->removeMealFromDailyMenu($meals->getName(), $this->date);
    }
}