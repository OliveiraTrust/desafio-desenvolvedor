@extends('layout.app', ["current" => "produtos"])

@section('body')

<div class="card border">
    <div class="card-body">
        <form action="/produtos/{{$prod->id}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" name="nome" value="{{$prod->nome}}"
                       id="nome" placeholder="Produto">
                
                @if ($errors->has('nome'))
                <div class="invalid-feedback">
                    {{ $errors->first('nome') }}
                </div>
                @endif       
            </div>
            <div class="form-group">
                <label for="estoque">Estoque</label>
                <input type="text" class="form-control  {{ $errors->has('estoque') ? 'is-invalid' : '' }}" name="estoque" value="{{$prod->estoque}}"
                       id="estoque" placeholder="Estoque">
                
                @if ($errors->has('estoque'))
                <div class="invalid-feedback">
                    {{ $errors->first('estoque') }}
                </div>
                @endif         
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="text" class="form-control  {{ $errors->has('preco') ? 'is-invalid' : '' }}" name="preco" value="{{$prod->preco}}"
                       id="preco" placeholder="Preço">
                
                @if ($errors->has('preco'))
                <div class="invalid-feedback">
                    {{ $errors->first('preco') }}
                </div>
                @endif        
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <a class="btn btn-danger btn-sm" href="{{ url('produtos') }}">Cancel</a>
                        
        </form>
    </div>
</div>

@endsection