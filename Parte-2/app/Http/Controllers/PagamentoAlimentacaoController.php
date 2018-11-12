<?php

namespace App\Http\Controllers;

use App\PagamentoAlimentacao;
use App\CupomAlimentacao;
use App\Aluno;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Repositories\Contracts\PagamentoAlimentacaoRepository;
use App\Repositories\Contracts\CupomAlimentacaoRepository;
use Kurt\Repoist\Repositories\Eloquent\Criteria\EagerLoad;

;

class PagamentoAlimentacaoController extends Controller
{
    private $pagamentoalimentacaos;

    public function __construct(PagamentoAlimentacaoRepository $pagamentoalimentacaos){
        $this->pagamentoalimentacaos = $pagamentoalimentacaos;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagamentos = PagamentoAlimentacao::all();
        $pagamentoAberto = PagamentoAlimentacao::where('data_pagamento',null)->first();
        // dd($pagamentoAberto);

        return view('pagamentoalimentacao.index', compact('pagamentos','pagamentoAberto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagamentoalimentacaos = $this->pagamentoalimentacaos
                            ->findWhere('data_pagamento', null);

        // dd($pagamentoalimentacaos);
        // $queryCupom = DB::table('cupom_alimentacaos')
                        // ->where('horario_utilizacao', '!=', null)
                        // ->where('pagamentoalimentacao_id', '=', null);

        if (sizeof($pagamentoalimentacaos)==0) {
            return $this->store(Request());

        } else {

            $pagamentoalimentacao = $pagamentoalimentacaos[0];
            // dd($pagamentoalimentacao);
            return redirect()->route('cupomalimentacao.listtopay', ['pagamentoalimentacao'=>$pagamentoalimentacao->id]);
        }

        
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
        $pagamentoalimentacao = new PagamentoAlimentacao();
        $pagamentoalimentacao->save();

        return redirect()->route('cupomalimentacao.listtopay', ['pagamentoalimentacao'=>$pagamentoalimentacao->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PagamentoAlimentacao  $pagamentoalimentacao
     * @return \Illuminate\Http\Response
     */
    public function show(PagamentoAlimentacao $pagamentoalimentacao)
    {
        return view('pagamentoalimentacao.show', compact('pagamentoalimentacao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PagamentoAlimentacao  $pagamentoAlimentacao
     * @return \Illuminate\Http\Response
     */
    public function edit(PagamentoAlimentacao $pagamentoAlimentacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PagamentoAlimentacao  $pagamentoalimentacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PagamentoAlimentacao $pagamentoalimentacao)
    {
        //
        $pagamentoalimentacao->setDataPagamento(Date('Y-m-d H:i:s'));
        $pagamentoalimentacao->update();

        return redirect()->route('pagamentoalimentacao.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PagamentoAlimentacao  $pagamentoAlimentacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(PagamentoAlimentacao $pagamentoAlimentacao)
    {
        //
    }
}
