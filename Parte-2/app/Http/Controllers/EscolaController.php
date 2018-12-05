<?php

namespace App\Http\Controllers;

use App\Escola;
use Illuminate\Http\Request;
use App\Http\Requests\EscolaStoreRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\UserEscola;
use App\EnderecoEscola;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\EscolaRepository;
use Kurt\Repoist\Repositories\Eloquent\Criteria\EagerLoad;
use Illuminate\Support\Facades\Password;

class EscolaController extends Controller
{
    private $escolas;

    public function __construct(EscolaRepository $escolas)
    {
        $this->escolas = $escolas;
    }

    public function searchSchool($schoolName)
    {
        /*
        debug url
        https://query.wikidata.org/#PREFIX%20wd%3A%20%3Chttp%3A%2F%2Fwww.wikidata.org%2Fentity%2F%3E%0APREFIX%20wdt%3A%20%3Chttp%3A%2F%2Fwww.wikidata.org%2Fprop%2Fdirect%2F%3E%0APREFIX%20wikibase%3A%20%3Chttp%3A%2F%2Fwikiba.se%2Fontology%23%3E%0APREFIX%20p%3A%20%3Chttp%3A%2F%2Fwww.wikidata.org%2Fprop%2F%3E%0APREFIX%20ps%3A%20%3Chttp%3A%2F%2Fwww.wikidata.org%2Fprop%2Fstatement%2F%3E%0APREFIX%20pq%3A%20%3Chttp%3A%2F%2Fwww.wikidata.org%2Fprop%2Fqualifier%2F%3E%0APREFIX%20rdfs%3A%20%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%0APREFIX%20bd%3A%20%3Chttp%3A%2F%2Fwww.bigdata.com%2Frdf%23%3E%0A%0ASELECT%20DISTINCT%20%3Funiversity%20%3FuniversityLabel%20%3Fcoordinate_location%20WHERE%20%7B%0A%20%20SERVICE%20wikibase%3Alabel%20%7B%0A%20%20%20%20bd%3AserviceParam%20wikibase%3Alanguage%20%22%5BAUTO_LANGUAGE%5D%2Cen%22.%20%0A%20%20%7D%0A%20%20%3Funiversity%20wdt%3AP17%20wd%3AQ155.%0A%20%20%3Funiversity%20wdt%3AP31%20wd%3AQ3918.%0A%20%20%3Funiversity%20wdt%3AP625%20%3Fcoordinate_location.%0A%7D
         */
        \EasyRdf_Namespace::set('wd', 'http://www.wikidata.org/entity/');
        \EasyRdf_Namespace::set('wdt', 'http://www.wikidata.org/prop/direct/');
        \EasyRdf_Namespace::set('wikibase', 'http://wikiba.se/ontology#');
        \EasyRdf_Namespace::set('p', 'http://www.wikidata.org/prop/');
        \EasyRdf_Namespace::set('ps', 'http://www.wikidata.org/prop/statement/');
        \EasyRdf_Namespace::set('pq', 'http://www.wikidata.org/prop/qualifier/');
        \EasyRdf_Namespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
        \EasyRdf_Namespace::set('bd', 'http://www.bigdata.com/rdf#');
        $sparql = new \EasyRdf_Sparql_Client('https://query.wikidata.org/sparql');

        $result = $sparql->query(
            'SELECT  ?university ?universityLabel ?coordinate_location WHERE {' .
                'SERVICE wikibase:label {' .
                '        bd:serviceParam wikibase:language "[AUTO_LANGUAGE],en" .' .
                '}' .
                '?university wdt:P17 wd:Q155 .' .
                '        ?university wdt:P31 wd:Q3918 .' .
                '        ?university wdt:P625 ?coordinate_location .' .
                '}'
        );

        foreach ($result as $row) {
            $university = $row->universityLabel->getValue();

            if ($university == $schoolName) {
                $coordinates = explode(' ', trim(
                    str_replace('Point', '', $row->coordinate_location->getValue()),
                    '()'
                ));

                return [
                    // coordenadas vem invertidas
                    'lat' => $coordinates[1],
                    'long' => $coordinates[0],
                ];
            }
        }
        // dd($data);

        return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escolas = $this->escolas->withCriteria([
            new EagerLoad(['user']),
        ])->all();

        return view('escola.index', compact('escolas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('escola.create');

        return view('escola.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EscolaStoreRequest $request)
    {
        $data = $request->all();

        $user = new UserEscola([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->save();

        $endereco = new EnderecoEscola([
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

        $escola = new Escola([
            'cnpj' => $data['cnpj']
        ]);

        $escola->user()->associate($user);
        $escola->endereco()->associate($endereco);
        $escola->save();

        if (env('MAIL_USERNAME') && env('MAIL_PASSWORD')) {
            Password::broker()->sendResetLink(
                ['email' => $data['email']]
            );
        }

        return redirect()->route('escola.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Escola  $escola
     * @return \Illuminate\Http\Response
     */
    public function show(Escola $escola)
    {
        return view('escola.show', compact('escola'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Escola  $escola
     * @return \Illuminate\Http\Response
     */
    public function edit(Escola $escola)
    {
        return view('escola.edit', compact('escola'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Escola  $escola
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Escola $escola)
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

        if ($webSchool = $this->searchSchool($user_data['name'])) {
            $endereco_data['lat'] = $webSchool['lat'];
            $endereco_data['long'] = $webSchool['long'];
        }

        $escola_data = $request->only(
            'cnpj'
        );

        $escola->user()->update($user_data);
        $escola->endereco()->update($endereco_data);
        $escola->update($escola_data);


        return redirect()->route('escola.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Escola  $escola
     * @return \Illuminate\Http\Response
     */
    public function destroy(Escola $escola)
    {
        //
    }
}
