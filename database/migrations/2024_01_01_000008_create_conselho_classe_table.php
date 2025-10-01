<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conselho_classe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('turma_id')->constrained('turmas')->onDelete('cascade');
            $table->date('data');
            $table->enum('status', ['agendado', 'em_andamento', 'realizado', 'cancelado'])->default('agendado');
            $table->integer('participantes')->default(0);
            $table->text('observacoes')->nullable();
            $table->longText('ata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conselho_classe');
    }
};
