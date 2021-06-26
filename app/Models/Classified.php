<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classified extends Model
{
    use HasFactory;

    protected $table = 'classified';

    public function furniture()
    {
        return $this->belongsTo(Furniture::class,'fru-id');
    }



}
