<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'logo', 
        'facebook', 
        'instagram', 
        'whatsapp', 
        'phone', 
        'email', 
        'address', 
        'policy'
    ];
}
