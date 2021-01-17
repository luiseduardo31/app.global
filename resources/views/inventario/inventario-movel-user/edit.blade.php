@extends('layouts.page-simple')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Minha Linha</li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">{{$linha->linha}} </a>
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
               <form action="{{route('minha-linha.update',$linha->id)}}" class="form-inline mb-4" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="token" value="disable">
                    <!-- Labels on top -->
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Formulário de atualização de inventário</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p class="font-size-sm text-muted">
                                       Por favor, preencha as informações abaixo:
                                    </p>
                                </div>
                                <div class="col-lg-8">
                                    <!-- Form Labels on top - Default Style -->
                                        <div class="form-group">
                                            <label>Linha</label>
                                            <input type="text" name="linha" disabled class="form-control mb-2 mr-sm-2 mb-sm-0" value="{{$linha->linha}}" maxlength="11">
                                        </div>
                                        <div class="form-group">
                                             <label for="grupo">Grupo</label>
                                             <select class="form-control mb-2 mr-sm-2 mb-sm-0 selectpicker" name="grupo_id" disabled>
                                             @foreach ($grupos as $grupo)
                                                <option value="{{$grupo->grupoID}}" {{ ( $grupo->grupoID == $linha->grupo_id) ? 'selected' : '' }}>
                                                   {{$grupo->grupo}}
                                             @endforeach
                                             </select>
                                        </div>
                                         
                                        <div class="form-group">
                                             <label for="nome">Nome</label>
                                             <input type="text" name="nome_usuario" class="form-control" value="{{$linha->nome_usuario}}"  minlength="10" maxlength="25">
                                         </div>

                                          <div class="form-group">
                                             <label for="email">E-mail</label>
                                             <input type="text" name="email" class="form-control" value="{{$linha->email}}" maxlength="50">
                                         </div>
                                        
                                         <div class="form-group">
                                             <label for="filial">Filial</label>
                                             <input type="text" name="filial" class="form-control" value="{{$linha->filial}}" maxlength="50">
                                         </div>
                                         
                                         <div class="form-group">
                                             <label for="funcao">Função</label>
                                             <input type="text" name="funcao" class="form-control" value="{{$linha->funcao}}" maxlength="50">
                                         </div>

                                         <div class="form-group">
                                             <label for="setor">Setor</label>
                                             <input type="text" name="setor" class="form-control" value="{{$linha->setor}}" maxlength="50">
                                         </div>

                                         <div class="form-group">
                                             <label for="subsetor">Subsetor</label>
                                             <input type="text" name="subsetor" class="form-control" value="{{$linha->subsetor}}" maxlength="50">
                                         </div>

                                         <div class="form-group">
                                             <label for="gestor">Gestor</label>
                                             <input type="text" name="gestor" class="form-control" value="{{$linha->gestor}}" maxlength="50">
                                         </div>

                                         <div class="form-group form-row">  
                                             <div class="col-12">
                                                <label for="observacao">Observação</label> <br>
                                                <textarea name="observacao" class="form-control" rows="3">{{$linha->observacao}}</textarea>
                                             </div>
                                         </div>

                                         <div class="form-group form-row">
                                            <div class="col-6">
                                               <button type="submit" class="btn btn-primary form-control">Salvar</button>  
                                            </div>                   
                                       
                                            <div class="col-6">
                                                <button type="reset" class="btn btn-danger form-control">Limpar</button>
                                             </div>
                                         </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Labels on top -->
               </form>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection
