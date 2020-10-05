@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                  <a href="{{route('usuarios.index')}}">
                     Meus Dados 
                  </a>
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Meus Dados</li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">Editando Senha</a>
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
               <form action="{{route('meus-dados.update',$usuarios->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                    <div class="form-group form-row">

                        <div class="col-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" disabled class="form-control" value="{{$usuarios->email}}" maxlength="25">
                        </div>

                        <div class="col-2">
                            <label for="password">Digite a nova senha</label>
                            <input type="password" name="password" id="novaSenha" class="form-control" minlength="8" maxlength="12">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-2">
                        <button type="submit" id="btnEnvia" style="border: #666 1px" name="salvar" class="btn btn-primary form-control">Salvar Dados</button>  
                        </div> 
                     
                        <div class="col-2">
                            <a href="{{route('meus-dados.index')}}" class="btn btn-danger form-control"  onclick="return confirm('Deseja realmente cancelar a edição?');">
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
