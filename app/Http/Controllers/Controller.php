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
        //$classified = Classified::where("fru-id",$request->get("ID"))->first();
        $customerFur = CustomerFurniture::where("cust_id",1)
        ->where("furn_id",$request->get("ID"))
        ->first();
        if(empty($customerFur))
        {CustomerFurniture::create([
            "cust_id" => 1,
            "furn_id"=> $request->get("ID")
        ]);
        return Response()->json([],200);
        }
        return Response()->json(['message' => "already exist"],401);
    }


    public function getKind(Request $request)
    {
        $kind = $request->get('kind');
        $favorites = Classified::where("cls-id", $kind)
            ->join('cus_own', 'classified.fru-id', '=', 'cus_own.furn_id')
            ->get();
        $classified = Classified::where("cls-id", $kind)->get();
        $kindVar = Furniture::whereIn("furniture.ID",$favorites->pluck("fru-id"))
        ->join('materials','materials.id','=','furniture.material_id')
        ->select('furniture.*','materials.name as material')
        ->get();
        $kindData = Furniture::whereIn("furniture.ID",$classified ->pluck("fru-id"))
        ->join('materials','materials.id','=','furniture.material_id')
        ->select('furniture.*','materials.name as material')
        ->get();
        $officeID = Classified::where("cls-id", 4)->get();
        $officeData = Furniture::whereIn("furniture.ID",$officeID ->pluck("fru-id"))
        ->join('materials','materials.id','=','furniture.material_id')
        ->select('furniture.*','materials.name as material')
        ->get();
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
        $cheps = Furniture::where("price", '<=' , 200)
        ->join('materials','materials.id','=','furniture.material_id')
        ->select('furniture.*','materials.name as material')
        ->get();
        return view('Cheapest',['cheps' => $cheps]);

    }
    public function officRoom(Request $request)
    {
        $officRooms = Furniture::getofficRoom();

        return view('rooms',['rooms' => $officRooms , 'roomName' => 'offic Room']);
    }

    public function search(Request $request)
    {
       // return $request->all();
        $furnitures = Furniture::search($request->get('query'));
        return view('index',['furnitures' => $furnitures]);

    }

    public function filter(Request $request)
    {
       // return $request->all();
        $materialId = $request->get('material_id');
        $price = $request->get('price');
        $priceMin = 0;
        $priceMax = 0;
        if($price == 1)
        {
            $priceMin = 80;
            $priceMax = 200;
        }else if($price == 2)
        {
            $priceMin = 205;
            $priceMax = 300;
        }else if($price == 3)
        {
            $priceMin = 300;
        }
        $furnitures = Furniture::filter($materialId,$priceMin,$priceMax);
        return view('index',['furnitures' => $furnitures]);

    }

}
