<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class telefone extends Model
{
    protected $fillable = ['numero',  'clientes_id'];

    // retira a máscara com "." e "," antes da inserção 
    public function setNumeroAttribute($value) {
        $novo1 = str_replace('(', '', $value);    
        $novo2 = str_replace(')', '', $novo1); 
        $novo3 = str_replace('-', '', $novo2);
        $this->attributes['numero'] = $novo3;
    }

    public function clientes() {
        return $this->belongsTo('App\Cliente');
    }
}
