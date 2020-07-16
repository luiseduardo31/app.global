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
                        <li class="breadcrumb-item">Inventário</li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">Editando Conta</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">{{$contas->conta}} </a>
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
               <form action="{{route('contas.update',$contas->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                    <div class="form-group form-row"> 
                        <div class="col-3">
                            <label for="conta">Conta</label>
                            <input type="text" name="conta" class="form-control" value="{{$contas->conta}}" maxlength="50">
                        </div>

                        <div class="col-2">
                            <label for="grupo">Grupo</label>
                            <select class="form-control selectpicker" name="grupo_id">
                                @foreach ($grupos as $grupo)
                                    <option value="{{$grupo->GrupoID}}" {{ ( $grupo->GrupoID == $contas->grupos_id) ? 'selected' : '' }}>
                                        {{$grupo->grupo}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-4">
                            <label for="grupo">Razão Social | CNPJ</label>
                            <select class="form-control selectpicker" name="empresa_id">
                                @foreach ($empresas as $empresa)
                                    <option value="{{$empresa->EmpresasID}}" {{ ( $empresa->EmpresasID == $contas->empresa_id) ? 'selected' : '' }} data-subtext=" | {{$empresa->cnpj}}">
                                        {{$empresa->razao_social}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-3">
                            <label for="operadoras">Operadoras</label>
                            <select class="form-control" name="operadora_id">
                            @foreach ($operadoras as $operadora)
                                <option value="{{$operadora->id}}" {{ ( $operadora->id == $contas->operadora_id) ? 'selected' : '' }}>
                                    {{$operadora->operadora}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-row"> 
                        <div class="col-12">
                            <label for="Observacao">Observação</label> <br>
                            <input type="text"  name="observacao" class="form-control" value="{{$contas->observacao}}" maxlength="100">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-2">
                        <button type="submit" class="btn btn-primary form-control">Salvar</button>  
                        </div> 
                     
                        <div class="col-2">
                            <a href="{{route('contas.index')}}" class="btn btn-danger form-control"  onclick="return confirm('Deseja realmente cancelar a edição da conta {{$contas->conta}}?');">
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
