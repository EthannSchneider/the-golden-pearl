<?php 

require_once "model/databases_connector/databases_choose.php";
require_once "exception/meals_not_exist_exception.php";
require_once "exception/meals_already_exist_exception.php";


class Meals {
    private DatabasesAccess $db;
    private string $name;

    public function __construct(string $name) {
        $databaseChoose = new DatabasesChoose();
        $this->db = $databaseChoose->getDatabase();

        if(!$this->db->isMealsExist($name)) {
            throw new MealsNotExistException();
        }

        $this->name = $name;
    }

    public static function all(): array {
        $databaseChoose = new DatabasesChoose();
        $db = $databaseChoose->getDatabase();

        return array_map(function ($meal) {
            return new Meals($meal);
        }, $db->allMeals());
    }

    public static function create(string $name, string $description, int|null $calories): self {
        $databaseChoose = new DatabasesChoose();
        $db = $databaseChoose->getDatabase();

        if ($db->isMealsExist($name)) {
            throw new MealsAlreadyExistException();
        }

        $db->addMeals($name, $description, $calories);

        return new Meals($name);
    }

    public static function delete(string $name): void {
        $databaseChoose = new DatabasesChoose();
        $db = $databaseChoose->getDatabase();

        if (!$db->isMealsExist($name)) {
            throw new MealsNotExistException();
        }

        $db->removeMeals($name);
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription() {
        return $this->db->getMealDescription($this->name);
    }

    public function getCalories() {
        return $this->db->getMealCalories($this->name);
    }

    public function __tostring(): string {
        return "{\"name\": \"{$this->getName()}\", \"Description\": \"{$this->getDescription()}\", \"Calories\": \"{$this->getCalories()}\"}";
    }

}