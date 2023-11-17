<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            $table->longText('link')->nullable();
            $table->longText('github_link')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */

     //serve per modificare le tabelle di up()
    public function down(): void
    {
        /* Schema::table('projects', function (Blueprint $table) {

            $table->longText('link');
            $table->longText('github_link');

        }); */
    }
};

