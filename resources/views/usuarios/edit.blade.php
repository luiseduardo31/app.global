@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                  <a href="{{route('usuarios.index')}}">
                     Usuários 
                  </a>
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Usuário</li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">Editando Usuário</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">{{$usuarios->name}} </a>
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
               <form action="{{route('usuarios.update',$usuarios->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                    <div class="form-group form-row"> 
                        <div class="col-3">
                            <label for="usuario">Usuário</label>
                            <input type="text" name="name" class="form-control" value="{{$usuarios->name}}" maxlength="25">
                        </div>
                        <div class="col-9">
                            <label for="grupo">Tipo de Usuário</label>
                            <select class="form-control" name="tipo_usuario_id">
                                @foreach ($tipos_usuarios as $tipo)
                                    <option value="{{$tipo->id}}" {{ ( $tipo->id == $usuarios->tipo_usuario_id) ? 'selected' : '' }}>
                                        {{$tipo->tipo_usuario}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-row"> 
                        <div class="col-12">
                            <label for="Observacao">Observação</label> <br>
                            <input type="text"  name="observacao" class="form-control" value="{{$usuarios->observacao}}" maxlength="145">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-2">
                        <button type="submit" class="btn btn-primary form-control">Salvar Dados</button>  
                        </div> 
                     
                        <div class="col-2">
                            <a href="{{route('register')}}" class="btn btn-danger form-control"  onclick="return confirm('Deseja realmente cancelar a edição do usuário {{$usuarios->name}} | {{$usuarios->email}}?');">
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
