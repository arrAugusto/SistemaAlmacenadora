<style>

    .pricing{
        margin:40px 0px;
    }
    .pricing .table{
        border-top:1px solid #ddd;
        background:#fff;
    }
    .pricing .table th,
    .pricing .table {
        text-align: center;
    }
    .pricing .table td {
        padding: 12px 10px;
        border:1px solid #ddd;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    #saltoTD{
        padding: 15px 10px;
        color: #EBEDF3;
        background:#fff;
    }
    .pricing .table th {
        padding: 9px 10px;
        border:1px solid #ddd;H {}
        border: 1px solid rgba(255, 255, 255, 0.1);

    }

    .pricing .table th {
        width: 25%;
        font-size: 30px;
        font-weight: 400;
        border-bottom: 0;
        background:#2F313A;
        color: #EBEDF3;
        text-transform: uppercase;
    }
    .pricing .table th.highlight{
        border-top: 4px solid #4caf50 !important;
    }
    .pricing .table tr:nth-child(odd){
        background: #f0f8ff;
    }
    .pricing .table td:first-child{
        padding-left: 20px;
        text-align: left;
        padding-top:35px;
        background: #5F97FB;
    }
    .pricing tr td .ptable-title {
        font-size: 22px;
        font-weight:400;
        color: #fff;
    }
    .pricing tr td .ptable-title i {
        width: 15px;
        line-height: 5px;
        text-align: right;
        margin-right: 5px;
    }
    .pricing .ptable-star {
        position: relative;
        display: block;
        text-align: center;
    }
    .pricing .ptable-star.red{
        color: #e91e63;
    }
    .pricing .ptable-star.green{
        color: #4caf50;
    }
    .pricing .ptable-star.lblue{
        color: #03a9f4;
    }
    .pricing .ptable-star i {
        width: 8px;
        font-size: 13px;
    }
    .pricing .ptable-price {
        display: block;
    }
    .pricing tr td {
        font-size: 16px;
        line-height:32px;
        text-transform:uppercase;
    }
    .pricing tr td.bg-red{
        background: #e91e63;
    }
    .pricing tr td.bg-green{
        background: #4caf50;
    }
    .pricing tr td.bg-lblue{
        background: #03a9f4;
    }
    .pricing tr td.bg-red a,
    .pricing tr td.bg-green a,
    .pricing tr td.bg-lblue a{
        color: #fff;
    }
    .pricing tr td i {
        display: block;
        margin-bottom: 12px;
        font-size: 30px;
    }
    .pricing tr td i.red{
        color: #e91e63;
    }
    .pricing tr td i.green{
        color: #4caf50;
    }
    .pricing tr td i.lblue{
        color: #03a9f4;
    }
    .pricing tr td:first-child i{
        display:inline;
        margin-bottom:0px;
        font-size:22px;
    }

    .swal2-content
    {
        z-index: 2!important;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CONTABILIDAD</h1>
                </div>
                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Procesos Pendientes</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <form role="form" method="post">
                <div class="card-body"> 
                    <div class="row">


                        <div class="col-12 mt-4">
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">

                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-12 invoice-col">

                                        <address>
                                            <div class="col-12 mx-auto"></div>
                                        </address>
                                    </div>
                                </div>
                                <div class="row">    
                                    <div class="col-12">
                                        <!-- Pricing # -->
                                        <div class="pricing">
                                            <div class="container">
                                                <div class="pricing-table table-responsive">
                                                    <div class="col-12">
                                                        <button type="button" class="btn btn-block btn-warning"  data-toggle="modal" data-target="#crearPolizaAjuste">Crear póliza de ajuste contable </button><br/>
                                                    </div>
                                                    <div class="col-12">
                                                        <table class="table">
                                                            <!-- Heading -->
                                                            <thead>
                                                                <tr>
                                                                <th>Empresa<br/>&nbsp;</th>
                                                                <th class="highlight">
                                                                    SALDO<br/>&nbsp;
                                                                </th>
                                                                <th>
                                                                    Acciones
                                                                    <br/>&nbsp;
                                                                </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $respuesta = ControladorSaldosContables::ctrSaldoActualContabilidad(); ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <!--
                            <div class="row">   
                            <div class="col-10 mx-auto">
                                <h4 class="text-center">ALMACENADORA INTEGRADA, S.A.<br/>PÓLIZAS DE MERCADERÍAS SEGUN REPORTES ADJUNTOS DEL DÍA</h4>
                                    <table class="table col-12">
                                        <thead class="table-primary">
                                            <tr>
                                            <th scope="col">CUENTA</th>
                                            <th scope="col">NOMBRE DE CUENTA</th>
                                            <th scope="col" style="width: 190px">DEBE</th>
                                            <th scope="col" style="width: 190px">HABER</th>
                                            </tr>
                                        </thead>


                                    </table>


                                </div>
                            </div>

                                <!-- /.row -->


                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="invoice p-3 mb-3">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="alert alert-info" role="alert">
                                            HISTORIAL DE SALDOS CIF 802103.0102
                                        </div>
                                        <div id="divSaldosCif">

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="alert alert-info" role="alert">
                                            HISTORIAL DE SALDOS IMPUESTOS 801109.01
                                        </div>
                                        <div id="divImpuesto">

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
</div>



<!-- Modal -->
<div class="modal fade" id="modalCortesContables" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-6">
                        <div class="alert alert-warning" role="alert">
                            DIAS PENDIENTES DE CERRAR CONTABILIDAD
                        </div>
                        <div id="divDiasPendContables">

                        </div>


                    </div>
                    <div class="col-6">
                        <div class="alert alert-warning" role="alert">
                            REPORTES CONTABLES
                        </div>
                        <div id="divTableReportes">

                        </div>


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalAjustes" role="dialog">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <!-- Modal content-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" id="divViewAjuste">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="crearPolizaAjuste" role="dialog">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <!-- Modal content-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <?php $respuesta = ControladorSaldosContables::ctrSaldoActualContabilidadPolConta(); ?>
                    </div>
                    <div class="col-6 mt-4">
                        <div class="btn-group btn-group-justified">
                            <button type="button" class="btn btn-primary btnajusteIngreso" id="btnajusteIngresos" estado="0">Ajuste Ingreso</button>
                            <button type="button" class="btn btn-outline-dark btnCifAjuste" id="btnCifAjustes" estado="0">Cif</button>
                            <button type="button" class="btn btn-outline-dark btnImptsAjuste" id="btnImptsAjustes" estado="0">Impuesto</button>
                        </div>
                    </div>
                    <div class="col-6 mt-4">
                        <div class="btn-group btn-group-justified">
                            <button type="button" class="btn btn-primary btnAjusteRetF" id="btnAjusteRetFs" estado="0">Ajuste Retiro</button>
                            <button type="button" class="btn btn-outline-dark btnAjusteCifRetF" id="btnAjusteRetCifFs" estado="0">Cif</button>
                            <button type="button" class="btn btn-outline-dark btnAjusteImptsRetF" id="btnAjusteRetImprsF" estado="0">Impuesto</button>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="button" class="btn btn-dark btn-block btnGenerarPolizaConta">GENERAR PÓLIZA CONTABLE</button> 
                    </div>
                    <div class="col-12 mt-4" >
                        <div class="row" id="divPolizaAjustes">   




                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
