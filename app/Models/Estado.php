<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pais;


class Estado extends Model
{
    protected $table = "estados";

    protected $fillable = [
        'nome', 'sigla', "pais_id"
    ];


    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function cidades()
    {
        return $this->hasMany(Cidade::class);
    }
}
