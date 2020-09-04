<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Produto extends Model
{
   use Sortable;

   protected $table = 'produtos';

   protected $fillable = ['id', 'nome', 'estoque', 'preco'];
   public $sortable = ['id', 'nome', 'estoque', 'preco'];
   
   public function pedido() {
      return $this->hasOne('App\Pedido');
  }

}
