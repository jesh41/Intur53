@extends('layouts.hom')

@section('content')
    <div class="panel-group ">
        <div class="panel panel-primary ">
            <div class="panel-heading">INFORMACIÓN DE LA CUENTA</div>
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
                @if(Auth::user()->isRole('hotel'))
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

@endsection