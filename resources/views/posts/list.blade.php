<div class="row d-none d-md-block">
    <table id="tabela" class="table table-striped table-bordered first ">
        <thead>
            <tr>
                <th>Fotos</th>
                <th>Titulo</th>
                <th class="d-none d-md-block">Categoria</th>
                <th>Data</th>
                <th class="d-none d-md-block">Destaque</th>
                <!-- <th class="d-none d-md-block">Status</th> -->

                <th>Ações</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($posts as $post)
                <tr>
                    <input type="hidden" class="delete" value="{{ $post->id }}">
                    <td>{{ Storage::url($post->foto) }}</td>
                    <td>{{ $post->titulo }}</td>
                    <th>{{ $post->tipo }}</th>
                    <td>{{ $post->data }}</td>


                    <!-- <td>{{ $post->destaque }}</td> -->
                    <!-- @if ($post->status == 'on')
                        <td><span class="badge bg-label-success me-1">Habilitado</span>
                    </td>


                    @else
                        <td><span class="badge bg-label-primary me-1">Desabilitado</span></td>
                    @endif -->


                    @if ($post->status == 'on')
                        <td>
                            <span class="form-check form-switch mb-3">
                                <label class="form-check-label" for="flexSwitchCheckChecked">On</label>
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                name="status_post" value="on"  {{'on' ==  $post->status  ? 'checked' : ''}} />
                            </span>
                        </td>

                    @else
                    <td>
                            <span class="form-check form-switch mb-3">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Off</label>
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                name="status_post" value="off"  {{'off' ==  $post->status  ?  : ''}} />
                            </span>
                        </td>

                    @endif




                    <!-- <td>
                        <ul
                            class="list-unstyled Imagem-list m-0 avatar-group d-flex align-items-center">
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                data-bs-placement="top" class="avatar avatar-xs pull-up"
                                title="Lilian Fuller">
                                <img src="{{ Storage::url($post->foto) }}" alt="Avatar"
                                    class="rounded-circle" />
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                data-bs-placement="top" class="avatar avatar-xs pull-up"
                                title="Sophia Wilkerson">
                                <img src="../assets/img/avatars/6.png" alt="Avatar"
                                    class="rounded-circle" />
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                data-bs-placement="top" class="avatar avatar-xs pull-up"
                                title="Christina Parker">
                                <img src="../assets/img/avatars/7.png" alt="Avatar"
                                    class="rounded-circle" />
                            </li>
                        </ul>
                    </td> -->
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/posts/edit/{{ $post->id }}"><i
                                        class="bx bx-edit-alt me-1"></i>
                                    Edit</a>
                                <a class="dropdown-item deletebtn" href="#"><i
                                        class="bx bx-trash me-1"></i>
                                    Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach


        </tbody>
        <!-- <tfoot>
            <tr>
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Data</th> -->
                <!-- <th>Destaque</th> -->
                <!-- <th>Status</th> -->
                <!-- <th>Fotos</th> -->
                <!-- <th>Ações</th>
            </tr>
        </tfoot> -->
    </table>
</div>

<div class="row d-block d-md-none">
@foreach ($posts as $post)
    <div class="col-12 mb-2">
        <div><h5>Título</h5></div>
        <div>{{ $post->titulo }}</div>
    </div>
    <div class="col-12 mb-3">
        <div><span><b>Categoria</b></span></div>
        <div class="mb-3">{{ $post->tipo }}</div>
        <div class="row">
            <div class="btn-group" data-toggle="buttons">
                <a href="" class="btn btn-sm btn-warning">Editar</a>
                <a href="" class="btn btn-sm btn-danger">Deletar</a>
            </div>
        </div>
    </div>

<hr>
@endforeach
</div>

</div>
<div class="py-4">
{{ $posts->links() }}
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('/assets/vendor/alert/sweet.js') }}"></script>
