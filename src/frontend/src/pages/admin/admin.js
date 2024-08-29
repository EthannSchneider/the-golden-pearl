import { is_login } from "../../services/auth";

function App() {
  is_login()
  .then(response => {
    if (!response.data.authenticated) {
      window.location = "/admin/login";
    }
  });
  return (
    <div className="Admin">
      <div class="d-flex justify-content-center mt-5">
        <h1>Dashboard</h1>
      </div>
      <div class="d-flex justify-content-center align-items-center">
        <a href="/admin/meals" class="text-black text-decoration-none border rounded-3 p-1">Meals</a>
        <a href="/admin/dailyMenu" class="text-black text-decoration-none border rounded-3 p-1">Daily Menu</a>
      </div>
      <hr/>

      <br/><br/><br/><br/><br/><br/><br/>
    </div>
  );
}

export default App;
  