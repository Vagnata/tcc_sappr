@extends('layouts/sappr')

@section('content')
    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastro de Anúncio</h2>
            <p class="lead">Insira os dados para criação do seu anúncio.</p>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form class="form-signin" action="{{ route('store-announcement') }}" method="post"
                      enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="name">Descrição</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="Nome"
                                       value="{{ old('name') }}"
                                       required>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="product_id">Produto</label>
                                <select class="form-control" id="product_id" name="product_id" required>
                                    <option value="">Selecione</option>
                                    @if(isset($products) && !empty($products))
                                        @foreach($products as $product)
                                            @if(isset($announcement) and $announcement['product_id'] == $product['id'])
                                                <option selected
                                                        value="{{$product['id']}}">{{$product['name'] . "($product->unityType->name)"}}</option>
                                            @else
                                                <option
                                                    value="{{$product['id']}}">{{$product['name'] . '(' . ($product->unityType->name) . ')'}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="local_withdraw">Tipo de Retirada</label>
                                <select class="form-control" id="local_withdraw" name="local_withdraw">
                                    @foreach($withdrawTypes as $withdrawType)
                                        @if(isset($withdrawType) && isset($product) && $withdrawType['id'] == $product['local_withdraw'])
                                            <option selected
                                                    value="{{$withdrawType['id']}}">{{$withdrawType['name']}}</option>
                                        @else
                                            <option value="{{$withdrawType['id']}}">{{$withdrawType['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="quantity">Quantidade</label>
                                <input name="quantity" type="number" class="form-control" id="quantity"
                                       placeholder="Quantidade"
                                       value="{{ old('quantity') }}"
                                       required>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="email">Preço</label>
                                <div class="input-group">
                                    <input name='price' type="number" class="form-control" id="price"
                                           placeholder="Preço/Unidade" step="0.1"
                                           value="{{old('price')}}"
                                           required>
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="address">Endereço</label>
                                <div class="input-group">
                                    <input name='address' class="form-control" id="address"
                                           placeholder="Rua Oswaldo Goeldi 123"
                                           value="{{old('address')}}"
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

                            <div class="col-md-4 form-group">
                                <label for="begin_date">Data Início Anúncio</label>
                                <input name="begin_date" type="date" class="form-control" id="begin_date"
                                       value="{{ old('begin_date') }}" required>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="end_date">Data Fim Anúncio</label>
                                <input name="end_date" type="date" class="form-control" id="end_date"
                                       value="{{ old('end_date') }}" required>
                            </div>

                            <div class="col-md-4 offset-4 form-group">
                                <label for="customFile">Foto do Produto</label>
                                <div class="input-group">
                                    <input type="file" class="custom-file-input" id="customFile" name="product_image">
                                    <label class="custom-file-label" for="customFile">Escolha a foto</label>
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
                            <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Salvar</button>
                            <a href="{{route('my-announcements')}}" style="text-decoration: none">
                                <button type="button" class="btn btn-lg btn-secondary btn-block">Voltar</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
