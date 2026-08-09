<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_categories', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('carousel'); // 'hero' | 'carousel'
            $table->string('name_et')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_ru')->nullable();
            $table->integer('sort_order')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_categories');
    }
};
