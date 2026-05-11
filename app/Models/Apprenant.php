<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apprenant extends Model
{
    // Les colonnes autorisées pour l'insertion/mise à jour en masse.
    protected $fillable = ['nom', 'age', 'maladie'];
}
