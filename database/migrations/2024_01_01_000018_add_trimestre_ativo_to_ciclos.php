<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ciclos', function (Blueprint $table) {
            $table->foreignId('trimestre_ativo_id')->nullable()->constrained('trimestres')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('ciclos', function (Blueprint $table) {
            $table->dropForeign(['trimestre_ativo_id']);
            $table->dropColumn('trimestre_ativo_id');
        });
    }
};
