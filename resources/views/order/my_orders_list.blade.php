@extends('layouts/sappr')

@section('custom-css')
    <link href="{{ asset('css/pricing.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <p class="display-4">Meus pedidos</p>
        <p class="lead">Realize pesquisas com filtros.</p>
        <p class="lead"></p>
        <form class="form-signin form-group" action="{{route('my-orders')}}" method="get">
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="created_at">Data da Reserva</label>
                        <input name="created_at" type="date" class="form-control" id="created_at"
                               value="@if(isset($filter['created_at'])){{ $filter['created_at'] }}@endif">
                    </div>
                    <div class="col-md-6">
                        <label for="sale_status_id">Status</label>
                        <select class="form-control" id="sale_status_id" name="sale_status_id">
                            <option value="">Selecione...</option>
                            @foreach($orderStatus as $status)
                                @if(isset($filter['sale_status_id']) && $status['id'] == $filter['sale_status_id'])
                                    <option selected
                                        value="{{$status['id']}}">{{$status['name']}}</option>
                                @else
                                    <option
                                        value="{{$status['id']}}">{{$status['name']}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 offset-4">
                    <button class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    @if(isset($newOrder))
        <div class="row">
            <div class="col-md-4 offset-4">
                <div class="alert alert-primary" role="alert">
                    Seu pedido for realizado com sucesso, aguarde a confirmação!
                </div>
            </div>
        </div>
    @endif

    @if(!count($orders))
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h4 style="text-align: center">Você ainda não realizou nenhuma reserva. Que tal buscar algo <a
                        href="{{route('welcome')}}">interessante ?</a></h4>
            </div>
        </div>
    @else
        <table class="table container">
            <thead>
            <tr>
                <th>Código</th>
                <th>Fornecedor</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Tipo de Retirada</th>
                <th>Data Reserva</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->announcement->user->name}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->announcement->product->name}}</td>
                    <td>{{$order->getFormattedPriceAttribute()}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->announcement->withdrawType()}}</td>
                    <td>{{$order->getCreatedDateFormatted()}}</td>
                    @if ($order->isAwaitingConfirmation())
                        <td class="orange-color font-weight-bold">{{$order->orderStatus->name}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                        id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    Opções
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button id="deleteButton" class="dropdown-item" type="button"
                                            onclick="cancelarPedido({{$order->id}})">Cancelar
                                    </button>
                                </div>
                            </div>
                        </td>
                    @else
                        @if($order->isConfirmed())
                            <td class="green-color font-weight-bold">{{$order->orderStatus->name}}</td>
                        @elseif($order->isFinalized())
                            <td class="gray-color font-weight-bold">{{$order->orderStatus->name}}</td>
                        @else
                            <td class="red-color font-weight-bold">{{$order->orderStatus->name}}</td>
                        @endif

                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle btn-sm" disabled type="button"
                                        id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    Opções
                                </button>
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@stop
