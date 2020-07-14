@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                  <a href="{{route('subsetores.index')}}">
                     Contas
                  </a>
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        [Inventario Móvel]
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Contas</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Cadastrar Nova Conta</a>
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
               <form action="{{route('contas.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group form-row">
                        <div class="col-3">
                            <label for="conta">Conta</label>
                            <input type="text" name="conta" class="form-control" placeholder="Conta" maxlength="50">
                        </div>
                        <div class="col-2">
                            <label for="grupo">Grupo Empresarial</label>
                            <select class="form-control" name="grupo_id">
                            @foreach ($grupos as $grupo)
                                <option value="{{$grupo->GrupoID}}">{{$grupo->grupo}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="col-4">
                            <label for="user">Razão Social | CNPJ</label>
                            <select class="form-control selectpicker" data-size="5" name="empresa_id">
                                <option readonly>Escolha uma opção</option>
                            @foreach ($empresas as $empresa)
                                <option data-subtext=" | {{$empresa->cnpj}}" value="{{$empresa->EmpresasID}}">{{$empresa->razao_social}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="col-3">
                            <label for="operadora">Operadora</label>
                            <select class="form-control" name="operadora_id">
                            @foreach ($operadoras as $operadora)
                                <option value="{{$operadora->id}}">{{$operadora->operadora}}</option>
                            @endforeach
                            </select>
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
                            <a href="{{route('contas.index')}}" class="btn btn-danger form-control"  onclick="return confirm('Deseja realmente cancelar o cadastro?')">
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
