<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// Script para executar via: php artisan tinker
// Execute: php artisan tinker
// Depois: include 'artisan_seed.php';

echo "🌱 Iniciando seed de dados...\n";

try {
    // Executar o script SQL
    $sql = file_get_contents('database_seeders.sql');
    DB::unprepared($sql);
    
    echo "✅ Dados inseridos com sucesso!\n";
    echo "📊 Resumo:\n";
    echo "- Cursos: " . DB::table('cursos')->count() . "\n";
    echo "- Turmas: " . DB::table('turmas')->count() . "\n";
    echo "- Disciplinas: " . DB::table('disciplinas')->count() . "\n";
    echo "- Professores: " . DB::table('professores')->count() . "\n";
    echo "- Alunos: " . DB::table('alunos')->count() . "\n";
    echo "- Usuários: " . DB::table('users')->count() . "\n";
    
    echo "\n🎉 Seed concluído! Acesse /dashboard/professores/create para testar.\n";
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}
