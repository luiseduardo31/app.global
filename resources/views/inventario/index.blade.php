@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Inventário Móvel 
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        <!-- subtitulo caso necessário-->
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Inventário</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Linhas Cadastradas</a>
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
        
            @include('includes.alerts')
            
            <div class="block-content">
                <p class="font-size-sm text-muted">
                    
                    <!-- Dynamic Table with Export Buttons -->
                    <div class="block">
                        <div class="block-content block-content-full">
                            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table id="contact-detail" class="responsive display nowrap table table-bordered table-striped table-vcenter" cellspacing="0" width="100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>Linha</th>
                                        <th>Grupo</th>
                                        <th>Usuário</th>
                                        <th>Plano</th>
                                        <th>Tipo</th>
                                        <th>Filial</th>
                                        <th>Gestor</th>
                                        <th>Conta</th>
                                        <th>Setor</th>
                                        <th>Subsetor</th>
                                        <th>Função</th>
                                        <th>Status</th>
                                        <th>Inicio</th>
                                        <th>Chip</th>
                                        <th>R. Desp.</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($linhas as $linha)
                                    <tr>
                                        <td>{{$linha->linha}}</td>
                                        <td class="text-center">{{$linha->grupo}}</td>
                                        <td>
                                            <span style="cursor:pointer" data-toggle="tooltip" data-animation="true" data-placement="top" 
                                            title="
                                                @if($linha->data_termino === NULL )
                                                    Sem Historico!
                                                @else
                                                    {{$linha->ultimo_usuario}}, {{strftime("%d-%m-%Y", strtotime($linha->data_inicio))}} à {{strftime("%d-%m-%Y", strtotime($linha->data_termino))}}
                                                @endif
                                            ">
                                            {{$linha->nome_usuario}}</td>
                                       
                                        <td>{{$linha->plano}}</td>
                                        <td>{{$linha->tipo}}</td>
                                        <td>{{$linha->filial}}</td>
                                        <td>{{$linha->gestor}}</td>
                                        <td>{{$linha->operadora}} - {{$linha->conta}}</td>
                                        <td>{{$linha->setor}}</td>
                                        <td>{{$linha->subsetor}}</td>
                                        <td>{{$linha->funcao}}</td>
                                        <td>{{$linha->status}}</td>
                                        <td>{{strftime("%d-%m-%Y", strtotime($linha->data_registro))}}</td>
                                        <td>{{$linha->chip}}</td>
                                        <td>{{$linha->obsInventario}}</td>
                                        <td> 
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Editar Registro" data-original-title="Editar">
                                                    <a href="{{route('inventario.edit', $linha->idInventario)}}">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </a>
                                                </button>
                                                <form action="{{route('inventario.destroy',$linha->idInventario)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Excluir Registro" data-original-title="Excluir"
                                                onclick="return confirm('Deseja realmente excluir a linha {{$linha->linha}}?');">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>                                                                       
                                    @empty
                                        
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Dynamic Table with Export Buttons -->

                </p>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection
