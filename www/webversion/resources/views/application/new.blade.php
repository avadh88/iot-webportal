<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Application</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'>
    <link rel="shortcut icon" href="{{asset('public/assets/images/favicon.ico')}}" />
    @include('common/headerlink')

</head>

<body class="skin-coreplus">
    <div class="preloader">
        <div class="loader_img"><img src="{{asset('public/assets/images/loader.gif')}}" alt="loading..." height="64" width="64"></div>
    </div>
    @include('common/header')

    <div class="wrapper row-offcanvas row-offcanvas-left">
        @include('common/sidebar')

        <aside class="right-side">
            <section class="content-header fixed_header_menu">
                <h1>
                    Add New Application
                </h1>
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item pt-1"><a href="{{ url('user/list')}}"><i class="fa fa-fw fa-home"></i> Users</a> -->
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="">Add New EMT Application</a>
                    </li>
                </ol>
            </section>
            <section class="content">
                <div>
                    <div class="card-body">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title d-inline ">
                                    <i class="fa fa-fw fa-star-half-empty"></i> Add New EMT Application
                                </h3>
                                <span class="pull-right">
                                    <i class="fa fa-fw clickable fa-chevron-up"></i>
                                </span>
                            </div>
                            <div class="card-body">

                                <form id="form-validation" action="{{ route('app.add') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="app_company_id">
                                            Company
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6 col-12">
                                            <select id="app_company_id" name="app_company_id" class="form-control">

                                                <option value=""> Please select </option>
                                                @if (isset($compnies))
                                                @foreach($compnies as $company)
                                                <option value="{{ $company->id }}" @if (isset($data->company_id)) @if($company->id == $data->company_id) selected="selected" @endif @endif> {{ $company->company_name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="device_name">
                                            Device Name
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="col-lg-6 col-12">
                                            <select id="device_name" name="device_name" class="form-control" class="device_name">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="app_name">
                                            Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6 col-12">
                                            <input type="text" name="app_name" id="app_name" class="form-control input-md" placeholder="Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="app_image">
                                            Image
                                        </label>
                                        <div class="col-lg-1 col-12">
                                            <input type="file" id="app_image" name="app_image" onchange="previewFile(this);" accept="image/bmp">
                                            <!-- <input type="file" id="app_image" name="app_image" onchange="previewFile(this);"> -->
                                        </div>

                                        <div class="col-lg-3 col-12">

                                            <img id="previewImg" src="" alt="Preview">
                                        </div>


                                        @if(isset($data->app_image))
                                        <img src="{{ $data->app_image }}" alt="{{ $data->app_image }}">
                                        @endif
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="app_status">
                                            Status
                                        </label>

                                        <div class="col-lg-1 col-12">
                                            <label class="switch">
                                                <input type="checkbox" name="app_status">
                                                <span class="slider round"></span>
                                            </label>

                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <span class="col-lg-3"></span>
                                        <div class="col-lg-6 col-12 text-left">

                                            <button type="submit" class="btn btn-primary btn-sm btn-responsive rounded-0 mb-3">Submit</button>
                                            <input type="button" id="load" name="load" value="Load" class="btn btn-info btn-sm btn-responsive rounded-0 mb-3 disabled">
                                            <!-- <button class="btn btn-info btn-sm btn-responsive rounded-0 mb-3 disabled">Load</button> -->

                                        </div>

                                    </div>
                                </form>
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