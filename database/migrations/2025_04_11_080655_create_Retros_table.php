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
        Schema::create('Retros_Table', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('Teacher_id')->unsigned();
            $table->String('Name_of_Promotion');
            $table->String('Retro');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Retros_Table');
    }
};
