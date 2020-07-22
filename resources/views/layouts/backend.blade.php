<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Inventario</title>

        <meta name="description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
        <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

        <!-- Page JS Plugins CSS -->
        
        <link href="{{URL::asset('/js/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset('/js/plugins/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset('/css/style.css')}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset('/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css">

        <!-- Latest compiled and minified CSS -->
        
        <!-- Fonts and Styles -->
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link href="{{URL::asset('/css/oneui.css') }}" rel="stylesheet" type="text/css">

        
        <!-- <link rel="stylesheet" id="css-theme" href="{{ mix('/css/themes/amethyst.css') }}"> -->
        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        @yield('css_after')

        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
       
    </head>
    <body>
    <!-- Page Container -->
    <!--
            Available classes for #page-container:

        GENERIC

            'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

        SIDEBAR & SIDE OVERLAY

            'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
            'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
            'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
            'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
            'sidebar-dark'                              Dark themed sidebar

            'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
            'side-overlay-o'                            Visible Side Overlay by default

            'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

            'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

        HEADER

            ''                                          Static Header if no class is added
            'page-header-fixed'                         Fixed Header

        HEADER STYLE

            ''                                          Light themed Header
            'page-header-dark'                          Dark themed Header

        MAIN CONTENT LAYOUT

            ''                                          Full width Main Content if no class is added
            'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
            'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
        -->
        <div id="page-container" class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed">
            <!-- Side Overlay-->
            <aside id="side-overlay" class="font-size-sm">
                <!-- Side Header -->
                <div class="content-header border-bottom">
                    <!-- User Avatar -->
                    <a class="img-link mr-1" href="javascript:void(0)">
                        <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
                    </a>
                    <!-- END User Avatar -->

                    <!-- User Info -->
                    <div class="ml-2">
                        <a class="link-fx text-dark font-w600" href="javascript:void(0)">Adam McCoy</a>
                    </div>
                    <!-- END User Info -->

                    <!-- Close Side Overlay -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="ml-auto btn btn-sm btn-dual" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
                        <i class="fa fa-fw fa-times text-danger"></i>
                    </a>
                    <!-- END Close Side Overlay -->
                </div>
                <!-- END Side Header -->

                <!-- Side Content -->
                <div class="content-side">
                    <p>
                        Content..
                    </p>
                </div>
                <!-- END Side Content -->
            </aside>
            <!-- END Side Overlay -->

            <!-- Sidebar -->
            <!--
                Sidebar Mini Mode - Display Helper classes

                Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
                Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
                    If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

                Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
                Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
                Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
            -->
            <nav id="sidebar" aria-label="Main Navigation">
            <!-- Side Header -->
                <div class="content-header bg-white-5">
                    <!-- Logo -->
                    <a class="font-w600 text-dual" href="/">
                        <i class="fa fa-circle-notch text-primary"></i>
                        <span class="smini-hide">
                            <span class="font-w700 font-size-h5">Global</span> <span class="font-w400">2.0</span>
                        </span>
                    </a>
                    <!-- END Logo -->

                    <!-- Options -->
                    <div>
                        <!-- Color Variations -->
                        <div class="dropdown d-inline-block ml-3">
                            <!-- Ocultando funções de cores do template
                                <a class="text-dual font-size-sm" id="sidebar-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="si si-drop"></i>
                                </a>
                            -->
                            <div class="dropdown-menu dropdown-menu-right font-size-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">
                                <!-- Color Themes -->
                                <!-- Layout API, functionality initialized in Template._uiHandleTheme() -->
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="default" href="#">
                                    <span>Default</span>
                                    <i class="fa fa-circle text-default"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ asset('css/themes/amethyst.css') }}" href="#">
                                    <span>Amethyst</span>
                                    <i class="fa fa-circle text-amethyst"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ asset('css/themes/city.css') }}" href="#">
                                    <span>City</span>
                                    <i class="fa fa-circle text-city"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ asset('css/themes/flat.css') }}" href="#">
                                    <span>Flat</span>
                                    <i class="fa fa-circle text-flat"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ asset('css/themes/modern.css') }}" href="#">
                                    <span>Modern</span>
                                    <i class="fa fa-circle text-modern"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ asset('css/themes/smooth.css') }}" href="#">
                                    <span>Smooth</span>
                                    <i class="fa fa-circle text-smooth"></i>
                                </a>
                                <!-- END Color Themes -->

                                <div class="dropdown-divider"></div>

                                <!-- Sidebar Styles -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <a class="dropdown-item" data-toggle="layout" data-action="sidebar_style_light" href="#">
                                    <span>Sidebar Light</span>
                                </a>
                                <a class="dropdown-item" data-toggle="layout" data-action="sidebar_style_dark" href="#">
                                    <span>Sidebar Dark</span>
                                </a>
                                <!-- Sidebar Styles -->

                                <div class="dropdown-divider"></div>

                                <!-- Header Styles -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <a class="dropdown-item" data-toggle="layout" data-action="header_style_light" href="#">
                                    <span>Header Light</span>
                                </a>
                                <a class="dropdown-item" data-toggle="layout" data-action="header_style_dark" href="#">
                                    <span>Header Dark</span>
                                </a>
                                <!-- Header Styles -->
                            </div>
                        </div>
                        <!-- END Themes -->

                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="d-lg-none text-dual ml-3" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                            <i class="fa fa-times"></i>
                        </a>
                        <!-- END Close Sidebar -->
                    </div>
                    <!-- END Options -->
                </div>
                <!-- END Side Header -->

                <!-- Side Navigation -->
                <div class="content-side content-side-full">
                    <ul class="nav-main">
                        <li class="nav-main-item">
                        <!--
                            <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                                <i class="nav-main-link-icon si si-cursor"></i>
                                <span class="nav-main-link-name">Dashboard</span>
                            </a>
                        -->
                        </li>
                        <li class="nav-main-heading">MENU</li>
                        
                        <!-- PAINEL DE CONTROLE -->
                        @if(Auth::user()->tipo_usuario_id == 1)
                              
                        <li class="nav-main-item">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="nav-main-link-icon si si-lock"></i>
                                <span class="nav-main-link-name">Painel de Controle</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                        <i class="nav-main-link-icon fa fa-user"></i>
                                        <span class="nav-main-link-name">Usuários / Acessos</span>
                                    </a>
                                    <ul class="nav-main-submenu">
                                        <li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is('register') ? ' active' : '' }}" href="/register">
                                                <span class="nav-main-link-name">Cadastrar Usuário</span>
                                            </a>
                                        </li>
                                        <li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is('usuarios') ? ' active' : '' }}" href="/usuarios/">
                                                <span class="nav-main-link-name">Usuários Cadastrados</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav-main-submenu">
                                        <li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is('acessos/create') ? ' active' : '' }}" href="/acessos/create">
                                                <span class="nav-main-link-name">Cadastrar Acesso</span>
                                            </a>
                                        </li>
                                        <li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is('acessos') ? ' active' : '' }}" href="/acessos/">
                                                <span class="nav-main-link-name">Acessos Cadastrados</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            
                            <ul class="nav-main-submenu">
                                <!-- Submenu Inventario ADM -->
                                <li class="nav-main-item">
                                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                        <i class="nav-main-link-icon si si-note"></i>
                                        <span class="nav-main-link-name">Inventario Móvel</span>
                                    </a>
                                    <ul class="nav-main-submenu">
                                        <li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is('inventario/create') ? ' active' : '' }}" href="/inventario/create">
                                                <span class="nav-main-link-name">Cadastrar Linha</span>
                                            </a>
                                        </li>
                                        <!-- Submenu Funções -->
                                        <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                                    <i class="nav-main-link-icon si si-note"></i>
                                                    <span class="nav-main-link-name">Funções</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link{{ request()->is('funcoes/create') ? ' active' : '' }}" href="/funcoes/create">
                                                            <span class="nav-main-link-name">Cadastrar Função</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link{{ request()->is('funcoes') ? ' active' : '' }}" href="/funcoes/">
                                                            <span class="nav-main-link-name">Funções Cadastradas</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!-- Fim Submenu Funções -->
                                            <!-- Submenu Gestores -->
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                                    <i class="nav-main-link-icon si si-note"></i>
                                                    <span class="nav-main-link-name">Gestores</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link{{ request()->is('gestores/create') ? ' active' : '' }}" href="/gestores/create">
                                                            <span class="nav-main-link-name">Cadastrar Gestor</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link{{ request()->is('gestores') ? ' active' : '' }}" href="/gestores/">
                                                            <span class="nav-main-link-name">Gestores Cadastrados</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!-- Fim Submenu Gestores -->
                                            <!-- Submenu Matriculas -->
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                                    <i class="nav-main-link-icon si si-note"></i>
                                                    <span class="nav-main-link-name">Filiais</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link{{ request()->is('filiais/create') ? ' active' : '' }}" href="/filiais/create">
                                                            <span class="nav-main-link-name">Cadastrar Filial</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link{{ request()->is('filiais') ? ' active' : '' }}" href="/filiais/">
                                                            <span class="nav-main-link-name">Filiais Cadastradas</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!-- Fim Submenu Matriculas -->
                                            <!-- Submenu Setores -->
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                                    <i class="nav-main-link-icon si si-note"></i>
                                                    <span class="nav-main-link-name">Setores</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link{{ request()->is('setores/create') ? ' active' : '' }}" href="/setores/create">
                                                            <span class="nav-main-link-name">Cadastrar Setores</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link{{ request()->is('setores') ? ' active' : '' }}" href="/setores/">
                                                            <span class="nav-main-link-name">Setores Cadastrados</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!-- Fim Submenu Setores -->
                                            <!-- Submenu SubSetores -->
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                                    <i class="nav-main-link-icon si si-note"></i>
                                                    <span class="nav-main-link-name">Subsetores</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link{{ request()->is('subsetores/create') ? ' active' : '' }}" href="/subsetores/create">
                                                            <span class="nav-main-link-name">Cadastrar Subsetores</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link{{ request()->is('subsetores') ? ' active' : '' }}" href="/subsetores/">
                                                            <span class="nav-main-link-name">Subsetores Cadastrados</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!-- Fim Submenu SubSetores -->
                                            <!-- Submenu Planos -->
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                                    <i class="nav-main-link-icon si si-note"></i>
                                                    <span class="nav-main-link-name">Planos</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link{{ request()->is('planos/create') ? ' active' : '' }}" href="/planos/create">
                                                            <span class="nav-main-link-name">Cadastrar Plano</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link{{ request()->is('planos') ? ' active' : '' }}" href="/planos/">
                                                            <span class="nav-main-link-name">Planos Cadastrados</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!-- Fim Submenu Planos -->
                                            <!-- Submenu Contas -->
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                                    <i class="nav-main-link-icon si si-note"></i>
                                                    <span class="nav-main-link-name">Contas</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link{{ request()->is('contas/create') ? ' active' : '' }}" href="/contas/create">
                                                            <span class="nav-main-link-name">Cadastrar Conta</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link{{ request()->is('contas') ? ' active' : '' }}" href="/contas/">
                                                            <span class="nav-main-link-name">Contas Cadastradas</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            </ul>
                                        </li>
                                
                                        <!-- Menu Contratos -->
                                            <li class="nav-main-item{{ request()->is('examples/*') ? ' open' : '' }}">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                                                    <i class="nav-main-link-icon far fa-address-book"></i>
                                                    <span class="nav-main-link-name">Contratos Telecom</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                    
                                                    <!-- Submenu Contratos Fixos -->
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                                            <i class="nav-main-link-icon si si-note"></i>
                                                            <span class="nav-main-link-name">Contratos Fixos</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link{{ request()->is('contratos-fixo/create') ? ' active' : '' }}" href="/contratos-fixo/create">
                                                                    <span class="nav-main-link-name">Cadastrar Contrato</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link{{ request()->is('contratos-fixo') ? ' active' : '' }}" href="/contratos-fixo/">
                                                                    <span class="nav-main-link-name">Contratos Cadastrados</span>
                                                                </a>
                                                            </li>
                                                        </ul> 
                                                    </li>
                                                    <!-- Fim Submenu Contratos Fixos -->

                                                    <!-- Submenu Contratos Móveis -->
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                                            <i class="nav-main-link-icon si si-note"></i>
                                                            <span class="nav-main-link-name">Contratos Móveis</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link{{ request()->is('contratos-movel/create') ? ' active' : '' }}" href="/contratos-movel/create">
                                                                    <span class="nav-main-link-name">Cadastrar Contrato</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link{{ request()->is('contratos-movel') ? ' active' : '' }}" href="/contratos-movel/">
                                                                    <span class="nav-main-link-name">Contratos Cadastrados</span>
                                                                </a>
                                                            </li>
                                                        </ul> 
                                                    </li>
                                                    <!-- Fim Submenu Contratos Móveis -->
                                                    
                                                </ul>
                                            </li>
                                        <!-- Fim Menu Contratos -->
                            </ul>
                        </li>
                        @endif
                        
                        <li class="nav-main-item{{ request()->is('examples/*') ? ' open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                                <i class="nav-main-link-icon far fa-address-book"></i>
                                <span class="nav-main-link-name">Inventário Móvel</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('inventario') ? ' active' : '' }}" href="/inventario/">
                                        <span class="nav-main-link-name">Linhas Cadastradas</span>
                                    </a>
                                </li>
                            </ul>
                        </li>     
                         
                        

 

                        <!-- Menu
                        <li class="nav-main-heading">More</li>
                        <li class="nav-main-item open">
                            <a class="nav-main-link" href="/">
                                <i class="nav-main-link-icon si si-globe"></i>
                                <span class="nav-main-link-name">Landing</span>
                            </a>
                        </li>
                        -->
                    </ul>
                </div>
                <!-- END Side Navigation -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="d-flex align-items-center">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                        <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                        <!-- END Toggle Sidebar -->

                        <!-- Toggle Mini Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                        <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                            <i class="fa fa-fw fa-ellipsis-v"></i>
                        </button>
                        <!-- END Toggle Mini Sidebar -->

                        <!-- Apps Modal -->
                        <!-- Mostra uma paleta de app's que posso usar no futuro
                        <button type="button" class="btn btn-sm btn-dual mr-2" data-toggle="modal" data-target="#one-modal-apps">
                            <i class="si si-grid"></i>
                        </button>
                         -->
                        <!-- END Apps Modal -->

                        <!-- Open Search Section (visible on smaller screens) -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-sm btn-dual d-sm-none" data-toggle="layout" data-action="header_search_on">
                            <i class="si si-magnifier"></i>
                        </button>
                        <!-- END Open Search Section -->

                        <!-- Search Form (visible on larger screens)
                        <form class="d-none d-sm-inline-block" action="/dashboard" method="POST">
                            @csrf
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="page-header-search-input2">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-body border-0">
                                        <i class="si si-magnifier"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        END Search Form -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="d-flex align-items-center">
                        <!-- User Dropdown -->
                        <div class="dropdown d-inline-block ml-2">
                            <button type="button" class="btn btn-sm btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="Header Avatar" style="width: 18px;">
                                <span class="d-none d-sm-inline-block ml-1">{{ Auth::user()->name }}</span>
                                <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-user-dropdown">
                                <div class="p-3 text-center bg-primary">
                                    <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
                                </div>
                                <div class="p-2">
                                    <h5 class="dropdown-header text-uppercase">USUÁRIO</h5>
                                    <!-- Itens do Profile
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                        <span>Inbox</span>
                                        <span>
                                            <span class="badge badge-pill badge-primary">3</span>
                                            <i class="si si-envelope-open ml-1"></i>
                                        </span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                        <span>Profile</span>
                                        <span>
                                            <span class="badge badge-pill badge-success">1</span>
                                            <i class="si si-user ml-1"></i>
                                        </span>
                                    </a>
                                    -->
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                        <span>Configurações</span>
                                        <i class="si si-settings"></i>
                                    </a>
                                    <div role="separator" class="dropdown-divider"></div>
                                    <h5 class="dropdown-header text-uppercase">Ações</h5>
                                    <!-- Elemento bloquear conta
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                        <span>Lock Account</span>
                                        <i class="si si-lock ml-1"></i>
                                    </a>
                                    -->
                                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }} <i class="si si-logout ml-1"></i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                        
                                        
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- END User Dropdown -->

                        <!-- Notifications Dropdown 
                        <div class="dropdown d-inline-block ml-2">
                            <button type="button" class="btn btn-sm btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="si si-bell"></i>
                                <span class="badge badge-primary badge-pill">6</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-2 bg-primary text-center">
                                    <h5 class="dropdown-header text-uppercase text-white">Notifications</h5>
                                </div>
                                <ul class="nav-items mb-0">
                                    <li>
                                        <a class="text-dark media py-2" href="javascript:void(0)">
                                            <div class="mr-2 ml-3">
                                                <i class="fa fa-fw fa-check-circle text-success"></i>
                                            </div>
                                            <div class="media-body pr-2">
                                                <div class="font-w600">You have a new follower</div>
                                                <small class="text-muted">15 min ago</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-dark media py-2" href="javascript:void(0)">
                                            <div class="mr-2 ml-3">
                                                <i class="fa fa-fw fa-plus-circle text-info"></i>
                                            </div>
                                            <div class="media-body pr-2">
                                                <div class="font-w600">1 new sale, keep it up</div>
                                                <small class="text-muted">22 min ago</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-dark media py-2" href="javascript:void(0)">
                                            <div class="mr-2 ml-3">
                                                <i class="fa fa-fw fa-times-circle text-danger"></i>
                                            </div>
                                            <div class="media-body pr-2">
                                                <div class="font-w600">Update failed, restart server</div>
                                                <small class="text-muted">26 min ago</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-dark media py-2" href="javascript:void(0)">
                                            <div class="mr-2 ml-3">
                                                <i class="fa fa-fw fa-plus-circle text-info"></i>
                                            </div>
                                            <div class="media-body pr-2">
                                                <div class="font-w600">2 new sales, keep it up</div>
                                                <small class="text-muted">33 min ago</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-dark media py-2" href="javascript:void(0)">
                                            <div class="mr-2 ml-3">
                                                <i class="fa fa-fw fa-user-plus text-success"></i>
                                            </div>
                                            <div class="media-body pr-2">
                                                <div class="font-w600">You have a new subscriber</div>
                                                <small class="text-muted">41 min ago</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-dark media py-2" href="javascript:void(0)">
                                            <div class="mr-2 ml-3">
                                                <i class="fa fa-fw fa-check-circle text-success"></i>
                                            </div>
                                            <div class="media-body pr-2">
                                                <div class="font-w600">You have a new follower</div>
                                                <small class="text-muted">42 min ago</small>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <div class="p-2 border-top">
                                    <a class="btn btn-sm btn-light btn-block text-center" href="javascript:void(0)">
                                        <i class="fa fa-fw fa-arrow-down mr-1"></i> Load More..
                                    </a>
                                </div>
                            </div>
                        </div>
                        END Notifications Dropdown -->

                        <!-- Toggle Side Overlay 
                        Layout API, functionality initialized in Template._uiApiLayout()
                        <button type="button" class="btn btn-sm btn-dual ml-2" data-toggle="layout" data-action="side_overlay_toggle">
                            <i class="fa fa-fw fa-list-ul fa-flip-horizontal"></i>
                        </button>
                        END Toggle Side Overlay -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Search -->
                <div id="page-header-search" class="overlay-header bg-white">
                    <div class="content-header">
                        <form class="w-100" action="/dashboard" method="POST">
                            @csrf
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <button type="button" class="btn btn-danger" data-toggle="layout" data-action="header_search_off">
                                        <i class="fa fa-fw fa-times-circle"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                            </div>
                        </form>
                   </div>
                </div>
                <!-- END Header Search -->

                <!-- Header Loader -->
                <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
                <div id="page-header-loader" class="overlay-header bg-white">
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                @yield('content')
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="bg-body-light">
               <!-- Dados rodapé do sistema
                <div class="content py-3">
                    <div class="row font-size-sm">
                        <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
                            Crafted with <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
                        </div>
                        <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-left">
                            <a class="font-w600" href="https://1.envato.market/xWy" target="_blank">OneUI</a> &copy; <span data-toggle="year-copy">2018</span>
                        </div>
                    </div>
                </div>
                -->
            </footer>
            <!-- END Footer -->

            <!-- Apps Modal -->
            <!-- Opens from the modal toggle button in the header -->
            <div class="modal fade" id="one-modal-apps" tabindex="-1" role="dialog" aria-labelledby="one-modal-apps" aria-hidden="true">
                <div class="modal-dialog modal-dialog-top modal-sm" role="document">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Apps</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="row gutters-tiny">
                                    <div class="col-6">
                                        <!-- CRM -->
                                        <a class="block block-rounded block-themed bg-default" href="javascript:void(0)">
                                            <div class="block-content text-center">
                                                <i class="si si-speedometer fa-2x text-white-75"></i>
                                                <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                                    CRM
                                                </p>
                                            </div>
                                        </a>
                                        <!-- END CRM -->
                                    </div>
                                    <div class="col-6">
                                        <!-- Products -->
                                        <a class="block block-rounded block-themed bg-danger" href="javascript:void(0)">
                                            <div class="block-content text-center">
                                                <i class="si si-rocket fa-2x text-white-75"></i>
                                                <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                                    Products
                                                </p>
                                            </div>
                                        </a>
                                        <!-- END Products -->
                                    </div>
                                    <div class="col-6">
                                        <!-- Sales -->
                                        <a class="block block-rounded block-themed bg-success mb-0" href="javascript:void(0)">
                                            <div class="block-content text-center">
                                                <i class="si si-plane fa-2x text-white-75"></i>
                                                <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                                    Sales
                                                </p>
                                            </div>
                                        </a>
                                        <!-- END Sales -->
                                    </div>
                                    <div class="col-6">
                                        <!-- Payments -->
                                        <a class="block block-rounded block-themed bg-warning mb-0" href="javascript:void(0)">
                                            <div class="block-content text-center">
                                                <i class="si si-wallet fa-2x text-white-75"></i>
                                                <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                                    Payments
                                                </p>
                                            </div>
                                        </a>
                                        <!-- END Payments -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Apps Modal -->
        </div>
        <!-- END Page Container -->

        <!-- OneUI Core JS -->
        <script src="{{ mix('js/oneui.app.js') }}"></script>

        <!-- Laravel Scaffolding JS -->
        <script src="{{ mix('js/laravel.app.js') }}"></script>
        
        
        @yield('js_after')
        
        <!-- Page JS Plugins -->
        <script src="{{URL::asset('js/plugins/datatables/datatables.min.js')}}"></script>

        <script src="{{URL::asset('asset/js/oneui.core.min.js')}}"></script>
        <script src="{{URL::asset('asset/js/oneui.app.min.js')}}"></script>
        <script src="{{URL::asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="{{URL::asset('/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>
        <script src="{{URL::asset('/js/plugins/datatables/buttons/buttons.html5.min.js')}}"></script>
        <script src="{{URL::asset('/js/plugins/jquery-mask-plugin/jquery.mask.js')}}"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

        

        

        

        <!-- Ativar datatable original 
        <script src="{{URL::asset('assets/js/pages/be_tables_datatables.min.js')}}"></script>
        -->
        <!-- selectpicker = adicionar subtitulo select option -->
        <script>
            $(document).ready( function() {
                $('.selectpicker').selectpicker({
                    showSubtext:true
                });
                
                $('#contact-detail').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [ {
                        text: 'Exportar Excel',
                        extend: 'excelHtml5',
                        autoFilter: true,
                        sheetName: 'Inventario Movel'
                    } ],
                } );

            } );

            
        </script>
  

    </body>
</html>
