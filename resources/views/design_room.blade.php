

 @extends('main')

    @section('links')
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
    @endsection


  @section('body')
  <body onload="deletLocalSorage();">
  @include('navBar')

  <h1 style="text-align: center; padding-top: 50px;">Enter You Room Prorerties</h1>
  <div style="width: 800px">
  <span class="input-group" id="inputWH" style="margin-left: 350px; width:100%; padding-top: 50px;">
      <span class="input-group-text"> Enter the width and hoght of your room in meters </span>
      <input id="areaRoomW" type="number" aria-label="First name" placeholder="Width" class="form-control">
      <span class="input-group-text">meter</span>
      <input id="areaRoomH" type="number" aria-label="Last name" placeholder="Height" class="form-control">
      <span class="input-group-text">meter</span>
  </span>
  <div style="display: inline; padding-top: 50px;">
    <select id="selectRoomKind" class="form-select" aria-label="Default select example" style="margin-left: 350px; width: 800; ">
      <option selected>Choose your room type</option>
      <option id="1" value="1">Bed Room</option>
      <option id="2" value="2">Living Room</option>
      <option id="3" value="3">Dining Room</option>
      <option id="4" value="4">Office Room</option>
    </select>
  </div>
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
          <input type="numder" id="WDwidth" class="form-control" aria-label="Amount (to the nearest dollar)">
          <span class="input-group-text">meter</span>
        </div>
        <button type="button" class="btn btn-success"  id="saveBT" >Save</button>
      </div>
    </div>
    <button type="button" class="btn btn-success"  id="Done" style="margin-left: 1150px; margin-top: 60px; display: none; "
    >Done</button>
    <div class="card-group">
    <div class="row" id="roomCard" style="display: flex;"> </div>
 </div>
   <a class="btn btn-primary" href="{{route('finalRoom')}}" role="button" id="nextBT" style="margin-left: 1150px; display: none;">Next</a>
  @include("footer");
  </body>
@endsection

