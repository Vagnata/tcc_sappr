@extends('layouts/sappr')

@section('custom-css')
    <link href="{{ asset('css/pricing.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <p class="display-4">Meus anúncios</p>
        <p class="lead"></p>
        <form class="form-signin form-group" action="{{route('my-announcements')}}" method="get">
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <label for="tipo_retirada">Tipo Retirada</label>
                        <select class="form-control" id="tipo_retirada" name="tipo_retirada">
                            <option value="">Selecione...</option>
                            @foreach($withdrawTypes as $withdrawType)
                                @if(isset($filter['tipo_retirada']) and $withdrawType['id'] == $filter['tipo_retirada'])
                                    <option selected
                                            value="{{$withdrawType['id']}}">{{$withdrawType['name']}}</option>
                                @else
                                    <option value="{{$withdrawType['id']}}">{{$withdrawType['name']}}</option>
                                @endif
                            @endforeach
                        </select>
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
                <th>Qtd. Inicial</th>
                <th>Qtd. Atual</th>
                <th>Produto</th>
                <th>Tipo de Retirada</th>
                <th>Data Inicio</th>
                <th>Data Fim</th>
                <th>Status</th>
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
                    <td>{{$announcement->current_quantity}}</td>
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
                                    <button id="deleteButton" class="dropdown-item" type="button"
                                            onclick="inativarAnuncio({{$announcement->id}})">Inativar
                                    </button>
                                </div>
                            </div>
                        </td>
                    @else
                        <td class="red-color font-weight-bold">{{$announcement->announcementStatus->name}}</td>
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
