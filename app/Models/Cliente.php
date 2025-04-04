<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'codigointerno', 'razaosocial', 'fantasia', 'pessoa', 'cnpj', 'inscrestadual',
        'cpf', 'rg', 'tipoentidade', 'inscricaosuframa', 'cnpjdepositante', 'cep',
        'endereco', 'numero', 'bairro', 'cidade', 'estado', 'pais', 'complemento',
        'telefone', 'codendereco', 'codigosorter', 'sigla', 'endentrega', 'endcobranca',
        'ativo', 'controleshelflife', 'valorshelflife', 'agente', 'empresa_id', 'user_id'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
