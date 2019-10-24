@extends('layouts/sappr')

@section('custom-css')
    <link href="{{ asset('css/pricing.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <p class="display-4">Minhas reservas recebidas</p>
        <p class="lead"></p>
        <form class="form-signin form-group" action="{{route('my-announcements')}}" method="get">
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="data_criacao">Data Cadastro</label>
                        <input name="data_criacao" type="date" class="form-control" id="data_criacao"
                               value="{{ old('data_criacao') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4"></div>
                <div>
                    <button class="btn btn-primary">Buscar</button>
                    <a href="{{route('form-announcement')}}">
                        <button type="button" class="btn btn-success">+ Cadastrar</button>
                    </a>
                </div>
            </div>
        </form>
    </div>

    @if(!count($announcements))
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h4 style="text-align: center">Você não possui nenhum anúncio ativo no momento, gostaria de realizar <a
                        href="{{route('form-announcement')}}">um?</a></h4>
            </div>
        </div>
    @else
        <table class="table container">
            <thead>
            <tr>
                <th>Código</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Produto</th>
                <th>Tipo de Retirada</th>
                <th>Data Inicio</th>
                <th>Data Fim</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($announcements as $announcement)
                <tr>
                    <td>{{$announcement->id}}</td>
                    <td>{{$announcement->name}}</td>
                    <td>{{$announcement->getFormattedPriceAttribute()}}</td>
                    <td>{{$announcement->quantity}}</td>
                    <td>{{$announcement->product->name}}</td>
                    <td>{{$announcement->withdrawType()}}</td>
                    <td>{{$announcement->getBeginDateFormatted()}}</td>
                    <td>{{$announcement->getEndDateFormatted()}}</td>
                    @if ($announcement->announcementStatus->isActive())
                        <td class="green-color font-weight-bold">{{$announcement->announcementStatus->name}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                        id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    Opções
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <a href="{{route('form-product', ['id' => $announcement->id])}}">
                                        <button class="dropdown-item" type="button">Editar</button>
                                    </a>
                                    <button id="deleteButton" class="dropdown-item" type="button"
                                            onclick="inativarProduto({{$announcement->id}})">Inativar
                                    </button>
                                </div>
                            </div>
                        </td>
                    @else
                        <td class="red-color font-weight-bold">{{$announcement->productStatus->name}}</td>
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
