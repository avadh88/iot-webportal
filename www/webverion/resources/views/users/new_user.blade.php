<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'>
    <link rel="shortcut icon" href="img/favicon.ico"/>
    @include('common/headerlink')
</head>

<body class="skin-coreplus">
<div class="preloader">
    <div class="loader_img"><img src="img/loader.gif" alt="loading..." height="64" width="64"></div>
</div>
@include('common/header')

<div class="wrapper row-offcanvas row-offcanvas-left">
    @include('common/sidebar')
  
    <aside class="right-side">
        <section class="content-header fixed_header_menu">
            <h1>
                Add New User
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item pt-1"><a href="{{ url('user/list')}}"><i class="fa fa-fw fa-home"></i> Users</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="">Add New User</a>
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
                                    <i class="fa fa-fw fa-star-half-empty"></i> Add New User
                                </h3>
                                <span class="pull-right">
                                        <i class="fa fa-fw clickable fa-chevron-up"></i>
                                    </span>
                            </div>
                            <div class="card-body" style="display: block;">
                                @if(isset($data))
                                    <form id="form-validation" action="{{ route('user.update') }}" class="" method="POST">
                                @else   
                                    <form id="form-validation" action="{{ route('user.name') }}" class="" method="POST">
                                @endif
                                                                
                                @csrf
                                <input type="hidden" name="id" @if(isset($data->id)) value="{{ $data->id }}" @endif>
                                    <div class="form-group row">
                                            <label class="col-md-4 col-form-label" for="role_id">
                                                Role
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <select id="role_id" name="role_id" class="form-control">

                                                    <option value=""> Please select </option>
                                                    @if (isset($roles))
                                                        @foreach($roles as $role)
                                                        <option value="{{ $role->id }}"  @if (isset($data->role_id)) @if($role->id == $data->role_id) selected="selected" @endif @endif> {{ $role->role_name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label" for="company_id">
                                                Company
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <select id="company_id" name="company_id" class="form-control">

                                                    <option value=""> Please select </option>
                                                    @if (isset($compnies))
                                                        @foreach($compnies as $company)
                                                        <option value="{{ $company->id }}"  @if (isset($data->company_id)) @if($company->id == $data->company_id) selected="selected" @endif @endif> {{ $company->company_name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label" for="first_name">
                                                First Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="first_name" id="first_name" class="form-control input-md" placeholder="First Name" @if(isset($data->first_name)) value="{{ $data->first_name }}" @endif >
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label" for="last_name">
                                                Last Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="last_name" id="last_name" class="form-control input-md" placeholder="Last Name" @if(isset($data->last_name)) value="{{ $data->last_name }}" @endif>
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label" for="username">
                                                Username
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="username" id="username" class="form-control input-md" placeholder="Enter your UserName" @if(isset($data->username)) value="{{ $data->username }}" @endif>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label" for="email">
                                                Email
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">    
                                                <input type="text" id="email" name="email" class="form-control" placeholder="Enter your valid email" @if(isset($data->email)) value="{{ $data->email }}" @endif>
                                            </div>
                                        </div>



                                        @if(!isset($data->id))
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label" for="password">
                                                Password
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" data-bv-field="password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label" for="repeat_password">
                                                Confirm Password
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="password" name="repeat_password" id="confirmpassword" class="form-control input-md" placeholder="Confirm Your Password">
                                            </div>
                                        </div>
                                    
                                        @endif
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label" for="phone_number">
                                                Phone Number
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Enter your phone number" @if(isset($data->phone_number)) value="{{ $data->phone_number }}" @endif>
                                            </div>
                                        </div>

                                     
                                    <div class="form-group form-actions">
                                        <div>
                                            <button type="submit" class="btn btn-effect-ripple btn-primary">Submit</button>
                                            </button>
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