@section('scripts')
<script type="text/javascript">
  var xStart,xEnd,yStart,yEnd,c,ctx,dx,dy;
  var isDrawing = false;
  var areaWidth;
  var areaHeight;
  var CartIdArr=[];
  var canvas = document.getElementById("canvas");
  var modal = document.getElementById("myModal");
  var span = document.getElementsByClassName("close")[0];
  var save = document.getElementById("saveBT");
  var kind =  document.getElementById("selectRoomKind");
  var roomCard = document.getElementById("roomCard");
  var DoneBT = document.getElementById("Done");
  var addToCartBT = document.getElementById("add_to_cart");
  var nextBT = document.getElementById("nextBT")
  var roomSpace;
  var totalItemSpace=0;


  function deletLocalSorage()
  {
    localStorage.clear();
    console.log(localStorage);
  }

  function DRfunction()
    {
      c=document.getElementById("myCanvas");
      ctx=c.getContext("2d");
      areaWidth =  document.getElementById("areaRoomW").value;
      areaHeight =  document.getElementById("areaRoomH").value;
      roomSpace= space(areaWidth*100,areaHeight*100);
      ctx.rect(500, 10, areaWidth*100, areaHeight*100);
      ctx.lineWidth = "10";
      ctx.strokeStyle = "black";
      ctx.stroke();
      document.getElementById("Done").style.display= "block";
      localStorage.setItem('areaWidth',areaWidth);
      localStorage.setItem('areaHeight',areaHeight);


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
      console.log(isDrawing);
    });

    c.addEventListener('mouseup', e =>
    {
      if(isDrawing==true)
      {
        modal.style.display = "block";
        isDrawing = false;
        }

    });
    c.addEventListener('mousemove', e =>
    {
        xEnd = e.offsetX;
        yEnd = e.offsetY;
        dx=xStart- xEnd+10; if(dx<0){  dx=dx*-1;}
        dy=yStart- yEnd+10; if(dy<0){  dy=dy*-1;}
        if(isDrawing === true)
        {
         if(dx>=dy){drawLine(ctx, xStart, yStart, xEnd, yStart); }
         else if(dx<dy){drawLine(ctx, xStart, yStart, xStart, yEnd);}
        }

    });
  }

  save.onclick = function()
  {
    var WIcheck = document.getElementById("flexRadioDefault2").checked;
    var DOcheck = document.getElementById("flexRadioDefault1").checked;
    var WDwidth = document.getElementById("WDwidth").value;
    var lineInfo = [WDwidth,xStart,yStart,xEnd,yEnd];


    if(WIcheck){localStorage.setItem('window',lineInfo);}
    else if(DOcheck){localStorage.setItem('door',lineInfo);}
    if(WIcheck || DOcheck && WDwidth.length!=0)
    {modal.style.display = "none";}


  }

  DoneBT.onclick = function()
  {
    var roomKind = document.getElementById(kind.value).innerHTML;

    $.ajax({
        method: 'GET',
        url: 'get_kind',
        dataType: 'json',
        data: {
            kind:kind.value,
        }
    }).done((json) => {


        var kind_fav = json.kind_fav;
        var kind_data = json.kind_data;
        var office_card = json.office_data;
        console.log(office_card);

        var roomsRow = $('#roomCard');

        roomsRow.empty();
        roomsRow.append(`<h2 class="bestselling"> Your Favorite </h2>`);

        for(i = 0 ;i<kind_fav.length;i++)
        {
            roomsRow.append(`<div class="col-lg-4">
            <div class="card">
              <img src="http://localhost/furniture/public/${kind_fav[i].image}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">${kind_fav[i].furn_name}</h5>
                width:${kind_fav[i].width} height: ${kind_fav[i].height}  depth: ${kind_fav[i].depth}<br>
                  price:${kind_fav[i].price}
                </p>
                <button id="addToCartBT" class="btn btn-primary" type="button" onclick="AddToCart(${kind_fav[i].ID},${kind_fav[i].width},${kind_fav[i].depth});" >
                  <strong class="btn-text">Add to cart <i class="fas fa-cart-plus"></i></i></strong>
                </button>
              </div>
            </div>
          </div>`);
        }

        roomsRow.append(`<h2 class="bestselling"> ${roomKind} </h2>`);

        for(i = 0 ;i<kind_data.length;i++)
        {
            roomsRow.append(`<div class="col-lg-4">
            <div class="card">
              <img src="http://localhost/furniture/public/${kind_data[i].image}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">${kind_data[i].furn_name}</h5>
                <p class="card-text">width: ${kind_data[i].width} height: ${kind_data[i].height}  depth: ${kind_data[i].depth}<br>
                  price:${kind_data[i].price}
                </p>
                <button id="addToCartBT" class="btn btn-primary" type="button"
                onclick="AddToCart(${kind_data[i].ID},${kind_data[i].width},${kind_data[i].depth});">
                  <strong class="btn-text">Add to cart <i class="fas fa-cart-plus"></i></i></strong>
                </button>
              </div>
            </div>
          </div>`);
        }
        if(kind.value==1)
        {
            roomsRow.append(`<h2 class="bestselling"> Office </h2>`);
            for(i = 0 ;i<office_card.length;i++)
            {
                roomsRow.append(`<div class="col-lg-4">
                <div class="card">
                  <img src="http://localhost/furniture/public/${office_card[i].image}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">${office_card[i].furn_name}</h5>
                    width:${office_card[i].width} height: ${office_card[i].height}  depth: ${office_card[i].depth}<br>
                      price:${office_card[i].price}
                    </p>
                    <button id="addToCartBT" class="btn btn-primary" type="button" onclick="AddToCart(${office_card[i].ID},${office_card[i].width},${office_card[i].depth});" >
                      <strong class="btn-text">Add to cart <i class="fas fa-cart-plus"></i></i></strong>
                    </button>
                  </div>
                </div>
                </div>`);
            }
        }

    }).fail((json)=>{
        console.log('fail');
    });
    nextBT.style.display = "block";
    console.log(localStorage);

  }

  function AddToCart($cardID,$width,$depth)
  {
    var itemSpace = $width*$depth;

    for(i=0; i<CartIdArr.length;i++)
    {
        if(CartIdArr[i]==$cardID)
        {
            alert("Already Exist")
            $("addToCartBT").attr("disabled", true);
            return;
        }

        totalItemSpace = totalItemSpace + itemSpace;
        console.log(totalItemSpace);
        if(totalItemSpace> roomSpace*65/100)
        {
            alert("you can't add any more Items");
            return;
         }
    }
    CartIdArr.push($cardID);

    console.log(CartIdArr);
  }

  nextBT.onclick = function()
  {
      localStorage.setItem('InCartArr',CartIdArr);
      localStorage.setItem('roomKind',kind.value);
  }
  span.onclick = function()
  {
    modal.style.display = "none";
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

  function space($x,$y)
  {
      space = $x*$y;
      return (space);

  }
</script>

@endsection
