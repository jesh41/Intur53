@extends('layouts.new')

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="blue2">
                            <i class="material-icons">book</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Libros Anulados</h4>

                            <div class="tab-content">
                                <div class="tab-pane active table-responsive ">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                           cellspacing="0" width="100%" style="width:100%">
                                        <thead role="row" class="text-primary">
                                        <tr>
                                            <th>id</th>
                                            <th>Book id</th>
                                            <th>Observacion</th>
                                            <th>Anulado Por</th>
                                            <th>Fecha Anulacion</th>
                                            <th>Accion</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($anulados as $annulment)
                                            <tr role="row" class="odd">
                                                <td>{{ $annulment->id }}</td>
                                                <td>{{ $annulment->book_id }}</td>
                                                <td>{{ $annulment->observacion }}</td>
                                                <td>{{ $annulment->Elaborado }}</td>
                                                <td>{{ $annulment->created_at }}</td>
                                                <td><a href="{{url("descargar/$annulment->book_id")}}" type="button"
                                                       class="btn  btn-info btn-sm " title="Descargar"> <i
                                                                class="material-icons">cloud_download</i></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection



