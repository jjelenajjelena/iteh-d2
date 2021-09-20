<?php

use App\Korisnik;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KorisnikTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 200; $i++) {
            Korisnik::insert([
                'ime' => Str::random(5),
                'prezime' => Str::random(7),
                'jmbg' => $this->generisiJmbg()
            ]);
        }
    }

    public function generisiJmbg(){
        $jmbg = '';
        for ($i=0; $i < 13; $i++) {
            $jmbg .= rand(0,9);
        }
        return $jmbg;
    }
}
