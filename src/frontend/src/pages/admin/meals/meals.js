import { is_login } from "../../../services/auth";
import { getMeals, createMeal } from "../../../services/meals";

function App() {
    is_login()
    .then(response => {
      if (!response.data.authenticated) {
        window.location = "/admin/login";
      }
    });
    getAllMeals();
    return (
        <div className="Meals">
            <div class="d-flex justify-content-center mt-5">
                <h1>Dashboard - Meals</h1>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <a href="/admin" class="text-black text-decoration-none border rounded-3 p-1">Admin</a>
                <a href="/admin/dailyMenu" class="text-black text-decoration-none border rounded-3 p-1">Daily Menu</a>
            </div>
            <div class="d-flex justify-content-center align-items-center"> 
                <input id="create_name" type="text" placeholder="name"/>
                <input id="create_calories" type="number" placeholder="Calories"/>
                <input id="create_price" type="number" placeholder="Price in CHF"/>
                <a onClick={onClickCreateMeals} class="text-black text-decoration-none border rounded-3 p-1">Create</a>
            </div>
            <div class="d-flex justify-content-center align-items-center"> 
                <textarea id="create_description" placeholder="description"/>
            </div>
            <hr/>
            <div class="d-flex justify-content-center m-3">
                <table id="meals">
                    
                </table>
            </div>
        </div>
    );
}

function onClickCreateMeals(event) {
    var name = document.getElementById("create_name").value
    var description = document.getElementById("create_description").value
    var calories = document.getElementById("create_calories").value
    var price = document.getElementById("create_price").value

    if (name !== "" || description !== "") {
        createMeal(name, description, calories, price)
        .then(response => {
            getAllMeals()
        })
        .catch(error => {
            console.log(error);
        });
    }
}

function getAllMeals() {
    getMeals()
    .then(response => {
        var mealsElement = document.getElementById("meals");

        mealsElement.innerHTML = "<tr class=\"border-3\"> <th class=\"border\">name</th> <th class=\"border\">description</th> <th class=\"border\">edit</th> </tr>";
        response.data.forEach(meals => {
            mealsElement.innerHTML += "<tr class=\"border-2\"> <td class=\"border\">" + meals.name + "</td> <td class=\"border\"> " + meals.description + " </td> <td class=\"border\"><a class=\"text-black \" href=\"/admin/meals/" + meals.name + "\">edit</a></td> </div>";
        });
    });
}

export default App;