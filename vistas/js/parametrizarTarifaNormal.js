$(document).on("click", ".btnMostrarServicios", function() {
    var consultaNitNomal = $(this).val();
    var datos = new FormData();
    datos.append("consultaNitNomal", consultaNitNomal);
    $.ajax({
        url: "ajax/parametrizarTarifaNormal.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            document.getElementById("formDinamic").innerHTML = '';
            document.getElementById("formDinamic").innerHTML += '<div class="card-header"> <h3 class="card-title" id="h3">Servicio </h3> <div class="card-tools"><button type="button" class="btn btn-tool btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i> </button> <button type="button" class="btn btn-tool btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i> </button> </div>';
            document.getElementById("formDinamic").innerHTML += '<div class="card-body" style=" border-style: ridge; border-color: #0CA3AB; bord"> <h3 class="card-title">Tarifa de Almacenaje</h3><div class="row"> <div class="col-md-4"><label>Base de calculo</label><select class="form-control select2" id="baseCalculoAlmacenaje" name="baseCalculoAlmacenaje" style="width: 100%;" disabled="disabled"><option>Porcentaje</option> </select> <span class="fa fa-percent"></span> </div><div class="col-md-4"><label>Periodo de calculo</label> <select class="form-control select2" id="periodoCalculoAlmacenaje" name="periodoCalculoAlmacenaje" style="width: 100%;"><option>Diario</option> <option>Mensual</option><option>Anual</option></select> <span class="fa fa-edit"></span></div><div class="col-md-4"><label>Valor Almacenaje</label> <div class="input-group mb-3"><input type="text" class="form-control input-lg" placeholder="valor" id="valorAlmacenaje" name="valorAlmacenaje" required><span class="input-group-append"></span></div></div></div><h3 class="card-title">Tarifa Zona Aduanera</h3><div class="row"> <div class="col-md-4"><label>Base de calculo</label><select class="form-control select2" id="baseCalculoZA" name="baseCalculoZA" style="width: 100%;" disabled="disabled"><option>Porcentaje</option> </select> <span class="fa fa-percent"></span> </div><div class="col-md-4"><label>Periodo de calculo</label> <select class="form-control select2" id="periodoCalculoZA" name="periodoCalculoZA" style="width: 100%;"><option>Diario</option> <option>Mensual</option><option>Anual</option></select> <span class="fa fa-edit"></span></div><div class="col-md-4"><label>Valor Seguro</label> <div class="input-group mb-3"><input type="text" class="form-control input-lg" placeholder="Valor" id="valorZA" name="valorZA" required><span class="input-group-append" id="divbutton"></span> </div></div></div><h3 class="card-title">Peso Almacen Fiscal</h3> <div class="row"> <div class="col-md-4"><label>Calculo de peso</label><select class="form-control select2" id="basePeso" name="basePeso" style="width: 100%;"><option>Tonelada</option> <option>Movimiento</option> <option>Cobro kg</option> <option>Cobro lb</option> </select> <span class="fa fa-edit"> </span> </div><div class="col-md-4"><label>Valor Seguro</label> <div class="input-group mb-3"><input type="text" class="form-control input-lg" placeholder="Valor" id="valorPeso" name="valorPeso"> <span class="input-group-append" id="divbutton"></span> </div></div></div><h3 class="card-title">Gastos Administración</h3> <div class="row"> <div class="col-md-4"><label>Calculo de gastos administración</label> <select class="form-control select2" id="baseGastosAdmin" name="baseGastosAdmin" style="width: 100%;"><option>Individual</option> <option>Consolidado</option><option>Por retiro</option> </select> <span class="fa fa-edit"> </span> </div><div class="col-md-4"><label>Valor Administracion</label> <div class="input-group mb-3"><input type="text" class="form-control input-lg" placeholder="Valor" id="valorGastosAdmin" name="valorGastosAdmin" ><span class="input-group-append" id="divbutton"></span> </div></div></div><h3 class="card-title">Fotocopias</h3><div class="row"> <div class="col-md-4"><label>Calculo de Fotocopias</label><select class="form-control select2" id="baseFotocopias" name="baseFotocopias" style="width: 100%;"><option>Individual</option> <option>Consolidado</option><option>Por retiro</option> </select> <span class="fa fa-edit"></span></div><div class="col-md-4"><label>Valor Fotocopias</label> <div class="input-group mb-3"><input type="text" class="form-control input-lg" placeholder="Valor" id="valorFotocopias" name="valorFotocopias"> <span class="input-group-append" id="divbutton"></span> </div></div></div><h3 class="card-title">Cuadrilla Carga / Descarga</h3><div class="row"> <div class="col-md-4"><label>Carga / Descarga</label> <select class="form-control select2" id="calculocargaDescarga" name="calculocargaDescarga" style="width: 100%;"><option>Cuadrilla carga</option><option>Cuadrilla descarga</option> </select><span class="fa fa-edit"></span> </div><div class="col-md-4"><label>Valor Cuadrilla Carga / Descarga</label><div class="input-group mb-3"> <input type="text" class="form-control input-lg" placeholder="Valor" id="valorcargaDescarga" name="valorcargaDescarga"> <span class="input-group-append" id="divbutton"></span> </div></div></div><h3 class="card-title">Otros Gastos</h3><div class="row"> <div class="col-md-4"><label>Calculo de otros Gastos</label><select class="form-control select2" id="calculoOtrosGastos" name="calculoOtrosGastos" style="width: 100%;"><option>Cuadrilla carga</option><option>Cuadrilla descarga</option> </select> <span class="fa fa-edit"></span></div><div class="col-md-4"><label>Valor Otros Gastos</label> <div class="input-group mb-3"><input type="text" class="form-control input-lg" placeholder="Valor" id="valorOtrosGastos" name="valorOtrosGastos"> <span class="input-group-append" id="divbutton"></span></div></div></div></div><div class="card-footer" id="endfooter"><div class="btn-group"> <button type="button" class="btn btn-primary btnTarifaNormal">Guardar Servicios</button><button type="button" class="btn btn-danger" data-widget="remove" data-toggle="tooltip" title="Remove">Limpiar Pantalla</button></div></div></div>';
        },
        error: function(respuesta) {}
    })
})
$(document).on("click", ".btnGuardarGlobal", function() {
    document.getElementById("individualGlobal").innerHTML = '';
    var Dependencias = document.getElementById("Dependencias").value;
    var regimenSat = document.getElementById("regimenSat").value;
    var tipoPoliza = document.getElementById("tipoPoliza").value;
    document.getElementById("individualGlobal").innerHTML = '';
    document.getElementById("individualGlobal").innerHTML += '<div class="card-body" style=" border-style: ridge; border-color: #5065D9; bord"> <div class="row"> <div class="col-12"><b>Cobro dirigido a la dependencia : </b> <label id="lblNit" style="color:#0072AF;"> ' + Dependencias + '</label> </div><div class="col-12"><b>Cobro dirigido a los regímenes de sat : </b> <label id="lblEmpresa" style="color:#0072AF;"> ' + regimenSat + '</label> </div></div><div class="col-12"><b>Fecha inicio : </b><label id="lblDireccion" style="color:#0072AF;"> ' + tipoPoliza + '</label></div></div>';
})
$(document).ready(function() {
    $("#consultaNitNomal").change(function() {
        document.getElementById("individualGlobal").innerHTML = '';
        var consultaEmpresa = $(this).val();
        var datos = new FormData();
        datos.append("consultaEmpresa", consultaEmpresa);
        $.ajax({
            url: "ajax/parametrizarTarifaNormal.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
                $(function() {
                    $('#datepicker').datepicker({
                        onSelect: function() { // When cal is opened execute
                            var currentDate = new Date($("#datepicker").datepicker("getDate"));
                            var strDateTime = currentDate.getDate() + "/" + (currentDate.getMonth() + 1) + "/" + currentDate.getFullYear();
                            startDatabaseQueries(strDateTime);
                        }
                    })
                });
                document.getElementById("individualGlobal").innerHTML = '';
                document.getElementById("individualGlobal").innerHTML += '<div class="card-body" style=" border-style: ridge; border-color: #5065D9; bord"><div class="row"><div class="col-12"><b>Nit de empresa : </b><label id="lblNit" style="color:#0072AF;">' + respuesta[0]['nitEmpresa'] + '</label></div><div class="col-12"><b>Nombre empresa : </b><label id="lblEmpresa" style="color:#0072AF;">' + respuesta[0]['nombreEmpresa'] + '</label></div></div><div class="col-12"><b>Direccion : </b><label id="lblDireccion" style="color:#0072AF;">' + respuesta[0]['direccionEmpresa'] + '</label></div><div class="col-12"><div class="form-group"><label>Date:</label><div class="input-group date"><div class="input-group-prepend"> <span class="input-group-text"> <i class="fa fa-calendar"></i></span> </div><input type="text" class="form-control pull-right" id="datepicker"> </div> </div></div></div></div>';
            },
            error: function(respuesta) {}
        })
    })
})
$(document).on("click", ".btnTarifaNormal", function() {
    var lblNit = document.getElementById("lblNit").innerHTML;
    var lblEmpresa = document.getElementById("lblEmpresa").innerHTML;
    var lblDireccion = document.getElementById("lblDireccion").innerHTML;
    var baseCalculoAlmacenaje = document.getElementById("baseCalculoAlmacenaje").value;
    var periodoCalculoAlmacenaje = document.getElementById("periodoCalculoAlmacenaje").value;
    var valorAlmacenaje = document.getElementById("valorAlmacenaje").value;
    var baseCalculoZA = document.getElementById("baseCalculoZA").value;
    var periodoCalculoZA = document.getElementById("periodoCalculoZA").value;
    var valorZA = document.getElementById("valorZA").value;
    var basePeso = document.getElementById("basePeso").value;
    var valorPeso = document.getElementById("valorPeso").value;
    var baseGastosAdmin = document.getElementById("baseGastosAdmin").value;
    var valorGastosAdmin = document.getElementById("valorGastosAdmin").value;
    var baseFotocopias = document.getElementById("baseFotocopias").value;
    var valorFotocopias = document.getElementById("valorFotocopias").value;
    var calculoOtrosGastos = document.getElementById("calculoOtrosGastos").value;
    var valorOtrosGastos = document.getElementById("valorOtrosGastos").value;
    var calculocargaDescarga = document.getElementById("calculocargaDescarga").value;
    var valorcargaDescarga = document.getElementById("valorcargaDescarga").value;
    var datos = new FormData();
    datos.append("lblNit", lblNit);
    datos.append("lblEmpresa", lblEmpresa);
    datos.append("lblDireccion", lblDireccion);
    datos.append("baseCalculoAlmacenaje", baseCalculoAlmacenaje);
    datos.append("periodoCalculoAlmacenaje", periodoCalculoAlmacenaje);
    datos.append("valorAlmacenaje", valorAlmacenaje);
    datos.append("baseCalculoZA", baseCalculoZA);
    datos.append("periodoCalculoZA", periodoCalculoZA); datos.append("valorZA", valorZA);
    datos.append("basePeso", basePeso);
    datos.append("valorPeso", valorPeso);
    datos.append("baseGastosAdmin", baseGastosAdmin);
    datos.append("valorGastosAdmin", valorGastosAdmin);
    datos.append("baseFotocopias", baseFotocopias);
    datos.append("valorFotocopias", valorFotocopias);
    datos.append("calculoOtrosGastos", calculoOtrosGastos);
    datos.append("valorOtrosGastos", valorOtrosGastos);
        datos.append("calculocargaDescarga", calculocargaDescarga);
    datos.append("valorcargaDescarga", valorcargaDescarga);
    $.ajax({
        url: "ajax/parametrizarTarifaNormal.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            swal({
                type: "success",
                title: "Guardado Correctamente",
                text: "La tarifa NORMAL, fue guardada con exito, active la tarifa para terminar el proceso",
                showConfirmButton: true,
                confrimButtonText: "Aceptar",
                closeConfirm: true
            });
        },
        error: function(respuesta) {
            console.log(respuesta);
        }
    })
})