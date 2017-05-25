  <section>
  <div class="col-md-12">



      <div class="box box-primary">
                      <div class="box-header">
                        <h3 class="box-title">Cargar Datos de Usuarios</h3>
                      </div><!-- /.box-header -->
     
      <div id="notificacion_resul_fcdu"></div>

      <form  id="f_cargar_books" name="f_cargar_books" method="post"  action="cargar_datos" class="formarchivo" enctype="multipart/form-data" >                
       <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>"> 
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
                  <label  class="col-sm-3" for="nombre">Mes *</label>
                   <div class="col-sm-4" >
                  <select class="form-control" name="mes" id="mes">
                  <?php foreach($months as $dato){ ?>
                      <option value="<?= $dato->id; ?>" required><?= $dato->mes; ?></option>
                    <?php  } ?>
                    </select>
                    </div>
                 </div>
      </div>   
                 

<div class="col-md-12">     
    <div class="box-footer">
        <button type="submit" class="btn btn-primary" >Cargar Datos</button>
        <a class="btn btn-default btn-close" onclick="javascript:$('.div_modal').click();">Cancelar</a>
      </div>

     

      </div>

      </form>

      </div>

  </div>
  </section>