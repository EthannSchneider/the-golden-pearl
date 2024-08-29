import { is_login, login } from "../../../services/auth";

function App() {
  is_login()
    .then(response => {
      if (response.data.authenticated) {
        window.location = "/admin";
      }
  });
  return (
    <div className="Login">
      <div class="d-flex justify-content-center mt-5">
        <h1>Login</h1>
      </div>
      <div class="d-flex justify-content-center"> 
        <form  onSubmit={submitLogin} class="d-flex flex-column w-50">
          <p id="error" class="bg-danger text-light rounded-3 p-2" hidden></p>
          <input class="my-2" id="username" type="text" placeholder="Username" />
          <input class="my-2" id="password" type="password" placeholder="Password" />
          <input type="submit" value="Login" class="btn btn-dark my-4" />
        </form>
      </div>
    </div>
  );
}

function submitLogin(event) {
  event.preventDefault();

  login(document.getElementById("username").value, document.getElementById("password").value)
  .then(response => {
    window.location = "/admin";
  })
  .catch(err => {
    error("user or password not exist");
    return;
  });
}

function error(errorValue) {
  var errorComponent = document.getElementById("error")

  errorComponent.innerHTML  = errorValue;
  errorComponent.hidden = false;
}

export default App;
  