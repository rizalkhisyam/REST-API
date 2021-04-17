<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['username', 'email', 'password', 'last_name', 'first_name', 'address', 'city', 'province', 'country'];
}
