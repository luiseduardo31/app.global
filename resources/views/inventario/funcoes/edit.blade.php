@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                  <a href="{{route('inventario.index')}}">
                     Funções 
                  </a>
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        [Inventário Móvel]
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Inventário</li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">Editando Função</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">{{$funcoes->funcao}} </a>
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
               <form action="{{route('funcoes.update',$funcoes->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                    <div class="form-group form-row"> 
                        <div class="col-2">
                            <label for="Funcao">Função</label>
                            <input type="text" name="funcao" class="form-control" value="{{$funcoes->funcao}}" maxlength="25">
                        </div>
                    </div>

                    <div class="form-group form-row"> 
                        <div class="col-12">
                            <label for="Observacao">Observação</label> <br>
                            <input type="text"  name="observacao" class="form-control" value="{{$funcoes->observacao}}" maxlength="100">
                        </div>
                    </div>

                  <div class="form-group form-row">
                     <div class="col-1">
                        <button type="submit" class="btn btn-primary">Salvar Dados</button>  
                     </div>                   
                  </div>
                     
               </form>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection
