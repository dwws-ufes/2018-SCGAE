<?php

namespace App\Http\Controllers;

use App\Restaurante;
use Illuminate\Http\Request;
use App\Http\Requests\RestauranteStoreRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\RestauranteRepository;
use Kurt\Repoist\Repositories\Eloquent\Criteria\EagerLoad;
use Illuminate\Support\Facades\Password;

class RestauranteController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    private $restaurantes;

    public function __construct(RestauranteRepository $restaurantes)
    {
        $this->restaurantes = $restaurantes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurantes = $this->restaurantes->withCriteria([
            new EagerLoad(['user']),
        ])->all();

        return view('restaurante.index', compact('restaurantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('restaurante.create');

        return view('restaurante.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AlunoStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestauranteStoreRequest $request)
    {
        $data = $request->all();

        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->save();

        $restaurante = new Restaurante([
            'telefone' => $data['telefone'],
            'cnpj' => $data['cnpj']
        ]);

        $restaurante->user()->associate($user);
        $restaurante->save();

        if (env('MAIL_USERNAME') && env('MAIL_PASSWORD')) {
            Password::broker()->sendResetLink(
                ['email' => $data['email']]
            );
        }


        return redirect()->route('restaurante.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurante $restaurante)
    {
        return view('restaurante.show', compact('restaurante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurante $restaurante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurante $restaurante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurante $restaurante)
    {
        //
    }
}
