<?php 
interface DatabasesAccess {

    // user

    public function isUserExist(string $username): bool;

    public function isUserPasswordCorrect(string $username, string $password): bool;

    // Daily menu

    public function isDailyMenuExist(DateTime $date): bool;

    public function getLatestDailyMenu(): DateTime|null;

    public function addDailyMenu(DateTime $date): void;

    public function getMealsInDailyMenu(DateTime $date): array;

    public function isMealsInDailyMenu(string $meal_name, DateTime $date);

    public function addMealToDailyMenu(string $meals_name, DateTime $date): void;

    public function removeMealFromDailyMenu(string $meals_name, DateTime $date): void;

    // Meals

    public function isMealsExist(string $meals_name): bool;

    public function getMealDescription(string $meals_name): string;

    public function getMealCalories(string $meals_name);

    public function allMeals(): array;

    public function addMeals(string $name, string $description, int $calories = null): void; 

    public function removeMeals(string $name): void;
}