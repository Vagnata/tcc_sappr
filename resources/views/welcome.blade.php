@extends('layouts/sappr')

@section('custom-css')
    <link href="{{ asset('css/pricing.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        @guest
            <h1 class="display-4">Bem-vindo</h1>
        @else
            <h1 class="display-4">Bem-vindo {{\Illuminate\Support\Facades\Auth::user()['name']}}</h1>
        @endguest
        <p class="lead">Pesquise por produtos e ofertas.</p>
        <form class="form-signin" action="{{ route('welcome') }}" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="buscar" id="buscar" placeholder="" value="@if(isset($buscar)){{$buscar}}@endif">
                <div class="input-group-append">
                    <button class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        @if(!count($announcements))
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h4 style="text-align: center">Nenhum produto disponível no momento. Tente outra busca ou acesse
                        mais tarde.</h4>
                </div>
            </div>
        @else
            <div class="card-deck mb-3 text-center">
                @foreach($announcements as $announcement)
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">{{$announcement->productName}}</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">R${{$announcement->getFormattedPriceAttribute()}}
                                <small class="text-muted">/ {{$announcement->product->unityType->name}}</small>
                            </h1>
                            <img class="img-thumbnail" src="{{url('storage/products/' . $announcement->image_path)}}">
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>{{$announcement->name}}</li>
                                <li class="font-weight-bold">Quantidade Disponível: {{$announcement->quantity}}</li>
                                <li class="font-weight-bold">{{$announcement->withdrawType()}}</li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-block btn-outline-primary">Reservar
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@stop
