<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class venda extends Model
{

    protected $fillable = ['cliente_id', 'produto_id', 'quantidade', 'preco_unitario', 'preco_total'];

    public function setPrecoUnitarioAttribute($value) {
        $novo1 = str_replace('.', '', $value); 
        $novo2 = str_replace(',', '.', $novo1);
        $this->attributes['preco_unitario'] = $novo2;
    }

    public function setPrecoTotalAttribute($value) {
        $novo1 = str_replace('.', '', $value); 
        $novo2 = str_replace(',', '.', $novo1);
        $this->attributes['preco_total'] = $novo2;
    }

    public function clientes() {
        return $this->belongsTo('App\Cliente');
    }

    public function produtos() {
        return $this->belongsTo('App\Produto');
    }
}
