@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                  <a href="{{route('contas.index')}}">
                     Contas 
                  </a>
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        [Inventário Móvel]
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Contrato Fixo</li>
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
                        
                        <div class="col-2">
                            <label for="assinatura">Assinatura</label>
                            <input type="text" name="assinatura" class="form-control" value="{{$contratos->assinatura}}" maxlength="40">
                        </div>
                        
                        <div class="col-2">
                            <label for="franquia">Franquia</label>
                            <input type="text" name="franquia" class="form-control" value="{{$detalhes_contrato->franquia}}" maxlength="40">
                        </div>
                        
                        <div class="col-2">
                            <label for="comprometimento_minimo">Comp. Minimo</label>
                            <input type="text" name="comprometimento_minimo" class="form-control" value="{{$detalhes_contrato->comprometimento_minimo}}" maxlength="40">
                        </div>

                    </div>
                    <div class="form-group form-row">
                        <div class="col-2">
                            <label for="empresa">CNPJ</label>
                            <select class="form-control" name="empresa_id">
                            @foreach ($empresas as $empresa)
                                <option value="{{$empresa->EmpresaID}}" {{ ( $empresa->EmpresaID == $contratos->empresa_id) ? 'selected' : '' }}>
                                    {{$empresa->cnpj}}
                                </option>
                            @endforeach
                            </select>
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
                            <input type="number" name="vigencia" class="form-control"value="{{$contratos->vigencia}}" maxlength="2" min="1" max="48">
                        </div>

                        <div class="col-1">
                            <label for="canais">Canais</label>
                            <input type="number" name="canais" class="form-control" value="{{$detalhes_contrato->canais}}" maxlength="3" min="1" max="120">
                        </div>

                        
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

                    </div>

                    <div class="form-group form-row">
                        
                        <div class="col-2">
                            <label for="tarifa_local_fixo">Local Fixo</label>
                            <input type="text" name="tarifa_local_fixo" class="form-control" value="{{$detalhes_contrato->tarifa_local_fixo}}" maxlength="8" data-mask="0.0000">
                        </div>

                        <div class="col-2">
                            <label for="tarifa_local_movel">Local Móvel</label>
                            <input type="text" name="tarifa_local_movel" class="form-control" value="{{$detalhes_contrato->tarifa_local_movel}}" maxlength="8">
                        </div>

                        <div class="col-2">
                            <label for="tarifa_ld_fixo">Longa Distancia Fixo</label>
                            <input type="text" name="tarifa_ld_fixo" class="form-control" value="{{$detalhes_contrato->tarifa_ld_fixo}}" maxlength="8">
                        </div>

                        <div class="col-2">
                            <label for="tarifa_ld_movel">Longa Distancia Móvel</label>
                            <input type="text" name="tarifa_ld_movel" class="form-control" value="{{$detalhes_contrato->tarifa_ld_movel}}"maxlength="8">
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