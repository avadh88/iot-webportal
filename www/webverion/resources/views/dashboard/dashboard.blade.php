<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'>
    <link rel="shortcut icon" href="img/favicon.ico"/>

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
                            <div class="canvas-interactive-wrapper1 interactive-gradient1-light">
                                <canvas id="canvas-interactive1" width="370" height="135"></canvas>
                                <div class="cta-wrapper1">
                                    <div class="widget" data-count=".num" data-from="0" data-to="99.9" data-suffix="%" data-duration="2">
                                        <div class="item">
                                            <div class="widget-icon pull-left icon-color animation-fadeIn">
                                                <i class="fa fa-fw fa-shopping-cart fa-size"></i>
                                            </div>
                                        </div>
                                        <div class="widget-count panel-white">
                                            <div class="item-label text-center">
                                                <div id="count-box" class="count-box" style="opacity: 1.98319;">25</div>
                                                <span class="title">Temporary Device</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 tile-bottom">
                            <div class="widget" data-count=".num" data-from="0" data-to="512" data-duration="3">
                                <div class="canvas-interactive-wrapper2 interactive-gradient2-light">
                                    <canvas id="canvas-interactive2" width="370" height="135"></canvas>
                                    <div class="cta-wrapper2">
                                        <div class="item">
                                            <div class="widget-icon pull-left icon-color animation-fadeIn">
                                                <i class="fa fa-fw fa-paw fa-size"></i>
                                            </div>
                                        </div>
                                        <div class="widget-count panel-white">
                                            <div class="item-label text-center">
                                                <div id="count-box2" class="count-box" style="opacity: 4.98418;">316</div>
                                                <span class="title">Daily Visits</span>
                                            </div>
                                            <div class="text-center">
                                                <span><i class="fa fa-level-up" aria-hidden="true"></i></span>
                                                <strong>60 Bounce Rate</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 tile-bottom">
                            <div class="widget" data-suffix="k" data-count=".num" data-from="0" data-to="310" data-duration="4" data-easing="false">
                                <div class="canvas-interactive-wrapper3 interactive-gradient3-light">
                                    <canvas id="canvas-interactive3" width="370" height="135"></canvas>
                                    <div class="cta-wrapper3">
                                        <div class="item">
                                            <div class="widget-icon pull-left icon-color animation-fadeIn">
                                                <i class="fa fa-fw fa-usd fa-size"></i>
                                            </div>
                                        </div>
                                        <div class="widget-count panel-white">
                                            <div class="item-label text-center">
                                                <div id="count-box3" class="count-box" style="opacity: 6.93566;">544</div>
                                                <span class="title">Total income</span>
                                            </div>
                                            <div class="text-center">
                                                <span><i class="fa fa-level-up" aria-hidden="true"></i></span>
                                                <strong>120 more income</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 tile-bottom">
                            <div class="widget">
                                <div class="canvas-interactive-wrapper4 interactive-gradient4-light">
                                    <canvas id="canvas-interactive4" width="370" height="135"></canvas>
                                    <div class="cta-wrapper4">
                                        <div class="item">
                                            <div class="widget-icon pull-left icon-color animation-fadeIn">
                                                <i class="fa fa-bar-chart-o fa-size"></i>
                                            </div>
                                        </div>
                                        <div class="widget-count panel-white">
                                            <div class="item-label text-center">
                                                <div id="count-box4" class="count-box" style="opacity: 9.94994;">1598</div>
                                                <span class="title">Total Sales</span>
                                            </div>
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
</body>

</html>
