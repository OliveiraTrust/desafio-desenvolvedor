@extends('layout.app', ["current" => "pedidos"])

@section('body')
<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Lista de Pedidos</h5>

        <div class="container">
        <form action="/pedidos/busca" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" name="q"
                    placeholder="Busca por Status"> <span class="input-group-btn">
                    <button type="submit" class="btn btn-light">
                        <span class="fas fa-search"></span>                        
                    </button>
                </span>
            </div>
        </form>
        </div>

        @if(isset($peds))

        @if(count($peds) > 0)
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>@sortablelink('id', 'Código')</th>
                    <th>@sortablelink('produto.nome','Produto')</th>
                    <th>@sortablelink('cliente.nome', 'Cliente')</th>
                    <th>@sortablelink('quantidade','Quantidade')</th>
                    <th>@sortablelink('valorTotal','Valor Total')</th>
                    <th>@sortablelink('status','Status')</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach($peds as $ped)
                <tr>
                    <td>{{$ped->id}}</td>
                    <td><a href="/produtos/editar/{{$ped->produto->id}}">{{$ped->produto->nome}}</a></td>
                    <td><a href="/clientes/editar/{{$ped->cliente->id}}">{{$ped->cliente->nome}}</a></td>
                    <td>{{$ped->quantidade}}</td>
                    <td>{{$ped->valorTotal}}</td>
                    <td>{{$ped->status}}</td>
                    
                    <td>
                        <a href="/pedidos/editar/{{$ped->id}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="/pedidos/apagar/{{$ped->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>
            @endforeach                
            </tbody>
        </table>
        {!! $peds->appends(Request::except('page'))->render() !!}

        @endif

        @elseif(isset($message))
			<p>{{ $message }}</p>
        @endif  
        
    </div>

    <div class="card-footer">
        <form method="POST" action="/pedidos/apagar">
            @method('DELETE')
            @csrf
             <a href="/pedidos/novo" class="btn btn-sm btn-primary" role="button">Novo Pedido</a>
             <input type="submit" class="btn btn-sm btn-danger delete-ped" value="Apagar todos os Pedidos">
        </form>        
    </div>
    
</div>

<script>
    $('.delete-ped').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Todos os registros serão apagados. Deseja continuar?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
</script>

@endsection