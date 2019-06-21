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
                <input type="text" class="form-control" id="search" placeholder="">
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
                    <h4 style="text-align: center">Nenhum produto disponível no momento. Tente outra busca ou acesse mais tarde.</h4>
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
    </div>
@stop
