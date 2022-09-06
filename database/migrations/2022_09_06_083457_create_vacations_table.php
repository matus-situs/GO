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
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("employee")->constrained("employees");
            $table->date('start');
            $table->date('end');
            $table->text("description");
            $table->foreignId("team_lead_approved")->nullable()->constrained("teams");
            $table->foreignId("project_lead_approved")->nullable()->constrained("projects");
            $table->string("status")->default("waiting approval");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacations');
    }
};
