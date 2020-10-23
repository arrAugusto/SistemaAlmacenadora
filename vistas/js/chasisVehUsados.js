$(document).on("click", ".btnExcelChasis", async function () {
    Swal.fire({
        title: 'Quiere descarga el reporte en excel?',
        text: "Esto puede tardar unos segundos!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        allowOutsideClick: false,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Descargar!'
    }).then(async function (result) {
        if (result.value) {
            var tipoOp = 1;

            var nomVar = "generateHistoriaChasis";
            var resp = await insertNuevoServicio(nomVar, tipoOp);
            var nombreReporte = 'HISTORIAL DE CHASIS VEHÍCULOS USADOS';
            var nombreEncabezado = "DescargaReporteExcel";
            var nombreFile = "ReporteDeIngresosVehUs_";
            var creaExcel = await JSONToCSVDescargaExcel(resp, nombreEncabezado, nombreReporte, nombreFile, true);
            console.log(resp);
        }
    })
})
