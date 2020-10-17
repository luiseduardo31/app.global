@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Logs de acesso
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Logs de acesso</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Logs Registrados</a>
                        </li>
                    </ol>
                </nav>
            </div>
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block">
        
            @include('includes.alerts')
            
            <div class="block-content">
                <p class="font-size-sm text-muted">
                    
                    <!-- Dynamic Table with Export Buttons -->
                    <div class="block">
                        <div class="block-content block-content-full">
                            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table id="contact-detail" class="responsive display nowrap table table-bordered table-striped table-vcenter" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:10%">ID</th>
                                        <th style="width:30%">Usuário</th>
                                        <th style="width:30%">Email</th>
                                        <th class="text-center">IP</th>
                                        <th>Ação</th>
                                        <th>Registro</th>
                                        <th style="width:50px">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($logslogins as $log)
                                    <tr>
                                        <td class="text-center">{{$log->logsloginsID}}</td>
                                        <td>{{$log->name}}</td>
                                        <td>{{$log->email}}</td>
                                        <td class="text-center">{{$log->ip}}</td>
                                        <td class="text-center">{{$log->acao}}</td>
                                        <td>{{strftime("%d-%m-%Y %H:%M:%S", strtotime($log->logsloginsData))}}</td>
                                        <td class="text-center">  
                                            <div class="btn-group">
                                                <form action="{{route('logs-acessos.destroy',$log->logsloginsID)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Excluir Registro" data-original-title="Excluir"
                                                onclick="return confirm('Deseja realmente excluir o registro do usuário {{$log->email}} de {{strftime("%d-%m-%Y %H:%M:%S", strtotime($log->logsloginsData))}}?');">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>                                                                     
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Dynamic Table with Export Buttons -->

                </p>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection
