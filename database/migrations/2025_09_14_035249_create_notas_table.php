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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained('alunos');
            $table->foreignId('disciplina_id')->constrained('disciplinas');
            $table->foreignId('turma_id')->constrained('turmas');
            $table->foreignId('professor_id')->constrained('professores');
            $table->decimal('nota1', 3, 1);
            $table->decimal('nota2', 3, 1);
            $table->decimal('nota3', 3, 1);
            $table->decimal('media', 3, 1);
            $table->string('periodo');
            $table->date('data_avaliacao');
            $table->string('tipo_avaliacao');
            $table->integer('peso')->default(1);
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
