@extends('layout.app', ["current" => "pedidos"])

@section('body')

<div class="card border">
    <div class="card-body">
        <form action="/pedidos/{{$ped->id}}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="produtoPedido">Produto</label>
                   
                    <select class="custom-select" id="produtoPedido" name="produtoPedido">
                        <option>Escolha...</option>
                        @foreach($prods as $prod)
                            <option value="{{$prod->id}}" @if($prod->id == $ped->produto_id) {{" Selected"}} @endif >{{$prod->nome}}</option>
                        @endforeach   
                    </select>
                </div>
                <div class="form-group col-md-6">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="clientePedido">Cliente</label>
                   
                    <select class="custom-select" id="clientePedido" name="clientePedido">
                        <option>Escolha...</option>
                        @foreach($clients as $cli)
                            <option value="{{$cli->id}}" @if($cli->id == $ped->cliente_id) {{" Selected"}} @endif >{{$cli->nome}}</option>
                        @endforeach   
                    </select>
                </div>
                <div class="form-group col-md-6">
                </div>
            </div>           

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="quantidadePedido">Quantidade</label>
                    <input type="text" class="form-control" name="quantidadePedido" value="{{$ped->quantidade}}" 
                       id="quantidadePedido" placeholder="Qtd de produtos no Pedido">
                </div>
                <div class="form-group col-md-6">
                </div>

                
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="valorTotalPedido">Valor Total</label>
                    <input type="text" class="form-control" name="valorTotalPedido" value="{{$ped->valorTotal}}" 
                       id="valorTotalPedido" placeholder="Valor Total do Pedido">
                </div>
                <div class="form-group col-md-6">
                </div>
            </div>    

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="statusPedido">Status</label>
                   
                    <select class="custom-select" id="statusPedido" name="statusPedido">
                        <option>Escolha...</option>
                        <option value="Em aberto" @if($ped->status == 'Em aberto') {{" Selected"}} @endif >Em aberto</option>
                        <option value="Pago" @if($ped->status == 'Pago') {{" Selected"}} @endif >Pago</option>
                        <option value="Cancelado" @if($ped->status == 'Cancelado') {{" Selected"}} @endif >Cancelado</option>                        
                    </select>
                </div>
                <div class="form-group col-md-6">
                </div>
            </div>   
            

            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <button type="reset" class="btn btn-danger btn-sm">Cancel</button>
        </form>
    </div>
</div>

@endsection