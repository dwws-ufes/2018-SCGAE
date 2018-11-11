<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCupomAlimentacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupom_alimentacaos', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('refeicao_id');
            $table->foreign('refeicao_id')->references('id')->on('refeicaos');

            $table->unsignedInteger('aluno_id');
            $table->foreign('aluno_id')->references('id')->on('alunos');

            $table->unsignedInteger('pagamentoalimentacao_id')->nullable()->default(null);
            $table->foreign('pagamentoalimentacao_id')->references('id')->on('pagamento_alimentacaos');
            
            $table->time('horario_utilizacao')->nullable()->default(NULL);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cupom_alimentacaos');
    }
}
