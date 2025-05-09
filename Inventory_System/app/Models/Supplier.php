<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    use HasFactory;
    protected $fillable = [
        'supplier_name',
        'supplier_address',
        'supplier_email',
        'supplier_number',
        'contact_person',
        'supplier_website',
        'tin',
    ];
}
