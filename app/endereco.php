<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class endereco extends Model
{
    public $timestamps = false;

    protected $fillable = ['estado','cidade', 'rua', 'bairro', 'numero', 'cep'];

       // retira a máscara com "." e "," antes da inserção 
    public function setcepAttribute($value) {
        $novo1 = str_replace('-', '', $value);  
        $this->attributes['cep'] = $novo1;
    }
}
