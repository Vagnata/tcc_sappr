@extends('layouts/sappr')

@section('content')
    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastre-se</h2>
            <p class="lead">Preencha o formulário abaixo para ter acesso a reservas e ofertas dos produtos.</p>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form class="form-signin" action="{{ url('store-announcement') }}" method="post">
                    {!! csrf_field() !!}

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <label for="name">Nome</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="Nome"
                                       value="{{ old('name') }}"
                                       required>
                            </div>

                            <div class="col-md-4">
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <input name='email' type="email" class="form-control" id="email" placeholder="Email"
                                           value="{{old('email')}}"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <label for="email">Senha</label>
                                <div class="input-group">
                                    <input name='password' type="password" class="form-control" id="password"
                                           placeholder="Senha"
                                           required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="password_confirmation">Confirme sua senha</label>
                                <div class="input-group">
                                    <input name='password_confirmation' type="password" class="form-control"
                                           id="password_confirmation" placeholder="Digite novamente a senha"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-warning" role="alert">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Cadastrar</button>
                            <a href="{{route('welcome')}}" style="text-decoration: none">
                                <button type="button" class="btn btn-lg btn-secondary btn-block">Voltar</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
