<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmbalagensTable extends Migration
{
    public function up()
    {
        Schema::create('embalagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos')->onDelete('cascade');

            $table->string('codigointerno')->nullable();
            $table->string('barra')->nullable();
            $table->string('descr')->nullable();
            $table->string('descrereduzida')->nullable();
            $table->string('apresentacao')->nullable();
            $table->decimal('fatorconv', 10, 2)->nullable();
            $table->decimal('altura', 8, 2)->nullable();
            $table->decimal('largura', 8, 2)->nullable();
            $table->decimal('comprimento', 8, 2)->nullable();
            $table->string('unidadevenda')->nullable();
            $table->string('unidadecompra')->nullable();
            $table->integer('lastro')->nullable();
            $table->integer('qtdecamada')->nullable();
            $table->decimal('pesobruto', 8, 3)->nullable();
            $table->decimal('pesoliquido', 8, 3)->nullable();
            $table->integer('empmax')->nullable();
            $table->boolean('caixafechada')->default(false);
            $table->boolean('controleestoque')->default(true);
            $table->integer('seqemb')->nullable();
            $table->string('tipoembalagem')->nullable();
            $table->boolean('ativo')->default(true);
            $table->string('precadastro')->nullable();
            $table->string('descrreduzido2')->nullable();
            $table->string('cnpjdepositante')->nullable();
            $table->string('inscrestadualdep')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('embalagens');
    }
}
