@extends('layouts/index')


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Posts /</span> Todas as Postagens</h4>
        <div class="nav-item d-flex ">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">

                    <div class="card-body ">
                        <div class="container text-left">
                            <div class="row">
                                <div class="col-sm-3">

                                </div>

                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-8 col-sm-6">
                                        </div>
                                        <div class="col-4 col-sm-6">
                                            <form class="form" id="form">
                                                <div class="input-group mb-3">
                                                    <input type='text' id='nome' name="nome" class="form-control"
                                                        placeholder="Digite" aria-label="Recipient's username"
                                                        aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <input type="hidden" id="page" name="page" value="0">
                                                        <button class="btn btn-primary" id="btn-sub"
                                                            type="button">Pesquisar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>


                        <div class="table-responsive">
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>



        <!--/ Hoverable Table rows -->

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
                    url: "{{ route('posts.list') }}",
                    method: 'GET',
                    data: dados
                }).done(function(data) {
                    $('.table-responsive').html(data);
                });
            }
        </script>
    @endsection
