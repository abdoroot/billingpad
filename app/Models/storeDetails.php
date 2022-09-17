<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class storeDetails extends Model
{
    use HasFactory;
    protected  $table = "store_details";
    protected  $fillable = [
        'name',
        'address',
        'phone_number',
    ];
}
