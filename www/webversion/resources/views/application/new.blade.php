<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity=
"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>
        @if(isset($data->id))
            Edit Application
        @else
            Add New Application
        @endif
    </title>
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
                @if(isset($data->id))
                    Edit EMT Application
                @else
                    Add New Application
                @endif
                </h1>
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item pt-1"><a href="{{ url('user/list')}}"><i class="fa fa-fw fa-home"></i> Users</a> -->
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="#">
                            @if(isset($data->id))
                                Edit EMT Application
                            @else
                                Add New EMT Application
                            @endif
                        </a>
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
                                    <i class="fa fa-fw fa-star-half-empty"></i> 
                                    @if(isset($data->id))
                                        Edit EMT Application
                                    @else
                                        Add New EMT Application
                                    @endif
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

                                            <!-- @if(!isset($data->app_image))
                                            <div class="col-lg-3 col-12">
                                                <img id="previewImg" src="" alt>
                                            </div>
                                            @endif -->

                                            @if(isset($data->app_image))


                                            <div class="content gallery">
                                                <div id="slim">
                                                    <div id="gallery">
                                                        <div id="gallery-content">
                                                            <div id="gallery-content-center">
                                                                <!-- <a class="fancybox img-responsive" href="{{ $data->app_image }}" data-fancybox-group="gallery" title=""> -->
                                                                    <img id="emt_img" alt="{{ $data->app_image }}" src="{{ $data->app_image }}" class="all" height="100px" width="100px"  data-toggle="modal" data-target="#exampleModal">
                                                                <!-- </a> -->

                                                            </div>
                                                        </div>
                                                        <!-- .images-box -->
                                                    </div>
                                                </div>
                                            </div>

                                            @else
                                            <div class="col-lg-3 col-12">
                                                <img id="previewImg" src="" alt>
                                            </div>

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
                                                <input type="button" id="process" name="process" value="Process" class="btn btn-info btn-sm btn-responsive rounded-0 mb-3">

                                            </div>

                                        </div>
                                    </form>
                            </div>
                        </div>

                    </div>
                </div>

                @if(isset($data->app_image))
                <!-- Modal -->
                <div class="modal fade"
                        id="exampleModal"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            
                                <!-- Add image inside the body of modal -->
                                <div class="modal-body">
                                    <img id="image" src="{{ $data->app_image }}"
                                        alt="Click on button" 
                                        height="575px"
                                        width="575px"/>
                                </div>
                
                                <div class="modal-footer">
                                    <button type="button"
                                        class="btn btn-secondary"
                                        data-dismiss="modal">
                                        Close
                                </button>
                                </div>
                            </div>
                        </div>
                </div>
                @endif



            </section>
        </aside>
    </div>

    @include('common/footerlink')



     <!-- Adding scripts to use bootstrap -->
    <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity=
"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous">
    </script>  
</body>

</html>