<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $table = 'customer';

    protected $primaryKey = 'customerID';
 
    protected $fillable = [
        'name', 'email', 'contact', 'password', 'gender', 'houseNo', 'streetName', 'city', 'postalCode', 'image',
    ];

    // Define the attributes that should be hidden for arrays
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Define the attributes that should be cast to native types
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

