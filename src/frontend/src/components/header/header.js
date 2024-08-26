function App() {
  return (
    <header className="Header" class="sticky-top text-bg-light">
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <a class="navbar-brand" href="/" >
            <img src="logo256.png" alt="logo" width="70" />
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="/who_are_we">Who are we ?</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/daily_menu">Daily Menu</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
  );
}

export default App;
