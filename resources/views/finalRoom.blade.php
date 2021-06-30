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

        <button onclick="getItems();"> test </button>
    </body>
  @include("footer");
@endsection

@section('scripts')
<script src="{{asset ('/js/app.js')}}"></script>
<script type="text/javascript">
    var areaWidth = localStorage.getItem('areaWidth')*100;
    var areaHeight = localStorage.getItem('areaHeight')*100;
    var Door = localStorage.getItem('door');
    var Window = localStorage.getItem('window');
    var theRoom = document.getElementById("theRoom");
    var selectedIDs = localStorage.getItem('selectedItems');
    var roomKind = localStorage.getItem('roomKind');
    var topWall,bottomWall,leftWall,rightWall;
    var DoorDistance, WindowDistance;
    var doorPosition, windowPosition;
    var selectedItems=[];
    var windowStartIn, windowEndIn;
    var doosStartIn, doorEndIn;
    var roomArray=[];
    var c,ctx;



    var population =[];


    function ItemsPresentation(selectedIDs,$Offset)
        {

                for(var i=0; i<Items.length; i++)
                {
                    var ItemIndexRow = ["Item Id", Items[i].ID, "ItemSatartIndex",0+$Offset,"ItemEndIndex",Items[i].width+$Offset];
                    ItemIdnex.push(ItemIndexRow);
                }
                return ItemIdnex
        }
    function DRfunction()
    {
        theRoom.innerHTML= '<canvas id="myCanvas" width="1520" height="'+(areaHeight+50)+'" ></canvas>';
        c=document.getElementById("myCanvas");
        ctx=c.getContext("2d");
        ctx.rect(500, 10, areaWidth, areaHeight);

        topWall = [500,10,500+(areaWidth),10];
        bottomWall = [500, 10+(areaHeight),500+(areaWidth),10+(areaHeight)];
        leftWall = [500,10,500, 10+(areaHeight)];
        rightWall = [500+(areaWidth),10,500+(areaWidth),10+(areaHeight)];


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

                if(door[1]<door[3]) {DoorDistance = door[1]-500;}
                else {DoorDistance = door[3]-500;}

            }
            else if(dx<dy)
            {
                drawLine(ctx,  door[1], door[2], door[1], door[4]);
                if(leftWall[0]+5<door[0]<leftWall[0]-5){doorPosition=2;}
                else doorPosition=3;

                if(door[2]<door[3]) {DoorDistance = door[2]-10;}
                else {DoorDistance = door[3]-10;}
            }
            localStorage.setItem('doorPosition',doorPosition)

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

                if(window[1]<window[3]) {WindowDistance = window[1]-500;}
                else {WindowDistance = window[3]-500;}
            }
            else if(dx<dy)
            {
                drawLine(ctx,  window[1], window[2], window[1], window[4]);
                if(leftWall[0]+5<window[0]<leftWall[0]-5){windowPosition=2;}
                else windowPosition=3;

                if(window[2]<window[3]) {WindowDistance = window[2]-10;}
                else {WindowDistance = window[3]-10;}

            }

            localStorage.setItem('windowPosition',windowPosition)
        }


        var perimeter = areaHeight*2 + areaWidth*2;
        localStorage.setItem('perimeter',perimeter)
        for(var i=0 ; i<perimeter ; i++)
        {
            roomArray.push(i);
        }

        rightIndex = areaWidth;
        bottomIndex = rightIndex+areaHeight;
        leftIndex = bottomIndex+areaWidth;

        localStorage.setItem('rightIndex',rightIndex)
        localStorage.setItem('bottomIndex',bottomIndex)
        localStorage.setItem('leftIndex',leftIndex)

        if(doorPosition==0)
        {
            doosStartIn = DoorDistance;
            doorEndIn = doosStartIn+door[0];
        }
        if(doorPosition==1)
        {
            doosStartIn = bottomIndex+(areaWidth-(DoorDistance+door[0]));
            doorEndIn = doosStartIn+door[0];
        }
        if(doorPosition==2)
        {
            doosStartIn = leftIndex+(areaHeight-(DoorDistance+door[0]));
            doorEndIn = doosStartIn+door[0];
        }
        if(doorPosition==3)
        {
            doosStartIn = rightIndex+DoorDistance;
            doorEndIn = doosStartIn+door[0];
        }

        var DoorIndex =[doosStartIn,doorEndIn]
        localStorage.setItem('DoorIndex',DoorIndex)

        if(windowPosition==0)
        {
            windowStartIn = WindowDistance;
            windowEndIn = windowStartIn+window[0];
        }
        if(windowPosition==1)
        {
            windowStartIn = bottomIndex+(areaWidth-(WindowDistance+window[0]));
            windowEndIn = windowStartIn+window[0];
        }
        if(windowPosition==2)
        {
            windowStartIn = leftIndex+(areaHeight-(WindowDistance+window[0]));
            windowEndIn = windowStartIn+window[0];
        }
        if(windowPosition==3)
        {
            windowStartIn = rightIndex+WindowDistance;
            windowEndIn = windowStartIn+window[0];
        }
        var WindowIndex =[windowStartIn,windowEndIn]
        localStorage.setItem('WindowIndex',WindowIndex)


        var selectedID = selectedIDs.split(',').map(function(item)
        {
            return parseInt(item, 10);
        });

        $.ajax({
        method: 'GET',
        url: 'get_item_byID',
        dataType: 'json',
        data: {
            IDs:selectedID
        }
        }).done((json) => {
            var Items=json.selecetdItems;
            console.log(Items)

        }).fail((json)=>{
            console.log('fail');
        });

        var populatio = setPopulation()
        console.log(populatio)

        console.log(geneticalgorithm.population());
        console.log(geneticalgorithm.evolve().evolve().best());

        // console.log(rightIndex,bottomIndex ,leftIndex)
        // console.log(doosStartIn, doorEndIn )
        // console.log(windowStartIn, windowEndIn)

        // geneticalgorithm.evolve()
        // var final= geneticalgorithm.best()

        // // console.log(final)

        // var phenotypeList = geneticalgorithm.population()

        // console.log(phenotypeList)

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

    function setPopulation()
 {
    var selectedIDs = localStorage.getItem('selectedItems');
    var selectedID = selectedIDs.split(',').map(function(item)
     {
    return parseInt(item, 10);
    });

    $.ajax({
    method: 'GET',
    url: 'get_item_byID',
    dataType: 'json',
    data: {
        IDs:selectedID
    }
    }).done((json) => {
        var Items=json.selecetdItems;
        for(var i=0;i<5;i++)
        {
            var $Offset = Math.random()*100;
            var ItemsHere=[]
            for(var i=0; i<Items.length; i++)
            {
                var ItemInfo = [ Items[i].furn_name, 0+$Offset, Items[i].width+$Offset, ItemPosetion($(0+$Offset,Items[i]),$(Items[i].width+$Offset))];
                ItemsHere.push(ItemInfo);
            }

            population.push(ItemsHere);
        }

        return population;
    }).fail((json)=>{
    console.log('fail');
    });
 }

 function ItemPosetion($IndexStart,$IndexEnd)
{
    if(0<$IndexStart<rightIndex  && 0<$IndexEnd<rightIndex) return 0;
    if(rightIndex<$IndexStart<bottomIndex  && rightIndex<$IndexEnd<bottomIndex) return 3;
    if(bottomIndex<$IndexStart<leftIndex  && bottomIndex<$IndexEnd<leftIndex) return 1;
    if(leftIndex<$IndexStart<perimeter  && leftIndex<$IndexEnd<perimeter) return 2;
    return null;
}



</script>
@endsection
