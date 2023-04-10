@extends('layouts/index')


@section('content')
        <form action="{{ route('posts.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Posts /</span> Edit Postagem</h4>

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
                        <input type="hidden" value="{{ $post->id }}" name="id_post" />

                        <div class="col-md-6" style="width: 100% !important; height: 100% !important">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="demo-inline-spacing" style="display: flex; justify-content: left; margin-bottom: 10px; margin-top: -10px;">
                                        <!--<button type="button" class="btn btn-primary">
                                        Voltar
                                    </button>-->
                                    </div>
                                    <div class="form-check form-switch mb-2" style="justify-content:right; display:flex; gap:10px ">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                            name="status_post" value="on"  {{'on' ==  $post->status  ? 'checked' : ''}} />
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Destaque</label>
                                    </div>

                                    <div class="mb-3">

                                        <label for="exampleFormControlSelect1" class="form-label">Tipo <b style="color:red">*</b></label>
                                        <select class="form-select" id="exampleFormControlSelect1" name="tipo_post"
                                            aria-label="Default select example">
                                            <option value = "">Selecione uma opção</option>
                                            <option value="Bombeiros"             {{"Bombeiros" == $post->tipo ? 'selected' : ''}} >Bombeiros</option>
                                            <option value="Catedral Cristo Rei"   {{"Catedral Cristo Rei" == $post->tipo ? 'selected' : ''}} >Catedral Cristo Rei</option>
                                            <option value="Classificados"         {{"Classificados" == $post->tipo ? 'selected' : ''}} >Classificados</option>
                                            <option value="Destaque Lateral"      {{"Destaque Lateral" == $post->tipo ? 'selected' : ''}} >Destaque Lateral</option>
                                            <option value="Diverção"              {{"Diverção" == $post->tipo ? 'selected' : ''}} >Diverção</option>
                                            <option value="Educação"              {{"Educação" == $post->tipo ? 'selected' : ''}} >Educação</option>
                                            <option value="Entretenimento"        {{"Entretenimento" == $post->tipo ? 'selected' : ''}} >Entretenimento</option>
                                            <option value="Esporte"               {{"Esporte" == $post->tipo ? 'selected' : ''}} >Esporte</option>
                                            <option value="Farmácias de plantão"  {{"Farmácias de plantão" == $post->tipo ? 'selected' : ''}} >Farmácias de plantão</option>
                                            <option value="Mensagens"             {{"Mensagens" == $post->tipo ? 'selected' : ''}} >Mensagens</option>
                                            <option value="Nota de falecimento"   {{"Nota de falecimento" == $post->tipo ? 'selected' : ''}} >Nota de falecimento</option>
                                            <option value="Notícias Especiais"    {{"Notícias Especiais" == $post->tipo ? 'selected' : ''}} >Notícias Especiais</option>
                                            <option value="O Ligeirinho"          {{"O Ligeirinho" == $post->tipo ? 'selected' : ''}} >O Ligeirinho</option>
                                            <option value="Ocorrências Policiais" {{"Ocorrências Policiais" == $post->tipo ? 'selected' : ''}} >Ocorrências Policiais</option>
                                            <option value="Para Refletir"         {{"Para Refletir" == $post->tipo ? 'selected' : ''}} >Para Refletir</option>
                                            <option value="Parceiros"             {{"Parceiros" == $post->tipo ? 'selected' : ''}} >Parceiros</option>
                                            <option value="Qualidade de vida"     {{"Qualidade de vida" == $post->tipo ? 'selected' : ''}} >Qualidade de vida</option>
                                            <option value="Receitas"              {{"Receitas" == $post->tipo ? 'selected' : ''}} >Receitas</option>
                                            <option value="Região"                {{"Região" == $post->tipo ? 'selected' : ''}} >Região</option>
                                            <option value="Senac"                 {{"Senac" == $post->tipo ? 'selected' : ''}} >Senac</option>
                                            <option value="Testando"              {{"Testando" == $post->tipo ? 'selected' : ''}} >Testando</option>
                                            <option value="Todos"                 {{"Todos" == $post->tipo ? 'selected' : ''}} >Todos</option>
                                            <option value="Turismo"               {{"Turismo" == $post->tipo ? 'selected' : ''}} >Turismo</option>
                                            <option value="Vagas de empregos"     {{"Vagas de empregos" == $post->tipo ? 'selected' : ''}} >Vagas de empregos</option>
                                            <option value="Vídeos"                {{"Vídeos" == $post->tipo ? 'selected' : ''}} >Vídeos</option>
                                        </select>
                                    </div>
                                    <div class=" mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Categoria <b
                                            style="color:red">*</b></label>
                                        <select class="form-select" id="exampleFormControlSelect1" name="tipo_post" aria-label="Default select example">
                                            <option value="" selected>Selecione uma opção</option>
                                            <option value="Notícias">Nota Categoria +</option>
                                            <option value="2">Assai</option>
                                            <option value="3">Cornélio Procópio</option>
                                            <option value="3" data-bs-toggle="modal" data-bs-target="#modalToggle">Nova Categoria</option>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Título <b style="color:red">*</b></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="Insira o Título" value="{{ $post->titulo }}" name="titulo_post" />
                                    </div>



                                    <div style="display: flex; gap: 60px;">
                                        <div class="col-md-6">
                                            <label for="exampleFormControlInput1" class="form-label">Legendas</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Insira legenda" name="legenda_post" value="{{ $post->legenda }}"/>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="exampleFormControlInput1" class="form-label">Video</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="https://..." name="video_post" value="{{ $post->video }}"/>
                                        </div>


                                    </div>

                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Upload Imagem Capa <b style="color:red">*</b></label>
                                        <input class="form-control" type="file" id="formFile" accept="image/png, image/jpeg" name="foto1_post" data-image-input/>
                                        <div class="preview"><img src="{{Storage::url($post->foto)}}" data-image-preview style="width:120px"></div>
                                        <input type="hidden" value="{{$post->foto}}" name="foto1_posts_db" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFileMultiple" class="form-label">Upload Imagens Conteudo</label>
                                        <input class="form-control" type="file" id="formFileMultiple"
                                            accept="image/png, image/jpeg" name="foto2_post" multiple/>
                                    </div>
                                    <!-- <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                            name="status_post" value="on"  {{'on' ==  $post->status  ? 'checked' : ''}} />
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Destaque</label>
                                    </div> -->


                                    <div>


                                        <label for="exampleFormControlTextarea1" class="form-label">Texto <b style="color:red">*</b></label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="texto_post"
                                            style="height: 300px !important">{!! trim(strip_tags($post->texto)) !!} </textarea>



                                            <!--
                                        <label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
                                        <textarea style="background-color:#534881; color: #ffffff;height: 200px" class="form-control" name="descr_post"
                                            id="exampleFormControlTextarea1" rows="3">{{ $post->descr}}s</textarea>-->
                                    </div>



                                    <div class="demo-inline-spacing" style="display: flex; justify-content: right">
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </form>
@endsection
