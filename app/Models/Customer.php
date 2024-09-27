<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'customer';
    protected $hidden  = ['password'];

    protected $guarded = ['id'];
}
