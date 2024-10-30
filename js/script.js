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
    
  
      // Tout le code ira ici
  
    });
  })(jQuery);