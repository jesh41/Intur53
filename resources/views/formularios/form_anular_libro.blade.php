<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border my-box-header">
              <h3 class="box-title">Anular Libro</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class=" box-body">

            <h3>¿ Deseas Anular Completamente el  libro  {{ $book->id }} ?</h3>

            </div>
         
              <div class="box-footer">

                  <form method="post" action="/anular_libro" id="form_anular" class="formentrada">


                      <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-2" for="nombre">Motivo*</label>
                    <div class="col-sm-10" >
                   <select class="form-control"  name="observacion" id="observacion">
                       <option selected></option>
                    <option>archivo incorrecto</option>
                    <option>Informacion vieja</option>
                  </select>
                    </div>
                  </div>
            </div>

               <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="id_book" value="{{ $book->id }}">

                <button type="button" class="btn btn-default" onclick="javascript:$('.div_modal').click();" >Cancelar</button>
                <button type="submit" class="btn btn-danger" style="margin-left:20px;" >Anular libro</button>
                 </form>
              </div>


          </div>

        </div>