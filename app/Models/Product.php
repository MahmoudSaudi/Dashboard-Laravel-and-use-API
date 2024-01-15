<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable= [
        'name_en',
        'name_ar',
        'details_en',
        'details_ar',
        'price',
        'quantity',
        'status',
        'brand_id',
        'subcategory_id',
        'photo'
    ];

}
