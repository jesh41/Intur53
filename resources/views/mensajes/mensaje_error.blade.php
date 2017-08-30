
 <br/><div class='rechazado'><label style='color:#FA206A'><?php  echo $msj; ?></label>  </div> 

 @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong><br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
  @endif

 <div class="box-footer col-xs-12  ">
     <a class="btn btn-default btn-close" onclick="javascript:$('.div_modal').click();">Cerrar</a>
 </div>
