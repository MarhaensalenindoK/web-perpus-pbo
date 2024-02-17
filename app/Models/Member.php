<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class & inheritance ke Model
class Member extends Model
{
    use HasFactory;
    // Encapsulasi
    protected $fillable = [
        'name', 'email', 'registration_date'
    ];
}
