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
        Schema::create('Knowledge_Table', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('IdStudent')->unsigned();
            $table->String('Skill');
            $table->Text('Description');
            $table->enum('status', ['à faire', 'en cours', 'terminé'])->default('à faire');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Knowledge_Table');
    }
};
