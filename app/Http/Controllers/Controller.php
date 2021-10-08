<?php

namespace App\Http\Controllers;

use App\Models\Classified;
use App\Models\CustomerFurniture;
use App\Models\Furniture;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function frniture(Request $request)
    {
        $furnitures = Furniture::get();
        if(Auth::guard('web')->check())
        $faveorite = CustomerFurniture::
        getCustomerFaveorite(Auth::guard('web')->user()->ID);
        else $faveorite = collect();
        return view('index', ['furnitures' => $furnitures,
        'favorite' => $faveorite ]);

    }

    public function faveorite(Request $request)
    {
        $faveorite = CustomerFurniture::get();
        return view('index',['faveorite' => $faveorite]);

    }

    public function bedRooms(Request $request)
    {
        $bedRooms = Furniture::getBedRooms();

        return view('rooms', ['rooms' => $bedRooms, 'roomName' => 'Bed Room']);
    }

    public function livingRoom(Request $request)
    {
        $livingRooms = Furniture::getLivingRoom();

        return view('rooms', ['rooms' => $livingRooms, 'roomName' => 'Living Room']);
    }

    public function designRoom(Request $request)
    {
        $bedRooms = Furniture::getBedRooms();
        return view('design_room', ['rooms' => $bedRooms]);
    }

    public function CreatFav(Request $request)
    {
        //$classified = Classified::where("fru-id",$request->get("ID"))->first();
        $customerFur = CustomerFurniture::where("cust_id", auth()->user()->ID)
            ->where("furn_id", $request->get("ID"))
            ->first();
        if (empty($customerFur)) {CustomerFurniture::create([
            "cust_id" => auth()->user()->ID,
            "furn_id" => $request->get("ID"),
        ]);
            return Response()->json([], 200);
        }
        return Response()->json(['message' => "already exist"], 401);
    }

    public function favList(Request $request)
    {
        //$classified = Classified::where("fru-id",$request->get("ID"))->first();
        $favlist = CustomerFurniture::where("cust_id",auth()->user()->ID)
        ->get("ID");

        return Response()->json(['fav_ID' => $favlist],200);


    }


    public function getKind(Request $request)
    {
        $kind = $request->get('kind');
        $favorites = Classified::where("cls-id", $kind)
            ->join('cus_own', 'classified.fru-id', '=', 'cus_own.furn_id')
            ->get();
        $classified = Classified::where("cls-id", $kind)->get();
        $kindVar = Furniture::whereIn("furniture.ID", $favorites->pluck("fru-id"))
            ->join('materials', 'materials.id', '=', 'furniture.material_id')
            ->select('furniture.*', 'materials.name as material')
            ->get();
        $kindData = Furniture::whereIn("furniture.ID", $classified->pluck("fru-id"))
            ->join('materials', 'materials.id', '=', 'furniture.material_id')
            ->select('furniture.*', 'materials.name as material')
            ->get();
        $officeID = Classified::where("cls-id", 4)->get();
        $officeData = Furniture::whereIn("furniture.ID", $officeID->pluck("fru-id"))
            ->join('materials', 'materials.id', '=', 'furniture.material_id')
            ->select('furniture.*', 'materials.name as material')
            ->get();
        return Response()->json(['kind_fav' => $kindVar, 'kind_data' => $kindData, 'office_data' => $officeData], 200);
    }

    public function getByID(Request $request)
    {
        $IDs = $request->get('IDs');
        $selectedItems = Furniture::getDataByID($IDs);
        return Response()->json(['selecetdItems' => $selectedItems], 200);
    }

    public function getchep(Request $request)
    {
        $cheps = Furniture::where("price", '<=', 200)
            ->join('materials', 'materials.id', '=', 'furniture.material_id')
            ->select('furniture.*', 'materials.name as material')
            ->get();
        return view('Cheapest', ['cheps' => $cheps]);

    }
    public function officRoom(Request $request)
    {
        $officRooms = Furniture::getofficRoom();

        return view('rooms', ['rooms' => $officRooms, 'roomName' => 'offic Room']);
    }

    public function search(Request $request)
    {
        // return $request->all();
        $furnitures = Furniture::search($request->get('query'));
        return view('index', ['furnitures' => $furnitures]);

    }

    public function filter(Request $request)
    {
        $materialId = $request->get('material_id');
        $price = $request->get('price');
        $priceMin = 0;
        $priceMax = 0;
        if ($price == 1) {
            $priceMin = 80;
            $priceMax = 200;
        } else if ($price == 2) {
            $priceMin = 205;
            $priceMax = 300;
        } else if ($price == 3) {
            $priceMin = 300;
        }
        $furnitures = Furniture::filter($materialId, $priceMin, $priceMax);
        return view('index', ['furnitures' => $furnitures]);

    }

    public function deleteFavorite(Request $request)
    {
        $customerFurniture = CustomerFurniture::where('cust_id',auth()->user()->ID)
                            ->where('furn_id',$request->get('ID'))
                            ->firstOrFail();
        $customerFurniture->delete();
        return response()->json(['messsage' => 'deletd'],200);
    }


    public function register(Request $request)
    {
        return $request->all();
        $validtor = Validator::make($request->all(),
        [
            'username' => ['required','unique:customers,user-name'],
            'password' => ['required','max:20'],
            'confirm_password' => ['required','same:password']
        ]);
        if($validtor->fails())
        return back()->withErrors($validtor->getMessageBag());
        User::create(
            [
                'user-name' => $request->get('username'),
                'password' => Hash::make($request->get('password')),
            ]
            );
        return redirect('/login');
    }

    public function login(Request $request)
    {
        $validtor = Validator::make($request->all(),
        [
            'user-name' => ['required'],
            'password' => ['required','max:20'],
        ]);

        if($validtor->fails())
        return back()->withErrors($validtor);
        if(Auth::attempt([
            'user-name' => $request->get('user-name'),
            'password' => $request->get('password'),
        ],1))
        {
            return redirect('/');
        }
        return back()->withErrors(['errors'=>'wrong username or password']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

}
