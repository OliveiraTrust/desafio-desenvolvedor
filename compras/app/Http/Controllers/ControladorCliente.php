<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Cliente;

class ControladorCliente extends Controller
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
        $col = "id";
        $clients = Cliente::sortable()->paginate(2);
        return view('clientes', compact('clients'));
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
            $clients = Cliente::where ( 'nome', 'LIKE', '%' . $q . '%' )->orWhere ( 'endereco', 'LIKE', '%' . $q . '%' )->paginate (5)->setPath ( '' );
            $pagination = $clients->appends ( array (
                    'q' => Input::get ( 'q' ) 
            ) );
        if (count ( $clients ) > 0)
            return view('clientes', compact('clients','q'));
        }
        $message = 'Nenhum Cliente encontrado com o termo buscado.';
        return view('clientes', compact('message'));        

    }   


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('novocliente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'nome'  => 'required|min:3|unique:clientes|max:20',
            'endereco' => 'required|min:18',
            'telefone' => 'required|min:4'
        ];
        $mensagens = [ 
//            'nome.required' => 'O nome é requerido.',
            'nome.min' => 'É necessário no mínimo 3 caracteres no nome.',
            'required' => 'O atributo :attribute não pode estar em branco.',  // Generico            
        ];
        $request->validate($regras, $mensagens);
        
        $cli = new Cliente();
        $cli->nome = $request->input('nome');
        $cli->endereco = $request->input('endereco');
        $cli->telefone = $request->input('telefone');        
        $cli->save();
        
        return redirect('/clientes');
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
        $cli = Cliente::find($id);
        if(isset($cli)) {
            return view('editarcliente', compact('cli'));
        }
        return redirect('/clientes');
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
        $regras = [
            'nome'  => 'required|min:3|max:20',
            'endereco' => 'required|min:18',
            'telefone' => 'required|min:4'
        ];
        $mensagens = [ 
//            'nome.required' => 'O nome é requerido.',
            'nome.min' => 'É necessário no mínimo 3 caracteres no nome.',
            'required' => 'O atributo :attribute não pode estar em branco.',  // Generico            
        ];
        $request->validate($regras, $mensagens);
        
        $cli = Cliente::find($id);
        if(isset($cli)) {
            $cli->nome = $request->input('nome');
            $cli->endereco = $request->input('endereco');
            $cli->telefone = $request->input('telefone'); 
            $cli->save();
        }
        return redirect('/clientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cli = Cliente::find($id);
        if (isset($cli)) {
            $cli->delete();
        }
        return redirect('/clientes');
    }

    public function destroyAll()
    {
        $clients = Cliente::all();
        if (isset($clients)) {
            foreach ($clients as $cli) {
                $cli->delete();
            }            
        }
        return redirect('/clientes');
    }
    
    /*
     * APIs REST 
     */

    public function indexJson()
    {
        $clients = Cliente::all();
        return $clients->toJson();
    }
}