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

function getRandomInt(max){
    return Math.floor(Math.random() * max);
}

function setPopulation()
{
    var selectedIDs = localStorage.getItem('selectedItems');
    var selectedID = selectedIDs.split(',').map(function(item)
    { return parseInt(item, 10); });

    $.ajax({
    method: 'GET',
    url: 'get_item_byID',
    dataType: 'json',
    data: {
        IDs:selectedID,
    }
    }).done((json) => {
        var Items=json.selecetdItems;
            var $Offset = getRandomInt(perimeter);
            var FirstItem = []
            var SecondItem = []
            FirstItem.push(Items[0].ID, $Offset, $Offset+Items[0].width)
            SecondItem.push(Items[0].ID, $Offset, $Offset+Items[0].width)
            return {first: FirstItem, second: SecondItem}
                // population.push({name :Items[i].furn_name,start: 0+$Offset,end: Items[i].width+$Offset,wall: ItemPosetion(0+$Offset,Items[i].width+$Offset)});
    }).fail((json)=>{
    console.log('fail');
    });

}

function fitnessFunction(phenotype)
{
        var score=0
        var first = phenotype.first
        var sec= phenotype.second

        var firstItemName = first[0].split(' ')

        var sceondItemName = sec[0].split(' ')
        var firstItemPosetion= ItemPosetion(first[1],first[1])
        var secItemPosetion= ItemPosetion(sec[1],sec[1])

        //If the first item is a bed then it should be on the wall next to the windows wall
        if(firstItemName[0]=="Bed" || firstItemName[1]=="Bed")
        {
            if(windowPosition==0)
            {
                if(firstItemPosetion==2 || firstItemPosetion==3){score=score+1}
            }
            if(windowPosition==3)
            {
                if(firstItemPosetion==0 || firstItemPosetion==1){score=score+1}
            }
            if(windowPosition==1)
            {
                if(firstItemPosetion==3 || firstItemPosetion==2){score=score+1}
            }
            if(windowPosition==2)
            {
                if(firstItemPosetion==0 || firstItemPosetion==1){score=score+1}
            }


        }
         //It the first is a closet then it should be on the same wall with the door
        if(firstItemName[0]=="Closet" || firstItemName[1]=="Closet")
        {
            if(doorPosition==firstItemPosetion)
            {score = score+1 }
        }


        //It the second is a closet then it should be on the same wall with the door
        if(sceondItemName[0]=="Closet" || sceondItemName[1]=="Closet")
        {
            if(doorPosition==ItemPosetion)
            {score = score+1}
        }
        //If this second is a bed then it should be on the wall next to the windows wall
        if(sceondItemName[0]=="Bed" || sceondItemName[1]=="Bed")
        {
            if(windowPosition==0)
            {
                if(secItemPosetion==2 || secItemPosetion==3){score=score+1}
            }
            if(windowPosition==3)
            {
                if(secItemPosetion==0 || secItemPosetion==1){score=score+1}
            }
            if(windowPosition==1)
            {
                if(secItemPosetion==3 || secItemPosetion==2){score=score+1}
            }
            if(windowPosition==2)
            {
                if(secItemPosetion==0 || secItemPosetion==1){score=score+1}
            }

        }


        //If first Item don't block the door
        if(first[1]<DoorIndex[0] && first[1]<DoorIndex[1])
        {score = score+1}
        if(first[1]>DoorIndex[0] && first[1]>DoorIndex[1])
        {score = score+1}

        //If second Item don't block the door
        if(sec[1]<DoorIndex[0] && sec[1]<DoorIndex[1])
        {score = score+1}
        if(sec[1]>DoorIndex[0] && sec[1]>DoorIndex[1])
        {score = score+1}


        //If the first Item don't block the window
        if(first[1]<WindowIndex[0] && first[1]<WindowIndex[1])
        {score = score+1}
        if(first[1]>WindowIndex[0] && first[1]>WindowIndex[1])
        {score = score+1}

        //If the second Item don't block the window
        if(sec[1]<WindowIndex[0] && sec[1]<WindowIndex[1])
        {score = score+1}
        if(sec[1]>WindowIndex[0] && sec[1]>WindowIndex[1])
        {score = score+1}


        //If this Item don't block other item
        if(first[1]<sec[1] && first[2]<sec[1])
        {score = score+1}
        if(first[1]>sec[1] && first[1]>sec[2])
        {score = score+1}



    return score
}

function mutationFunction(phenotype)
{

        var first = phenotype.first
        var sec = phenotype.second

        var offset1 = getRandomInt(perimeter)
        first[1] = first[1]+offset1
        first[2]= first[2]+offset1

        var offset2 = getRandomInt(perimeter)
        sec[1] = sec[1]+offset2
        sec[2]= sec[2]+offset2
        return phenotype
}

function crossoverFunction(phenotypeA, phenotypeB)
{
    var swapItemIndex = Math.random()


    if(swapItemIndex<=0.5)
    {var fromA = phenotypeA.first
    var fromB = phenotypeB.first
    phenotypeA.first= fromB
    phenotypeB.first = fromA}

    if(swapItemIndex>0.5)
    {var fromA = phenotypeA.second
    var fromB = phenotypeB.second
    phenotypeA.second= fromB
    phenotypeB.second = fromA}

    return [phenotypeA, phenotypeB]

}



    window.genertic = require('geneticalgorithm')
    window.geneticalgorithm= window.genertic( {
        mutationFunction: mutationFunction,
        crossoverFunction: crossoverFunction,
        fitnessFunction: fitnessFunction,
        population: [setPopulation()],
        populationSize: 30
        } );
