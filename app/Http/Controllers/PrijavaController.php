<?php

namespace App\Http\Controllers;

use App\Korisnik;
use App\Prijava;
use App\Ustanova;
use Illuminate\Http\Request;

class PrijavaController extends Controller
{
    public function get(Request $request)
    {
        if ($request->query('id_ustanova')) {
            $prijave = Ustanova::find($request->query('id_ustanova'))->prijave()->get();
        } else $prijave = Prijava::all();
        return response()->json(['prijave' => $prijave]);
    }

    public function createPrijava(Request $request)
    {
        $postojiKorisnik = Korisnik::where('jmbg', $request->jmbg)->first();
        $postojiPrijava = false;
        if ($postojiKorisnik)
            $postojiPrijava = Prijava::where('korisnik_id', $postojiKorisnik->id)->first();
        else $postojiKorisnik = (object) [
            'id' => Korisnik::insertGetId([
                'ime' => $request->ime,
                'prezime' => $request->prezime,
                'jmbg' => $request->jmbg
            ])
        ];
        $prijave = Prijava::where('ustanova_id', $request->ustanovaId)->where('vakcina_id', $request->vakcinaId)->orderBy('zakazano_u', 'ASC')->get();
        $pocetnoVreme = 1626328800;
        $slobodnoVreme = $pocetnoVreme;
        $brPrijava = count($prijave);
        foreach ($prijave as $i => $prijava) {
            if ($pocetnoVreme != $prijava->zakazano_u) {
                $slobodnoVreme = $pocetnoVreme;
                break;
            }
            $pocetnoVreme = $pocetnoVreme + 900;
            if ($i == $brPrijava - 1)
                $slobodnoVreme = $pocetnoVreme;
        }
        if ($postojiPrijava) {
            return response()->json([
                'poruka' => 'Vi ste vec prijavljeni da se vakcinisete u: ' .
                    date('d.m.Y h:i', $postojiPrijava->zakazano_u),
                'zakazano_u' => $postojiPrijava->zakazano_u,
                'prijava_id' => $postojiPrijava->id,
                'novoVremeFormat' => date('d.m.Y h:i', $slobodnoVreme),
                'novoVreme' => $slobodnoVreme,
                'postoji' => true
            ]);
        }
        $uspesnaPrijava = Prijava::insert(
            [
                'napomena' => $request->napomena && "",
                'zakazano_u' => $slobodnoVreme,
                'korisnik_id' => $postojiKorisnik->id,
                'ustanova_id' => $request->ustanovaId,
                'vakcina_id' => $request->vakcinaId
            ]
        );
        if ($uspesnaPrijava) {
            return response()->json(['poruka' => 'Prijavili ste se za vakcinaciju. Dodjite u ' . date('d.m.Y h:i', $slobodnoVreme), 'postoji' => false]);
        }
        return response()->json(['poruka' => 'Doslo je do greske..', 'postoji' => false]);
    }

    public function updatePrijava(Request $request, Prijava $prijava)
    {
        if (!$prijava) return response()->json(['poruka' => 'Doslo je do greske..'], 200);
        $prijava->zakazano_u = $request->novoVreme;
        $prijava->save();

        return response()->json(['poruka' => 'Uspesno ste promenili prijavu.' . date('d.m.Y h:i', $request->novoVreme)]);
    }

    public function delete(Prijava $prijava)
    {
        $prijava->delete();
        return response()->json(['poruka' => 'Uspesno ste obrisali prijavu.']);
    }
}
