<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Intur-Hotel</title>

    <!-- Styles -->
<!--  <link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
<!-- <link href="{{ asset('css/barra-nueva.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
<!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">-->
<!--<link href="{{ asset('css/skin-blue.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/plusis.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">



    <!-- Scripts -->
   
    <script>

        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};


    </script>


</head>

<body >

<div style="display: none;" id="cargador_empresa" align="center">
        <br>
         <label style="color:#FFF; background-color:#ABB6BA; text-align:center">&nbsp;&nbsp;&nbsp;Espere... &nbsp;&nbsp;&nbsp;</label>

         <img src="{{ url('/img/cargando.gif') }}" align="middle" alt="cargador"> &nbsp;<label style="color:#ABB6BA">Realizando tarea solicitada ...</label>

          <br>
         <hr style="color:#003" width="50%">
         <br>
</div>
<input type="hidden"  id="url_raiz_proyecto" value="{{ url("/") }}" />

<div id="capa_modal" class="div_modal" style="display: none;"></div>
<div id="capa_formularios" class="div_contenido" style="display: none;"></div>
<div id="capa_test" class="div_test" style="display: none;"></div>

<body>
   
        <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0">
        <a href="#" data-toggle="offcanvas" style="position:absolute;top: 20%;left:1%;"><i class="fa fa-navicon fa-2x"></i></a>
        <a class="navbar-brand" ><img src="{{asset('images/Logo.png') }}" style="width:135px;height:40px;position:absolute;top: 10%;left:3%;"/> </a>             
           <div class="container">
                      
                    <ul class="nav navbar-nav navbar-right">
                      
                        @if (Auth::guest())
                        
                            
                        @else
                            
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/user"><i class="fa fa-user-circle fa-xl"></i> <span
                                                    class="collapse in hidden-xs">Mi cuenta</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Salir
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                </ul>
                            </li>
                        @endif 
                    </ul>
                
            </div> 
        </nav>
        

  
 <div id="wrapper" style="height:93%;">
 
 <div class="row row-offcanvas row-offcanvas-left">
        <!-- sidebar -->
        <div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
            <ul class="nav" id="menu" style="margin-left: 5%;">
                <li><a href="/home"><i class="fa fa-dashboard fa-lg"></i> <span class="collapse in hidden-xs">Dashboard</span></a></li>
                @can('book')
               <li><a href="/book"><i class="fa fa-book fa-lg"></i> <span class="collapse in hidden-xs">Libros de Huespedes</span></a></li>
             @endcan
             @can('reportes')
               <li><a href="/reports"><i class="fa fa-cubes fa-lg"></i> <span class="collapse in hidden-xs"> Reportes</span></a></li>
               @endcan
                @role('administrador')
                <li>
                    <a href="#" data-target="#item2" data-toggle="collapse"><i class="fa fa-gear fa-lg"></i> <span class="collapse in hidden-xs">Configuracion<span class="caret"></span></span></a>
                    <ul class="nav nav-stacked collapse" id="item2">
                        <li><a href="/listado_usuarios"><i class="fa fa-users fa-lg"></i> Usuarios</a></li>
                        <li><a href="/bitacora"><i class="fa fa-compass fa-lg"></i> Bitacora</a></li>
                    </ul>
                </li>
                @endrole

            </ul>
        </div>
        <!-- /sidebar -->

        <!-- main right col -->
        <div class="column col-sm-9 col-xs-11" id="main">
           
             @yield('content')
        </div>
        <!-- /main -->
 </div>
</div>







<!-- Then include bootstrap js -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <script src="{{asset('js/app.js') }}"></script>
  <script src="{{asset('js/highcharts.js') }}"></script>
  <script src="http://code.highcharts.com/modules/exporting.js"></script>
  <script src="{{asset('js/plusis.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/toastr.js') }}"></script>
        <script>
                    @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
            @endif
        </script>


</body>
</html>