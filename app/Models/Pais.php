<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Pais extends Model
{
    protected $table = "pais";

    protected $fillable = [
        'nome', 'sigla',
    ];

    public function estados()
    {
        return $this->hasMany(Estado::class, "pais_id")->with("cidades");
    }
}
