<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Role</title>
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
                            <div class="card-body">
                                @if(isset($data))
                                    <form id="roleValidation" action="{{ route('roles.update') }}" class="" method="POST">
                                @else   
                                    <form id="roleValidation" action="{{ route('roles.insert') }}" class="" method="POST">
                                @endif
                                                                
                                @csrf
                                        <input type="hidden" name="id" @if(isset($data->id)) value="{{ $data->id }}" @endif>
                                  


                                        <div class="form-group row">
                                            <label class="col-lg-3 col-12 col-form-label  text-lg-right text-left" for="role_name">
                                                Role Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6 col-12">
                                                <input type="text" name="role_name" id="role_name" class="form-control input-md" placeholder="Enter New Role" @if(isset($data->role_name)) value="{{ $data->role_name }}" @endif>
                                            </div>
                                        </div>
                                
                                <div class="form-group row">
                                    <label class="col-lg-2 col-md-2  col-sm-12 col-12 col-form-label m-t-ng-8 text-lg-right text-md-right text-left">User</label>
                                    <div class="col-lg-3 col-12 col-form-label  text-lg-right text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="selectAllUser">
                                        <label class="form-check-label" for="selectAllUser">
                                            Select All
                                        </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="userCreate" value="user.create" class="checkAllUser" > Add User
                                            </label>


                                        </div>
                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="userRead" value="user.read" class="checkAllUser" > View User
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="userDelete" value="user.delete" class="checkAllUser" > Delete User
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="userUpdate" value="user.update" class="checkAllUser" > Update User
                                            </label>
                                        </div>
                                    </div>
                                </div>
         
                                <div class="form-group row">
                                    <label class="col-lg-2 col-md-2  col-sm-12 col-12 col-form-label m-t-ng-8 text-lg-right text-md-right text-left">Role</label>
                                    <div class="col-lg-3 col-12 col-form-label  text-lg-right text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="selectAllRole">
                                        <label class="form-check-label" for="selectAllRole">
                                            Select All
                                        </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="roleCreate" value="role.create" class="checkAllRole" > Add Role
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="roleRead" value="role.read" class="checkAllRole" > View Role
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="roleDelete" value="role.delete" class="checkAllRole" > Delete Role
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="roleUpdate" value="role.update" class="checkAllRole" > Update Role
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-2 col-md-2  col-sm-12 col-12 col-form-label m-t-ng-8 text-lg-right text-md-right text-left">Temporary</label>
                                    <div class="col-lg-3 col-12 col-form-label  text-lg-right text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="selectAllTemp">
                                        <label class="form-check-label" for="selectAllTemp">
                                            Select All
                                        </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                   
                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="temporaryRead" value="temporary.read" class="checkAllTemp" > View Temporary Devices
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="temporaryDelete" value="temporary.delete" class="checkAllTemp" > Delete Temporary Device
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="temporaryUpdate" value="temporary.update" class="checkAllTemp" > Update Temporary Device
                                            </label>
                                        </div>

                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="permanentCreate" value="permanent.create" class="checkAllTemp" > Add To Permanent Device
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-md-2  col-sm-12 col-12 col-form-label m-t-ng-8 text-lg-right text-md-right text-left">Permanent</label>
                                    <div class="col-lg-3 col-12 col-form-label  text-lg-right text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="selectAllPermanent">
                                        <label class="form-check-label" for="selectAllPermanent">
                                            Select All
                                        </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                       
                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="permanentRead" value="permanent.read" class="checkAllpermanent" > View Permanent Devices
                                            </label>
                                        </div>
                                       
                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="permanentUpdate" value="permanent.update" class="checkAllpermanent" > Edit Permanent Device
                                            </label>
                                        </div>

                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="permanentDelete" value="permanent.delete" class="checkAllpermanent" > Delete Permanent Device
                                            </label>
                                        </div>

                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-2 col-md-2  col-sm-12 col-12 col-form-label m-t-ng-8 text-lg-right text-md-right text-left">Company</label>
                                    <div class="col-lg-3 col-12 col-form-label  text-lg-right text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="selectAllCompany">
                                        <label class="form-check-label" for="selectAllCompany">
                                            Select All
                                        </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                       
                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="companyCreate" value="company.create" class="checkAllcompany" > Add New Company
                                            </label>
                                        </div>

                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="companyRead" value="company.read" class="checkAllcompany" > View Company
                                            </label>
                                        </div>

                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="companyDelete" value="company.delete" class="checkAllcompany" > Delete Company
                                            </label>
                                        </div>

                                        <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="companyUpdate" value="company.update" class="checkAllcompany" > Edit Company
                                            </label>
                                        </div>
                                    
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
