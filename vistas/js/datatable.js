/*=============================================
 DATA TABLES
 =============================================*/
$(document).ready(function () {
    var table = $('#tablas').DataTable({
        "deferRender": true,
        "language": {

            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Busqueda:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }

        }
    });

    // Apply the search
    table.columns().every(function () {
        var that = this;
        $('input', this.header()).on('keyup change', function () {
            if (that.search() !== this.value) {
                that.search(this.value).draw();
            }
        });
    });
    //Add row button
    $('.dt-add').each(function () {
        $(this).on('click', function (evt) {
            //Create some data and insert it
            var rowData = [];
            //Tomando el numero de fila para agregar orden
            var info = table.page.info();
            //Contador y agregar fila
            rowData.push(info.recordsTotal + 1);
            var idServicio = $(this).attr("idServicio");
            rowData.push(idServicio);
            rowData.push('<select class="form-control select2" style="width: 100%;" name="dependencia"><option>Saldo Diario</option><option>Saldo Anticipado</option></select>');
            rowData.push('<select class="form-control select2" style="width: 100%;" name="dependencia"><option>Posiciones</option><option>Porcentaje</option><option>Metros²</option><option>Metros³</option><option>Unidad</option></select>');
            rowData.push('<select class="form-control select2" style="width: 100%;" name="dependencia"><option>Diario</option><option>Mensual</option><option>Anual</option></select>');
            rowData.push('<select class="form-control select2" style="width: 100%;" name="dependencia"><option>Quetzales</option><option>Porcentaje %</option><option>Dolares $</option></select>');
            rowData.push('<input type="text" class="form-control" style="width: 100%;" placeholder="Valor">');
            rowData.push('<div class="btn-group"><button  type="button" data-func="dt-add" class="btn btn-outline-danger dt-add"><i class="fa fa-plus"></i></button><button  type="button" data-func="dt-add" class="btn btn-outline-danger dt-add"><i class="fa fa-cloud-upload"></i></button></div>');
            //INSERT THE ROW
            table.row.add(rowData).draw(false);
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            })
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            })
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            })
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    });
    /*
     $('#tablas td').attr('role', 'gridcell');
     $('#tablas tr').attr('role', 'row');
     $('#tablas th').attr('role', 'gridcell');
     $('#tablas table').attr('role', 'grid');
     $('#tablas td:nth-of-type(7)').attr('contenteditable', 'true');
     
     $('#tablas td:nth-of-type(13)').attr('contenteditable', 'true');
     */
    $(document).on("click", ".btnGuardar", function () {
        var id = $(this).attr("id");
        var estadoUsuario = $(this).attr("estadoUsuario");
        var calculosobre = "#calculoSobre";
        calculosobre += estadoUsuario;
        var baseCalculo = "#baseCalculo";
        baseCalculo += estadoUsuario;
        var periodoCobro = "#periodoCobro";
        periodoCobro += estadoUsuario;
        var moneda = "#moneda";
        moneda += estadoUsuario;
        var valorAlmacenaje = "#valorAlmacenaje";
        valorAlmacenaje += estadoUsuario;
        var nit = document.getElementById("lblCliente").value;
        if (nit == "") {
            swal({
                type: "error",
                title: "Selección",
                text: "Seleccione el cliente para continuar",
                showConfirmButton: true,
                confrimButtonText: "cerrar",
                closeConfirm: true
            });
        } else {
            var dato1 = table.$(calculosobre).val();
            var dato2 = table.$(baseCalculo).val();
            var dato3 = table.$(periodoCobro).val();
            var dato4 = table.$(moneda).val();
            var dato5 = table.$(valorAlmacenaje).val();
            if (dato5 == "") {
                swal({
                    type: "error",
                    title: "Monto",
                    text: "El valor de calculo no puede ser vacia ingrese el valor correcto",
                    showConfirmButton: true,
                    confrimButtonText: "cerrar",
                    closeConfirm: true
                });
            } else {
                var datos = new FormData();
                datos.append("idServicio", id);
                datos.append("idNit", nit);
                datos.append("calculosobre", dato1);
                datos.append("baseCalculo", dato2);
                datos.append("periodoCobro", dato3);
                datos.append("moneda", dato4);
                datos.append("valorAlmacenaje", dato5);
                $.ajax({
                    url: "ajax/activarTarifa.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (respuesta) {
                        console.log(respuesta)
                    },
                    error: function (respuesta) {
                        console.log(respuesta);
                    }
                })
                var selectCalculoSobre = ('<select class="form-control select2" style="width: 100%;" name="dependencia" disabled="disabled"><option>');
                selectCalculoSobre += dato1;
                selectCalculoSobre += ('</option></select>');
                var selectBaseCalculo = ('<select class="form-control select2" style="width: 100%;" name="dependencia" disabled="disabled"><option>');
                selectBaseCalculo += dato2;
                selectBaseCalculo += ('</option></select>');
                var selectPeriodoCalculo = ('<select class="form-control select2" style="width: 100%;" name="dependencia" disabled="disabled"><option>');
                selectPeriodoCalculo += dato3;
                selectPeriodoCalculo += ('</option></select>');
                var selectMoneda = ('<select class="form-control select2" style="width: 100%;" name="dependencia" disabled="disabled"><option>');
                selectMoneda += dato4;
                selectMoneda += ('</option></select>');
                var selectMoneda = ('<select class="form-control select2" style="width: 100%;" name="dependencia" disabled="disabled"><option>');
                selectMoneda += dato4;
                selectMoneda += ('</option></select>');
                var txtValor = ('<input type="text" class="form-control" style="width: 100%;" value="');
                txtValor += dato5;
                txtValor += ('" readonly>');
                //Crear lista de datos datatable.
                var rowData = [];
                //Tomando el numero de fila para agregar orden
                var info = table.page.info();
                //Contador y agregar fila
                rowData.push(info.recordsTotal + 1);
                var servicioAlmacenaje = $(this).attr("servicioAlmacenaje");
                rowData.push(servicioAlmacenaje);
                rowData.push(selectCalculoSobre);
                rowData.push(selectBaseCalculo);
                rowData.push(selectPeriodoCalculo);
                rowData.push(selectMoneda);
                rowData.push(txtValor);
                rowData.push('<button type="button" class="btn btn-danger btnEliminar">Otros Servicios</button>');
                //INSERT THE ROW
                table.row.add(rowData).draw(false);
                swal({
                    type: "success",
                    title: "SERVICIO ACTUALIZADO",
                    text: "El servicio fue actualizado correctamente",
                    showConfirmButton: true,
                    confrimButtonText: "cerrar",
                    closeConfirm: true
                });
                $(this).removeClass('btn btn-outline-success');
                $(this).addClass('btn btn-warning');
                $(this).html('Servicio Agregada');
            }
        }
    });
    $(document).on("click", ".btnEliminar", function () {
        Swal.fire({
            position: 'center',
            type: 'info',
            title: '¡Para eliminar este servicio vaya configuracion de tarifas!',
            showConfirmButton: false,
            timer: 5000
        })
    });
});

