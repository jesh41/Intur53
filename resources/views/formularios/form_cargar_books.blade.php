
  <div class="col-md-12">

      <div class="box box-primary">
                      <div class="box-header">
                        <h3 class="box-title">Cargar Datos de Usuarios</h3>
                      </div><!-- /.box-header -->
     
      <div id="notificacion_resul_fcdu"></div>

          <form method="post" action="cargar_datos" id="f_cargar_books" class="formarchivo"
                enctype="multipart/form-data">

              <div class="box-body">

      <div class="form-group col-xs-12"  >
             <label>Agregar Archivo de Excel </label>
              <input name="archivo" id="archivo" type="file"   class="archivo form-control"  required/><br /><br />

      </div>
      <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-3" for="nombre">Observaciones *</label>
                    <div class="col-sm-6" >
                      <input type="text" class="form-control" id="observacion" name="observacion"  required   >
                    </div>
                    </div>
      </div>
          <div class="col-md-6">
              <div class="form-group">
                  <label class="col-sm-3" for="nombre">Año *</label>
                  <div class="col-sm-4">
                      <select class="form-control" name="anio" id="anio" required>
                          <option selected></option>
                          <option value="2016">2016</option>
                          <option value="2017">2017</option>
                      </select>
                  </div>
              </div>
          </div>

          <div class="col-md-6">
                 <div class="form-group">
                  <label  class="col-sm-3" for="nombre">Mes *</label>
                   <div class="col-sm-4" >
                       <select class="form-control" name="mes" id="mes" required>
                           <option selected></option>
                    </select>
                    </div>
                 </div>
          </div>


          <div class="col-md-12">
    <div class="box-footer">
        <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">
        <button type="submit" class="btn btn-primary" >Cargar Datos</button>
        <a class="btn btn-default btn-close" onclick="javascript:$('.div_modal').click();" a href="/book">Cancelar</a>
      </div>
      </div>
      </div>
      </form>

      </div>

  </div>


  <script>

      $("#anio").on('change', function (e) {
          //console.log(e);
          var id = e.target.value;
          //ajax
          $.get('/ajax-submes?id=' + id, function (data) {
              //success data
              $("#mes").empty();
              $.each(data, function (index, subcatObj) {
                  $("#mes").append('<option value="' + subcatObj.id + '">' + subcatObj.mes + '</option>');
              });
          });
      });

  </script>