<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
       'name',
        'unit',
        'description',
        'image',
        'is_active',
    ];
}
