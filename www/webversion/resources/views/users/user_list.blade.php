<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>User List</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'>
    <link rel="shortcut icon" href="{{asset('public/assets/images/favicon.ico')}}" />

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
                    User List
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item pt-1"><a href="{{ url('user/list')}}"><i class="fa fa-fw fa-home"></i> User List</a>
                </ol>

            </section>
            <section class="content">

                @if( Helper::showBasedOnPermission( ['user.create'],'OR' ) )
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="{{ url('user/new') }}" class="btn btn-animate btn-animate-side btn-primary m-r-50">
                            <span><i class="icon fa fa-fw fa-plus" aria-hidden="true"></i>Add User</span>
                        </a>
                    </div>
                </div>
                @endif
                @if( Helper::showBasedOnPermission( ['user.read','user.create'],'OR' ) )
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card border-primary">
                            <div class="card-header text-white bg-primary">
                                <h3 class="card-title d-inline">
                                    <i class="fa fa-fw fa-table"></i> User List
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
                                                            <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                ID
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Username
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Email
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Role
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Company
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Status
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @php
                                                        $i = 1;
                                                        @endphp
                                                        @foreach ($users as $user)

                                                        <tr role="row" class="odd">
                                                            <td>{{ $i++}}</td>
                                                            <td>{{ $user->username }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->role_name }}</td>
                                                            <td>{{ $user->company_name }}</td>
                                                            <td>
                                                                <div class="col-lg-6 col-12">
                                                                    <label class="switch">
                                                                        <input type="checkbox" name="company_status" @if(isset($user->user_status)) {{ ($user->user_status == 1 ) ? 'checked' : ""}} @endif>
                                                                        <span class="slider round"></span>
                                                                    </label>

                                                                </div>
                                                            </td>
                                                            <td>
                                                                @if( Helper::showBasedOnPermission( ['user.update'],'OR' ) )
                                                                <a href="{{ url('user/edit/'.$user->id) }}"><i class="fa fa-fw fa-pencil text-primary actions_icon" title="Edit User"></i></a>
                                                                @endif

                                                                @if( Helper::showBasedOnPermission( ['user.delete'],'OR' ) )
                                                                <a href="{{ url('user/delete/'.$user->id) }}" onclick="deleteUser(event)"><i class="fa fa-fw fa-times text-danger actions_icon" title="Delete User"></i></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>

                                                    <tfoot>
                                                        <tr role="row">
                                                            <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                ID
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Username
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Email
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Role
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Company
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Status
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
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
                </div>
                @endif
            </section>
        </aside>
    </div>

    @include('common/footerlink')
</body>

</html>