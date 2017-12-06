<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\TurmaRepository::class, \App\Repositories\TurmaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AlunoRepository::class, \App\Repositories\AlunoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RespostaRepository::class, \App\Repositories\RespostaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PerguntaRepository::class, \App\Repositories\PerguntaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\QuestionarioRepository::class, \App\Repositories\QuestionarioRepositoryEloquent::class);
        //:end-bindings:
    }
}
