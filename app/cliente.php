<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    public $timestamps = false;

    protected $fillable = ['nome' , 'cpf'];

    // retira a máscara com "." e "," antes da inserção 
    public function setCpfAttribute($value) {
        $novo1 = str_replace('.', '', $value);    // retira o ponto
        $novo2 = str_replace('-', '', $novo1);   // substitui a , por .
        $this->attributes['cpf'] = $novo2;
    }
    
}
