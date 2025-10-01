<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nome');
            $table->enum('nivel', ['Fundamental', 'Ensino Médio', 'Técnico'])->default('Ensino Médio');
            $table->integer('ano');
            $table->enum('periodo', ['Matutino', 'Vespertino', 'Noturno', 'Integral'])->default('Matutino');
            $table->string('conselheiro')->nullable();
            $table->string('sala')->nullable();
            $table->text('descricao')->nullable();
            $table->string('cor')->default('blue'); // blue, green, purple, orange, pink, emerald
            $table->integer('alunos_count')->default(0);
            $table->integer('disciplinas_count')->default(0);
            $table->enum('status', ['Ativa', 'Inativa'])->default('Ativa');
            $table->foreignId('curso_id')->nullable()->constrained('cursos')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};
