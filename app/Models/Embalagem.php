<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Embalagem extends Model
{
    protected $table = 'embalagens';
    
    protected $fillable = [
        'produto_id',
        'barra',
        'descrereduzida',
        'descr',
        'apresentacao',
        'fatorconv',
        'altura',
        'largura',
        'comprimento',
        'unidadevenda',
        'unidadecompra',
        'lastro',
        'qtdecamada',
        'pesobruto',
        'pesoliquido',
        'empmax',
        'caixafechada',
        'controleestoque',
        'user_id',
        'empresa_id',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
