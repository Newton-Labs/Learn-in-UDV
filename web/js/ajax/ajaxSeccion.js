function ajaxSeccion()
{
    $('body').on('submit', '.ajaxFormSeccion', function (e) {

        e.preventDefault();
       

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {

            
            dataOptions = data[0];
            dataIds     = data[1];
            
            // Get the raw DOM object for the select box
            select = document.getElementById('appbundle_curso_seccion');
            // Clear the old options
            select.options.length = 0;   
            showCreated = "";
            // Load the new options
            // Or whatever source information you're working with
            for (var index = 0; index < dataOptions.length; index++) {
                option = dataOptions[index];
                opt1 = document.createElement("option");
                opt1.text = option['key'];
                opt1.value = dataIds[index]['value'];
                showCreated = option['key'];
                
                select.options.add(opt1);
                if (index == dataOptions.length-1){
                   $(select).val(dataIds[index]['value']).trigger("change"); 
                }
            }
           
            $("#appbundle_curso_seccion_nombreSeccion").val('');
            

            $('#modalSeccion').modal('hide');
            
           

            $(document).trigger("add-alerts", {
              message: "Se ha guardado correctamente: "+showCreated,
              priority: "success"
            });

         }
        })
        .done(function (data) {
            if (typeof data.message !== 'undefined') {
                alert(data.message);
            }

            
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if (typeof jqXHR.responseJSON !== 'undefined') {
                if (jqXHR.responseJSON.hasOwnProperty('form')) {
                    $('#form_body').html(jqXHR.responseJSON.form);
                }

                $('.form_error').html(jqXHR.responseJSON.message);

            } else {

            }
            $('#modalCodigo').modal('hide');
           
            
             $(document).trigger("add-alerts", {
              message: (jqXHR.responseJSON.error),
              priority: "error"
            });

        });
    });
}