<?php

    function routes_battles(){

               $routes[] = array(
                            '_uri'  => '/^battles\/(.*)\/(.*)$/i',
                            1       => 'action',
                   			2       => 'zapros'
                         );
 			    $routes[] = array(
                            '_uri'  => '/^battles\/(.*)$/i',
                            1       => 'action'
                         );
        return $routes;

    }

?>
