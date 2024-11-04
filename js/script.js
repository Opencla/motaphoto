(function ($) {
    $(document).ready(function () {
        const button=document.getElementById("load");
        button.addEventListener("click",function(){

            fetch('/motaphoto/wordpress/wp-admin/admin-ajax.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Cache-Control': 'no-cache',
                },
                body:new URLSearchParams({
                    action: 'motaphoto_load_post',
                    contenu: 'message test',
                                   })
                
            })
            .then(response => response.json())
            .then(response => {
                console.log(response)
            });

        });
        
        jQuery(document).ready(function($) {
            let page = 1;
        
            $('#load-more').on('click', function() {
                page++;
                $.ajax({
                    url: ajax_params.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'load_more_photos',
                        page: page,
                    },
                    success: function(response) {
                        if (response === 'no_more_posts') {
                            $('#load-more').hide();  // Cache le bouton s'il n'y a plus de photos
                        } else {
                            $('#gallery').append(response);  // Ajoute les nouvelles images
                        }
                    },
                    error: function(error) {
                        console.log('Erreur de chargement des photos : ', error);
                    }
                });
            });
        });
        
       
  
      // Tout le code ira ici
      
  
    });
  })(jQuery);