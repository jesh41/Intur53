$(document).on("submit", ".formentrada999", function (e) {
    e.preventDefault();
    var quien = $(this).attr("id");
    var formu = $(this);
    var varurl = "";
    if (quien == "form_anular") {
        var varurl = $(this).attr("action");
        var div_resul = "capa_formularios";
    }//listo
    //$("#"+div_resul+"").html( $("#cargador_empresa").html());
    $.ajax({
        // la URL para la petición
        url: varurl,
        data: formu.serialize(),
        type: 'POST',
        dataType: 'html',
        success: function (resul) {
            // console.log(e);
            //    swal.close()
            //  swal({
            //     title: "Anulada!",
            //    text: "",
            //   timer: 1000,
            //  showConfirmButton: false
            // }).catch(swal.noop);
            // material.showNotification('top','right')
        },
        error: function (xhr, status) {
            //  console.log(e);
            // swal("Error deleting!", "Please try again", "error");
        }
    });
})


material = {


    checkFullPageBackgroundImage: function () {
        $page = $('.full-page');
        image_src = $page.data('image');

        if (image_src !== undefined) {
            image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>'
            $page.append(image_container);
        }
    },

    showSwal: function (type, libro, token) {
        if (type == 'basic') {
            swal({
                title: "Here's a message!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success"
            });

        } else if (type == 'anular') {
            swal({
                title: 'Desea anular el libro ' + libro + '?',
                html: '  <form method="post" action="/anular_libro" id="form_anular999" class="formentrada" >' +
                '   <select class="form-control"  name="observacion" id="observacion" required>\n' +
                '                       <option selected></option>\n' +
                '                    <option>archivo incorrecto</option>\n' +
                '                    <option>Informacion vieja</option>\n' +
                '                  </select>' +
                '<input type="hidden" name="_token"  value=' + token + '>' +
                '<input type="hidden" name="id_book" value=' + libro + '>' + '<button type="submit" class="btn btn-success">Anular</button>' +
                '</form>',
                type: 'warning',
                showCancelButton: true,
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                cancelButtonClass: "btn btn-danger",
                buttonsStyling: false
            }).then(function () {
                swal.close()
            });
        } else if (type == 'subir') {
            swal({
                title: 'Desea anular el libro ' + libro + '?',
                html: '  <form method="post" action="/anular_libro" id="form_anular999" class="formentrada" >' +
                '   <select class="form-control"  name="observacion" id="observacion" required>\n' +
                '                       <option selected></option>\n' +
                '                    <option>archivo incorrecto</option>\n' +
                '                    <option>Informacion vieja</option>\n' +
                '                  </select>' +
                '<input type="hidden" name="_token"  value=' + token + '>' +
                '<input type="hidden" name="id_book" value=' + libro + '>' + '<button type="submit" class="btn btn-success">Anular</button>' +
                '</form>',
                type: 'warning',
                showCancelButton: true,
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                cancelButtonClass: "btn btn-danger",
                buttonsStyling: false
            }).then(function () {
                swal.close()
            });
        }

    },

    showNotification: function (from, align) {
        type = ['', 'info', 'success', 'warning', 'danger', 'rose', 'primary'];

        color = Math.floor((Math.random() * 6) + 1);

        $.notify({
            icon: "notifications",
            message: "Welcome to <b>Material Dashboard</b> - a beautiful freebie for every web developer."

        }, {
            type: type[color],
            timer: 3000,
            placement: {
                from: from,
                align: align
            }
        });
    }


}