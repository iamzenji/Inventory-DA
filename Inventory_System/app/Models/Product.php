<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    use HasFactory;
    protected $fillable = [
        'product_type',
        'product_number',
        'serial_number',
        'brand',
        'date_acquired',
        'price',
        'office_location',
        'issued_to',
        'end_user',
    ];
}
