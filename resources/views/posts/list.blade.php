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

            <form action="{{route('posts.destaque')}}" method="PUT">
                @csrf
            @foreach ($posts as $post)
                <tr>
                    <input type="hidden" class="delete" value="{{ $post->id }}">
                    <td><img src="{{ Storage::url($post->foto) }}"style="width:100px; height 100px" /></td>
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

                        <td>
                                <span class="form-check form-switch mb-3"  onClick="window.location.reload()">
                                    <label class="form-check-label" for="flexSwitchCheckChecked" >{{'on' ==  $post->status  ? 'On' : 'Off'}}</label>
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                    name="status_post"   {{'on' ==  $post->status  ? 'checked' : ''}} onclick="statusDestaque(this, {{$post->id}})"/>
                                </span>
                            </td>

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
        </form>


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
    <div class="col-12 mb-3">
        <div><h5>Post</h5></div>
        <div>{{ $post->titulo }}</div>
    </div>
    <div class="col-12 mb-4">
        <!-- <div><span><b>Categoria</b></span></div>
        <div class="mb-3">{{ $post->tipo }}</div> -->
        <div class="row">
            <div class="btn-group" data-toggle="buttons">
                <a href="" class="btn btn-sm btn-secondary">
                    <i class="bx bx-edit-alt me-1"> </i>
                    Editar
                </a>
                <a href="" class="btn btn-sm btn-danger ">
                    <i class="bx bx-trash me-1"></i>
                    Deletar
                </a>
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
