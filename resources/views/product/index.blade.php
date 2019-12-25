@extends('layouts.app')

@section('content')

<div class="container">

    <button onclick="openModalCreateProduct()" name="btn-add" class="btn btn-outline-dark">Adicionar Produto</button>
    <div class="card card-block">
        <h2 class="card-title">Administração de produtos
        </h2>
    </div>

    <div class="card card-block">
        <form action="{{route('product.search')}}">
            <input type="text" class="form-control" name="insert" placeholder="Procurar" value="">
            <button type="submit" class="btn btn-outline-primary">Filtrar</button>
        </form>
    </div>


    <div>
        <table class="table">
            <thead>
                <tr>
                    @php $reverse = ($sort == 'asc') ? 'desc' : 'asc'; @endphp
                    <th> <a href="{{route('select.product.for',["sort" => $reverse, $param => "id"])}}">ID#</a></th>
                    <th><a href="{{route('select.product.for',["sort" => $reverse, $param => "name"])}}">Nome</a></th>
                    <th><a href="{{route('select.product.for',["sort" => $reverse, $param => "description"])}}">Descrição</a></th>
                    <th><a href="{{route('select.product.for',["sort" => $reverse, $param => "amount"])}}">Quantidade</a></th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="links-list" name="links-list">
                @foreach ($products as $product)
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->amount}}</td>
                    <td>
                        <button name="btn-edit" onclick="pullDataProduct({{$product->id}})" class="btn btn-outline-info" value="{{$product->id}}">Edit
                        </button>
                        <button class="btn btn-outline-danger" onclick="deleteDataProduct({{$product->id}})" value="{{$product->id}}">Excluir
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
                        <h4 class="modal-title" id="linkEditorModalLabel">Por favor informe seus dados</h4>
                    </div>
                        <div class="hidden" id="errors">
                            <div class="alert alert-danger">
                                <ul>
                                        <li id=err></li>
                                </ul>
                            </div>
                    </div>

                    <div class="modal-body">
                        <form id="modalFormData" name="modalFormData" class="form-horizontal" novalidate="">

                            <div class="form-group">
                                <label for="inputLink" class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Nome" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputLink" class="col-sm-2 control-label">Descrição</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="Description" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputLink" class="col-sm-2 control-label">Quantidade</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="amount" name="amount"
                                        placeholder="Quantidade" value="">
                                </div>
                            </div>

                        </div>
                        </form>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="saveOrUpdateProduct()" id="btn-save" value="add">Salvar
                        </button>
                        <input type="hidden" id="product_id" name="product_id" value="0">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection