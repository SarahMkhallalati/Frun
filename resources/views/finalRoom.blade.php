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
    var InCartArr = localStorage.getItem('InCartArr');
    var roomKind = localStorage.getItem('roomKind');
    var topWall,bottomWall,leftWall,rightWall;
    var doorPosition, windowPosition;
    var c,ctx;

    function DRfunction()
    {
        theRoom.innerHTML= '<canvas id="myCanvas" width="1520" height="'+areaHeight*110+'" ></canvas>';
        c=document.getElementById("myCanvas");
        ctx=c.getContext("2d");
        ctx.rect(500, 10, areaWidth*100, areaHeight*100);

        topWall = [500,10,500+(areaWidth*100),10];
        bottomWall = [500, 10+(areaHeight*100),500+(areaWidth*100),10+(areaHeight*100)];
        leftWall = [500,10,500, 10+(areaHeight*100)];
        rightWall = [500+(areaWidth*100),10,500+(areaWidth*100),10+(areaHeight*100)];

        // drawLine(ctx,topWall[0],topWall[1],topWall[2],topWall[3]);
        // drawLine(ctx,bottomWall[0],bottomWall[1],bottomWall[2],bottomWall[3]);
        // drawLine(ctx,leftWall[0],leftWall[1],leftWall[2],leftWall[3]);
        // drawLine(ctx,rightWall[0],rightWall[1],rightWall[2],rightWall[3]);

        ctx.lineWidth = "10";
        ctx.strokeStyle = "black";
        ctx.stroke();


        if(Door!=null)
        {
            var door = Door.split(',').map(function(item) {
            return parseInt(item, 10);
            });
            var dx=door[1]- door[3]+10; if(dx<0){  dx=dx*-1;}
            var dy=door[2]- door[4]+10; if(dy<0){  dy=dy*-1;}
            if(dx>=dy)
            {
                drawLine(ctx, door[1], door[2], door[3], door[2]);
                if(topWall[1]+5<door[1]<topWall[1]-5){doorPosition=0;}
                else doorPosition=1;
            }
            else if(dx<dy)
            {
                drawLine(ctx,  door[1], door[2], door[1], door[4]);
                if(leftWall[0]+5<door[0]<leftWall[0]-5){doorPosition=2;}
                else doorPosition=3;
            }
        }


        if(Window!=null)
        {
            var window = Window.split(',').map(function(item) {
                return parseInt(item, 10);
            });
            var dx=window[1]- window[3]+10; if(dx<0){  dx=dx*-1;}
            var dy=window[2]- window[4]+10; if(dy<0){  dy=dy*-1;}
            if(dx>=dy)
            {
                drawLine(ctx, window[1], window[2], window[3], window[2]);
                if(topWall[1]+5<window[1]<topWall[1]-5){windowPosition=0;}
                else windowPosition=1;
            }
            else if(dx<dy)
            {
                drawLine(ctx,  window[1], window[2], window[1], window[4]);
                if(leftWall[0]+5<window[0]<leftWall[0]-5){windowPosition=2;}
                else windowPosition=3;
            }
        }
        console.log(doorPosition);
        console.log(1);
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
