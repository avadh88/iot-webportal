<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Role</title>
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
                Add New Role
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item pt-1"><a href="{{ url('roles/list')}}"><i class="fa fa-fw fa-home"></i> Role</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="#">Add New Role</a>
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
                                    <i class="fa fa-fw fa-star-half-empty"></i> Add New Role
                                </h3>
                                <span class="pull-right">
                                        <i class="fa fa-fw clickable fa-chevron-up"></i>

                                    </span>
                            </div>
                            <div class="card-body" style="display: block;">
                                @if(isset($data))
                                    <form id="roleValidation" action="{{ route('roles.update') }}" class="" method="POST">
                                @else   
                                    <form id="roleValidation" action="{{ route('roles.insert') }}" class="" method="POST">
                                @endif
                                                                
                                @csrf
                                        <input type="hidden" name="id" @if(isset($data->id)) value="{{ $data->id }}" @endif>
                                  


                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label" for="role_name">
                                                Role Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="role_name" id="role_name" class="form-control input-md" placeholder="Enter New Role" @if(isset($data->role_name)) value="{{ $data->role_name }}" @endif>
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
