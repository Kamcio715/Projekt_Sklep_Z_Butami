<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    protected $fillable = [
        'id_klienta',
        'imie_klienta',
        'email_klienta',
        'telefon_klienta',
        'adres',
        'kwota',
        'przedmioty',
    ];
}
