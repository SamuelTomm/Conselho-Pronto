<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained('alunos')->onDelete('cascade');
            $table->foreignId('disciplina_id')->constrained('disciplinas')->onDelete('cascade');
            $table->foreignId('turma_id')->constrained('turmas')->onDelete('cascade');
            $table->foreignId('professor_id')->constrained('professores')->onDelete('cascade');
            $table->decimal('nota1', 3, 1)->nullable();
            $table->decimal('nota2', 3, 1)->nullable();
            $table->decimal('nota3', 3, 1)->nullable();
            $table->decimal('media', 3, 1)->nullable();
            $table->string('periodo');
            $table->date('data_avaliacao');
            $table->string('tipo_avaliacao');
            $table->integer('peso')->default(1);
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
