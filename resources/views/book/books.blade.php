@extends('layouts.hom')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Cargar Libros</div>
                <div class="margin" id="botones_control">
              <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(4);" >SUBIR</a>
                                          
        </div>
                <div class="panel-body">
                    Seccion de Libros
                </div>
            </div>
        </div>
    </div>
</div>

@endsection