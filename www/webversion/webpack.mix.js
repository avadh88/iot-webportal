const  mix  = require('laravel-mix');

//src path configuration
var nodevendors = 'node_modules/';

var vendors = 'resources/assets/vendors/';
var resourcesAssets = 'resources/assets/';
var srcCss = resourcesAssets + 'css/';
var srcJs = resourcesAssets + 'js/';

//destination path configuration
var dest = 'public/assets/';
var destFonts = dest + 'fonts/';
var destCss = dest + 'css/';
var destJs = dest + 'js/';
var destImg = dest + 'images/';
var destVendors = dest + 'vendors/';


mix.combine(
    [
        
        'resources/assets/css/font-awesome.min.css',
        'resources/assets/css/bootstrap.css',
        'resources/assets/css/custom_css/metisMenu.css',

        'resources/assets/css/custom.css',
        'resources/assets/css/layouts.css',
        'resources/assets/css/custom_css/wizard.css',


        'resources/assets/vendors/morrisjs/morris.css',
        'resources/assets/vendors/datatables/css/dataTables.bootstrap4.css',
        'resources/assets/vendors/datatables/css/buttons.bootstrap4.css',
        'resources/assets/vendors/datatables/css/rowReorder.bootstrap4.css',
        'resources/assets/vendors/datatables/css/colReorder.bootstrap4.css',
        'resources/assets/vendors/datatables/css/scroller.bootstrap4.css',
        'resources/assets/css/custom_css/datatables_custom.css',
        'resources/assets/css/fontawesome_icons.css',

        'resources/assets/vendors/select2/css/select2.min.css',
        'resources/assets/vendors/select2/css/select2-bootstrap.css',
        'resources/assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css',
        'resources/assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css',
        'resources/assets/vendors/iCheck/css/all.css',

        'resources/assets/css/advbuttons.css',
        'resources/assets/css/buttons_sass.css',
        'resources/assets/vendors/hover/css/hover-min.css',

        'resources/assets/css/custom_css/form2.css',
        'resources/assets/css/custom_css/form3.css',

        'resources/assets/vendors/prettycheckable/css/prettyCheckable.css',
        'resources/assets/css/custom_css/company.css',
    ], destCss + 'app.css');

mix.combine(
    [
        'node_modules/popper.js/dist/umd/popper.js',
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/components-jqueryui/jquery-ui.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        'resources/assets/js/custom_js/leftmenu.js',
        'resources/assets/js/metisMenu.js',
        'resources/assets/js/custom_js/rightside_bar.js',
        'node_modules/holderjs/holder.min.js',

        
        'resources/assets/js/custom_js/fixed.js',
        'resources/assets/js/custom_js/user.js',

        'resources/assets/js/backstretch.js',
        'resources/assets/vendors/countupcircle/js/jquery.countupcircle.js',
        'resources/assets/vendors/granim/js/granim.min.js',
        'resources/assets/vendors/flotchart/js/jquery.flot.js',
        'resources/assets/vendors/flotchart/js/jquery.flot.resize.js',
        'resources/assets/vendors/flotchart/js/jquery.flot.time.js',
        'resources/assets/vendors/flotchart/js/jquery.flot.symbol.js',
        'resources/assets/vendors/flotchart/js/jquery.flot.pie.js',
        'resources/assets/vendors/flotchart/js/jquery.flot.stack.js',
        'resources/assets/vendors/flotchart/js/jquery.flot.tooltip.js',
        'resources/assets/vendors/flotchart/js/jquery.flot.spline.min.js',

        'resources/assets/js/custom_js/roles.js',

        'resources/assets/vendors/datatables/js/jquery.dataTables.js',
        'resources/assets/vendors/datatables/js/dataTables.bootstrap4.js',
        'resources/assets/vendors/datatables/js/dataTables.rowReorder.js',
        'resources/assets/vendors/datatables/js/dataTables.scroller.js',
        'resources/assets/vendors/Buttons/js/buttons.js',
        'resources/assets/vendors/moment/js/moment.min.js',
        'resources/assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js',
        'resources/assets/vendors/select2/js/select2.js',
        'resources/assets/vendors/select2/js/select2.full.js',
        'resources/assets/vendors/bootstrapwizard/js/jquery.bootstrap.wizard.js',
        'resources/assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js',
        'resources/assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js',
        'resources/assets/vendors/iCheck/js/icheck.js',


        'resources/assets/js/custom_js/datatables_custom.js',
        'resources/assets/js/fontawesome_icons.js',

        'resources/assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js',
        'resources/assets/vendors/bootstrap-maxlength/js/bootstrap-maxlength.js',
        'resources/assets/js/custom_js/form1.js',
        'resources/assets/js/custom_js/form2.js',
        'resources/assets/js/custom_js/form3.js',
        'resources/assets/js/custom_js/form_validations.js',

        'resources/assets/vendors/prettycheckable/js/prettyCheckable.min.js',
        'resources/assets/js/custom_js/company.js',
        'resources/assets/js/custom_js/temporary.js',
        'resources/assets/js/custom_js/permanent.js',


    ], destJs + 'app.js');

mix.copy(resourcesAssets + 'images', destImg, false);
mix.copy(resourcesAssets + 'fonts', destFonts, false);

mix.combine([

    'resources/assets/css/bootstrap.css',
    'resources/assets/css/font-awesome.min.css',
    'resources/assets/css/custom_css/metisMenu.css',

    'resources/assets/vendors/iCheck/css/all.css',
    'resources/assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css',
    'resources/assets/css/login.css',
    
],destCss + 'login.css');

mix.combine([

    'node_modules/popper.js/dist/umd/popper.js',
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/components-jqueryui/jquery-ui.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
    'resources/assets/js/custom_js/leftmenu.js',
    'resources/assets/js/metisMenu.js',
    'resources/assets/js/custom_js/rightside_bar.js',
    'node_modules/holderjs/holder.min.js',
    
    'resources/assets/vendors/iCheck/js/icheck.js',
    'resources/assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js',
    'resources/assets/js/custom_js/login2.js',


],destJs + 'login.js');

mix.combine([

    'resources/assets/css/custom_css/dashboard1.css',

    
],destCss + 'dashboard.css');

mix.combine([

    'resources/assets/js/dashboard1.js',

],destJs + 'dashboard.js');
