<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shoe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'brand',
        'category',
        'type',
        'size',
        'color',
        'image',
    ];
}