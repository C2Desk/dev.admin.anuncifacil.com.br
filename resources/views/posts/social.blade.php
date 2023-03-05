@extends('layouts/index')


@section('content')

<div class="content-wrapper">
    <!-- Content -->
    <!-- <form action="{{route('posts.save')}}" method="POST" enctype="multipart/form-data"> -->
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Posts /</span> Nova Postagem em Redes Sociais</h4>


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


                <div class="row">
                    <!-- Form controls -->
                    <div class="col-md-6" style="width: 100% !important; height: 100% !important">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="demo-inline-spacing" style="
                          display: flex;
                          justify-content: left;
                          margin-bottom: 10px;
                          margin-top: -10px;
                        ">
                                    <!--<button type="button" class="btn btn-primary">
                                        Voltar
                                    </button>-->
                                </div>
                                <div class="form-check form-switch mb-3" style="justify-content:right; display:flex; gap:60px ">

                                        <label class="form-check-label" for="flexSwitchCheckChecked">Status</label>

                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                            name="status_pub" value="on" checked />
                                    </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Grupo <b
                                        style="color:red">*</b></label>
                                    <select class="form-select" id="exampleFormControlSelect1" name="tipo_post" aria-label="Default select example">
                                        <option value="" selected>Selecione uma opção</option>
                                        <option value="Social">* Amig*s da Notícia</option>

                                    </select>
                                </div>

                                <div class="row">

                                <div class="mb-3">
                                    <label for="formFileMultiple" class="form-label">Upload Imagens </label>
                                    <input class="form-control" type="file" id="formFileMultiple" accept="image/png, image/jpeg" name="foto2_post" multiple />
                                </div>


                                <div>

                                   <label for="exampleFormControlTextarea1" class="form-label" >Texto <b
                                    style="color:red">*</b></label>

                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="texto_post" style="height: 300px !important"></textarea>
                                </div>



                                <div class="demo-inline-spacing" style="display: flex; justify-content: right">
                                                <button type="submit" class="btn btn-danger">Cancelar</button>
                                                <!-- <button type="submit" class="btn btn-primary">Enviar</button> -->
                                                <button type="submit" class="btn btn-success">Enviar</button>
                                            </div>
                            </div>



                        </div>
                    </div>
                </div>
    </form>
</div>


@endsection

