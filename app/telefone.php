<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{

    public $timestamps = false;

    protected $fillable = ['numero',  'clientes_id'];


    public function clientes() {
        return $this->belongsTo('App\Cliente');
    }
}
