<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('codigointerno')->nullable();
            $table->string('razaosocial');
            $table->string('fantasia')->nullable();
            $table->string('pessoa')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('inscrestadual')->nullable();
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->string('tipoentidade')->nullable();
            $table->string('inscricaosuframa')->nullable();
            $table->string('cnpjdepositante')->nullable();
            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('pais')->nullable();
            $table->string('complemento')->nullable();
            $table->string('telefone')->nullable();
            $table->string('codendereco')->nullable();
            $table->string('codigosorter')->nullable();
            $table->string('sigla')->nullable();
            $table->string('endentrega')->nullable();
            $table->string('endcobranca')->nullable();
            $table->boolean('ativo')->default(true);
            $table->boolean('controleshelflife')->default(false);
            $table->integer('valorshelflife')->nullable();
            $table->string('agente')->nullable();
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
