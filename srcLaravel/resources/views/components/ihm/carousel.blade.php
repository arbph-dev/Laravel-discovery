@props(['iddiv' => 'carousel-app'])


    <div id="{{ $iddiv }}">
        
        <image-carousel :period="3000">
            <a href="./public/img/ANIMAUX/CHIENS/berger-allemand.jpg" target="_blank"> 
                <img src="./public/img/ANIMAUX/CHIENS/berger-allemand.jpg" alt="berger allemand"/>
            </a>
            <img src="./public/img/ANIMAUX/CHIENS/berger-border-Collie.jpg" alt="berger border Collie" />
            <img src="./public/img/ANIMAUX/CHIENS/berger-malinois.jpg" alt="berger malinois" />
            <img src="./public/img/ANIMAUX/CHIENS/chien_akita.jpg" alt="Akita Inu"/>
            <img src="./public/img/ANIMAUX/CHIENS/chien_border.jpg" alt="Border Collie" />
        </image-carousel>

    </div><!-- end caroussel -->



<script type="module">
    import { createApp } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js';
    import { ImageCarousel } from './public/build/assets/carousel.js';
    // Application pour le carrousel
    const carouselApp = createApp( { components: { 'image-carousel': ImageCarousel } } )
    carouselApp.mount('#carousel-app')

</script>    
