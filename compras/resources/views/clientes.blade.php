@extends('layout.app', ["current" => "clientes"])

@section('body')
<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Clientes</h5>

        <div class="container">
        <form action="/clientes/busca" method="POST" role="search">
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
        @if(isset($clients))

            @if(count($clients) > 0)
            <table class="table table-ordered table-hover">
                <thead>
                    <tr>
                        <th>@sortablelink('id','Código')</th>
                        <th>@sortablelink('nome')</th>
                        <th>@sortablelink('endereco','Endereço')</th>
                        <th>@sortablelink('telefone')</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($clients as $key => $cli)
                    <tr>
                        <td>{{$cli->id}}</td>
                        <td>{{$cli->nome}}</td>
                        <td>{{$cli->endereco}}</td>
                        <td>{{$cli->telefone}}</td>
                        <td>
                            <a href="/clientes/editar/{{$cli->id}}" class="btn btn-sm btn-primary">Editar</a>
                            <a href="/clientes/apagar/{{$cli->id}}" class="btn btn-sm btn-danger">Apagar</a>
                        </td>
                    </tr>
                @endforeach                
                </tbody>
            </table>
            {!! $clients->appends(Request::except('page'))->render() !!}

            
            @endif 

        @elseif(isset($message))
			<p>{{ $message }}</p>
		@endif
    </div>
    <div class="card-footer">
        <form method="POST" action="/clientes/apagar">
            @method('DELETE')
            @csrf
             <a href="/clientes/novo" class="btn btn-sm btn-primary" role="button">Novo Cliente</a>
             <input type="submit" class="btn btn-sm btn-danger delete-user" value="Apagar todos os clientes">
        </form>        
    </div>
</div>

<script>
    $('.delete-user').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Todos os registros serão apagados. Deseja continuar?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
</script>

@endsection

