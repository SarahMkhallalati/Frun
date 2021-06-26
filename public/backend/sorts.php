<?php 
require 'My.php';
$db = new DB_Connect();
$bed_room_arr = $db->BedRoom();
$bed_room_card='<div class="row">';
  foreach ($bed_room_arr as $key => $bed_room_furn) 
   {
    $bed_room_card .= '<div class="col-lg-4">
                        <div class="card">
                          <img src="'.$bed_room_furn["image"].'"class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title">'.$bed_room_furn["furn_name"].'</h5>
                            <p class="card-text">width:120cm
                              height:20cm <br>
                              price:'.$bed_room_furn["price"].'
                            </p>
                            <button class="btn btn-primary" type="button">
                              <strong class="btn-text">Add to favorite <i class="far fa-heart"></i></i></strong>
                            </button>
                          </div>
                        </div>
                      </div>';  
   }
$bed_room_card.='</div>';

// $living_room_arr = $db->LivingRoom();
// $living_room_card="";
// foreach ($living_room_arr as $key => $living_room_furn) 
//    {
//     $living_room_card .= '<div class="col-lg-4">
//                         <div class="card">
//                           <img src="'.$living_room_card["image"].'"class="card-img-top" alt="...">
//                           <div class="card-body">
//                             <h5 class="card-title">'.$living_room_card["furn_name"].'</h5>
//                             <p class="card-text">width:120cm
//                               height:20cm <br>
//                               price:'.$living_room_card["price"].'
//                             </p>
//                             <button class="btn btn-primary" type="button">
//                               <strong class="btn-text">Add to favorite <i class="far fa-heart"></i></i></strong>
//                             </button>
//                           </div>
//                         </div>
//                       </div>';  
//    }   

// $dining_room_arr = $db->DiningRoom();
// $dining_room_card="";
// foreach ($dining_room_arr as $key => $dining_room_furn) 
//    {
//     $dining_room_card .= '<div class="col-lg-4">
//                         <div class="card">
//                           <img src="'.$dining_room_card["image"].'"class="card-img-top" alt="...">
//                           <div class="card-body">
//                             <h5 class="card-title">'.$dining_room_card["furn_name"].'</h5>
//                             <p class="card-text">width:120cm
//                               height:20cm <br>
//                               price:'.$dining_room_card["price"].'
//                             </p>
//                             <button class="btn btn-primary" type="button">
//                               <strong class="btn-text">Add to favorite <i class="far fa-heart"></i></i></strong>
//                             </button>
//                           </div>
//                         </div>
//                       </div>';  
//    }

// $office_room_arr = $db->OfficeRoom();
// $office_room_card="";
// foreach ($office_room_arr as $key => $office_room_furn) 
//    {
//     $office_room_card .= '<div class="col-lg-4">
//                         <div class="card">
//                           <img src="'.$office_room_card["image"].'"class="card-img-top" alt="...">
//                           <div class="card-body">
//                             <h5 class="card-title">'.$office_room_card["furn_name"].'</h5>
//                             <p class="card-text">width:120cm
//                               height:20cm <br>
//                               price:'.$office_room_card["price"].'
//                             </p>
//                             <button class="btn btn-primary" type="button">
//                               <strong class="btn-text">Add to favorite <i class="far fa-heart"></i></i></strong>
//                             </button>
//                           </div>
//                         </div>
//                       </div>';  
//    }  
    
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
<nav style="background-color: skyblue; height: 30px; margin: auto;">
		    <a href="#"> Bed Room </a>
		    <a href="sorts.php"> Living Room </a>
		    <a href="designe.html"> Dining Room </a>	
		    <a href="about.html"> Office Room </a>	
		    	
</nav>

<body>

	<hr>
	<h2> Bed Room </h2>
	<div class="card-group">
   <?php echo $bed_room_card; ?>
  </div>

	<hr>
	<h2  class="bestselling"> Living Room </h2>
	<div class="card-group">
   		 
	</div>

	<hr>
	<h2  class="bestselling"> Dining Room </h2>
	<div class="card-group">
   		
	</div>

	<hr>
	<h2  class="bestselling"> Office Room </h2>
	<div class="card-group">
   		 <?php echo $office_room_card; ?>
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
	
</html>