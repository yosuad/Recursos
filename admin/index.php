<?php
// MENSAJE ENVIADO 
$resultado = $_GET['resultado'] ?? null;



require '../includes/funciones.php';
incluirTemplates('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

            <?php if( intval( $resultado) === 1) : ?>
                <p class="alerta exito">Propiedad Creada Correctamente</p>
            <?php endif; ?>
        <a href="propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    </main>


    
<?php
incluirTemplates('footer');
?>