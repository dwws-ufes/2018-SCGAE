<?php

namespace App\Http\Controllers;

use App\User;
use App\Aluno;
use App\Refeicao;
use App\PagamentoAlimentacao;
use Illuminate\Support\Facades\Auth;
use App\CupomAlimentacao;
use Illuminate\Http\Request;
use Date;
use Illuminate\Support\Facades\DB;

use App\Repositories\Contracts\CupomAlimentacaoRepository;
use Kurt\Repoist\Repositories\Eloquent\Criteria\EagerLoad;

class CupomAlimentacaoController extends Controller
{
    
    private $cupomalimentacaos;

    public function __construct(CupomAlimentacaoRepository $cupomalimentacaos){
        $this->cupomalimentacaos = $cupomalimentacaos;
    }

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

        // $refeicaos = Refeicao::all()
                    // ->join('cupom_alimentacaos','refeicaos.id','=','cupomalimentacaos.refeicao_id')
                    // ->get();
                    // ->where('');
        // dd($refeicaos);

        // $cupomalimentacaos = Aluno::find($aluno['id'])->cupomalimentacao()->whereDate('created_at','=',Date('Y-m-d'))->get();



        $refeicaos = DB::table("refeicaos")
                    ->leftJoin(
                        DB::raw(
                        "(SELECT id as id_cupom, horario_utilizacao, created_at as emissao_cupom, refeicao_id, aluno_id FROM cupom_alimentacaos WHERE DATE(cupom_alimentacaos.created_at) = '" . Date('Y-m-d') . "' AND cupom_alimentacaos.aluno_id = " . $aluno['id'] . ") as cupom"
                        ),'refeicaos.id','=','cupom.refeicao_id'
                    )->orderBy("inicio")
                    ->get();

        dd($refeicaos);

        return view('cupomalimentacao.today', compact('user','aluno','refeicaos'));
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
     * @param  \App\CupomAlimentacao  $cupomalimentacao
     * @return \Illuminate\Http\Response
     */
    public function show(CupomAlimentacao $cupomalimentacao)
    {
        $aluno = CupomAlimentacao::find($cupomalimentacao['id'])->aluno;
        $user = Aluno::find($aluno['id'])->user;
        $refeicao = CupomAlimentacao::find($cupomalimentacao['id'])->refeicao;

        return view('cupomalimentacao.print', compact('cupomalimentacao', 'aluno', 'refeicao', 'user'));
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
        if(empty($data)){

            $cupomalimentacaos = $this->cupomalimentacaos->withCriteria([
                new EagerLoad(['aluno']),
                new EagerLoad(['refeicao']),

            ])->all();

            return view('relatorio.meuscupons', compact('cupomalimentacaos'));
        }
    }

    public function listToPay (Request $request, PagamentoAlimentacao $pagamentoalimentacao){
        
        // dd($pagamentoalimentacao);

        $cupomalimentacaos = $this->cupomalimentacaos
                                ->withCriteria([
                                    new EagerLoad(['aluno']),
                                    new EagerLoad(['refeicao']),
                                    new EagerLoad(['aluno.user']),
                                ])
                                ->findWhere('pagamentoalimentacao_id',null)
                                ->where('horario_utilizacao','!=', null);
                                
        // dd($cupomalimentacaos);
        return view('cupomalimentacao.listtopay',compact('cupomalimentacaos', 'pagamentoalimentacao'));
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
    public function update(Request $request, CupomAlimentacao $cupomalimentacao)
    {
        //
        $data = $request->all();
        $pagamentoalimentacao = PagamentoAlimentacao::find($data['pagamento_id']);

        $cupomalimentacao->pagamentoalimentacao()->associate($pagamentoalimentacao);
        $cupomalimentacao->update();
        $pagamentoalimentacao->somaValor($cupomalimentacao->refeicao->valor);
        $pagamentoalimentacao->update();
        return redirect()->route('cupomalimentacao.listtopay', ['pagamentoalimentacao' => $pagamentoalimentacao]); 
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
