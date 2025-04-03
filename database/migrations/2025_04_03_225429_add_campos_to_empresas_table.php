<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('cnpj')->nullable()->after('nome');
            $table->string('endereco')->nullable()->after('cnpj');
            $table->string('telefone')->nullable()->after('endereco');
        });
    }
    
    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn(['cnpj', 'endereco', 'telefone']);
        });
    }
}
