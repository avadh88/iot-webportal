<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('public/assets/images/favicon.ico')}}"/>
    <link rel="stylesheet" href="{{asset('public/assets/css/login.css')}}"/>
</head>

<body>
<div class="preloader">
    <div class="loader_img"><img src="{{asset('public/assets/images/loader.gif')}}" alt="loading..." height="64" width="64"></div>
</div>
<div class="container">

    <div class="card-header nocolor">
        <h2 class="text-center">
            Log In
        </h2>
    </div>
    <div class="row">
        <div class="col-md-10 ml-auto">
            <div class="card-body social">
                <div class="clearfix">
                    <div class="col-12 col-sm-9">
                        <hr class="omb_hrOr">
                        <span class="omb_spanOr"></span>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-12 col-sm-6 form_width">
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
                    
                    <form action="{{ route('login.loginVerify') }}" id="authentication" class="login_validator" method="post">
                        @csrf 
                           
                            <div class="form-group">
                                <label for="email" class="sr-only"> E-mail</label>
                                <div class="input-group  input-group-prepend">
                                    <span class="input-group-text border-right-0 rounded-left"><i class="fa fa-envelope text-primary"></i></span>
                                    <input type="text" class="form-control  form-control-lg" id="email" name="username"
                                           placeholder="E-mail">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <div class="input-group input-group-prepend">
                                    <span class="input-group-text border-right-0 rounded-left"><i class="fa fa-lock text-primary"></i></span>
                                    <input type="password" class="form-control form-control-lg" id="password"
                                           name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Log In</button>
                            </div>
                            <a href="forgot_password.html" id="forgot" class="forgot"> Forgot Password? </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{ asset('public/assets/js/login.js') }}" type="text/javascript"></script>

</body>

</html>
