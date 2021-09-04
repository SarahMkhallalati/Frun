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
    var rightIndex,bottomIndex,leftIndex
    var topWall,bottomWall,leftWall,rightWall;
    var DoorDistance, WindowDistance;
    var doorPosition, windowPosition;
    var selectedItems=[];
    var windowStartIn, windowEndIn;
    var doosStartIn, doorEndIn;
    var roomArray=[];
    var perimeter
    var c,ctx;
    var DoorIndex,WindowIndex
    var FirstItem = []
    var SecondItem = []
    var population
    var allItems=[]
    var stringPop='{'
    var selectedID


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


        perimeter = areaHeight*2 + areaWidth*2;
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

        DoorIndex =[doosStartIn,doorEndIn]
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
        WindowIndex =[windowStartIn,windowEndIn]
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

        }).fail((json)=>{
            console.log('fail');
        });


    }


function getItems()
{
    setPopulation()
    var anotherGA = geneticalgorithm.clone({
        mutationFunction: mutationFunction,
        crossoverFunction: crossoverFunction,
        fitnessFunction: fitnessFunction,
        population: [population],
        populationSize: 10
    })
    console.log("population")
    console.log( anotherGA.population())
    for(var i=0; i<10; i++)
    {
        anotherGA.evolve()
        // console.log(anotherGA.population())
    }
    // var i=0
    // while(anotherGA.bestScore()<0 )
    // {

    //     anotherGA.evolve()
    // }
    console.log("best")
    var x = anotherGA.best()
    console.log(x)
    console.log("best Score")
    console.log( anotherGA.bestScore())

}

function setPopulation()
{
    var haveKomode =false
    var selectedIDs = localStorage.getItem('selectedItems');
    selectedID = selectedIDs.split(',').map(function(item)
    { return parseInt(item, 10); });

    $.ajax({
    method: 'GET',
    url: 'get_item_byID',
    dataType: 'json',
    async:false,
    data: {
        IDs:selectedID,
    }
    }).done((json) => {
        var Items=json.selecetdItems;
        for(var i=0;i<Items.length;i++)
        {
            var Offset = getRandomInt(perimeter);
            var y= mod(Offset+Items[i].width,perimeter)
            allItems[i]= [Items[i].furn_name, Offset, y, null ,Items[i].depth]
            stringPop+='"ItemNumber'+i+'":'+i+','
            // solveDeadSulutions(allItems[i],allItems)
        }

        for(var i=1;i<Items.length;i++)
        {
            var Offset = getRandomInt(perimeter);
            var KommodeName = Items[i].furn_name.split(' ')
            if(KommodeName[0]=="Kommode" || KommodeName[1]=="Kommode")
            {
                haveKomode = true
                var j= allItems.length
                var Offset = getRandomInt(perimeter);
                var y= mod(Offset+Items[i].width,perimeter)
                allItems[j]= [Items[i].furn_name, Offset, y, null ,Items[i].depth]
                stringPop+='"ItemNumber'+j+'":'+j+'}'
                // solveDeadSulutions(allItems[i],allItems)
            }
        }

        if(haveKomode == false)
        {
            stringPop = stringPop.slice(0,-1)
            stringPop+='}'
        }
        console.log(stringPop[stringPop.length-1])
        population = JSON.parse(stringPop)

        for (key in population)
        {
            if (population.hasOwnProperty(key))
            {
                population[key] = allItems[population[key]]
                var Item = population[key]

                // if the Item is on any corner then the depth must be consedered
                var depth = Item[4]

                if(Item[2]==0 || Item[2]==roomArray.length)
                {Item[3]=depth}
                if(Item[2]==rightIndex)
                {Item[3]=depth+rightIndex}
                if(Item[2]==bottomIndex)
                {Item[3]=depth+bottomIndex}
                if(Item[2]==leftIndex)
                {Item[3]=depth+leftIndex}

                if(Item[1]==0 || Item[1]==roomArray.length)
                {Item[3]=roomArray.length-depth }
                if(Item[1]==rightIndex)
                {Item[3]=rightIndex-depth}
                if(Item[1]==bottomIndex)
                {Item[3]=bottomIndex-depth}
                if(Item[1]==leftIndex)
                {Item[3]=leftIndex-depth}
            }
        }

    }).fail((json)=>{
    console.log('fail');
    });
}

