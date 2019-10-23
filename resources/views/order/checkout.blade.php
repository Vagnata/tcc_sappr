@extends('layouts.sappr')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="py-5 text-center">
                    <h2>Confirmar Reserva</h2>
                    <p class="lead">Informe os dados corremente para realização da reserva do anúncio</p>
                    @if($announcement->user_id == \Illuminate\Support\Facades\Auth::id())
                        <div class="alert alert-danger" role="alert">
                            Não é possível reservar seu próprio anúncio!
                        </div>
                    @endif
                </div>
                <form class="form-signin" action="{{ route('store-order') }}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="hidden" name="announcement_id" value="{{$announcement->id}}">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="quantity">Quantidade</label>
                                <input name="quantity" type="number" class="form-control" id="quantity"
                                       placeholder="Quantidade"
                                       value="{{ old('quantity') }}"
                                       max="{{$announcement->current_quantity}}"
                                       required>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="address">Endereço</label>
                                <div class="input-group">
                                    <input name='address' class="form-control" id="address"
                                           placeholder="Av. Calógeras 4123" value="{{old('address')}}"
                                           required>
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="phone">Contato</label>
                                <div class="input-group">
                                    <input name='phone' type="number" class="form-control" id="phone"
                                           placeholder="Telefone para contato"
                                           value="{{old('phone')}}"
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
                        <div class="col-md-4 offset-4">
                            @if($announcement->user_id == \Illuminate\Support\Facades\Auth::id())
                                <button type="button" class="btn btn-lg btn-primary btn-block mb-3" disabled>Salvar</button>
                            @else
                                <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Salvar</button>
                            @endif
                            <a href="{{route('welcome')}}" style="text-decoration: none">
                                <button type="button" class="btn btn-lg btn-secondary btn-block">Voltar</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top"
                         src="{{url('storage/products/' . $announcement->image_path)}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$announcement->product->name}}</h5>
                        <p class="card-text">{{$announcement->name}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Dados Fornecedor</b></li>
                        <li class="list-group-item">{{$announcement->user->name}}</li>
                        <li class="list-group-item">{{$announcement->address}}</li>
                        <li class="list-group-item">{{$announcement->phone}}</li>
                        <li class="list-group-item">Qtd. Disponível: {{$announcement->current_quantity}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
