@extends('layouts.app')

@section('content')

<div class="container">

    <button onclick="openModalCreateOrder()" name="btn-add" class="btn btn-outline-dark">Adicionar Orderm</button>
    <div class="card card-block">
        <h2 class="card-title">Ordens de compras
        </h2>
    </div>

    <div class="card card-block">
        <form action="{{route('order.search')}}">
            <input type="text" class="form-control" name="insert" placeholder="Procurar" value="">
            <button type="submit" class="btn btn-outline-primary">Filtrar</button>
        </form>
    </div>


    <div>
        <table class="table">
            <thead>
                <tr>
                    @php $reverse = ($sort == 'asc') ? 'desc' : 'asc'; @endphp
                    <th> <a href="{{route('select.order.for',["sort" => $reverse, $param => "id"])}}">ID#</a></th>
                    <th><a href="{{route('select.order.for',["sort" => $reverse, $param => "description"])}}">Descrição</a></th>
                    <th><a href="{{route('select.order.for',["sort" => $reverse, $param => "active"])}}">Status</a></th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="links-list" name="links-list">
                @foreach ($orders as $order)
                    <td>{{$order->id}}</td>
                    <td>{{$order->description}}</td>
                    <td>
                        @if ($order->active == "0")
                        <button class="btn btn-outline-danger">Finalizada</button>
                        
                        @else
                            <button class="btn btn-outline-info">Ativa</button>
                        @endif

                    </td>
                    <td>
                        
                        <button name="btn-edit" onclick="pullDataOrder({{$order->id}})" class="btn btn-outline-info" value="{{$order->id}}">Edit
                        </button>
                        <button class="btn btn-outline-danger" onclick="deleteDataOrder({{$order->id}})" value="{{$order->id}}">Excluir
                        </button>


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="modal fade" id="linkEditorModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="linkEditorModalLabel">Ordem de compra</h4>
                    </div>
                    <div class="modal-body">
                        <form id="modalFormData" name="modalFormData" class="form-horizontal" novalidate="">

                            <div class="form-group">
                                <label for="inputLink" class="col-sm-2 control-label">Descrição</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="Adicione a descrição" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputLink" class="col-sm-2 control-label">Situação</label>
                                <div class="col-sm-12">
                                    <select id="select" class="control-label">
                                        <option value="" disabled selected>Selecine</option>
                                        <option value="1">Ativa</option> 
                                        <option value="0">Finalizada</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        </form>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="saveOrUpdateOrder()" id="btn-save" value="add">Salvar
                        </button>
                        <input type="hidden" id="order_id" name="order_id" value="0">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection