<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = 'account_tb';
    protected $fiilable = [
        'name',
        'email',
        'role'
    ];
}
