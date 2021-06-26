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

<body onload="DRoom()">
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
          <li class="nav-item">
            <a class="nav-link" href="design room.php">Designe room</a>
          </li>
          <li class="nav-item">
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
  <div >
    <canvas id="myCanvas" width="1520" height="850" ></canvas>
  </div>
</body>
<script>
  var c=document.getElementById("myCanvas");
  var ctx=c.getContext("2d");
  function DRoom(){
    ctx.rect(500, 40, 400, 400);
    ctx.lineWidth = "10";
    ctx.strokeStyle = "black";
    ctx.stroke();
    drawLine(ctx, 650,40,750,40);
    drawLine(ctx, 790,440,890,440);
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
</script>