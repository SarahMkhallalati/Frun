@extends('main')

    @section('links')
    <style>

        #main_cont{
        width: 100%;
      	height:100%;
        background-image: url(images/cover.jpg);
        background-size: cover;
        background-position: center;
        }
		</style>
    @endsection

  @section('body')
  @include('navBar')
    <body onload="DRfunction();" >
        <div id="theRoom" >

        </div>
    </body>
  @include("footer");
@endsection

@section('scripts')
<script type="text/javascript">
    var areaWidth = localStorage.getItem('areaWidth');
    var areaHeight = localStorage.getItem('areaHeight');
    var Door = localStorage.getItem('door');
    var Window = localStorage.getItem('window');
    var theRoom = document.getElementById("theRoom");
    var c,ctx;

    function DRfunction()
    {
        theRoom.innerHTML= '<canvas id="myCanvas" width="1520" height="'+areaHeight*110+'" ></canvas>';
        c=document.getElementById("myCanvas");
        ctx=c.getContext("2d");
        ctx.rect(500, 10, areaWidth*100, areaHeight*100);
        ctx.lineWidth = "10";
        ctx.strokeStyle = "black";
        ctx.stroke();
        var door = Door.split(',').map(function(item) {
        return parseInt(item, 10);
        });
        var window = Window.split(',').map(function(item) {
        return parseInt(item, 10);
        });
        var dx=door[1]- door[3]+10; if(dx<0){  dx=dx*-1;}
        var dy=door[2]- door[4]+10; if(dy<0){  dy=dy*-1;}
        if(dx>=dy){drawLine(ctx, door[1], door[2], door[3], door[2]); }
        else if(dx<dy){drawLine(ctx,  door[1], door[2], door[1], door[4]);}

        var dx=window[1]- window[3]+10; if(dx<0){  dx=dx*-1;}
        var dy=window[2]- window[4]+10; if(dy<0){  dy=dy*-1;}
        if(dx>=dy){drawLine(ctx, window[1], window[2], window[3], window[2]); }
        else if(dx<dy){drawLine(ctx,  window[1], window[2], window[1], window[4]);}
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
@endsection
