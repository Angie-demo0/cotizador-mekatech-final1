$(document).ready(function() {
    //Agregar concepto
    $('#do_add_concept').on('submit', function(e) {
        e.preventDefault();
        var concepto,
            precio,
            cantidad;

        concepto = $('#concepto').val();
        precio = $('#precio').val();
        cantidad = $('#cantidad').val();
        action = 'add_concepto';

        $
            .ajax({
                url: 'app/ajax.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    concepto,
                    precio,
                    cantidad,
                    action
                },
                beforeSend: function() {}
            })
            .done(function(res) {
                if (res.status === 200) {
                    $('#do_add_concept').trigger('reset');
                    alert(res.msg);
                    load_conceptos();
                } else {
                    alert(res.msg);
                }
            })
            .always(function() {})
            .fail(function(err) {
                alert('Entrando a fail...')
            });
    });

    //Cargar conceptos
    function load_conceptos() {
        var wrapper = $('#wrapper-cotizacion');
        action = 'get_conceptos';
        $
            .ajax({
                url: 'app/ajax.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    action
                },
                beforeSend: function() {}
            })
            .done(function(res) {
                if (res.status === 200) {
                    wrapper.html(res.data);
                } else {
                    alert(res.msg);
                }
            })
            .always(function() {})
            .fail(function(err) {
                alert('Error al cargar los conceptos');
            });
    }

    load_conceptos();

    //Borrar concepto
    $('body').on('click', '.do_delete_concepto', function(e) {

        if (!confirm('¿Estás seguro?'))
            return false;

        var id = $(this).data('id'),
            action = 'delete_concepto';

        $
            .ajax({
                url: 'app/ajax.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id,
                    action
                },
                beforeSend: function() {}
            })
            .done(function(res) {
                if (res.status === 200) {
                    alert(res.msg);
                    load_conceptos();
                } else {
                    alert(res.msg);
                }
            })
            .always(function() {})
            .fail(function(err) {
                alert('Entrando a fail...')
            });
    });

    //Editar concepto
    $('body').on('click', '.do_get_concepto', function(e) {

        var id = $(this).data('id');
        action = 'get_concepto';
        wrapper = $('#wrapper-form');

        $.ajax({
                url: 'app/ajax.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id,
                    action
                },

                beforeSend: function() {

                }
            })
            .done(function(res) {
                if (res.status === 200) {
                    wrapper.html(res.data);
                } else {
                    alert(res.msg);
                }
            })

        .always(function() {

            })
            .fail(function(err) {
                alert('Entrando a fail...');
            });
    });


    $('body').on('click', '#cancel-update', function(e) {
        e.preventDefault();
        $('#wrapper-update-concepto-form').fadeOut(function() {
            $(this).remove();
        });
    });

    //Guardar cambios del concepto -edicion
    
    $('body').on('submit', '#do_update_concepto', function(e) {
        e.preventDefault();
        var id = $('#update_id').val(),
        concepto = $('#update_concepto').val(),
        precio = $('#update_precio').val(),
        cantidad = $('#update_cantidad').val(),
        action = 'update_concepto';

        $.ajax({
                url: 'app/ajax.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id,
                    concepto,
                    precio,
                    cantidad,
                    action
                },
                beforeSend: function() {}
            })
            .done(function(res) {
                if (res.status === 200) {
                    $('#wrapper-update-concepto-form').fadeOut(function(){
                        $(this).remove();
                    });
                    alert(res.msg);
                    load_conceptos();
                } else {
                    alert(res.msg);
                }
            })
            .always(function() {

            })
            .fail(function(err) {
                
            });
    });  

});