<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conselho_participantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conselho_id')->constrained('conselho_classe')->onDelete('cascade');
            $table->foreignId('professor_id')->constrained('professores')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['conselho_id', 'professor_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conselho_participantes');
    }
};
