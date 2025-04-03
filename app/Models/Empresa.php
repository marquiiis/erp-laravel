<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'nome',
        'cnpj',
        'endereco',
        'telefone',
        'empresa_admin_id',
    ];

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
    

}
