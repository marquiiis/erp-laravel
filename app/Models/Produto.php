<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Produto extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }


    protected $fillable = [
        'nome',
        'codigo',
        'estoque_minimo',
    ];
}
