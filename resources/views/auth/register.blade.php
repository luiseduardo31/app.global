@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                  <a href="{{route('register')}}">
                     Usuários
                  </a>
                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                       
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Usuários</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Cadastrar Novo Usuário</a>
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
            <!-- Titulo do block
            <div class="block-header">
                <h3 class="block-title">Linhas Cadastradas no Inventário Móvel</h3>
            </div>
            -->
            <div class="block-content">
               <form method="POST" action="{{ route('register') }}">
                        @csrf


                    <div class="form-group form-row"> 
                        <div class="col-4">
                            <label for="usuario">Nome</label>
                            <input type="text" id="name" name="name" maxlength="40" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                        

                        <div class="col-4">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="col-2">
                            <label for="senha">Senha</label>    
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-2">
                            <label for="senha">Confirmar Senha</label> 
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-2">
                            <label for="grupo">Tipo de Usuário</label>
                            <select class="form-control" name="tipo_usuario_id">
                                @foreach ($tipos_usuarios as $tipo)
                                    <option value="{{$tipo->id}}">
                                        {{$tipo->tipo_usuario}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-10">
                            <label for="Observacao">Observação</label> <br>
                            <input type="text"  name="observacao" class="form-control" maxlength="85">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary form-control">Salvar</button>  
                        </div>  
                        
                        <div class="col-2">
                            <a href="{{route('usuarios.index')}}" class="btn btn-danger form-control"  onclick="return confirm('Deseja realmente cancelar o cadastro?')">
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