function fitnessFunction(phenotype)
{
    var score=0
    var BedPose

    for (key in phenotype)
    {
        if (phenotype.hasOwnProperty(key))
        {
            var Item = phenotype[key]
            var ItemName = Item[0].split(' ')
            var Posetion = getPosetion(Item[1],Item[2])
            var BedStartIdx, BedEndIdx

            if(Posetion == null)
            {
                return -1000000000
            }

            //If the item is a bed then it should be on the wall next to the windows wall
            if(ItemName[0]=="Bed" || ItemName[1]=="Bed")
            {
                BedPose = Posetion
                if(windowPosition==0)
                {
                    if(Posetion==2 || Posetion==3){score+=1}
                }
                if(windowPosition==3)
                {
                    if(Posetion==0 || Posetion==1){score+=1}
                }
                if(windowPosition==1)
                {
                    if(Posetion==3 || Posetion==2){score+=1}
                }
                if(windowPosition==2)
                {
                    if(Posetion==0 || Posetion==1){score+=1}
                }
            }

            //It the item is a closet then it should be on the same wall with the door
            if(ItemName[0]=="Closet" || ItemName[1]=="Closet")
            {
                if(doorPosition==Posetion)
                {score+=1 }
            }

            //If the item is a Kommode then it should be side by side with the bed
            if(ItemName[0]=="Kommode" || ItemName[1]=="Kommode")
            {
                if(Posetion==BedPose){score= score+1}
                if(Item[2]== BedEndIdx+10 || Item[1]==BedStartIdx+10)
                {score+=1}
            }


            //check if this Item block another
            for (key in phenotype)
            {
                var otherItem = phenotype[key]
                if(Item==otherItem){break}
                else
                {
                    if(Item[3]!=null)
                    {
                        if(Item[3]>Item[2])
                        {
                            if(otherItem[1]>Item[1] && otherItem[1]<Item[3] || otherItem[2]>Item[1]  && otherItem[2]<Item[3] || otherItem[3]>Item[1] && otherItem[3]<Item[3])
                            {
                                return -1000000000
                            }
                            else
                            {
                                score+=1
                            }
                        }

                        if(Item[3]<Item[1])
                        {
                            if(otherItem[1]>Item[3] && otherItem[1]<Item[2] || otherItem[2]>Item[3]  && otherItem[2]<Item[2] || otherItem[3]>Item[3] && otherItem[3]<Item[2])
                            {
                                return -1000000000
                            }
                            else
                            {
                                score+=1
                            }
                        }

                        if(Item[1] == otherItem[1] || Item[2] == otherItem[2] || Item[3] == otherItem[3] )
                        {
                            return -1000000000
                        }
                        else
                        {
                            score+=1
                        }
                    }
                }
            }

            // //check if the item is on any corner
            // if(Item[1]<rightIndex && Item[2]>rightIndex || Item[1]<bottomIndex && Item[2]>bottomIndex || Item[1]<leftIndex && Item[2]>leftIndex || Item[1]>Item[2])
            // {
            //     return -1000000000
            // }
            // else
            // {
            //     score+=1
            // }

            //If  Item don't block the door
            if(DoorIndex[0]<Item[1] && DoorIndex[0]<Item[2])
            {
                if(DoorIndex[1]<Item[1] && DoorIndex[1]<Item[2] )
                {
                    score+=1
                }
                else
                {
                    return -1000000000
                }
            }
            else
            {
                if(DoorIndex[0]>Item[1] && DoorIndex[0]>Item[2] )
                {
                    if(DoorIndex[1]>Item[1] && DoorIndex[1]>Item[2])
                    {
                        score+=1
                    }
                    else
                    {
                        return -1000000000
                    }
                }
                else
                {
                    return -1000000000
                }
            }


            //If the Item don't block the window
            if(WindowIndex[0]<Item[1] && WindowIndex[0]<Item[2])
            {
                if(WindowIndex[1]<Item[1] && WindowIndex[1]<Item[2] )
                {
                    score+=1
                }
                else
                {
                    return -1000000000
                }
            }
            else
            {
                if(WindowIndex[0]>Item[1] && WindowIndex[0]>Item[2])
                {
                    if(WindowIndex[1]>Item[1] && WindowIndex[1]>Item[2])
                    {
                        score+=1
                    }
                    else
                    {
                        return -1000000000
                    }
                }
                else
                {

                    return -1000000000
                }
            }

        }


    }

    return score
}

