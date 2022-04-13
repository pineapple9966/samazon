<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'score',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scoreStar()
    {
        return str_repeat('★', $this->score);
    }
}
