<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Temporary Device</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'>
    <link rel="shortcut icon" href="img/favicon.ico"/>

  @include('common/headerlink')

</head>
<body class="skin-coreplus nav-fixed">
<div class="preloader">
    <div class="loader_img"><img src="{{asset('public/assets/images/loader.gif')}}" alt="loading..." height="64" width="64"></div>
</div>
<!-- header logo: style can be found in header-->

@include('common/header')
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    @include('common/sidebar')


    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header fixed_header_menu">
            <h1>
                Temporary Device
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item pt-1"><a href="{{ url('temporary/list') }}"><i class="fa fa-fw fa-home"></i> Temporary Device</a>
                </li>
            </ol>
            @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }} toastrshow" id="showtoast">{{ Session::get('message') }}</p>
        <!-- <p class="alert {{ Session::get('alert-class', 'alert-info') }} toastrshow" id="showtoast">{{ Session::get('role') }}</p> -->
        @endif
        <!-- Main content -->
            
        </section>
            
                <section class="content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card border-primary">
                                <div class="card-header text-white bg-primary">
                                    <h3 class="card-title d-inline">
                                        <i class="fa fa-fw fa-table"></i> Temporary Devices
                                    </h3>
                                    <span class="pull-right">
                                            <i class="fa fa-fw fa-chevron-up clickable"></i>
                                    </span>
                                </div>

                                @if( Helper::showBasedOnPermission( 'temporary.read' ) )
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div id="sample_1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                    
                                            <div class="row">
                                    
                                                <div class="col-sm-12">
                                                        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" style="width: 58.25px;">
                                                                    ID
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"  style="width: 42.25px;">
                                                                        Company Name
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"  style="width: 77.25px;">
                                                                        Device Name
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" style="width: 43.25px;">
                                                                        Serial Name
                                                                    </th>

                                                                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" style="width: 43.25px;">
                                                                        Action
                                                                    </th>
                                                                
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                @if (!empty($temps) )
                                                                @php
                                                                    $i = 1;
                                                                @endphp
                                                                @foreach ($temps as $temp)
                                                                    <tr role="row" class="odd">
                                                                        <td>{{ $i++ }}</td>
                                                                        <td>{{ $temp->company_name }}</td>
                                                                        <td>{{ $temp->device_name }}</td>
                                                                        <td>{{ $temp->serial_number }}</td>
                                                                        
                                                                        <td>
                                                                            <a href="{{ url('temporary/edit/'.$temp->id) }}"><i class="fa fa-fw fa-pencil text-primary actions_icon" title="Edit Role"></i></a>
                                                                            <a href="{{ url('temporary/delete/'.$temp->id) }}" data-toggle="modal" data-target="#delete"><i class="fa fa-fw fa-times text-danger actions_icon" title="Delete User"></i></a>
                                                                        @if( Helper::showBasedOnPermission( 'permanent.create' ) )
                                                                        
                                                                            <!-- <a href="{{ url('insert/'.$temp->id) }}"><i class="fa fa-fw fa-save" style="color:green" title="save Device"></i></a> -->
                                                                            <a href="{{ url('permanent/insert/'.$temp->id) }}"><i class="fa fa-fw fa-save" style="color:green" title="save Device"></i></a>
                                                                        @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                @endif
                                                            </tbody>
                                                            <tfoot>
                                                                <tr role="row">
                                                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" style="width: 58.25px;">
                                                                    ID
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"  style="width: 42.25px;">
                                                                        Company Name
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"  style="width: 77.25px;">
                                                                        Device Name
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" style="width: 43.25px;">
                                                                        Serial Name
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" style="width: 43.25px;">
                                                                        Action
                                                                    </th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                </div>
                                        </div>  

                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </section>
        <!-- /.content -->
    </aside>
    <!-- /.right-side -->
</div>
<!-- ./wrapper -->
<!-- global js -->
@include('common/footerlink')
</body>

</html>
