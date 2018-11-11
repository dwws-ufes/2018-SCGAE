<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\AlunoRepository;
use App\Repositories\Contracts\EscolaRepository;
use App\Repositories\Contracts\RestauranteRepository;
use App\Repositories\Contracts\RefeicaoRepository;
use App\Repositories\Contracts\CupomAlimentacaoRepository;
use App\Repositories\Contracts\PagamentoAlimentacaoRepository;
use App\Repositories\Eloquent\EloquentAlunoRepository;
use App\Repositories\Eloquent\EloquentEscolaRepository;
use App\Repositories\Eloquent\EloquentRestauranteRepository;
use App\Repositories\Eloquent\EloquentRefeicaoRepository;
use App\Repositories\Eloquent\EloquentCupomAlimentacaoRepository;
use App\Repositories\Eloquent\EloquentPagamentoAlimentacaoRepository;

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
     * Register the application servic  es.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AlunoRepository::class, EloquentAlunoRepository::class);
        $this->app->bind(EscolaRepository::class, EloquentEscolaRepository::class);
        $this->app->bind(RestauranteRepository::class, EloquentRestauranteRepository::class);
        $this->app->bind(RefeicaoRepository::class, EloquentRefeicaoRepository::class);
        $this->app->bind(CupomAlimentacaoRepository::class, EloquentCupomAlimentacaoRepository::class);
        $this->app->bind(PagamentoAlimentacaoRepository::class, EloquentPagamentoAlimentacaoRepository::class);
    }
}
