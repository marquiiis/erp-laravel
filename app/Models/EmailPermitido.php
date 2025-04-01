<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailPermitido extends Model
{
    protected $table = 'emails_permitidos'; // 👈 adicione isso se ainda não tiver

    protected $fillable = ['email', 'empresa_id'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
