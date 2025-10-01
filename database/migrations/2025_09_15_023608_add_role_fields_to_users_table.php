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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('professor')->after('email');
            $table->json('turmas_ids')->nullable()->after('role');
            $table->json('disciplinas_ids')->nullable()->after('turmas_ids');
            $table->boolean('active')->default(true)->after('disciplinas_ids');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'turmas_ids', 'disciplinas_ids', 'active']);
        });
    }
};
