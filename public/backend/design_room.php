<?php 
require 'My.php';
$db = new DB_Connect();
$bed_room_arr = $db->BedRoom();
$bed_room_card='<div class="row">';
$bay_list=array();
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
                            <button class="btn btn-primary" type="button" id="add_to_cart">
                              <strong class="btn-text">Add to cart <i class="fas fa-cart-plus"></i></i></strong>
                            </button>
                          </div>
                        </div>
                      </div>';  
   }
$bed_room_card.='</div>';
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
        
        .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 300px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
      }
        .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 10px;
        border: 1px solid #888;
        width: 60%;
       }

        .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
       }
        #saveBT,#Done{    
        width: 150px;
        margin: auto;
       }
       #lingthOfDW{
        display: flex;
        width: 65%;
        margin: auto;
        }
        #inputWH{
        display: inline-flex;
        flex-wrap: nowrap;
        }
       .close:hover,
       .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
        }
        #main_cont{ 
        width: 100%; 
      	height:100%; 
        background-image: url(images/cover.jpg);
        background-size: cover;
        background-position: center;
        }
        #checkFoem{
        display: inline-flex;
        margin: auto;
        }  
        #myCanvas{
          height: getHight();
        }   
               
		</style>

	</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light navbar sticky-top navbar-light bg-light">
    <div class="container-fluid" >
   <a class="navbar-brand" href="index.php" style="font-weight: bold;">
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
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Calssification
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="bed_room.php">Bed Room</a></li>
            <li><a class="dropdown-item" href="living_room.php">Living Room</a></li>
            <li><a class="dropdown-item" href="dining_room.php">Dining Room</a></li>
            <li><a class="dropdown-item" href="office_room.php">Office Room</a></li>
          </ul>
        </li>
        <li class="nav-item" style="width: 125;">
          <a class="nav-link" href="design room.php">Designe room</a>
        </li>
        <li class="nav-item" >
          <a class="nav-link" href="#">Sales</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Bestselling</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">ِAbout</a>
        </li>
      </ul>
    </div>
    <div class="container-fluid" style="padding-left: 450";>
      <form class="d-flex">
        <input class="form-control me-2" style="display: inline-block; width: 250px;" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" style="background-color: white;" type="submit">Search</button>
      </form>
    </div>
    <div style="display: flex; padding-left:15">
      <a href="account.html" style=" color: blue; "><i class="fas fa-user"></i></a>
      <a href="fav.html"style=" color: blue; padding-left:5"><i class="far fa-heart"></i></i></a>
      <a href="card.html"style="; color: blue; padding-left:5"><i class="fas fa-cart-plus"></i></i></a>
    </div>
    </div>
  </nav>
  </nav>
  <h1 style="text-align: center; padding-top: 50px;">Enter You Room Prorerties</h1>
  <span class="input-group" id="inputWH" style="margin-left: 350px; width: 800; padding-top: 50px;">
      <span class="input-group-text"> Enter the width and hoght of your room in meters </span>
      <input id="areaRoomW" type="text" aria-label="First name" placeholder="Width" class="form-control">
      <span class="input-group-text">meter</span>
      <input id="areaRoomH" type="text" aria-label="Last name" placeholder="Height" class="form-control">
      <span class="input-group-text">meter</span>
  </span>
  <div style="display: inline; padding-top: 50px;">
    <select id="selectRoomKind" class="form-select" aria-label="Default select example" style="margin-left: 350px; width: 800; ">
      <option selected>Choose your room type</option>
      <option value="1">Bed Room</option>
      <option value="2">Living Room</option>
      <option value="3">Dining Room</option>
      <option value="3">Office Room</option>
    </select>
  </div>
  <button class="btn btn-outline-secondary" type="button" id="button-addon2" style="margin-left: 1150px; margin-top:10px;" 
   onclick="canvasDIV();">OK
  </button>
  <div id=canvas>
      
  </div>
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <div id="checkFoem">
        <h4 >This Line Present Door Or Window?</h4>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" style="margin-left:5px;">
          <label class="form-check-label" for="flexRadioDefault1"> Door </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" style="margin-left:5px;">
          <label class="form-check-label" for="flexRadioDefault2"> Window </label>
        </div>
      </div>
      <div class="input-group mb-3" id="lingthOfDW">
        <span class="input-group-text">Enter the width of it in meters</span>
        <input type="text" id="WDwidth" class="form-control" aria-label="Amount (to the nearest dollar)">
        <span class="input-group-text">meter</span>
      </div>
      <button type="button" class="btn btn-success"  id="saveBT">Save</button>
    </div>
  </div>
  <button type="button" class="btn btn-success"  id="Done" style="margin-left: 1150px; margin-top: 60px; display: none;"
   >Done</button>

  <div id="roomCard" style="display: none;"><?php echo $bed_room_card; ?></div>
    
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
</body>
<script type="text/javascript">
  var xStart,xEnd,yStart,yEnd,c,ctx;
  let isDrawing = false;
  var areaWidth;
  var areaHeight;
  var canvas = document.getElementById("canvas");
  var modal = document.getElementById("myModal");
  var span = document.getElementsByClassName("close")[0];
  var save = document.getElementById("saveBT");
  var kind =  document.getElementById("selectRoomKind").value;
  var roomCard = document.getElementById("roomCard");
  var DoneBT = document.getElementById("Done");
  var addToCartBT = document.getElementById("add_to_cart");
  


  function DRfunction()
    {
      c=document.getElementById("myCanvas");
      ctx=c.getContext("2d");
      areaWidth =  document.getElementById("areaRoomW").value;
      areaHeight =  document.getElementById("areaRoomH").value; 
      ctx.rect(500, 10, areaWidth*100, areaHeight*100);
      ctx.lineWidth = "10";
      ctx.strokeStyle = "black";
      ctx.stroke();
      document.getElementById("Done").style.display= "block";
    

      

    }
  function canvasDIV()
  {
    areaHeight =  document.getElementById("areaRoomH").value;
    canvas.innerHTML= '<canvas id="myCanvas" width="1520" height="'+areaHeight*110+'" ></canvas>'; 
    DRfunction();
  

  c.addEventListener('mousedown', e => 
    {
      xStart = e.offsetX;
      yStart = e.offsetY;
      var p = ctx.getImageData(xStart, yStart, 1, 1).data; 
      if(p[3]==0)
      {isDrawing = false;}
      else {isDrawing=true;}
      console.log(p);
    });

  c.addEventListener('mouseup', e => 
    {
      if(isDrawing==true)
      { 
        modal.style.display = "block";
        isDrawing = false;} 
    });
  c.addEventListener('mousemove', e => 
  {
    xEnd = e.offsetX;
    yEnd = e.offsetY;
    var dx=xStart- xEnd+10; if(dx<0){dx=dx*-1;}
    var dy=yStart- yEnd+10; if(dy<0){dy=dy*-1;}
    if(isDrawing === true) 
    {
     if(dx>=dy){drawLine(ctx, xStart, yStart, xEnd, yStart);}
     else if(dx<dy){drawLine(ctx, xStart, yStart, xStart, yEnd);}
    }  
  });
  }

  save.onclick = function() 
  {
    var WIcheck = document.getElementById("flexRadioDefault2").checked;
    var DOcheck = document.getElementById("flexRadioDefault1").checked;
    var WDwidth = document.getElementById("WDwidth").value;
    // if(WDwidth.length==0 && WIcheck) {alert("enter the width of you window ");}
    // if(WDwidth.length==0 && DOcheck) {alert("enter the width of you door ");}
    // if(!WIcheck || !DOcheck) {alert("choose what you draw a line for ");}
    if(WIcheck || DOcheck && WDwidth.length!=0)
    {modal.style.display = "none";}
    if(kind==1){}
  }

  DoneBT.onclick = function()
  {
    roomCard.style.display = "block";
    console.log("AAAAAAAA");
  }
  
  span.onclick = function() 
  {
    modal.style.display = "none";
  }
  addToCartBT.onclick= function()
  {

  }

  function drawLine(ctx, x1, y1, x2, y2) 
  {
    ctx.beginPath();
    ctx.strokeStyle = 'red';
    ctx.lineWidth = 10;
    ctx.moveTo(x1, y1);
    ctx.lineTo(x2, y2);
    ctx.stroke();
    ctx.closePath();
    ctx.lineCap = 'round';
  }

  function rgbToHex(r, g, b)
  {
    if (r > 255 || g > 255 || b > 255)
    throw "Invalid color component";
    return ((r << 16) | (g << 8) | b).toString(16);
  }

</script>