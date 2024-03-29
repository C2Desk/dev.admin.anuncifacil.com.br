@extends('layouts/index')


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users /</span> Todos os users </h4>
        <div class="nav-item d-flex ">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">

                    <div class="card-body">

                        <div class="container text-left">
                            <div class="row">
                                <div class="col-sm-3">
                                    <a href="#{{ route('publicidade.pdf') }}" type="button"
                                        class="btn btn-primary">Novo usuario</a>
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
                        </div>


                        <div class="row">
                            <table>
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>data cadastro</th>
                                    <th>ultima alteração</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <td>{{$user->updated_at}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="table-responsive"></div> -->
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- <script>
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
                url: "{{ route('account.list') }}",
                method: 'GET',
                data: dados
            }).done(function(data) {
                $('.table-responsive').html(data);
            });
        }
     </script> -->
@endsection
