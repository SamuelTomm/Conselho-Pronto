<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('professor_turma', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professor_id')->constrained('professores')->onDelete('cascade');
            $table->foreignId('turma_id')->constrained('turmas')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['professor_id', 'turma_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('professor_turma');
    }
};
