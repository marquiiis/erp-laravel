<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserAndEmpresaToProdutosTable extends Migration
{
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            if (!Schema::hasColumn('produtos', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }

            if (!Schema::hasColumn('produtos', 'empresa_id')) {
                $table->unsignedBigInteger('empresa_id')->after('user_id');
                $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            if (Schema::hasColumn('produtos', 'empresa_id')) {
                $table->dropForeign(['empresa_id']);
                $table->dropColumn('empresa_id');
            }

            if (Schema::hasColumn('produtos', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
}
