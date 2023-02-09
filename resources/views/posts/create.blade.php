@extends('layouts/index')


@section('content')

<form action="{{route('posts.save')}}" method="POST">
    @csrf
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Posts /</span> Nova Postagem</h4>


        <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif



            <!-- Form controls -->
            <div class="col-md-6" style="width: 100%!important; height: 100%!important;">

                <div class="card mb-4">

                    <div class="card-body">
                        
                        <div class="demo-inline-spacing" style="display: flex;justify-content:left;margin-bottom: 10px; margin-top: -10px;">
                            <button type="button" class="btn btn-primary">Voltar</button>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Tipo</label>
                            <select class="form-select" id="exampleFormControlSelect1" name="tipo_post" aria-label="Default select example">
                                <option selected>Selecione uma opção</option>
                                <option value="1">Notícias</option>
                                <option value="2">Destaques</option>
                                <option value="3">Nota de Falecimento</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Título</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Insira o Título" name="titulo_post" />
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Sub-título</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Sub-título" name="sub_titulo_post" />
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload Imagem</label>
                            <input class="form-control" type="file" id="image" name="foto_post" />
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Upload Várias Imagens</label>
                            <input class="form-control" type="file" id="formFileMultiple" multiple name="fotos_post" />
                        </div>

                        <label for="formFileMultiple" class="form-label">Status</label>
                        <div class="mb-3">

                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="status_post" value="on" id="btnradio1" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="btnradio1">Habilitado</label>
                                <input type="radio" class="btn-check" name="status_post" value="off" id="btnradio2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio2">Desabilitado</label>

                            </div>
                        </div>

                        

                        <div>
                            <label for="exampleFormControlTextarea1" class="form-label">Texto</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="height: 300px!important;" name="texto_post"></textarea>
                        </div>
                        <div class="demo-inline-spacing" style="display: flex;justify-content:right; ">

                            <button type="submit" class="btn btn-success">Post</button>
                            <!-- <button type="button" class="btn btn-danger">Delete</button> -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection