<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    use HasFactory;

    protected $table = 'furniture';

    public  function classified()
    {
        return $this->hasMany(Classified::class,'fru-id');
    }

    public static function getBedRooms()
    {
        return Furniture::whereHas('classified', function($classifiy)
        {
            $classifiy->where('cls-id',1);
        })->get();
    }

    public static function getLivingRoom()
    {
        return Furniture::whereHas('classified', function($classifiy)
        {
            $classifiy->where('cls-id',2);
        })->get();
    }

    public static function getDataByKind($kind)
    {
        return Furniture::whereHas('classified', function($classifiy) use ($kind)
        {
            $classifiy->where('cls-id',$kind);
        })->get();
    }

    public static function getDataByID($IDs)
    {

        return Furniture::whereIn('ID', $IDs)->get();
    }

    
}
