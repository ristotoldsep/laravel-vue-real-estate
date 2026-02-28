<?php

use App\Models\Apartment;
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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('number');
            $table->unsignedInteger('floor');
            $table->unsignedInteger('rooms');
            $table->decimal('area', 10, 2);
            $table->decimal('balcony', 10, 2);
            $table->unsignedMediumInteger('price');
            $table->string('status')->nullable();
            $table->timestamps();
        });

        Apartment::create([
            'number' => 1,
            'floor' => 1,
            'rooms' => 1,
            'area' => 50.00,
            'balcony' => 5.00,
            'price' => 100000,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
