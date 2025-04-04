<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosCompletoTable extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('codigointerno');
            $table->string('codreferencia')->nullable();
            $table->string('descr');
            $table->string('tipoprod')->nullable();
            $table->string('subtipoprod')->nullable();
            $table->string('marca')->nullable();
            $table->string('submarca')->nullable();
            $table->string('ncm')->nullable();
            $table->boolean('ativo')->default(true);
            $table->boolean('manufaturado')->default(false);
            $table->boolean('sazonal')->default(false);
            $table->string('codtipoprod')->nullable();
            $table->string('codigoprodanvisa')->nullable();
            $table->string('cnpjfamilia')->nullable();
            $table->integer('prazovalidade')->nullable();
            $table->integer('prazocomercializacao')->nullable();
            $table->integer('prazocritico')->nullable();
            $table->decimal('precomax', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
