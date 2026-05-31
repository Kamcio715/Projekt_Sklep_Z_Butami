<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Review extends Model
{
    protected $fillable = [
        'shoe_id',
        'user_id',
        'rating',
        'content',
    ];

    public function shoe()
{
    return $this->belongsTo(Shoe::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