function mutationFunction(phenotype)
{

    var allItems =[]
    for (key in phenotype)
    { if(phenotype.hasOwnProperty(key)) { allItems.push(phenotype[key]) } }

    for (key in phenotype)
    {
        if (phenotype.hasOwnProperty(key))
        {
            var Item = phenotype[key]
            moveItem(Item)
            // solveDeadSulutions(Item, allItems)

            // if the Item is on any corner then the depth must be consedered
            var depth = Item[4]

            if(Item[2]==0 || Item[2]==roomArray.length)
            {Item[3]=depth}
            else if(Item[2]==rightIndex)
            {Item[3]=depth+rightIndex}
            else if(Item[2]==bottomIndex)
            {Item[3]=depth+bottomIndex}
            else if(Item[2]==leftIndex)
            {Item[3]=depth+leftIndex}

            else if(Item[1]==0 || Item[1]==roomArray.length)
            {Item[3]=roomArray.length-depth }
            else if(Item[1]==rightIndex)
            {Item[3]=rightIndex-depth}
            else if(Item[1]==bottomIndex)
            {Item[3]=bottomIndex-depth}
            else if(Item[1]==leftIndex)
            {Item[3]=leftIndex-depth}
            else {Item[3]=null}
        }
    }

    return phenotype
}

function crossoverFunction(phenotypeA, phenotypeB)
{
    var swapIndex = getRandomInt(selectedID.length)
    var swapkey
    var keyArr =[]
    for(key in phenotypeA)
    {
        keyArr.push(key)
    }

    for(var i =0;i<keyArr.length;i++)
    {
        if(i==swapIndex)
        {
            swapkey=keyArr[i]
            break
        }
    }
    var fromA, fromB
    fromA = phenotypeA[swapkey]
    fromB = phenotypeB[swapkey]
    phenotypeA[swapkey]= fromB
    phenotypeB[swapkey] = fromA
    return [phenotypeA, phenotypeB]
}

function getRandomInt(max)
{
    return Math.floor(Math.random() * max);
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

 function getPosetion($IndexStart,$IndexEnd)
{

    if($IndexStart<rightIndex && $IndexStart<0  && $IndexEnd<rightIndex && $IndexStart<0  ) return 0;
    if($IndexStart<bottomIndex && rightIndex<$IndexStart && $IndexEnd<bottomIndex && rightIndex<$IndexEnd) return 3;
    if($IndexStart<leftIndex && bottomIndex<$IndexStart && $IndexEnd<leftIndex && bottomIndex<$IndexEnd) return 1;
    if($IndexStart<perimeter && leftIndex<$IndexStart && $IndexEnd<perimeter && leftIndex<$IndexEnd) return 2;
    return null;
}

function moveItem(Item)
{

        var offset = getRandomInt(perimeter)


        Item[1] = Item[1]+offset
        if(Item[1]>roomArray.length)
        {Item[1]=mod(Item[1],roomArray.length)}

        Item[2]= Item[2]+offset
        if(Item[2]>roomArray.length)
        {Item[2]=mod(Item[2],roomArray.length)}

}

function mod(x,y)
{
    var z=x-y
    if(z>0)
    {
        while(z>y)
        {
            z=z-y
        }
    return z
    }
    else return x
}

function drawingDesign(phenotype)
{
    for (key in phenotype)
    {
        if (phenotype.hasOwnProperty(key))
        {
            var Item = phenotype[key]
            var wall = whichWall(Item)
            console.log(wall)
            if(wall == 0)
            {
                ctx.rect(500+Item[1],10,500+Item[1]+Item[2],10+Item[4])
                ctx.lineWidth = "10";
                ctx.strokeStyle = "black";
                ctx.stroke();
            }

            if(wall == 2)
            {
                ctx.rect(areaWidth-Item[4],10+Item[1],areaWidth,10+Item[2])
                ctx.lineWidth = "10";
            ctx.strokeStyle = "blue";
            ctx.stroke();
            }

            if(wall == 1)
            {
                ctx.rect(areaWidth-Item[2],areaHeight-Item[4],areaWidth-Item[1],areaHeight)
                ctx.lineWidth = "10";
                ctx.strokeStyle = "green";
                ctx.stroke();
            }

            if(wall == 3)
            {
                ctx.rect(500,10+Item[1],500+Item[4],10+Item[2])
                ctx.lineWidth = "10";
                ctx.strokeStyle = "gray";
                ctx.stroke();
            }

        }


    }
}

function whichWall(Item)
{
    if(Item[1]>0 && Item[1]<areaWidth)
    return 0
    else if(Item[1]>=areaWidth && Item[1]<=(areaWidth+areaHeight))
    return 2
    else if(Item[1]>=(areaWidth+areaHeight) && Item[1]<=(2*areaWidth+areaHeight))
    return 1
    else if(Item[1]>=(2*areaWidth+areaHeight) && Item[1]<=(2*areaWidth+2*areaHeight))
    return 3
}


</script>
@endsection
