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
            <!-- Titulo do block
            <div class="block-header">
                <h3 class="block-title">Linhas Cadastradas no Inventário Móvel</h3>
            </div>
            -->
            <div class="block-content">
                <p class="font-size-sm text-muted">
                    
                    <!-- Dynamic Table with Export Buttons -->
                    <div class="block">
                        <div class="block-content block-content-full">
                            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table id="contact-detail" class="responsive display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Address</th>
                                        <th data-priority="1">Phone</th>
                                        <th data-priority="2">DOB</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td>Barry</td>
                                        <td>Allen</td>
                                        <td>Florida</td>
                                        <td>2211335566</td>
                                        <td>02-02-1983</td>
                                    </tr>
                                    ...
                                    ...
                                    ...
                                    <tr>
                                        <td>Tony</td>
                                        <td>Stark</td>
                                        <td>Texas</td>
                                        <td>8899886655</td>
                                        <td>05-10-1984</td>
                                    </tr>
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
