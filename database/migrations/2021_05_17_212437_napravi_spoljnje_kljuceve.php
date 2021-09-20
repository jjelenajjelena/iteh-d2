<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NapraviSpoljnjeKljuceve extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prijava', function (Blueprint $table) {
            $table->foreign('vakcina_id')->references('id')->on('vakcina')->onDelete('cascade');
            $table->foreign('korisnik_id')->references('id')->on('korisnik')->onDelete('cascade');
            $table->foreign('ustanova_id')->references('id')->on('ustanova')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prijava', function (Blueprint $table) {
            $table->dropForeign(['korisnik_id']);
            $table->dropForeign(['vakcina_id']);
            $table->dropForeign(['ustanova_id']);
        });
    }
}
