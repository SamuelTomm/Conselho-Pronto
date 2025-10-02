<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Ciclo;

class TrimestreServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Compartilhar trimestre ativo com todas as views
        View::composer('*', function ($view) {
            $trimestreAtivo = Ciclo::getTrimestreAtivoSistema();
            $view->with('trimestreAtivo', $trimestreAtivo);
        });
    }

    public function register()
    {
        //
    }
}
