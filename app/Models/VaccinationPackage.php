<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VaccinationPackage extends Model
{
    protected $fillable = ['name', 'description', 'price', 'pet_type'];
}