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
    Schema::create('cars', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // owner
        $table->string('title');                 // e.g. “2018 Honda Civic RS”
        $table->text('description')->nullable(); // optional details
        $table->string('fb_link');               // Facebook Marketplace URL
        $table->string('image_path')->nullable();// stored image path (we’ll wire uploads later)
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
