<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'codigointerno',
        'codreferencia',
        'descr',
        'tipoprod',
        'subtipoprod',
        'marca',
        'submarca',
        'ncm',
        'ativo',
        'manufaturado',
        'sazonal',
        'codtipoprod',
        'codigoprodanvisa',
        'cnpjfamilia',
        'prazovalidade',
        'prazocomercializacao',
        'prazocritico',
        'precomax',
        'user_id',
        'empresa_id',
        'estoque'
    ];

    public function embalagem()
    {
        return $this->hasOne(Embalagem::class);
    }
}
