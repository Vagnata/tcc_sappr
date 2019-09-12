@extends('layouts/sappr')

@section('content')
    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastrar Produto</h2>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form class="form-signin" action="{{ route('store-product') }}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Nome</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="Nome"
                                       value="{{ old('name') }}"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label for="unity_type">Tipo de Medida</label>
                                <select class="form-control" id="unity_type" name="unity_type_id">
                                    @foreach($unityTypes as $unityType)
                                        <option value="{{$unityType['id']}}">{{$unityType['name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{--<div class="col-md-4">--}}
                                {{--<label for="customFile">Imagem</label>--}}
                                {{--<div class="input-group">--}}
                                    {{--<<input type="file" class="custom-file-input" id="customFile" name="product_image">--}}
                                    {{--<label class="custom-file-label" for="customFile">Choose file</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="row">
                            <div class="offset-4 col-md-4">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-warning" role="alert">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="offset-4 col-md-4">
                            <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Salvar</button>
                            <a href="{{route('products')}}" style="text-decoration: none">
                                <button type="button" class="btn btn-lg btn-secondary btn-block">Voltar</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@stop
