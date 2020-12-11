// Para que WP detecte que estamos usando jQuery
(function($){

    $('#categorias-productos').change(function() {

        $.ajax({
            url: pg.ajaxurl,
            method: 'POST',
            data: {
                'action': 'pgFiltroProductos',
                'categoria': $(this).find(':selected').val()
            },
            beforeSend: function() {
                $('#resultado-productos').html('Cargando...')
            },
            success: function(data) {
                let html = '';
                data.forEach(item => {
                    html += `
                        <div class="col-4 my-3">
                            <figure>${item.imagen}</figure>
                            <h4 class="text-center my-2">
                                <a href="${item.link}">${item.titulo}</a>
                            </h4>
                        </div>    
                    `
                })
                $("#resultado-productos").html(html);
            },
            error: function(error) {
                console.log(error)
            }
        })

    })



    // document.addEventListener('DOMContentLoaded', function() {
    //     var elems = document.querySelectorAll('.parallax');
    //     var instances = M.Parallax.init(elems);
    //   });


    $(document).ready(function(){
        $('select').formSelect();
      });

})(jQuery);



