<?php

namespace App\Http\Controllers;

use App\User;
use App\Aluno;
use App\Refeicao;
use Illuminate\Support\Facades\Auth;
use App\CupomAlimentacao;
use Illuminate\Http\Request;
use Date;
use Illuminate\Support\Facades\DB;

class CupomAlimentacaoController extends Controller
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

    public function today()
    {
        //
        $user = Auth::user();
        $aluno = Aluno::whereUserId($user['id'])->first();

        // $cupomalimentacaos = Aluno::find($aluno['id'])->cupomalimentacao()->whereDate('created_at','=',Date('Y-m-d'))->get();

        $refeicaos = DB::table("refeicaos")
                    ->leftJoin(
                        DB::raw(
                        "(SELECT id as id_cupom, horario_utilizacao, created_at as emissao_cupom, refeicao_id FROM cupom_alimentacaos WHERE DATE(cupom_alimentacaos.created_at) = '" . Date('Y-m-d') . "') as cupom"
                        ),'refeicaos.id','=','cupom.refeicao_id'
                    )->orderBy("inicio")
                    ->get();

        


        return view('cupomalimentacao.today', compact('user','aluno','refeicaos'));

        // dd($aluno);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // dd($data);

        $cupomAlimentacao = CupomAlimentacao::create([
            'refeicao_id' => $data['refeicaoId'],
            'aluno_id' => $data['alunoId']
        ]);

        
        // return route('cupomalimentacao.show',$cupomAlimentacao);
        return redirect()->route('cupomalimentacao.today');


        // return view('cupomalimentacao.list', compact('alunos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CupomAlimentacao  $cupomAlimentacao
     * @return \Illuminate\Http\Response
     */
    public function show(int $cupomAlimentacaoId)
    {
        // dd($cupomAlimentacaoId);
        $cupomAlimentacao = CupomAlimentacao::find($cupomAlimentacaoId);
        $aluno = CupomAlimentacao::find($cupomAlimentacao['id'])->aluno;
        $user = Aluno::find($aluno['id'])->user;
        $refeicao = CupomAlimentacao::find($cupomAlimentacao['id'])->refeicao;

        return view('cupomalimentacao.print', compact('cupomAlimentacao', 'aluno', 'refeicao', 'user'));
    }


    public function validateView(Request $request){
        $data = $request->all();
        // dd($data);
        if(empty($data)){
            return view('cupomalimentacao.validate');
        }
        // dd($data);

        $cupomAlimentacao = CupomAlimentacao::find($data['cupomalimentacao_id']);
        $aluno = CupomAlimentacao::find($cupomAlimentacao['id'])->aluno;
        $user = Aluno::find($aluno['id'])->user;
        $refeicao = CupomAlimentacao::find($cupomAlimentacao['id'])->refeicao;

        // dd($cupomAlimentacao, $aluno, $user, $refeicao);

        return view('cupomalimentacao.validate', compact('cupomAlimentacao', 'aluno', 'user', 'refeicao'));
    }

    public function doValidate(Request $request){
        $data = $request->all();

        $cupomAlimentacao = CupomAlimentacao::find($data['cupomalimentacao_id']);
        $cupomAlimentacao['horario_utilizacao'] = Date('Y-m-d H:m:s');
        $cupomAlimentacao->update();

        return redirect()->route('cupomalimentacao.validate', $request);
        
        
    }

    public function reportMeusCupons(Request $request){
        $data = $request->all();
        // dd($data);
        if(empty($data)){
            return view('relatorio.meuscupons');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CupomAlimentacao  $cupomAlimentacao
     * @return \Illuminate\Http\Response
     */
    public function edit(CupomAlimentacao $cupomAlimentacao)
    {
        //
        // dd($cupomAlimentacao);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CupomAlimentacao  $cupomAlimentacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CupomAlimentacao $cupomAlimentacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CupomAlimentacao  $cupomAlimentacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(CupomAlimentacao $cupomAlimentacao)
    {
        //
    }
}
