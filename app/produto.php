<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produto extends Model
{
    protected $fillable = ['nome', 'tipo', 'preco'];

    // retira a máscara com "." e "," antes da inserção 
    public function setPrecoAttribute($value) {
        $novo1 = str_replace('.', '', $value);   
        $novo2 = str_replace(',', '.', $novo1);  
        $this->attributes['preco'] = $novo2;
    }
}
