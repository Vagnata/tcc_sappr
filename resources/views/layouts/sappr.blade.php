@extends('layouts/sappr_base')
@section('base-content')
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><a href="{{route('welcome')}}">SAPPR</a></h5>
        @guest

            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="#">Features</a>
                <a class="p-2 text-dark" href="#">Enterprise</a>
                <a class="p-2 text-dark" href="#">Support</a>
                <a class="p-2 text-dark" href="{{route('show-register')}}">Cadastrar</a>
            </nav>
            <a class="btn btn-outline-primary" href="{{ route('show-login') }}">Acessar</a>
        @else
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="#">Features</a>
                <a class="p-2 text-dark" href="#">Enterprise</a>
                <a class="p-2 text-dark" href="#">Support</a>
                <a class="p-2 text-dark" href="{{route('show-register')}}">Cadastrar</a>
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
