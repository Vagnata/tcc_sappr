@extends('layouts/sappr')

@section('custom-css')
    <link href="{{ asset('css/pricing.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <p class="display-4">Meus anúncios</p>
        <p class="lead">Pesquise por produtos e ofertas.</p>
        <form class="form-signin form-group" action="{{ route('welcome') }}" method="get">


            <div class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="data_criacao">Data Criação</label>
                        <input name="data_criacao" type="date" class="form-control" id="data_criacao"
                               value="{{ old('data_criacao') }}"
                               required>
                    </div>

                    <div class="col-md-4">
                        <label for="tipo_retirada">Tipo Retirada</label>
                        <select name="tipo_retirada" class="form-control">
                            <option value="">Selecione</option>
                            <option value="0">Entrega</option>
                            <option value="1">Local</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4"></div>
                <div>
                    <button class="btn btn-primary">Buscar</button>
                    <button type="button" class="btn btn-success"><a style="text-decoration: none; color: white;" href="{{route('form-announcement')}}">+ Cadastrar</a></button>
                </div>
            </div>
        </form>
    </div>

        @if(!count($announcements))
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h4 style="text-align: center">Você não possui nenhum anúncio ativo no momento, gostaria de realizar
                        um?</h4>
                </div>
            </div>
        @else
            @foreach($announcements as $announcement)
                teste
            @endforeach
            <div class="card-deck mb-3 text-center">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Free</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$0
                            <small class="text-muted">/ mo</small>
                        </h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>10 users included</li>
                            <li>2 GB of storage</li>
                            <li>Email support</li>
                            <li>Help center access</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button>
                    </div>
                </div>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Pro</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$15
                            <small class="text-muted">/ mo</small>
                        </h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>20 users included</li>
                            <li>10 GB of storage</li>
                            <li>Priority email support</li>
                            <li>Help center access</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
                    </div>
                </div>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Enterprise</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$29
                            <small class="text-muted">/ mo</small>
                        </h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>30 users included</li>
                            <li>15 GB of storage</li>
                            <li>Phone and email support</li>
                            <li>Help center access</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
                    </div>
                </div>
            </div>
        @endif
@stop
