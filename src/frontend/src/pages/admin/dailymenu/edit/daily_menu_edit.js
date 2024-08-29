import { is_login } from "../../../../services/auth";
import { deleteMealFromDailyMenu, getCurrentDailyMenu } from "../../../../services/daily_menu"
import { useParams } from "react-router-dom";

// TODO add method to update and not only delete

function App() {
    const {name} = useParams()

    is_login()
    .then(response => {
        if (!response.data.authenticated) {
        window.location = "/admin/login";
        }
    });
    checkIfMealIsInDailyMenu(name)
    return (
        <div className="AdminDailyMenuEdit"> 
            <div class="d-flex justify-content-end m-5">
                <button onClick={() => buttonDeleteMealsFromDailyMenu(name)}>Remove from dailyMenu</button>
            </div>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        </div>
    )
}

function checkIfMealIsInDailyMenu(name) {
    getCurrentDailyMenu()
    .then(response => {
        var redirect = true;

        response.data.forEach(meals => {
            if (meals.name == name) {
                redirect = false
            }
        });

        if (redirect) {
            window.location = "/admin/dailyMenu"
        }
    })
}

function buttonDeleteMealsFromDailyMenu(name) {
    deleteMealFromDailyMenu(name).then(response => {
        window.location = "/admin/dailyMenu";
    })
    .catch(error => {
        window.location = "/admin/dailyMenu";
    });
}

export default App;
