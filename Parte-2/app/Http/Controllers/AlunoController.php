<?php

namespace App\Http\Controllers;

use App\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AlunoStoreRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $this->validator($data)->validate();
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $aluno = Aluno::create([
            'user_id' => $user['id'],
            'telefone' => $data['telefone'],
            'matricula' => $data['matricula'],
            'cpf' => $data['cpf'],
            'rendaFamiliar' => $data['rendaFamiliar'],
            'auxilioAlimentacao' => isset($data['auxilioAlimentacao']),
            'auxilioTransporte' => isset($data['auxilioTransporte'])
        ]);

        // dd($user, $aluno);
    }

    public function list(){

        $alunos = DB::table('users')
                    ->join('alunos','alunos.user_id', '=' , 'users.id')
                    ->get();

        // return $alunos;
        return view('aluno.list', compact('alunos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function show(Aluno $aluno)
    {
        //

        // $user = User::show()
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function edit(Aluno $aluno)
    {
        // $aluno = $aluno->leftJoin('users','alunos.user_id', '=' , 'users.id')->get();
        // dd($aluno);

        $user = User::find($aluno['user_id']);
        
        return view('aluno.edit', compact('aluno', 'user'));
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
        //
        // dd($request, $aluno);
        $data = $request->all();

        // $this->validator($data)->validate();

        $user = User::find($aluno['user_id']);
        
        $user['name'] = $data['name'];
        $user->update();

        
        $aluno['telefone'] = $data['telefone'];
        $aluno['matricula'] = $data['matricula'];
        $aluno['cpf'] = $data['cpf'];
        $aluno['rendaFamiliar'] = $data['rendaFamiliar'];
        $aluno['auxilioAlimentacao'] = isset($data['auxilioAlimentacao']);
        $aluno['auxilioTransporte'] = isset($data['auxilioTransporte']);
        $aluno->update();
        
        return redirect()->route('aluno.list');
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
