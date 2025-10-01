<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disciplinas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nome');
            $table->string('curso_nome')->nullable(); // Nome do curso para relacionamento
            $table->integer('carga_horaria')->default(0);
            $table->string('periodo')->nullable();
            $table->text('descricao')->nullable();
            $table->string('cor')->default('blue'); // blue, green, purple, orange, pink, emerald
            $table->integer('total_alunos')->default(0);
            $table->boolean('ativo')->default(true);
            $table->foreignId('curso_id')->nullable()->constrained('cursos')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disciplinas');
    }
};
