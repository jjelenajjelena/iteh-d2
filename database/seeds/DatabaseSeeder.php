<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(KorisnikTableSeeder::class);
        $this->call(UstanovaTableSeeder::class);
        $this->call(VakcinaTableSeeder::class);
        $this->call(PrijavaTableSeeder::class);
    }
}
