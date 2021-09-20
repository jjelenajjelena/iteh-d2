<?php

namespace App\Http\Controllers;

use App\Prijava;
use App\Ustanova;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function prijave()
    {
        $prijaveBelekspo = Prijava::with('korisnik')
            ->with('vakcina')
            ->whereHas('ustanova', function ($query) {
                $query->where('naziv_ustanova', 'Belekspo centar');
            })
            ->orderBy('zakazano_u')
            ->get();
        $prijaveBogojevic = Prijava::with('korisnik')
            ->with('vakcina')
            ->whereHas('ustanova', function ($query) {
                $query->where('naziv_ustanova', 'Hala "Gordana Goca Bogojevic"');
            })
            ->orderBy('zakazano_u')
            ->get();
        $prijaveSajam = Prijava::with('korisnik')
            ->with('vakcina')
            ->whereHas('ustanova', function ($query) {
                $query->where('naziv_ustanova', 'Hala Sajam');
            })
            ->orderBy('zakazano_u')
            ->get();


        return view('page.prijave', [
            'prijaveBelekspo' => $prijaveBelekspo,
            'prijaveBogojevic' => $prijaveBogojevic,
            'prijaveSajam' => $prijaveSajam
        ]);
    }

    public function pocetna()
    {
        return view('page.pocetna');
    }
}
