<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    #fondoSwitch{

        background-color: black;

    }


    .has-error .select2-selection {
        border-color: rgb(185, 74, 72) !important;
    }

    .has-success .select2-selection {
        border-color: #00AA0D !important;
    }

</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Elaboración de Ingresos Fiscales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <div class="card card-info card-outline">

            <form role="form" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 col-sm-4" id="divNitNuevo">

                            <div class="form-group">
                                <label>Nit del Cliente</label>
                                <input class="form-control is-invalid" type="text" placeholder="Ingrese el número de nit" id="txtNitEmpresa" />
                            </div>

                        </div>
                        <div class="col-md-6 col-lg-4 col-sm-4">
                            <label>Fecha Real de Ing</label>
                            <input type="text" id="dateTime" class="form-control">
                            <input type="hidden" id="hiddenDateTime" value="<?php
                            date_default_timezone_set('America/Guatemala');
                            echo date('Y-m-d H:i:s');
                            ?>">
                            <input type="hidden" id="hiddenDateTimeVal" value="<?php
                            date_default_timezone_set('America/Guatemala');
                            echo date('d-m-Y');
                            ?>">                 
                        </div>
                        <div class="col-md-6 col-lg-4 col-sm-4">
                            <label>Consolidados</label><br/>
                            <button type="button" class="btn btn-primary" id="buttonMostrarCons" data-toggle="modal" data-target="#exampleModalCenter">
                                Mostrar consolidados&nbsp;&nbsp;<i class="fa fa-database"></i>
                            </button>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 mt-4">
                            <button type="button" id="capturarQRPol" class="btn btn-outline-secondary btnCapturarQRPol btn-block" style="font-size:25px">Codigo de Barras&nbsp;&nbsp;&nbsp;<i class='fa fa-barcode' style='font-size:48px;'></i></button>
                        </div>    
                        <div class="col-md-6 col-lg-6 col-sm-12 mt-4">
                            <button type="button" id="manifiestosSat" class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#verManifiestosSat" style="font-size:25px">MANIFIESTOS&nbsp;&nbsp;&nbsp;<i class='fa fa-external-link-square' style='font-size:48px;'></i></button>
                        </div>                            
                        <div class="col-md-12 mt-4" id="individualGlobal">
                            <div class="col-md-12" id="imprimirCotizacion">

                                <div class="row invoice-info">
                                    <div class="col-sm-5 invoice-col">
                                        <label>
                                            Datos del Cliente
                                        </label>
                                        <address>
                                            <b>
                                                Nit:
                                            </b>
                                            <label id="lblNit" style="font-weight: normal;">

                                            </label>
                                            <br/>
                                            <input id="lblClienteId" name="lblClienteId" type="hidden" value="" />
                                            <b>
                                                Empresa:
                                            </b>
                                            <label id="lblEmpresa" style="font-weight: normal;">

                                            </label>
                                            <br/>
                                            <b>
                                                Direccion:
                                            </b>
                                            <label id="lblDireccion" style="font-weight: normal;">
                                            </label>
                                            <br/>
                                            <div id="divCodigo">
                                                <div class="col-12">
                                                    <b>
                                                        <!--  Codigo : -->
                                                    </b>
                                                    <label id="lblCodigo" style="color:#0072AF;">
                                                    </label>
                                                </div>
                                            </div>
                                            <br/>
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col" id="divContacto">
                                        <b>
                                            Datos de Contacto
                                        </b>
                                        <br/>
                                        <br/>
                                        <b>
                                            Contacto:
                                        </b>
                                        <label id="lblNombreContacto" style="font-weight: normal;">

                                        </label>
                                        <br/>
                                        <b>
                                            Telefono:
                                        </b>
                                        <label id="lblTelefonoC" style="font-weight: normal;">

                                        </label>
                                        <br/>
                                        <b>
                                            Correo:
                                        </b>
                                        <label id="lblCorreoC" style="font-weight: normal;">

                                        </label>
                                        <br/>
                                        <b>
                                            # Tarifa:
                                        </b>
                                        <label id="lblNúmerotarifa" style="font-weight: normal;">

                                        </label>
                                        <input id="lblIdMostrar" name="idMostrar" type="hidden" value="2">

                                        <br/>
                                        <div id="divVerTarifa">
                                        </div>
                                        <br/>
                                        </input>
                                        <br/>
                                    </div>
                                    <div class="col-sm-3 invoice-col" id="divEjecutivo">
                                        <b>
                                            Datos Ejecutivo
                                        </b>
                                        <br/>
                                        <input id="lblEjecutivo" name="lblEjecutivo" type="hidden" value="">
                                        <br/>
                                        <b>
                                            Ejecutivo:
                                        </b>
                                        <label id="lblNombreEjecutivo" style="font-weight: normal;">
                                        </label>
                                        <br/>
                                        <b>
                                            Telefono:
                                        </b>
                                        <label id="lblTelefonoE" style="font-weight: normal;">
                                        </label>
                                        <br/>
                                        <b>
                                            Correo:
                                        </b>
                                        <label id="lblCorreoE" style="font-weight: normal;">
                                        </label>
                                        <br/>
                                        <b>
                                            Departamento:
                                        </b>
                                        <label id="lblDeptoE" style="font-weight: normal;">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="formDinamic  mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <h3 class="card-title" style="color: yellow;">Datos Generales de Póliza</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4" id="divSeleccionDeServicios">
                                                <label>Selecciona Servicio</label>
                                                <select class="form-control is-invalid" id="servicioTarifa" name="servicioTarifa"></select>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Régimen / Modalidad Póliza</label>
                                                    <select class="form-control is-invalid" style="width: 100%;" id="regimenPoliza" name="regimenPoliza" required>
                                                        <option selected="selected" disabled="disabled">Seleccione regimen</option>
                                                        <?php
                                                        $respuesta = ControladorHistorialIngresos::ctrMostrarRegimenes();
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="divCartaCupo">
                                                <div class="form-group">
                                                    <label>Número de Carta Cupo</label>
                                                    <input class="form-control is-invalid" type="text" placeholder="Ejemplo : AI-12-2485-20.." id="cartaDeCupo" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Cantidad de Contenedores</label>
                                                    <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 1" id="cantContenedores" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                                <!--<center id="infoCantidadCont"></center>-->
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Número de DUA</label>
                                                    <input class="form-control is-invalid" type="text" placeholder="Ejemplo : GTCTUTU-19-111271-1" id="dua" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>BL, Carta Porte y Factura Comercial</label>
                                                    <input class="form-control is-invalid" type="text" placeholder="Ejemplo : 8502520" id="bl" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Número de Póliza</label>
                                                    <input class="form-control is-invalid" type="text" placeholder="Ejemplo : 2999502512" id="poliza" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Total de Bultos en Póliza</label>
                                                    <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 1250" id="bultosIngreso" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group has-error" id="selectSucces">
                                                    <label>Aduana / Puerto de Origen</label>
                                                    <select  class="select2" style="width: 100%;" id="puertoOrigen">
                                                        <option selected="selected" disabled="disabled">Seleccione Aduana / Puerto</option>
                                                        <?php
                                                        $respuesta = ControladorHistorialIngresos::ctrMostrarPuertos();
                                                        ?>
                                                    </select>
                                                </div> 
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Cantidad de Clientes</label>
                                                    <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 1" id="cantClientes" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Descripción de la Mercadería</label>
                                                    <input class="form-control is-invalid" type="text" placeholder="Ejemplo : MAQUINAS DE CORTE" id="producto" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Peso Bruto Total KG</label>
                                                    <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 250.25" id="pesoIng" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Valor en Aduana Total $.</label>
                                                    <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 12503.25" id="valorTotalAduana" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tasa de Cambio Q.</label>
                                                    <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 7.65452" id="tipoDeCambio" name="tipoDeCambio" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Total Val. Aduana * Tasa de Cambio Q.</label>
                                                    <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 95706.38" id="totalValorCif" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Total General (DAI+IVA) Q.</label>
                                                    <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 32125.25" id="valorImpuesto" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="divPiloto">
                                                <div class="form-group">
                                                    <label>Número de Licencia</label>
                                                    <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 2330675310201" id="numeroLicencia" name="númeroLicencia" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nombre de Piloto</label>
                                                    <input class="form-control is-invalid" type="text" placeholder="Ejemplo : MIGUEL ANGEL PEREZ FLORES" id="nombrePiloto" name="nombrePiloto" readonly="readonly" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Número de Placa</label>
                                                    <input class="form-control is-invalid" type="text" placeholder="Ejemplo : C250CMK" id="numeroPlaca" name="númeroPlaca" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Número de Contenedor</label>
                                                    <input class="form-control is-invalid" type="text" placeholder="Ejemplo : CMCU850425" id="numeroContenedor" name="númeroContenedor" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="divMarchamo">
                                                <div class="form-group">
                                                    <label>Número de Marchamo</label>
                                                    <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 451023" id="numeroMarchamo" name="númeroMarchamo"  onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>

                                            <div class="col-md-4" id="divConsolidado">
                                                <div class="form-group ">
                                                    <label>Tipo de Consolidado</label>
                                                    <select multiple class="form-control is-invalid" id="sel2" name="sellist2">
                                                        <option selected="true" disabled="disabled">Seleccion ubicación</option>
                                                        <option>Cliente individual</option>
                                                        <option>Cliente consolidado</option>
                                                        <option>Cliente consolidado poliza</option>
                                                    </select>
                                                </div>


                                            </div>
                                            <div id="divButtonIndiv">

                                            </div>                                            
                                            <input type="hidden" id ="hiddenConsolidado" value=""> 
                                            <input type="hidden" id ="hiddenTipoTar" value=""> 
                                            <input type="hidden" id ="hidenPilotosPlus" value="">
                                            <input type="hidden" id ="hiddenIdentity" value="">

                                            <input type="hidden" id ="hiddenContadorPolizas" value="0">
                                            <input type="hidden" id ="hiddencartaDeCupo" value="">
                                            <input type="hidden" id ="hiddencantContenedores" value="">
                                            <input type="hidden" id ="hiddendua" value="">
                                            <input type="hidden" id ="hiddenbl" value="">
                                            <input type="hidden" id ="hiddenpoliza" value="">
                                            <input type="hidden" id ="hiddenbultosIngreso" value="">
                                            <input type="hidden" id ="hiddenpuertoOrigen" value="">
                                            <input type="hidden" id ="hiddencantClientes" value="">
                                            <input type="hidden" id ="hiddenproducto" value="">
                                            <input type="hidden" id ="hiddenpesoIng" value="">
                                            <input type="hidden" id ="hiddenvalorTotalAduana" value="">
                                            <input type="hidden" id ="hiddentipoDeCambio" value="">
                                            <input type="hidden" id ="hiddentotalValorCif" value="">
                                            <input type="hidden" id ="hiddenvalorImpuesto" value="">
                                            <input type="hidden" id ="hiddenregimenPoliza" value="">
                                            <input type="hidden" id ="hiddennumeroLicencia" value="">
                                            <input type="hidden" id ="hiddennombrePiloto" value="">
                                            <input type="hidden" id ="hiddennumeroPlaca" value="">
                                            <input type="hidden" id ="hiddennumeroContenedor" value="">
                                            <input type="hidden" id ="hiddennumeroMarchamo" value="">
                                            <input type="hidden" id ="hiddenselectTipoConsolidado" value="">
                                            <input type="hidden" id="parseRepuesta" value="">
                                            <input type="hidden" id="hiddenValidacion" value=""/>
                                            <input type="hidden" id="lblEjecutivo" name="lblEjecutivo" value="">
                                            <input type="hidden" id="dependencia" value="">

                                            <div class="col-md-4" id="divPilotoExt">

                                            </div>
                                            <div class="col-12 mt-4">
                                                <div class="row">
                                                    <div class="col-5" id="divPlusClientes">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 mt-4" id="divAccionesValidacion">
                                            </div>
                                            <div class="col-md-4" id="divRelleno">
                                            </div>
                                            <div class="col-md-4" id="divAccionesVehiculos">
                                                <div class="small-box bg-danger" id="colorDiv">
                                                    <div class="inner">
                                                        <h3 id="contadorH3">0</h3>
                                                        <p id="clientesRegs">Clientes Registrados en Detalle</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-bag"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">Ver Detalles Agregados<i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">

                                            <div class="col-12">
                                                <div id="divAcciones">

                                                    <?php
                                                    //btnIngresoSinTarifa
                                                    if ($_SESSION["departamentos"] == "Operaciones Fiscales") {
                                                        echo '<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#verPrediosBodegas">Iniciar </button>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="col-6" id="divMasButtons">
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </section>
</div>


<!--=====================================
MODAL GUARDAR DATOS
======================================-->
<!-- Modal -->
<div id="guardarEmpresas" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!--=====================================
                INICIO FORM
                ======================================-->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Selección de Tipo de Cliente.</h3>
                        </div>
                        <!--campos formularios -->
                        <form role="form" method="post" id="divGuardaDetalle">
                            <div class="form-horizontal">
                                <div class="card-body">
                                    <div class="row" id="diveGuardaEmpresa">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    Minimal
                                                </label>
                                                <select class="form-control select2" id="selectConsolidado" name="selectConsolidado" style="width: 100%;">
                                                    <option selected="selected">
                                                        Selecciona Consolidado
                                                    </option>
                                                    <option>
                                                        Consolidado Simple
                                                    </option>
                                                    <option>
                                                        Consolidado Pólizas
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br/><br/>
                                    <div id="divEmpresasAgregadas">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!--=====================================
MODAL POLIZA CONSOLIDADA
======================================-->
<!-- Modal -->
<div id="gdarEmpresasPolConso" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!--=====================================
                INICIO FORM
                ======================================-->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title" id="divBtnPlusNit">Ingrese Pólizas del Consolidado</h3><br/>
                            <button type="button" class="btn btn-warning btn-block btnDuplicaCons" estado="0">Duplicar Poliza</button>
                        </div>
                        <!--campos formularios -->
                        <form role="form" method="post" id="divGuardaDetalle">
                            <div class="form-horizontal">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-4 mt-4">
                                            <input type="text" class="form-control is-invalid" id="ClientPoltxtNitSalida" placeholder="Ingrese Nit" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                            <input type="hidden" id="hiddenNitIdenty" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                        </div>
                                        <div class="col-8 mt-4">
                                            <input type="text" class="form-control is-invalid" id="ClientPoltxtNombreSalida" placeholder="Ingrese Empresa" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                        </div>
                                        <div class="col-12 mt-4">
                                            <input type="text" class="form-control is-invalid" id="ClientPoltxtDireccionSalida" placeholder="Ingrese Dirección" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                        </div>
                                        <div class="col-4 mt-4">
                                            <input type="text" class="form-control is-invalid" id="ClPolDua" placeholder="Ingrese Dua" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                        </div>
                                        <div class="col-4 mt-4">
                                            <input type="text" class="form-control is-invalid" id="ClPolBL" placeholder="Ingrese BL" value=""  onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                        </div>
                                        <div class="col-4 mt-4">
                                            <input type="text" class="form-control is-invalid" id="ClPolPoliza" placeholder="Ingrese Poliza" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                        </div>
                                        <div class="col-4 mt-4">
                                            <input type="number" class="form-control is-invalid" id="ClPolBultos" placeholder="Ingrese Bultos" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                        </div>
                                        <div class="col-4 mt-4">
                                            <input type="text" class="form-control is-invalid" id="ClPolProducto" placeholder="Ingrese Producto" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                        </div>
                                        <div class="col-4 mt-4">
                                            <input type="number" class="form-control is-invalid" id="ClPolPeso" placeholder="Ingrese Peso" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                        </div>
                                        <div class="col-4 mt-4">
                                            <input type="number" class="form-control is-invalid" id="ClPolTAduana" placeholder="Ingrese Total Aduana" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                        </div>
                                        <div class="col-4 mt-4">
                                            <input type="number" class="form-control is-invalid" id="ClPolCambio" placeholder="Ingrese tipo cambio" value="" onkeyup="javascript:this.value = this.value.toUpperCase();"/>
                                        </div>
                                        <div class="col-4 mt-4">
                                            <input type="number" class="form-control is-invalid" id="ClPolCif" placeholder="Ingrese Cif" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                        </div>
                                        <div class="col-4 mt-4">
                                            <input type="number" class="form-control is-invalid" id="ClPolImpuesto" placeholder="Ingrese Impuesto" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                        </div>

                                        <div class="col-4 mt-4">
                                            <button type="button" class="btn btn-primary bntGuardarPolCons">Guardar póliza <i class="fa fa-save"></i></button>

                                            <input type="hidden" id="hiddenClientPoltxtNitSalida" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                            <input type="hidden" id="hiddenClientPoltxtNombreSalida" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                            <input type="hidden" id="hiddenClientPoltxtDireccionSalida" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                            <input type="hidden" id="hiddenClPolDua" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                            <input type="hidden" id="hiddenClPolBL" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                            <input type="hidden" id="hiddenClPolPoliza" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                            <input type="hidden" id="hiddenClPolBultos" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                            <input type="hidden" id="hiddenClPolProducto" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                            <input type="hidden" id="hiddenClPolPeso" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                            <input type="hidden" id="hiddenClPolTAduana" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                            <input type="hidden" id="hiddenClPolCambio" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                            <input type="hidden" id="hiddenClPolCif" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                            <input type="hidden" id="hiddenClPolImpuesto" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                        </div>

                                    </div>
                                    <div class="modal-footer" id="divButtonPase">
                                        <button type="button" id="capturarQRPol" class="btn btn-outline-secondary btnCapturarQRPol btn-block" style="font-size:25px">Codigo de Barras&nbsp;&nbsp;&nbsp;<i class="fa fa-barcode" style="font-size:48px;"></i></button>
                                    </div>
                                    <br/><br/>
                                    <div id="divEmpresasAgregadas">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!--=====================================
MODAL POLIZA CONSOLIDADA
======================================-->
<!-- Modal -->
<div id="gdrManifiestos" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!--=====================================
                INICIO FORM
                ======================================-->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Agregar Detalles de Mercadería</h3>
                        </div>
                        <!--campos formularios -->
                        <form role="form" method="post" id="divGuardaDetalle">                            <div class="row">
                                <div class="col-12 mt-4" id="UltimochasisTeclado">
                                    <center><label id="comprobarChasis"></label></center>
                                </div>
                            </div>
                            <div class="form-horizontal mt-2">
                                <div class="card-body">
                                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                                        <a class="nav-item nav-link" id="tabIngManifiesto" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="false">Ingreso con manifiesto</a>
                                        <a class="nav-item nav-link" id="tabVehiculosUsados" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Ingreso Vehiculos</a>
                                    </div>  

                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade" id="product-desc" role="tabpanel" aria-labelledby="tabIngManifiesto">
                                            <div class="row">

                                                <input id="valueClientes" type="hidden" value="" />
                                                <input id="cantVsClientes" type="hidden" value="" />
                                                <input id="idIngManiElegido" type="hidden" value="" />



                                                <div class="col-4 form-group autocompletar">
                                                    <label>
                                                        Nombre de Empresa
                                                    </label>
                                                    <input class="form-control is-invalid" id="tipoBusqueda" name="tipoBusqueda" placeholder="Ingrese Nombre de empresa" type="text" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>
                                                            Cantidad de Bultos
                                                        </label>
                                                        <input class="form-control is-invalid" id="bultosAgregados" name="bultosAgregados" placeholder="Ingrese cantidad de bultos" type="number" />
                                                        <center><label id="bultosSobregiro" style="color:red;"></label></center>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="col-12">
                                                        <label>
                                                            Valor Peso
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control is-invalid" id="pesoAgregado" name="pesoAgregado" placeholder="Ingrese peso" type="number" />

                                                            <span class="input-group-append">
                                                                <button btnagrega="0" class="btn btn-info btn-flat btnAgregarEmpresa" type="button">Agregar Empresa</button>
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-12">
                                                    <div id="divEmpresasAgregadasMani">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="tabVehiculosUsados">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label>Ingrese el Numero de Chasis</label>
                                                    <input type="text" class="form-control is-invalid" id="numChasisVehUs" placeholder="Chasis: 5UXFA53543LW26843" value="" autocomplete="false" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>

                                                <div class="col-3">
                                                    <label>Tipo de Vehículo</label>
                                                    <input type="text" class="form-control is-invalid" id="tVehiculoUs" placeholder="Ejemplo : AUTOMOVIL" value="" autocomplete="false" onkeyup="javascript:this.value = this.value.toUpperCase();" />

                                                </div>
                                                <div class="col-3">
                                                    <label>Marca del Vehículo</label>
                                                    <input type="text" class="form-control is-invalid" id="marcaVeh" placeholder="Ejemplo : TOYOTA" value="" autocomplete="false" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>      

                                                <div class="col-6">
                                                    <label>Linea del Vehículo</label>
                                                    <input type="text" class="form-control is-invalid"  id="lineaVeh" placeholder="Ejemplo : Yaris" value=""  autocomplete="false" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                                <div class="col-6">
                                                    <label>Modelo del Vehículo</label>
                                                    <input type="number" class="form-control is-invalid"  id="modeloVeh" autocomplete="false" placeholder="Ejemplo : <?php
                                                    date_default_timezone_set('America/Guatemala');
                                                    $year = date('Y');
                                                    echo $year;
                                                    ?>" value="" />
                                                </div>
                                                <div class="col-6">
                                                    <label>Cantidad de Vehículos</label>
                                                    <input type="number" class="form-control is-valid"  id="cantidaVeh" value="1" autocomplete="false" readOnly="false" />
                                                    <center><label id="bultosSobregiro" style="color:red;"></label></center>
                                                </div>                                                
                                                <div class="col-6">
                                                    <div class="col-12">
                                                        <label>Peso de Vehículo</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control is-invalid" id="pesoVehiculoUs" autocomplete="false" placeholder="Ejemplo : 2125.12" value="" />
                                                            <span class="input-group-append">
                                                                <button type="button" class="btn btn-success btnGVehciuloUs">Agregar Chasis</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <center><label id="pesoSobregiro" style="color:red;"></label></center>
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-12 mt-4" id="divChaisVehiculosUS">

                                </div>
                                <div class="col-4">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info">
                                            <i class="fa fa-calculator">
                                            </i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Detalle de Bultos</span>
                                            <h4 id="saldoIngNblts"></h4>

                                            <h4 id="saldoNuevoblts"></h4>
                                            <h4 id="bltsRetirados"></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info">
                                            <i class="fa fa-calculator">
                                            </i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">
                                                Detalle de Peso
                                            </span>
                                            <h4 id="saldoIngNPeso"></h4>
                                            <h4 id="pesoNuevoblts"></h4>
                                            <h4 id="pesoRetirados"></h4>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success">
                                            <i class="fa fa-calculator">
                                            </i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">
                                                Clientes Agregados
                                            </span>
                                            <h3 id="contadorClientes"></h3>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                            </div>  
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-block" id="btnGuardarDetallesIng" disabled="false">Guardar Detalles</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="vistas/js/autocompletar.js"></script>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Seleccione el Consolidador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-12">
                        <div class="form-group">
                            <label>Regimen</label>
                            <select class="form-control" id="busquedaConsolidado" name="busquedaConsolidado">
                                <option selected="selected" disabled="disabled">Seleccione Régimen</option>
                                <?php
                                $respuesta = ControladorOpB::ctrBuscarEmpresaConsolidada();
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCerrarCons" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="plusPilotos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <input class="form-control is-invalid" type="number" id="numeroMarchamoPlusUn" name="numeroMarchamo" placeholder="Escriba el numero de marchamo" onkeyup="javascript:this.value = this.value.toUpperCase();">
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
<!-- The Modal -->
<div class="modal fade" id="modalEjecutivo">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ejecutivo Asignado</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center" id="fotoPerfil">
                        </div>
                        <h3 class="profile-username text-center" id="nombreEjecutivo"></h3>
                        <p class="text-muted text-center" id="funcion"></p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Correo</b> <b class="float-right" id="email"></b>
                            </li>
                            <li class="list-group-item">
                                <b>Telefono</b> <b class="float-right" id="cel"></b>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>

<div id="verChasisNoEncon" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Detalle de Todos los Servicios Prestados</h3>
                        </div>
                        <form role="form" method="post">
                            <div class="form-horizontal">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-xs-12"  id="divChaisesNoEncontrados">

                                        </div>
                                        <div class="col-lg-6 col-xs-12 mt-5">
                                            <div class="col-12">
                                                <div class="alert alert-primary">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <strong>Información</strong> <br/>Los botones rojos significan que el tipo de vehículo y linea no existe en la base de datos.<br/>Los botones amarillos significan que existen vehículos con tipo y linea similares en predios
                                                </div>
                                                <div class="col-12 mt-4">

                                                    <div class="form-group">
                                                        <label>Buscar linea</label>
                                                        <select class="form-control is-invalid select2" style="width: 100%;" id="selectVehiculos" name="selectVehiculos" required>
                                                            <option selected="selected" disabled="disabled">Seleccione regimen</option>
                                                            <?php
                                                            $respuesta = ControladorOpB::ctrMostrarTiposLines();
                                                            ?>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-12 mt-4" id="divCompararChasis">
                                                </div>
                                                <div class="col-12 mt-4" id="divButtonsCompara">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer mt-4">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-outline-success btn-block btnGuardarNuevasLineas" data-dismiss="modal">Guardar lineas</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- The Modal CAPTURA UBICACIONES -->

<div class="modal fade" id="verManifiestosSat">
    <div class="modal-dialog modal-lgMapa">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Manifiestos SAT</h4>
                <button type="button" class="close" id="buttonMin1" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <iframe id="myFrameManifiesto" src="https://portal.sat.gob.gt/portal/documentos-manifiesto#form1" title="W3Schools HTML Tutorial" height="750px" width="99%"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- The Modal CAPTURA UBICACIONES -->
<div class="modal fade" id="verPrediosBodegas">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Clasificación de bodega</h4>
                <button type="button" class="close" id="buttonMin1" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-map-pin"></i></span>

                            <div class="info-box-content">
                                <input type="hidden" id ="numBodIdent" value="<?php echo $_SESSION["idDeBodega"]; ?>">
                                <span class="info-box-text"><?php echo $_SESSION["Navega"] . '&nbsp;&nbsp;&nbsp;&nbsp'; ?></span>
                                <span class="info-box-number" id="idBodegEmpresa"><?php echo '<i id="etiquetaBod">' . $_SESSION["NavegaBod"] . '</i>&nbsp;&nbsp;&nbsp;&nbsp;<i id="etiquetaNumBod">' . $_SESSION["NavegaNumB"] . '</i>'; ?></span>
                                <span class="info-box-number"><button type="button" class="btn btn-success btn-block btnIngresoSinTarifa">Guardar Ingreso</button></span>

                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <table id="tablasGeneral" role="grid" class="table dt-responsive table-hover table-sm">
                            <thead>
                                <tr>
                                <th style="width:3px">#</th>
                                <th>Area</th>
                                <th>Empresa</th>
                                <th><center>Acciones</center></th>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php
                                $respuesta = ControladorOpB::ctrVerBodegasDisponibles();

                                if ($respuesta !== null) {
                                    
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
