<style>
    .invoice-box {
        max-width: 1000px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr.header td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.item td:nth-child(3) {
        text-align: right;
    }


    .invoice-box table tr.item td:nth-child(1) {
        width:15px;
    }


    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    .disabledDiv{
        pointer-events:none;
    }
    .container-fluid .centered-vertically{
        display:flex;
        align-items:center;
    }

    .light-wrapper {
        margin: 0px auto;
        height: 130px;
        width: 75px;
        background-color: black;
        padding: 10px;
        border-radius:5px;
        border:1px solid #eee;
    }

    .light {
        margin: 3px auto;
        height: 30px;
        width: 30px;
        background-color: #848484;
        border-radius: 50%;
        box-shadow:inset 0 1px 0 0 rgba(0,0,0,0.2);
    }

    .red.active {
        background-color: #DF0101;
    }
    .yellow.active {
        background-color: #FF0;
    }
    .green.active {
        background-color: #76ff03;
    }

</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pases de Salida</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Pases de salida Bodega</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="col-md-12">
        <div class="card card-success card-outline">

            <form role="form" method="post">
                <div class="card-body">
                    <div class="col-12" id="divAlerta">

                    </div>
                    <div>
                        <input type="hidden" id="hiddenTipoOP" value="" />
                    </div>
                    <div class="col-12">
                        <div class="row" id="divCalculoHistoria">
                        </div>

                        <?php
                        if ($_SESSION["departamentos"] != "Operaciones Fiscales") {

                            echo '
    
                         </div>
<div class="alert alert-danger" role="alert">
Las mercaderías listadas son clientes que estan por retirarse,
si la mercaderia no puede salir, comuniquese con el area de oficinas fiscales
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>   
    
    ';
                        }
                        ?>
                        <div class="col-12 mt-4">
                            <table id="tablasVehiculos" role="grid" class="table dt-responsive table-striped table-hover table-sm" >
                                <thead>
                                    <tr>
                                    <th style="whidth:5px">#</th>
                                    <th>Nit</th>
                                    <th>Nombre de Empresa</th>
                                    <th>Poliza Ing</th>
                                    <th>Poliza Ret</th>
                                    <th>Bultos</th>
                                    <th>Peso</th>
                                    <th>Servicio</th>
                                    <?php
                                    if ($_SESSION["departamentos"] == "Operaciones Fiscales") {
                                        echo '<th>Acciones</th>';
                                    }
                                    ?>
                                    </tr>
                                </thead> <tbody>
                                    <?php
                                    $tipo = 0;
                                    $respuesta = ControladorPasesDeSalida::ctrListarRetiros($tipo);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade responsive" id="modalPaseSalida" role="dialog">
    <div class="modal-dialog modal-lgMapa">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <label>Póliza de ingreso</label>
                        <input type="text" class="form-control" id="polizaIngreso" value="" disabled/>
                    </div>
                    <div class="col-4">
                        <label>Póliza de retiro</label>
                        <input type="text" class="form-control" id="polizaRetiro" value="" disabled/>
                    </div>  
                    <div class="col-4">
                        <label>Numero de retiro</label>
                        <input type="text" class="form-control" id="numeroRetiro" value="" disabled/>
                    </div>
                    <div class="col-4 mt-4">
                        <label>Valor en Aduana Total</label>
                        <input type="number" class="form-control is-invalid" id="valorDoll" placeholder="Ejemplo : 40525.23" value=""/>
                        <span class="badge bg-danger pull-right" id="spanvalorDoll" style="display: none;"></span>
                    </div>
                    <div class="col-4 mt-4">
                        <label>Tasa de Cambio</label>                        
                        <input type="number" class="form-control is-invalid" id="tCambio" placeholder="Ejemplo : 7.6452" value=""/>
                        <span class="badge bg-danger pull-right" id="spantCambio" style="display: none;"></span>                        
                    </div>
                    <div class="col-4 mt-4">
                        <label>Total Val. Aduana * Tasa de Cambio</label>   
                        <input type="number" class="form-control is-invalid" id="cif" placeholder="Ejemplo : 309823.49" value=""/>
                        <span class="badge bg-danger pull-right" id="spancif" style="display: none;"></span>                        

                    </div>
                    <div class="col-4 mt-4">
                        <label>Total General (DAI+IVA)</label>
                        <input type="number" class="form-control is-invalid" id="impuestos" placeholder="Ejemplo : 41252.13" value=""/>
                        <span class="badge bg-danger pull-right" id="spanimpuestos" style="display: none;"></span>                        

                    </div>
                    <div class="col-4 mt-4">
                        <label>Peso Bruto Total KG</label>
                        <input type="number" class="form-control is-invalid" id="peso" placeholder="Ejemplo : 524.25" value=""/>
                        <span class="badge bg-danger pull-right" id="spanpeso" style="display: none;"></span>                        

                    </div>
                    <div class="col-4 mt-4">
                        <label>Total de Bultos en Póliza</label>
                        <input type="number" class="form-control is-invalid" id="bultos" placeholder="Ejemplo : 5" value=""/>
                        <span class="badge bg-danger pull-right" id="spanbultos" style="display: none;"></span>                        
                    </div>
                    <div class="col-6 mt-4">
                        <button type="button" class="btn btn-outline-info btn-block btn-sm btnTomarDatRet">Tomar datos de retiro <i class="fa fa-recycle"></i></button>
                    </div>        
                    <div class="col-12 mt-4" id="tableVehUsados">
                        
                    </div>                     
                    <div class="col-12 mt-4">
                        <button type="button" id="capturarQRPol" class="btn btn-outline-secondary btnCapturarQRPol btn-block" style="font-size:25px">Codigo de Barras&nbsp;&nbsp;&nbsp;<i class='fa fa-barcode' style='font-size:48px;'></i></button>
                    </div>                    

                    <input type="hidden" id="hiddenvalorDoll" value="">
                    <input type="hidden" id="hiddentCambio" value="">
                    <input type="hidden" id="hiddencif" value="">
                    <input type="hidden" id="hiddenimpuestos" value="">
                    <input type="hidden" id="hiddenbultos" value="">
                    <input type="hidden" id="hiddenMarchElect" value="">
                    <input type="hidden" id="hiddenGTOAcuse" value="">


                    <input type="hidden" id="hiddenpeso" value="">
                    <input type="hidden" id="hiddenOtros" value="">
                    <input type="hidden" id="spanTotalC" value="">
                    <input type="hidden" id="hiddenZonaAduana" value="">  

                    <input type="hidden" id="hiddenRevision" value="">                     
                    <input type="hidden" id="hiddenAlmacenaje" value="">                    
                    <input type="hidden" id="hiddenManejo" value="">                    
                    <input type="hidden" id="hiddenGstosAdmin" value="">                    
                    <input type="hidden" id="hiddenresultIdIngreso" value="">                    
                    <input type="hidden" id="serviciosDefTotal" value="">
                    <input type="hidden" id="valDescuento" value="">   
                    <input type="hidden" id="hiddenTotalCobrar" value="">                    
                    <input type="hidden" id="hiddenDescuento" value=""> 
                </div>
            </div>
            <div class="modal-footer" id="divButtonPase">
                <button type="button" class="btn btn-primary btnImprimirRecibo" id="btnCalculoAlm" data-dismiss="modal">Confirmar datos <i class="far fa-check-circle"></i></button>
            </div>
        </div>
    </div>
</div>
<div class="tipOtros responsive" id="tipOtros">
    <div class="card card-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-warning">
            <button type="button" class="btn btn-tool pull-right btnCerrarOtros"><i class="fa fa-times"></i>
            </button>
            <h4>Total Otros gastos</h4>
        </div>
        <div id="divCrearListOtros" class="card-footer p-0">

        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="plusOtrosServicios" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Complete el Formulario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label>
                            AGREGAR MAS SERVICIOS
                        </label>
                        </input>
                    </div>
                    <div class="col-6 form-group">
                        <label>
                            Nombre del servicio
                        </label>
                        <select class="form-control select2" id="selectOtrosServ"style="width: 100%;">
                            <option selected="selected" disabled="disabled">Seleccione el servicio</option>
                            <?php
                            $respuesta = ControladorPasesDeSalida::ctrMostrarOtrosServicios();
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="col-12">
                            <label>
                                Valor Peso
                            </label>
                            <div class="input-group">
                                <input class="form-control is-invalid" id="montoOtroServicio" name="montoOtroServicio" placeholder="Ingrese monto del servicio" type="number" />

                                <span class="input-group-append">
                                    <button btnagrega="0" class="btn btn-primary btn-flat btnNuevoServicios" type="button">Agregar nuevo servicio</button>
                                </span>
                            </div>
                        </div>
                        <center><label id="pesoSobregiro" style="color:red;"></label></center>
                    </div>
                    <div class="col-md-12" id="divOtrosServicios"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="plusServiciosDefalult" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Complete el Formulario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="row">
                        <div class="col-12">
                            <label>
                                AGREGAR MAS SERVICIOS
                            </label>
                            </input>
                        </div>
                        <div class="col-6 form-group">
                            <label>
                                Nombre del servicio
                            </label>
                            <select class="form-control select2" id="selectOtrosServDefault"style="width: 100%;">
                                <option selected="selected" disabled="disabled">Seleccione el servicio</option>
                                <?php
                                $respuesta = ControladorPasesDeSalida::ctrMostrarServiciosDefault();
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="col-12">
                                <label>
                                    Valor Peso
                                </label>
                                <div class="input-group">
                                    <input class="form-control is-invalid" id="montoOtroServicioDefault" name="montoOtroServicio" placeholder="Ingrese monto del servicio" type="number" />

                                    <span class="input-group-append">
                                        <button btnagrega="0" class="btn btn-primary btn-flat btnServiciosDefault" type="button">Agregar nuevo servicio</button>
                                    </span>
                                </div>
                            </div>
                            <center><label id="pesoSobregiro" style="color:red;"></label></center>
                        </div>
                        <div class="col-md-12" id="divServiciosDefault"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="plusPilotos" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalRebajaMercaOpStock"></h3>
                <button type="button" class="close" data-dismiss="modal" id="cerrarMinModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 mt-4">
                        <input class="form-control is-invalid" type="number" placeholder="Ingrese numero de licencia sin guiones" id="numeroLicenciaPlus" name="numeroLicencia" onkeyup="javascript:this.value = this.value.toUpperCase();" value="" />
                        <input type="hidden" id="idPilotoPlusUni" value="" />
                    </div>
                    <div class="col-6 mt-4">
                        <input class="form-control is-invalid" type="text" placeholder="Ingrese nombre del piloto" id="nombrePilotoPlusUn" name="nombrePiloto" onkeyup="javascript:this.value = this.value.toUpperCase();" value="" />
                    </div>
                    <div class="col-6 mt-4">
                        <input class="form-control is-invalid" type="text" id="numeroPlacaPlusUn" name="numeroPlaca" placeholder="Escriba el numero de placa" onkeyup="javascript:this.value = this.value.toUpperCase();">
                    </div> 
                    <div class="col-6 mt-4">    
                        <input class="form-control is-invalid" type="text" id="numeroContenedorPlusUn" name="numeroContenedor" placeholder="Escriba el numero de contenedor" onkeyup="javascript:this.value = this.value.toUpperCase();">
                    </div>
                   <div class="col-6 mt-4">
                        <input class="form-control is-invalid" type="number" id="numeroMarchamoPlusUn" name="numeroMarchamoPlusUn" placeholder="Escriba el numero de marchamo" onkeyup="javascript:this.value = this.value.toUpperCase();">
                    </div>                    
                    <div class="col-12 mt-4">
                        <button type="button" id="capturarQRPol" class="btn btn-outline-secondary btnCapturarQRPol btn-block" style="font-size:25px">Codigo de Barras&nbsp;&nbsp;&nbsp;<i class="fa fa-barcode" style="font-size:48px;"></i></button>
                    </div>        
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-flat btn-sm btnGuardaNuevaUnidadPlus" id="btnGuardaNuevaUnidad">Guardar Nueva Unidad</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPreImpresoRecibo" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- The Modal -->


            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Recibo de facturación </h4>
                <button type="button" class="close" id="buttonMenuMins" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <input type="text" class="form-control is-invalid" id="txtNitSalida" dataretiro="" placeholder="Ejemplo : 37315213" onkeyup="javascript:this.value = this.value.toUpperCase();">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-primary btn-block btnBuscaRetiro">Cambiar Nit <i class="fa fa-exchange"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <table data-module="table 02" border="0" width="100%" cellpadding="0" cellspacing="0" style="padding:0;background:#ffffff;" class="currentTable">
                            <tr valign="top">
                            <td class="editable">
                                <table width="650" style="padding:30px;margin:0 auto 0 auto;width:650px;background:#ffffff;border-right:1px solid #ddd;border-left:1px solid #ddd;" cellpadding="0" cellspacing="0" bgcolor="#fff">
                                    <tr valign="top">
                                    <td>
                                        <h1 style="font-family:Ruda, Arial, Helvetica, sans-serif;font-weight:300;font-size:20px;text-transform:capitalize" align="center" data-color="Headline01" data-size="Headline01" data-min="20" data-max="26">
                                            <?php echo $_SESSION["Navega"]; ?>
                                        </h1>
                                        <div style="height:1px;background:#59C2C5;width:100px;margin:0 auto 0 auto;">
                                        </div>
                                    </td>
                                    </tr>
                                    <tr valign="top">
                                    <td style="font-size: 0; line-height: 0;" height="20">
                                        &nbsp;
                                    </td>
                                    </tr>
                                    <tr valign="top">
                                    <td style="padding:0;width:100%;border:1px solid #ddd">
                                        <!-- ///////////////////////////////// table payment ///////////////////////////////// -->

                                        <table border="0" width="100%" cellpadding="0" cellspacing="0" style="padding:0;margin:0">
                                            <tr>
                                            <td style="font-family:Ruda, Arial, Helvetica, sans-serif;font-weight:bold;font-size:12px;border-top:1px solid #fff;border-left:1px solid #fff;padding:8px 5px;background:#59C2C5;color:#fff" align="center">

                                            </td>
                                            <td colspan="5" style="font-family:Open Sans, Arial, Helvetica, sans-serif;font-weight:300;font-size:12px;border-top:1px solid #fff;border-right:1px solid #fff;padding:8px 5px;background:#59C2C5;color:#fff" width="100%" align="left">
                                                Recibo de Almacenaje
                                            </td>
                                            </tr>
                                            <tr>
                                            <td colspan="6">
                                                <table border="0" width="100%" cellpadding="0" cellspacing="0" style="padding:0;margin:0">
                                                    <tr valign="top">

                                                    <td id="tdDatosGenerales">

                                                    </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td style="font-family:Ruda, Arial, Helvetica, sans-serif;font-weight:300;font-size:12px;background-color:#ccc;color:#fff;line-height:22px;border-top:1px solid #fff;border-left:1px solid #fff;border-bottom:1px solid #ddd;padding:5px;width:5%" align="center">
                                                No
                                            </td>
                                            <td style="font-family:Ruda, Arial, Helvetica, sans-serif;font-weight:300;font-size:12px;background-color:#ccc;color:#fff;line-height:22px;border-top:1px solid #fff;border-left:1px solid #fff;border-bottom:1px solid #ddd;padding:5px;width:40%" align="left">

                                                Descripción
                                            </td>

                                            <td style="font-family:Ruda, Arial, Helvetica, sans-serif;font-weight:300;font-size:12px;background-color:#ccc;color:#fff;line-height:22px;border-top:1px solid #fff;border-left:1px solid #fff;border-bottom:1px solid #ddd;padding:5px;width:10%" align="center">
                                                Total Cobrado
                                            </td>
                                            </tr>
                                            <tbody id="tableDetalleConsumo">


                                            </tbody>
                                            <tr>

                                            <td colspan="2" style="font-family:Open sans, Arial, Helvetica, sans-serif;font-weight:300;font-size:15px;line-height:1.4em;border:1px solid #fff;padding:10px 5px;" align="right">
                                                TOTAL A COBRAR
                                            </td>
                                            <td id="totalCobro" style="text-align: left; font-family:Open Sans, Arial, Helvetica, sans-serif;font-weight:600;font-size:15px;line-height:1.4em;letter-spacing:1px;border:1px solid #fff;background-color:#59C2C5;color:#fff;padding:10px 5px;" align="right">

                                            </td>
                                            </tr>
                                        </table>
                                        <!-- ///////////////////////////////// table payment end ///////////////////////////////// -->

                                    </td>
                                    </tr>
                                    <tr valign="top">
                                    <td style="font-size: 0; line-height: 0;" height="20">
                                        &nbsp;
                                    </td>
                                    </tr>
                                    <tr valign="top">
                                    <td>
                                        <div data-color="ContentTable02" data-size="ContentTable02" style="font-family:Open Sans, Arial, Helvetica, sans-serif;font-size:14px;font-weight:300;line-height:1.4em;" align="left">

                                        </div>
                                    </td>
                                    </tr>
                                    <tr valign="top">
                                    <td style="font-size: 0; line-height: 0;" height="20">
                                        &nbsp;
                                    </td>
                                    </tr>
                                    <tr valign="top">
                                    <td><center>
                                        <div  class="col-sm-12 col-lg-4 mt-4">                                
                                            <div class="btn btn-outline-danger btn-block btn-lg btn-flat imprimirReciboAlmacenaje">
                                                <i class="fa fa-print fa-lg mr-2"></i>
                                                Imprimir Recibo
                                            </div>    
                                        </div>
                                            </center>
                                    </td>
                                    </tr>
                                </table>
                            </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

