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
                <div class="col-md-12">
                    <a href="{{ url('app/list') }}" class="btn btn-animate btn-animate-side btn-primary m-r-50">
                        <span><i class="icon fa fa-fw fa-plus" aria-hidden="true"></i>EMT List</span>
                    </a>
                </div>
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


                                @if(isset($data->id))
                                <form id="form-validation" action="{{ route('app.update') }}" method="POST" enctype="multipart/form-data">
                                    @else
                                    <form id="form-validation" action="{{ route('app.add') }}" method="POST" enctype="multipart/form-data">

                                        @endif

                                        @csrf

                                        <input type="hidden" name="user_id" id="user_id" value="{{ Session::get('user_id') }}">
                                        <input id="emtId" type="hidden" name="id" value="{{ isset($data->id) ? $data->id : '' }}">
                                        <input id="deviceId" type="hidden" name="deviceId" value="{{ isset($data->device_id) ? $data->device_id : '' }}">



                                        <div class="fetchCompany">

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="app_company_id">
                                                    Company
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6 col-12">
                                                    <select id="app_company_id" name="app_company_id" class="form-control" class="app_company_id" @change="setDevice($event)">

                                                        @if(isset($data->app_company_id))
                                                        <!-- <option value="{{ $data->app_company_id }}"> {{ $data->company_name }}</option> -->
                                                        <option v-for="company in companyList" v-bind:value="company.company_id" :selected="company.company_id == {{$data->app_company_id}}"> @{{ company.company_name }}</option>
                                                        @else
                                                        <option value="">Select Company</option>
                                                        <option v-for="company in companyList" v-bind:value="company.company_id"> @{{ company.company_name }}</option>

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
                                                        @if(isset($data->device_id))
                                                        <!-- <option value="{{ $data->device_id }}"> {{ $data->company_name }}</option> -->
                                                        <option v-for="device in deviceList" v-bind:value="device.device_id"> @{{ device.device_name }}</option>
                                                        @else
                                                        <option value="">Select Device</option>
                                                        <option v-for="device in deviceList" v-bind:value="device.device_id"> @{{ device.device_name }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="app_name">
                                                Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6 col-12">
                                                <input type="text" name="app_name" id="app_name" class="form-control input-md" placeholder="Name" @if(isset($data->app_name)) value="{{ $data->app_name  }}" @endif>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="app_image">
                                                Image
                                            </label>
                                            <div class="col-lg-1 col-12">
                                                <input type="file" id="app_image" name="app_image" onchange="previewFile(this);" accept="image/bmp">
                                            </div>

                                            <div class="col-lg-3 col-12">

                                                <img id="previewImg" src="" alt="Preview">
                                            </div>


                                            @if(isset($data->app_image))


                                            <div class="content gallery">
                                                <div id="slim">
                                                    <div id="gallery">
                                                        <div id="gallery-content">
                                                            <div id="gallery-content-center">
                                                                <a class="fancybox img-responsive" href="{{ $data->app_image }}" data-fancybox-group="gallery" title="">
                                                                    <img id="emt_img" alt="{{ $data->app_image }}" src="{{ $data->app_image }}" class="all">
                                                                </a>

                                                            </div>
                                                        </div>
                                                        <!-- .images-box -->
                                                    </div>
                                                </div>
                                            </div>




                                            <!-- <img src="{{ $data->app_image }}" alt="{{ $data->app_image }}" height="50px" width="50px"> -->
                                            @endif
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="app_status">
                                                Status
                                            </label>

                                            <div class="col-lg-1 col-12">
                                                <label class="switch">
                                                    <input type="checkbox" name="app_status" @if(isset($data->app_status)) {{ ($data->app_status == 1 ) ? 'checked' : ""}} @endif>
                                                    <span class="slider round"></span>
                                                </label>

                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <span class="col-lg-3"></span>
                                            <div class="col-lg-6 col-12 text-left">

                                                <button type="submit" class="btn btn-primary btn-sm btn-responsive rounded-0 mb-3">Submit</button>
                                                <input type="button" id="load" name="load" value="Load" class="btn btn-info btn-sm btn-responsive rounded-0 mb-3">

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