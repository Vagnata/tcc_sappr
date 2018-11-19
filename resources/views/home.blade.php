{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Seja Bem-vindo</h1>
    <div>
        <h1>Implementar Filtros</h1>
    </div>
@stop

@section('content')
    @if(!count($announcements))
        <p>Nenhum anúncio ativo.</p>
    @else
        @foreach($announcements as $announcement)
            <div class="col-md-4">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $announcement->name }}</h3>
                        <div class="box-tools pull-right">
                            @if($announcement->local_withdraw)
                                <span class="label label-primary">Retirar Local</span>
                            @else
                                <span class="label label-success">Entrega</span>
                            @endif
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-4">
                            <img src="{{asset("img/$announcement->image_path")}}" height="70px">
                        </div>
                        <div class="col-md-8">
                            <ul>
                                <li>Quantidade: {{$announcement->quantity}}</li>
                                <li>Data Anúncio: {{ \Carbon\Carbon::parse($announcement->begin_date)->format('d/m/Y')}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="box-footer">
                        R$ @convert($announcement->price)/ {{$announcement->product->unityType->name}}
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
