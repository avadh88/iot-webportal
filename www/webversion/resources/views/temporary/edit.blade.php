<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Temporary Device</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'>
    <link rel="shortcut icon" href="{{asset('public/assets/images/favicon.ico')}}"/>

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
                Edit Temporary Device
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item pt-1"><a href="{{ url('temporary/list')}}"><i class="fa fa-fw fa-home"></i> Temporary Device</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="">Edit Temporary Device</a>
                </li>
            </ol>
        </section>
        <section class="content">
            <div>
                    <div class="card-body">
                        @if($message = Session::get('message'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($error->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif 
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title d-inline ">
                                    <i class="fa fa-fw fa-star-half-empty"></i> Edit Temporary Device
                                </h3>
                                <span class="pull-right">
                                        <i class="fa fa-fw clickable fa-chevron-up"></i>
                                    </span>
                            </div>
                            <div class="card-body" style="display: block;">
                                @if(isset($data))
                                    <form id="form-validation" action="{{ route('temporary.update') }}" class="" method="POST">
                                @else   
                                    <form id="form-validation" action="{{ route('temporary.add') }}" class="" method="POST">
                                @endif
                                                                
                                @csrf
                                    <input type="hidden" name="id" @if(isset($data->id)) value="{{ $data->id }}" @endif>

                                    <!-- <div class="form-group row" >
                                        <label for="company_name" class="col-md-4 col-form-label">
                                        Company Name
                                                <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <select id="company_name" class="form-control select2" style="width:100%">

                                                    @if (isset($compnies))
                                                        @foreach($compnies as $compny)
                                                        <option value="{{ $compny->id }}"  @if (isset($data->company_name)) @if($compny->company_name == $data->company_name) selected="selected" @endif @endif> {{ $compny->company_name }}</option>
                                                        @endforeach
                                                    @endif

                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="form-group row">
                                            <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="company_name">
                                                Company Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6 col-12">
                                                <input type="text" name="company_name" id="company_name" class="form-control input-md" placeholder="Company Name" @if(isset($data->company_name)) value="{{ $data->company_name }}" @endif >
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="device_name">
                                                Device Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6 col-12">
                                                <input type="text" name="device_name" id="device_name" class="form-control input-md" placeholder="Device Name" @if(isset($data->device_name)) value="{{ $data->device_name }}" @endif>
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="serial_number">
                                                Serial Number
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6 col-12">
                                                <input type="text" name="serial_number" id="serial_number" class="form-control input-md" placeholder="Serial Number" @if(isset($data->serial_number)) value="{{ $data->serial_number }}" @endif>
                                            </div>
                                        </div>
                                                            
                                        <div class="form-group form-actions" style="margin-left: -45%;">
                                            <button type="submit" class="btn btn-effect-ripple btn-primary">Submit</button>
                                            </button>
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
