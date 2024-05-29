<?php

// IMPORTAR LA CONEXION
require '../includes/config/database.php';
$db = ConectarDB();
// ESCRIBIR EL QUERY
$query = "SELECT * FROM propiedades";
// CONSULTAR BD
$resultadoConsulta = mysqli_query($db, $query);

// MUESTRA MENSAJE CONDICIONAL SI SE AGREGO UNA PROPIEDAD 
$resultado = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $id = $_POST['id'];
   $id = filter_var($id, FILTER_VALIDATE_INT);

   if ($id) {
       // ELIMINAR ARCHIVO
       $query = "SELECT imagen FROM propiedades WHERE id = $id";

       $resultado = mysqli_query($db, $query);
       $propiedad = mysqli_fetch_assoc($resultado);

       unlink('../imagenes/' . $propiedad['imagen']);

       // ELIMINAR PROPIEDAD
        $query = "DELETE FROM propiedades WHERE id = $id";

        $resultado = mysqli_query($db, $query);

        if($resultado){
            header('Location: /propiedades/admin?resultado=3');
        }
   }
   
}

// INCLUYE UN TEMPLATE
require '../includes/funciones.php';
incluirTemplates('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

            <?php if( intval( $resultado) === 1) : ?>
                <p class="alerta exito">Propiedad Creada Correctamente</p>
            <?php elseif( intval( $resultado) === 2) : ?>
                <p class="alerta exito">Propiedad Actualizada Correctamente</p>
            <?php elseif( intval( $resultado) === 3) : ?>
                <p class="alerta exito">Propiedad Eliminada Correctamente</p>


            <?php endif; ?>
        <a href="propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>

                </tr>
            </thead>

            <tbody>
                 <!-- MOSTRAR RESULTADOS -->
                 <?php while($propiedad =mysqli_fetch_assoc($resultadoConsulta)) :  ?>
               
                 <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td><img class="imagen-tabla" src="../imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen Propiedad"></td>
                    <td><?php echo $propiedad['precio']; ?></td>
                <td>
                    <form method="POST" class="w-100">
                        <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?> ">
                        <input type="submit" href="#" class="boton-rojo-block" value="Eliminar">
                    </form>                   
                    <a href="propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">actualizar</a>
                </td>
                </tr>

                <?php endwhile; ?>

            </tbody>

        </table>
        
    </main>


    
<?php
// CERRAR LA CONEXION
mysqli_close($db);
incluirTemplates('footer');
?>