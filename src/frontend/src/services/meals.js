import axios from 'axios';

export function getMeals() {
    return axios.get("/api/meals");
}

export function getMeal(name) {
    return axios.get("/api/meals/" + name);
}

export function createMeal(meal_name, description, calories, price) {
    return axios.post("/api/meals", { name: meal_name, description: description, calories: calories, price: price });
}

export function deleteMeal(name) {
    return axios.delete("/api/meals/" + name);
}