@extends('layouts/index')


@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Posts /</span> Todas as Postagens</h4>
    <div class="nav-item d-flex ">

        <!-- <button
                              type="button"
                              class="btn btn-primary d-block"
                              data-bs-toggle="button"
                              autocomplete="off"
                            >
                              Limpar Cache
                  </button>
                  <button
                  style= "margin-left: 10px";                             
                  type="button"                             
                  class="btn btn-primary d-block"                             
                  data-bs-toggle="button"                             
                  autocomplete="off"                           
                  >                            
                  Ver site
                  </button> -->

    </div>



    <!-- Hoverable Table rows -->
    <div class="row">
        <div class="demo-inline-spacing" style="display: flex;justify-content:left;margin-bottom: 10px; margin-top: -10px;">
            <button type="button" class="btn btn-primary">Novo Post</button>
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Post</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabela" class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Data</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->titulo}}</td>
                                <td>{{$post->data}}</td>
                                <td>Edinburgh</td>
                                <td><span class="badge bg-label-primary me-1">Active</span></td>
                                <td>
                                    <ul class="list-unstyled Imagem-list m-0 avatar-group d-flex align-items-center">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Lilian Fuller">
                                            <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
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
                                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>
                                                Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--/ Hoverable Table rows -->

    <hr class="my-5" />
 
    @endsection