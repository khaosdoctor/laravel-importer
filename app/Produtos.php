<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    //Nome da tabela
    protected $table = 'produtos';
    //Chave primária'
    protected $primaryKey = 'lm';
    //Define que a chave primária não é incremental
    public $incrementing = false;
    //Define os campos que podem ser preenchidos programaticamente
    protected $fillable = ['lm','name','free_shipping','description','price','category'];
}
