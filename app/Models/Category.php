<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['products'];

    protected $fillable = [
        'major_category_id',
        'name',
        'description',
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function majorCategory()
    {
        return $this->belongsTo('App\Models\MajorCategory');
    }
}
