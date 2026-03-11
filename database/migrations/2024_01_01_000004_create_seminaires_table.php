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
        Schema::create('seminaires', function (Blueprint $table) {
            $table->id();
            $table->string('theme'); // Seminar theme/title
            $table->date('date_debut'); // Start date
            $table->date('date_fin'); // End date
            $table->text('description')->nullable();
            $table->decimal('cout_journalier', 8, 2); // Daily cost
            $table->unsignedBigInteger('animateur_id'); // Foreign key to animateurs
            $table->timestamps();

            // Define the relationship to animateurs table
            $table->foreign('animateur_id')->references('id')->on('animateurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seminaires');
    }
};
