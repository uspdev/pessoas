<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamposExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campos_extras', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codpes')->unique(); 
            $table->string('nome'); 
            $table->date('data_nascimento')->nullable(); 
            $table->string('sexo')->nullable(); 
            $table->string('pai')->nullable(); 
            $table->string('mae')->nullable(); 
            $table->text('endereco')->nullable(); 
            $table->string('cep')->nullable(); 
            $table->string('cidade')->nullable(); 
            $table->string('uf')->nullable(); 
            $table->string('pais')->nullable();
            $table->string('nacionalidade')->nullable(); 
            $table->string('telefone')->nullable(); 
            $table->string('celular')->nullable(); 
            $table->string('emails')->nullable(); 
            $table->string('cpf')->nullable(); 
            $table->string('rg')->nullable(); 
            $table->string('passaporte')->nullable(); 
            $table->date('validade_visto')->nullable(); 
            $table->string('rne')->nullable(); 
            $table->string('pis')->nullable(); 
            $table->string('lotado')->nullable(); 
            $table->string('banco')->nullable(); 
            $table->string('agencia')->nullable(); 
            $table->string('conta_corrente')->nullable(); 
            $table->string('sigla_universidade')->nullable(); 
            $table->string('docente_usp')->nullable(); 
            $table->string('empenho')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campos_extras');
    }
}
