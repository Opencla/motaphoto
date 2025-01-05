<?php
get_header(); 
?>
<main>
    <!--Section pour photographe event-->
    <section class="image">
        <h1>Photographe Event</h1>
    <div class="image-banner">
        <img width="1440" height="962" src="http://localhost/motaphoto/wordpress/wp-content/uploads/2024/10/nathalie-11.jpg">
    </div>
    </section>
    <!--Mes filtres-->
    <section class="filters">
    <select class="element-filter" id="order-by-categories">
        <option value="">CATEGORIES</option>
        <option value="reception">Réception</option>
        <option value="television">Télévision</option>
        <option value="concert">Concert</option>
        <option value="mariage">Mariage</option>
    </select>
    <select class="element-filter" id="order-by-formats">
        <option value="all">FORMATS</option>
        <option value="paysage">Paysage</option>
        <option value="portrait">Portrait</option>
    </select>
    <select class="element-filter last-filter" id="order-by-date">
        <option value="all">TRIER PAR</option>
        <option value="DESC">A partir des plus récentes</option>
        <option value="ASC">A partir des plus anciennes</option>
    </select>
    </section>
    <!--Section pour la galerie des photos-->
    <section class="gallery">
        <div id="gallery-container"></div>
        <button id="load" class="load-more"type="button">Charger plus</button>
    </section> 

    <!--Lightbox-->
    <div id="motaphoto-lightbox" class="lightbox lightbox_hidden">
        <button id="lightbox__close"></button>
        <button id="lightbox__next">
            <span class='next-icon'></span>
            <p>Suivante</p>
        </button>
        <button id="lightbox__prev">
            <span class='prev-icon'></span>
            <p>Précédente</p>
        </button>
        <div class="lightbox__container">
            <img id="motaphoto-lightbox-image" src="">
        </div>
    </div>
<?php
get_footer();
?>
