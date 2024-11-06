<?php
    $presupuestos = mysqli_query($con, "SELECT * FROM presupuestos");
    $tickets = mysqli_query($con, "SELECT * FROM ticket");
    $projects = mysqli_query($con, "SELECT * FROM project");
    $priorities = mysqli_query($con, "SELECT * FROM priority");
    $statuses = mysqli_query($con, "SELECT * FROM status");
    $kinds = mysqli_query($con, "SELECT * FROM kind");
    $categories = mysqli_query($con, "SELECT * FROM category");
    $users = mysqli_query($con, "SELECT * FROM user");
?>
    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Editar Ticket</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd" name="upd">
                        <div id="result2"></div>

                        <input type="hidden" name="mod_id" id="mod_id">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre" id="mod_nombre" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <textarea name="descripcion" id="mod_descripcion" class="form-control col-md-7 col-xs-12" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Precio <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" name="precio" class="form-control" placeholder="Precio" id="mod_precio" required>
                            </div>
                        </div>

                        
                        
                        
              

                        <!-- Agregué los siguientes campos -->

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ticket
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="presupuesto_id" id="mod_presupuesto_id">
                                    <option selected="" value="">-- Selecciona --</option>
                                    <?php foreach($tickets as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['id'] . ' - ' . $p['title'] ; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <button id="upd_data" type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->