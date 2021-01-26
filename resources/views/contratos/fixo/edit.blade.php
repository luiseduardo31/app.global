@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                  <a href="{{route('contratos-fixo.index')}}">
                     Contratos | Telefonia Fixa
                  </a>
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Contrato de Telefonia Fixa</li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">Editando Contrato</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">{{$contratos->contrato}} </a>
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
               <form action="{{route('contratos-fixo.update',$contratos->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group form-row">
                        <div class="col-4">
                            <label for="contrato">Nº do Contrato</label>
                            <input type="text" name="contrato" class="form-control" value="{{$contratos->contrato}}" maxlength="40">
                        </div>

                        <div class="col-6">
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
                            <input type="text" name="assinatura" class="form-control money" value="{{$contratos->assinatura}}" maxlength="40">
                        </div>
                        
                        <div class="col-2">
                            <label for="franquia">Franquia</label>
                            <input type="text" name="franquia" class="form-control" value="{{$detalhes_contrato->franquia}}" maxlength="40">
                        </div>
                        
                        <div class="col-2">
                            <label for="comprometimento_minimo">Comp. Minimo</label>
                            <input type="text" name="comprometimento_minimo" class="form-control money" value="{{$detalhes_contrato->comprometimento_minimo}}" maxlength="40">
                        </div>

                        <div class="col-2">
                            <label for="data_inicio">Período (Inicio)</label>
                            <input type="date" name="data_inicio" class="form-control" value="{{$contratos->data_inicio}}" maxlength="40">
                        </div>

                        <div class="col-2">
                            <label for="data_fim">Período (Fim)</label>
                            <input type="date" name="data_fim" class="form-control" value="{{$contratos->data_fim}}" maxlength="40">
                        </div>

                        <div class="col-1">
                            <label for="vigencia">Vigência</label>
                            <input type="number" name="vigencia" class="form-control"value="{{$contratos->vigencia}}" maxlength="2" min="1" max="96">
                        </div>

                        <div class="col-1">
                            <label for="canais">Canais</label>
                            <input type="number" name="canais" class="form-control" value="{{$detalhes_contrato->canais}}" maxlength="3" min="1" max="999">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-2">
                            <label for="range">Range</label>
                            <input type="text" name="range" class="form-control" value="{{$detalhes_contrato->range}}" maxlength="9" data-mask="0000-0000">
                        </div>

                        <div class="col-2">
                            <label for="sinalizacao">Sinalização</label>
                            <select class="form-control" name="sinalizacao">
                                <option value="ISDN" {{ ( $detalhes_contrato->sinalizacao == "ISDN") ? 'selected' : '' }}>ISDN</option>
                                <option value="R2" {{ ( $detalhes_contrato->sinalizacao == "R2") ? 'selected' : '' }}>R2</option>
                                <option value="SIP" {{ ( $detalhes_contrato->sinalizacao == "SIP") ? 'selected' : '' }}>SIP</option>
                            </select>
                        </div>
                        
                        <div class="col-1">
                            <label for="tarifa_local_fixo">LC Fixo</label>
                            <input type="text" name="tarifa_local_fixo" class="form-control" value="{{$detalhes_contrato->tarifa_local_fixo}}" maxlength="7" data-mask="0.000">
                        </div>

                        <div class="col-1">
                            <label for="tarifa_local_movel">LC Móvel</label>
                            <input type="text" name="tarifa_local_movel" class="form-control" value="{{$detalhes_contrato->tarifa_local_movel}}" maxlength="7"data-mask="0.000">
                        </div>

                        <div class="col-1">
                            <label for="tarifa_ld_fixo">LDFixo</label>
                            <input type="text" name="tarifa_ld_fixo" class="form-control" value="{{$detalhes_contrato->tarifa_ld_fixo}}" maxlength="7" data-mask="0.000">
                        </div>

                        <div class="col-1">
                            <label for="tarifa_ld_movel">LD Móvel</label>
                            <input type="text" name="tarifa_ld_movel" class="form-control" value="{{$detalhes_contrato->tarifa_ld_movel}}"maxlength="7" data-mask="0.000">
                        </div>

                        <div class="col-2">
                            <label for="status_contrato">Status</label>
                            <select class="form-control selectpicker" name="status_contrato">
                                <option value="0" {{ ( $contratos->status_contrato == "0") ? 'selected' : '' }}>Cancelado</option>
                                <option value="1" {{ ( $contratos->status_contrato == "1") ? 'selected' : '' }}>Ativo</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group form-row">
                        <div class="col-12">
                            <label for="Observacao">Observação</label> <br>
                            <textarea name="observacao" class="form-control" rows="3">{{$contratos->observacao}}</textarea>
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary form-control">Salvar</button>  
                        </div>  
                        
                        <div class="col-2">
                            <a href="{{route('contratos-fixo.index')}}" class="btn btn-danger form-control"  onclick="return confirm('Deseja realmente cancelar a edição do contrato {{$contratos->numero_contrato}}?');">
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