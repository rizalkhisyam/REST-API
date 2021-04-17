<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['username', 'email', 'password', 'last_name', 'first_name', 'address', 'city', 'province', 'country'];
    protected $dates = ['deleted_at'];
}
