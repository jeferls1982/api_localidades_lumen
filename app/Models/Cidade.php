<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Estado;


class Cidade extends Model
{
    protected $table = "cidades";

    protected $fillable = [
        'nome', 'sigla', "estado_id"
    ];


    public function estado()
    {
        return $this->belongsTo(Estado::class)->with("pais");
    }
}
