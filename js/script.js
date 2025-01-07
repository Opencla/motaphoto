(function ($) {
    $(document).ready(function () {
        const button = document.getElementById("load");
        let reload = false; // permettra de savoir si on doit vider gallery-container ou non
        let page = 1;
        let order = 'DESC';
        let category = 'all';
        let format = 'all';
        let backgroundURLs = [];

        loadPosts();

        button.addEventListener("click", function () {
            reload = false;
            loadPosts();
        });

        const dateFilter = document.getElementById("order-by-date");
        dateFilter.addEventListener('change', function (event) {
            order = dateFilter.value;
            reload = true;
            loadPosts();
        })
        const categoriesFilter = document.getElementById("order-by-categories");
        categoriesFilter.addEventListener('change', function (event) {
            category = categoriesFilter.value;
            reload = true;
            loadPosts();
        })
        const formatsFilter = document.getElementById("order-by-formats");
        formatsFilter.addEventListener('change', function (event) {
            format = formatsFilter.value;
            reload = true;
            loadPosts();
        })

        function loadPosts() {
            if (reload) {
                page = 1;
            } else {
                page = page + 1;
            }

            fetch('/motaphoto/wordpress/wp-admin/admin-ajax.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Cache-Control': 'no-cache',
                },
                body: new URLSearchParams({
                    action: 'motaphoto_load_post',
                    page: page,
                    order: order,
                    category: category,
                    format_to_back_end: format
                })

            })
                .then(response => response.json())
                .then(response => {
                    const gallery = document.getElementById('gallery-container');
                    if (reload) {
                        page = 1
                        gallery.innerHTML = response.data;
                    } else {
                        page = page + 1;
                        gallery.insertAdjacentHTML('beforeend', response.data);
                    }

                    initListener();
                });
        }


        let lightBox = $('#motaphoto-lightbox');
        let lightBoxImageContainer = $('#motaphoto-lightbox-image');

        function initListener() {
            let trigger = $('.js-open-lightbox');

            trigger.each(function () {
                $(this).on('click', function (event) {
                    event.stopPropagation();
                    event.preventDefault();

                    let backgroundURL = $(this).closest('.photo-article').css('background-image');
                    let parentContainer = $(this).closest('.photo-link');
                    parentContainer.addClass('open');

                    backgroundURL = backgroundURL.replace('url("', '');
                    backgroundURL = backgroundURL.replace('")', '');

                    lightBoxImageContainer.attr('src', backgroundURL);
                    lightBox.removeClass('lightbox_hidden');

                    /**
                     * Trouver comment récupérer tous backgroundURL des balises ".photo-article" appartenant à gallery-container et les stocker dans un tableau
                     *      -> afficher ce tableau dans la console*/
                    
                    // Créer un tableau pour stocker les URLs des images de fond
                        backgroundURLs = [];
                        // Parcourir chaque élément .photo-article dans .gallery-container
                        $('#gallery-container .photo-article').each(function() {
                            // Récupérer la valeur du style background-image
                            let backgroundImage = $(this).css('background-image');
                            
                            // Extraire l'URL de l'image en enlevant "url(" et ")"
                            let url = backgroundImage.replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
                            
                            // Ajouter l'URL au tableau
                            if (url) {
                                backgroundURLs.push(url);
                            }
                        });                       
                });
            });
        }

        $('#photo-link').on('click', function () {
            console.log('photo-link');
    });


        // Fermer la lightbox en cliquant sur la croix
        $('#lightbox__close').on('click', function () {
            console.log('clic détécté');
            $('#motaphoto-lightbox').addClass('lightbox_hidden'); // Cache la lightbox
            $("#gallery-container .open").removeClass('open');
        });

        // Détection du clic sur le bouton suivant
        $('#lightbox__next').on('click', function () {
            // ici on veut savoir qui a la classe "open" -> trouver son indice sur la page
            let openPhotoIndex = $("#gallery-container .open").index();
            // A partir de là l'objectif c'est de récupérer l'url des photos suivantes et précédentes de notre tableau
            let nextPhotoIndex = openPhotoIndex + 1;
            // let prevPhotoIndex = openPhotoIndex - 1;
            
            // on veut récupérer l'url de la photo qui à pour index nextPhotoIndex à partir de notre tableau d'url
            let photoUrl = backgroundURLs[nextPhotoIndex];
            lightBoxImageContainer.attr('src', photoUrl); // notre image change

            $("#gallery-container .open").removeClass('open');
            let nextPhotoLink = $("#gallery-container .photo-link").eq(nextPhotoIndex); //quand on dépasse les bornes, nextPhotoIndex va valloir 8 qui n'existe pas
            // or la méthode eq n'accepte pas de valeur négative et revient à 0 (première photo)
            nextPhotoLink.addClass('open');
        });

        // Détection du clic sur le bouton précédent
        $('#lightbox__prev').on('click', function () {
            console.log('précédente');
            // ici on veut savoir qui a la classe "open" -> trouver son indice sur la page
            let openPhotoIndex = $("#gallery-container .open").index();
            // A partir de là l'objectif c'est de récupérer l'url des photos suivantes et précédentes de notre tableau
            let prevPhotoIndex = openPhotoIndex - 1;

            // on veut récupérer l'url de la photo qui à pour index nextPhotoIndex à partir de notre tableau d'url
            let photoUrl = backgroundURLs[prevPhotoIndex];
            lightBoxImageContainer.attr('src', photoUrl); // notre image change

            $("#gallery-container .open").removeClass('open');
            let prevPhotoLink = $("#gallery-container .photo-link").eq(prevPhotoIndex); //quand on dépasse les bornes, nextPhotoIndex va valloir 8 qui n'existe pas
            // or la méthode eq n'accepte pas de valeur négative et revient à 0 (première photo)
            prevPhotoLink.addClass('open');
        });
        
        /**
         * Objectifs simples :
         * CSS : mettre en forme correctement la lightbox ✅
         * JS : Parvenir à fermer la lightbox en cliquant sur la croix ✅
         * JS : détecter le clic sur la flèche suivant et afficher dans la console "clic suivant" ✅
         * JS : détecter le clic sur la flèche précédent et afficher dans la console "clic précédent" ✅
         * JS : mettre en place le changement de photo pour le bouton précédent
         * CSS : corriger le positionnement des éléments de la lightbox
         * 
         * HTML/CSS/PHP : mettre en forme la page single
         * 
         * Objectifs complexes
         * JS : parvenir à récupérer les urls des posts avant/après dès que l'on clique sur l'oeil ✅
         */

    });
})(jQuery);