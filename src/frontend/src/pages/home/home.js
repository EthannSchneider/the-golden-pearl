import './home.css'

function App() {
  return (
    <div className="Home">
      <div id="homeSlider" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="/assets/img/banner1.png" class="d-block w-100" alt="banner 1" />
          </div>
          <div class="carousel-item">
            <img src="/assets/img/banner2.png" class="d-block w-100" alt="banner 2" />
          </div>
          <div class="carousel-item">
            <img src="/assets/img/banner3.png" class="d-block w-100" alt="banner 3" />
          </div>
          <div class="carousel-item">
            <img src="/assets/img/banner4.png" class="d-block w-100" alt="banner 4" />
          </div>
        </div>
        <div id="container" class="d-flex flex-column justify-content-center align-items-center">
          <img src="/assets/img/logo256.png" alt="logo" width="70" />
          <h1 class="text-light p-2">The Golden Pearl</h1>
          <p class="text-light p-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget nunc a nibh vestibulum viverra. Sed vitae erat nec justo cursus malesuada.</p>
        </div>
      </div>

      <div id="WhoAreWe" class="d-flex justify-content-around m-4">
        <div class="mx-3">
          <img src="/assets/img/old_house.png" alt="img" />
        </div>
        <div>
          <h1>Who Are We ?</h1>

          <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Urna lacus sollicitudin habitasse quisque lacus; sollicitudin duis curabitur. Gravida natoque aliquam egestas; potenti nullam quis pretium. Consequat facilisis facilisi sed efficitur donec risus nec. Hendrerit himenaeos ullamcorper sodales; orci cras et inceptos blandit. Orci vulputate sapien vehicula non fringilla lectus. Commodo quisque tellus pulvinar fermentum; nisi ut cubilia. Sem aptent id integer dignissim phasellus massa; metus efficitur lobortis. Ut mollis ultricies finibus et potenti sagittis. Efficitur convallis varius curae imperdiet nascetur mauris maecenas nascetur. <br/><br/> Convallis accumsan laoreet urna aliquam ipsum parturient elit amet leo. Class maximus dui ad arcu mauris dictum ut. Praesent laoreet molestie pretium augue, aliquet hendrerit sodales. Sagittis eget suscipit interdum volutpat natoque curabitur mi at mi. Proin pulvinar metus; molestie lacinia aliquam potenti aptent. Tempus porta egestas ipsum etiam efficitur eget in nullam elit. Varius felis vitae volutpat litora pulvinar. Aenean sit nisl penatibus dui sagittis sollicitudin aliquam. Donec hendrerit fermentum per elit integer. Nam elit aenean pulvinar dapibus facilisi; dui mi tortor.</p>
        </div>
      </div>
    </div>
  );
}

export default App;
