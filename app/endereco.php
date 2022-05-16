<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public $timestamps = false;

    protected $fillable = ['estado','cidade', 'rua', 'bairro', 'numero', 'cep'];

}
