<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class Admin extends ModelAuthenticate
{
    use HasFactory;
    protected $table = 'admin';
}
