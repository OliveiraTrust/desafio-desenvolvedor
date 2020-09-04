@extends('layout.app', ["current" => "produtos"])

@section('body')
 
<div class="card border">
    <div class="card-body">
        <form action="/produtos" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome do Produto</label>
                <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" name="nome" id="nome" placeholder="Produto" value="{{ old('nome') }}">
                
                @if ($errors->has('nome'))
                <div class="invalid-feedback">
                    {{ $errors->first('nome') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="estoque">Estoque</label>
                <input type="text" class="form-control  {{ $errors->has('estoque') ? 'is-invalid' : '' }}" name="estoque" id="estoque" placeholder="Estoque" value="{{ old('estoque') }}">
                
                @if ($errors->has('estoque'))
                <div class="invalid-feedback">
                    {{ $errors->first('estoque') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="text" class="form-control  {{ $errors->has('preco') ? 'is-invalid' : '' }}" name="preco" id="preco" placeholder="Preço" value="{{ old('preco') }}">
                
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