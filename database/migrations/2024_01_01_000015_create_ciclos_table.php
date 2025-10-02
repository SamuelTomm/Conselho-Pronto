<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ciclos', function (Blueprint $table) {
            $table->id();
            $table->integer('ano')->unique(); // Ex: 2024, 2025
            $table->string('descricao')->nullable(); // Ex: "Ano letivo de 2024"
            $table->date('data_inicio'); // Data de início do ano letivo
            $table->date('data_fim'); // Data de fim do ano letivo
            $table->boolean('ativo')->default(true); // Se o ciclo está ativo
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ciclos');
    }
};
