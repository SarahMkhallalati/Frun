window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
var population = Array();
var rightIndex = localStorage.getItem('rightIndex')
var bottomIndex = localStorage.getItem('bottomIndex')
var leftIndex = localStorage.getItem('leftIndex')
var perimeter = localStorage.getItem('perimeter')
var windowPosition = localStorage.getItem('windowPosition')
var doorPosition =localStorage.getItem('doorPosition')
var WindowIndex = localStorage.getItem('WindowIndex')
var DoorIndex = localStorage.getItem('DoorIndex')



var $ = require('jquery');
function ItemPosetion($IndexStart,$IndexEnd)
{
    if(0<$IndexStart<rightIndex  && 0<$IndexEnd<rightIndex) return 0;
    if(rightIndex<$IndexStart<bottomIndex  && rightIndex<$IndexEnd<bottomIndex) return 3;
    if(bottomIndex<$IndexStart<leftIndex  && bottomIndex<$IndexEnd<leftIndex) return 1;
    if(leftIndex<$IndexStart<perimeter  && leftIndex<$IndexEnd<perimeter) return 2;
    return null;
}

function getRandomInt(max) {
    return Math.floor(Math.random() * max);
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
        IDs:selectedID,

    }
    }).done((json) => {
        var Items=json.selecetdItems;

            var $Offset = Math.random()*100;

            for(var i=0; i<Items.length; i++)
                population.push({name :Items[i].furn_name,start: 0+$Offset,end: Items[i].width+$Offset,wall: ItemPosetion(0+$Offset,Items[i].width+$Offset)});
    }).fail((json)=>{
    console.log('fail');
    });
    return population;
}

function fitnessFunction(phenotype)
{
    var score=0

    for(var i=0;i<phenotype.length;i++)
    {
        var thisItem = phenotype[i]
        var ItemName = thisItem[0].split('').map(function(item)
        {
            return parseInt(item, 10);
        });

        //If this item is a bed then it should be on the wall next to the windows wall
        if(ItemName[0]=="Bed" || ItemName[1]=="Bed")
        {
            if(windowPosition==0)
            {
                if(thisItem[3]==2 || thisItem[3]==3){score=score+1}
            }
            if(windowPosition==3)
            {
                if(thisIteme[3]==0 || thisItem[3]==1){score=score+1}
            }
            if(windowPosition==1)
            {
                if(thisItem[3]==3 || thisItem[3]==2){score=score+1}
            }
            if(windowPosition==2)
            {
                if(thisItem[3]==0 || thisItem[3]==1){score=score+1}
            }
        }


        //It the item is a closet then it should be on the same wall with the door
        if(thisItem[0]=="Closet" || thisItem[1]=="Closet")
        {
            if(doorPosition==thisItem[3])
            {
                if(thisItem[1]<DoorIndex[0] && thisItem[1]<DoorIndex[1])
                {
                    if(thisItem[1]>DoorIndex[0] && thisItem[1]>DoorIndex[1])
                    {score = score+1}
                }
            }
        }


        //If this Item don't block the door
        if(thisItem[1]<DoorIndex[0] && thisItem[1]<DoorIndex[1])
        {
            if(thisItem[1]>DoorIndex[0] && thisItem[1]>DoorIndex[1])
            {score = score+1}
        }

        //If this Item don't block the window
        if(thisItem[1]<WindowIndex[0] && thisItem[1]<WindowIndex[1])
        {
            if(thisItem[1]>WindowIndex[0] && thisItem[1]>WindowIndex[1])
            {score = score+1}
        }


        //If this Item don't block other item
        for(var j=1;j<phenotype.length;j++)
        {
            var OtherItem = phenotype[j];
            if(thisItem[1]<OtherItem[1] && thisItem[1]<OtherItem[2])
            {
                if(thisItem[1]>OtherItem[1] && thisItem[1]>OtherItem[2])
                {score = score+1}
                else break
            }
            else break
        }
    }
    return score
}

function mutationFunction(phenotype)
{
    for( var i=0; i<phenotype.length; i++)
    {
        var thisItem = population[i]
        var offset = Math.random()*100
        thisItem[1] = phenotype[1]+offset
        thisItem[2]= phenotype[2]+offset
        thisItem[3]=ItemPosetion(phenotype[1],phenotype[2])
    }

    return phenotype
}

function crossoverFunction(phenotypeA, phenotypeB)
{
    var swapItemIndex = getRandomInt(geneticalgorithm.population().length)
    var fromA = phenotypeA[swapItemIndex]
    var fromB = phenotypeB[swapItemIndex]

    phenotypeA[swapItemIndex]= fromB
    phenotypeB[swapItemIndex] = fromA

    return [phenotypeA, phenotypeB]

}
population = [{name : "black Closet" , start:614,end:674,wall:0},{name : "bambo Closet" , start:614,end:734,wall:0}];


    window.genertic = require('geneticalgorithm')
    window.geneticalgorithm = window.genertic( {
        mutationFunction: mutationFunction,
        crossoverFunction: crossoverFunction,
        fitnessFunction: fitnessFunction,
        population: setPopulation(),
        populationSize: 2
        } );
