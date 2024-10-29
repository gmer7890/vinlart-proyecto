<?php
// Comprobar si el formulario ha sido enviado
if (isset($_POST['nombre']) && isset($_POST['contrasena'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

    // Comprobar si el usuario existe y si la contraseña es correcta
    $usuarios = json_decode(file_get_contents('usuarios.json'), true); // Obtener los usuarios registrados
    if (isset($usuarios[$nombre])) {
        if (password_verify($contrasena, $usuarios[$nombre]['contrasena'])) {
            // Obtener la lista de cuentas registradas desde la cookie
            $cuentas_registradas = $_COOKIE['cuentas_registradas'] ?? '';
            $cuentas_registradas = explode(',', $cuentas_registradas);
            $cuentas_registradas = array_filter($cuentas_registradas); // Eliminar elementos vacíos
            $cuentas_registradas = array_unique($cuentas_registradas); // Eliminar duplicados

            // Agregar el nombre de usuario actual a la lista de cuentas registradas y guardarla en la cookie
            $cuentas_registradas[] = $nombre;
            $cuentas_registradas = array_unique($cuentas_registradas); // Eliminar duplicados
            setcookie('cuentas_registradas', implode(',', $cuentas_registradas), time() + (86400 * 30), '/'); // Cookie válida por 30 días

            // Iniciar sesión y redirigir a index.php después de un inicio de sesión exitoso
            session_start();
            $_SESSION['nombre'] = $nombre;
            echo '<meta http-equiv="refresh" content="8; URL=home.php">';
            exit;
        } else {
            $mensaje = 'Contraseña incorrecta';
        }
    } else {
        $mensaje = 'El usuario no existe';
    }
} elseif (isset($_POST['nombre']) && isset($_POST['redaccion'])) {
    // Comprobar si el formulario ha sido enviado con una redacción en lugar de una contraseña
    $nombre = $_POST['nombre'];
    $redaccion = $_POST['redaccion'];

    // Comprobar si el usuario existe y si la redacción es correcta
    $usuarios = json_decode(file_get_contents('usuarios.json'), true); // Obtener los usuarios registrados
    if (isset($usuarios[$nombre])) {
        if ($usuarios[$nombre]['redaccion'] === $redaccion) {
            // Obtener la lista de cuentas registradas desde la cookie
            $cuentas_registradas = $_COOKIE['cuentas_registradas'] ?? '';
            $cuentas_registradas = explode(',', $cuentas_registradas);
            $cuentas_registradas = array_filter($cuentas_registradas); // Eliminar elementos vacíos
            $cuentas_registradas = array_unique($cuentas_registradas); // Eliminar duplicados

            // Agregar el nombre de usuario actual a la lista de cuentas registradas y guardarla en la cookie
            $cuentas_registradas[] = $nombre;
            $cuentas_registradas = array_unique($cuentas_registradas); // Eliminar duplicados
            setcookie('cuentas_registradas', implode(',', $cuentas_registradas), time() + (86400 * 30), '/'); // Cookie válida por 30 días

            // Iniciar sesión y redirigir a index.php después de un inicio de sesión exitoso
            session_start();
            $_SESSION['nombre'] = $nombre;
            echo '<meta http-equiv="refresh" content="8; URL=home.php">';
            exit;
        } else {
            $mensaje = 'Palabra clave incorrecta';
        }
    } else {
        $mensaje = 'El usuario no existe';
    }
} elseif (isset($_GET['usuario'])) {
    // Si se ha pasado un parámetro de usuario a través de un enlace, iniciar sesión automáticamente con ese usuario
    $nombre = $_GET['usuario'];
    $usuarios = json_decode(file_get_contents('usuarios.json'), true); // Obtener los usuarios registrados
    if (isset($usuarios[$nombre])) {
        // Iniciar sesión y redirigir a index.php después de un inicio de sesión exitoso
        session_start();
        $_SESSION['nombre'] = $nombre;
        echo '<meta http-equiv="refresh" content="8; URL=home.php">';
        exit;
    } else {
        $mensaje = 'El usuario no existe';
    }
} else {
    $mensaje = '';
}

// Obtener la lista de cuentas registradas desde la cookie
$cuentas_registradas = $_COOKIE['cuentas_registradas'] ?? '';
$cuentas_registradas = explode(',', $cuentas_registradas);
$cuentas_registradas = array_filter($cuentas_registradas); // Eliminar elementos vacíos
$cuentas_registradas = array_unique($cuentas_registradas); // Eliminar duplicados
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Segurity</title>
    <meta http-equiv="refresh" content="8; URL=home.php">
    <style>
  ::-webkit-scrollbar {
width: 0em;
height:0px;
background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb {
background-color: transparent;
height:0px;
}

::-webkit-scrollbar-track {
background-color: #F5F5F5;
}
</style>
    <!-- Favicon -->
    <link rel="icon" href="vanne.png" type="image/jpeg" size="230x230">
    <!-- Custom styles -->
    <style>
        .centered-image {
            max-width: 100%;
            max-height: 100%;
        }

        .loading-text {
            font-size: 22px;
            color: #333;
            font-family: helvetica;
            position: absolute;
            bottom: 20px;
        }

        /* Nuevo estilo para el fondo multicolor estilo Instagram en tonos morados, rosas y rojos */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url();
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background: linear-gradient(white);
            z-index: -1;
        }
          .contenedor-center {
            width: 100%;
            max-width: 400px;
            height: 200px;
            padding: 3px;
            background-color: #fff;
            border: 0px solid #000;
            border-radius: 10px;
            justify-content: center;
            align-items: center;
            position: absolute; /* Cambia a posición absoluta */
            left: 50%; /* Posiciona el contenedor al 50% desde la izquierda */
            top: 50%; /* Posiciona el contenedor al 50% desde la parte superior */
            transform: translate(-50%, -50%); /* Ajusta el contenedor para que esté centrado */
        }

    </style>
</head>
<body>

<div class="contenedor-center">
<div style="padding:9px; background-color:transparent; color:black; border-radius:0px; font-family:helvetica;" class="svg-standalone-icon centered-image">
    <center>
<img style="margin:9px; width: 150px; height: 150px; color:black; border-radius:10px;" class="svg-standalone-icon" src="https://cdn3d.iconscout.com/3d/premium/thumb/cerradura-de-seguridad-5535847-4623319.png?f=webp">
</center>
<br>
<center style="font-family:helvetica;">encryption</center>
<br>
<center>
    <style>
 .container {
            width: 100%;
            height: 3px;
            border: 0px solid #ede9e9d4;
            border-radius: 80px;
            position: relative;
            background-color: #ede9e9d4;
            overflow: hidden;
        }

        .progress-bar {
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, red, red);
            border-radius: 20px;
            position: absolute;
            left: 0;
            animation: fillBar 6s forwards;
        }

        @keyframes fillBar {
            0% {
                width: 0%;
            }
            100% {
                width: 100%;
            }
        }
    </style>

     <div class="container">
        <div class="progress-bar"></div>
    </div>


    </center>
</div></div>
   

 
  
    
</body>
    </body>