<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    protected $fillable = ['nom','sexe','largeurImpression','hauteurImpression','origineX','origineY'];
}
