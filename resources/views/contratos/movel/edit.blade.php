@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                  <a href="{{route('contas.index')}}">
                     Contratos | Telefonia Móvel
                  </a>
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                     
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Contrato de Telefonia Móvel</li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">Editando Contrato</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">{{$contratos->numero_contrato}} </a>
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
            <div class="block-content">
               <form action="{{route('contratos-movel.update',$contratos->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group form-row">
                        <div class="col-3">
                            <label for="contrato">Nº do Contrato</label>
                            <input type="text" name="contrato" class="form-control" value="{{$contratos->contrato}}" maxlength="40">
                        </div>

                        <div class="col-7">
                            <label for="user">Razão Social | CNPJ | Grupo</label>
                            <select class="form-control selectpicker" data-size="5" name="empresa_id" id="empresa_id">
                            @foreach ($empresas as $empresa)
                                <option data-subtext=" | {{$empresa->cnpj}} | {{$empresa->grupo}}" value="{{$empresa->EmpresaID}}" {{ ( $empresa->EmpresaID == $contratos->empresa_id) ? 'selected' : '' }}>
                                    {{$empresa->razao_social}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        
                        <div class="col-2">
                            <label for="operadora">Operadora</label>
                            <select class="form-control selectpicker" name="operadora_id">
                            @foreach ($operadoras as $operadora)
                                <option value="{{$operadora->id}}" {{ ( $operadora->id == $contratos->operadora_id) ? 'selected' : '' }}>
                                    {{$operadora->operadora}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-row">
                        
                        <div class="col-2">
                            <label for="assinatura">Assinatura</label>
                            <input type="text" name="assinatura" class="form-control" value="{{$contratos->assinatura}}" maxlength="8">
                        </div>
                        
                        <div class="col-1">
                            <label for="vigencia">Vigência</label>
                            <input type="number" name="vigencia" class="form-control" value="{{$contratos->vigencia}}" maxlength="2" min="1" max="96">
                        </div>
                                                
                        <div class="col-1">
                            <label for="sms_unitario">SMS</label>
                            <input type="text" name="sms_unitario" class="form-control" value="{{$detalhes_contrato->sms_unitario}}" maxlength="4" data-mask="0.00">
                        </div>

                        <div class="col-1">
                            <label for="sms_pacote">Pct SMS</label>
                            <input type="text" name="sms_pacote" class="form-control" value="{{$detalhes_contrato->sms_pacote}}" data-mask="000.00" maxlength="6">
                        </div>

                        <div class="col-1">
                            <label for="gestor_online">Gestor</label>
                            <input type="text" name="gestor_online" class="form-control" value="{{$detalhes_contrato->gestor_online}}" data-mask="0.00" maxlength="5">
                        </div>

                        <div class="col-1">
                            <label for="tarifa_local_mesma">LC Mesma</label>
                            <input type="text" name="tarifa_local_mesma" class="form-control" value="{{$detalhes_contrato->tarifa_local_mesma}}" data-mask="0.00" maxlength="4">
                        </div>
                        
                        <div class="col-1">
                            <label for="tarifa_local_fixo">LC Fixo</label>
                            <input type="text" name="tarifa_local_fixo" class="form-control" value="{{$detalhes_contrato->tarifa_local_fixo}}" data-mask="0.00" maxlength="4">
                        </div>

                        <div class="col-1">
                            <label for="tarifa_local_outra">LC Outra</label>
                            <input type="text" name="tarifa_local_outra" class="form-control" value="{{$detalhes_contrato->tarifa_local_outra}}"  data-mask="0.00" maxlength="4">
                        </div>

                        <div class="col-1">
                            <label for="tarifa_ld_mesma">LD Mesma</label>
                            <input type="text" name="tarifa_ld_mesma" class="form-control" value="{{$detalhes_contrato->tarifa_ld_mesma}}"  data-mask="0.00" maxlength="4">
                        </div>
                        
                        <div class="col-1">
                            <label for="tarifa_ld_fixo">LD Fixo</label>
                            <input type="text" name="tarifa_ld_fixo" class="form-control" value="{{$detalhes_contrato->tarifa_ld_fixo}}" data-mask="0.00" maxlength="4">
                        </div>

                        <div class="col-1">
                            <label for="tarifa_ld_outra">LD Outra</label>
                            <input type="text" name="tarifa_ld_outra" class="form-control" value="{{$detalhes_contrato->tarifa_ld_outra}}" data-mask="0.00" maxlength="4">
                        </div>

                    </div>
                    
                    <div class="form-group form-row">
                        <div class="col-2">
                            <label for="data_inicio">Período (Inicio)</label>
                            <input type="date" name="data_inicio" class="form-control" value="{{$contratos->data_inicio}}">
                        </div>

                        <div class="col-2">
                            <label for="data_fim">Período (Fim)</label>
                            <input type="date" name="data_fim" class="form-control" value="{{$contratos->data_fim}}">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-12">
                            <label for="planos_contrato">Planos e Condições Comerciais</label>
                            <textarea name="planos_contrato" class="form-control" rows="3">{{$detalhes_contrato->planos_contrato}}</textarea>
                        </div>
                    </div> 

                    <div class="form-group form-row">
                        <div class="col-12">
                            <label for="Observacao">Observação</label>
                            <textarea name="observacao" class="form-control" rows="3">{{$contratos->observacao}}</textarea>
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary form-control">Salvar</button>  
                        </div>  
                        
                        <div class="col-2">
                            <a href="{{route('contratos-movel.index')}}" class="btn btn-danger form-control"  onclick="return confirm('Deseja realmente cancelar a edição do contrato {{$contratos->numero_contrato}}?');">
                                Cancelar
                            </a>
                        </div>
                    </div>
                     
               </form>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection