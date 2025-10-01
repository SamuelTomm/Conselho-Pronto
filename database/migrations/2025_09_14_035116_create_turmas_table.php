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
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nome');
            $table->enum('nivel', ['Ensino Fundamental', 'Ensino Médio', 'Técnico']);
            $table->string('ano');
            $table->enum('periodo', ['Matutino', 'Vespertino', 'Noturno', 'Integral']);
            $table->string('sala')->nullable();
            $table->string('conselheiro');
            $table->string('cor')->default('blue');
            $table->integer('alunos_count')->default(0);
            $table->integer('disciplinas_count')->default(0);
            $table->text('descricao')->nullable();
            $table->string('status')->default('Ativa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};
