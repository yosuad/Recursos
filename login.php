<?php
require 'includes/config/database.php';
$db = ConectarDB();
// AUTENTICAR USUARIO
$errores =[];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);
   

    if (!$email) {
        $errores[] = "El email es obligatorio o no es valido";
    }
    if (!$password) {
        $errores[] = "El password es obligatorio";
    }
    if (empty($errores)) {
        // REVISAR SI EL USUARIO EXISTE
        $query = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($db, $query);
       
        if ($resultado -> num_rows) {
            // REVISAR SI EL PASSWORD ES CORRECTO
            $usuario = mysqli_fetch_assoc($resultado);
            // VERIFICAR SI EL PASSWORD ES CORRECTO O NO
            $auth = password_verify($password, $usuario['password']);

            if ($auth) {
                // EL USUARIO ESTA AUTENTICADO
                session_start();
                // LLENAR EL ARREGLO DE LA SESSION
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;
               
            } else{
                $errores[] = "El password es incorrecto";
            }           
    
        } else {
            $errores[] = "El usuario no es valido";
        }



    }

    
}


// INCLUIR HEADER
require 'includes/funciones.php';
incluirTemplates('header');
?>

    <main class="contenedor Sesion">
        <h1>Iniciar seccion </h1>
            <?php foreach($errores as $error) :?>
                <div class="alerta error">
                   <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
        <form method="POST" class="formulario" action="">

        <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email">

                <label for="password">passwoerd</label>
                <input type="password" name="password" placeholder="Tu password" id="password">               
            </fieldset>
            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">

        </form>
    </main>


    
<?php
incluirTemplates('footer');
?>