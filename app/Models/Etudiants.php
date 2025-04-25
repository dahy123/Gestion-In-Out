<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiants extends Model
{
    use HasFactory;

    // Définir les attributs qui peuvent être remplis
    protected $fillable = ['nom','image', 'email'];
}
