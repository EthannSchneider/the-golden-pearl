import { is_login } from "../../../../services/auth";
import { getMeal, deleteMeal } from "../../../../services/meals";
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
    getMeals(name);
    return (
        <div id="meals" className="MealsEdit">
            <div class="d-flex justify-content-end m-5">
                <button onClick={() => deleteMeals(name)}>Delete</button>
            </div>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        </div>
    )
}

function getMeals(name) {
    getMeal(name)
    .then(response => {

    })
    .catch(error => {
        window.location = "/admin/meals";
    });
}

function deleteMeals(name) {
    deleteMeal(name).then(response => {
        window.location = "/admin/meals";
    })
    .catch(error => {
        window.location = "/admin/meals";
    });
}

export default App;

