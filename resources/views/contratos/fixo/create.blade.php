@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                  <a href="{{route('contratos-fixo.index')}}">
                     Contratos Fixo
                  </a>
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        [Contratos]
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Contratos Fixo</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Cadastrar Novo Contrato</a>
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
            <!-- Titulo do block
            <div class="block-header">
                <h3 class="block-title">Linhas Cadastradas no Inventário Móvel</h3>
            </div>
            -->
            <div class="block-content">
               <form action="{{route('contratos-fixo.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="tipo_contrato" value="1">
                    <div class="form-group form-row">
                        <div class="col-4">
                            <label for="contrato">Nº do Contrato</label>
                            <input type="text" name="contrato" class="form-control" placeholder="Nº do Contrato" maxlength="40">
                        </div>
                        
                        <div class="col-6">
                            <label for="user">Razão Social | CNPJ</label>
                            <select class="form-control selectpicker" data-size="5" name="empresa_id" id="empresa_id">
                                <option readonly>Escolha uma opção</option>
                            @foreach ($empresas as $empresa)
                                <option data-subtext=" | {{$empresa->cnpj}}" value="{{$empresa->EmpresaID}}">{{$empresa->razao_social}}</option>
                            @endforeach
                            </select>
                        </div>
                        
                        <div class="col-2">
                            <label for="operadora">Operadora</label>
                            <select class="form-control selectpicker" name="operadora_id">
                                <option readonly>Escolha uma opção</option>
                            @foreach ($operadoras as $operadora)
                                <option value="{{$operadora->id}}">{{$operadora->operadora}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group form-row">    
                        <div class="col-2">
                            <label for="assinatura">Assinatura</label>
                            <input type="text" name="assinatura" class="form-control" placeholder="Valor da Assinatura" maxlength="40">
                        </div>
                        
                        <div class="col-2">
                            <label for="franquia">Franquia</label>
                            <input type="text" name="franquia" class="form-control" placeholder="Franquia" maxlength="40">
                        </div>
                        
                        <div class="col-2">
                            <label for="comprometimento_minimo">Comp. Minimo</label>
                            <input type="text" name="comprometimento_minimo" class="form-control" placeholder="Comp. Minimo" maxlength="40">
                        </div>

                        <div class="col-2">
                            <label for="data_inicio">Período (Inicio)</label>
                            <input type="date" name="data_inicio" class="form-control" placeholder="Período (Inicio)" maxlength="40">
                        </div>

                        <div class="col-2">
                            <label for="data_fim">Período (Fim)</label>
                            <input type="date" name="data_fim" class="form-control" placeholder="Período (Fim)" maxlength="40">
                        </div>

                        <div class="col-1">
                            <label for="vigencia">Vigência</label>
                            <input type="number" name="vigencia" class="form-control" placeholder="Meses" maxlength="2" min="1" max="96">
                        </div>

                        <div class="col-1">
                            <label for="canais">Canais</label>
                            <input type="number" name="canais" class="form-control" placeholder="Canais" maxlength="3" min="1" max="999">
                        </div>

                    </div>

                    <div class="form-group form-row">                        
                        <div class="col-2">
                            <label for="range">Range</label>
                            <input type="text" name="range" class="form-control" placeholder="Range" maxlength="9" data-mask="0000-0000">
                        </div>

                        <div class="col-2">
                            <label for="sinalizacao">Sinalização</label>
                            <select class="form-control" name="sinalizacao">
                                <option value="ISDN">ISDN</option>
                                <option value="R2">R2</option>
                                <option value="SIP">SIP</option>
                            </select>
                        </div>
                        
                        <div class="col-1">
                            <label for="tarifa_local_fixo">LC Fixo</label>
                            <input type="text" name="tarifa_local_fixo" class="form-control" placeholder="Tarifa" maxlength="7">
                        </div>

                        <div class="col-1">
                            <label for="tarifa_local_movel">LC Móvel</label>
                            <input type="text" name="tarifa_local_movel" class="form-control" placeholder="Tarifa" maxlength="7">
                        </div>

                        <div class="col-1">
                            <label for="tarifa_ld_fixo">LD Fixo</label>
                            <input type="text" name="tarifa_ld_fixo" class="form-control" placeholder="Tarifa" maxlength="7">
                        </div>

                        <div class="col-1">
                            <label for="tarifa_ld_movel">LD Móvel</label>
                            <input type="text" name="tarifa_ld_movel" class="form-control" placeholder="Tarifa" maxlength="7">
                        </div>

                    </div>

                <div class="form-group form-row">  
                    <div class="col-12">
                    <label for="resp_despesa">Observação</label> <br>
                    <textarea name="observacao" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                    <div class="form-group form-row">
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary form-control">Salvar</button>  
                        </div>  
                        
                        <div class="col-2">
                            <a href="{{route('contratos-fixo.index')}}" class="btn btn-danger form-control"  onclick="return confirm('Deseja realmente cancelar o cadastro?')">
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
