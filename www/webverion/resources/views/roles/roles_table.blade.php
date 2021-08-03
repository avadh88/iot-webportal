<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Roles</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'>
    <link rel="shortcut icon" href="img/favicon.ico"/>

  @include('common/headerlink')

</head>
<body class="skin-coreplus nav-fixed">
<div class="preloader">
    <div class="loader_img"><img src="{{asset('public/assets/images/loader.gif')}}" alt="loading..." height="64" width="64"></div>
</div>

@include('common/header')
<div class="wrapper row-offcanvas row-offcanvas-left">
    @include('common/sidebar')

    <aside class="right-side">
        <section class="content-header fixed_header_menu">
            <h1>
                Role List
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item pt-1"><a href="{{ url('roles/list') }}"><i class="fa fa-fw fa-home"></i> Role List</a>
                </li>
            </ol>

        </section>
            
            <section class="content">
                @if( Helper::showBasedOnPermission( 'role.create' ) )

                    <div class="row mb-2">
                        <div class="col-md-12">
                            <a href="{{ url('roles/new') }}" class="btn btn-animate btn-animate-side btn-primary m-r-50">
                                <span><i class="icon fa fa-fw fa-plus" aria-hidden="true"></i>Add Role</span>
                            </a>
                        </div>
                    </div>
                @endif
                @if( Helper::showBasedOnPermission( 'role.read' ) )

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card border-primary">
                                <div class="card-header text-white bg-primary">
                                    <h3 class="card-title d-inline">
                                        <i class="fa fa-fw fa-table"></i> Role List
                                    </h3>
                                    <span class="pull-right">
                                            <i class="fa fa-fw fa-chevron-up clickable"></i>
                                    </span>
                                </div>
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
                                                                        Name
                                                                    </th>
                                                                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" style="width: 43.25px;">
                                                                        Action
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                @if (!empty($roles) )
                                                                @php
                                                                    $i = 1;
                                                                
                                                                @endphp
                                                                @foreach ($roles as $roles)
                                                                    <tr role="row" class="odd">
                                                                        <td>{{ $i++ }}</td>
                                                                        <td>{{ $roles->role_name }}</td>
                                                                        <td>
                                                                        @if( Helper::showBasedOnPermission( 'role.update' ) )
                                                                            <a href="{{ url('roles/edit/'.$roles->id) }}"><i class="fa fa-fw fa-pencil text-primary actions_icon" title="Edit Role"></i></a>
                                                                        @endif
                                                                            @if( Helper::showBasedOnPermission( 'role.delete' ) )
                                                                            <a href="{{ url('roles/delete/'.$roles->id) }}" data-toggle="modal" data-target="#delete"><i class="fa fa-fw fa-times text-danger actions_icon" title="Delete User"></i></a>
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
                                                                        Name
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
                            </div>
                        </div>
                    </div>
                @endif
                
            </section>
    </aside>
</div>

@include('common/footerlink')
</body>

</html>
