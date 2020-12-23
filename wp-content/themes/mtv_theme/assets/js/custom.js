// Para que WP detecte que estamos usando jQuery
(function($){

    $('#categorias-productos').change(function() {
        // console.log('test');

        $.ajax({
            url: pg.ajaxurl,    //  archivo a donde enviaremos la información
            method: 'POST',     //  Método a utilizar
            data: {             //  Definir que data se va a enviar
                'action': 'pgFiltroProductos',  // nombre de funcion que va a procesar los datos
                'categoria': $(this).find(':selected').val()    // Seleccionar valor del select
            },
            beforeSend: function() {    //  Mostrar mientras se está generando la petición
                $('#resultado-productos').html('Cargando...');
            },
            success: function(data) {   // Que va a pasar si funcion se ejecuta correctamente. Parametro data es lo que devuelve funcion php
                // console.log(data);
                let html = '';
                data.forEach(item => {
                    html += `
                        <div class="col s12 m3 center-align">
                            <imagen class="responsive-img">${item.imagen}</imagen>
                            <h5 class="">
                                <a href="${item.link}" class="black-text">${item.titulo}</a>
                            </h5>
                        </div>    
                    `
                })
                $("#resultado-productos").html(html);
            },
            error: function(error) {    //  Error que se mostrará si es que ocurre un error
                console.log(error);
            }
        })

    })

    $(document).ready(function(){
        $('.sidenav').sidenav();
    });

    
    $(document).ready(function() {

        // Select products
        $('select').formSelect();

        $.ajax({
            url: pg.apiurl+'novedades/3',
            method: 'GET',
            beforeSend: function() {
                $('#resultado-novedades').html('Cargando...');
            },
            success: function(data) {

                let html = '';
                data.forEach(item => {
                    html += `
                        <a href="${item.link}" class="black-text">
                            <div class="col s12 m4">
                                <div>
                                    <img>${item.imagen}</img>
                                </div>
                                <h5>
                                    <p>${item.titulo}</p>
                                </h5>
                            </div>    
                        </a>
                    `
                })
                $("#resultado-novedades").html(html);
            },
            error: function(error) {    //  Error que se mostrará si es que ocurre un error
                console.log(error);
            }
        })

    })



    $(document).ready(function(){
        $('.ir-arriba').click(function(){
            $('body, html').animate({
                scrollTop: '0px'
            }, 300);
        });
    
        $(window).scroll(function () {
            if ($(this).scrollTop() > 0) {
                $('.ir-arriba').slideDown(300);
            } else {
                $('.ir-arriba').slideUp(300);
            }
        });
    
    });

})(jQuery);




// Parallax

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.parallax');
    var instances = M.Parallax.init(elems);
});



