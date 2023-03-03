@extends('layouts/index')


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Publicidade /</span> Todas as Publicidades</h4>
        <div class="nav-item d-flex ">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                    <div class="col-sm-12">
                           <div class="row">
                                            <form class="form" id="form">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                                                    <input type='text' id='nome' name="nome" class="form-control"
                                                        placeholder="Buscar" aria-label="Recipient's username"
                                                        aria-describedby="basic-addon-search31">
                                                    <div class="input-group-append">
                                                        <input type="hidden" id="page" name="page" value="0">
                                                        <button class="btn btn-primary" id="btn-sub"
                                                            type="button">Pesquisar</button>
                                                    </div>
                                                
                                                </div>
                                            </form>
                                    </div>
                                
                    </div>
                    <br>
                            <div class="table-responsive"> </div>
                            <div class="demo-inline-spacing" style="display: flex; justify-content: right">
                              <a href="{{ route('publicidade.pdf') }}" type="button" class="btn btn-dark">Imprimir</a>
                                                   
                              </div>
                            
                        </div>
                    </div>

                </div>
                
            </div>
        </div>

        <hr class="my-5" />
        <script>
            $(document).ready(function() {
                carregarTabela(0);
            });


            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var pagina = $(this).attr('href').split('page=')[1];
                carregarTabela(pagina);
            });

            $("#nome").keyup(function() {
                carregarTabela(0);
            });
            /*
            $(document).on('Keyup submit', '.form', function(e) {
                e.preventDefault();
                carregarTabela(0);
            });*/
            $("#btn-sub").click(function() {
                carregarTabela(0);
            });

            function carregarTabela(pagina) {
                $('#page').val(pagina);
                var dados = $('#form').serialize();


                $.ajax({
                    url: "{{ route('publicidade.list') }}",
                    method: 'GET',
                    data: dados
                }).done(function(data) {
                    $('.table-responsive').html(data);
                });
            }
        </script>
    @endsection
