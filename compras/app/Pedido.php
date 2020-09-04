<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Pedido extends Model
{
    use Sortable;

    protected $table = 'pedidos';

    protected $fillable = ['id', 'produto.nome', 'cliente.nome', 'quantidade', 'valorTotal','status'];
	public $sortable = ['id', 'produto.nome', 'cliente.nome', 'quantidade', 'valorTotal','status'];
   
    public function cliente() {
        return $this->belongsTo('App\Cliente','cliente_id','id');
    }

    public function produto() {
        return $this->belongsTo('App\Produto','produto_id','id');
    }
   
}
