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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <link href="{{ asset('css/barra-nueva.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
   <!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/skin-blue.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plusis.css') }}" rel="stylesheet">
     <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


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
                  <a class="navbar-brand" ><img src="{{asset('images/Logo.png') }}" style="width:135px;height:40px;position:absolute;top: 10%;left:1%;"/> </a>             
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
 
<div class="nav-side-menu" style="margin-top: 50px;width:" >
 
 
        <div class="menu-list" >
  
            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="/home">  <i class="fa fa-dashboard fa-lg"></i> Dashboard</a>
                </li>

                <li>
                  
                  <a href="/book"><i class="fa fa-book fa-lg"></i> Libros </a>
                
                 <li >
                  <a href="/reports"><i class="fa fa-cubes fa-lg"></i> Reportes </a>
                </li>  
                   <li data-toggle="collapse" data-target="#new" class="collapsed">
                  <a href="#"><i class="fa fa-car fa-lg"></i> Ejemplo <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="new">
                  <li>Nuevo 1</li>
                  <li>Nuevo 2</li>
                  <li>Nuevo 3</li>
                </ul>
                 <li data-toggle="collapse" data-target="#config" class="collapsed">
                  <a href="#"><i class="fa fa-gear fa-lg"></i>Configuracion<span class="arrow"></span></a>
                 </li>
                 <ul class="sub-menu collapse" id="config">
                     <li>
                        <a href="/listado_usuarios"> <i class="fa fa-users fa-lg"></i> Usuarios</a>              
                     </li>
                      <li>
                        <a href="/bitacora"> <i class="fa fa-compass fa-lg"></i> Bitacora</a>              
                     </li>
                 </ul>
             </ul>
     </div>
</div>
</div>


 @yield('content')




<!-- Then include bootstrap js -->

  <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="{{asset('js/app.js') }}"></script>
  <script src="{{asset('js/plusis.js') }}" type="text/javascript"></script>
</body>
</html>