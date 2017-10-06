@extends('layouts.new')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">book</i>
                        </div>
                        <div class="card-content">
                            @can('subir')

                                <button href="javascript:void(0);" class="btn btn-primary btn-sm btn-round"
                                        style="float: right" onclick="cargar_formulario(4);"><i class="material-icons">file_upload</i>Subir
                                </button>
                            @endcan
                            <h4 class="card-title">Libros</h4>

                            <div class="tab-content">
                                <div class="tab-pane active table-responsive ">
                                    <table class="table table-hover table-striped" cellspacing="0" width="100%">
                                        <thead role="row" class="text-primary">
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Mes</th>
                                            <th>Estado</th>
                                            <th>Año</th>
                                            <th>Fecha Elaborado</th>
                                            <th>Usuario</th>
                                            <th class="text-right">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($books as $book)
                                            <tr role="row" class="odd">
                                                <td>{{ $book->id }}</td>
                                                <td>{{ $book->month->mes}}</td>
                                                <td>{{ $book->estado }}</td>
                                                <td>{{ $book->Anio }}</td>
                                                <td>{{ Carbon\Carbon::parse($book->FechaElaborado)->format('d-m-Y')}}</td>
                                                <td>{{ $book->user->name}}</td>
                                                <td class="td-actions text-right">
                                                    @if ($book->estado=='U')
                                                        <a href="{{url("descargar/$book->id")}}" type="button"
                                                           class="btn  btn-info btn-sm " title="Descargar"> <i
                                                                    class="material-icons">cloud_download</i></a>
                                                    @else
                                                        <a onclick="{{url("descargar/$book->id")}}" type="button"
                                                           class="btn  btn-info btn-sm " title="Descargar"> <i
                                                                    class="material-icons">cloud_download</i></a>
                                                        @can('subir') <!--onclick="anular_libro({{$book->id }});"-->
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                title="anular"
                                                                onclick="material.showSwal('anular','{{$book->id }}','<?php echo csrf_token(); ?>')">
                                                            <i class="material-icons">delete</i></button>
                                                        @endcan
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $books->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



              