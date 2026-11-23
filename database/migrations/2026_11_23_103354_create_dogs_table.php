<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // msa7 user = msa7 klabo
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('breed')->nullable();
            $table->string('sex'); // male | female
            $table->decimal('weight', 5, 2)->nullable(); // kg
            $table->json('photos')->nullable();          // ["dogs/a.jpg", "dogs/b.jpg"]
            $table->boolean('is_neutered')->default(false);
            $table->string('color')->nullable();
            $table->string('microchip_number')->nullable()->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dogs');
    }
};