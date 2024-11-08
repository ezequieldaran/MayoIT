<?php
$title = "Presupuestos | ";
include "head.php";
include "sidebar.php";
?>

<div class="right_col" role="main"><!-- page content -->
    <div class="">
        <div class="page-title">
            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php
                include("modal/new_presupuesto.php");
                include("modal/upd_presupuesto.php");
                ?>
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Presupuestos</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    
                    <!-- form seach -->
                    <form class="form-horizontal" role="form" id="tickets">
                        <div class="form-group row">
                            <label for="q" class="col-md-2 control-label">Nombre/Asunto</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="q" placeholder="Nombre del ticket" onkeyup='load(1);'>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-default" onclick='load(1);'>
                                    <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                <span id="loader"></span>
                            </div>
                        </div>
                    </form>     
                    <!-- end form seach -->


                    <div class="x_content">
                        <div class="table-responsive">
                            <!-- ajax -->
                            <div id="resultados"></div><!-- Carga los datos ajax -->
                            <div class='outer_div'></div><!-- Carga los datos ajax -->
                            <!-- /ajax -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->

<?php include "footer.php" ?>

<script type="text/javascript" src="js/presupuesto.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script>

$("#add").submit(function(event) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/addpresupuesto.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})


$( "#upd" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/updpresupuesto.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result2").html("Mensaje: Cargando ...");
              },
            success: function(datos){
            $("#result2").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

    function obtener_datos(id){
        var descripcion = $("#descripcion"+id).val();
        var nombre = $("#nombre"+id).val();
        var precio = $("#precio"+id).val();
        var creado_at = $("#creado_at"+id).val();
            $("#mod_id").val(id);
            $("#mod_nombre").val(nombre);
            $("#mod_descripcion").val(descripcion);
            $("#mod_precio").val(precio);
            $("#mod_creado_at").val(creado_at);
           
        }

</script>