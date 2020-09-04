@extends('layout.app', ["current" => "clientes"])

@section('body')
 
<div class="card border">
    <div class="card-body">
        <form action="/clientes" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome do Cliente</label>
                <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" name="nome" id="nome" placeholder="Cliente" value="{{ old('nome') }}">
                
                @if ($errors->has('nome'))
                <div class="invalid-feedback">
                    {{ $errors->first('nome') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control  {{ $errors->has('endereco') ? 'is-invalid' : '' }}" name="endereco" id="endereco" placeholder="Endereço" value="{{ old('endereco') }}">
                
                @if ($errors->has('endereco'))
                <div class="invalid-feedback">
                    {{ $errors->first('endereco') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control  {{ $errors->has('telefone') ? 'is-invalid' : '' }}" name="telefone" id="telefone" placeholder="Telefone" value="{{ old('telefone') }}">
                
                @if ($errors->has('telefone'))
                <div class="invalid-feedback">
                    {{ $errors->first('telefone') }}
                </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <a class="btn btn-danger btn-sm" href="{{ url('clientes') }}">Cancel</a>
        </form>
    </div>
</div>

@endsection