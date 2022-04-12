<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Edit Permission</title>
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
                    Edit Permissions
                </h1>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item pt-1"><a href="{{ url('roles/list')}}"><i class="fa fa-fw fa-home"></i> Roles</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Edit Permissions
                    </li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title d-inline">
                                    <i class="fa fa-fw fa-crosshairs"></i> Edit Permission
                                </h3>
                                <span class="pull-right">
                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                </span>
                            </div>
                            <div class="card-body">
                                <form role="form" action="{{ route('roles.update') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
                                    <div class="form-group row">
                                        <label for="input-text" class="col-lg-2 col-md-2  col-sm-12 col-12 col-form-label text-lg-right text-md-right text-left">Role</label>
                                        <div class="col-lg-10 col-md-10  col-sm-12 col-12 col-sm-12">
                                            <input name="role_name" type="text" class="form-control form-control-lg" id="role_name" placeholder="role_name" value="{{ isset($role) ? $role : '' }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 col-md-2  col-sm-12 col-12 col-form-label m-t-ng-8 text-lg-right text-md-right text-left">User</label>
                                        <div class="col-lg-2 col-md-2  col-sm-2 col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="selectAllUser">
                                                <label class="form-check-label" for="selectAllUser">
                                                    Select All
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4  col-sm-4 col-4">
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="userCreate" value="user.create" class="checkAllUser" @if(in_array('user.create', $permissions)) checked @endif> Add User
                                                </label>


                                            </div>
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="userRead" value="user.read" class="checkAllUser" @if(in_array('user.read', $permissions)) checked @endif> View User
                                                </label>
                                            </div>
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="userDelete" value="user.delete" class="checkAllUser" @if(in_array('user.delete', $permissions)) checked @endif> Delete User
                                                </label>
                                            </div>
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="userUpdate" value="user.update" class="checkAllUser" @if(in_array('user.update', $permissions)) checked @endif> Update User
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 col-md-2  col-sm-12 col-12 col-form-label m-t-ng-8 text-lg-right text-md-right text-left">Role</label>
                                        <div class="col-lg-2 col-md-2  col-sm-2 col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="selectAllRole">
                                                <label class="form-check-label" for="selectAllRole">
                                                    Select All
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4  col-sm-4 col-4">
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="roleCreate" value="role.create" class="checkAllRole" @if(in_array('role.create', $permissions)) checked @endif> Add Role
                                                </label>
                                            </div>
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="roleRead" value="role.read" class="checkAllRole" @if(in_array('role.read', $permissions)) checked @endif> View Role
                                                </label>
                                            </div>
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="roleDelete" value="role.delete" class="checkAllRole" @if(in_array('role.delete', $permissions)) checked @endif> Delete Role
                                                </label>
                                            </div>
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="roleUpdate" value="role.update" class="checkAllRole" @if(in_array('role.update', $permissions)) checked @endif> Update Role
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-lg-2 col-md-2  col-sm-12 col-12 col-form-label m-t-ng-8 text-lg-right text-md-right text-left">Temporary</label>
                                        <div class="col-lg-2 col-md-2  col-sm-2 col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="selectAllTemp">
                                                <label class="form-check-label" for="selectAllTemp">
                                                    Select All
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4  col-sm-4 col-4">
                                            <!-- <div>
                                            <label>
                                                <input type="checkbox" name="permission[]" id="create" value="temporary.create" class="checkAllTemp" @if(in_array('temporary.create', $permissions)) checked @endif> Add Temporary Device
                                            </label>
                                        </div> -->
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="temporaryRead" value="temporary.read" class="checkAllTemp" @if(in_array('temporary.read', $permissions)) checked @endif> View Temporary Devices
                                                </label>
                                            </div>
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="temporaryDelete" value="temporary.delete" class="checkAllTemp" @if(in_array('temporary.delete', $permissions)) checked @endif> Delete Temporary Device
                                                </label>
                                            </div>
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="temporaryUpdate" value="temporary.update" class="checkAllTemp" @if(in_array('temporary.update', $permissions)) checked @endif> Update Temporary Device
                                                </label>
                                            </div>

                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="permanentCreate" value="permanent.create" class="checkAllTemp" @if(in_array('permanent.create', $permissions)) checked @endif> Add To Permanent Device
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 col-md-2  col-sm-12 col-12 col-form-label m-t-ng-8 text-lg-right text-md-right text-left">Permanent</label>
                                        <div class="col-lg-2 col-md-2  col-sm-2 col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="selectAllPermanent">
                                                <label class="form-check-label" for="selectAllPermanent">
                                                    Select All
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4  col-sm-4 col-4">

                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="permanentRead" value="permanent.read" class="checkAllpermanent" @if(in_array('permanent.read', $permissions)) checked @endif> View Permanent Devices
                                                </label>
                                            </div>

                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="permanentUpdate" value="permanent.update" class="checkAllpermanent" @if(in_array('permanent.update', $permissions)) checked @endif> Edit Permanent Device
                                                </label>
                                            </div>

                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="permanentDelete" value="permanent.delete" class="checkAllpermanent" @if(in_array('permanent.delete', $permissions)) checked @endif> Delete Permanent Device
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 col-md-2  col-sm-12 col-12 col-form-label m-t-ng-8 text-lg-right text-md-right text-left">Company</label>
                                        <div class="col-lg-2 col-md-2  col-sm-2 col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="selectAllCompany">
                                                <label class="form-check-label" for="selectAllCompany">
                                                    Select All
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4  col-sm-4 col-4">

                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="companyCreate" value="company.create" class="checkAllcompany" @if(in_array('company.create', $permissions)) checked @endif> Add New Company
                                                </label>
                                            </div>

                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="companyRead" value="company.read" class="checkAllcompany" @if(in_array('company.read', $permissions)) checked @endif> View Company
                                                </label>
                                            </div>

                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="companyDelete" value="company.delete" class="checkAllcompany" @if(in_array('company.delete', $permissions)) checked @endif> Delete Company
                                                </label>
                                            </div>

                                            <div>
                                                <label>
                                                    <input type="checkbox" name="permission[]" id="companyUpdate" value="company.update" class="checkAllcompany" @if(in_array('company.update', $permissions)) checked @endif> Edit Company
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-md-2  col-sm-12 col-12 col-form-label">Company Access</label>

                                        <div class="col-lg-3 col-12 col-form-label">
                                            <select id="companyAccess" name="companyAccess[]" class="form-control select2" multiple style="width:100%">
                                                <option value=""> Please select </option>
                                                @if (isset($compnies))
                                                @foreach($compnies as $company)
                                                <option value="{{ $company->id }}" @if (isset($company_id)) @if(in_array( $company->id, $company_id)) selected="selected" @endif @endif> {{ $company->company_name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <button class="btn btn-default" type="submit">submit</button>
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