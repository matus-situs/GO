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
        Schema::create('projekt', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->foreignId("voditelj")->constrained("zaposlenik");
            $table->date('datum_nastanka');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projekt');
    }
};
