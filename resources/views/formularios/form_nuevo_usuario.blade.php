<section class="content">

    <div class="col-md-12">

        <div class="box box-primary  box-gris">

            <div class="box-header with-border my-box-header">
                <h3 class="box-title"><strong>Nuevo Usuario</strong></h3>
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <hr style="border-color:white;"/>

            <div class="box-body">

                <form action="{{url('crear_usuario')}}" method="post" id="f_crear_usuario" class="formentrada">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">


                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4" for="email">Correo</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4" for="email">Contraseña</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                    </div>

                    <!--  <div class="box-header with-border my-box-header col-md-12"
                           style="margin-bottom:2px;margin-top: 2px;">
                          <h3 class="box-title">Tipo de usuario </h3>
                      </div>-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Tipo de usuario</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="tipo-usuario" name="tipo-usuario" required>
                                    <option selected></option>
                                    @foreach($roles as $role)
                                        <option value={{$role->id}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Departamento</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="departamento" name="departamento" required>
                                    <option selected></option>
                                    @foreach ($depto as $d)
                                        <option value={{$d->id}}>{{$d->city}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Municipio</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="municipio" name="municipio" required>
                                    <option selected></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Actividad</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="actividad" name="actividad" required>
                                    <option selected></option>
                                    @foreach ($acti as $ac)
                                        <option value={{$ac->id}}}>{{$ac->actividad}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Categoria hotel</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="categoria" name="categoria" required>
                                    <option selected></option>
                                    @foreach ($catho as $cath)
                                        <option value={{$cath->id}}}>{{$cath->categoria}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4" for="nombre">Nombre Hotel</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="hotel" name="hotel" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4" for="nombre">Telefono</label>
                            <div class="col-sm-6">
                                <input type="tel" class="form-control" id="telefono" name="telefono" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-2" for="nombre">Direccion</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="direccion" name="direccion" maxlength="60"
                                       required>
                            </div>
                        </div>
                    </div>


                    <div class="box-footer col-xs-12 box-gris ">
                        <button type="submit" class="btn btn-primary">Crear Nuevo Usuario</button>
                        <a class="btn btn-default btn-close" onclick="javascript:$('.div_modal').click();">Cancelar</a>
                    </div>


                </form>

            </div>

        </div>

    </div>

    <script>
        $("#departamento").on('change', function (e) {
            console.log(e);
            var cat_id = e.target.value;
            //ajax
            $.get('/ajax-subcat?cat_id=' + cat_id, function (data) {
                //success data
                $("#municipio").empty();
                $.each(data, function (index, subcatObj) {
                    $("#municipio").append('<option value="' + subcatObj.id + '">' + subcatObj.municipio + '</option>');
                });
            });
        });

    </script>
</section>


