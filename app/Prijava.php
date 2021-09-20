<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prijava extends Model
{

    protected $table = 'prijava';

    public function korisnik()
    {
        return $this->belongsTo('App\Korisnik');
    }
    public function ustanova()
    {
        return $this->belongsTo('App\Ustanova');
    }

    public function vakcina()
    {
        return $this->belongsTo('App\Vakcina');
    }
}
