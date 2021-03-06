<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrijavasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prijavas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('napomena')->default('');
            $table->unsignedBigInteger('zakazano_u');
            $table->unsignedBigInteger('korisnik_id');
            $table->unsignedBigInteger('ustanova_id');
            $table->unsignedBigInteger('vakcina_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prijavas');
    }
}
