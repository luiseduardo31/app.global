@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Contratos | Telefonia Móvel
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Contratos de Telefonia Móvel</li>
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
                                        <th style="width:25%">Contrato</th>
                                        <th  style="text-align: center">Situação</th>
                                        <th>Operadora</th>
                                        <th>Razão Social</th>
                                        <th>CNPJ</th>
                                        <th>Periodo</th>
                                        <th>Vigencia</th>
                                        <th>Assinatura</th>
                                        <th>SMS Unitário</th>
                                        <th>SMS Pacote</th>
                                        <th>Gestor Online</th>
                                        <th>Local para Mesma</th>
                                        <th>Local para Fixo</th>
                                        <th>Local para Outras</th>
                                        <th>LD para Mesma</th>
                                        <th>LD para Fixo</th>
                                        <th>LD para Outras</th>
                                        <th>Planos/Condição Comercial</th>
                                        <th>Status</th>
                                        <th>Observação</th>
                                        @if(Auth::user()->tipo_usuario_id == 1)
                                            <th style="width:50px">Ações</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contratos as $contrato)

                                        @if($contrato->status_contrato == 1)
                                        
                                        @php 
                                            $data_fim_contrato = date_create($contrato->data_fim);
                                            $data_hoje = date_create(date('Y-m-d'));
                                            $intervalo = date_diff($data_hoje, $data_fim_contrato);
                                            $dias_venc_contrato = (int)$intervalo->format('%R%a');

                                            $situacao_contrato = $dias_venc_contrato <0 ? "Vencido (".abs($dias_venc_contrato). " dias)" : ($dias_venc_contrato <=60 ? "À Vencer ($dias_venc_contrato dias)" : "Vigente");
                                            $situacao_texto = $dias_venc_contrato <0 ? "color:red;font-weight:bold" : ($dias_venc_contrato <=60 ? "color:blue" : "vigente");
                                            $status_contrato = "Ativo";
                                        @endphp
                                        @else
                                        @php
                                            $situacao_texto = "color:#838383;background-color:#e9e9e9";
                                            $situacao_contrato = "Cancelado";
                                            $status_contrato = "Cancelado";
                                        @endphp
                                        @endif

                                    <tr style="{{$situacao_texto}}">
                                        <td style="{{$situacao_texto}}">{{$contrato->contrato}}</td>
                                        <td style="text-align: center">{{$situacao_contrato}}</td>
                                        <td>{{$contrato->operadora}}</td>
                                        <td>{{$contrato->razao_social}}</td>
                                        <td>{{$contrato->cnpj}}</td>
                                        <td style="text-align: center">{{strftime("%d-%m-%Y", strtotime($contrato->data_inicio))}} à {{strftime("%d-%m-%Y", strtotime($contrato->data_fim))}}</td>
                                        <td style="text-align: center">{{$contrato->vigencia}} Meses</td>
                                        <td>R$ {{number_format($contrato->assinatura, 2, ',', '.')}}</td>
                                        <td>R$ {{number_format($contrato->sms_unitario, 2, ',', '.')}}</td>
                                        <td>R$ {{number_format($contrato->sms_pacote, 2, ',', '.')}}</td>
                                        <td>R$ {{number_format($contrato->gestor_online, 2, ',', '.')}}</td>
                                        <td>R$ {{number_format($contrato->tarifa_local_mesma, 2, ',', '.')}}</td> 
                                        <td>R$ {{number_format($contrato->tarifa_local_fixo, 2, ',', '.')}}</td> 
                                        <td>R$ {{number_format($contrato->tarifa_local_outra, 2, ',', '.')}}</td>
                                        <td>R$ {{number_format($contrato->tarifa_ld_mesma, 2, ',', '.')}}</td> 
                                        <td>R$ {{number_format($contrato->tarifa_ld_fixo, 2, ',', '.')}}</td> 
                                        <td>R$ {{number_format($contrato->tarifa_ld_outra, 2, ',', '.')}}</td>
                                        <td>{{$contrato->planos_contrato}}</td>  
                                        <td>{{$status_contrato}}</td>                                 
                                        <td>{{$contrato->obsContrato}}</td>
                                        @if(Auth::user()->tipo_usuario_id == 1)
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Editar Registro" data-original-title="Editar">
                                                    <a href="{{route('contratos-movel.edit', \Crypt::encrypt($contrato->ContratoID))}}">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </a>
                                                </button>
                                                <form action="{{route('contratos-movel.destroy',$contrato->ContratoID)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Excluir Registro" data-original-title="Excluir"
                                                onclick="return confirm('Deseja realmente excluir o contrato {{$contrato->contrato}}?');">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        @endif
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
