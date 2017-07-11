<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>HOME::SPIE</title>

        <meta name="description" content="SPIE - Sistema de Planificacion Integral de l Estado, desarrollado por el Ministerio de Planificación">
        <meta name="author" content="Cristhian M. Flores Lopez">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->

        <link rel="shortcut icon" href="/assets_home/assets/img/favicons/spie_favicon.png">

        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers
        <link rel="shortcut icon" href="/assets_home/assets/img/favicons/favicon.jpg">

        <link rel="icon" type="image/png" href="/assets_home/assets/img/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="/assets_home/assets/img/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/assets_home/assets/img/favicons/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="/assets_home/assets/img/favicons/favicon-160x160.png" sizes="160x160">
        <link rel="icon" type="image/png" href="/assets_home/assets/img/favicons/favicon-192x192.png" sizes="192x192">

        <link rel="apple-touch-icon" sizes="57x57" href="/assets_home/assets/img/favicons/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/assets_home/assets/img/favicons/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/assets_home/assets/img/favicons/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/assets_home/assets/img/favicons/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/assets_home/assets/img/favicons/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/assets_home/assets/img/favicons/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/assets_home/assets/img/favicons/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/assets_home/assets/img/favicons/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/assets_home/assets/img/favicons/apple-touch-icon-180x180.png">
        END Icons -->

        <!-- Stylesheets -->
        <!-- Web fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">

        <!-- Bootstrap and OneUI CSS framework -->
        <link rel="stylesheet" href="/assets_home/assets/css/bootstrap.min.css">
        <link rel="stylesheet" id="css-main" href="/assets_home/assets/css/oneui.css">


        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="/assets_home/assets/css/themes/flat.min.css"> -->
        <!-- END Stylesheets -->

    @yield('header')
        <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    </head>
    <body>
        <!-- Page Container -->
        <!--
            Available Classes:

            'enable-cookies'             Remembers active color theme between pages (when set through color theme list)

            'sidebar-l'                  Left Sidebar and right Side Overlay
            'sidebar-r'                  Right Sidebar and left Side Overlay
            'sidebar-mini'               Mini hoverable Sidebar (> 991px)
            'sidebar-o'                  Visible Sidebar by default (> 991px)
            'sidebar-o-xs'               Visible Sidebar by default (< 992px)

            'side-overlay-hover'         Hoverable Side Overlay (> 991px)
            'side-overlay-o'             Visible Side Overlay by default (> 991px)

            'side-scroll'                Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (> 991px)

            'header-navbar-fixed'        Enables fixed header
        -->

        <div id="page-container" class="sidebar-l side-scroll header-navbar-fixed">
            <!-- Side Overlay-->
            <aside id="side-overlay">
                <!-- Side Overlay Scroll Container -->
                <div id="side-overlay-scroll">
                    <!-- Side Header -->
                    <div class="side-header side-content">
                        <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                        <button class="btn btn-default pull-right" type="button" data-toggle="layout" data-action="side_overlay_close">
                            <i class="fa fa-times"></i>
                        </button>
                        <span class="font-w600">{{ Auth::user()->name }}</span>
                    </div>
                    <!-- END Side Header -->

                    <!-- Side Content -->
                    <div class="side-content remove-padding-t">

                        <!-- Quick Settings -->
                        <div class="block pull-r-l">
                            <div class="block-header bg-gray-lighter">
                                <ul class="block-options">
                                    <li>
                                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                                    </li>
                                </ul>
                                <h3 class="block-title">Opciones</h3>
                            </div>

                                 <!-- Online Friends -->

                                        <div class="block-content block-content-full">
                                            <!-- Users Navigation -->
                                            <ul class="nav-users remove-margin-b">
                                                <li>
                                                    <a tabindex="-1" href="#">
                                                        <span class="badge badge-default pull-right"><i class="si si-user pull-right"></i></span>Perfil de Usuario
                                                    </a>
                                                </li>
                                                <li>
                                                    <a tabindex="-1" href="#">
                                                        <span class="badge badge-default pull-right"><i class="si si-refresh pull-right"></i></span>Cambiar Contraseña
                                                    </a>
                                                </li>
                                                <li>

                                                    <a tabindex="-1" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                        <span class="badge badge-default pull-right"><i class="si si-power pull-right"></i></span>Cerrar Sesion
                                                    </a>
                                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                            {{ csrf_field() }}
                                                    </form>
                                                </li>
                                            </ul>
                                            <!-- END Users Navigation -->
                                        </div>







                                    <!-- END Online Friends -->




                        </div>
                        <!-- END Quick Settings -->
                    </div>
                    <!-- END Side Content -->
                </div>
                <!-- END Side Overlay Scroll Container -->
            </aside>
            <!-- END Side Overlay -->

            <!-- Header -->
            <header id="header-navbar">
                <div class="content-mini content-mini-full content-boxed">
                    <!-- Header Navigation Right -->
                    <ul class="nav-header pull-right">
                        <li class="visible-xs">
                            <!-- Toggle class helper (for .js-header-search below), functionality initialized in App() -> uiToggleClass() -->
                            <button class="btn btn-default" data-toggle="class-toggle" data-target=".js-header-search" data-class="header-search-xs-visible" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </li>
                        <li class="js-header-search header-search remove-margin">
                            <form class="form-horizontal" action="base_pages_search.html" method="post">
                                <div class="form-material form-material-primary input-group remove-margin-t remove-margin-b">
                                    <input class="form-control" type="text" id="base-material-text" name="base-material-text" placeholder="Buscar...">
                                    <span class="input-group-addon"><i class="si si-magnifier"></i></span>
                                </div>
                            </form>
                        </li>
                        <li>
                            <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                            <button class="btn btn-default btn-image" data-toggle="layout" data-action="side_overlay_toggle" type="button">
                                <img src="/assets_home/assets/img/avatars/avatar9.jpg" alt="Avatar">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                        </li>
                    </ul>
                    <!-- END Header Navigation Right -->

                    <!-- Header Navigation Left -->
                    <ul class="nav-header pull-left">
                        <li class="header-content">
                            <a class="h5" href="{{ url('/home') }}">
                                <img src="/assets_home/assets/img/iconos/spie_icono.png" width="45px" alt="{{ config('app.name', 'Principal') }}">
                            </a>
                        </li>
                    </ul>
                    <!-- END Header Navigation Left -->
                </div>
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                <!-- Sub Header -->
                <div class="bg-gray-lighter visible-xs">
                    <div class="content-mini content-boxed">
                        <button class="btn btn-block btn-default visible-xs push" data-toggle="collapse" data-target="#sub-header-nav">
                            <i class="fa fa-navicon push-5-r"></i>Menu
                        </button>
                    </div>
                </div>
                <div class="bg-primary-lighter collapse navbar-collapse remove-padding" id="sub-header-nav">
                    <div class="content-mini content-boxed">
                        <ul class="nav nav-pills nav-sub-header push">

                            <li id="home">
                                <a href="{{ url('/home') }}">
                                    <i class="fa fa-briefcase push-5-r"></i>Sub-Sistemas
                                </a>
                            </li>
                            {{-- <li id="modulos">
                                <a href="{{ url('/modulos') }}">
                                    <i class="fa fa-briefcase push-5-r"></i>Modulos
                                </a>
                            </li> --}}

                            <li id="configuracion">
                                <a href="bd_settings.html">
                                    <i class="fa fa-cog push-5-r"></i>Configuración
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- END Sub Header -->

                <!-- Page Content -->

                 @yield('content')

                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="bg-body font-s12">
                <div class="content-mini content-mini-full content-boxed clearfix push-15">
                    <div class="pull-right">
                       VPC <i class="fa fa-laptop text-city"></i> <a class="font-w600" href="#" target="_blank">SISTEMAS</a>
                    </div>
                    <div class="pull-left">
                        <a class="font-w600" href="{{url('/')}}" target="_blank">SPIE v2.0</a> &copy; 2017
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>

        <!-- END Page Container -->

        <!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
        <script src="/assets_home/assets/js/core/jquery.min.js"></script>
        <script src="/assets_home/assets/js/core/bootstrap.min.js"></script>
        <script src="/assets_home/assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="/assets_home/assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="/assets_home/assets/js/core/jquery.appear.min.js"></script>
        <script src="/assets_home/assets/js/core/jquery.countTo.min.js"></script>
        <script src="/assets_home/assets/js/core/jquery.placeholder.min.js"></script>
        <script src="/assets_home/assets/js/core/js.cookie.min.js"></script>
        <script src="/assets_home/assets/js/app.js"></script>

        @stack('script-head')
    </body>
</html>
