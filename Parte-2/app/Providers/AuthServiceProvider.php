<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Aluno;
use App\Policies\AlunoPolicy;
use App\Refeicao;
use App\Policies\RefeicaoPolicy;
use App\Restaurante;
use App\Policies\RestaurantePolicy;
use App\UserEscola;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($user->name == 'Admin') {
                return true;
            }
        });

        Gate::define('escola.manage', function ($user, $escola = null) {
            return false;
        });

        Gate::define('aluno.manage', function ($user, $aluno = null) {
            return UserEscola::find($user->id)->escola;
        });

        Gate::define('restaurante.manage', function ($user, $restaurante = null) {
            return UserEscola::find($user->id)->escola;
        });

        Gate::define('refeicao.manage', function ($user, $refeicao = null) {
            return UserEscola::find($user->id)->escola;
        });
    }
}
