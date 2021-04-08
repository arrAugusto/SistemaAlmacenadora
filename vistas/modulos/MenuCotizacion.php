<nav class="mt-2" id="navBarLateral">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Primer Elaboracion y creacion de cotizaciones -->

        <?php
        if ($_SESSION["departamentos"] == "Ventas" || $_SESSION["departamentos"] == "Gerencia") {
            $style = 'colorBarSuperTitle';
            echo '
            <li class="nav-item">
                <a href="gestorDeTarifas" class="nav-link">
                <i class="fa fa-history colorBarSuper"></i>
                <p class="colorBarSuper">Historial Tarifa</p>
                </a>
            </li>  
            
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                <i class="fa fa-circle colorBarSuperVill"></i>
                <p class="colorBarSuper">Operaciones Fiscales
                <i class="fa fa-angle-left right colorBarSuper"></i></p>
            </a>

            <ul class="nav nav-treeview">
        <li class="text-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________</li>
<li class="nav-item has-treeview">
            <a href="historiaIngresosFisacales" class="nav-link">
                <i class="fa fa-history colorBarSuper"></i>
                <p class="colorBarSuper">
                   Historial de ingresos
                </p>

            </a>
        </li>
                <li class="nav-item has-treeview">
            <a href="historialChasisVehUsados" class="nav-link">
                 <i class="fa fa-truck colorBarSuper"></i>
                <p class="colorBarSuper">
                    Chasis Veh. Usados &nbsp;&nbsp;
                </p>

            </a>
        </li>
                                <li class="nav-item has-treeview">
            <a href="chasisVehiculosNuevos" class="nav-link">
                <i class="fa fa-truck colorBarSuper"></i>
                <p class="colorBarSuper">
                    Chasis Veh. Nuevos &nbsp;&nbsp;
                </p>
            </a>
        </li>



<li class="nav-item has-treeview">
            <a href="culminarIngresosBodega" class="nav-link">';

            $respuesta = ControladorOpB::ctrMostrarIngPendientes();
            echo '
                <i class="fa fa-warning"';
            if ($respuesta[0]["cantIng"] < 6) {
                echo 'style="color:#1e88e5">';
                echo '  </i>
                <p class="colorBarSuper">
                   Descargas Pendientes';
                if ($respuesta[0]["cantIng"] == 0) {
                    
                } elseif ($respuesta[0]["cantIng"] > 1 || $respuesta[0]["cantIng"] < 5) {
                    echo ' <span class="badge badge-primary right">';
                    echo $respuesta[0]["cantIng"];
                }
            } else {
                echo 'style="color:#ef6c00">';

                echo '  </i>
                <p class="colorBarSuper">
                    Culminar Ingresos
                <span class="badge badge-danger right">';
                echo $respuesta[0]["cantIng"];
            }
            echo '
            </span>
            </p>
            </a>
        </li> 
        <li class="text-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________</li>
        <li class="nav-item has-treeview">
            <a href="calculosDeAlmacenaje" class="nav-link">
                <i class="fa fa-calculator colorBarSuper"></i>
                <p class="colorBarSuper">
                    Calculo de Almacenaje ZA
                </p>
            </a>
        </li>
                        <li class="nav-item has-treeview">
            <a href="calcAlmacenajeF" class="nav-link">
                <i class="fa fa-calculator colorBarSuper"></i>
                <p class="colorBarSuper">
                    Calculos de especiales AF
                </p>
            </a>
        </li>
        <li class="text-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________</li>
             <li class="nav-item has-treeview">
            <a href="retiroBod" class="nav-link">
                <i class="fa fa-dolly colorBarSuper"></i>
                <p class="colorBarSuper">
                    Cargas en Bodega
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="paseDeSalida" class="nav-link">
                <i class="fa fa-send colorBarSuper"></i>
                <p class="colorBarSuper">
                    Pases de Salida
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="paseSalidaVehNuevo" class="nav-link">
                <i class="fa fa-truck colorBarSuper"></i>
                <p class="colorBarSuper">
                    Pases Veh. Nuevos
                    
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="chasisVehiculosNuevos" class="nav-link">
                <i class="fa fa-truck colorBarSuper"></i>
                <p class="colorBarSuper">
                    Chasis Veh. Nuevos
                    
                </p>
            </a>
        </li>        
        <li class="text-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________</li>
  
        <li class="nav-item has-treeview">
            <a href="UbicacionBodega" class="nav-link">
                <i class="fa fa-crosshairs colorBarSuper"></i>
                <p class="colorBarSuper">
                    Ubicaciones
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="inventariosFiscales" class="nav-link">
                <i class="fa fa-clipboard colorBarSuper"></i>
                <p class="colorBarSuper">
                    Inventarios Fiscal
                </p>

            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="cuadreKardex" class="nav-link">
                <i class="fa fa-wrench colorBarSuper"></i>
                <p class="colorBarSuper">
                    Cuadre Kardex
                </p>
            </a>
        </li>
        </ul>            
        </li>

        

';

            if ($_SESSION["departamentos"] == "Ventas") {
                echo '        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fa fa-user colorBarSuper"></i>
                <p class="colorBarSuper">
                    Clientes
                    <i class="fa fa-angle-left right colorBarSuper"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="crearClientes" class="nav-link">
                        <i class="fa fa-gear colorBarSuper"></i>
                        <p class="colorBarSuper">Crear Clientes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="gestorClientes" class="nav-link">
                        <i class="fa fa-unlock colorBarSuper"></i>
                        <p class="colorBarSuper">Autorizar Cliente</p>
                    </a>
                </li>
            </ul>
            
        </li>';
            }
        }

        if ($_SESSION["niveles"] == "ALTO" && $_SESSION["departamentos"] == "Operaciones Generales") {
            if ($_SESSION["niveles"] == "ALTO") {
                $style = 'colorBarSuperTitle';
            } else {

                $style = 'colorBarSuper';
            }
            echo '
                
                <li class="nav-item has-treeview">
                    <a class="nav-link">
                <i class="fa fa-circle colorBarSuperVill"></i>
                <p class="colorBarSuper">
                    Parametrizar Cotizaciones
                </p>
                <i class="fa fa-angle-left right colorBarSuper"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="parametrizarAlmacenaje" class="nav-link">
                        <i class="fa fa-building colorBarSuper"></i>
                        <p class="colorBarSuper">Parametrizar Almacenajes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="activarOtrosServicios" class="nav-link">
                        <i class="fa fa-folder-open colorBarSuper"></i>
                        <p class="colorBarSuper">Otros Servicios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="detallesTarifa" class="nav-link">
                        <i class="fa fa-check-square colorBarSuper"></i>
                        <p class="colorBarSuper">Detalle Tarifa</p>
                    </a>
                </li>
                            <li class="nav-item">
            <a href="gestorDeTarifas" class="nav-link">
                <i class="fa fa-history colorBarSuper"></i>
                <p class="colorBarSuper">Gestor de tarifas</p>
            </a>
            </li>   
            </ul>

</li>       
                <li class="nav-item has-treeview">
                    <a class="nav-link">
                <i class="fa fa-circle colorBarSuperVill"></i>
                <p class="colorBarSuper">
                   Inventario - Ubicación F
                  
                </p>
                <i class="fa fa-angle-left right colorBarSuper"></i>
            </a>
            <ul class="nav nav-treeview">

  
        <li class="nav-item has-treeview">
            <a href="UbicacionBodega" class="nav-link">
                <i class="fa fa-crosshairs colorBarSuper"></i>
                <p class="colorBarSuper">
                    Ubicaciones
                </p>
            </a>
        </li>
                <li class="nav-item has-treeview">
            <a href="inventariosFiscales" class="nav-link">
                <i class="fa fa-clipboard colorBarSuper"></i>
                <p class="colorBarSuper">
                    Inventarios Fiscal
                </p>

            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="cuadreKardex" class="nav-link">
                <i class="fa fa-wrench colorBarSuper"></i>
                <p class="colorBarSuper">
                    Cuadre Kardex
                </p>
            </a>
        </li>        
        </ul>            
        </li>

            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                <i class="fa fa-circle colorBarSuperVill"></i>
                <p class="colorBarSuper">Operaciones Fiscales
                <i class="fa fa-angle-left right colorBarSuper"></i></p>
            </a>

            <ul class="nav nav-treeview">
        <li class="text-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________</li>
<li class="nav-item has-treeview">
            <a href="historiaIngresosFisacales" class="nav-link">
                <i class="fa fa-history colorBarSuper"></i>
                <p class="colorBarSuper">
                   Historial de ingresos
                </p>

            </a>
        </li>
                <li class="nav-item has-treeview">
            <a href="historialChasisVehUsados" class="nav-link">
                 <i class="fa fa-truck colorBarSuper"></i>
                <p class="colorBarSuper">
                    Chasis Veh. Usados &nbsp;&nbsp;
                </p>

            </a>
        </li>
                                <li class="nav-item has-treeview">
            <a href="chasisVehiculosNuevos" class="nav-link">
                <i class="fa fa-truck colorBarSuper"></i>
                <p class="colorBarSuper">
                    Chasis Veh. Nuevos &nbsp;&nbsp;
                </p>
            </a>
        </li>

<li class="nav-item has-treeview">
            <a href="culminarIngresosBodega" class="nav-link">';

            $respuesta = ControladorOpB::ctrMostrarIngPendientes();
            echo '
                <i class="fa fa-warning"';
            if ($respuesta[0]["cantIng"] < 6) {
                echo 'style="color:#1e88e5">';
                echo '  </i>
                <p class="colorBarSuper">
                   Descargas Pendientes';
                if ($respuesta[0]["cantIng"] == 0) {
                    
                } elseif ($respuesta[0]["cantIng"] > 1 || $respuesta[0]["cantIng"] < 5) {
                    echo ' <span class="badge badge-primary right">';
                    echo $respuesta[0]["cantIng"];
                }
            } else {
                echo 'style="color:#ef6c00">';

                echo '  </i>
                <p class="colorBarSuper">
                    Culminar Ingresos
                <span class="badge badge-danger right">';
                echo $respuesta[0]["cantIng"];
            }
            echo '
            </span>
            </p>
            </a>
        </li> 
        <li class="text-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________</li>
        <li class="nav-item has-treeview">
            <a href="calculosDeAlmacenaje" class="nav-link">
                <i class="fa fa-calculator colorBarSuper"></i>
                <p class="colorBarSuper">
                    Calculo de Almacenaje ZA
                </p>
            </a>
        </li>
                        <li class="nav-item has-treeview">
            <a href="calcAlmacenajeF" class="nav-link">
                <i class="fa fa-calculator colorBarSuper"></i>
                <p class="colorBarSuper">
                    Calculos de especiales AF
                </p>
            </a>
        </li>
        <li class="text-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________</li>
             <li class="nav-item has-treeview">
            <a href="retiroBod" class="nav-link">
                <i class="fa fa-dolly colorBarSuper"></i>
                <p class="colorBarSuper">
                    Cargas en Bodega
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="paseDeSalida" class="nav-link">
                <i class="fa fa-send colorBarSuper"></i>
                <p class="colorBarSuper">
                    Pases de Salida
                </p>
            </a>
        </li>
                        <li class="nav-item has-treeview">
            <a href="paseSalidaVehNuevo" class="nav-link">
                <i class="fa fa-truck colorBarSuper"></i>
                <p class="colorBarSuper">
                    Pases Vehículos N
                    
                </p>
            </a>
        </li>
        <li class="text-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________</li>

        


  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fa fa-circle colorBarSuperVill"></i>
                <p class="colorBarSuper">
                    Contabilidad
                </p>
                <i class="fa fa-angle-left right colorBarSuper"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">

                    <a href="ingPendientesC" class="nav-link">
                        <i class="fa fa-calendar-times-o colorBarSuper"></i>
                        <p class="colorBarSuper">
                            Ing. Pendietes
                        </p>

                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">

                    <a href="ingReportados" class="nav-link">
                        <i class="fa fa-calendar-check-o colorBarSuper"></i>
                        <p class="colorBarSuper">
                            Ing. Reportados
                        </p>

                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">

                    <a href="polizasDiarias" class="nav-link">
                        <i class="fa fa-calculator colorBarSuper"></i>
                        <p class="colorBarSuper">
                            Pólizas Diarias
                        </p>

                    </a>
                </li>
            </ul>            
        </li>
                            </ul>            
        </li>


            <li class="nav-item has-treeview">
            <a href="clientesSinTarifa" class="nav-link">
                <i class="fa fa-user-plus colorBarSuper"></i>
                <p class="colorBarSuper">
                    Clientes Sin Tarifa
                </p>
            </a>
        </li>  
                    <li class="nav-item has-treeview">
            <a href="nuevasEmpresas" class="nav-link">
                <i class="fa fa-table colorBarSuper"></i>
                <p class="colorBarSuper">
                    Nuevas Empresas
                </p>
            </a>
        </li>  
        <li class="nav-item">
            <a href="mapeoBodega" class="nav-link">
                <i class="fa fa-map-pin colorBarSuper"></i>
                <p class="colorBarSuper">
                    Menu Mapas
                </p>
            </a>
        </li>
        </ul>
        </li>


';
        }

        if ($_SESSION["niveles"] == "MEDIO" && $_SESSION["departamentos"] == "Operaciones Fiscales" || $_SESSION["niveles"] == "BAJO" && $_SESSION["departamentos"] == "Operaciones Fiscales") {
            echo '      
            <li class="nav-item">
                            <a href="gestorDeTarifas" class="nav-link">
                <i class="fa fa-history colorBarSuper"></i>
                <p class="colorBarSuper">Gestor de tarifas</p>
            </a>
        </li>    
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fa fa-circle colorBarSuperVillGren"></i>
                <p class="colorBarSuper">
                    Operaciones de Ingreso
                </p>
                <i class="fa fa-angle-left right colorBarSuper"></i>
            </a>
            <ul class="nav nav-treeview">
        <li class="nav-item">
                <a href="operacionesBIngreso" class="nav-link">
                    <i class="fa fa-mail-forward colorBarSuper"></i>
                        <p class="colorBarSuper">
                            Elaboración de ingreso
                        </p>
                </a>
                <a href="ingresosPendientes" class="nav-link">
                    <i class="fa fa-window-close colorBarSuper"></i>
                    <p class="colorBarSuper">
                        Ingresos Interrumpidos
                    </p>
                </a>
                </li>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
            <a href="culminarIngresosBodega" class="nav-link">';

            $respuesta = ControladorOpB::ctrMostrarIngPendientes();
            echo '
                <i class="fa fa-warning"';
            if ($respuesta[0]["cantIng"] < 6) {
                echo 'style="color:#1e88e5">';
                echo '  </i>
                <p class="colorBarSuper">
                    Culminar Ingresos';
                if ($respuesta[0]["cantIng"] == 0) {
                    
                } elseif ($respuesta[0]["cantIng"] > 1 || $respuesta[0]["cantIng"] < 5) {
                    echo ' <span class="badge badge-primary right">';
                    echo $respuesta[0]["cantIng"];
                }
            } else {
                echo 'style="color:#ef6c00">';

                echo '  </i>
                <p class="colorBarSuper">
                    Culminar Ingresos
                <span class="badge badge-danger right">';
                echo $respuesta[0]["cantIng"];
            }
            echo '
            </span>
            </p>
            </a>
        </li> 
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fa fa-circle colorBarSuperVillGren"></i>
                <p class="colorBarSuper">
                    Historiales
                </p>
                <i class="fa fa-angle-left right colorBarSuper"></i>
            </a>
            <ul class="nav nav-treeview">   
        <li class="nav-item has-treeview">
            <a href="historiaIngresosFisacales" class="nav-link">
                <i class="fa fa-history colorBarSuper"></i>
                <p class="colorBarSuper">
                    Historial de ingresos
                </p>

            </a>
        </li>
                <li class="nav-item has-treeview">
            <a href="historiaRetirosFisacales" class="nav-link">
                <i class="fa fa-history colorBarSuper"></i>
                <p class="colorBarSuper">
                    Historial de retiros
                </p>

            </a>
        </li>
        
                <li class="nav-item has-treeview">
            <a href="datosGeneralesPolizas" class="nav-link">
                <i class="fa fa-history colorBarSuper"></i>
                <p class="colorBarSuper">
                    Acuses - Pilotos
                </p>

            </a>
        </li>
        </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fa fa-circle colorBarSuperVillGren"></i>
                <p class="colorBarSuper">
                    Opciones de calculo
                </p>
                <i class="fa fa-angle-left right colorBarSuper"></i>
            </a>
            <ul class="nav nav-treeview">        
        <li class="nav-item has-treeview">
            <a href="calculosDeAlmacenaje" class="nav-link">
                <i class="fa fa-calculator colorBarSuper"></i>
                <p class="colorBarSuper">
                    Calculo de Almacenaje ZA
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="historialCalculos" class="nav-link">
                <i class="fa fa-history colorBarSuper"></i>
                <p class="colorBarSuper">
                    Historial de Calculos ZA
                </p>
            </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="calcAlmacenajeF" class="nav-link">
                <i class="fa fa-calculator colorBarSuper"></i>
                <p class="colorBarSuper">
                    Calculos de especiales AF
                </p>
            </a>
        </li>
     </ul>
     </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fa fa-circle colorBarSuperVillGren"></i>
                <p class="colorBarSuper">
                    Opciones de retiro
                </p>
                <i class="fa fa-angle-left right colorBarSuper"></i>
            </a>
            <ul class="nav nav-treeview">         
        <li class="nav-item has-treeview">
            <a href="retiroOpe" class="nav-link">
                <i class="fa fa-send colorBarSuper"></i>
                <p class="colorBarSuper">
                    Retiro Fiscal
                </p>
            </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="retiroBod" class="nav-link">
                <i class="fa fa-send colorBarSuper"></i>
                <p class="colorBarSuper">
                    Retiro Fiscal Bodega
                </p>
            </a>
        </li>


        <li class="nav-item has-treeview">
            <a href="paseDeSalida" class="nav-link">
                <i class="fa fa-truck colorBarSuper"></i>
                <p class="colorBarSuper">
                    Pases de salida
                </p>
            </a>
        </li>
                <li class="nav-item has-treeview">
            <a href="paseSalidaVehNuevo" class="nav-link">
                <i class="fa fa-truck colorBarSuper"></i>
                <p class="colorBarSuper">
                    Pases Vehículos N
                </p>
            </a>
        </li>
    </ul>
    </li>
    <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fa fa-circle colorBarSuperVillGren"></i>
                <p class="colorBarSuper">
                    Contabilidad
                </p>
                <i class="fa fa-angle-left right colorBarSuper"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="ingPendientesC" class="nav-link">
                        <i class="fa fa-calendar-times-o colorBarSuper"></i>
                        <p class="colorBarSuper">
                            Ing. Pendietes
                        </p>

                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">

                    <a href="ingReportados" class="nav-link">
                        <i class="fa fa-calendar-check-o colorBarSuper"></i>
                        <p class="colorBarSuper">
                               Ing. Reportados
                        </p>
                    </a>
                </li>
            </ul>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="retiroPendienteC" class="nav-link">
                        <i class="fa fa-calendar-times-o colorBarSuper"></i>
                        <p class="colorBarSuper">
                            Ret. Pendietes
                        </p>

                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="retirosContabilizados" class="nav-link">
                        <i class="fa fa-calendar-check-o colorBarSuper"></i>
                        <p class="colorBarSuper">
                            Ret. Reportados
                        </p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="historialRetChasisSinConta" class="nav-link">
                        <i class="fa fa-calendar-times-o colorBarSuper"></i>
                        <p class="colorBarSuper">
                            Veh. Pendientes &nbsp;&nbsp;<span class="right badge badge-danger">Nuevo</span>
                        </p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="historialRetChasisContable" class="nav-link">
                        <i class="fa fa-calendar-check-o colorBarSuper"></i>
                        <p class="colorBarSuper">
                            Veh. Reportados &nbsp;&nbsp;<span class="right badge badge-danger">Nuevo</span>
                        </p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="trasladosPendientesAF" class="nav-link">
                        <i class="fa fa-calendar-check-o colorBarSuper"></i>
                        <p class="colorBarSuper">
                            Traslados AF &nbsp;&nbsp;<span class="right badge badge-danger">Nuevo</span>
                        </p>
                    </a>
                </li>
            </ul>            
            ';
            if ($_SESSION["niveles"] == "MEDIO" && $_SESSION["departamentos"] == "Operaciones Fiscales") {
                echo '
              <ul class="nav nav-treeview">
                <li class="nav-item">

                    <a href="polizasDiarias" class="nav-link">
                        <i class="fa fa-calculator colorBarSuper"></i>
                        <p class="colorBarSuper">
                            Pólizas Diarias
                        </p>
                    </a>
                </li>
            </ul> 
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="sldDiarioContabilidad" class="nav-link">
                        <i class="fa fa-calculator colorBarSuper"></i>
                        <p class="colorBarSuper">
                            Diario Contabilidad
                        </p>
                    </a>
                </li>
            </ul>                         
';
            }

            echo '
        <li class="nav-item has-treeview">
            <a href="UbicacionBodega" class="nav-link">
                <i class="fa fa-crosshairs colorBarSuper"></i>
                <p class="colorBarSuper">
                    Ubicaciones
                </p>
            </a>
        </li>        
        <li class="nav-item has-treeview">
            <a href="inventariosFiscales" class="nav-link">
                <i class="fa fa-clipboard colorBarSuper"></i>
                <p class="colorBarSuper">
                    Inventarios Fiscal
                </p>

            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="cuadreKardex" class="nav-link">
                <i class="fa fa-wrench colorBarSuper"></i>
                <p class="colorBarSuper">
                    Cuadre Kardex
                </p>
            </a>
        </li>        
        <li class="text-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________</li>
        <li class="nav-item has-treeview">
            <a href="chasisVehiculosNuevos" class="nav-link">
                <i class="fa fa-truck colorBarSuper"></i>
                <p class="colorBarSuper">
                    Chasis Veh. Nuevos &nbsp;&nbsp;
                </p>
            </a>
        </li>
                        <li class="nav-item has-treeview">
            <a href="historialChasisVehUsados" class="nav-link">
                 <i class="fa fa-truck colorBarSuper"></i>
                <p class="colorBarSuper">
                    Chasis Veh. Usados &nbsp;&nbsp;
                </p>

            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="historialRetChasisVehN" class="nav-link">
                <i class="fa fa-envelope colorBarSuper"></i>
                <p class="colorBarSuper">
                    Correo Vehiculos &nbsp;&nbsp;<span class="right badge badge-danger">Nuevo</span>
                </p>
            </a>
        </li>        
        <li class="nav-item has-treeview">
            <a href="medidasVehiculos" class="nav-link">
                <i class="fa fa-car colorBarSuper"></i>
                <p class="colorBarSuper">
                    Medidas Vehiculos
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="vehiculosSinMedidas" class="nav-link">
                <i class="fa fa-sort-numeric-asc colorBarSuper"></i>
                <p class="colorBarSuper">
                    Vehículos sin medida
                </p>

            </a>
        </li>
        <li class="text-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________</li>
';
            echo '
        <li class="nav-item has-treeview">
            <a href="clientesSinTarifa" class="nav-link">
                <i class="fa fa-user-plus colorBarSuper"></i>
                <p class="colorBarSuper">
                    Clientes Sin Tarifa
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="gestorUsuarios" class="nav-link">
                <i class="fa fa-group colorBarSuper"></i>
                <p class="colorBarSuper">Colaboradores</p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="configuracion" class="nav-link">
                <i class="fa fa-wrench colorBarSuper"></i>
                <p class="colorBarSuper">
                    Confi Navegación
                </p>
            </a>
        </li>
';
        }
        if ($_SESSION["niveles"] == "MEDIO" && $_SESSION["departamentos"] == "Bodegas Fiscales" || $_SESSION["niveles"] == "BAJO" && $_SESSION["departamentos"] == "Bodegas Fiscales") {
            echo '      
        <li class="nav-item">
                <a href="gestorDeTarifas" class="nav-link">
                <i class="fa fa-history colorBarSuper"></i>
                <p class="colorBarSuper">Gestor de tarifas</p>
            </a>
        </li>    
        <li class="nav-item has-treeview">
            <a href="culminarIngresosBodega" class="nav-link">';
            $respuesta = ControladorOpB::ctrMostrarIngPendientes();
            echo '
                <i class="fa fa-warning"';
            if ($respuesta[0]["cantIng"] < 6) {
                echo 'style="color:#1e88e5">';
                echo '  </i>
                <p class="colorBarSuper">
                    Culminar Ingresos';
                if ($respuesta[0]["cantIng"] == 0) {
                    
                } elseif ($respuesta[0]["cantIng"] > 1 || $respuesta[0]["cantIng"] < 5) {
                    echo ' <span class="badge badge-primary right">';
                    echo $respuesta[0]["cantIng"];
                }
            } else {
                echo 'style="color:#ef6c00">';

                echo '  </i>
                <p class="colorBarSuper">
                    Ingresos Pendientes
                <span class="badge badge-danger right">';
                echo $respuesta[0]["cantIng"];
            }
            echo '
            </span>
            </p>
            </a>
        </li> 
        <li class="nav-item has-treeview">
            <a href="historiaIngresosFisacales" class="nav-link">
                <i class="fa fa-history colorBarSuper"></i>
                <p class="colorBarSuper">
                    Historial de ingresos
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="historialChasisVehUsados" class="nav-link">
                 <i class="fa fa-truck colorBarSuper"></i>
                <p class="colorBarSuper">
                    Chasis Veh. Usados &nbsp;&nbsp;
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="chasisVehiculosNuevos" class="nav-link">
                <i class="fa fa-truck colorBarSuper"></i>
                <p class="colorBarSuper">
                    Chasis Veh. Nuevos &nbsp;&nbsp;
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="UbicacionBodega" class="nav-link">
                <i class="fa fa-crosshairs colorBarSuper"></i>
                <p class="colorBarSuper">
                    Ubicaciones
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="inventariosFiscales" class="nav-link">
                <i class="fa fa-clipboard colorBarSuper"></i>
                <p class="colorBarSuper">
                    Inventarios Fiscal
                </p>

            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="cuadreKardex" class="nav-link">
                <i class="fa fa-wrench colorBarSuper"></i>
                <p class="colorBarSuper">
                    Cuadre Kardex
                </p>
            </a>
        </li>        
        <li class="nav-item has-treeview">
            <a href="retiroBod" class="nav-link">
                <i class="fa fa-send colorBarSuper"></i>
                <p class="colorBarSuper">
                    Retiro Fiscal Bodega
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="paseDeSalida" class="nav-link">
                <i class="fa fa-truck colorBarSuper"></i>
                <p class="colorBarSuper">
                    Pases de salida
                </p>
            </a>
        </li>
';


            echo '
        <li class="nav-item has-treeview">
            <a href="clientesSinTarifa" class="nav-link">
                <i class="fa fa-user-plus colorBarSuper"></i>
                <p class="colorBarSuper">
                    Clientes Sin Tarifa
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="gestorUsuarios" class="nav-link">
                <i class="fa fa-group colorBarSuper"></i>
                <p class="colorBarSuper">Colaboradores</p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="configuracion" class="nav-link">
                <i class="fa fa-wrench colorBarSuper"></i>
                <p class="colorBarSuper">
                    Confi Navegación
                </p>
            </a>
        </li>
';
        }
        if ($_SESSION["niveles"] == "ADMINISTRADOR") {
            echo '
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fa fa-user colorBarSuper"></i>
                <p class="colorBarSuper">
                    Usuarios Almacenadoras
                    <i class="fa fa-angle-left right colorBarSuper"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="crearUsuarios" class="nav-link">
                        <i class="fa fa-gear colorBarSuper"></i>
                        <p class="colorBarSuper">Crear Usuarios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="gestorUsuarios" class="nav-link">
                        <i class="fa fa-unlock colorBarSuper"></i>
                        <p class="colorBarSuper">Autorizar Internos</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fa fa-user colorBarSuper"></i>
                <p class="colorBarSuper">
                    Clientes
                    <i class="fa fa-angle-left right colorBarSuper"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="crearClientes" class="nav-link">
                        <i class="fa fa-gear colorBarSuper"></i>
                        <p class="colorBarSuper">Crear Clientes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="gestorClientes" class="nav-link">
                        <i class="fa fa-unlock colorBarSuper"></i>
                        <p class="colorBarSuper">Autorizar Cliente</p>
                    </a>
                </li>
            </ul>
        </li>
';
        }
        ?>


</nav>
</div>

</aside>
