<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notas', function (Blueprint $table) {
            // Adicionar foreign key para trimestre
            $table->foreignId('trimestre_id')->nullable()->constrained('trimestres')->onDelete('cascade');
            
            // Manter o campo periodo para compatibilidade, mas agora será preenchido automaticamente
            // baseado no trimestre_id
        });
    }

    public function down(): void
    {
        Schema::table('notas', function (Blueprint $table) {
            $table->dropForeign(['trimestre_id']);
            $table->dropColumn('trimestre_id');
        });
    }
};
