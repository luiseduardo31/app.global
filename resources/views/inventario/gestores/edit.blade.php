@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                  <a href="{{route('gestores.index')}}">
                     Gestores 
                  </a>
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        [Inventário Móvel]
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Inventário</li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">Editando Gestor</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">{{$gestores->gestor}} </a>
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
               <form action="{{route('gestores.update',$gestores->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                    <div class="form-group form-row"> 
                        <div class="col-3">
                            <label for="Gestor">Gestor</label>
                            <input type="text" name="gestor" class="form-control" value="{{$gestores->gestor}}" maxlength="25">
                        </div>
                        <div class="col-9">
                            <label for="grupo">Grupo Empresarial</label>
                            <select class="form-control" name="grupo_id">
                                @foreach ($grupos as $grupo)
                                    <option value="{{$grupo->GrupoID}}" {{ ( $grupo->GrupoID == $gestores->grupo_id) ? 'selected' : '' }}>
                                        {{$grupo->grupo}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group form-row"> 
                        <div class="col-12">
                            <label for="Observacao">Observação</label> <br>
                            <input type="text"  name="observacao" class="form-control" value="{{$gestores->observacao}}" maxlength="145">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-2">
                        <button type="submit" class="btn btn-primary form-control">Salvar Dados</button>  
                        </div> 
                     
                        <div class="col-2">
                            <a href="{{route('gestores.index')}}" class="btn btn-danger form-control"  onclick="return confirm('Deseja realmente cancelar a edição do gestor {{$gestores->gestor}}?');">
                                Cancelar Edição
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
