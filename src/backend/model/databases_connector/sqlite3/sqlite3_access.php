<?php
require "model/databases_connector/databases_access.php";
require "model/databases_connector/sqlite3/sqlite3.php";

class Sqlite3Access implements DatabasesAccess {
    private Sqlite3Connector $db;

    public function __construct(string $path) {
        $this->db = new Sqlite3Connector($path);

        if ($this->db->get("SELECT name FROM sqlite_master WHERE type='table' AND name='users'") == []) {
            $this->createDb();

            // temporary add defaut admin user
            $this->db->modify("INSERT INTO users(username, password) VALUES ('admin', :password)", [ ":password" => password_hash("admin", PASSWORD_DEFAULT) ]);
        }
    }

    private function createDb() {
        foreach (explode(";", file_get_contents("model/databases_connector/sqlite3/sqlite3.sql")) as $table) {
            $this->db->modify($table);
        }
    }

    // user

    public function isUserExist(string $username): bool {
        return sizeof($this->db->get("SELECT username FROM users WHERE username=:username",[":username"=>$username])) > 0;
    }

    public function isUserPasswordCorrect(string $username, string $password): bool {
        $response = $this->db->get("SELECT password FROM users WHERE username=:username", [":username", $username]);
        return sizeof($response) > 0 && password_verify($password, $response[0]["password"]);
    }

    // Daily menu

    public function isDailyMenuExist(DateTime $date): bool {
        return $this->db->get("SELECT day FROM dailyMenu WHERE day=:day", [":day"=>date_format($date, "Y-m-d")]) != [];
    }

    public function addDailyMenu(DateTime $date): void {
        $this->db->modify("INSERT INTO dailyMenu (day) VALUES (:day)", [":day" => date_format($date, "Y-m-d")]);
    }

    public function getLatestDailyMenu(): DateTime|null {
        $latestDailyMenu = $this->db->get("SELECT day FROM dailyMenu DESC LIMIT 1");
        if (sizeof($latestDailyMenu) == 0) {
            return null;
        }
        return new DateTime($latestDailyMenu[0]["day"]);
    }

    public function isMealsInDailyMenu(string $meal_name, DateTime $date) {
        return sizeof($this->db->get("SELECT meals.name FROM dailyMenu INNER JOIN dailyMenuContainsMeals ON dailyMenu.id=dailyMenuContainsMeals.dailyMenuId INNER JOIN meals ON meals.id=dailyMenuContainsMeals.mealsId WHERE dailyMenu.day=:date AND meals.name=:meal", [":date"=>date_format($date, "Y-m-d"), ":meal" => $meal_name])) > 0;
    }

    public function getMealsInDailyMenu(DateTime $date): array {
        return $this->reorderArray(
            $this->db->get("SELECT meals.name FROM dailyMenu INNER JOIN dailyMenuContainsMeals ON dailyMenu.id=dailyMenuContainsMeals.dailyMenuId INNER JOIN meals ON meals.id=dailyMenuContainsMeals.mealsId WHERE dailyMenu.day=:date", [":date"=>date_format($date, "Y-m-d")])
        );
    }

    public function addMealToDailyMenu(string $meals_name, DateTime $date): void {
        $this->db->modify("INSERT INTO dailyMenuContainsMeals (dailyMenuId, mealsId) VALUES ((SELECT id FROM dailyMenu WHERE day=:day), (SELECT id FROM meals WHERE name=:meals))", [":day"=>date_format($date, "Y-m-d"), ":meals"=>$meals_name]);
    }

    public function removeMealFromDailyMenu(string $meals_name, DateTime $date): void {
        $this->db->modify("DELETE FROM dailyMenuContainsMeals WHERE mealsId=(SELECT id FROM meals WHERE name=:meals) AND dailyMenuId=(SELECT id FROM dailyMenu WHERE day=:day)", [":meals"=>$meals_name, ":day"=>date_format($date, "Y-m-d")]);
    }

    // Meals

    public function isMealsExist(string $meals_name): bool {
        return $this->db->get("SELECT name FROM meals WHERE name=:meals", [":meals"=>$meals_name]) != [];
    }

    public function getMealDescription(string $meals_name): string {
        return $this->db->get("SELECT description FROM meals WHERE name=:meals", [":meals"=>$meals_name])[0]["description"];
    }

    public function getMealCalories(string $meals_name) {
        return $this->db->get("SELECT calories FROM meals WHERE name=:meals", [":meals" => $meals_name])[0]["calories"];
    }

    public function getMealPrice(string $meals_name) {
        return $this->db->get("SELECT price FROM meals WHERE name=:meals", [":meals" => $meals_name])[0]["price"];
    }

    public function allMeals(): array {
        return $this->reorderArray(
            $this->db->get("SELECT name FROM meals")
        );
    }

    public function addMeals(string $name, string $description, int $calories = null, int $price): void {
        $this->db->modify("INSERT INTO meals (name, description, calories, price) VALUES (:name, :description, :calories, :price)", [":name" => $name, ":description" => $description, ":calories" => $calories, ":price" => $price]);
    }

    public function removeMeals(string $name): void {
        $this->db->modify("DELETE FROM meals WHERE name=:name", [":name" => $name]);
    }

    private function reorderArray(array $array): array {
        $array_ordered = [];
        foreach ($array as $item) {
            array_push($array_ordered, $item["name"]);
        }
        return $array_ordered;
    }
}