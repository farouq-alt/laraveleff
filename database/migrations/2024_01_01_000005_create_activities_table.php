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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // Activity name
            $table->text('description')->nullable();
            $table->unsignedBigInteger('seminaire_id'); // Foreign key to seminaires
            $table->timestamps();

            // Define the relationship to seminaires table
            $table->foreign('seminaire_id')->references('id')->on('seminaires')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
