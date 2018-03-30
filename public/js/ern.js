

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
    enviar: function (usuario) {
        $('<input />').attr('type', 'hidden').attr('name', 'id_usuario')
            .attr('value', usuario)
            .appendTo('#form_cambio_rol');
    },

    checkFullPageBackgroundImage: function () {
        $page = $('.full-page');
        image_src = $page.data('image');

        if (image_src !== undefined) {
            image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>'
            $page.append(image_container);
        }
    },

    showSwal2: function (rol, permiso, token) {

        swal({
            title: 'Desea eliminar el permiso ?',
            html: '  <form method="post" action="/quitar_permiso" id="form_eliminar"> ' +
            '<input type="hidden" name="_token"  value=' + token + '>' +
            '<input type="hidden" name="id_rol" value=' + rol + '>' +
            '<input type="hidden" name="id_permiso" value=' + permiso + '>' +
            '</form>',
            type: 'warning',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: "ELIMINAR",
            confirmButtonClass: 'btn btn-success',
            allowOutsideClick: false,
            allowEscapeKey: false,
            cancelButtonClass: "btn btn-danger",
            buttonsStyling: false,
        }).then(
            function () {
                $('form').submit();
            },
            function () {
                return false;
            });

    },

    showSwal: function (type, id, token) {
        if (type == 'anular') {
            swal({
                title: 'Desea anular el libro ' + id + '?',
                html: '  <form method="post" action="/anular_libro" id="form_anulacion"> ' +
                '<input type="hidden" name="_token"  value=' + token + '>' +
                '<input type="hidden" name="id_book" value=' + id + '>' +
                '</form>',
                type: 'warning',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: "ANULAR",
                confirmButtonClass: 'btn btn-success',
                allowOutsideClick: false,
                allowEscapeKey: false,
                cancelButtonClass: "btn btn-danger",
                buttonsStyling: false,
                input: 'select',
                inputClass: 'dropdown-toggle btn btn-primary btn-round',
                inputOptions: {
                    'Incorrecto': 'Incorrecto',
                    'Desactualizado': 'Informacion desactualizada'
                },
                inputPlaceholder: 'Motivo...',
                inputValidator: function (value) {
                    return new Promise(function (resolve, reject) {
                        if (value == 'Incorrecto' || value == 'Desactualizado') {
                            $('<input />').attr('type', 'hidden').attr('name', 'observacion')
                                .attr('value', value)
                                .appendTo('#form_anulacion');
                            $('<input />').attr('type', 'hidden').attr('name', 'id_book')
                                .attr('value', id)
                                .appendTo('#form_anulacion');
                            $('form').submit();
                        } else {
                            reject('Escoger motivo')
                        }
                    })
                }
            }).catch(swal.noop);
        } else if (type == 'reporte') {
            swal({
                title: 'Digitar Año',
                html: '<form method="post" action="/reporte/' + id + '" id="form_year">' +
                '<input type="hidden" name="_token"  value=' + token + '>' +
                '</form>',
                type: 'question',
                showCancelButton: true,
                showConfirmButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonText: "Procesar",
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: "btn btn-danger",
                cancelButtonText: 'CANCELAR',
                buttonsStyling: false,
                input: 'number',
                inputAttributes: {
                    'name': 'year',
                    'id': 'year'
                },
                inputPlaceholder: '2016',
                inputValidator: function (value) {
                    return new Promise(function (resolve, reject) {
                        if (value >= 2016 && value < 2050) {
                            $('<input />').attr('type', 'hidden').attr('name', 'year').attr('value', value)
                                .appendTo('#form_year');
                            $('form').submit();
                        } else {
                            reject('Digitar año mayor a 2015')
                        }
                    })
                }
            }).catch(swal.noop);

        } else if (type == 'desactivar') {
            swal({
                title: 'Desactivar usuario',
                html: '  <form method="post" action="/desactivar" id="form_desactivar"> ' +
                '<input type="hidden" name="_token"  value=' + token + '>' +
                '<input type="hidden" name="id_user" value=' + id + '>' +
                '</form>',
                type: 'question',
                showCancelButton: true,
                showConfirmButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonText: "Desactivar",
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: "btn btn-danger",
                cancelButtonText: 'CANCELAR',
                buttonsStyling: false,
            }).then(
                function () {
                    $('form').submit();
                },
                function () {
                    return false;
                });
        } else if (type == 'activar') {
            swal({
                title: 'Activar usuario',
                html: '  <form method="post" action="/activar" id="form_activar"> ' +
                '<input type="hidden" name="_token"  value=' + token + '>' +
                '<input type="hidden" name="id_user" value=' + id + '>' +
                '</form>',
                type: 'question',
                showCancelButton: true,
                showConfirmButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonText: "Desactivar",
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: "btn btn-danger",
                cancelButtonText: 'CANCELAR',
                buttonsStyling: false,
            }).then(
                function () {
                    $('form').submit();
                },
                function () {
                    return false;
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