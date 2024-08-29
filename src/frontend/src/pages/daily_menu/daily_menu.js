import { getCurrentDailyMenu } from "../../services/daily_menu";
import './daily_menu.css'

function App() {
  getMenu();

  return (
    <div className="DailyMenu">
      <div class="d-flex justify-content-center my-5">
        <h1>Daily Menu</h1>
      </div>
      <hr/>
      <div id="menu" class="d-flex flex-column py-3 mx-3 mb-5 gap-4 rounded-3"></div>
    </div>
  );
}

function getMenu() {
  getCurrentDailyMenu()
  .then(dailyMenu => {
    var menu = document.getElementById("menu")
    menu.innerHTML = ""
    if (dailyMenu.data.length === 0) {
      noDailyMenu();
    }else {
      menu.innerHTML += "<div class=\"row d-flex justify-content-around align-items-center mx-5 rounded-3 back-on-mobile hide-on-mobile\"> <h2 class=\"col\"> Meals Names </h2> <h2 class=\"col align-items-center\"> Description </h2> <h2 class=\"col align-items-center\"> Calories </h2> <h2 class=\"col align-items-center\"> Prices </h2> </div>";
      dailyMenu.data.forEach(meals => {
        menu.innerHTML += "<div class=\"row d-flex justify-content-around align-items-center mx-5 rounded-3 back-on-mobile\"> <h5 class=\"col\"> " + meals.name + " </h2> <p class=\"col align-items-center\"> " + meals.description + " </p> <p class=\"col align-items-center\"> " + meals.calories + " kcal </p> <p class=\"col align-items-center\"> " + meals.price + " CHF </p> </div>" 
      });
    }
  })
  .catch(err => {
    noDailyMenu()
  });

  function noDailyMenu() {
    document.getElementById("menu").innerHTML = "<p class=\"d-flex justify-content-center\">There is no menu for now</p><br/><br/><br/><br/><br/><br/><br/>";
  }

} 

export default App;
