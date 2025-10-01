<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('professores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'coordenador', 'conselheiro', 'professor'])->default('professor');
            $table->string('especialidade')->nullable();
            $table->string('telefone')->nullable();
            $table->date('data_admissao')->nullable();
            $table->json('turmas_ids')->nullable(); // IDs das turmas como array
            $table->json('disciplinas_ids')->nullable(); // IDs das disciplinas como array
            $table->text('observacoes')->nullable();
            $table->boolean('ativo')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('professores');
    }
};
