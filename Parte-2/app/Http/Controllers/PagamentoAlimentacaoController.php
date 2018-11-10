<?php

namespace App\Http\Controllers;

use App\PagamentoAlimentacao;
use App\CupomAlimentacao;
use App\Aluno;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;;

class PagamentoAlimentacaoController extends Controller
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
        $pagamento = DB::table("pagamento_alimentacaos")
                    ->where('data_pagamento','=', null)
                    ->get();

        $queryCupom = DB::table('cupom_alimentacaos')
                        ->where('horario_utilizacao','!=',null)
                        ->where('pagamento_alimentacao_id','=',null);

        if(sizeof($pagamento)==0){
            $pagamento = PagamentoAlimentacao::create([]);
        }else{
            $pagamento = $pagamento->first();
            $queryCupom->orWhere('pagamento_alimentacao_id','=',$pagamento->id);
        }

        $queryCupom->leftJoin('alunos','alunos.id','=','cupom_alimentacaos.aluno_id')
                    ->leftJoin('users','users.id','=','alunos.user_id')
                    ->leftJoin('refeicaos','refeicaos.id','=','cupom_alimentacaos.refeicao_id');

        $cupomalimentacaos = $queryCupom->get([
                            'cupom_alimentacaos.id as cupom_id',
                            'cupom_alimentacaos.created_at as cupom_data',
                            'cupom_alimentacaos.pagamento_alimentacao_id',
                            'alunos.matricula',
                            'refeicaos.name as refeicao_name',
                            'refeicaos.valor as refeicao_valor',
                            'users.name as aluno_name'
                            ]);

        return view('pagamentoalimentacao.create',compact('pagamento','cupomalimentacaos'));
    }


    public function setPagamento(Request $request){

        $data = $request->all();
        $pagamento = PagamentoAlimentacao::find($data['pagamento_id']);

        if($data['action']=='pagar'){
            $pagamento['data_pagamento'] = Date('Y-m-d H-i-s');
            $pagamento->update();

            return redirect()->route('pagamentoalimentacao.list');
        }

        $cupom =  CupomAlimentacao::find($data['cupom_id']);
        
        if($data['action']=='incluir'){
            $cupom['pagamento_alimentacao_id']=$data['pagamento_id'];
            $pagamento['valor']+=$data['refeicao_valor'];

        }else{
            $cupom['pagamento_alimentacao_id']=null;
            $pagamento['valor']-=$data['refeicao_valor'];

        }
        $cupom->update();
        $pagamento->update();
        return redirect()->route('pagamentoalimentacao.create');
    }


    function list(){

        $pagamentos = PagamentoAlimentacao::all();

        // return $alunos;
        return view('pagamentoalimentacao.list', compact('pagamentos'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PagamentoAlimentacao  $pagamentoalimentacao
     * @return \Illuminate\Http\Response
     */
    public function show(PagamentoAlimentacao $pagamentoalimentacao)
    {

        // $cupomalimentacaos = PagamentoAlimentacao::find($pagamentoalimentacao['id'])->cupomalimentacao;

        $queryCupom = DB::table('cupom_alimentacaos')
                        ->where('pagamento_alimentacao_id','=',$pagamentoalimentacao['id'])
                        ->leftJoin('alunos','alunos.id','=','cupom_alimentacaos.aluno_id')
                        ->leftJoin('users','users.id','=','alunos.user_id')
                        ->leftJoin('refeicaos','refeicaos.id','=','cupom_alimentacaos.refeicao_id');

        $cupomalimentacaos = $queryCupom->get([
                            'cupom_alimentacaos.id as cupom_id',
                            'cupom_alimentacaos.created_at as cupom_data',
                            'cupom_alimentacaos.pagamento_alimentacao_id',
                            'alunos.matricula',
                            'refeicaos.name as refeicao_name',
                            'refeicaos.valor as refeicao_valor',
                            'users.name as aluno_name'
                            ]);

        // dd($cupomalimentacaos);
        return view('pagamentoalimentacao.show',compact('cupomalimentacaos', 'pagamentoalimentacao'));
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
     * @param  \App\PagamentoAlimentacao  $pagamentoAlimentacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PagamentoAlimentacao $pagamentoAlimentacao)
    {
        //
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
