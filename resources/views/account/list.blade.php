<table id="tabela" class="table table-striped table-bordered first">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Data</th>
            <th>Destaque</th>
            <th>Status</th>
            <th>Fotos</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($accounts as $account)
            <tr>
                <input type="hidden" class="delete" value="{{ $account->id }}">
                <td>{{ $account->name }}</td>
                <th>{{ $account->email }}</th>
                <td>{{ $account->data }}</td>
                <td>{{ $account->destaque }}</td>
                @if ($account->status == 'on')
                    <td><span class="badge bg-label-success me-1">Habilitado</span></td>
                @else
                    <td><span class="badge bg-label-primary me-1">Desabilitado</span></td>
                @endif

                <td>
                    <ul
                        class="list-unstyled Imagem-list m-0 avatar-group d-flex align-items-center">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                            data-bs-placement="top" class="avatar avatar-xs pull-up"
                            title="Lilian Fuller">
                            <img src="{{ Storage::url($account->foto) }}" alt="Avatar"
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
                </td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                            data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/posts/edit/{{ $account->id }}"><i
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
    <tfoot>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Data</th>
            <th>Destaque</th>
            <th>Status</th>
            <th>Fotos</th>
            <th>Ações</th>
        </tr>
    </tfoot>
</table>

</div>
<div class="py-4">
{{ $accounts->links() }}
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('/assets/vendor/alert/sweet.js') }}"></script>
