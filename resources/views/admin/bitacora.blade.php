@extends('layouts.new')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">signal_cellular_no_sim</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Anulaciones</h4>


                            <div class="tab-content">
                                <div class="tab-pane active table-responsive ">

                                    <table class="table table-hover table-striped" cellspacing="0" width="100%">
                                        <thead role="row" class="text-primary">
                                        <tr>
                                            <th>id</th>
                                            <th>Book id</th>
                                            <th>Observacion</th>
                                            <th>Anulado Por</th>
                                            <th>Fecha Anulacion</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($annulments as $annulment)
                                            <tr role="row" class="odd">
                                                <td>{{ $annulment->id }}</td>
                                                <td>{{ $annulment->book_id }}</td>
                                                <td>{{ $annulment->observacion }}</td>
                                                <td>{{ $annulment->Elaborado }}</td>
                                                <td>{{ $annulment->created_at }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $annulments->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



              