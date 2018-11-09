<?php

namespace App\Http\Controllers;

use App\Refeicao;
use Illuminate\Http\Request;

class RefeicaoController extends Controller
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
        //
        return view('refeicao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        
        $refeicao = Refeicao::create([
            'name' => $data['name'],
            'valor' => $data['valor'],
            'inicio' => $data['inicio'],
            'termino' => $data['termino']
        ]);

        return view('/home');
    }

    public function list(){

        $refeicaos = Refeicao::all();

        // return $alunos;
        return view('refeicao.list', compact('refeicaos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Refeicao  $refeicao
     * @return \Illuminate\Http\Response
     */
    public function show(Refeicao $refeicao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Refeicao  $refeicao
     * @return \Illuminate\Http\Response
     */
    public function edit(Refeicao $refeicao)
    {
        //
        // dd($refeicao);
        
        return view('refeicao.edit', compact('refeicao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Refeicao  $refeicao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Refeicao $refeicao)
    {
        //
        $data = $request->all();
        $refeicao['name'] = $data['name'];
        $refeicao['valor'] = $data['valor'];
        $refeicao['inicio'] = $data['inicio'];
        $refeicao['termino'] = $data['termino'];
        $refeicao->update();
        
        return redirect()->route('refeicao.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Refeicao  $refeicao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Refeicao $refeicao)
    {
        //
    }
}
