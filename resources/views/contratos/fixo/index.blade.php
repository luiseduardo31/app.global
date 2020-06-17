@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Contratos Fixos
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        [Contratos]
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Contratos Fixos</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Cadastrados</a>
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
                                        <th style="width:300px">Contrato</th>
                                        <th style="width:300px !important">Operadora</th>
                                        <th wid>Razão Social</th>
                                        <th>CNPJ</th>
                                        <th>Periodo</th>
                                        <th>Vigencia</th>
                                        <th>Assinatura</th>
                                        <th>Comp. Min.</th>
                                        <th>Franquia</th>
                                        <th>Range</th>
                                        <th>Canais</th>
                                        <th>Sinalização</th>
                                        <th>Tarifa Local - Fixo</th>
                                        <th>Tarifa Local - Móvel</th>
                                        <th>Tarifa LD - Fixo</th>
                                        <th>Tarifa LD - Móvel</th>
                                        <th>Observação</th>
                                        <th style="width:50px">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contratos as $contrato)
                                    <tr>
                                        <td>{{$contrato->numero_contrato}}</td>
                                        <td style="width:300px !important">{{$contrato->operadora}}</td>
                                        <td>{{$contrato->razao_social}}</td>
                                        <td>{{$contrato->cnpj}}</td>
                                        <td style="text-align: center">{{strftime("%d-%m-%Y", strtotime($contrato->periodo_inicio))}} à {{strftime("%d-%m-%Y", strtotime($contrato->periodo_fim))}}</td>
                                        <td style="text-align: center">{{$contrato->vigencia}} Meses</td>
                                        <td>R$ {{$contrato->assinatura}}</td>
                                        <td>R$ {{$contrato->comprometimento_minimo}}</td>
                                        <td>{{$contrato->franquia}}</td>
                                        <td style="text-align: center">{{$contrato->range}}</td>
                                        <td style="text-align: center">{{$contrato->canais}}</td>
                                        <td style="text-align: center">{{$contrato->sinalizacao}}</td>
                                        <td style="text-align: center">{{$contrato->tarifa_local_fixo}}</td>
                                        <td style="text-align: center">{{$contrato->tarifa_local_movel}}</td>
                                        <td style="text-align: center">{{$contrato->tarifa_ld_fixo}}</td>
                                        <td style="text-align: center">{{$contrato->tarifa_ld_movel}}</td>
                                        <td>{{$contrato->obsContrato}}</td>
                                        <td> 
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Editar Registro" data-original-title="Editar">
                                                    <a href="{{route('contratos-fixo.edit', $contrato->idContrato)}}">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </a>
                                                </button>
                                                <form action="{{route('contratos-fixo.destroy',$contrato->idContrato)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Excluir Registro" data-original-title="Excluir"
                                                onclick="return confirm('Deseja realmente excluir o contrato {{$contrato->numero_contrato}}?');">
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
