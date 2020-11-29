@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                  <a href="{{route('contratos-fixo.index')}}">
                     Contratos Móveis
                  </a>
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Contrato Móvel</li>
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
               <form action="{{route('contratos-movel.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="tipo_contrato" value="2">

                  <div class="form-group form-row">
                        <div class="col-3">
                            <label for="contrato">Nº do Contrato</label>
                            <input type="text" name="contrato" class="form-control" placeholder="Nº do Contrato" maxlength="40">
                        </div>
                        
                        <div class="col-7">
                            <label for="user">Razão Social | CNPJ | Grupo</label>
                            <select class="form-control selectpicker" data-size="5" name="empresa_id" id="empresa_id">
                                <option readonly>Escolha uma opção</option>
                            @foreach ($empresas as $empresa)
                                <option data-subtext=" | {{$empresa->cnpj}} | {{$empresa->grupo}}" value="{{$empresa->EmpresaID}}">{{$empresa->razao_social}}</option>
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
                            <input type="text" name="assinatura" class="form-control" placeholder="Valor da Assinatura" maxlength="8">
                        </div>

                        <div class="col-1">
                            <label for="vigencia">Vigência</label>
                            <input type="number" name="vigencia" class="form-control" placeholder="Meses" maxlength="2" min="1" max="96">
                        </div>
                                                
                        <div class="col-1">
                            <label for="sms_unitario">SMS</label>
                            <input type="text" name="sms_unitario" class="form-control" placeholder="Custo" maxlength="4" data-mask="0.00">
                        </div>

                        <div class="col-1">
                            <label for="sms_pacote">Pct SMS</label>
                            <input type="text" name="sms_pacote" class="form-control" placeholder="Custo" data-mask="000.00" maxlength="6">
                        </div>

                        <div class="col-1">
                            <label for="gestor_online">Gestor</label>
                            <input type="text" name="gestor_online" class="form-control" placeholder="Custo" data-mask="0.00" maxlength="5">
                        </div>

                        <div class="col-1">
                            <label for="tarifa_local_mesma">LC Mesma</label>
                            <input type="text" name="tarifa_local_mesma" class="form-control" placeholder="Custo" data-mask="0.00" maxlength="4">
                        </div>
                        
                        <div class="col-1">
                            <label for="tarifa_local_fixo">LC Fixo</label>
                            <input type="text" name="tarifa_local_fixo" class="form-control" placeholder="Custo" data-mask="0.00" maxlength="4">
                        </div>

                        <div class="col-1">
                            <label for="tarifa_local_outra">LC Outra</label>
                            <input type="text" name="tarifa_local_outra" class="form-control" placeholder="Custo" data-mask="0.00" maxlength="4">
                        </div>

                        <div class="col-1">
                            <label for="tarifa_ld_mesma">LD Mesma</label>
                            <input type="text" name="tarifa_ld_mesma" class="form-control" placeholder="Custo" data-mask="0.00" maxlength="4">
                        </div>
                        
                        <div class="col-1">
                            <label for="tarifa_ld_fixo">LD Fixo</label>
                            <input type="text" name="tarifa_ld_fixo" class="form-control" placeholder="Custo" data-mask="0.00" maxlength="4">
                        </div>

                        <div class="col-1">
                            <label for="tarifa_ld_outra">LD Outra</label>
                            <input type="text" name="tarifa_ld_outra" class="form-control" placeholder="Custo" data-mask="0.00" maxlength="4">
                        </div>

                    </div>

                    <div class="form-group form-row">
                        <div class="col-2">
                            <label for="data_inicio">Período (Inicio)</label>
                            <input type="date" name="data_inicio" class="form-control" placeholder="Período (Inicio)" maxlength="40">
                        </div>

                        <div class="col-2">
                            <label for="data_fim">Período (Fim)</label>
                            <input type="date" name="data_fim" class="form-control" placeholder="Período (Fim)" maxlength="40">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-12">
                            <label for="planos_contrato">Planos e Condições Comerciais</label>
                            <textarea name="planos_contrato" class="form-control" placeholder="Exemplo: Smart Vivo 0,5GB (R$ 34,99) / Smart Vivo 2GB (R$ 49,99)" rows="3"></textarea>
                        </div>
                    </div> 

                    <div class="form-group form-row">
                        <div class="col-12">
                            <label for="Observacao">Observação</label>
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
