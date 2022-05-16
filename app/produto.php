<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Produto extends Model
{
    use SoftDeletes;

    public $timestamps = false;
    
    protected $fillable = ['nome', 'tipo', 'preco'];

    protected $dates = ['deleted_at'];
}
