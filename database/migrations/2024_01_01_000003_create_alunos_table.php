<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('matricula')->unique();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('telefone')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->text('endereco')->nullable();
            $table->string('turma_nome')->nullable(); // Nome da turma para relacionamento
            $table->string('curso_nome')->nullable(); // Nome do curso para relacionamento
            $table->string('responsavel')->nullable();
            $table->string('telefone_responsavel')->nullable();
            $table->enum('status', ['Ativo', 'Inativo', 'Transferido'])->default('Ativo');
            $table->text('observacoes')->nullable();
            $table->string('foto')->nullable();
            $table->foreignId('turma_id')->nullable()->constrained('turmas')->onDelete('set null');
            $table->foreignId('curso_id')->nullable()->constrained('cursos')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
