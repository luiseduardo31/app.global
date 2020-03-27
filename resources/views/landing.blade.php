@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="bg-image" style="background-image: url('{{ asset('media/photos/photo36@2x.jpg') }}');">
        <div class="hero bg-white overflow-hidden">
            <div class="hero-inner">
                <div class="content content-full text-center">
                    <h1 class="display-4 font-w600 mb-3 invisible" data-toggle="appear" data-class="animated fadeInDown">
                        Gestão Telecom 
                        <span class="text-primary font-w300">2.0</span><br>
                        <span class="font-w300" style="font-size:40px !important">Global Solutions</span>
                    </h1>
                    <h2 class="h3 font-w400 text-muted mb-5 invisible" data-toggle="appear" data-class="animated fadeInDown" data-timeout="300">
                        Bem vindo ao nosso sistema de Gestão Telecom!
                    </h2>
                    <span class="m-2 d-inline-block invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="600">
                        <a class="btn btn-success px-4 py-2" href="/login">
                            <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Vamos Começar?
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection
