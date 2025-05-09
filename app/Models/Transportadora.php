<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportadora extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'codigointerno',
        'razaosocial',
        'fantasia',
        'pessoa',
        'cnpj',
        'inscrestadual',
        'cpf',
        'rg',
        'tipoentidade',
        'inscricaosuframa',
        'cnpjdepositante',
        'cep',
        'endereco',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'pais',
        'complemento',
        'telefone',
        'codendereco',
        'codigosorter',
        'sigla',
        'endentrega',
        'endcobranca',
        'ativo',
        'controleshelflife',
        'valorshelflife',
        'agente',
    ];
}
