<?php
// IMPORTAR LA CONEXIÓN
require 'includes/config/database.php';
$db = ConectarDB();
// CREAR UN EMAIL Y PASSWORD
$email = "correo@correo.com";
$password = 123456;
// QUERY PARA CREAR EL USUARIO
$query = " INSERT INTO usuarios (email, password) VALUES ('$email', '$password'); ";
// AGREGAR A LA BASE DE DATOS

echo $query;
mysqli_query($db, $query);