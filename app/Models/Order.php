<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_intent_id',
        'user_id',
        'total_amount',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withTrashed();
    }

    public function purchaseHistory()
    {
        return $this->hasMany('App\Models\PurchaseHistory');
    }

    public function code()
    {
        return substr($this->payment_intent_id, 5);
    }
}
