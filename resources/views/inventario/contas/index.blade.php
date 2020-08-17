@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Contas 
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        [Inventario Móvel]
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Contas</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Contas Cadastradas</a>
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
                                        <th style="width:30%">Conta</th>
                                         <th class="text-center">Grupo</th>
                                         <th style="width:30%">Razão Social</th>
                                         <th class="text-center">CNPJ</th>
                                         <th class="text-center">Operadora</th>
                                        <th>Observação</th>
                                        <th style="width:50px">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contas as $conta)
                                    <tr>
                                        <td class="text-center">{{$conta->ContaID}}</td>
                                        <td>{{$conta->conta}}</td>
                                        <td class="text-center">{{$conta->grupo}}</td>
                                        <td>{{$conta->razao_social}}</td>
                                        <td class="text-center">{{$conta->cnpj}}</td>
                                        <td class="text-center">{{$conta->operadora}}</td>
                                        <td>{{$conta->obsConta}}</td>
                                        <td> 
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Editar Registro" data-original-title="Editar">
                                                    <a href="{{route('contas.edit', $conta->ContaID)}}">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </a>
                                                </button>
                                                <form action="{{route('contas.destroy',$conta->ContaID)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Excluir Registro" data-original-title="Excluir"
                                                onclick="return confirm('Deseja realmente excluir a conta {{$conta->conta}}?');">
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
