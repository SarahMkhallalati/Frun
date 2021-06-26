<?php 
require 'My.php';
$db = new DB_Connect();
$dining_room_arr = $db->DiningRoom();
$dining_room_card='<div class="row">';
  foreach ($dining_room_arr as $key => $dining_room_furn) 
   {
    $dining_room_card .= '<div class="col-lg-4">
                        <div class="card">
                          <img src="'.$dining_room_furn["image"].'"class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title">'.$dining_room_furn["furn_name"].'</h5>
                            <p class="card-text">width:120cm
                              height:20cm <br>
                              price:'.$dining_room_furn["price"].'
                            </p>
                            <button class="btn btn-primary" type="button">
                              <strong class="btn-text">Add to favorite <i class="far fa-heart"></i></i></strong>
                            </button>
                          </div>
                        </div>
                      </div>';  
   }
$dining_room_card.='</div>';

 ?>
 <Doctype html>
	<!DOCTYPE html>
	<html>
 
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>East SR</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/logo.jpg"/>  
		<link href="fontawesome-free-5.12.0-web/css/all.min.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Dancing Script"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Cabin"/>
	  <link rel="stylesheet" type="text/css" href="css/css/bootstrap.min.css"/>
    <script type="text/javascript" src="JS/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="JS/popper.min.js"></script>
    <script type="text/javascript" src="JS/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        #main_cont{ 
      			width: 100%; 
      			height:100%; 
      			background-image: url(images/cover.jpg);
      			background-size: cover;
      			background-repeat: no-repeat;
      		  background-position: center;
                 }
		</style>

	</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar sticky-top navbar-light bg-light">
  <div class="container-fluid" >
   <a class="navbar-brand" href="#" style="font-weight: bold;">
      <img src="images/logo.png" alt="" width="30" height="35" class="d-inline-block align-text-center">
      East SR
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Calssification
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="bed_room.php">Bed Room</a></li>
            <li><a class="dropdown-item" href="living_room.php">Living Room</a></li>
            <li><a class="dropdown-item" href="dining_room.php">Dining Room</a></li>
            <li><a class="dropdown-item" href="office_room.php">Office Room</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="design room.php">Designe room</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Sales</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Bestselling</a>
        </li>
      </ul>
    </div>
    <div class="container-fluid" style="padding-left: 560";>
      <form class="d-flex">
        <input class="form-control me-2" style="display: inline-block; width: 250px;" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" style="background-color: white;" type="submit">Search</button>
      </form>
    </div>
    <div style="display: inline-block;">
      <a href="account.html" style="padding-left: 45px; color: blue;"><i class="fas fa-user"></i></a>
      <a href="fav.html"style="padding-left: 45px; color: blue;"><i class="far fa-heart"></i></i></a>
      <a href="card.html"style="padding-left: 45px; color: blue;"><i class="fas fa-cart-plus"></i></i></a>
    </div>
  </div>
</nav>

<body>

	<hr>
	<h2  class="bestselling"> Dining Room </h2>
	<div class="card-group">
   		 <?php echo $dining_room_card; ?>
	</div>

</body>
<hr>
<footer class="footer">
		<div style="width:25%;">
		<p id="in-footer"> We're Here To Help</p>
		<ul class="ul-footer">
			<li><a href="#">Customer Service</a></li>
			<li><a href="#">Email Preference</a></li>
			<li><a href="#">Contact Us</a></li>
			<li><a href="#">Give Us FeedBack</a></li>
		</ul>
	</div>
	<div style="width: 25%;">
		<p id="in-footer"> Policies</p>
		<ul class="ul-footer">
			<li><a href="#">Shipping & Delivery</a></li>
			<li><a href="#">Returns</a></li>
			<li><a href="#">Payment Methods</a></li>
			<li><a href="#">Privacy Policy</a></li>
		</ul>
   </div>
   <div style="width: 25%;">
		<p id="in-footer">Get In Touch</p>
		<pre><i class="fab fa-facebook-f"></i> </pre>
   </div>
   </footer>

		<h6 id="lastline">all copy right reserved 2021 ©</h6>
	
</html