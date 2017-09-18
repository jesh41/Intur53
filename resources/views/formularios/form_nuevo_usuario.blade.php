<div class="box-body">
    <div class="box-header with-border my-box-header">
        <h3 class="box-title"><strong>Nuevo Usuario</strong></h3>
    </div>
    <form method="post" action="/crear_usuario" id="f_crear_usuario">

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
                <label class="col-sm-4" for="email">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4" for="email">Contraseña</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
        </div>

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

        <div class="col-md-6" id="text-departamento" style="visibility:hidden">
            <div class="form-group">
                <label class="col-sm-4 control-label">Departamento</label>
                <div class="col-sm-6">
                    <select class="form-control" id="departamento" name="departamento">
                        <option selected></option>
                        @foreach ($depto as $d)
                            <option value={{$d->id}}>{{$d->city}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-6" id="text-municipio" style="visibility:hidden">
            <div class="form-group">
                <label class="col-sm-4 control-label">Municipio</label>
                <div class="col-sm-6">
                    <select class="form-control" id="municipio" name="municipio">
                        <option selected></option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-6" id="text-actividad" style="visibility:hidden">
            <div class="form-group">
                <label class="col-sm-4 control-label">Actividad</label>
                <div class="col-sm-6">
                    <select class="form-control" id="actividad" name="actividad">
                        <option selected></option>
                        @foreach ($acti as $ac)
                            <option value={{$ac->id}}>{{$ac->actividad}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-6" id="text-categoria" style="visibility:hidden">
            <div class="form-group">
                <label class="col-sm-4 control-label">Categoria hotel</label>
                <div class="col-sm-6">
                    <select class="form-control" id="categoria" name="categoria">
                        <option selected></option>
                        @foreach ($catho as $cath)
                            <option value={{$cath->id}}>{{$cath->categoria}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-6" id="text-nombre" style="visibility:hidden">
            <div class="form-group">
                <label class="col-sm-4" for="nombre">Nombre Hotel</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nombre-hotel" name="nombre-hotel">
                </div>
            </div>
        </div>
        <div class="col-md-6" id="text-telefono" style="visibility:hidden">
            <div class="form-group">
                <label class="col-sm-4" for="nombre">Telefono</label>
                <div class="col-sm-6">
                    <input type="tel" class="form-control" id="telefono" name="telefono">
                </div>
            </div>
        </div>

        <div class="col-md-6" id="text-direc" style="visibility:hidden">
            <div class="form-group">
                <label class="col-sm-2" for="nombre">Direccion</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="direccion" name="direccion" maxlength="120">
                            </div>
                        </div>
                    </div>


        <div class="box-footer col-xs-12 box-gris ">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <button type="submit" class="btn btn-primary">Crear Nuevo Usuario</button>
            <a class="btn btn-default btn-close" onclick="javascript:$('.div_modal').click();">Cancelar</a>
                    </div>


                </form>

</div>


            <script>
        $("#departamento").on('change', function (e) {
            //console.log(e);
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

        $("#tipo-usuario").on('change', function (e) {
            //console.log(e);
            var id = e.target.options[e.target.selectedIndex].text;
            if (id == 'Hotel' || id == 'hotel') {
                document.getElementById('text-departamento').style.visibility = 'visible';
                document.getElementById('text-direc').style.visibility = 'visible';
                document.getElementById('text-municipio').style.visibility = 'visible';
                document.getElementById('text-categoria').style.visibility = 'visible';
                document.getElementById('text-actividad').style.visibility = 'visible';
                document.getElementById('text-nombre').style.visibility = 'visible';
                document.getElementById('text-telefono').style.visibility = 'visible';
                $('#departamento').prop("required", true);
                $('#direccion').prop("required", true);
                $('#municipio').prop("required", true);
                $('#categoria').prop("required", true);
                $('#actividad').prop("required", true);
                $('#nombres').prop("required", true);
                $('#telefono').prop("required", true);
            }
            else {
                document.getElementById('text-departamento').style.visibility = 'hidden';
                document.getElementById('text-direc').style.visibility = 'hidden';
                document.getElementById('text-municipio').style.visibility = 'hidden';
                document.getElementById('text-categoria').style.visibility = 'hidden';
                document.getElementById('text-actividad').style.visibility = 'hidden';
                document.getElementById('text-nombre').style.visibility = 'hidden';
                document.getElementById('text-telefono').style.visibility = 'hidden';
                $('#departamento').removeAttr("required");
                $('#direccion').removeAttr("required");
                $('#municipio').removeAttr("required");
                $('#categoria').removeAttr("required");
                $('#actividad').removeAttr("required");
                $('#nombres').removeAttr("required");
                $('#telefono').removeAttr("required");
            }
        });
    </script>



