<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserAndEmpresaToEmbalagensTable extends Migration
{
    public function up()
    {
        Schema::table('embalagens', function (Blueprint $table) {
            if (!Schema::hasColumn('embalagens', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }

            if (!Schema::hasColumn('embalagens', 'empresa_id')) {
                $table->unsignedBigInteger('empresa_id')->after('user_id');
                $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('embalagens', function (Blueprint $table) {
            if (Schema::hasColumn('embalagens', 'empresa_id')) {
                $table->dropForeign(['empresa_id']);
                $table->dropColumn('empresa_id');
            }

            if (Schema::hasColumn('embalagens', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
}
