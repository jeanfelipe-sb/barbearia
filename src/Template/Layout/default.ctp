<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = 'Barber Blues: Cabelo, Barba e Bigode';
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?= $cakeDescription ?>:
            <?= $this->fetch('title') ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <?= $this->Html->css('bootstrap.css') ?>
        <?= $this->Html->css('carousel.css') ?>
        <?= $this->Html->css('custom.css') ?>
        <?= $this->Html->css('magnific-popup.css') ?>
        <?= $this->Html->css('font-awesome.min.css') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Bungee+Shade');
            @import url('https://fonts.googleapis.com/css?family=Merriweather');
            @import url('https://fonts.googleapis.com/css?family=Open+Sans');

            @import url('https://fonts.googleapis.com/css?family=Averia+Gruesa+Libre');
            @import url('https://fonts.googleapis.com/css?family=Frijole');
        </style>
    </head>
    <body  id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

        <nav id="nav-main" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-ex1-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="img-logo">
                        <div style="background-image: url('webroot/img/Logo.png');"></div>
                    </div>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li><a class="page-scroll" href="#page-top">HOME</a></li>                        
                        <li><a class="page-scroll" href="#about">A BARBEARIA</a></li>      
                        <li><a class="page-scroll"  href="#services">SERVIÇOS</a></li>                   
                        <li><a class="page-scroll" href="#address">ENDEREÇO</a></li>
                        <li><a class="page-scroll" href="#contact">CONTATO</a></li>  
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
        </nav>
        <div class="content-page">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>

        <script>

            /**
             * Listen to scroll to change header opacity class
             */
            //            function checkScroll() {
            //                var startY = $('.navbar').height() * 2; //The point where the navbar changes in px
            //
            //                if ($(window).scrollTop() > startY) {
            //                    $('.navbar').addClass("scrolled");
            //                } else {
            //                    $('.navbar').removeClass("scrolled");
            //                }
            //            }
            //
            //            if ($('.navbar').length > 0) {
            //                $(window).on("scroll load resize", function () {
            //                    checkScroll();
            //                });
            //            }
            function initMap() {
                // Styles a map in night mode.
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: -25.445686, lng: -49.064647},
                    zoom: 15,
                    styles: [
                        {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
                        {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
                        {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                        {
                            featureType: 'administrative.locality',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'poi',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'geometry',
                            stylers: [{color: '#263c3f'}]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#6b9a76'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'geometry',
                            stylers: [{color: '#38414e'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'geometry.stroke',
                            stylers: [{color: '#212a37'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#9ca5b3'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry',
                            stylers: [{color: '#746855'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry.stroke',
                            stylers: [{color: '#1f2835'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#f3d19c'}]
                        },
                        {
                            featureType: 'transit',
                            elementType: 'geometry',
                            stylers: [{color: '#2f3948'}]
                        },
                        {
                            featureType: 'transit.station',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'geometry',
                            stylers: [{color: '#17263c'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#515c6d'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.stroke',
                            stylers: [{color: '#17263c'}]
                        }
                    ]
                });
                var image = {
                    url: '/Images/orange_guy.png', // image is 512 x 512
                    scaledSize: new google.maps.Size(22, 32)
                };

                var myLatLng = {lat: -25.440869, lng: -49.062524};
                // Create markers.
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,

                    title: 'Barber Blues'
                });
                marker.setMap(map);
            }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiFc85P-9BtFTNK4LcCeohAxncv_EO9Oc&callback=initMap"
        async defer></script>
        <footer class="bg-dark">
            <div class="col-sm-4">
                
            </div>
            <div class="col-sm-4 text-center">
                <img style="height: 70px;"src="webroot/img/Logo.png" alt=""/>
            </div>
            <div class="col-sm-4 text-center">
                 <h5 class="text-center">Desenvolvido por: <img style="height: 70px;"src="webroot/img/jf.png" alt=""/> </h5>
                
               
            </div>
            
        </footer>

        <?= $this->Html->script('jquery-3.2.1.min.js') ?>
        <?= $this->Html->script('bootstrap.js') ?>
        <?= $this->Html->script('jquery.easing.min.js') ?>
        <?= $this->Html->script('custom.js') ?>
        <?= $this->Html->script('jquery.magnific-popup.min.js') ?>

    </body>
</html>
