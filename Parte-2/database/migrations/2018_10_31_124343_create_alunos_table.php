<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('endereco_id');
            $table->foreign('endereco_id')->references('id')->on('enderecos');

            $table->unsignedInteger('escola_id');
            $table->foreign('escola_id')->references('id')->on('escolas');

            $table->string('telefone')->default('');
            $table->string('matricula')->default('');
            $table->string('cpf')->default('');
            $table->double('rendaFamiliar')->default(0);
            $table->boolean('auxilioAlimentacao')->default(false);
            $table->boolean('auxilioTransporte')->default(false);
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
        Schema::dropIfExists('alunos');
    }
}
