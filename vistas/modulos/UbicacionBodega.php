<style>
    .wrapper-iframe {
        position: relative;
        overflow: hidden;
        float: left;


    }

    iframe {

        position: absolute;
        background: #f5f5f5;
        border: none;
    }

    .table td,
    .table th {
        padding: 0.2em .5em;
    }

    th {
        font-weight: normal;
    }

</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubicaciones Bodegas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Ubicaciones Bodega</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-sm-12"><div class="input-group">
                            <input type="text" id="textParamBusq" placeholder="Busque por: Póliza o Nit del consolidador" class="form-control buscando">
                            <span class="input-group-append"><button type="button" class="btn btn-success btnSearch"><i class="fa fa-search"></i></button></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="alert alert-primary" role="alert" style="text-align: justify;">
                            Puede buscar ubicaciones en bodega por <strong>Número de NIT del cliente , Número de Póliza, BL, Carta Porte o Factura Comercial o bien por el nombre del consignatario de retiro.</strong>
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-dark btnMostrarVehUsados">Mostrar Vehiculos Usados&nbsp;&nbsp;<i class="fa fa-map-signs"></i></button>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-primary btnLimpiarPan">Limpiar pagina&nbsp;&nbsp;<i class="fa fa-trash"></i></button>
                    </div>
                    <div id="mapEntradaUbic" class="col-1 mt-4 pull-left">
                        <center>Entrada De :&nbsp;&nbsp;&nbsp;&nbsp;Bodega&nbsp;&nbsp;1</center>
                    </div>
                    <div id="mapeandoUbica" class="col-10 mt-4 pull-left wrapper-iframe">
                        <?php
                        $respuesta = ControladorUbicacionBodega::ctrDibujarMapaDetalles();
                        ?>
                    </div>
                    <div id="mapEntradaUbic" class="col-1 mt-4 pull-right">
                        <center>Fondo De :&nbsp;&nbsp;&nbsp;&nbsp;Bodega&nbsp;&nbsp;1</center>
                    </div>
                    <div id="detalleSeleccionado" class="col-12 mt-4">

                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="tip" id="tip2">
        <div class="info-box-content">
            <b id="numIng"></b><br/>
            <b id="numPoliza"></b><br/>
            <b id="Nomempresa"></b><br/>
            <b id="cantBultos"></b><br/>
            <b id="CantpesoKg"></b><br/>
            <b id="descripcion"></b><br/>
            <b id="posiciones"></b><br/>
            <b id="metros"></b><br/>

        </div>
    </div>
</div>


<!-- Modal -->
<div id="modalVehUsados" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-5" id="divTablePosVehUS">
                        
                    </div>
                    <div class="col-7" id="divRecibidoVehUs">
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
