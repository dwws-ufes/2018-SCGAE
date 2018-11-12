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
use App\UserAluno;
use App\UserRestaurante;
use App\Escola;
use function Psy\debug;
use App\CupomAlimentacao;

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

    private function isUserAdmin($user)
    {
        return $user->id === 1;
    }

    private function isUserEscola($user)
    {
        return UserEscola::find($user->id)->escola !== null;
    }

    private function isUserAluno($user)
    {
        return UserAluno::find($user->id)->aluno !== null;
    }

    private function isAlunoHabilitadoCupomAlimentacao($user, $cupomalimentacao)
    {
        $aluno = UserAluno::find($user->id)->aluno;

        if (! $aluno) {
            return false;
        }

        if (! $aluno->auxilioAlimentacao) {
            return false;
        }

        if (($cupomalimentacao instanceof CupomAlimentacao) && $cupomalimentacao->aluno->id != $aluno->id) {
            return false;
        }

        return true;
    }

    private function isUserRestaurante($user)
    {
        return UserRestaurante::find($user->id)->restaurante !== null;
    }

    private function checkExistingEscolas()
    {
        return Escola::all()->count() > 0;
    }

    private function checkExistingRestaurantes()
    {
        return Restaurante::all()->count() > 0;
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if (
                $ability != 'escola.create' && $ability != 'restaurante.create' &&
                $this->isUserAdmin($user)
                ) {
                return true;
            }
        });

        Gate::define('escola.manage', function ($user, $escola = null) {
            return false;
        });

        Gate::define('escola.create', function ($user, $escola = null) {
            return Gate::allows('escola.manage') && ! $this->checkExistingEscolas();
        });

        Gate::define('aluno.manage', function ($user, $aluno = null) {
            return $this->isUserEscola($user);
        });

        Gate::define('restaurante.manage', function ($user, $restaurante = null) {
            return $this->isUserEscola($user);
        });

        Gate::define('restaurante.create', function ($user, $restaurante = null) {
            return Gate::allows('restaurante.manage') && !$this->checkExistingRestaurantes();
        });

        Gate::define('refeicao.manage', function ($user, $refeicao = null) {
            return $this->isUserEscola($user);
        });

        Gate::define('cupomalimentacao.emitir', function ($user, $cupomalimentacao = null) {
            return $this->isUserAluno($user) && $this->isAlunoHabilitadoCupomAlimentacao($user, $cupomalimentacao);
        });

        Gate::define('cupomalimentacao.validar', function ($user, $cupomalimentacao = null) {
            return $this->isUserRestaurante($user);
        });

        Gate::define('cupomalimentacao.pagar', function ($user, $cupomalimentacao = null) {
            return $this->isUserEscola($user);
        });

        Gate::define('pagamentoalimentacao.manage', function ($user, $pagamentoalimentacao = null) {
            return $this->isUserEscola($user);
        });
    }
}
