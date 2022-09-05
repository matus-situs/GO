<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('go', function (Blueprint $table) {
            $table->id();
            $table->foreignId("zaposlenik")->constrained("zaposlenik");
            $table->date('pocetak');
            $table->date('kraj');
            $table->text("opis");
            $table->foreignId("prihvatio_voditelj_tima")->constrained("tim");
            $table->foreignId("prihvatio_voditelj_projekta")->constrained("projekt");
            $table->string("status")->default("ceka odobrenje");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('go');
    }
};
