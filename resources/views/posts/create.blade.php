@extends('layouts/index')


@section('content')

<div class="content-wrapper">
    <!-- Content -->
    <form action="{{route('posts.save')}}" method="POST" enctype="multipart/form-data">
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
                                    <label for="exampleFormControlSelect1" class="form-label">Tipo <b
                                        style="color:red">*</b></label>
                                    <select class="form-select" id="exampleFormControlSelect1" name="tipo_post" aria-label="Default select example">
                                        <option value="" selected>Selecione uma opção</option>
                                        <option value="Notícias">Notícias</option>
                                        <option value="2">Destaques</option>
                                        <option value="3">Nota de Falecimento</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Título <b
                                        style="color:red">*</b></label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Insira o Título" name="titulo_post" />
                                </div>



                                <div style="display: flex; gap: 60px;">
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Legendas</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Insira legenda" name="legenda_post" />
                                    </div>
                                    <div class="col-md-5">
                                        <label for="exampleFormControlInput1" class="form-label">Video</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="https://..." name="video_post" />
                                    </div>


                                </div>
                                <br>

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload Imagem Capa <b
                                        style="color:red">*</b></label>
                                    <input class="form-control" type="file" id="formFile" accept="image/png, image/jpeg" name="foto1_post" data-image-input />
                                    <div class="preview"><img data-image-preview style="width:120px"></div>
                                    <label for="formFileMultiple" class="form-label">Upload Imagens Conteudo</label>
                                    <input class="form-control" type="file" id="formFileMultiple" accept="image/png, image/jpeg" name="foto2_post" multiple />
                                </div>
                                <div class="mb-3">
                                    
                                </div>

                                <div>

                                   <label for="exampleFormControlTextarea1" class="form-label" >Texto <b
                                    style="color:red">*</b></label>

                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="texto_post" style="height: 300px !important"></textarea>
                                </div>



                                <div class="demo-inline-spacing" style="display: flex; justify-content: right">

                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </form>
</div>


@endsection
