@extends('layout.app', ["current" => "home"])

@section('body')

<div class="jumbotron bg-light border border-secondary">
    <div class="row">
        <div class="card-deck">
            
            <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Cadastro de Clientes</h5>
                    <p class="card=text">
                    Aqui você cadastra todos os seus clientes.
                    </p>
                    <a href="/clientes" class="btn btn-primary">Cadastre seus clientes</a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Cadastro de produtos</h5>
                    <p class="card=text">
                        Aqui você cadastra todos os seus produtos.                        
                    </p>
                    <a href="/produtos" class="btn btn-primary">Cadastre seus produtos</a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Cadastro de Pedidos</h5>
                    <p class="card=text">
                        Cadastre os Pedidos.<br>
                        Só não se esqueça de cadastrar previamente os Clientes e Produtos
                    </p>
                    <a href="/pedidos" class="btn btn-primary">Cadastre os pedidos</a>
                </div>
            </div>            
        </div>
    </div>
</div>

@endsection