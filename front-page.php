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
        <option value="">FORMATS</option>
        <option value="paysage">Paysage</option>
        <option value="portrait">Portrait</option>
    </select>
    <select class="element-filter last-filter" id="order-by-date">
        <option value="">TRIER PAR</option>
        <option value="DESC">A partir des plus récentes</option>
        <option value="ASC">A partir des plus anciennes</option>
    </select>
    </section>
    <!--Section pour la galerie des photos-->
    <section class="gallery">
        <div id="gallery-container"></div>
        <button id="load" class="load-more"type="button">Charger plus</button>
    </section> 
<?php
get_footer();
?>
