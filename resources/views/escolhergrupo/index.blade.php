@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Seus Grupos Empresariais 
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        | Escolha um grupo 
                    </small>
                </h1>
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
                <div class="form-group form-row">

                    @if(Auth::user()->tipo_usuario_id == 1)
                        <div class="col-sm-2">
                            <div class="card">
                                <h5 class="card-header">
                                    Todos os Grupos
                                </h5>
                                <div class="card-body">
                                    <p class="card-text"> </p>
                                    <form action="{{route('escolher-grupo.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                    <input type="hidden" name="grupo_nome" value="Todos os Grupos">
                                    <button type="submit" value="0" name="grupo" class="btn btn-primary form-control">Escolher</button>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    @endif

                    @forelse ($grupos as $grupo)
                        <div class="col-sm-2">
                            <div class="card">
                                <h5 class="card-header">
                                    {{$grupo->grupo}}
                                </h5>
                                <div class="card-body">
                                    <p class="card-text"> </p>
                                    <form action="{{route('escolher-grupo.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                    <input type="hidden" name="grupo_nome" value="{{$grupo->grupo}}">
                                    <button type="submit" value="{{$grupo->id}}" name="grupo" class="btn btn-primary form-control">Escolher Grupo</button>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection


