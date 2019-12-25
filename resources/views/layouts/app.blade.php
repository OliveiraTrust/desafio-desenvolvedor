<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Desafio desenvolvedor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    .hidden {
        display: none !important;
        visibility: hidden !important;
    }
    </style>
</head>

<body style="margin-top: 60px" class="container">
    <section>
        <h2 class="card-title">Implementações</h2>
        <a href="{{url("/")}}" class="btn btn-outline-dark">Clientes</a>
        <a href="{{url("/product")}}" class="btn btn-outline-dark">Produtos</a>
        <a href="{{url("/order")}}" class="btn btn-outline-dark">Pedido de Compra</a>
    </section>

    <br>
    
    @yield('content')
    <script src="{{url('js/axios.min.js')}}"></script>
    <script src="{{url('js/jquery-3.1.1.min.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{url('js/app/client/client.js')}}"></script>
    <script src="{{url('js/app/product/product.js')}}"></script>
    <script src="{{url('js/app/purchase-order/purchase-order.js')}}"></script>

</body>

</html>