<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'>
    <link rel="shortcut icon" href="{{asset('public/assets/images/favicon.ico')}}" />

    @include('common/headerlink')
    <link type="text/css" rel="stylesheet" href="{{asset('public/assets/css/dashboard.css')}}" />


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
                    Dashboard
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item pt-1"><a href="{{ url('dashboard') }}"><i class="fa fa-fw fa-home"></i> Dashboard</a>
                    </li>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row tiles-row">
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 tile-bottom">
                                <div class="widget" data-count=".num" data-from="0" data-to="{{ $data->userCount }}" data-duration="1">
                                    <div class="canvas-interactive-wrapper2 interactive-gradient2-light">
                                        <canvas id="canvas-interactive2" width="370" height="135"></canvas>
                                        <div class="cta-wrapper2">
                                            <div class="item">
                                                <div class="widget-icon pull-left icon-color animation-fadeIn">
                                                    <i class="fa fa-fw fa-line-chart fa-size" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <div class="widget-count panel-white">
                                                <div class="item-label text-center">
                                                    <div id="count-box" class="count-box">{{ $data->userCount }}</div>
                                                    <span class="title">All Users</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 tile-bottom">
                                <div class="canvas-interactive-wrapper1 interactive-gradient1-light">
                                    <canvas id="canvas-interactive1" width="370" height="135"></canvas>
                                    <div class="cta-wrapper1">
                                        <div class="widget" data-count=".num" data-from="0" data-to="{{ $data->tempCount }}" data-duration="1">
                                            <div class="item">
                                                <div class="widget-icon pull-left icon-color animation-fadeIn">
                                                    <i class="fa fa-fw fa-line-chart fa-size" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <div class="widget-count panel-white">
                                                <div class="item-label text-center">
                                                    <div id="count-box2" class="count-box" style="opacity: 1.98319;">{{ $data->tempCount }}</div>
                                                    <span class="title">Temporary Devices</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 tile-bottom">
                                <div class="widget" data-suffix="k" data-count=".num" data-from="0" data-to="{{ $data->PermanentCount }}" data-duration="1" data-easing="false">
                                    <div class="canvas-interactive-wrapper3">
                                        <canvas id="canvas-interactive3"></canvas>
                                        <div class="cta-wrapper3">
                                            <div class="item">
                                                <div class="widget-icon pull-left icon-color animation-fadeIn">
                                                    <i class="fa fa-fw fa-usd fa-size"></i>
                                                </div>
                                            </div>
                                            <div class="widget-count panel-white">
                                                <div class="item-label text-center">
                                                    <div id="count-box3" class="count-box">{{ $data->PermanentCount }}</div>
                                                    <span class="title">Permanent Devices</span>
                                                </div>
                                                <!-- <div class="text-center"> -->
                                                <!-- <span><i class="fa fa-level-up" aria-hidden="true"></i></span> -->
                                                <!-- <strong>Online Devices</strong> -->
                                                <!-- <span><i class="fa fa-level-up" aria-hidden="true"></i></span> -->
                                                <!-- <strong>Offline Devices</strong> -->
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </aside>
    </div>
    @include('common/footerlink')
    <script src="{{asset('public/assets/js/dashboard.js')}}" type="text/javascript"></script>
</body>

</html>