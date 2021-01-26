@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                  <a href="{{route('contas.index')}}">
                     Contratos | Servico de Dados
                  </a>
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Contrato de Serviços de Dados</li>
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
               <form action="{{route('contratos-dados.update',$contratos->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group form-row">
                        <div class="col-3">
                            <label for="contrato">Nº do Contrato</label>
                            <input type="text" name="contrato" class="form-control" value="{{$contratos->contrato}}" maxlength="40">
                        </div>
                        
                        <div class="col-5">
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
                            <label for="status_contrato">Status</label>
                            <select class="form-control selectpicker" name="status_contrato">
                                <option value="0" {{ ( $contratos->status_contrato == "0") ? 'selected' : '' }}>Cancelado</option>
                                <option value="1" {{ ( $contratos->status_contrato == "1") ? 'selected' : '' }}>Ativo</option>
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
                            <label for="data_inicio">Período (Inicio)</label>
                            <input type="date" name="data_inicio" class="form-control" value="{{$contratos->data_inicio}}">
                        </div>

                        <div class="col-2">
                            <label for="data_fim">Período (Fim)</label>
                            <input type="date" name="data_fim" class="form-control" value="{{$contratos->data_fim}}">
                        </div>

                        <div class="col-1">
                            <label for="vigencia">Vigência</label>
                            <input type="number" name="vigencia" class="form-control" value="{{$contratos->vigencia}}" maxlength="2" min="1" max="96">
                        </div>

                        <div class="col-1">
                            <label for="velocidade">Veloc. (MB)</label>
                            <input type="number" name="velocidade" class="form-control" value="{{$detalhes_contrato->velocidade}}" maxlength="4" min="1" max="9999">
                        </div>

                        <div class="col-2">
                            <label for="tecnologia">Tecnologia</label>
                            <select class="form-control selectpicker" name="tecnologia">
                                <option value="ADSL" {{ ( $detalhes_contrato->tecnologia == "ADSL") ? 'selected' : '' }}>ADSL</option>
                                <option value="Interconexao" {{ ( $detalhes_contrato->tecnologia == "Interconexão") ? 'selected' : '' }}>Interconexão</option>
                                <option value="Link Dedicado" {{ ( $detalhes_contrato->tecnologia == "Link Dedicado") ? 'selected' : '' }}>Link Dedicado</option>
                                <option value="MPLS" {{ ( $detalhes_contrato->tecnologia == "MPLS") ? 'selected' : '' }}>MPLS</option>
                            </select>
                        </div>

                        <div class="col-2">
                            <label for="MeioEntrega">Meio de Entrega</label>
                            <select class="form-control selectpicker" name="meio_entrega">
                                <option value="Radio" {{ ( $detalhes_contrato->meio_entrega == "Radio") ? 'selected' : '' }}>Rádio</option>
                                <option value="Fibra Optica" {{ ( $detalhes_contrato->meio_entrega == "Fibra Optica") ? 'selected' : '' }}>Fibra Óptica</option>
                                <option value="Par Metalico" {{ ( $detalhes_contrato->meio_entrega == "Par Metalico") ? 'selected' : '' }}>Par Metálico</option>
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
                            <a href="{{route('contratos-dados.index')}}" class="btn btn-danger form-control"  onclick="return confirm('Deseja realmente cancelar a edição do contrato {{$contratos->numero_contrato}}?');">
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