<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    protected $fillable = [
        'nazwa',
        'marka',
        'kategoria',
        'rodzaj',
        'rozmiar',
        'cena',
        'kolor',
        'opis',
        'zdjecie',
    ];
}
