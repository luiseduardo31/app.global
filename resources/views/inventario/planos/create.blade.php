@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                  <a href="{{route('planos.index')}}">
                     Planos
                  </a>
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        [Inventario Móvel]
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Planos</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Cadastrar Novo Plano</a>
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
               <form action="{{route('planos.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group form-row">
                        <div class="col-3">
                            <label for="plano">Plano</label>
                            <input type="text" name="plano" class="form-control" placeholder="Ex.: Smart Vivo 0.5GB" maxlength="50">
                        </div>
                        <div class="col-2">
                            <label for="custo_plano">Custo do Plano</label>
                            <input type="text" name="custo_plano" class="form-control money" placeholder="Ex.: R$ 44,90" maxlength="50">
                        </div>
                        <div class="col-3">
                            <label for="operadora">Operadora</label>
                            <select class="form-control selectpicker" name="operadora_id">
                            @foreach ($operadoras as $operadora)
                                <option value="{{$operadora->id}}">{{$operadora->operadora}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="col-4">
                            <label for="grupo">Grupo Empresarial</label>
                            <select class="form-control selectpicker" name="grupo_id">
                            @foreach ($grupos as $grupo)
                                <option value="{{$grupo->GrupoID}}">{{$grupo->grupo}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-12">
                            <label for="Observacao">Observação</label> <br>
                            <input type="text" name="observacao" class="form-control" maxlength="145">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary form-control">Salvar</button>  
                        </div>  
                        
                        <div class="col-2">
                            <a href="{{route('planos.index')}}" class="btn btn-danger form-control"  onclick="return confirm('Deseja realmente cancelar o cadastro?')">
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
