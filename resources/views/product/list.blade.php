@extends('layouts/sappr')

@section('custom-css')
    <link href="{{ asset('css/pricing.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <p class="display-4">Lista de Produtos</p>
        <form class="form-signin form-group" action="{{ route('welcome') }}" method="get">
            <div class="mb-12">
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4 form-group">
                        <input class="form-control" name="nome" id="nome" type="text" placeholder="Busque por nome">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <button class="btn btn-primary">Buscar</button>
                    <a href="{{route('form-product')}}">
                        <button type="button" class="btn btn-success">+ Cadastrar</button>
                    </a>
                </div>
            </div>
        </form>
    </div>

    @if(!count($products))
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h4 style="text-align: center">Nenhum produto cadastrado</h4>
            </div>
        </div>
    @else
        <table class="table container">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Tipo de Unidade</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->unityType->name}}</td>
                    <td>{{$product->productStatus->name}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@stop
