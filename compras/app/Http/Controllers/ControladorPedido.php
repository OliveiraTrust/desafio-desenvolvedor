<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Builder;

use App\Pedido;
use App\Cliente;
use App\Produto;
use DB;

class ControladorPedido extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexView()
    {
        //$peds = DB::table('pedidos')
       //->join('produtos', 'produtos.id', '=', 'pedidos.produto_id')
       //->join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
      // ->select('pedidos.id', 'produtos.nome as produto', 'clientes.nome as cliente', 'pedidos.quantidade', 'pedidos.valorTotal', 'pedidos.status');

       // $peds = $peds->sortable()->paginate(2);

        //return view('pedidos', compact('peds'));
        
        $peds = Pedido::with(['cliente','produto'])->sortable()->paginate(2);
        //$clients = Cliente::all();
        //$prods = Produto::all();
        return view('pedidos', compact('peds'));           
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchView()
    {
        $q = Input::get ('q');
        
        if($q != ""){

            $peds = Pedido::where ( 'status', 'LIKE', '%' . $q . '%' )->paginate (5)->setPath ( '' );
            $pagination = $peds->appends ( array (
                    'q' => Input::get ( 'q' ) 
            ));
        if (count ( $peds ) > 0)
            return view('pedidos', compact('peds','q'));
        }
        $message = 'Nenhum Pedido encontrado com o termo buscado.';
        return view('pedidos', compact('message'));        

    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Cliente::all();
        $prods = Produto::all();
        return view('novopedido', compact('clients','prods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ped = new Pedido();
        $ped->produto_id = $request->input('produtoPedido');
        $ped->cliente_id = $request->input('clientePedido');
        $ped->quantidade = $request->input('quantidadePedido');
        $ped->valorTotal = $request->input('valorTotalPedido');
        $ped->status = $request->input('statusPedido');
        $ped->save();
        return redirect('/pedidos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ped = Pedido::find($id);
        $clients = Cliente::all();
        $prods = Produto::all();
        if(isset($ped)) {
            return view('editarpedido', compact('ped','clients','prods'));
        }
        return redirect('/pedidos');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ped = Pedido::find($id);
        if(isset($ped)) {
            $ped->produto_id = $request->input('produtoPedido');
            $ped->cliente_id = $request->input('clientePedido');
            $ped->status = $request->input('statusPedido');
            $ped->quantidade = $request->input('quantidadePedido');
            $ped->valorTotal = $request->input('valorTotalPedido');
            $ped->save();
        }
        return redirect('/pedidos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ped = Pedido::find($id);
        if (isset($ped)) {
            $ped->delete();
        }
        return redirect('/pedidos');
    }

    public function destroyAll()
    {
        $peds = Pedido::all();
        if (isset($peds)) {
            foreach ($peds as $ped) {
                $ped->delete();
            }            
        }
        return redirect('/pedidos');
    }
    
    /*
     * APIs REST 
     */

    public function indexJson()
    {
        $peds = Pedido::all();
        return $peds->toJson();
    }
}