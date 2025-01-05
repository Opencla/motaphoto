jQuery(document).ready(function($) {
    let trigger = $('.js-open-lightbox');

    console.log(trigger);

    // Boucle correctement avec jQuery
    trigger.each(function() {
        $(this).on('click', function(event) {
            event.stopPropagation();
            console.log('cliqué');
        });
    });
});
