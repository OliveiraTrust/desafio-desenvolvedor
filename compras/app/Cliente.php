<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable; 

class Cliente extends Model
{
    use Sortable;

    protected $table = 'clientes';

    protected $fillable = ['id', 'nome', 'endereco', 'telefone'];
	public $sortable = ['id', 'nome', 'endereco', 'telefone'];
    
    public function pedido() {
        return $this->hasOne('App\Pedido');
    }   
    
}
