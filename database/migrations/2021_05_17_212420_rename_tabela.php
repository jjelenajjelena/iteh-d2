<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTabela extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('prijavas', 'prijava');
        Schema::rename('korisniks', 'korisnik');
        Schema::rename('vakcinas', 'vakcina');
        Schema::rename('ustanovas', 'ustanova');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('ustanovas', 'ustanova');
        Schema::rename('vakcinas', 'vakcina');
        Schema::rename('korisniks', 'korisnik');
        Schema::rename('prijavas', 'prijava');

    }
}
