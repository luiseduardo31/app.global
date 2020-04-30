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
                    <div class="form-group form-row">
                        <div class="col-3">
                            <label for="contrato">Nº do Contrato</label>
                            <input type="text" name="numero_contrato" class="form-control" placeholder="Nº do Contrato" maxlength="40">
                        </div>
                        
                        <div class="col-2">
                            <label for="empresa">CNPJ</label>
                            <select class="form-control" name="empresa_id">
                            @foreach ($empresas as $empresa)
                                <option value="{{$empresa->id}}">{{$empresa->cnpj}}</option>
                            @endforeach
                            </select>
                        </div>
                        
                        <div class="col-2">
                            <label for="operadora">Operadora</label>
                            <select class="form-control" name="operadora_id">
                            @foreach ($operadoras as $operadora)
                                <option value="{{$operadora->id}}">{{$operadora->operadora}}</option>
                            @endforeach
                            </select>
                        </div>
                        
                        <div class="col-2">
                            <label for="periodo_inicio">Período (Inicio)</label>
                            <input type="date" name="periodo_inicio" class="form-control" placeholder="Período (Inicio)" maxlength="40">
                        </div>

                        <div class="col-2">
                            <label for="periodo_fim">Período (Fim)</label>
                            <input type="date" name="periodo_fim" class="form-control" placeholder="Período (Fim)" maxlength="40">
                        </div>

                        <div class="col-1">
                            <label for="vigencia">Vigência</label>
                            <input type="number" name="vigencia" class="form-control" placeholder="Meses" maxlength="2" min="1" max="48">
                        </div>

                    </div>
                    <div class="form-group form-row">
                        <div class="col-2">
                            <label for="assinatura">Assinatura</label>
                            <input type="text" name="assinatura" class="form-control" placeholder="Valor da Assinatura" maxlength="40">
                        </div>


                                                
                        <div class="col-1">
                            <label for="sms_unitario">SMS</label>
                            <input type="text" name="sms_unitario" class="form-control" placeholder="Custo" maxlength="4" data-mask="0.00">
                        </div>

                        <div class="col-2">
                            <label for="sms_pacote">Pacote SMS</label>
                            <input type="text" name="sms_pacote" class="form-control" placeholder="Custo" maxlength="6">
                        </div>

                        <div class="col-2">
                            <label for="gestor_online">Gestor Online</label>
                            <input type="text" name="gestor_online" class="form-control" placeholder="Custo" maxlength="6">
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
                            <label for="Observacao">Observação</label> <br>
                            <input type="text" name="observacao" class="form-control" maxlength="100">
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