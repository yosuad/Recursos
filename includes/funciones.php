<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');

function incluirTemplates( string $nombre, bool $inicio = false){       
    include TEMPLATES_URL . "/{$nombre}.php";   
}

function estaAutenticado() {
    session_start();
   
    if(!$_SESSION['login']){
        header('Location: ../../login.php');
        
    }
    
}

function debug($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
}