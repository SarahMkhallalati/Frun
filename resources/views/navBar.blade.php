<nav class="navbar navbar-expand-lg navbar-light bg-light navbar sticky-top navbar-light bg-light">
    <div class="container-fluid" >
     <a class="navbar-brand" href="index.php" style="font-weight: bold;">
        <img src="{{asset('images/logo.png')}}" alt="" width="30" height="35" class="d-inline-block align-text-center">
        East SR
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('Index')}}">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Calssification
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="{{route('bed_rooms')}}">Bed Room</a></li>
              <li><a class="dropdown-item" href="{{route('living_room')}}">Living Room</a></li>
              <li><a class="dropdown-item" href="dining_room.php">Dining Room</a></li>
              <li><a class="dropdown-item" href="office_room.php">Office Room</a></li>
            </ul>
          </li>
          <li class="nav-item" style="width: 125;">
            <a class="nav-link" href="{{route('design_room')}}">Designe room</a>
          </li>
          <li class="nav-item" >
            <a class="nav-link" href="#">Sales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Bestselling</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('about_us')}}">ِAbout</a>
          </li>
        </ul>
      </div>
      <div class="container-fluid" style="margen-left:500";>
        <form class="d-flex">
          <input class="form-control me-2" style="display: inline-block; width: 250px; padding-left: 450;" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" style="background-color: white;" type="submit">Search</button>
        </form>
      </div>
      <div style="display: flex; padding-left:15">
        <a href="{{route('account')}}" style=" color: blue; "><i class="fas fa-user"></i></a>
        <a href="fav.html"style=" color: blue; padding-left:5"><i class="far fa-heart"></i></i></a>
        <a href="card.html"style="; color: blue; padding-left:5"><i class="fas fa-cart-plus"></i></i></a>
      </div>
    </div>
  </nav>
