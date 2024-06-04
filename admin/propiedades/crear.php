<?php
require '../../includes/funciones.php';
$auth = estaAutenticado();
if (!$auth) {
    header('Location: /propiedades');
}




// BASE DE DATOS
require '../../includes/config/database.php';
$db = ConectarDB();

// CONSULTAR PARA OBTENER LOS VENDEDORES
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// AREGLO CON MENSAJES DE ERRORES
$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedores_id = '';

// EJECUTAR EL CODIGO DESPUES QUE EL USUARIO ENVIA EL FORMULARIO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     echo "<pre>";
//     var_dump ($_POST);
//     echo "<pre>";

    $titulo = mysqli_real_escape_string( $db, $_POST['titulo']);
    $precio = mysqli_real_escape_string( $db, $_POST['precio'] );
    $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion'] );
    $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones'] );
    $wc = mysqli_real_escape_string( $db, $_POST['wc'] );
    $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento'] );
    $vendedores_id = mysqli_real_escape_string( $db, $_POST['vendedores_id'] );
    $creado = date('Y/m/d');

    //ASIGNAR FILE HACIA UNA VARIABLE
    $imagen = $_FILES['imagen'];

    if (!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }

    if (!$precio) {
        $errores[] = "El precio es Obligatorio";
    }

    if (strlen($descripcion) < 50 ) {
        $errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
    }

    if (!$habitaciones) {
        $errores[] = "El Numero de habitaciones el obligatorio";
    }

    if (!$wc) {
        $errores[] = "El numero de Baños es obligatorio";
    }

    if (!$estacionamiento) {
        $errores[] = "El numero de lugares de estacionamiento es obligatorio";
    }

    if (!$vendedores_id) {
        $errores[] = "Seleciona el vendedor";
    }

    if (!$imagen['name']) {
        $errores[] = "La imagen es obligatoria";
    }



    // REVISAR QUE LOS ERRORES ESTE VACIO
    if(empty($errores)){

        // GENERAR UN NOMBRE UNICO
        $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";

        // CREAR CARPETA 
        $carpetaImagenes = '../../imagenes/';
            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }
            // SUBIR IMAGEN 
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );



    // INSERTAR EN LA BASE DE DATOS
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id)
                   VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedores_id')";

        // echo $query;
        $resultado = mysqli_query($db, $query);
        if($resultado){
            // REDIRECCIONAR AL USUARIO
            header('Location: /propiedades/admin?resultado=1');
        }
    }

}




incluirTemplates('header');
?>

    <main class="contenedor seccion">
        <h1>Crear Propiedad</h1>
        <a href="../" class="boton boton-verde">Volver</a>

        <!-- MENSAJE FALTAN DATOS -->
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>            
        <?php endforeach; ?>
        <!-- MENSAJE FALTAN DATOS -->
        
        <form class="formulario" method="POST" action="crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion de la Propiedad</legend>
                    <label for="habitaciones">Habitaciones:</label>
                    <input type="nomber" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="6" value="<?php echo $habitaciones ?>">

                    <label for="wc">Baños:</label>
                    <input type="nomber" id="wc" name="wc" placeholder="Ej: 3" min="1" max="6" value="<?php echo $wc ?>">

                    <label for="estacionamiento">estacionamiento:</label>
                    <input type="nomber" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="6" value="<?php echo $estacionamiento ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                   <select name="vendedores_id">
                       <option value="">-- Seleccionar --</option>
                            <?php while($row = mysqli_fetch_assoc($resultado)) : ?>
                                <option <?php echo $vendedores_id === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"> <?php echo $row['nombre'] . " " . $row['apellido'] ?> </option>
                            <?php endwhile; ?>
                   </select>
            </fieldset>

            <input class="boton boton-verde" type="submit" value="Crear Propiedad">
        </form>
    </main>


    
<?php
incluirTemplates('footer');
?>