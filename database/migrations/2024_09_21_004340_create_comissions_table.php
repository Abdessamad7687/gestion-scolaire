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
        Schema::create('comissions', function (Blueprint $table) {
            $table->id();
            $table->double('montant');
            $table->date('datecomission');
            $table->string('statutcomission');
            $table->unsignedBigInteger('professeur_id'); // Define the column
            $table->unsignedBigInteger('etudiant_id');
            $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
            $table->foreign('etudiant_id')->references('id')->on('etudiants')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comissions');
    }
};
