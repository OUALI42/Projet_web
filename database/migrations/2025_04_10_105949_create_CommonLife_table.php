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
        Schema::create('CommonLife_Table', function (Blueprint $table) {
            $table->id();
            $table->id('StudentID');
            $table->string('Task');
            $table->Boolean('Status');
            $table->Text('Commentary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('CommonLife_Table');
    }
};
