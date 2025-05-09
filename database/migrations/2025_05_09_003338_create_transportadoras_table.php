<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transportadoras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id'); // FK obrigatória

            $table->string('codigointerno');
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
            $table->enum('ativo', ['Sim', 'Não'])->default('Sim');
            $table->string('controleshelflife')->nullable();
            $table->integer('valorshelflife')->nullable();
            $table->string('agente')->nullable();

            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transportadoras');
    }
};
