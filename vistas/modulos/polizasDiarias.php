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
        width: 23px;
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
                        <div class="col-6 mt-4">
                                    <button type="button" class="btn btn-outline-danger btn-block btn-flat btn-sm btnGenerarPolizaContable">Generar Poliza</button>
                        </div>
                
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
                                                    <table class="table">
                                                        <!-- Heading -->
                                                        <thead>

                                                            <?php
                                                            $respuesta = ControladorGenerarContabilidad::ctrMostrarReportes();
                                                            ?>
                                                            </tbody>

                                                    </table>
                                                </div>
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
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <!-- Modal content-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" id="divReporteIngresosView">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>