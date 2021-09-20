<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Korisnik extends Model
{
    protected $table = 'korisnik';
    public $timestamps = false;

    public function prijava()
    {
        return $this->hasOne('App\Prijava');
    }
}
