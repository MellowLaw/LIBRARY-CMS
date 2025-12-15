<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->enum('section_type', ['vision', 'mission', 'goals', 'news', 'staff', 'custom']);
            $table->string('title');
            $table->longText('content')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_sections');
    }
};
