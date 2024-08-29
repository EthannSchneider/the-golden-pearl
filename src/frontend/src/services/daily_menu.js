import axios from 'axios';

export function getCurrentDailyMenu() {
    return axios.get("/api/daily_menu");
}

export function addMealToDailyMenu(name) {
    return axios.post("/api/daily_menu", {meals_name: name});
}

export function deleteMealFromDailyMenu(name) {
    return axios.delete("/api/daily_menu/" + name);
}
