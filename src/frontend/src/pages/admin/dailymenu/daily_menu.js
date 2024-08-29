import { is_login } from "../../../services/auth";
import { getCurrentDailyMenu, addMealToDailyMenu } from "../../../services/daily_menu";
import { getMeals } from "../../../services/meals";

function App() {
  is_login()
  .then(response => {
    if (!response.data.authenticated) {
      window.location = "/admin/login";
    }
  });
  getAllDailyMenu();
  getAllMeals();
  return (
    <div className="AdminDailyMenu">
      <div class="d-flex justify-content-center mt-5">
        <h1>Dashboard - Admin Daily menu</h1>
      </div>
      <div class="d-flex justify-content-center align-items-center">
        <a href="/admin" class="text-black text-decoration-none border rounded-3 p-1">Admin</a>
        <a href="/admin/Meals" class="text-black text-decoration-none border rounded-3 p-1">Meals</a>
      </div>
      <div class="d-flex justify-content-center align-items-center"> 
          <select id="selectName"></select>
          <a onClick={onClickAddDailyMenu} class="text-black text-decoration-none border rounded-3 p-1">Create</a>
      </div>
      <hr/>
      <div class="d-flex justify-content-center m-3">
        <table id="dailyMenu">
                
        </table>
      </div>
    </div>
  );
}

function getAllDailyMenu() {
  getCurrentDailyMenu()
  .then(response => {
    var dailyMenu = document.getElementById("dailyMenu");

    dailyMenu.innerHTML = "";
    dailyMenu.innerHTML = "<tr class=\"border-3\"> <th class=\"border\">name</th> <th class=\"border\">description</th> <th class=\"border\">edit</th> </tr>";
    response.data.forEach(meals => {
      dailyMenu.innerHTML += "<tr class=\"border-2\"> <td class=\"border\">" + meals.name + "</td> <td class=\"border\"> " + meals.description + " </td> <td class=\"border\"><a class=\"text-black \" href=\"/admin/dailyMenu/" + meals.name + "\">edit</a></td> </div>"
    });
  });
}

function getAllMeals() {
  getMeals()
  .then(response => {
    var selectBox = document.getElementById("selectName")

    selectBox.innerHTML = ""
    response.data.forEach(
      meals => {
        selectBox.innerHTML += "<option value=\"" + meals.name + "\">" + meals.name + "</option>"
      }
    )
  });
}

function onClickAddDailyMenu() {
  var name = document.getElementById("selectName").value

  if (name !== "") {
      addMealToDailyMenu(name)
      .then(response => {
        getAllDailyMenu()
      })
      .catch(error => {
        console.log(error);
      });
  }
}


export default App;
  