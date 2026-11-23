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
        Schema::create('adoption_dogs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // chkhs li nechr
    $table->string('name');
    $table->text('description')->nullable();
    $table->date('date_of_birth')->nullable();
    $table->string('breed')->nullable();
    $table->string('sex');                       // male | female
    $table->string('size')->nullable();          // small | medium | large
    $table->decimal('weight', 5, 2)->nullable(); // kg
    $table->string('color')->nullable();
    $table->string('city')->nullable()->index();
    $table->boolean('is_neutered')->default(false);
    $table->boolean('is_vaccinated')->default(false);
    $table->boolean('is_microchipped')->default(false);
    $table->boolean('good_with_kids')->default(false);
    $table->boolean('good_with_dogs')->default(false);
    $table->text('adoption_requirements')->nullable();
    $table->string('status')->default('available')->index(); // available | reserved | adopted
    $table->json('photos')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoption_dogs');
    }
};
