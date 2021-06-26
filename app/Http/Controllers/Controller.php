<?php

namespace App\Http\Controllers;

use App\Models\Classified;
use App\Models\Fruniture;
use App\Models\Furniture;
use GrahamCampbell\ResultType\Result;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function frniture(Request $request)
    {
        $furnitures = Furniture::get();
        return view('index',['furnitures' => $furnitures]);

    }

    public function bedRooms(Request $request)
    {
        $bedRooms = Furniture::getBedRooms();

        return view('rooms',['rooms' => $bedRooms , 'roomName' => 'Bed Room']);
    }


    public function livingRoom(Request $request)
    {
        $livingRooms = Furniture::getLivingRoom();

        return view('rooms',['rooms' => $livingRooms , 'roomName' => 'Living Room']);
    }

    public function designRoom(Request $request)
    {
        $bedRooms = Furniture::getBedRooms();
        return view('design_room',['rooms' => $bedRooms]);
    }

    public function GetClassified(Request $request)
    {
        $classified = Classified::get();
        return Response()->json(['Classified' => $classified],200);

    }


    public function getKind(Request $request)
    {
        $kind = $request->get('kind');
        $kindData = Furniture::getDataByKind($kind);
        return Response()->json(['kind_data' => $kindData],200);
    }


}
