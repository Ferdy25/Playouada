<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Field yang boleh diisi lewat create/update
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];
}
