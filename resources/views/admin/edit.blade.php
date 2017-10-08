@extends('layouts.new')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">info</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">INFORMACION DE LA CUENTA</h4>
            <div class="panel-body">
                <div class="col-md-6">
                    Nombre: {{$u->name}}
                </div>
                <div class="col-md-6">
                    Correo: {{$u->email}}
                </div>
                <div class="col-md-6">
                    @foreach($u->getRoles() as $roles)
                        Tipo de usuario:  {{  $roles }}
                    @endforeach
                </div>
                @if(Auth::user()->isRole('hotel')&& $indicador==true)
                    <div class="col-md-6">
                        Hotel:{{$h->nombre}}
                    </div>
                    <div class="col-md-6">
                        Categoria: {{$h->cathotel->categoria}}
                    </div>

                    <div class="col-md-6">
                        Departamento: {{$h->city->city}}
                    </div>
                    <div class="col-md-6">
                        Municipio: {{$h->municipio->municipio}}
                    </div>

                    <div class="col-md-6">
                        Actividad: {{$h->catactivity->actividad}}
                    </div>
                @endif
            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection