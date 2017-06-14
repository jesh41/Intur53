
  $(document).on("click",".pagination li a",function(e){
 e.preventDefault();
 
 var url =$(this).attr("href");
 $("#capa_formularios").html($("#cargador_empresa").html()); 
    $.get(url,function(resul){
        $("#capa_formularios").html(resul); 
   })

  });

  $.ajaxPrefilter(function( options, original_Options, jqXHR ) {
    options.async =false;
});

