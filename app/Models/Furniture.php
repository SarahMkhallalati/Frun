<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    use HasFactory;

    protected $table = 'furniture';

    public function classified()
    {
        return $this->hasMany(Classified::class, 'fru-id');
    }

    public static function getBedRooms()
    {
        return Furniture::
            whereHas('classified', function ($classifiy) {
            $classifiy->where('cls-id', 1);
        })
            ->join('materials', 'materials.id', '=', 'furniture.material_id')
            ->select('furniture.*', 'materials.name as material')
            ->get();
    }

    public static function getLivingRoom()
    {
        return Furniture::whereHas('classified', function ($classifiy) {
            $classifiy->where('cls-id', 2);
        })
            ->join('materials', 'materials.id', '=', 'furniture.material_id')
            ->select('furniture.*', 'materials.name as material')
            ->get();
    }

    public static function getDataByKind($kind)
    {
        return Furniture::whereHas('classified', function ($classifiy) use ($kind) {
            $classifiy->where('cls-id', $kind);
        })
            ->join('materials', 'materials.id', '=', 'furniture.material_id')
            ->select('furniture.*', 'materials.name as material')
            ->get();
    }

    public static function getDataByID($IDs)
    {

        return Furniture::whereIn('ID', $IDs)
            ->join('materials', 'materials.id', '=', 'furniture.material_id')
            ->select('furniture.*', 'materials.name as material')
            ->get();
    }
    public static function getofficRoom()
    {
        return Furniture::whereHas('classified', function ($classifiy) {
            $classifiy->where('cls-id', 4);
        })
            ->join('materials', 'materials.id', '=', 'furniture.material_id')
            ->select('furniture.*', 'materials.name as material')
            ->get();
    }

    public static function search($query)
    {
        return Furniture::where('furn_name', 'like', "%$query%")
            ->join('materials', 'materials.id', '=', 'furniture.material_id')
            ->select('furniture.*', 'materials.name as material')
            ->get();
    }

    public static function filter($materialId, $priceMin,$priceMax)
    {
        return Furniture::when($materialId, function ($furnatiure) use ($materialId) {
            $furnatiure->where('material_id', $materialId);
        })->when($priceMin, function ($furnatiure) use ($priceMin) {
            $furnatiure->where('price','>=', $priceMin);
        })->when($materialId, function ($furnatiure) use ($priceMax) {
            $furnatiure->where('price','<=', $priceMax);
        })
            ->join('materials', 'materials.id', '=', 'furniture.material_id')
            ->select('furniture.*', 'materials.name as material')
            ->get();
    }

}
