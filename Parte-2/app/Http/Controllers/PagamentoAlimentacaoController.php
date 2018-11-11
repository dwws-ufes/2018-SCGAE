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

        $queryCupom = DB::table('cupom_alimentacaos')
                        ->where('horario_utilizacao', '!=', null)
                        ->where('pagamento_alimentacao_id', '=', null);

        if (sizeof($pagamentoalimentacaos)==0) {

            $pagamentoalimentacaos = PagamentoAlimentacao::create([]);

        } else {

            $pagamentoalimentacaos = $pagamentoalimentacaos->first();

            $cupomalimentacaos = $pagamentoalimentacaos->cupomalimentacao;
            // dd($cupomalimentacaos);

            $queryCupom->orWhere('pagamento_alimentacao_id', '=', $pagamentoalimentacaos->id);

        }

        $queryCupom->leftJoin('alunos', 'alunos.id', '=', 'cupom_alimentacaos.aluno_id')
                    ->leftJoin('users', 'users.id', '=', 'alunos.user_id')
                    ->leftJoin('refeicaos', 'refeicaos.id', '=', 'cupom_alimentacaos.refeicao_id');

        $cupomalimentacaos = $queryCupom->get([
                            'cupom_alimentacaos.id as cupom_id',
                            'cupom_alimentacaos.created_at as cupom_data',
                            'cupom_alimentacaos.pagamento_alimentacao_id',
                            'alunos.matricula',
                            'refeicaos.name as refeicao_name',
                            'refeicaos.valor as refeicao_valor',
                            'users.name as aluno_name'
                            ]);

        return view('pagamentoalimentacao.create', compact('pagamentoalimentacaos', 'cupomalimentacaos'));
    }


    public function setPagamento(Request $request)
    {
        $data = $request->all();
        $pagamento = PagamentoAlimentacao::find($data['pagamento_id']);

        if ($data['action']=='pagar') {
            $pagamento['data_pagamento'] = Date('Y-m-d H-i-s');
            $pagamento->update();

            return redirect()->route('pagamentoalimentacao.index');
        }

        $cupom =  CupomAlimentacao::find($data['cupom_id']);

        if ($data['action']=='incluir') {
            $cupom['pagamento_alimentacao_id']=$data['pagamento_id'];
            $pagamento['valor']+=$data['refeicao_valor'];
        } else {
            $cupom['pagamento_alimentacao_id']=null;
            $pagamento['valor']-=$data['refeicao_valor'];
        }
        $cupom->update();
        $pagamento->update();
        return redirect()->route('pagamentoalimentacao.create');
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

        return redirect()->route('pagamentoalimentacao.index');
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
                        ->where('pagamento_alimentacao_id', '=', $pagamentoalimentacao['id'])
                        ->leftJoin('alunos', 'alunos.id', '=', 'cupom_alimentacaos.aluno_id')
                        ->leftJoin('users', 'users.id', '=', 'alunos.user_id')
                        ->leftJoin('refeicaos', 'refeicaos.id', '=', 'cupom_alimentacaos.refeicao_id');

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
        return view('pagamentoalimentacao.show', compact('cupomalimentacaos', 'pagamentoalimentacao'));
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
