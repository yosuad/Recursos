<?php
// AUTENTICAR USUARIO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
}


// INCLUIR HEADER
require 'includes/funciones.php';
incluirTemplates('header');
?>

    <main class="contenedor Sesion">
        <h1>Iniciar seccion </h1>

        <form method="POST" class="formulario" action="">

        <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu Email" id="email">

                <label for="password">passwoerd</label>
                <input type="password" placeholder="Tu password" id="password">               
            </fieldset>
            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">

        </form>
    </main>


    
<?php
incluirTemplates('footer');
?>