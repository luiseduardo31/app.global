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
                            <table id="list-table" class="responsive display nowrap" cellspacing="0" width="100%">
                                
                                <thead>
                                    <tr>
                                        <th data-priority="1" style="width: 50px;">ID</th>
                                        <th data-priority="2">Name</th>
                                        <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                                        <th style="width: 15%;">Registered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center font-size-sm">1</td>
                                        <td class="font-w600 font-size-sm">
                                            <a href="be_pages_generic_blank.html">Sara Fields</a>
                                        </td>
                                        <td class="d-none d-sm-table-cell font-size-sm">
                                            client1<em class="text-muted">@example.com</em>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="badge badge-info">Business</span>
                                        </td>
                                        <td>
                                            <em class="text-muted font-size-sm">9 days ago</em>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center font-size-sm">2</td>
                                        <td class="font-w600 font-size-sm">
                                            <a href="be_pages_generic_blank.html">Jack Estrada</a>
                                        </td>
                                        <td class="d-none d-sm-table-cell font-size-sm">
                                            client2<em class="text-muted">@example.com</em>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="badge badge-danger">Disabled</span>
                                        </td>
                                        <td>
                                            <em class="text-muted font-size-sm">6 days ago</em>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center font-size-sm">3</td>
                                        <td class="font-w600 font-size-sm">
                                            <a href="be_pages_generic_blank.html">David Fuller</a>
                                        </td>
                                        <td class="d-none d-sm-table-cell font-size-sm">
                                            client3<em class="text-muted">@example.com</em>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="badge badge-success">VIP</span>
                                        </td>
                                        <td>
                                            <em class="text-muted font-size-sm">4 days ago</em>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center font-size-sm">4</td>
                                        <td class="font-w600 font-size-sm">
                                            <a href="be_pages_generic_blank.html">Thomas Riley</a>
                                        </td>
                                        <td class="d-none d-sm-table-cell font-size-sm">
                                            client4<em class="text-muted">@example.com</em>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="badge badge-primary">Personal</span>
                                        </td>
                                        <td>
                                            <em class="text-muted font-size-sm">6 days ago</em>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center font-size-sm">4</td>
                                        <td class="font-w600 font-size-sm">
                                            <a href="be_pages_generic_blank.html">Thomas Riley</a>
                                        </td>
                                        <td class="d-none d-sm-table-cell font-size-sm">
                                            client4<em class="text-muted">@example.com</em>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="badge badge-primary">Personal</span>
                                        </td>
                                        <td>
                                            <em class="text-muted font-size-sm">6 days ago</em>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center font-size-sm">4</td>
                                        <td class="font-w600 font-size-sm">
                                            <a href="be_pages_generic_blank.html">Thomas Riley</a>
                                        </td>
                                        <td class="d-none d-sm-table-cell font-size-sm">
                                            client4<em class="text-muted">@example.com</em>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="badge badge-primary">Personal</span>
                                        </td>
                                        <td>
                                            <em class="text-muted font-size-sm">6 days ago</em>
                                        </td>
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
