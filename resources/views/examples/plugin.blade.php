@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/slick-carousel/slick-theme.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/slick-carousel/slick.min.js') }}"></script>

    <!-- Page JS Helpers (Slick Slider Plugin) -->
    <script>jQuery(function(){ One.helpers('slick'); });</script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Slick Slider Example <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Plugin Integration</small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Examples</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Plugin</a>
                        </li>
                    </ol>
                </nav>
            </div>
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Info -->
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Plugin Example</h3>
                    </div>
                    <div class="block-content">
                        <p class="font-size-sm text-muted">
                            This page showcases how easily you can add a plugin’s JS/CSS assets and init it using a OneUI JS helper.
                        </p>
                    </div>
                </div>
                <!-- END Info -->

                <!-- Slider with dots -->
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Dots</h3>
                    </div>
                    <div class="js-slider" data-dots="true">
                        <div>
                            <img class="img-fluid" src="{{ asset('media/photos/photo27@2x.jpg')}}" alt="photo">
                        </div>
                        <div>
                            <img class="img-fluid" src="{{ asset('media/photos/photo28@2x.jpg')}}" alt="photo">
                        </div>
                        <div>
                            <img class="img-fluid" src="{{ asset('media/photos/photo29@2x.jpg')}}" alt="photo">
                        </div>
                    </div>
                    <!-- END Slider with dots -->
                </div>
                <!-- END Dots -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
