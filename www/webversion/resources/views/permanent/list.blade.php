<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Permanent Device</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'>
    <link rel="shortcut icon" href="{{asset('public/assets/images/favicon.ico')}}" />
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

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
                    Permanent Device
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item pt-1"><a href="{{ url('permanent/list') }}"><i class="fa fa-fw fa-home"></i> Permanent Device</a>
                    </li>
                </ol>
                @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }} toastrshow" id="showtoast">{{ Session::get('message') }}</p>
                @endif

            </section>

            @if( Helper::showBasedOnPermission( ['permanent.read'],'OR' ) )
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card border-primary">
                            <div class="card-header text-white bg-primary">
                                <h3 class="card-title d-inline">
                                    <i class="fa fa-fw fa-table"></i> Permanent Devices
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
                                                                Company Name
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Device Name
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Serial Name
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Temp Device Id
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
                                                        @if (!empty($permanents) )
                                                        @php
                                                        $i = 1;

                                                        @endphp
                                                        <input type="hidden" name="permanents" id="permanents" value="{{ json_encode($permanents) }}">
                                                        @foreach ($permanents as $permanent)
                                                        <tr role="row" class="odd">
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $permanent->company_name }}</td>
                                                            <td>{{ $permanent->device_name }}</td>
                                                            <td>{{ $permanent->serial_number }}</td>
                                                            <td>{{ $permanent->temp_device_id }}</td>
                                                            <td class="app" id="{{ $permanent->id }}">
                                                                {{ $permanent->status }}
                                                            </td>

                                                            <td>@if( Helper::showBasedOnPermission( ['permanent.update'],'OR' ) )
                                                                <a href="{{ url('permanent/edit/'.$permanent->id) }}"><i class="fa fa-fw fa-pencil text-primary actions_icon" title="Edit Role"></i></a>
                                                                @endif

                                                                @if( Helper::showBasedOnPermission( ['permanent.delete'],'OR' ) )
                                                                <a href="{{ url('permanent/delete/'.$permanent->id) }}" onclick="deletePermanent(event)"><i class="fa fa-fw fa-times text-danger actions_icon" title="Delete Device"></i></a>
                                                                @endif

                                                                @if ($permanent->retry == 0)
                                                                <a href="{{ url('permanent/retry/'.$permanent->id) }}"> <button class="btn btn-effect-ripple btn-primary"> Retry </button></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                    <tfoot>
                                                        <tr role="row">
                                                            <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                ID
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Company Name
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Device Name
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Serial Name
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Temp Device Id
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
            </section>
            @endif
        </aside>
    </div>

    <script src="{{asset('node_modules/socket.io/client-dist/socket.io.js')}}"></script>
    </script>
    @include('common/footerlink')
    <script src="{{asset('public/assets/js/device_status.js')}}" type="text/javascript"></script>

</body>

</html>