

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
      <option value="1">Bed Room</option>
      <option value="2">Living Room</option>
      <option value="3">Dining Room</option>
      <option value="3">Office Room</option>
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
        <button type="button" class="btn btn-success"  id="saveBT">Save</button>
      </div>
    </div>
  <button type="button" class="btn btn-success"  id="Done" style="margin-left: 1150px; margin-top: 60px; display: none;"
   >Done</button>
   <div class="card-group">
    <div class="row" id="roomCard" style="display: flex;"> </div>
   </div>
  @include("footer");
@endsection

@section('scripts')
<script type="text/javascript">
  var xStart,xEnd,yStart,yEnd,c,ctx;
  let isDrawing = false;
  var areaWidth;
  var areaHeight;
  var canvas = document.getElementById("canvas");
  var modal = document.getElementById("myModal");
  var span = document.getElementsByClassName("close")[0];
  var save = document.getElementById("saveBT");
  var kind =  document.getElementById("selectRoomKind");
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
    console.log(kind.value)
    $.ajax({
        method: 'GET',
        url: 'get_kind',
        dataType: 'json',
        data: {
            kind:kind.value,
        }
    }).done((json) => {
        console.log('success');
        console.log(json.kind_data);

        var kind_data = json.kind_data;
        var roomsRow = $('#roomCard');

        roomsRow.empty();
        roomsRow.append(`<h2 class="bestselling"> Your Favorite </h2>`);

        for(i = 0 ;i<kind_data.length;i++)
        {
            roomsRow.append(`<div class="col-lg-4">
            <div class="card">
              <img src="http://localhost/furniture/public/${kind_data[i].image}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">${kind_data[i].furn_name}</h5>
                <p class="card-text">width:120cm
                  height:20cm <br>
                  price:${kind_data[i].price}
                </p>
                <button class="btn btn-primary" type="button" id="add_to_cart">
                  <strong class="btn-text">Add to cart <i class="fas fa-cart-plus"></i></i></strong>
                </button>
              </div>
            </div>
          </div>`)
        }


    }).fail((json)=>{
        console.log('fail');
    });
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

</script>

@endsection
