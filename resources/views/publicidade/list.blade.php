<table class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Venc.</th>
            <th>Titulo</th>
            <th>Categoria</th>
            <th>Status</th>
            <th>Enviado</th>
            <th>Fotos</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($publicidade as $publi)

        <tr>
            <input type="hidden" class="delete" value="{{$publi->id}}">
            <td>{{$publi->vencimento}}</td>
            <td>{{$publi->titulo}}</td>
            <td>{{$publi->tipo}}</td>
            @if($publi->status == "on")
            <td><span class="badge bg-label-success me-1">Habilitado</span></td>
            @else
            <td><span class="badge bg-label-primary me-1">Desabilitado</span></td>
            @endif
            <td>{{$publi->data}}</td>

            <td>
                <ul class="list-unstyled Imagem-list m-0 avatar-group d-flex align-items-center">
                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Lilian Fuller">
                        <img src="{{Storage::url($publi->foto)}}" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                        <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Christina Parker">
                        <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                    </li>
                </ul>
            </td>
            <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/publicidade/edit/{{$publi->id}}"><i class="bx bx-edit-alt me-1"></i>
                            Edit</a>
                        <a class="dropdown-item deletebtnPub" href="#"><i class="bx bx-trash me-1"></i>
                            Delete</a>
                    </div>
                </div>
            </td>

        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Venc.</th>
            <th>Titulo</th>
            <th>Categoria</th>
            <th>Status</th>
            <th>Enviado</th>
            <th>Fotos</th>
            <th>Ações</th>
        </tr>
    </tfoot>
</table>
</div>
<div class="py-4">
{{$publicidade->links()}}
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('/assets/vendor/alert/sweet.js') }}"></script>
