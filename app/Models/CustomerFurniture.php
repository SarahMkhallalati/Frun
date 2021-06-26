<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFurniture extends Model
{
    use HasFactory;
    protected $table = 'cus_furn';
    public $timestamps = false;
    protected $fillable = ['cust-id', 'classified-id'];
}
