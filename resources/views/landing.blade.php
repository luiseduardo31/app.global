@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="bg-image" style="background-image: url('{{ asset('media/photos/photo36@2x.jpg') }}');">
        <div class="hero bg-white overflow-hidden">
            <div class="hero-inner">
                <div class="content content-full text-center">
                    <h1 class="display-4 font-w600 mb-3 invisible" data-toggle="appear" data-class="animated fadeInDown">
                        OneUI <span class="text-primary font-w300">4.0</span> <span class="font-w300">+ Laravel</span>
                    </h1>
                    <h2 class="h3 font-w400 text-muted mb-5 invisible" data-toggle="appear" data-class="animated fadeInDown" data-timeout="300">
                        Welcome to the starter kit! Build something amazing!
                    </h2>
                    <span class="m-2 d-inline-block invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="600">
                        <a class="btn btn-success px-4 py-2" href="/dashboard">
                            <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Enter Dashboard
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection
