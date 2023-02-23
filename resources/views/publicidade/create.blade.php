@extends('layouts/index')


@section('content')

    <div class="content-wrapper">
        <!-- Content -->
        <form action="{{ route('publicidade.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Publicidade /</span> Nova Publicidade</h4>


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
                                    <div class="demo-inline-spacing"
                                        style="
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
                                        <select class="form-select" id="exampleFormControlSelect1" name="tipo_pub"
                                            aria-label="Default select example">
                                            <option value="" selected>Selecione uma opção</option>
                                            <option value="1">Banner grande topo "1336x768"</option>
                                            <option value="2">Banner lateral "800x800"</option>
                                            <option value="3">Banner grande meio "1336x768"</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Título <b
                                                style="color:red">*</b></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="Insira o Título" name="titulo_pub" required />
                                    </div>

                                    <!-- <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Vencimento <b
                                                    style="color:red">*</b></label>
                                            <input type="text" class="form-control vencimento"
                                                id="exampleFormControlInput1" placeholder="Insira vencimento"
                                                name="venc_pub" />
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="exampleFormControlInput1" class="form-label">Valor <b
                                                    style="color:red">*</b></label>
                                            <input type="number" class="form-control valor" id="exampleFormControlInput1"
                                                placeholder="Insira valor" name="valor_pub" />
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="exampleFormControlInput1" class="form-label">Valor <b
                                                    style="color:red">*</b></label>
                                            <input type="number" class="form-control valor" id="exampleFormControlInput1"
                                                placeholder="Insira valor" name="valor_pub" />
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="exampleFormControlInput1" class="form-label">E-mail <b
                                                    style="color:red">*</b></label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="email@domain" name="email_pub" required />
                                        </div>
                                        

                                    </div> -->

                                    <div class="row">
                                        <div class="col-sm-8 col-md-10 col-lg-3 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Vencimento <b
                                                    style="color:red">*</b></label>
                                            <input type="text" class="form-control vencimento"
                                                id="exampleFormControlInput1" placeholder="Insira vencimento"
                                                name="venc_pub" />
                                        </div>

                                        <div class="col-sm-4 col-md-2 col-lg-3">
                                            <label for="exampleFormControlInput1" class="form-label">Valor <b
                                                    style="color:red">*</b></label>
                                            <input type="number" class="form-control valor" id="exampleFormControlInput1"
                                                placeholder="Insira valor" name="valor_pub" />
                                        </div>
                                        

                                    </div>
                                    <br>


                                    <div style="display: flex; gap: 40px">
                                    <div class="col-md-5">
                                            <label for="exampleFormControlInput1" class="form-label">E-mail <b
                                                    style="color:red">*</b></label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="email@domain" name="email_pub" required />
                                        </div>
                                        
                                        
                                        <div class="col-md-5">
                                            <label for="exampleFormControlInput1" class="form-label">Telefone</label>
                                            <input type="text" class="form-control telefone"
                                                id="exampleFormControlInput1" placeholder="(00) 0 0000-0000"
                                                name="telefone_pub" />
                                        </div>
                                   
                                    </div>
                                   

                                    <br>

                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Upload foto publicidade <b
                                                style="color:red">*</b></label>
                                        <input class="form-control" type="file" id="formFile"
                                            accept="image/png, image/jpeg" name="foto1_pub" data-image-input required />


                                        <div class="preview"><img data-image-preview style="width:120px"></div>
                                            <label for="exampleFormControlInput1" class="form-label">Link</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="https://" name="link_pub" /><br>
                                            
                                            <div style="display:grid; text-align:left; align-itens:center">
                                                <label for="exampleFormControlTextarea1" class="form-label">Anotações</label>
                                                <textarea style="background-color:#534881; color: #ffffff " class="form-control" name="descr_post"
                                                    id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div><br>
                                            <div style="display:grid; text-align:left; align-itens:center">
                                                <label for="exampleFormControlTextarea1" class="form-label">Conteúdo</label>
                                                <textarea style="background-color:#534881; color: #ffffff " class="form-control" name="descr_post"
                                                    id="editor" rows="3"></textarea>
                                            </div>
                                        
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
        </form>
    </div>

@endsection
