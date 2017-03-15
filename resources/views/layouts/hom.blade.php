<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'INTUR') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/skin-blue.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plusis.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body class="skin-blue sidebar-mini">

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


<body>
   
        <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0">
         
                                   
                  <a class="navbar-brand" ><img src="{{asset('images/Logo.png') }}" style="width:135px;height:40px;"/> </a>  
                

                <div class="nav navbar-nav navbar-left">
                     <li class="active" ><button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <i class="fa fa-bars"></i></button></li>  
                </div>



             <div class="container">
                             
                    <ul class="nav navbar-nav navbar-right">
                      
                        @if (Auth::guest())
                        
                            
                        @else
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
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
        
    
  
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
 
                <li class="active">
                    <a href="/home"><span class="fa-stack fa-lg pull-left"><i class="fa fa-dashcube fa-stack-1x "></i></span>Dashboard</a>
                       
                </li>
                <li>
                    <a href="/book"><span class="fa-stack fa-lg pull-left"><i class="fa fa-book fa-stack-1x "></i></span>Libros</a>
                </li>
                <li>
                    <a href="/report"><span class="fa-stack fa-lg pull-left"><i class="fa fa-cubes fa-stack-1x "></i></span>Reportes</a>
                </li>
                <li>
                    <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-gear fa-stack-1x"></i></span>Configuracion</a>
                    <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                        <li><a href="/listado_usuarios"><span class="fa-stack fa-lg pull-left"><i class="fa fa-user fa-stack-1x "></i></span>Perfil</a></li>
                        <li><a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-book fa-stack-1x "></i></span>link2</a></li>
 
                    </ul>
                </li>
                       
            </ul>
        </div>
    </div>


 @yield('content')
    <!-- Scripts -->
 <script src="{{asset('js/app.js') }}"></script>
   <script src="{{asset('js/sidebar_menu.js') }}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/plusis.js') }}" type="text/javascript"></script>
</body>
</html>