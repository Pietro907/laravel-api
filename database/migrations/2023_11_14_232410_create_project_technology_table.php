<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*
     
Run the migrations.*/
    public function up(): void
    {
        /* Schema::dropIfExists('project_technology'); */

        Schema::create('project_technology', function (Blueprint $table) {

            $table->foreign('project_id')->references('id')->on('projects');
            
            $table->unsignedBigInteger('project_id');

            $table->foreign('technology_id')->references('id')->on('technologies');
            
            $table->unsignedBigInteger('technology_id');

            $table->primary(['project_id', 'technology_id']);

            $table->timestamps();
        });
    }

    /*
     
Reverse the migrations.*/
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
