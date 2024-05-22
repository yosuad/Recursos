<?php
// BASE DE DATOS
require '../../includes/config/database.php';

$db = ConectarDB();
// AREGLO CON MENSAJES DE ERRORES
$errores = [];
// EJECUTAR EL CODIGO DESPUES QUE EL USUARIO ENVIA EL FORMULARIO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump ($_POST);
    // echo "<pre>";

    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedores_id = $_POST['vendedores_id'];

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

    // REVISAR QUE LOS ERRORES ESTE VACIO
    if(empty($errores)){
    // INSERTAR EN LA BASE DE DATOS
        $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedores_id)
                   VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedores_id')";

    // echo $query;
    $resultado = mysqli_query($db, $query);
    if($resultado){
        echo "Insertado Corretamente";
    }
    }


}


require '../../includes/funciones.php';
incluirTemplates('header');
?>

    <main class="contenedor seccion">
        <h1>Crear Propiedad</h1>
        <a href="../" class="boton boton-verde">Volver</a>

        <!-- MENSAJE FALTAN DATOS -->
        <?php foreach($errores as $error): ?>
            <?php echo $error; ?>
        <?php endforeach; ?>
        <!-- MENSAJE FALTAN DATOS -->
        
        <form class="formulario" method="POST" action="crear.php">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion de la Propiedad</legend>
                    <label for="habitaciones">Habitaciones:</label>
                    <input type="nomber" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="6">

                    <label for="wc">Baños:</label>
                    <input type="nomber" id="wc" name="wc" placeholder="Ej: 3" min="1" max="6">

                    <label for="estacionamiento">estacionamiento:</label>
                    <input type="nomber" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="6">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                   <select name="vendedores_id">
                       <option value="">-- Seleccionar --</option>
                       <option value="1">Juan</option>
                       <option value="2">Karen</option>
                   </select>
            </fieldset>

            <input class="boton boton-verde" type="submit" value="Crear Propiedad">
        </form>
    </main>


    
<?php
incluirTemplates('footer');
?>