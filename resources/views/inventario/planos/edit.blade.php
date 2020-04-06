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
                        [Inventário Móvel]
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Inventário</li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">Editando Plano</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">{{$planos->plano}} </a>
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
               <form action="{{route('planos.update',$planos->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                    <div class="form-group form-row"> 
                        <div class="col-3">
                            <label for="plano">Plano</label>
                            <input type="text" name="plano" class="form-control" value="{{$planos->plano}}" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group form-row"> 
                        <div class="col-12">
                            <label for="Observacao">Observação</label> <br>
                            <input type="text"  name="observacao" class="form-control" value="{{$planos->observacao}}" maxlength="145">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-2">
                        <button type="submit" class="btn btn-primary form-control">Salvar</button>  
                        </div> 
                     
                        <div class="col-2">
                            <a href="{{route('planos.index')}}" class="btn btn-danger form-control"  onclick="return confirm('Deseja realmente cancelar a edição do plano {{$planos->plano}}?');">
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
