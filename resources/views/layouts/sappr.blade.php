@extends('layouts/sappr_base')

@section('base-content')
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><a style="text-decoration: none" href="{{route('welcome')}}">SAPPR</a>
            @auth()
                <nav class="my-2 my-md-0 mr-md-3 float-right">
                    <i><span class="p-2 text-dark" href="{{route('welcome')}}"> {{Auth::user()->name}}
                            ({{Auth::user()->email}})</span></i>
                </nav>
            @endauth
        </h5>

        @guest

            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="{{route('show-register')}}">Cadastrar</a>
            </nav>
            <a class="btn btn-outline-primary" href="{{ route('show-login') }}">Acessar</a>
        @else
            @if (User::isAdmin())
                <nav class="my-2 my-md-0 mr-md-3">
                    <a class="p-2 text-dark" href="{{route('products')}}">Produtos</a>
                </nav>
            @endif
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="{{route('my-announcements')}}">Meus anúncios</a>
            </nav>
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="{{route('my-orders')}}">Meus pedidos</a>
            </nav>
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="{{route('received-orders')}}">Pedidos Recebidos</a>
            </nav>
            <a class="btn btn-outline-primary" href="<?= route('logout'); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sair</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endguest
    </div>
    @yield('content')
@endsection
