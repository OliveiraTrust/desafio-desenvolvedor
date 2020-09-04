@extends('layout.app', ["current" => "produtos"])

@section('body')
<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Produtos</h5>

        <div class="container">
        <form action="/produtos/busca" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" name="q"
                    placeholder="Busca"> <span class="input-group-btn">
                    <button type="submit" class="btn btn-light">
                        <span class="fas fa-search"></span>                        
                    </button>
                </span>
            </div>
        </form>
        </div>

        @if(isset($prods))

        @if(count($prods) > 0)
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>@sortablelink('id','Código')</th>
                    <th>@sortablelink('nome')</th>
                    <th>@sortablelink('estoque')</th>
                    <th>@sortablelink('preco','Preço')</th>                    
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach($prods as $prod)
                <tr>
                    <td>{{$prod->id}}</td>
                    <td>{{$prod->nome}}</td>
                    <td>{{$prod->estoque}}</td>
                    <td>{{$prod->preco}}</td>                    
                    <td>
                        <a href="/produtos/editar/{{$prod->id}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="/produtos/apagar/{{$prod->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>
            @endforeach                
            </tbody>
        </table>
        {!! $prods->appends(Request::except('page'))->render() !!}

        @endif 
        
        @elseif(isset($message))
			<p>{{ $message }}</p>
        @endif 
            
    </div>

    <div class="card-footer">
        <form method="POST" action="/produtos/apagar">
            @method('DELETE')
            @csrf
             <a href="/produtos/novo" class="btn btn-sm btn-primary" role="button">Novo Produto</a>
             <input type="submit" class="btn btn-sm btn-danger delete-prod" value="Apagar todos os produtos">
        </form>        
    </div>

</div>

<script>
    $('.delete-prod').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Todos os registros serão apagados. Deseja continuar?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
</script>

@endsection