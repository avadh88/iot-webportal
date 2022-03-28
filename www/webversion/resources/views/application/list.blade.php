<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Applications</title>
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
                    Applications
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item pt-1"><a href="{{ url('app/list') }}"><i class="fa fa-fw fa-home"></i> Applications</a>
                    </li>
                </ol>
                @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }} toastrshow" id="showtoast">{{ Session::get('message') }}</p>
                @endif

            </section>

            <section class="content">



                <div class="row">
                    <div class="col-lg-12">
                        <div class="card border-primary">
                            <div class="card-header text-white bg-primary">
                                <h3 class="card-title d-inline">
                                    <i class="fa fa-fw fa-table"></i> Applications
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
                                                                Application Name
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Device Name
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Application Status
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Action
                                                            </th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @if (!empty($apps) )
                                                        @php
                                                        $i = 1;
                                                        @endphp
                                                        @foreach ($apps as $app)
                                                        <tr role="row" class="odd">
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $app->app_name }}</td>
                                                            <td>{{ $app->device_name }}</td>
                                                            <td>{{ ($app->app_status == 1 ) ? 'Active' : 'Inactive'}} </td>


                                                            <td>
                                                                <a href="{{ url('app/edit/'.$app->id) }}"><i class="fa fa-fw fa-pencil text-primary actions_icon" title="Edit Application"></i></a>

                                                                <a href="{{ url('app/delete/'.$app->id) }}" onclick="deleteEmtApp(event)"><i class="fa fa-fw fa-times text-danger actions_icon" title="Delete Application"></i></a>
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
                                                                Application Name
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Device Name
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1">
                                                                Application Status
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

        </aside>
    </div>
    @include('common/footerlink')
</body>

</html>