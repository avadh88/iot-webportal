<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Company</title>
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
                Add New Company
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item pt-1"><a href="{{ url('company/list')}}"><i class="fa fa-fw fa-home"></i> Company</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="#">Add New Company</a>
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
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif 


                        
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title d-inline ">
                                    <i class="fa fa-fw fa-star-half-empty"></i> Add New Company
                                </h3>
                                <span class="pull-right">
                                        <i class="fa fa-fw clickable fa-chevron-up"></i>

                                    </span>
                            </div>
                            <div class="card-body">
                                @if(isset($data))
                                    <form id="companyValidation" action="{{ route('company.update') }}" class="" method="POST" enctype="multipart/form-data"
                                                  class=" form-bordered">
                                @else   
                                    <form id="companyValidation" action="{{ route('company.create') }}" class="" method="POST" enctype="multipart/form-data"
                                                  class=" form-bordered">
                                @endif
                                                                
                                @csrf
                                        <input type="hidden" name="id" value="{{ isset($data->id) ? $data->id : '' }}">
                                    
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="company_name">
                                                    Company Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                    <div class="col-lg-6 col-12">
                                                        <input type="text" name="company_name" id="company_name" value="{{ isset($data->company_name) ? $data->company_name : '' }}" class="form-control input-md" placeholder="Enter New Company">
                                                    </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="company_address">
                                                Company Address
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6 col-12">
                                                    <textarea type="text" name="company_address" id="company_address" value="{{ isset($data->company_address) ? $data->company_address : '' }}" class="form-control input-md" placeholder="Enter Company Address" >{{ isset($data->company_address) ? $data->company_address : '' }}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="company_email">
                                                    Email
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6 col-12">    
                                                    <input type="text" id="company_email" name="company_email" class="form-control" placeholder="Enter your valid email" value="{{ isset($data->company_email) ? $data->company_email : '' }}">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="company_mobile">
                                                    Phone Number
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6 col-12">
                                                    <input type="text" id="company_mobile" name="company_mobile" class="form-control" placeholder="Enter your phone number" @if(isset($data->company_mobile)) value="{{ $data->company_mobile }}" @endif>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                            <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="company_status">
                                            Status
                                            </label>
                                            
                                            <div class="col-lg-6 col-12">
                                            <label class="switch">
                                                <input type="checkbox" name="company_status" @if(isset($data->company_status)) {{ ($data->company_status == 1 ) ? 'checked' : ""}}  @endif>
                                                <span class="slider round"></span>
                                            </label>

                                        </div>  
                                        </div>  


                                        <div class="form-group row">
                                                <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="company_logo">
                                                Company Logo
                                                </label>
                                                <div class="col-lg-6 col-12">
                                                    <input type="file" id="company_logo" name="company_logo">
                                                </div>
                                                @if(isset($data->company_logo))
                                                <img src="{{ $data->company_logo }}" alt="{{ $data->company_logo }}" >
                                                @endif
                                            </div>

                                  
                                    <div class="form-group row">
                                        
                                        <span class="col-lg-3"></span>
                                        <div class="col-lg-6 col-12 text-left">
                                            <button type="submit" class="btn btn-effect-ripple btn-primary input-md">Submit</button>
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
