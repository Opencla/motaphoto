(function ($) {
    $(document).ready(function () {
        const button = document.getElementById("load");
        let reload = false; // permettra de savoir si on doit vider gallery-container ou non
        let page = 1;
        let order = 'DESC';
        let category = 'all';

        loadPosts();

        button.addEventListener("click", function(){
            reload = false;
            loadPosts();
        });

        const dateFilter = document.getElementById("order-by-date");
        dateFilter.addEventListener('change', function(event){
            order = dateFilter.value;
            reload = true;
            loadPosts();
        })
        const categoriesFilter = document.getElementById("order-by-categories");
        categoriesFilter.addEventListener('change', function(event){
            category = categoriesFilter.value;
            reload = true;
            loadPosts();
        })
        const formatsFilter = document.getElementById("order-by-formats");
        formatsFilter.addEventListener('change', function(event){
            order = formatsFilter.value;
            reload = true;
            loadPosts();
        })

        function loadPosts () {
            fetch('/motaphoto/wordpress/wp-admin/admin-ajax.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Cache-Control': 'no-cache',
                },
                body:new URLSearchParams({
                    action: 'motaphoto_load_post',
                    page: page,
                    order: order,
                    category: category
                })
                
            })
            .then(response => response.json())
            .then(response => {
                const gallery = document.getElementById('gallery-container');
                if (reload) {
                    page = 1
                    gallery.innerHTML  = response.data;
                } else {
                    page = page + 1;
                    gallery.insertAdjacentHTML('beforeend', response.data);
                }
                
            });
        }
    });
  })(jQuery);