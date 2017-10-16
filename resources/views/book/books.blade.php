@extends('layouts.new')

@section('content')
    <!-- upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="card card-signup card-plain" data-background-color="red">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="material-icons">clear</i></button>
                        <div class="card-header  text-center " data-background-color="purple">
                            <h4 class="card-title">Subir Libro</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/cargar_datos" id="f_cargar_books" class="formarchivo"
                              enctype="multipart/form-data">
                            <div class="card-content">

                                <div class="form-group form-file-upload">
                                    <input type="file" name="archivo" id="archivo" required>
                                    <div class="input-group">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">attach_file</i>
                                        </span>
                                        <input type="text" readonly name="archivo" id="archivo" class="form-control"
                                               placeholder="Escoger libro">
                                    </div>
                                </div>


                                <div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">short_text</i>
								</span>
                                    <input type="text" class="form-control" id="observacion" name="observacion"
                                           placeholder="Observacion..." required>
                                </div>


                                <div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">today</i>
								</span>
                                    <select class="btn btn-primary btn-round" name="anio" id="anio" required>
                                        <option value="" selected disabled>Escoger año</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                    </select>
                                </div>


                                <div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">date_range</i>
								</span>
                                    <select class="btn btn-primary btn-round" name="mes" id="mes" required>
                                        <option value="" selected disabled>Escoger mes</option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer text-center">
                                <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">
                                <button type="submit" class="btn btn-primary ">Cargar Datos
                                </button>
                                <a class="btn btn-primary btn-simple btn-wd btn-lg" data-dismiss="modal"
                                   aria-hidden="true">Cancelar</a>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!--  End Modal -->





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

                                <!--  <button class="btn btn-primary btn-sm btn-round"style="float: right" onclick="material.showSwal('subir','0','<?php echo csrf_token(); ?>')">-->
                                    <button class="btn btn-primary btn-sm btn-round" style="float: right"
                                            data-toggle="modal" data-target="#uploadModal">
                                        <i class="material-icons">file_upload</i>Subir
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
                                                        @can('subir')
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



              