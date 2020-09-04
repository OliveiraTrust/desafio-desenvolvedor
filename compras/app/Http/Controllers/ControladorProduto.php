<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Produto;

class ControladorProduto extends Controller
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
        $prods = Produto::sortable()->paginate(2);
        return view('produtos', compact('prods'));        
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
            $prods = Produto::where ( 'nome', 'LIKE', '%' . $q . '%' )->paginate (5)->setPath ( '' );
            $pagination = $prods->appends ( array (
                    'q' => Input::get ( 'q' ) 
            ) );
        if (count ( $prods ) > 0)
            return view('produtos', compact('prods','q'));
        }
        $message = 'Nenhum Produto encontrado com o termo buscado.';
        return view('produtos', compact('message'));        

    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prods = Produto::all();
        return view('novoproduto', compact('prods'));        
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
            'nome'  => 'required|min:3|unique:produtos|max:20',
            'estoque' => 'required',
            'preco' => 'required'
        ];
        $mensagens = [ 
//            'nome.required' => 'O nome é requerido.',
            'nome.min' => 'É necessário no mínimo 3 caracteres no nome.',
            'required' => 'O atributo :attribute não pode estar em branco.',  // Generico            
        ];
        $request->validate($regras, $mensagens);
        
        $prod = new Produto();
        $prod->nome = $request->input('nome');
        $prod->estoque = $request->input('estoque');
        $prod->preco = $request->input('preco');       
        $prod->save();
        return redirect('/produtos');
        //return json_encode($prod);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $prod = Produto::find($id);
       if(isset($prod)) {
           return json_encode($prod);
       }        
       return response('Produto não encontrado',404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prod = Produto::find($id);
        if(isset($prod)) {
            return view('editarproduto', compact('prod'));
        }
        return redirect('/produtos');
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
            'nome'  => 'required|min:3|unique:produtos|max:20',
            'estoque' => 'required',
            'preco' => 'required'
        ];
        $mensagens = [ 
//            'nome.required' => 'O nome é requerido.',
            'nome.min' => 'É necessário no mínimo 3 caracteres no nome.',
            'required' => 'O atributo :attribute não pode estar em branco.',  // Generico            
        ];
        $request->validate($regras, $mensagens);
       
        $prod = Produto::find($id);
       if(isset($prod)) {
            $prod->nome = $request->input('nome');
            $prod->estoque = $request->input('estoque');
            $prod->preco = $request->input('preco');            
            $prod->save();
            //return json_encode($prod);
       }        
       return redirect('/produtos');
       //return response('Produto não encontrado',404);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = Produto::find($id);
        if (isset($prod)) {
            $prod->delete();
        }
        //return response('Produto não encontrado',404);
        return redirect('/produtos');
    }

    public function destroyAll()
    {
        $prods = Produto::all();
        if (isset($prods)) {
            foreach ($prods as $prod) {
                $prod->delete();
            }            
        }
        return redirect('/produtos');
    }

    /*
     * APIs REST 
     */

    public function indexJson()
    {
        $prods = Produto::all();
        //return json_encode($prods);
        return $prods->toJson();
    }



}
