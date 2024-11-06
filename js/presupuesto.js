$(document).ready(function() {
  load(1);

  // Funcion para hacer carga
  function load(page) {
    var q = $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
      url: './ajax/presupuestos.php?action=ajax&page=' + page + '&q=' + q,
      beforeSend: function() {
        $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
      },
      success: function(data) {
        $(".outer_div").html(data).fadeIn('slow');
        $('#loader').html('');
      }
    });
  }

  // Funcion para nukear
  function eliminar(id) {
    var q = $("#q").val();
    if (confirm("Realmente deseas eliminar el presupuesto?")) {
      $.ajax({
        type: "GET",
        url: "./ajax/presupuestos.php",
        data: { id: id, q: q },
        beforeSend: function() {
          $("#resultados").html("Mensaje: Cargando...");
        },
        success: function(datos) {
          $("#resultados").html(datos);
          load(1);
        }
      });
    }
  }

  // Ojo al piojo: unciones de submit para agregar y actualizar presupuestos
  $('#add, #upd').submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    var url = $(this).attr('id') === 'add' ? 'action/addpresupuesto.php' : 'action/updpresupuesto.php';
    var resultDiv = $(this).attr('id') === 'add' ? '#result' : '#result2';
    $.ajax({
      type: 'POST',
      url: url,
      data: formData,
      beforeSend: function() {
        $('#loader').html('Cargando...');
      },
      success: function(data) {
        $(resultDiv).html(data);
        load(1);
      }
    });
  });

  // Función obtener_datos
  function obtener_datos(id) {
    var descripcion = $("#descripcion" + id).val();
    var nombre = $("#nombre" + id).val();
    var precio = $("#precio" + id).val();
    var creado_at = $("#creado_at" + id).val();
    $("#mod_id").val(id);
    $("#mod_nombre").val(nombre);
    $("#mod_descripcion").val(descripcion);
    $("#mod_precio").val(precio);
    $("#mod_creado_at").val(creado_at);
  }
});