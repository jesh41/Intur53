@extends('layouts.new')

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">

                        <div class="card-content">
                            <h3 class="card-title">Ayuda</h3>
                            Bienvenido a la seccion de ayuda<br>
                            FAQ<br>
                            Como subir un libro.<br>
                            Como anular un libro.<br>
                            Como generar un reporte.<br>

                            Para decargar el manual version PDF, dar clik en el boton descarga
                            <a href="{{url("/descargar_manual")}}" target="_blank">
                                <button class="btn btn-info btn-just-icon" rel="tooltip"
                                        data-placement="right"
                                        title="Descargar Manual"><i class="material-icons">cloud_download</i>
                                </button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection