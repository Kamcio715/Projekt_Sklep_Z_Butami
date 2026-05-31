<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'category',
        'type',
        'size',
        'price',
        'stock',
        'color',
        'description',
        'image',
    ];


}


