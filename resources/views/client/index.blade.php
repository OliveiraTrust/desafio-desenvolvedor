@extends('layouts.app')

@section('content')

<div class="container">

    <button onclick="openModalCreateClient()" name="btn-add" class="btn btn-outline-dark">Adicionar Cliente</button>
    <div class="card card-block">
        <h2 class="card-title">Administração de clientes
        </h2>
    </div>

    <div class="card card-block">
        <form action="{{route('client.search')}}">
            <input type="text" class="form-control" name="insert" placeholder="Procurar" value="">
            <button type="submit" class="btn btn-outline-primary">Filtrar</button>
        </form>
    </div>


    <div>
        <table class="table">
            <thead>
                <tr>
                    @php $reverse = ($sort == 'asc') ? 'desc' : 'asc'; @endphp
                    <th> <a href="{{route('select.user.for',["sort" => $reverse, $param => "id"])}}">ID#</a></th>
                    <th><a href="{{route('select.user.for',["sort" => $reverse, $param => "name"])}}">Nome</a></th>
                    <th><a href="{{route('select.user.for',["sort" => $reverse, $param => "email"])}}">Email</a></th>
                    <th><a href="{{route('select.user.for',["sort" => $reverse, $param => "phone"])}}">Telefone</a></th>
                    <th><a href="{{route('select.user.for',["sort" => $reverse, $param => "address"])}}">Endereço</a></th>
                    <th><a href="{{route('select.user.for',["sort" => $reverse, $param => "number"])}}">Numero</a></th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="links-list" name="links-list">
                @foreach ($users as $user)
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->number}}</td>
                    <td>
                        <button name="btn-edit" onclick="pullDataClient({{$user->id}})" class="btn btn-outline-info" value="{{$user->id}}">Edit
                        </button>
                        <button class="btn btn-outline-danger" onclick="deleteDataClient({{$user->id}})" value="{{$user->id}}">Excluir
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
                                <label for="inputLink" class="col-sm-2 control-label">E-mail</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="E-mail" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputLink" class="col-sm-2 control-label">Telefone</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Telefone" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputLink" class="col-sm-2 control-label">Endereço</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Endereço" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputLink" class="col-sm-2 control-label">Número</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="number" name="number"
                                        placeholder="Número" value="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="saveOrUpdateClient()" id="btn-save" value="add">Salvar
                        </button>
                        <input type="hidden" id="user_id" name="user_id" value="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection