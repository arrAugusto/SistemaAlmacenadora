$(document).ready(function () {
    $("#btnEliminar").change(function () {
        window.location = "parametrizarServicios";
    });
});
$(document).on("click", ".btnSegundaCarga", function () {
    var nitEmpresa = document.getElementById("lblCliente").value;
    var idContador = $(this).attr("idContador");
    var idServicio = $(this).attr("idServicio");
    var idservicioalmacenadora = $(this).attr("idservicioalmacenadora");
    var calculoSobreSeguro = document.getElementById("calculoSobreSeguro" + idContador).value;
    var baseCalculo = document.getElementById("baseCalculo" + idContador).value;
    var periodoCalculo = document.getElementById("periodoCalculo" + idContador).value;
    var monedaSeguro = document.getElementById("monedaSeguro" + idContador).value;
    var valorSobreSeguro = document.getElementById("valorSeguro" + idContador).value;
    var basePeso = document.getElementById("basePeso" + idContador).value;
    var monedaPeso = document.getElementById("monedaPeso" + idContador).value;
    var valorPeso = document.getElementById("valorPeso" + idContador).value;
    var valorGastosAdmin = document.getElementById("valorGastosAdmin" + idContador).value;
    var monedaGtsAdmin = document.getElementById("monedaGtsAdmin" + idContador).value;
    var valorGtosA = document.getElementById("valorGtosA" + idContador).value;
    var calculoOtrosGastos = document.getElementById("calculoOtrosGastos" + idContador).value;
    var monedaOtrosGastos = document.getElementById("monedaOtrosGastos" + idContador).value;
    var valorOtrosGastos = document.getElementById("valorOtrosGastos" + idContador).value;
    if (valorSobreSeguro == "" && valorPeso == "" && valorGtosA == "" && valorGtosA == "") {
        alert("vacios");
    } else {
        var datos = new FormData();
        datos.append("idContador", idContador);
        datos.append("idOtroServicios", idServicio);
        datos.append("calculoSobreSeguro", calculoSobreSeguro);
        datos.append("baseCalculo", baseCalculo);
        datos.append("periodoCalculo", periodoCalculo);
        datos.append("monedaSeguro", monedaSeguro);
        datos.append("valorSobreSeguro", valorSobreSeguro);
        datos.append("basePeso", basePeso);
        datos.append("monedaPeso", monedaPeso);
        datos.append("valorPeso", valorPeso);
        datos.append("valorGastosAdmin", valorGastosAdmin);
        datos.append("monedaGtsAdmin", monedaGtsAdmin);
        datos.append("valorGtosA", valorGtosA);
        datos.append("calculoOtrosGastos", calculoOtrosGastos);
        datos.append("monedaOtrosGastos", monedaOtrosGastos);
        datos.append("valorOtrosGastos", valorOtrosGastos);
        datos.append("idservicioalmacenadora", idservicioalmacenadora);
        datos.append("nitEmpresa", nitEmpresa);
        $.ajax({
            url: "ajax/activarOtrosServicios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                var endfo = "endfooter" + idContador;
                if (respuesta[0] == "ok") {
                    document.getElementById("calculoSobreSeguro" + idContador).disabled = true;
                    document.getElementById("periodoCalculo" + idContador).disabled = true;
                    document.getElementById("monedaSeguro" + idContador).disabled = true;
                    document.getElementById("valorSeguro" + idContador).readOnly = true;
                    document.getElementById(endfo).innerHTML = '';
                } else {
                    var divbutton = "divbutton" + idContador + 1;
                    document.getElementById(divbutton).innerHTML += '<button class="btn btn-danger" type="button">Guardar</button>';
                    document.getElementById(endfo).innerHTML = '';
                }
                if (respuesta[1] == "ok") {
                    document.getElementById("basePeso" + idContador).disabled = true;
                    document.getElementById("monedaPeso" + idContador).disabled = true;
                    document.getElementById("valorPeso" + idContador).readOnly = true;
                    document.getElementById(endfo).innerHTML = '';
                } else {
                    var divbutton = "divbutton" + idContador + 2;
                    document.getElementById(divbutton).innerHTML += '<button class="btn btn-danger" type="button">Guardar</button>';
                    document.getElementById(endfo).innerHTML = '';
                }
                if (respuesta[2] == "ok") {
                    document.getElementById(endfo).innerHTML = '';
                    document.getElementById("valorGastosAdmin" + idContador).disabled = true;
                    document.getElementById("monedaGtsAdmin" + idContador).disabled = true;
                    document.getElementById("valorGtosA" + idContador).readOnly = true;
                } else {
                    var divbutton = "divbutton" + idContador + 3;
                    document.getElementById(divbutton).innerHTML += '<button class="btn btn-danger" type="button">Guardar</button>';
                    document.getElementById(endfo).innerHTML = '';
                }
                if (respuesta[3] == "ok") {
                    document.getElementById("calculoOtrosGastos" + idContador).disabled = true;
                    document.getElementById("monedaOtrosGastos" + idContador).disabled = true;
                    document.getElementById("valorOtrosGastos" + idContador).readOnly = true;
                    document.getElementById(endfo).innerHTML = '';
                } else {
                    var divbutton = "divbutton" + idContador + 4;
                    document.getElementById(divbutton).innerHTML += '<button class="btn btn-danger" type="button">Guardar</button>';
                    document.getElementById(endfo).innerHTML = '';
                }
                let timerInterval
                Swal.fire({
                    title: '¡Servicios parametrizados!',
                    html: 'Tiempo <strong></strong> Segundos.<br/><br/>' + '<button id="increase" class="btn btn-info">' + 'Seguro:  ' + respuesta[0] + '</button><br/>' + '<button id="increase" class="btn btn-success">' + 'Manejo:  ' + respuesta[1] + '</button><br/>' + '<button id="increase" class="btn btn-warning">' + 'Gastos Administración:  ' + respuesta[2] + '</button><br/>' + '<button id="increase" class="btn btn-dark">' + 'Otros Gastos:  ' + respuesta[3] + '</button><br/>',
                    timer: 10000,
                    onBeforeOpen: () => {
                        const content = Swal.getContent()
                        const $ = content.querySelector.bind(content)
                        const stop = $('#stop')
                        const resume = $('#resume')
                        const toggle = $('#toggle')
                        const increase = $('#increase')
                        Swal.showLoading()
                        function toggleButtons() {
                            stop.disabled = !Swal.isTimerRunning()
                            resume.disabled = Swal.isTimerRunning()
                        }
                        timerInterval = setInterval(() => {
                            Swal.getContent().querySelector('strong').textContent = (Swal.getTimerLeft() / 1000).toFixed(0)
                        }, 100)
                    },
                    onClose: () => {
                        clearInterval(timerInterval)
                    }
                })
            },
            error: function (respuesta) {}
        })
    }
});
$(document).on("click", ".btnActi", function () {
    Swal.fire({
        title: '¿Listo?',
        text: "Si termino de parametrizar los servicios haga click, en aceptar",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.value) {
            window.location = "detallesTarifa";
        }
    })
})
