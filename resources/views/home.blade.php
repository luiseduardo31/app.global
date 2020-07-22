@extends('layouts.simple')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    
                        
                       
                    
                </div>

                <div class="card-body">
                   <form class="js-validation-signin" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group form-row">
                                <div class="form-group col-6">
                                    <input type="email" class="form-control form-control-alt form-control-lg" placeholder="Email" @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <input type="password" minlength="8" maxlength="12" class="form-control form-control-alt form-control-lg" placeholder="Senha" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
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
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3 col-xl-3">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Entrar
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
