<form method="post" action="/reporte/{{$arg}}">

    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Año</h4>
            </div>
            <div class="modal-body">
                <!--<p>Digitar año</p>-->
                <div class="form-group">
                    <label for="inputdefault">Digitar año</label>
                    <input class="form-control" id="year" name="year" type="text">
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <button type="submit" class="btn btn-default"> Procesar</button>

                <a class="btn btn-default btn-close" onclick="javascript:$('.div_modal').click();">Cancelar</a>
            </div>
        </div>
    </div>
</form>




