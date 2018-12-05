<?php

namespace App\Http\Controllers;

use App\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AlunoStoreRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\UserAluno;
use App\EnderecoAluno;
use App\Escola;
use App\Repositories\Contracts\AlunoRepository;
use Kurt\Repoist\Repositories\Eloquent\Criteria\EagerLoad;
use Illuminate\Support\Facades\Auth;
use App\UserEscola;
use Illuminate\Support\Facades\Password;

class AlunoController extends Controller
{
    private $alunos;

    public function __construct(AlunoRepository $alunos)
    {
        $this->alunos = $alunos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = $this->alunos->withCriteria([
            new EagerLoad(['user']),
        ])->all();

        return view('aluno.index', compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aluno.create');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'telefone' => '',
            'matricula' => 'required|string|min:6',
            'cpf' => 'required|string|min:6|max:6',
            'rendaFamiliar' => 'required|numeric'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AlunoStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlunoStoreRequest $request)
    {
        $data = $request->all();

        $user = new UserAluno([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->save();

        $endereco = new EnderecoAluno([
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'],
            'cep' => $data['cep'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'estado' => $data['estado'],
            'pais' => $data['pais'],
        ]);

        $endereco->save();

        $userEscola = UserEscola::find(Auth::user()->id)->escola ;
        $escola = $userEscola ? $userEscola->escola : Escola::firstOrFail();

        $aluno = new Aluno([
            'telefone' => $data['telefone'],
            'matricula' => $data['matricula'],
            'cpf' => $data['cpf'],
            'rendaFamiliar' => $data['rendaFamiliar'],
            'auxilioAlimentacao' => intval($data['auxilioAlimentacao']),
            'auxilioTransporte' => intval($data['auxilioTransporte']),
        ]);

        $aluno->escola()->associate($escola);
        $aluno->endereco()->associate($endereco);
        $aluno->user()->associate($user);
        $aluno->save();


        if (env('MAIL_USERNAME') && env('MAIL_PASSWORD')) {
            Password::broker()->sendResetLink(
                ['email' => $data['email']]
            );
        }

        return redirect()->route('aluno.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function show(Aluno $aluno)
    {
        return view('aluno.show', compact('aluno'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function semantic(Aluno $aluno)
    {
        // $format_options = array();
        // foreach (\EasyRdf_Format::getFormats() as $format) {
        //     if ($format->getSerialiserClass()) {
        //         $format_options[$format->getLabel()] = $format->getName();
        //     }
        // }
        // dd($format_options);
        $graph = new \EasyRdf_Graph();
        $me = $graph->resource(url()->current(), 'foaf:Person');
        $me->set('foaf:name', $aluno->user->name);
        $me->set('foaf:phone', $aluno->telefone);

        $email = $graph->resource("mailto:" . $aluno->user->email);
        $me->add('foaf:mbox', $email);

        $data = $graph->serialise('rdfxml');
        // dd($data);

        return response($data)->header('Content-Type', 'application/rdf+xml');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function edit(Aluno $aluno)
    {
        return view('aluno.edit', compact('aluno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aluno $aluno)
    {
        $user_data = $request->only('email', 'name');

        $endereco_data = $request->only(
            'logradouro',
            'numero',
            'complemento',
            'cep',
            'bairro',
            'cidade',
            'estado',
            'pais'
        );

        $aluno_data = $request->only(
            'telefone',
            'matricula',
            'cpf',
            'rendaFamiliar',
            'auxilioAlimentacao',
            'auxilioTransporte'
        );

        $aluno->user()->update($user_data);
        $aluno->endereco()->update($endereco_data);
        $aluno->update($aluno_data);

        return redirect()->route('aluno.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aluno $aluno)
    {
        //
    }
}
