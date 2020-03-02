@extends('admin.layout.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                  <a href="{{route('inventario.index')}}">
                     Inventário Móvel 
                  </a>
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        <!-- subtitulo caso necessário-->
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Inventário</li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">Editando Linha</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                           <a class="link-fx" href="">{{$inventario->linha}} </a>
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
               <form action="{{route('inventario.update',$inventario->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group form-row">
                     
                     <div class="col-2">
                        <label for="Linha">Linha</label>
                     <input type="text" name="linha" disabled class="form-control" placeholder="Linha" value="{{$inventario->linha}}" maxlength="11">
                     </div>

                     <div class="col-3">
                        <label for="Conta">Conta</label>
                        <select class="form-control" name="conta_id">
                           @foreach ($contas as $conta)
                              <option value="{{$conta->id}}" {{ ( $conta->id == $inventario->conta_id) ? 'selected' : '' }}>
                                 {{$conta->conta}}
                              </option>
                           @endforeach
                        </select>
                     </div>

                     <div class="col-3">
                        <label for="Plano">Plano</label>
                        <select class="form-control" name="plano_id">
                           @foreach ($planos as $plano)
                              <option value="{{$plano->id}}" {{ ( $plano->id == $inventario->plano_id) ? 'selected' : '' }}>
                                 {{$plano->plano}}
                              </option>
                           @endforeach
                        </select>
                     </div>

                     <div class="col-2">
                        <label for="Tipo">Tipo</label>
                        <select class="form-control" name="tipo_linha_id">
                           @foreach ($tipos_linha as $tipos)
                              <option value="{{$tipos->id}}" {{ ( $tipos->id == $inventario->tipo_linha_id) ? 'selected' : '' }}>
                                 {{$tipos->tipo}}
                              </option>
                           @endforeach
                        </select>
                     </div>

                     <div class="col-2">
                        <label for="Status">Status</label>
                        <select class="form-control" name="status_id">
                           @foreach ($status as $iStatus)
                              <option value="{{$iStatus->id}}" {{ ( $iStatus->id == $inventario->status_id) ? 'selected' : '' }}>
                                 {{$iStatus->status}}
                              </option>
                           @endforeach
                        </select>
                     </div>
                  </div>

                  <div class="form-group form-row">

                     <div class="col-3">
                        <label for="Nome">Nome</label>
                        <input type="text" name="nome_usuario" class="form-control" placeholder="Nome" value="{{$inventario->nome_usuario}}" maxlength="25">
                     </div>

                     <div class="col-2">
                        <label for="Inicio">Inicio</label>
                        <input type="date" name="data_registro" class="form-control" placeholder="" value="{{$inventario->data_registro}}" style="font-size:15px">
                     </div>

                     <div class="col-3">
                        <label for="matricula">Codex</label>
                           <select class="form-control" name="matricula_id">
                           @foreach ($matriculas as $matricula)
                              <option value="{{$matricula->id}}" {{ ( $matricula->id == $inventario->matricula_id) ? 'selected' : '' }}>
                                 {{$matricula->matricula}}
                              </option>
                           @endforeach
                        </select>
                     </div>

                     <div class="col-4">
                        <label for="Funcao">Função</label>
                        <select class="form-control" name="funcao_id">
                           @foreach ($funcoes as $funcao)
                              <option value="{{$funcao->id}}" {{ ( $funcao->id == $inventario->funcao_id) ? 'selected' : '' }}>
                                 {{$funcao->funcao}}
                              </option>
                           @endforeach
                        </select>
                     </div>
                     
                  </div>

                  <div class="form-group form-row">

                     <div class="col-3">
                        <label for="Gestor">Gestor</label>
                        <select class="form-control" name="gestor_id">
                           @foreach ($gestores as $gestor)
                              <option value="{{$gestor->id}}" {{ ( $gestor->id == $inventario->gestor_id) ? 'selected' : '' }}>
                                 {{$gestor->gestor}}
                              </option>
                           @endforeach
                        </select>
                     </div>

                     <div class="col-3">
                        <label for="Setor">Setor</label>
                        <select class="form-control" name="setor_id">
                           @foreach ($setores as $setor)
                              <option value="{{$setor->id}}" {{ ( $setor->id == $inventario->setor_id) ? 'selected' : '' }}>
                                 {{$setor->setor}}
                              </option>
                           @endforeach
                        </select>
                     </div>

                     <div class="col-3">
                        <label for="SubSetor">SubSetor</label>
                        <select class="form-control" name="subsetor_id">
                           @foreach ($subsetores as $subsetor)
                              <option value="{{$subsetor->id}}" {{ ( $subsetor->id == $inventario->subsetor_id) ? 'selected' : '' }}>
                                 {{$subsetor->subsetor}}
                              </option>
                           @endforeach
                        </select>
                     </div>

                     <div class="col-3">
                        <label for="Chip">Chip (simcard)</label>
                        <input type="text" name="chip" class="form-control" placeholder="Chip" value="{{$inventario->chip}}" maxlength="20">
                     </div>
                     
                     <div class="col-12">
                        <label for="Observacao">Responsabilidade da Despesa</label> <br>
                        <input type="text"  name="observacao" class="form-control" value="{{$inventario->observacao}}" maxlength="100">
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
