@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Entre com seu email e senha.</div>

                <div class="card-body">
                        <form class="js-validation-signin" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="py-3 col-12">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-alt form-control-lg" placeholder="Digite seu Email" @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                     @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" minlength="8" maxlength="12" class="form-control form-control-alt form-control-lg" placeholder="Digite sua Senha" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                     @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                                <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Lembrar Informações') }}
                                            </label>
                                        </div>
                                        <div class="form-group">
                                        <button type="submit" style="margin-top: 10px" class="btn btn-primary">
                                            {{ __('Entrar') }}
                                        </button>
                                        </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
