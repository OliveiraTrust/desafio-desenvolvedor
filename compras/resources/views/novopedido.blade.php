@extends('layout.app', ["current" => "pedidos"])

@section('body')
 
<div class="card border">
    <div class="card-body">
        <form action="/pedidos" method="POST">
            @csrf
            <div class="form-group">
                <label for="produtoPedido">Produto</label>
                <select class="custom-select" id="produtoPedido" name="produtoPedido">
                    <option value="">Escolha...</option>
                    @foreach($prods as $prod)
                        <option value="{{$prod->id}}">{{$prod->nome}}</option>
                    @endforeach   
                </select>
            </div>

            <div class="form-group">
                <label for="clientePedido">Cliente</label>
                <select class="custom-select" id="clientePedido" name="clientePedido">
                        <option value="">Escolha...</option>
                        @foreach($clients as $cli)
                            <option value="{{$cli->id}}">{{$cli->nome}}</option>
                        @endforeach   
                </select>
            </div>           

            <div class="form-group">
                <label for="quantidadePedido">Quantidade</label>
                <input type="text" class="form-control" name="quantidadePedido" id="quantidadePedido" placeholder="Qtd de produtos no Pedido">
            </div>

            <div class="form-group">
                <label for="valorTotalPedido">Valor Total</label>
                <input type="text" class="form-control" name="valorTotalPedido" id="valorTotalPedido" placeholder="Valor Total do Pedido">
            </div>

            <div class="form-group">
                <label for="statusPedido">Status</label>
                <select class="custom-select" id="statusPedido" name="statusPedido">
                        <option>Escolha...</option>
                        <option value="Em aberto">Em aberto</option>
                        <option value="Pago">Pago</option>
                        <option value="Cancelado">Cancelado</option>                        
                </select>
            </div>
  
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <a class="btn btn-danger btn-sm" href="{{ url('pedidos') }}">Cancel</a>
        </form>
    </div>
</div>

@endsection