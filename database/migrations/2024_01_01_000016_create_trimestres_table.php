<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trimestres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ciclo_id')->constrained('ciclos')->onDelete('cascade');
            $table->integer('numero'); // 1, 2, 3
            $table->string('nome'); // "1º Trimestre", "2º Trimestre", "3º Trimestre"
            $table->string('periodo'); // "Fevereiro a Abril", "Maio a Julho", "Agosto a Novembro"
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->boolean('ativo')->default(true);
            $table->text('observacoes')->nullable();
            $table->timestamps();
            
            // Garantir que não pode ter dois trimestres com o mesmo número no mesmo ciclo
            $table->unique(['ciclo_id', 'numero']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trimestres');
    }
};
