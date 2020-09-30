@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Logs do Sistema 
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Logs do Sistema</li>
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
                                        <th class="text-center">Grupo</th>
                                        <th class="text-center">Tipo</th>
                                        <th>Detalhes</th>
                                        <th>Data</th>
                                        <th>Retorno</th>
                                        <th>Tabela</th>
                                        <th>Registro</th>
                                        <th style="width:50px">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($logs as $log)
                                    <tr>
                                        <td class="text-center">{{$log->logsID}}</td>
                                        <td>
                                            <span style="cursor:pointer" data-toggle="tooltip" data-animation="true" data-placement="top" 
                                                title="{{$log->email}}">
                                            {{$log->name}}
                                        </td>
                                        <td class="text-center">{{$log->grupo}}</td>
                                        <td class="text-center">{{$log->tipo_acao}}</td>
                                        <td>{{$log->acao}}</td>
                                        <td>{{strftime("%d-%m-%Y %H:%M:%S", strtotime($log->LogsData))}}</td>
                                        <td class="text-center">
                                            @if($log->retorno == '1') Sucesso @else Falha @endif
                                        </td>
                                        <td class="text-center">{{$log->tabela}}</td>
                                        <td>{{$log->registro_id}}</td>
                                        <td> 
                                            <div class="btn-group">
                                                <form action="{{route('logs.destroy',$log->logsID)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Excluir Registro" data-original-title="Excluir"
                                                onclick="return confirm('Deseja realmente excluir o registro de Log {{$log->logsID}}?');">
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
