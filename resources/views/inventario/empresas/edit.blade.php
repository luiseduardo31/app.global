@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                  <a href="{{route('empresas.index')}}">
                     Empresas 
                  </a>
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        [Inventário Móvel]
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Inventário</li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">Editando Empresa</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">{{$empresas->razao_social}} </a>
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
               <form action="{{route('empresas.update',$empresas->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                    <div class="form-group form-row"> 
                        <div class="col-4">
                            <label for="razao_social">Razão Social</label>
                            <input type="text" name="razao_social" class="form-control" value="{{$empresas->razao_social}}" maxlength="50">
                        </div>

                        <div class="col-4">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" name="cnpj" class="form-control" value="{{$empresas->cnpj}}" maxlength="50">
                        </div>

                        <div class="col-4">
                            <label for="grupo">Grupo</label>
                            <select class="form-control selectpicker dynamic" name="grupo_id" id="grupos">
                                @foreach ($grupos as $grupo)
                                    <option value="{{$grupo->GrupoID}}" {{ ( $grupo->GrupoID == $empresas->grupos_id) ? 'selected' : '' }}>
                                        {{$grupo->grupo}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-row"> 
                        <div class="col-12">
                            <label for="Observacao">Observação</label> <br>
                            <input type="text"  name="observacao" class="form-control" value="{{$empresas->observacao}}" maxlength="145">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-2">
                        <button type="submit" class="btn btn-primary form-control">Salvar</button>  
                        </div> 
                     
                        <div class="col-2">
                            <a href="{{route('empresas.index')}}" class="btn btn-danger form-control"  onclick="return confirm('Deseja realmente cancelar a edição da empresa {{$empresas->razao_social}}?');">
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
