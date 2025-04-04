<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstoqueToProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->integer('estoque')->default(0)->after('precomax');
        });
    }
    
    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('estoque');
        });
    }

}
