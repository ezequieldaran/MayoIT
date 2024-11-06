<?php
    $presupuestos = mysqli_query($con, "select * from presupuestos");
    $tickets = mysqli_query($con, "select * from ticket");
    $projects = mysqli_query($con, "select * from project");
    $priorities = mysqli_query($con, "select * from priority");
    $statuses = mysqli_query($con, "select * from status");
    $kinds = mysqli_query($con, "select * from kind");
    $categories = mysqli_query($con, "select * from category");
    $users = mysqli_query($con, "select * from user");
?>

<div> <!-- Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Presupuesto </button>
</div>

<div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Agregar presupuesto</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add">
                    <div id="result"></div>
          
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" name="nombre" class="form-control" placeholder="Nombre" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea name="descripcion" class="form-control col-md-7 col-xs-12"  placeholder="Descripción"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Precio <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea name="precio" class="form-control col-md-7 col-xs-12"  placeholder="Precio"></textarea>
                        </div>
                    </div>
    

   
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ticket
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" name="ticket_id" > 
                                <option selected="" value="">-- Selecciona --</option>
                              <?php foreach($tickets as $p):?>
                                <option value="<?php echo $p['id']; ?>"><?php echo $p['id']  . ' - ' . $p['description']; ?></option>
                              <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                        
                         
                        
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button id="save_data" type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div> <!-- /Modal   -->
<!--
<script>
    $(document).ready(function() {
        $('#add').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'save_presupuesto.php',
                data: formData,
                success: function(data) {
                    $('#result').html(data);
                    $('#add')[0].reset();
                    $('#myModal').modal('hide');
                }
            });
        });
    });
</script>

-->