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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<script>
$(document).ready(function(){
    var count = 1;
    dynamic_field(count);

    function dynamic_field(number)
    {
        html = '<div class="form-group form-row" id="dinamico">';
            html += '<div class="col-3"><label for="empresa">Plano</label><input type="text" name="nome_plano[]"  class="form-control" /></div>';
            html += '<div class="col-1"><label for="empresa">Custo</label><input type="text" name="custo_plano[]" class="form-control"/></div>';
            if(number > 1)
            {
                html += '<div class="col-1"><label for="empresa">&nbsp;</label><button type="button" name="remove" id="" class="btn btn-danger remove form-control">--</button></span>';
                $('#dinamico').append(html);
            }
            else
            {   
                html += '<div class="col-1"><label for="empresa">&nbsp;</label><button type="button" name="add" id="add" class="btn btn-success form-control">+</button></div></div>';
                $('#dinamico').html(html);
            }
    }

    $(document).on('click', '#add', function(){
        count++;
        dynamic_field(count);
    });

    $(document).on('click', '.remove', function(){
        count--;
        $(this).closest("#dinamico").remove();
    });

});
</script>

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
                    <div class="form-group form-row">
                        <div class="col-4">
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
                            <label for="assinatura">Assinatura</label>
                            <input type="text" name="assinatura" class="form-control" placeholder="Valor da Assinatura" maxlength="40">
                        </div>
                        
                        <div class="col-2">
                            <label for="franquia">Franquia</label>
                            <input type="text" name="franquia" class="form-control" placeholder="Franquia" maxlength="40">
                        </div>

                    </div>
                    <div class="form-group form-row">
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

                        <div class="col-2">
                            <label for="sinalizacao">Sinalização</label>
                            <select class="form-control" name="sinalizacao">
                                <option value="ISDN">ISDN</option>
                                <option value="R2">R2</option>
                                <option value="SIP">SIP</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group form-row">
                        
                        <div class="col-2">
                            <label for="tarifa_local_fixo">Local Fixo</label>
                            <input type="text" name="tarifa_local_fixo" class="form-control" placeholder="Tarifa" maxlength="8" data-mask="R$ 0,0000">
                        </div>

                        <div class="col-2">
                            <label for="tarifa_local_movel">Local Móvel</label>
                            <input type="text" name="tarifa_local_movel" class="form-control" placeholder="Tarifa" maxlength="8" data-mask="R$ 0,0000">
                        </div>

                        <div class="col-2">
                            <label for="tarifa_ld_fixo">Longa Distancia Fixo</label>
                            <input type="text" name="tarifa_ld_fixo" class="form-control" placeholder="Tarifa" maxlength="8" data-mask="R$ 0,0000">
                        </div>

                        <div class="col-2">
                            <label for="tarifa_ld_movel">Longa Distancia Móvel</label>
                            <input type="text" name="tarifa_ld_movel" class="form-control" placeholder="Tarifa" maxlength="8" data-mask="R$ 0,0000">
                        </div>

                    </div>

                    
                    <div id="dinamico"></div>
                    

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
