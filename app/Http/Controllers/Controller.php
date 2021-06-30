<?php

namespace App\Http\Controllers;

use App\Models\Classified;
use App\Models\CustomerFurniture;
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


    public function CreatFav(Request $request)
    {
        $classified = Classified::where("fru-id",$request->get("ID"))->first();
        $customerFur = CustomerFurniture::where("cust-id",1)->where("classified-id",$classified->ID)->first();
        if(empty($customerFur))
        {CustomerFurniture::create([
            "cust-id" => 1,
            "classified-id"=> $classified->ID
        ]);
        return Response()->json(['Classified' => $classified],200);
        }
        return Response()->json(['message' => "already exist"],401);
    }


    public function getKind(Request $request)
    {
        $kind = $request->get('kind');
        $favorites = Classified::where("cls-id", $kind)
            ->join('cus_furn', 'classified.ID', '=', 'cus_furn.classified-id')
            ->get();
        $classified = Classified::where("cls-id", $kind)->get();
        $kindVar = Furniture::whereIn("ID",$favorites->pluck("fru-id"))->get();
        $kindData = Furniture::whereIn("ID",$classified ->pluck("fru-id"))->get();
        $officeID = Classified::where("cls-id", 4)->get();
        $officeData = Furniture::whereIn("ID",$officeID ->pluck("fru-id"))->get();
        return Response()->json(['kind_fav' => $kindVar,'kind_data'=>$kindData,'office_data'=>$officeData],200);
    }

    public function getByID(Request $request)
    {
        $IDs = $request->get('IDs');
        $selectedItems = Furniture::getDataByID($IDs);
        return Response()->json(['selecetdItems' => $selectedItems],200);
    }


    public function getchep (Request $request)
    {
        $cheps = Furniture::where("price", '<=' , 200) ->get();
        return view('Cheapest',['cheps' => $cheps]);

    }

}
