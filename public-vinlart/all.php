<?php
session_start();

// Verificar si el usuario ha iniciado sesión o si se ha almacenado una cookie de sesión
if (!isset($_SESSION['nombre']) && !isset($_COOKIE['nombre'])) {
  // Si no ha iniciado sesión y no hay una cookie de sesión, redireccionar a la página de registro
  
}

// Leer los datos de usuarios del archivo JSON
$usuarios = json_decode(file_get_contents('usuarios.json'), true);

// Obtener los datos del usuario actual
if (isset($_SESSION['nombre'])) {
  // Si hay una sesión activa, obtener los datos del usuario de la sesión
  $nombre = $_SESSION['nombre'];
} else {
  // Si no hay una sesión activa, obtener los datos del usuario de la cookie
  $nombre = $_COOKIE['nombre'];
  // Restaurar la sesión utilizando el nombre de usuario almacenado en la cookie
  $_SESSION['nombre'] = $nombre;
}

// Verificar si el usuario actual existe en el archivo de usuarios
if (!array_key_exists($nombre, $usuarios)) {
  // Si el usuario no existe, redireccionar a la página de registro
  
}

// Obtener los datos del usuario actual
$usuario = $usuarios[$nombre];

// Establecer una cookie de sesión para recordar al usuario con una expiración de 3 años
if (!isset($_COOKIE['nombre']) || $_COOKIE['nombre'] !== $nombre) {
  setcookie('nombre', $nombre, time() + (86400 * 365 * 3), '/'); // La cookie expirará después de 3 años
}

$d = $nombre;
?>


<?php
$archivo = "datos.json";
$datos = array();
$dedu = 0;
if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $datos = json_decode($contenido);
}

if (isset($_POST['eliminar'])) {
    $id = $_POST['eliminar'];
    unset($datos->$id);

    $json_datos = json_encode($datos, JSON_PRETTY_PRINT);
    file_put_contents($archivo, $json_datos);

    header("Location: csc.php");
    exit();
}

if (isset($_GET['q'])) {
    $q = $_GET['q'];
    $datos = array_filter($datos, function ($dato) use ($q) {
        return strpos($dato->foto, $q) !== false
            || strpos($dato->nombre, $q) !== false
            || strpos($dato->texto, $q) !== false;
    });
}

shuffle($datos);
?>

		<?php

		$promg = 0;
		foreach ($datos as $id => $dato) {
            
		?>


<?php

    // Asignar el valor de las variables "tiempo", "foto" y "texto"
    $nombre = ($dato->id);

    // Concatenar el valor de las variables en el nombre del archivo
    $nombre_archivo = 'vin-' . $nombre . '.php';
    // Definir el contenido del archivo (por ejemplo, una cadena vacía)
    $contenido_archivo = '
    <?php
session_start();

// Verificar si el usuario ha iniciado sesión o si se ha almacenado una cookie de sesión
if (!isset($_SESSION[\'nombre\']) && !isset($_COOKIE[\'nombre\'])) {
  // Si no ha iniciado sesión y no hay una cookie de sesión, redireccionar a la página de registro
  header(\'Location: sign_up.php\');
  exit;
}

// Leer los datos de usuarios del archivo JSON
$usuarios = json_decode(file_get_contents(\'usuarios.json\'), true);

// Obtener los datos del usuario actual
if (isset($_SESSION[\'nombre\'])) {
  // Si hay una sesión activa, obtener los datos del usuario de la sesión
  $nombre = $_SESSION[\'nombre\'];
} else {
  // Si no hay una sesión activa, obtener los datos del usuario de la cookie
  $nombre = $_COOKIE[\'nombre\'];
  // Restaurar la sesión utilizando el nombre de usuario almacenado en la cookie
  $_SESSION[\'nombre\'] = $nombre;
}

// Verificar si el usuario actual existe en el archivo de usuarios
if (!array_key_exists($nombre, $usuarios)) {
  // Si el usuario no existe, redireccionar a la página de registro
  header(\'Location: sign_up.php\');
  exit;
}

// Obtener los datos del usuario actual
$usuario = $usuarios[$nombre];

// Establecer una cookie de sesión para recordar al usuario con una expiración de 3 años
if (!isset($_COOKIE[\'nombre\']) || $_COOKIE[\'nombre\'] !== $nombre) {
  setcookie(\'nombre\', $nombre, time() + (86400 * 365 * 3), \'/\'); // La cookie expirará después de 3 años
}

$d = $nombre;
?>

    <!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title data-key="delete"></title>
    <link rel="icon" href="logo.png">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./dark.css" />
    <script>
        (function() {
            const currentMode = localStorage.getItem("mode") || "light";
            document.documentElement.classList.add(`${currentMode}-mode`);
        })();
    </script>
    <?php
$soy_Y = "'.$dato->nombre.'";
$soy_X = "$d";
if ($soy_Y == $soy_X) {
    // Si las variables son iguales, no se hace nada
} else {
    // Si las variables son diferentes, se redirige a la página anterior
    echo "<script>window.history.back();</script>";
}
?>
    <!-- Importa la fuente de iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

<br><br><br><br><br><br>
    <center>
    <?php
$soy_Y = "'.$dato->nombre.'";
$soy_X = "$d";
if ($soy_Y == $soy_X) {
    // Si las variables son iguales, no se hace nada
} else {
    // Si las variables son diferentes, se redirige a la página anterior
    echo "<h1>Error Page</h1>";
}
?>

    <a style="color:red; <?php
$soy_Y = "'.$dato->nombre.'";
$soy_X = "$d";
if ($soy_Y == $soy_X) {
    // Si las variables son iguales, no se hace nada
} else {
    // Si las variables son diferentes, se redirige a la página anterior
    echo "display: none;";
}
?>" class="" id="eliminarPost" data-key="delete">Eliminar</a>
        </center>


        <script>
        document.getElementById("eliminarPost").addEventListener("click", function() {
            var confirmar = confirm("¿Seguro que deseas eliminar esta publicación?");
    
            if (confirmar) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "datos.json", true);
    
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
    
                        // Filtrar el objeto JSON específico
                        var newData = data.filter(function(item) {
                            return !(item.nombre === "'.$dato->nombre.'" && item.id === "'.$dato->id.'");
                        });
    
                        var jsonResult = JSON.stringify(newData, null, 2);
    
                        var xhr2 = new XMLHttpRequest();
                        xhr2.open("POST", "", true);
                        xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
                        xhr2.onreadystatechange = function () {
                            if (xhr2.readyState === 4 && xhr2.status === 200) {
                                alert("Publicación eliminada");
                                window.location.href = "profile.php"; // Redirige al perfil
                            } else {
                                alert("Se eliminara permatentemente");
                                window.location.href = "profile.php"; // Redirige al perfi
                            }
                        };
    
                        xhr2.send("json=" + encodeURIComponent(jsonResult));
                    }
                };
    
                xhr.send();
            }
        });
    </script>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $json = $_POST["json"];
        file_put_contents("datos.json", $json);
    
        // Eliminar archivos PHP si existen
        $phpFile1 = "comment_'.$dato->id.'.php";
        $phpFile2 = "vin-'.$dato->id.'.php";
    
        if (file_exists($phpFile1)) {
            unlink($phpFile1);
        }
    
        if (file_exists($phpFile2)) {
            unlink($phpFile2);
        }
    
        echo "OK";
    }
    ?>

    <button style=" display: none;" id="toggleDarkMode">Toggle Dark Mode</button>
    <script src="dark.js"></script>
    </div>
</body>

</html>
    ';
    // Guardar el contenido en el archivo
    file_put_contents($nombre_archivo, $contenido_archivo);
}
?>

<?php
$archivo = "datos.json";
$datos = array();
$dedu = 0;
if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $datos = json_decode($contenido);
}

if (isset($_POST['eliminar'])) {
    $id = $_POST['eliminar'];
    unset($datos->$id);

    $json_datos = json_encode($datos, JSON_PRETTY_PRINT);
    file_put_contents($archivo, $json_datos);

    header("Location: csc.php");
    exit();
}

if (isset($_GET['q'])) {
    $q = $_GET['q'];
    $datos = array_filter($datos, function ($dato) use ($q) {
        return strpos($dato->foto, $q) !== false
            || strpos($dato->nombre, $q) !== false
            || strpos($dato->texto, $q) !== false;
    });
}

shuffle($datos);
?>

		<?php

		$promg = 0;
		foreach ($datos as $id => $dato) {
            
		?>


<?php

    // Asignar el valor de las variables "tiempo", "foto" y "texto"
    $nombre = ($dato->id);

    // Concatenar el valor de las variables en el nombre del archivo
    $nombre_archivo = 'report-vin-' . $nombre . '.php';
    // Definir el contenido del archivo (por ejemplo, una cadena vacía)
    $contenido_archivo = '<?php

session_start();



// Verificar si el usuario ha iniciado sesión o si se ha almacenado una cookie de sesión
if (!isset($_SESSION[\'nombre\']) && !isset($_COOKIE[\'nombre\'])) {
  // Si no ha iniciado sesión y no hay una cookie de sesión, redireccionar a la página de registro
  header(\'Location: sign_up.php\');
  exit;
}

// Leer los datos de usuarios del archivo JSON
$usuarios = json_decode(file_get_contents(\'usuarios.json\'), true);

// Obtener los datos del usuario actual
if (isset($_SESSION[\'nombre\'])) {
  // Si hay una sesión activa, obtener los datos del usuario de la sesión
  $nombre = $_SESSION[\'nombre\'];
} else {
  // Si no hay una sesión activa, obtener los datos del usuario de la cookie
  $nombre = $_COOKIE[\'nombre\'];
  // Restaurar la sesión utilizando el nombre de usuario almacenado en la cookie
  $_SESSION[\'nombre\'] = $nombre;
}

// Verificar si el usuario actual existe en el archivo de usuarios
if (!array_key_exists($nombre, $usuarios)) {
  // Si el usuario no existe, redireccionar a la página de registro
  header(\'Location: sign_up.php\');
  exit;
}

// Obtener los datos del usuario actual
$usuario = $usuarios[$nombre];

// Establecer una cookie de sesión para recordar al usuario con una expiración de 3 años
if (!isset($_COOKIE[\'nombre\']) || $_COOKIE[\'nombre\'] !== $nombre) {
  setcookie(\'nombre\', $nombre, time() + (86400 * 365 * 3), \'/\'); // La cookie expirará después de 3 años
}

$d = $nombre;
?>

    <!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title data-key="report"></title>
    <link rel="icon" href="logo.png">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./dark.css" />
    <script>
        (function() {
            const currentMode = localStorage.getItem("mode") || "light";
            document.documentElement.classList.add(`${currentMode}-mode`);
        })();
    </script>
    
    <!-- Importa la fuente de iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

<br><br><br><br>
    <center>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"] {
            width: 100%;
            display: none;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Estilos para el textarea en PC */
        textarea {
            width: 350px;
            padding: 10px;
            border: 0px solid #ccc;
            border-width: 1px;
    border-style: solid;
            border-radius: 4px;
            resize: none; /* Deshabilita el redimensionamiento manual */
            overflow: hidden;
            background-color: transparent;
            min-height: 100px;
        }

        /* Estilos para dispositivos móviles */
        @media (max-width: 768px) {
            textarea {
                width: 100%;
            }
        }
    </style>


    <form action="ve.php"  method="post" enctype="multipart/form-data">
    <input type="text" value="'.$dato->nombre.'" id="name" name="voto" placeholder="Introduce tu nombre">
    <input type="text" value="post.php?views='.$dato->id.'.php" id="name" name="link" placeholder="Introduce tu nombre">

        <label for="message" data-key="report"></label>
        <textarea  class="darklight" id="message" name="texto" placeholder="Aa..."></textarea>
        <br>
        <input style="padding: 9px;
        border: solid 1px #cccccc30;
        border-radius:10px;
        background-color: red; color: white;" type="submit">
    </form>

    <script>
        // Función para ajustar la altura del textarea según el contenido
        const textarea = document.getElementById("message");
        
        textarea.addEventListener("input", function() {
            this.style.height = "auto"; // Resetea la altura primero
            this.style.height = this.scrollHeight + "px"; // Ajusta la altura según el contenido
        });
    </script>
        </center>


        
    <button style=" display: none;" id="toggleDarkMode">Toggle Dark Mode</button>
    <script src="dark.js"></script>
    </div>
</body>

</html>
    ';
    // Guardar el contenido en el archivo
    file_put_contents($nombre_archivo, $contenido_archivo);
}
?>

<?php
$archivo = "datos.json";
$datos = array();
$dedu = 0;
if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $datos = json_decode($contenido);
}

if (isset($_POST['eliminar'])) {
    $id = $_POST['eliminar'];
    unset($datos->$id);

    $json_datos = json_encode($datos, JSON_PRETTY_PRINT);
    file_put_contents($archivo, $json_datos);

    header("Location: csc.php");
    exit();
}

if (isset($_GET['q'])) {
    $q = $_GET['q'];
    $datos = array_filter($datos, function ($dato) use ($q) {
        return strpos($dato->categoria, $q) !== false
            || strpos($dato->nombre, $q) !== false
            || strpos($dato->descripcion, $q) !== false;
    });
}

shuffle($datos);
?>

		<?php

		$promg = 0;
		foreach ($datos as $id => $dato) {
            
		?>


<?php

    // Asignar el valor de las variables "tiempo", "foto" y "texto"
    $nombre = ($dato->id);

    // Concatenar el valor de las variables en el nombre del archivo
    $nombre_archivo = 'Comment_' . $nombre . '.php';
    // Definir el contenido del archivo (por ejemplo, una cadena vacía)
    $contenido_archivo = '
    <?php
    session_start();
    
    // Verificar si el usuario ha iniciado sesión o si se ha almacenado una cookie de sesión
    if (!isset($_SESSION[\'nombre\']) && !isset($_COOKIE[\'nombre\'])) {
      // Si no ha iniciado sesión y no hay una cookie de sesión, redireccionar a la página de registro
      header(\'Location: sign_up.php\');
      exit;
    }
    
    // Leer los datos de usuarios del archivo JSON
    $usuarios = json_decode(file_get_contents(\'usuarios.json\'), true);
    
    // Obtener los datos del usuario actual
    if (isset($_SESSION[\'nombre\'])) {
      // Si hay una sesión activa, obtener los datos del usuario de la sesión
      $nombre = $_SESSION[\'nombre\'];
    } else {
      // Si no hay una sesión activa, obtener los datos del usuario de la cookie
      $nombre = $_COOKIE[\'nombre\'];
      // Restaurar la sesión utilizando el nombre de usuario almacenado en la cookie
      $_SESSION[\'nombre\'] = $nombre;
    }
    
    // Verificar si el usuario actual existe en el archivo de usuarios
    if (!array_key_exists($nombre, $usuarios)) {
      // Si el usuario no existe, redireccionar a la página de registro
      header(\'Location: sign_up.php\');
      exit;
    }
    
    // Obtener los datos del usuario actual
    $usuario = $usuarios[$nombre];
    
    // Establecer una cookie de sesión para recordar al usuario con una expiración de 3 años
    if (!isset($_COOKIE[\'nombre\']) || $_COOKIE[\'nombre\'] !== $nombre) {
      setcookie(\'nombre\', $nombre, time() + (86400 * 365 * 3), \'/\'); // La cookie expirará después de 3 años
    }
    
    $d = $nombre;
    ?>

    <!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title data-key="comment"></title>
    <link rel="icon" href="logo.png">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./dark.css" />
    <script>
        (function() {
            const currentMode = localStorage.getItem("mode") || "light";
            document.documentElement.classList.add(`${currentMode}-mode`);
        })();
    </script>
                <style>
            .main-post3{
                margin: 0px 24%;
            }
            @media (max-width: 976px){
    .main-post3{
       margin: 0px 10%;
    }
}

            @media (max-width: 733px){
    .main-post3{
       margin: 0px 5%;
    }
}

            @media (max-width: 533px){
    .main-post3{
       margin: 0px;
    }
}
      
        .post-container {
            margin-top: 7px;
            border-bottom: solid 1px #ccc6;
            width: 100%;
            display: flex;
        }
        .post-image {
            flex: ;
            margin-right: 15px;
            width: 100%;
        }
        .post-image img {
            width: 100%;
            border-radius: 15px;
        }
        .post-content {
            flex: 2;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .post-text {
            margin-bottom: 20px;
        }
        .post-icons {
            display: flex;
            justify-content: flex-end;
        }
        .post-icons i {
            margin-left: 10px;
            font-size: 24px;
            cursor: pointer;
            color: #555;
        }
        .post-icons i:hover {
            color: #000;
        }

        .carousel-container {
      display: flex;
      justify-content: center;
      margin: 8px 0;
    }

    .carousel {
      display: flex;
      overflow-x: auto;
      scroll-snap-type: x mandatory;
      -webkit-overflow-scrolling: touch;
      scroll-behavior: smooth;
      width: 100%;
      max-width: 1000px; /* Limitar el ancho máximo */
    }

    .carousel-item {
      flex: none;
      width: 100%;
      scroll-snap-align: start;
    }

    .carousel-item img {
      width: 100%;
      display: block;
      padding: 1px;
      min-height: 200px;
    }

    .carousel::-webkit-scrollbar {
      display: none;
    }

    @media (max-width: 600px) {
      .carousel-item img {
        width: 100%;
      }
    }
    </style>
    <!-- Importa la fuente de iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

  <div">
    <!-- sidebar -->
    <div  style="background-color: transparent; border-right: solid 1px #cccc;" class="sidebar">
        <a href="#" class="logo">
            <img style="width: 40px;" src="logo.png" alt="logo">
        </a>
        <!-- profile image -->
        <div class="profile">
            <a href=" profile.php?user=<?php echo $d; ?>"><div class="profile-img">
                <img style="width: 70px; height: 70px; object-fit: cover;" src="perfiles/'.$usuario['imagen'].'" alt="profile">
            </div></a>
            <br>
            <h4><?php echo $d; ?></h4>
            <span>'.$usuario['nombre_completo'].'</span>
        </div>
        <!-- About -->
        <div style="border: solid 0.5px #cccccc0d;" class="about">
            <!-- Box 1 -->
        </div>

        <!-- Menu -->
        <div class="menu">
            <a href="home.php" class="darklight">
                <span class="icon">
                    <i class="ri-function-line"></i>
                </span>
                <span data-key="home">Feed</span>
            </a>
           
            <a class=active href="noti.php">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="17" height="17"><path d="M22.555,13.662l-1.9-6.836A9.321,9.321,0,0,0,2.576,7.3L1.105,13.915A5,5,0,0,0,5.986,20H7.1a5,5,0,0,0,9.8,0h.838a5,5,0,0,0,4.818-6.338ZM12,22a3,3,0,0,1-2.816-2h5.632A3,3,0,0,1,12,22Zm8.126-5.185A2.977,2.977,0,0,1,17.737,18H5.986a3,3,0,0,1-2.928-3.651l1.47-6.616a7.321,7.321,0,0,1,14.2-.372l1.9,6.836A2.977,2.977,0,0,1,20.126,16.815Z"></path></svg>
                </span>
                <span data-key="notifications">Notifications</span>
            </a>

            <a class="darklight" href="search.php">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="17" height="17"><path d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z"/></svg>
                </span>
                <span data-key="search">Explore</span>
            </a>

            <a class="darklight" href="stat.php">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" fill="currentColor" class="bi bi-star not_loved" viewBox="0 0 24 24" width="17" height="17"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"></path></svg>
                </span>
                <span data-key="stats">Stats</span>
            </a>

            <a class="darklight" href="text.php">
                <span class="icon">
                   <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 -0.5 24 24" width="17" height="17"><path d="M12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"></path><path d="M21.294,13.9l-.444-.256a9.1,9.1,0,0,0,0-3.29l.444-.256a3,3,0,1,0-3-5.2l-.445.257A8.977,8.977,0,0,0,15,3.513V3A3,3,0,0,0,9,3v.513A8.977,8.977,0,0,0,6.152,5.159L5.705,4.9a3,3,0,0,0-3,5.2l.444.256a9.1,9.1,0,0,0,0,3.29l-.444.256a3,3,0,1,0,3,5.2l.445-.257A8.977,8.977,0,0,0,9,20.487V21a3,3,0,0,0,6,0v-.513a8.977,8.977,0,0,0,2.848-1.646l.447.258a3,3,0,0,0,3-5.2Zm-2.548-3.776a7.048,7.048,0,0,1,0,3.75,1,1,0,0,0,.464,1.133l1.084.626a1,1,0,0,1-1,1.733l-1.086-.628a1,1,0,0,0-1.215.165,6.984,6.984,0,0,1-3.243,1.875,1,1,0,0,0-.751.969V21a1,1,0,0,1-2,0V19.748a1,1,0,0,0-.751-.969A6.984,6.984,0,0,1,7.006,16.9a1,1,0,0,0-1.215-.165l-1.084.627a1,1,0,1,1-1-1.732l1.084-.626a1,1,0,0,0,.464-1.133,7.048,7.048,0,0,1,0-3.75A1,1,0,0,0,4.79,8.992L3.706,8.366a1,1,0,0,1,1-1.733l1.086.628A1,1,0,0,0,7.006,7.1a6.984,6.984,0,0,1,3.243-1.875A1,1,0,0,0,11,4.252V3a1,1,0,0,1,2,0V4.252a1,1,0,0,0,.751.969A6.984,6.984,0,0,1,16.994,7.1a1,1,0,0,0,1.215.165l1.084-.627a1,1,0,1,1,1,1.732l-1.084.626A1,1,0,0,0,18.746,10.125Z"></path></svg>
                </span>
                <span data-key="edit">Settings</span>
            </a>

            <a class="darklight" href="logout.php">
                <span class="icon">
                    <i class="ri-logout-box-line"></i>
                </span>
                <span data-key="logout">Logout</span>
            </a>

            <a href="profile.php?user=<?php echo $d; ?>"><div style=" position: absolute; bottom: 0; width: 90%; padding: 6px; margin-bottom: 9px; border-radius: 10px;" class="post-info colors">
                    <div style=" border: solid 0px;" class="post-img">
                        <img style="width: 26px; height: 26px; object-fit: cover; border-radius: 50%; border: solid 0px;" src="perfiles/'.$usuario['imagen'].'" alt="profile">
                    </div>
                    <h5><?php echo $d; ?></h5>
                </div></a>
        </div>

    </div>
    <!-- Main Home -->
   <div class= "main-home">
   
        <div style="flex-direction: column; justify-content: center; align-items: center; color: white; position: fixed; top: 0; left: 0; z-index: 100; width: 100%; height: 32px;" class="glass-effect mass tows">
        <style>
        /* Estilos generales para el fondo */
        /* Efecto cristal */
        .glass-effect {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2); /* Borde semi-transparente */
        }
        
         @media only screen and (max-width: 768px) {
    .glass-effect {
            border-bottom: 0px solid rgba(255, 255, 255, 0.2); /* Borde semi-transparente */
        }
    }

        /* Estilos para el contenido dentro del div */
        .glass-effect h2 {
            font-size: 24px;
            margin-bottom: 0px;
        }

        .glass-effect p {
            font-size: 16px;
            line-height: 1.5;
            text-align: center;
        }
    </style>
    </div>
        <div style="border-bottom: 1px #80808021 solid; margin-top: 26px;" class="header tows">
            <!-- search -->
            <style>
            .pl{
            display: none;
        }
        @media (min-width: 768px) {
            .pl{
                display: block;
}
        }
        .pl2{
            display: block;
        }
        @media (min-width: 768px) {
            .pl2{
                display: none;
}
        }
    </style>
            <img class="pl2" style="width: 35px;" src="logo.png" alt="logo">
            <a class="pl" href="search.php"><div class="search colors">
                <svg  class="darklight" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="24" height="24"><path d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z"/></svg>
                <input type="text" name="" id="" placeholder="Search">
            </div></a>

            <div class="header-content">
                
                
                <!-- Button -->
                <a style="margin-right:5px; justify-content: center; align-items: center; padding:0px; background-color:transparent;" href="share.php">         
                    <svg style="margin-top:8px; background-color:transparent" class="tows" xmlns="http://www.w3.org/2000/svg" id="Layer_1" width="21" height="21" viewBox="0 0 24 24" data-name="Layer 1"><path d="m12 0a12 12 0 1 0 12 12 12.013 12.013 0 0 0 -12-12zm0 22a10 10 0 1 1 10-10 10.011 10.011 0 0 1 -10 10zm5-10a1 1 0 0 1 -1 1h-3v3a1 1 0 0 1 -2 0v-3h-3a1 1 0 0 1 0-2h3v-3a1 1 0 0 1 2 0v3h3a1 1 0 0 1 1 1z"></path></svg>
                </a>
            </div>
    
        </div>
        <br>
         <div class="pm">
        
        
        <div class="feed">
               
                <div class="feed-text">
                    
                </div>
        </div>
        <div  class="main-post3">
        <form class="nkp" id="comment-form" style="border-radius:25px; padding: 9px 12px;width:100%;background-color: transparent;" method="POST">
        <div style="margin-bottom: 12px; width: 100%;" class="search colors dark-mode">

              
        <input style="display:none;" name="perfil" value="perfiles/'.$usuario["imagen"].'">
        <input style="display:none;" name="nombre" value="'.$dato->nombre.'">
        <input style="display:none;" name="clave" value="<?php echo $d ?>">
        <input class="darklight dark-mode" id="ff" style="width: 90%; margin-left:7px; margin-top:1px; background-color:transparent; padding:0px; font-size:15px; border-radius:0px;" autocomplete="off" required="" type="text" name="texto" placeholder="Aあ...">
        <button id="dd" style="background-color: transparent; border:solid 0px; width:23px; height:38px; margin-right:-16px;" class="dropdown-btn transparent-btn" type="submit" title="More info">
        <r style=""><svg fill="rgb(26 155 239)" xmlns="http://www.w3.org/2000/svg" id="mySvg" data-name="Layer 1" viewBox="0 0 24 24" width="19" height="19"><path d="m4.173,13h19.829L4.201,23.676c-.438.211-.891.312-1.332.312-.696,0-1.362-.255-1.887-.734-.84-.77-1.115-1.905-.719-2.966l.056-.123,3.853-7.165Zm-.139-12.718C2.981-.22,1.748-.037.893.749.054,1.521-.22,2.657.18,3.717l3.979,7.283h19.841L4.11.322l-.076-.04Z"></path></svg></r>         
        </button>
        </div>
        </form>
        
        <script>
    const input = document.getElementById("ff");
    const svgIcon = document.getElementById("mySvg"); // SVG con el ID específico

    // Función para verificar palabras largas y agregar un espacio
    input.addEventListener("input", function () {
        const words = input.value.split(" ");
        const newWords = words.map(word => {
            if (word.length > 25) {
                // Si la palabra tiene más de 25 caracteres, divide la palabra
                return word.slice(0, 25) + " " + word.slice(25);
            }
            return word;
        });
        
        input.value = newWords.join(" ");

        // Mostrar el SVG solo si el input tiene texto
        if (input.value.trim().length > 0) {
            svgIcon.style.display = "block";
        } else {
            svgIcon.style.display = "none";
        }
    });
</script>
        <style>
        #ff {
            
        }
        #mySvg {
            display: none; /* SVG oculto inicialmente */
        }
        .pm{
            padding: 20px;    
            }
        @media screen and (max-width: 736px){
            .pm{
                padding: 0px;
            }
        }
        .tweet-container {

            width: 100%;

            margin-bottom: 0px;

            border-bottom: 0px solid #e1e8ed73;

            border-radius: 0px;

            padding: 15px;
    word-wrap: break-word; /* Esto asegura que el texto largo se ajuste al contenedor */

            overflow-wrap: break-word; /* Para compatibilidad adicional */

        }

.profile-pic {
    max-width: 40px;
    max-height: 40px;
    min-width: 40px;
    min-height: 40px;
    border-radius: 50%;
    float: left;
    margin-right: 10px;
}

.tweet-header {
    display: flex;
    flex-direction: row; /* Para que la imagen y el texto estén en la misma línea */
    align-items: flex-start; /* Alinear el contenido en la parte superior */
}

.tweet-details {
    display: flex;
    flex-direction: column; /* Para colocar el nombre de usuario y el handle en columnas */
}

.user-name {
    font-weight: bold;
    font-size: 15px;
    color: #D9D9D9; /* Texto principal claro */
    display: inline; /* Para que el nombre esté en la misma línea que el handle */
}

.user-handle, .tweet-time {
    color: #8899A6; /* Color de texto gris para los detalles secundarios */
    font-size: 13px;
    font-weight: 400;
    margin-right: 5px;
    display: inline; /* Aparecen en la misma línea que el nombre */
}

.tweet-time {
    margin-left: 5px; /* Un poco de espacio antes de la hora */
}

.tweet-text {
    font-size: 14px;
    color: #E1E8ED; /* Color del texto del tweet */
    margin-top: 5px; /* Un poco de espacio encima del texto */
}

.tweet-image {
    width: 100%;
    border-radius: 10px; /* Bordes redondeados para la imagen del tweet */
    margin-top: 10px; /* Espacio entre el texto y la imagen */
}

.clearfix {
    clear: both;
}

.modal-title {
  margin-bottom: 0;
  line-height: var(--#{$prefix}modal-title-line-height);
}

// Modal body
// Where all modal content resides (sibling of .modal-header and .modal-footer)
.modal-body {
  position: relative;
  // Enable `flex-grow: 1` so that the body take up as much space as possible
  // when there should be a fixed height on `.modal-dialog`.
  flex: 1 1 auto;
  padding: var(--#{$prefix}modal-padding);
}

// Footer (for actions)
.modal-footer {
  display: flex;
  flex-shrink: 0;
  flex-wrap: wrap;
  align-items: center; // vertically center
  justify-content: flex-end;
  padding: calc(var(--#{$prefix}modal-padding) - var(--#{$prefix}modal-footer-gap) * .5);
  background-color: var(--#{$prefix}modal-footer-bg);
  border-top: var(--#{$prefix}modal-footer-border-width) solid var(--#{$prefix}modal-footer-border-color);
  @include border-bottom-radius(var(--#{$prefix}modal-inner-border-radius));

  // Place margin between footer elements
  // This solution is far from ideal because of the universal selector usage,
  // but is needed to fix https://github.com/twbs/bootstrap/issues/24800
  > * {
    margin: calc(var(--#{$prefix}modal-footer-gap) * .5); // Todo in v6: replace with gap on parent class
  }
}

// Scale up the modal
@include media-breakpoint-up(sm) {
  .modal {
    --#{$prefix}modal-margin: #{$modal-dialog-margin-y-sm-up};
    --#{$prefix}modal-box-shadow: #{$modal-content-box-shadow-sm-up};
  }

  
  .modal-dialog {
    max-width: var(--#{$prefix}modal-width);
    margin-right: auto;
    margin-left: auto;
  }

  .modal-sm {
    --#{$prefix}modal-width: #{$modal-sm};
  }
}

@include media-breakpoint-up(lg) {
  .modal-lg,
  .modal-xl {
    --#{$prefix}modal-width: #{$modal-lg};
  }
}

@include media-breakpoint-up(xl) {
  .modal-xl {
    --#{$prefix}modal-width: #{$modal-xl};
  }
}

// scss-docs-start modal-fullscreen-loop
@each $breakpoint in map-keys($grid-breakpoints) {
  $infix: breakpoint-infix($breakpoint, $grid-breakpoints);
  $postfix: if($infix != "", $infix + "-down", "");

  @include media-breakpoint-down($breakpoint) {
    .modal-fullscreen#{$postfix} {
      width: 100vw;
      max-width: none;
      height: 100%;
      margin: 0;

      .modal-content {
        height: 100%;
        border: 0;
        @include border-radius(0);
      }

      .modal-header,
      .modal-footer {
        @include border-radius(0);
      }

      .modal-body {
        overflow-y: auto;
      }
    }
  }
}
.comments{
    .comment{
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        color: #262626;
        
        button{
            font-size: 12px;
            color:$gray-color;
            background-color: transparent;
            border: none;
        }
        .img{
            margin-right: 10px;
            img{
                border-radius: 30px;
                width: 32px;
                height: 32px;
            }
        }
        .content{
            .person{
                display: flex;
                align-items: baseline;
                h4{
                    font-size: 14px;
                    margin: 0;
                }
                span{
                    margin-left: 10px;
                    font-size: 14px;
                    color: $gray-color;
                }
            }
            p{
                margin: 0;
                font-size: 14px;
            }
            .replay{
                display: flex;
                align-items: baseline;
                margin-bottom: 5px;
                button{
                    margin-right: 10px;
                }
            }
            .answers{
                button{
                    display: flex;
                    align-items: center;
                    span{
                        padding: 0 4px;
                    }
                    span.line{
                        padding: 1px 20px;
                        font-size: 1.5px;
                        margin-right: 5px;
                        background-color: $gray;
                    }
                }
            }
        }
        .like{
            display: flex;
            flex-direction: column;
            float: right;
            align-items: center;
            justify-content: end;
            img{
                width: 16px;
                height: 16px;
            }
            p{
                margin: 0;
            }
        }
    }
    .responses{
        margin: 1em 0 1em 1em;
    }
}

    </style>
    <br><br>
            <!--Box 1-->
            <?php
            $ttt = "'.$d.'";
            $searchQuery = isset($_GET["q"]) ? $_GET["q"] : "";
            $filename = "time='.$dato->id.'" . ".json";
            $datos = array();
            
            if (file_exists($filename)) {
                $json_data = file_get_contents($filename);
                $datos = json_decode($json_data, true);
            }
            
            if (!empty($searchQuery)) {
    $datos = array_filter($datos, function ($dato) use ($searchQuery) {
        // Concatenar clave y tiempo con un guion bajo y buscar en esa cadena
        $combinedString = $dato["clave"] . "_" . $dato["tiempo"];
        return strpos($combinedString, $searchQuery) !== false;
    });
}
            
            // Ordenar los datos: poner los comentarios con clave "vanne" primero y los demás al azar
            usort($datos, function ($a, $b) use ($ttt) {
                if ($a["clave"] === \'$ttt\' && $b["clave"] !== \'$ttt\') {
                    return -1; // $a viene antes que $b
                } elseif ($b["clave"] === \'$ttt\' && $a["clave"] !== \'$ttt\') {
                    return 1; // $b viene antes que $a
                } else {
                    // Si ninguno de los dos elementos tiene la clave "vanne", ordénalos aleatoriamente
                    return rand(-1, 1);
                }
            }
            );
            ?>
            <?php foreach ($datos as $dato) : ?>
            <div class="tweet-container">
            <div class="tweet-header">
                <a href="@<?php echo $dato["clave"]; ?>.php"><img style="border:1px solid #cccccc30; object-fit:cover;" class="profile-pic" src="perfiles/<?php

                $clave = $dato["clave"];
                // Obtener el contenido del archivo JSON
                $json = file_get_contents("usuarios.json");
                // Decodificar el JSON en un array de PHP
                $data = json_decode($json, true);
                
                // Acceder a los datos de la cadena específica
                $cadena = $data[$clave];
                
                // Verificar si la cadena tiene el campo "imagen"
                if (isset($cadena["imagen"])) {
                    echo $cadena["imagen"];
                }
                ?>" alt="Foto de perfil"></a>
                <div>
                    <div class="content"><a href="@<?php echo $dato["clave"]; ?>.php">
                            <div class="person">
                                <h4><span style="background-color: transparent;" class="user-name tows"><?php

                    $clave = $dato["clave"];
                    // Obtener el contenido del archivo JSON
                    $json = file_get_contents("usuarios.json");
                    // Decodificar el JSON en un array de PHP
                    $data = json_decode($json, true);
                    
                    // Acceder a los datos de la cadena específica
                    $cadena = $data[$clave];
                    
                    // Verificar si la cadena tiene el campo "imagen"
                    if (isset($cadena["nombre_completo"])) {
                        echo $cadena["nombre_completo"];
                    }
                    ?><?php
// Cargar el contenido del archivo verificado.json
$verificados_json = file_get_contents("verificado.json");

// Decodificar el JSON en un array asociativo
$verificados_data = json_decode($verificados_json, true);


// Verificar si el valor de $d está en la lista de verificados
if (in_array($dato["clave"], $verificados_data["verificados"])) {
    // Si $d está verificado, mostrar el SVG
    echo \'<svg style="margin-left: 4px; margin-bottom: -1.2px;" width="12" height="12" fill="#03a9f4" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="m23.126,9.868h0l-2.151-2.154v-1.718c0-1.651-1.342-2.995-2.991-2.995h-1.716l-2.151-2.153c-1.131-1.131-3.101-1.131-4.231,0l-2.151,2.153h-1.716c-1.65,0-2.991,1.343-2.991,2.995v1.718l-2.152,2.154c-1.165,1.168-1.165,3.067,0,4.235l2.151,2.154v1.718c0,1.651,1.342,2.995,2.991,2.995h1.716l2.151,2.153c.565.565,1.317.877,2.116.877s1.55-.312,2.115-.877l2.151-2.153h1.716c1.65,0,2.991-1.343,2.991-2.995v-1.718l2.152-2.154c1.165-1.168,1.165-3.067,0-4.235Zm-4.922.343l-5.054,4.995c-.614.61-1.423.916-2.231.916s-1.613-.305-2.229-.913l-2.599-2.499c-.392-.389-.396-1.021-.007-1.414.39-.391,1.021-.396,1.415-.007l2.598,2.498c.453.449,1.19.45,1.644,0l5.055-4.996c.394-.39,1.026-.386,1.415.007s.385,1.025-.007,1.414Z"/>
  </svg>\';
} else {
    // Si no está verificado, mostrar un mensaje o SVG alternativo
    echo \'\';
}
?>

<?php
// Cargar el contenido del archivo verificado.json
$verificados_json = file_get_contents("emp.json");

// Decodificar el JSON en un array asociativo
$verificados_data = json_decode($verificados_json, true);


// Verificar si el valor de $d está en la lista de verificados
if (in_array($dato["clave"], $verificados_data["verificados"])) {
    // Si $d está verificado, mostrar el SVG
    echo \'<svg style="margin-left: 4px; margin-bottom: -1.2px;" width="12" height="12" fill="red" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="m23.126,9.868h0l-2.151-2.154v-1.718c0-1.651-1.342-2.995-2.991-2.995h-1.716l-2.151-2.153c-1.131-1.131-3.101-1.131-4.231,0l-2.151,2.153h-1.716c-1.65,0-2.991,1.343-2.991,2.995v1.718l-2.152,2.154c-1.165,1.168-1.165,3.067,0,4.235l2.151,2.154v1.718c0,1.651,1.342,2.995,2.991,2.995h1.716l2.151,2.153c.565.565,1.317.877,2.116.877s1.55-.312,2.115-.877l2.151-2.153h1.716c1.65,0,2.991-1.343,2.991-2.995v-1.718l2.152-2.154c1.165-1.168,1.165-3.067,0-4.235Zm-4.922.343l-5.054,4.995c-.614.61-1.423.916-2.231.916s-1.613-.305-2.229-.913l-2.599-2.499c-.392-.389-.396-1.021-.007-1.414.39-.391,1.021-.396,1.415-.007l2.598,2.498c.453.449,1.19.45,1.644,0l5.055-4.996c.394-.39,1.026-.386,1.415.007s.385,1.025-.007,1.414Z"/>
  </svg>\';
} else {
    // Si no está verificado, mostrar un mensaje o SVG alternativo
    echo \'\';
}
?></span>
                    <span style="color: rgb(26 155 239); font-weight: 500;" class="user-handle"> · @<?php echo $dato["clave"]; ?></span>
                    <span class="tweet-time"></span></h4>
                                
                            </div>
                            </a>
                            <a href=\'?q=<?php echo $dato["clave"]; ?>_<?php echo $dato["tiempo"]; ?>\'><button style="background-color: transparent; padding: 0px; font-size: 16px; cursor: pointer; margin: 0px; border: none; border-radius: 30px;" class="translation"><p><div style="text-align: left; background-color: transparent;" class="tows tweet-text">
            <?php echo $dato["texto"]; ?>
            </div></p></button></a>
                             <a href=\'?q=<?php echo $dato["clave"]; ?>_<?php echo $dato["tiempo"]; ?>\'><img style=\'<?php
if (!empty($dato["img"])) {
    echo "display:block; width:100%; border-radius:10px;";
} else {
    echo "display:none;";
}
?>\' src=\'<?php echo $dato["img"]; ?>\' alt="Imagen"></a>
<br>
                            <p class="tweet-time"><?php
// Comprobamos si $dato["tiempo"] está definido y es válido
if (isset($dato["tiempo"])) {
    try {
        // Fecha y hora actuales
        $now = new DateTime();

        // Fecha y hora del evento o punto en el tiempo
        $pastDate = new DateTime($dato["tiempo"]); // Asegúrate de que esté en formato compatible (YYYY-MM-DD HH:MM:SS)

        // Diferencia entre ambas fechas
        $interval = $now->diff($pastDate);

        // Lógica para determinar la unidad de tiempo más adecuada
        if ($interval->y > 0) {
            $tiempo = $interval->y . " a";
        } elseif ($interval->m > 0) {
            $tiempo = $interval->m . " m";
        } elseif ($interval->d >= 7) {
            $weeks = floor($interval->d / 7);
            $tiempo = $weeks . " s";
        } elseif ($interval->d > 0) {
            $tiempo = $interval->d . " d";
        } elseif ($interval->h > 0) {
            $tiempo = $interval->h . " h";
        } elseif ($interval->i > 0) {
            $tiempo = $interval->i . " min";
        } else {
            $tiempo = "0"; // En caso de que no haya pasado nada de tiempo
        }

        // Imprime el resultado
        echo $tiempo;

    } catch (Exception $e) {
        // En caso de error (por ejemplo, formato de fecha incorrecto)
        echo "0 n";
    }
} else {
    // Si no se proporciona $dato["tiempo"]
    echo "null";
}
?>
</p>

<a href=\'?q=<?php echo $dato["clave"]; ?>_<?php echo $dato["tiempo"]; ?>\'><p data-key="views" class="tweet-time">
views</p></a>

<a onclick="copiarEnlace(this)" data-enlace="https://vinlart.com/Comment_'.$dato->id.'?q=<?php echo $dato["clave"]; ?>_<?php echo $dato["tiempo"]; ?>" id="link1"><p data-key="share" class="tweet-time">
share</p></a>
                            <div class="answers">
                               
                            </div>
                        </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <?php endforeach; ?>
<script>
    function copiarEnlace(button) {
        // Obtener el enlace del atributo data del botón
        const enlace = button.getAttribute("data-enlace");
        
        // Crear un elemento temporal para copiar el enlace
        const tempInput = document.createElement("input");
        tempInput.value = enlace;
        document.body.appendChild(tempInput);
        
        // Seleccionar el texto del input
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // Para dispositivos móviles

        // Copiar el texto seleccionado al portapapeles
        document.execCommand("copy");

        // Eliminar el elemento temporal
        document.body.removeChild(tempInput);

        // Opcional: mostrar un mensaje de confirmación
        alert(`Copy: ${enlace}`);
    }
</script>

        <br><br><br><br><br>
        
        <?php
if(isset($_POST["texto"])) {
    date_default_timezone_set("America/Mexico_City");
    setlocale(LC_ALL, "es_ES");
    $perfil = $_POST["perfil"];
    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];
    $tiempo = date("Y-m-d H:i:s", strtotime(date_default_timezone_get()));

    $img = "";
    if(isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
        $img_dir = "comment/";
        if(!is_dir($img_dir)) {
            mkdir($img_dir, 0777, true); // Crea la carpeta si no existe
        }

        $img_name = basename($_FILES["img"]["name"]);
        $img_path = $img_dir . $img_name;
        if(move_uploaded_file($_FILES["img"]["tmp_name"], $img_path)) {
            $img = $img_path; // Guarda la ruta de la imagen si se sube correctamente
        }
    }

    $datos = "time='.$dato->id.'"; // Nombre de archivo basado en el tiempo actual
    $filename = $datos . ".json";

    // Leer o crear el archivo JSON
    if(file_exists($filename)) {
        $json_data = file_get_contents($filename);
        $data = json_decode($json_data, true);
    } else {
        $data = array();
    }

    // Crear un nuevo dato para el JSON
    $nuevo_dato = array(
        "nombre" => $nombre,
        "clave" => $clave,
        "perfil" => $perfil,
        "texto" => $_POST["texto"],
        "img" => $img, // Incluye la ruta de la imagen
        "tiempo" => $tiempo
    );

    array_push($data, $nuevo_dato);

    // Guardar los datos en el archivo JSON
    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    
    if(file_put_contents($filename, $json_data)) {
        echo "<script>
        setTimeout(function() {
            window.history.back();
        }, 10);
        </script>";
    } else {
        echo "";
    }
}
?>

<style>
.nkp {
  display: block;
}
@media screen and (max-width: 600px) {

  .nkp {
     display: none;
  }
  
  }
  </style>
        </div>
        </div>
    </div>
    
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("carga").style.display = "block";
    });

    window.addEventListener("load", function() {
        document.getElementById("carga").style.display = "block";
    });
</script>

<div id="carga" style="display: none;">
    <div style="border-bottom:1px #80808000 solid; text-align: left; position: fixed; bottom: 35px;" class="tabs_bottom tows">
        
    <div class="tab2 tows" style="text-align: left; border-bottom: 3px solid #03a9f400;" onclick="openTab()">
    <form id="comment-form" style="border-radius:25px; padding: 1px 11px 6px 11px;width:100%;background-color: transparent;" method="POST" enctype="multipart/form-data">
              
    <input style="display:none;" name="perfil" value="perfiles/'.$usuario["imagen"].'">
    <input style="display:none;" name="nombre" value="'.$dato->nombre.'">
    <input style="display:none;" name="clave" value="<?php echo $d ?>"> 
    
    
    <div style="border-radius:30px; padding-top: 2px; padding-bottom: 4px; padding-right: 17px; padding-left: 17px; background-color:transparent;" class="nav_xm">
    <div class="dropdown">
       <div style="margin-left: -21px; border-radius:100px; position:absolute;" class="img">
                                <img style="border-radius:50%; width:24px; height:24px; object-fit: cover;" src="perfiles/<?php echo $usuario[\'imagen\'] ?>" alt="">
                            </div>
       <?php
    
    // Verificar si el usuario ha iniciado sesión o si se ha almacenado una cookie de sesión
    if (3 == 3) {
        // Si el usuario ha iniciado sesión o tiene una cookie de sesión, mostrar un saludo
        echo "";
    
        // Puedes agregar un enlace para cerrar sesión si es necesario
        echo \'<input class="darklight" id="ftt" style="border: solid 1px transparent; width: 90%; margin-left:7px; margin-top:1px; background-color:transparent; padding:0px; font-size:15px; border-radius:0px;" autocomplete="off" type="text" name="texto" placeholder="Aあ...">
       
    </div>
    <div class="left">
    
    

    
    <div style="border-top:0px #80808000 solid;" class="tabs_bottom tows light-mode">
        <div class="tab2 tows light-mode" style="border-bottom: 3px solid #03a9f400;" onclick="openTab()"><a id="dd" style="margin-top: 2.3px; background-color: transparent;border:solid 0px;width:23px;height:23px;margin-right: 1px;" class="dropdown-btn transparent-btn" onclick="openModal()" title="More info">
    <r style=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#03a9f4" style="color:#03a9f4; margin-top: 0px; fill:#03a9f4;" class="bi bi-camera-video" viewBox="0 0 16 16">
        <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"></path>
      </svg></r>         
    </a></div>
        <div class="tab2 tows light-mode" style="border-bottom: 3px solid #03a9f400; text-align: left;" onclick="openTab()"><button id="dd" style="background-color: transparent; border:solid 0px; margin-top: 0px; padding: 0px;" class="dropdown-btn transparent-btn" type="submit" title="More info">
    <r style=""><svg fill="rgb(26 155 239)" xmlns="http://www.w3.org/2000/svg" id="up" data-name="Layer 1" viewBox="0 0 24 24" width="19" height="19"><path d="m4.173,13h19.829L4.201,23.676c-.438.211-.891.312-1.332.312-.696,0-1.362-.255-1.887-.734-.84-.77-1.115-1.905-.719-2.966l.056-.123,3.853-7.165Zm-.139-12.718C2.981-.22,1.748-.037.893.749.054,1.521-.22,2.657.18,3.717l3.979,7.283h19.841L4.11.322l-.076-.04Z"/></svg>
    
    <svg xmlns="http://www.w3.org/2000/svg" id="loadingSvg" class="loading-icon" fill="rgb(26, 155, 239)" height="19" viewBox="0 0 24 24" width="19" data-name="Layer 1"><path d="m13 1v2a1 1 0 0 1 -2 0v-2a1 1 0 0 1 2 0zm-1 19a1 1 0 0 0 -1 1v2a1 1 0 0 0 2 0v-2a1 1 0 0 0 -1-1zm-8-8a1 1 0 0 0 -1-1h-2a1 1 0 0 0 0 2h2a1 1 0 0 0 1-1zm19-1h-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2zm-4.982-9.382a1 1 0 0 0 -1.367.364l-1 1.731a1 1 0 0 0 .365 1.366.987.987 0 0 0 .5.135 1 1 0 0 0 .866-.5l1-1.731a1 1 0 0 0 -.364-1.365zm-10.031 17.303a1 1 0 0 0 -1.366.364l-1 1.731a1 1 0 0 0 .364 1.366.989.989 0 0 0 .5.135 1 1 0 0 0 .867-.5l1-1.731a1 1 0 0 0 -.365-1.365zm-3.272-12.3-1.731-1a1 1 0 0 0 -1 1.731l1.731 1a1 1 0 0 0 1-1.731zm17.3 10.03-1.731-1a1 1 0 0 0 -1 1.731l1.731 1a.987.987 0 0 0 .5.135 1 1 0 0 0 .5-1.866zm-14.666-14.669a1 1 0 0 0 -1.731 1l1 1.731a1 1 0 0 0 .866.5.987.987 0 0 0 .5-.135 1 1 0 0 0 .365-1.366zm10.03 17.3a1 1 0 0 0 -1.731 1l1 1.731a1 1 0 0 0 1.731-1zm2.408-10.8a1 1 0 0 0 .5-.134l1.731-1a1 1 0 0 0 -1-1.731l-1.731 1a1 1 0 0 0 .5 1.865zm-16.074 7.166-1.731 1a1 1 0 0 0 .5 1.866.987.987 0 0 0 .5-.135l1.731-1a1 1 0 0 0 -1-1.731z"/></svg>
    </r>         
    </button></div>
        <div class="tab2 tows light-mode" style="border-bottom: 3px solid #00000000;" onclick="openTab()"></div>
        <div class="tab2 tows light-mode" style="border-bottom: 3px solid #00000000;" onclick="openTab()"></div>
        <div class="tab2 tows light-mode" style="border-bottom: 3px solid #00000000; text-align: center;" onclick="openTab()"></div>
    </div>
    
    
    <div id="modalbottom" class="modalbottom tows">
        <!-- Contenido del modal -->
        <center><div style="width:32px; height:3.5px; border-radius:20px; background-color:#cccc;"></div></center>
        
       <style>
        /* Add a blue border to the selected image */
        .item_img.selected {
          border: 2.4px solid #03A9F4;
        }
      </style>
        <h2 style="font-size:19px;">Gif wall</h2>
        <div class="chat-box" id="chat-box">
        <table style="width:100%;">
        <tr>
          <td>
          <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        /* Ocultar el input de archivo */
        #imageInput {
            display: none;
        }

        /* Estilos para el contenedor de previsualización */
        .preview {
            margin-top: 10px;
            display: none;
            flex-direction: column;
            align-items: center;
        }

        .preview img {
            width: 100%;
            border-radius: 10px;
            border: 0px solid #ccc;
            padding: 0px;
        }

        .remove-btn {
            margin-top: 10px;
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            display: none; /* Botón oculto inicialmente */
        }

        /* Estilos del SVG como botón */
        .upload-svg {
            cursor: pointer;
            width: 50px;
            height: 50px;
            fill: #007bff;
            transition: fill 0.3s ease;
        }

        .upload-svg:hover {
            fill: #0056b3;
        }
        
        #up {
            
            display: none; /* SVG oculto inicialmente */
        }
        
        .loading-icon {
            animation: spin 1s linear infinite; /* Animación de rotación */
        }
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        /* Ocultar el SVG de carga por defecto */
        #loadingSvg {
            display: none;
        }
    </style>
          <div class="container">
    <input type="file" id="imageInput" name="img" accept="image/*">
    
    <!-- SVG como botón de subida -->
    <center><svg style="margin-top: -1px;" width="26" height="26" fill="#03a9f4" xmlns="http://www.w3.org/2000/svg" id="uploadIcon" class="upload-svg" data-name="Layer 1" viewBox="0 0 24 24">
  <path d="m12,21c0,.553-.448,1-1,1h-6c-2.757,0-5-2.243-5-5V5C0,2.243,2.243,0,5,0h12c2.757,0,5,2.243,5,5v6c0,.553-.448,1-1,1s-1-.447-1-1v-6c0-1.654-1.346-3-3-3H5c-1.654,0-3,1.346-3,3v6.959l2.808-2.808c1.532-1.533,4.025-1.533,5.558,0l5.341,5.341c.391.391.391,1.023,0,1.414-.195.195-.451.293-.707.293s-.512-.098-.707-.293l-5.341-5.341c-.752-.751-1.976-.752-2.73,0l-4.222,4.222v2.213c0,1.654,1.346,3,3,3h6c.552,0,1,.447,1,1ZM15,3.5c1.654,0,3,1.346,3,3s-1.346,3-3,3-3-1.346-3-3,1.346-3,3-3Zm0,2c-.551,0-1,.448-1,1s.449,1,1,1,1-.448,1-1-.449-1-1-1Zm8,12.5h-3v-3c0-.553-.448-1-1-1s-1,.447-1,1v3h-3c-.552,0-1,.447-1,1s.448,1,1,1h3v3c0,.553.448,1,1,1s1-.447,1-1v-3h3c.552,0,1-.447,1-1s-.448-1-1-1Z"></path>
</svg></center>
    
    

    <div class="preview" id="previewContainer">
        <img id="imagePreview" src="#" alt="Previsualización de la imagen">
        <button class="remove-btn" data-key="delete" id="removeBtn">Quitar</button>
    </div>
</div>




<script>
    const imageInput = document.getElementById("imageInput");
    const uploadIcon = document.getElementById("uploadIcon");
    const previewContainer = document.getElementById("previewContainer");
    const imagePreview = document.getElementById("imagePreview");
    const removeBtn = document.getElementById("removeBtn");

    // Activar el input de archivo cuando se hace clic en el SVG
    uploadIcon.addEventListener("click", function() {
        imageInput.click();
    });

    // Mostrar la previsualización de la imagen cuando se selecciona
    imageInput.addEventListener("change", function() {
        const file = this.files[0];
        
        // Validar si el archivo es una imagen
        const allowedTypes = ["image/jpeg", "image/png", "image/gif"];
        if (file) {
            if (allowedTypes.includes(file.type)) {
                const reader = new FileReader();
                previewContainer.style.display = "flex"; // Mostrar el contenedor de previsualización
                reader.onload = function(event) {
                    imagePreview.setAttribute("src", event.target.result);
                    uploadIcon.style.display = "none"; // Ocultar el icono SVG
                    removeBtn.style.display = "block"; // Mostrar el botón de eliminar
                }
                reader.readAsDataURL(file);
            } else {
                // Mostrar alerta si el archivo no es una imagen
                alert("Error: Solo se permiten archivos de imagen (JPG, PNG, GIF).");
                imageInput.value = ""; // Limpiar el input de archivo
            }
        }
    });

    // Función para quitar la imagen seleccionada
    removeBtn.addEventListener("click", function() {
        imageInput.value = ""; // Limpiar el input de archivo
        previewContainer.style.display = "none"; // Ocultar la previsualización
        imagePreview.setAttribute("src", "#"); // Restablecer la imagen de previsualización
        removeBtn.style.display = "none"; // Ocultar el botón de quitar
        uploadIcon.style.display = "block"; // Volver a mostrar el icono SVG
    });
</script></td>
          <td><img style="width:100%; min-height:190px; max-height:190px; object-fit:cover; margin-left: 0px; padding:3px;" class="img-fluid item_img gh" src="" alt=""></td>
        </tr>
        
       
      </table>
        <script>
        // Get all images with the class "item_img"
        const images = document.querySelectorAll(".item_img");
    
        // Add click event listeners to each image
        images.forEach((image) => {
          image.addEventListener("click", () => {
            // Remove the "selected" class from all images
            images.forEach((img) => {
              img.classList.remove("selected");
            });
    
            // Add the "selected" class to the clicked image
            image.classList.add("selected");
    
            // Update the input field with the src of the selected image
            document.getElementById("selectedImageSrc").value = image.src;
          });
        });
      </script>
      </div>
        <!-- Botón de cierre del modal -->
      </div>
    <script>
      var startY; // Variable para almacenar la posición inicial del deslizamiento
      var startTime; // Variable para almacenar el tiempo inicial del deslizamiento
    
      // Función para mostrar el modal
      function openModal() {
        var modal = document.getElementById("modalbottom");
        modal.style.display = "block";
      }
    
      // Función para cerrar el modal
      function closeModal() {
        var modal = document.getElementById("modalbottom");
        modal.style.transform = "translateY(100%)"; /* Desliza hacia abajo */
        // Espera a que termine la transición para ocultar el modal
        modal.addEventListener("transitionend", function(event) {
          if (event.propertyName === "transform" && modal.style.transform === "translateY(100%)") {
            modal.style.display = "none"; /* Oculta el modal después de la animación */
            modal.style.transform = ""; /* Reinicia la transformación para futuras aperturas */
          }
        });
      }
    
      // Evento para detectar el inicio del deslizamiento
      function touchStart(event) {
        // Guarda la posición inicial del deslizamiento y el tiempo inicial
        startY = event.touches[0].clientY;
        startTime = new Date().getTime();
      }
    
      // Evento para detectar el movimiento del deslizamiento
      function touchMove(event) {
        var modal = document.getElementById("modalbottom");
        var currentY = event.touches[0].clientY;
        var currentTime = new Date().getTime();
        var timeDiff = currentTime - startTime;
        var distance = currentY - startY;
        var speed = Math.abs(distance / timeDiff); // Calcula la velocidad del deslizamiento
    
        // Si la velocidad es mayor a 1.5px/ms, cierra el modal
        if (speed > 1.5) {
          closeModal();
        }
      }
    
      // Agrega los eventos touchstart, touchmove y touchend al modal
      var modal = document.getElementById("modalbottom");
      modal.addEventListener("touchstart", touchStart);
      modal.addEventListener("touchmove", touchMove);
    </script>
    
    
      <style>
      .chat-box {
          height: 320px;
          width:100%;
          padding: 0px;
          overflow-y: auto;
        }
        /* Estilos para el modal */
        #modalbottom {
          display: none; /* El modal está oculto inicialmente */
          position: fixed;
          bottom: 92px;
          left: 0;
          right: 0;
          box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.2); /* Sombra en la parte inferior */
          border-top-left-radius: 10px; /* Bordes redondeados arriba a la izquierda */
          border-top-right-radius: 10px; /* Bordes redondeados arriba a la derecha */
          padding: 15px;
          z-index: 1000;
          transition: transform 0.3s ease-out; /* Transición para el cierre */
        }
    
        /* Estilos para el botón de cierre */
        .close-btn {
          position: absolute;
          top: 10px;
          right: 10px;
          cursor: pointer;
        }
      </style>
      
    
    
     \';
    } else {
        // Si no ha iniciado sesión y no hay una cookie de sesión, mostrar un botón para registrarse
        echo \'<center><a style="background-color:transparent; color:black; padding:6px; border-radius:30px;" href="sign_up.php">Registrate para poder comentar</a></center>\';
    }
    ?>
    
    <style>
    #ff{
        border:solid 1px transparent;
    }
    #ff:hover{
        border-bottom:solid 1px transparent;
    }
    input:focus {
      outline: none; /* Elimina el borde de enfoque predeterminado */
      /* Agrega otros estilos que desees aplicar cuando el elemento está en enfoque */
    }
    botton:focus {
      outline: none; /* Elimina el borde de enfoque predeterminado */
      /* Agrega otros estilos que desees aplicar cuando el elemento está en enfoque */
    }
    #dd{
        color:gray;
    }
    #dd:hover{
        color:rgb(26 155 239);
    }
    </style>
        <a href="./notification.html">
            
        </a>
    
    </div>
    </div>
                            </form>
                            <script>
    const inputTextoFF = document.getElementById("ftt");
    const inputImagenFTT = document.getElementById("imageInput");
    const svgIconFTT = document.getElementById("up");
    const loadingSvg = document.getElementById("loadingSvg");

    function verificarLongitudTextoFF() {
        const palabrasFF = inputTextoFF.value.split(" ");
        const nuevasPalabrasFF = palabrasFF.map(palabra => {
            if (palabra.length > 25) {
                return palabra.slice(0, 25) + " " + palabra.slice(25);
            }
            return palabra;
        });
        inputTextoFF.value = nuevasPalabrasFF.join(" ");
    }

    function mostrarOcultarSvgFTT() {
        if (inputTextoFF.value.trim().length > 0 || inputImagenFTT.files.length > 0) {
            svgIconFTT.style.display = "block";
        } else {
            svgIconFTT.style.display = "none";
        }
    }

    // Cambiar al ícono de carga cuando se hace clic en el SVG
    svgIconFTT.addEventListener("click", () => {
        svgIconFTT.style.display = "none"; // Ocultar el SVG original
        loadingSvg.style.display = "block"; // Mostrar el SVG de carga

        // Simulación de proceso de carga con tiempo de espera
        setTimeout(() => {
            loadingSvg.style.display = "none"; // Ocultar el SVG de carga
            svgIconFTT.style.display = "block"; // Mostrar el SVG original
        }, 2000); // Cambia el tiempo en milisegundos según sea necesario
    });

    inputTextoFF.addEventListener("input", () => {
        verificarLongitudTextoFF();
        mostrarOcultarSvgFTT();
    });

    inputImagenFTT.addEventListener("change", mostrarOcultarSvgFTT);
</script>
    </div>
    </div>

    </div>
    
    <button style=" display: none;" id="toggleDarkMode">Toggle Dark Mode</button>
    <script src="dark.js"></script>
    </div>
</body>

</html>
    ';
    // Guardar el contenido en el archivo
    file_put_contents($nombre_archivo, $contenido_archivo);
}
?>
<?php
$archivo = "usuarios.json";
$datos = array();

if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $datos = json_decode($contenido);
}

if (isset($_POST['eliminar'])) {
    $id = $_POST['eliminar'];
    if (isset($datos->$id)) {
        unset($datos->$id);
    }

    $json_datos = json_encode($datos, JSON_PRETTY_PRINT);
    file_put_contents($archivo, $json_datos);

    header("Location: csc.php");
    exit();
}

if (isset($_GET['q'])) {
    $q = $_GET['q'];
    $datos = array_filter($datos, function ($dato) use ($q) {
        return strpos($dato->imagen, $q) !== false
            || strpos($dato->nombre_completo, $q) !== false
            || strpos($dato->correo, $q) !== false;
    });
}
?>
<?php
$promg = 0;
foreach ($datos as $id => $dato) {
    // Código para mostrar los datos de usuario aquí
    // Por ejemplo:

    // Asignar el valor de las variables "tiempo", "foto" y "texto"
    $nombre = ($id); // Modificamos "$id" a "$dato->nombre_completo" para obtener un nombre válido

    // Concatenar el valor de las variables en el nombre del archivo
    $nombre_archivo = '@' . $nombre . '.php';

    // Definir el contenido del archivo (por ejemplo, una cadena vacía)
    $contenido_archivo = '
        <?php
   

    // Leer los datos de usuarios del archivo JSON
    $usuarios = json_decode(file_get_contents("usuarios.json"), true);

    // Obtener el ID del usuario que deseas mostrar
    $idUsuario = "'.$id.'";

    // Verificar si el ID de usuario existe en la lista de usuarios
    if (!isset($usuarios[$idUsuario])) {
      // Si el ID de usuario no es válido, mostrar un mensaje de error o redireccionar a una página de error
      echo "Usuario no encontrado";
      exit;
    }

    // Obtener los datos del usuario utilizando el ID
    $usuario = $usuarios[$idUsuario];
    ?>
    <html lang="es" class="dark-mode"><head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Profile ('.$id.') / <?php echo $usuario["nombre_completo"] ?></title>
    <link rel="icon" href="logo.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./dark.css">
    <script>
        (function() {
            const currentMode = localStorage.getItem("mode") || "light";
            document.documentElement.classList.add(`${currentMode}-mode`);
        })();
    </script>
                <style>
            .main-post3{
                margin: 0px 18%;
            }
            @media (max-width: 976px){
    .main-post3{
       margin: 0px 10%;
    }
}

            @media (max-width: 733px){
    .main-post3{
       margin: 0px 5%;
    }
}

            @media (max-width: 533px){
    .main-post3{
       margin: 0px;
    }
}
      
        .post-container {
            margin-top: 7px;
            border-bottom: solid 1px #ccc6;
            width: 100%;
            display: flex;
        }
        .post-image {
            flex: ;
            margin-right: 20px;
            width: 100%;
        }
        .post-image img {
            width: 100%;
            border-radius: 10px;
        }
        .post-content {
            flex: 2;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .post-text {
            margin-bottom: 20px;
        }
        .post-icons {
            display: flex;
            justify-content: flex-end;
        }
        .post-icons i {
            margin-left: 10px;
            font-size: 24px;
            cursor: pointer;
            color: #555;
        }
        .post-icons i:hover {
            color: #000;
        }
        .hwe {
    background-color: transparent;
}
.hnn{
    background-image: url(<?php
    if (!empty($usuario["banner"])) {
        echo "banner/" . $usuario["banner"];
    } else {
        echo "https://i.pinimg.com/564x/20/33/80/20338003920ec18491739916b7af7ade.jp";
    }
    ?>);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    
    background-color: rgba(255, 255, 255, 0.1); /* Fondo semitransparente */
    backdrop-filter: blur(10px); /* Efecto de desenfoque en el fondo */
    -webkit-backdrop-filter: blur(10px); /* Soporte para Safari */
    opacity: 0.8; /* Controla la visibilidad de la imagen */
}

.modal {
    display: none;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    z-index: 9999;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro semi-transparente */
    justify-content: center;
    align-items: center;
    backdrop-filter: blur(20px); /* Efecto de cristal empañado */
}

.modal-content {
 position: fixed;
    left: 0;
    top: 0;
    justify-content: center;
    align-items: center;
    position: relative;
    width: auto;
    padding: 20px;
    border-radius: 10px;
    animation: fadeIn 0.5s ease-in-out;
    color: white;
}

.modal-img {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    object-fit: cover;
}

.close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 28px;
    cursor: pointer;
    color: white;
    display: block;
}

@media only screen and (max-width: 768px) {
.close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 28px;
    cursor: pointer;
    color: white;
    display: none;
}
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}


.vvg {
  border-bottom: 0px #80808021 solid;
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  position: fixed;
  z-index: 999;
  padding: 9px;
}

    </style>
    <!-- Importa la fuente de iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

 <div id="modal" class="modal">
 <span id="closeModalBtn" class="close">&times;</span>
        <div class="modal-content">
            <img src="perfiles/<?php echo $usuario["imagen"] ?>" alt="<?php echo $usuario["nombre_completo"] ?>" class="modal-img">
        </div>
    </div>
    
<body class="dark-mode">
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("carga").style.display = "none";
    });

    window.addEventListener("load", function() {
        document.getElementById("carga").style.display = "block";
    });
</script>
  <div id="carga" style="display: block;">
    <!-- sidebar -->
    <div  style="background-color: transparent; border-right: solid 1px #cccc;" class="sidebar">
        <a href="#" class="logo">
            <img style="width: 40px;" src="logo.png" alt="logo">
        </a>
        <!-- profile image -->
        <br><br>
        <!-- About -->
        <div style="border: solid 0.5px #cccccc0d;" class="about">
            <!-- Box 1 -->
        </div>
        <br>
        <!-- Menu -->
        <div class="menu">
            <a style="margin-bottom:12px;" href="home.php" class="darklight">
                <span class="icon">
                    <i class="ri-function-line"></i>
                </span>
                <span data-key="home">Feed</span>
            </a>
           
            <a style="margin-bottom:12px;" class="darklight" href="noti.php">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="17" height="17"><path d="M22.555,13.662l-1.9-6.836A9.321,9.321,0,0,0,2.576,7.3L1.105,13.915A5,5,0,0,0,5.986,20H7.1a5,5,0,0,0,9.8,0h.838a5,5,0,0,0,4.818-6.338ZM12,22a3,3,0,0,1-2.816-2h5.632A3,3,0,0,1,12,22Zm8.126-5.185A2.977,2.977,0,0,1,17.737,18H5.986a3,3,0,0,1-2.928-3.651l1.47-6.616a7.321,7.321,0,0,1,14.2-.372l1.9,6.836A2.977,2.977,0,0,1,20.126,16.815Z"></path></svg>
                </span>
                <span data-key="notifications">Notifications</span>
            </a>

            <a style="margin-bottom:12px;" class="darklight" href="search.php">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="17" height="17"><path d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z"/></svg>
                </span>
                <span data-key="search">Explore</span>
            </a>

            <a style="margin-bottom:12px;" class="darklight" href="stat.php">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" fill="currentColor" class="bi bi-star not_loved" viewBox="0 0 24 24" width="17" height="17"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"></path></svg>
                </span>
                <span data-key="stats">Stats</span>
            </a>

            <a style="margin-bottom:12px;" class="darklight" href="text.php">
                <span class="icon">
                   <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 -0.5 24 24" width="17" height="17"><path d="M12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"></path><path d="M21.294,13.9l-.444-.256a9.1,9.1,0,0,0,0-3.29l.444-.256a3,3,0,1,0-3-5.2l-.445.257A8.977,8.977,0,0,0,15,3.513V3A3,3,0,0,0,9,3v.513A8.977,8.977,0,0,0,6.152,5.159L5.705,4.9a3,3,0,0,0-3,5.2l.444.256a9.1,9.1,0,0,0,0,3.29l-.444.256a3,3,0,1,0,3,5.2l.445-.257A8.977,8.977,0,0,0,9,20.487V21a3,3,0,0,0,6,0v-.513a8.977,8.977,0,0,0,2.848-1.646l.447.258a3,3,0,0,0,3-5.2Zm-2.548-3.776a7.048,7.048,0,0,1,0,3.75,1,1,0,0,0,.464,1.133l1.084.626a1,1,0,0,1-1,1.733l-1.086-.628a1,1,0,0,0-1.215.165,6.984,6.984,0,0,1-3.243,1.875,1,1,0,0,0-.751.969V21a1,1,0,0,1-2,0V19.748a1,1,0,0,0-.751-.969A6.984,6.984,0,0,1,7.006,16.9a1,1,0,0,0-1.215-.165l-1.084.627a1,1,0,1,1-1-1.732l1.084-.626a1,1,0,0,0,.464-1.133,7.048,7.048,0,0,1,0-3.75A1,1,0,0,0,4.79,8.992L3.706,8.366a1,1,0,0,1,1-1.733l1.086.628A1,1,0,0,0,7.006,7.1a6.984,6.984,0,0,1,3.243-1.875A1,1,0,0,0,11,4.252V3a1,1,0,0,1,2,0V4.252a1,1,0,0,0,.751.969A6.984,6.984,0,0,1,16.994,7.1a1,1,0,0,0,1.215.165l1.084-.627a1,1,0,1,1,1,1.732l-1.084.626A1,1,0,0,0,18.746,10.125Z"></path></svg>
                </span>
                <span data-key="edit">Settings</span>
            </a>

            <a class="darklight" href="logout.php">
                <span class="icon">
                    <i class="ri-logout-box-line"></i>
                </span>
                <span data-key="logout">Logout</span>
            </a>

            <a href="profile.php?user=<?php echo $d; ?>"><div style=" position: absolute; bottom: 0; width: 90%; padding: 6px; margin-bottom: 9px; border-radius: 10px;" class="post-info colors">
                    <div style=" border: solid 0px;" class="post-img">
                        <svg class="tows dark-mode" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20"><path d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z"></path><path d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z"></path></svg>
                    </div>
                    <h5 data-key="profile">profile</h5>
                </div></a>
        </div>

    </div>
    <!-- Main Home -->
    <div class="main-home">
    <style>
    
    #refreshContainer {
      position: fixed;
      margin-top: 80px;
      top: 50px; /* Inicialmente oculto */
      left: 50%;
      transform: translateX(-50%);
      width: 50px;
      z-index:99999;
    object-fit: cover;
    border-radius: 30%;
      height: 30px;
      display: none;
    }

    #refreshIcon {
       width: 30px;
      z-index:99999;
    object-fit: cover;
    border-radius: 50%;
    height: 30px;
      animation: spin 1s linear infinite; /* Efecto de rotación */
    }

    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

  </style>
    <div id="refreshContainer">
    <img id="refreshIcon" src="https://i.pinimg.com/564x/40/c5/1b/40c51baaf681fe429ecc56e8dc56de81.jpg" alt="Refresh" />
  </div>

<script>
    let isRefreshing = false;
    let startY = 0;
    let pullDownThreshold = 150; // Distancia mínima para activar el refresco
    const refreshContainer = document.getElementById("refreshContainer");

    window.addEventListener("touchstart", function(e) {
        // Solo iniciar si estamos en la parte superior de la página
        if (window.scrollY === 0) {
            startY = e.touches[0].clientY;
        }
    });

    window.addEventListener("touchmove", function(e) {
        const currentY = e.touches[0].clientY;

        // Si estamos en la parte superior y el usuario desliza más de lo permitido
        if (window.scrollY === 0 && currentY - startY > pullDownThreshold) {
            refreshContainer.style.display = "block"; // Mostrar el icono de refresco
            refreshContainer.style.top = "20px"; // Moverlo a la vista
            isRefreshing = true;
        }
    });

    window.addEventListener("touchend", function() {
        if (isRefreshing) {
            // Recargar la página
            setTimeout(function() {
                location.reload(); // Recargar la página
            }, 1000); // Retardo para mostrar el icono girando

            // Restablecer el icono de refresco después de un tiempo
            setTimeout(function() {
                refreshContainer.style.display = "none";
                refreshContainer.style.top = "-100px"; // Ocultar el icono nuevamente
            }, 1500);

            isRefreshing = false; // Permitir refrescos nuevamente
        }
    });
</script>
        <div class="nav-fi">
        
        <div style="border-bottom: 1px #80808021 solid;" class="header tows">
            <!-- search -->
            <a href="search.php"><div class="search colors dark-mode">
                <svg class="darklight dark-mode" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="11" height="11"><path d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z"></path></svg>
                <input type="text" name="" id="" placeholder="Search">
            </div></a>
            <div class="header-content">
           
                <a href="text.php"><svg style="margin-left: 9px; margin-top: 8px; margin-right:8px;" class="tows" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 -0.5 24 24" width="19" height="19"><path d="M12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"></path><path d="M21.294,13.9l-.444-.256a9.1,9.1,0,0,0,0-3.29l.444-.256a3,3,0,1,0-3-5.2l-.445.257A8.977,8.977,0,0,0,15,3.513V3A3,3,0,0,0,9,3v.513A8.977,8.977,0,0,0,6.152,5.159L5.705,4.9a3,3,0,0,0-3,5.2l.444.256a9.1,9.1,0,0,0,0,3.29l-.444.256a3,3,0,1,0,3,5.2l.445-.257A8.977,8.977,0,0,0,9,20.487V21a3,3,0,0,0,6,0v-.513a8.977,8.977,0,0,0,2.848-1.646l.447.258a3,3,0,0,0,3-5.2Zm-2.548-3.776a7.048,7.048,0,0,1,0,3.75,1,1,0,0,0,.464,1.133l1.084.626a1,1,0,0,1-1,1.733l-1.086-.628a1,1,0,0,0-1.215.165,6.984,6.984,0,0,1-3.243,1.875,1,1,0,0,0-.751.969V21a1,1,0,0,1-2,0V19.748a1,1,0,0,0-.751-.969A6.984,6.984,0,0,1,7.006,16.9a1,1,0,0,0-1.215-.165l-1.084.627a1,1,0,1,1-1-1.732l1.084-.626a1,1,0,0,0,.464-1.133,7.048,7.048,0,0,1,0-3.75A1,1,0,0,0,4.79,8.992L3.706,8.366a1,1,0,0,1,1-1.733l1.086.628A1,1,0,0,0,7.006,7.1a6.984,6.984,0,0,1,3.243-1.875A1,1,0,0,0,11,4.252V3a1,1,0,0,1,2,0V4.252a1,1,0,0,0,.751.969A6.984,6.984,0,0,1,16.994,7.1a1,1,0,0,0,1.215.165l1.084-.627a1,1,0,1,1,1,1.732l-1.084.626A1,1,0,0,0,18.746,10.125Z"></path></svg></a>
                <!-- Button -->
               <a style="margin-right:5px; justify-content: center; align-items: center; padding:0px; background-color:transparent;" href="share.php">         
                    <svg style="margin-top:8px; background-color:transparent" class="tows" xmlns="http://www.w3.org/2000/svg" id="Layer_1" width="21" height="21" viewBox="0 0 24 24" data-name="Layer 1"><path d="m12 0a12 12 0 1 0 12 12 12.013 12.013 0 0 0 -12-12zm0 22a10 10 0 1 1 10-10 10.011 10.011 0 0 1 -10 10zm5-10a1 1 0 0 1 -1 1h-3v3a1 1 0 0 1 -2 0v-3h-3a1 1 0 0 1 0-2h3v-3a1 1 0 0 1 2 0v3h3a1 1 0 0 1 1 1z"></path></svg>
                </a>
            </div>
    
        </div>
</div>

<div class="nk">

<div style="flex-direction: column; justify-content: center; align-items: center; color: white; position: fixed; top: 0; left: 0; z-index: 100; width: 100%; height: 32px;" class="glass-effect mass tows">
        <style>
        /* Estilos generales para el fondo */
        /* Efecto cristal */
        .glass-effect {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2); /* Borde semi-transparente */
        }
        
         @media only screen and (max-width: 768px) {
    .glass-effect {
            border-bottom: 0px solid rgba(255, 255, 255, 0.2); /* Borde semi-transparente */
            background-image: url(<?php

    if (!empty($usuario["banner"])) {

        echo "banner/" . $usuario["banner"];
    } else {
        echo "https://i.pinimg.com/564x/20/33/80/20338003920ec18491739916b7af7ade.jp";
    }
    ?>);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: start start;
    
        }
    }

        /* Estilos para el contenido dentro del div */
        .glass-effect h2 {
            font-size: 24px;
            margin-bottom: 0px;
        }

        .glass-effect p {
            font-size: 16px;
            line-height: 1.5;
            text-align: center;
        }
        .hdsppp3 {
    height: 188px;
    width: 95%;
    margin-top: 0px;
    border-radius: 10px;
}
        @media screen and (max-width: 600px){
            .hdsppp3 {
    height: 170px;
    width: 100%;
    margin-top: 0px;
    border-radius: 0px;
    border-bottom: solid 1px rgba(204, 204, 204, 0.182);
}
        }
    </style>
    </div>
<div id="miElemento" style="margin-top: 25px;" class="darklight vvg">
            <!-- search -->
            <a  href="javascript:history.back()"><svg class="darklight" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="17" height="17"><g id="_01_align_center" data-name="01 align center"><path d="M16.752,23.994,6.879,14.121a3,3,0,0,1,0-4.242L16.746.012,18.16,1.426,8.293,11.293a1,1,0,0,0,0,1.414l9.873,9.873Z"/></g></svg></a>
            <a href="search.php"><div class="search colors dark-mode">
                <svg class="darklight dark-mode" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="11" height="11"><path d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z"></path></svg>
                <input type="text" name="" id="" placeholder="Search">
            </div></a>
            <div class="header-content">
                <a style="padding: 7px; border: solid 1px #cccccc30; border-radius: 50%; background-color: #00000057;">
                <svg xmlns="http://www.w3.org/2000/svg" id="abrir-modal" fill="#0095f6" data-name="Layer 1" viewBox="0 0 24 24" width="15" height="15"><path d="M7,0h-3C1.794,0,0,1.794,0,4v3c0,2.206,1.794,4,4,4h3c2.206,0,4-1.794,4-4V4C11,1.794,9.206,0,7,0Zm2,7c0,1.103-.897,2-2,2h-3c-1.103,0-2-.897-2-2V4c0-1.103,.897-2,2-2h3c1.103,0,2,.897,2,2v3Zm-2-2v1c0,.552-.448,1-1,1h-1c-.552,0-1-.448-1-1v-1c0-.552,.448-1,1-1h1c.552,0,1,.448,1,1Zm10,6h3c2.206,0,4-1.794,4-4V4C24,1.794,22.206,0,20,0h-3C14.794,0,13,1.794,13,4v3c0,2.206,1.794,4,4,4Zm-2-7c0-1.103,.897-2,2-2h3c1.103,0,2,.897,2,2v3c0,1.103-.897,2-2,2h-3c-1.103,0-2-.897-2-2V4Zm2,2v-1c0-.552,.448-1,1-1h1c.552,0,1,.448,1,1v1c0,.552-.448,1-1,1h-1c-.552,0-1-.448-1-1ZM7,13h-3c-2.206,0-4,1.794-4,4v3c0,2.206,1.794,4,4,4h3c2.206,0,4-1.794,4-4v-3c0-2.206-1.794-4-4-4Zm2,7c0,1.103-.897,2-2,2h-3c-1.103,0-2-.897-2-2v-3c0-1.103,.897-2,2-2h3c1.103,0,2,.897,2,2v3Zm-2-2v1c0,.552-.448,1-1,1h-1c-.552,0-1-.448-1-1v-1c0-.552,.448-1,1-1h1c.552,0,1,.448,1,1Zm10-3.5v1c0,.828-.672,1.5-1.5,1.5h-1c-.828,0-1.5-.672-1.5-1.5v-1c0-.828,.672-1.5,1.5-1.5h1c.828,0,1.5,.672,1.5,1.5Zm3,4h0c0,.828-.672,1.5-1.5,1.5h0c-.828,0-1.5-.672-1.5-1.5h0c0-.828,.672-1.5,1.5-1.5h0c.828,0,1.5,.672,1.5,1.5Zm-3,3v1c0,.828-.672,1.5-1.5,1.5h-1c-.828,0-1.5-.672-1.5-1.5v-1c0-.828,.672-1.5,1.5-1.5h1c.828,0,1.5,.672,1.5,1.5Zm7-7v1c0,.828-.672,1.5-1.5,1.5h-1c-.828,0-1.5-.672-1.5-1.5v-1c0-.828,.672-1.5,1.5-1.5h1c.828,0,1.5,.672,1.5,1.5Z"/></svg>
               </a>
            </div>
    
        </div>
</div>
<script>
    document.addEventListener("scroll", function() {
    const elemento = document.getElementById("miElemento");
    if (window.scrollY > 0) {
        elemento.classList.replace("hwe", "hnn");
    } else {
        elemento.classList.replace("hnn", "hwe");
    }
});
</script>

        
        <div style="padding: 0px;">

 <div class="page">
 <center>
 <a><div class="hdspppm" style="border: solid 0px #ccc6; margin-top: 0px; <?php
 if (!empty($usuario["banner"])) {
     echo "display: block;";
 } else {
     echo "display: none;";
 }
 ?>"><img class="hdsppp3" style="width: 100%; <?php
 if (!empty($usuario["banner"])) {
     echo "display: block;";
 } else {
     echo "display: none;";
 }
 ?>" src="banner/<?php echo $usuario["banner"] ?>"></div></a>
</center>
       
        <!-- PROFILE -->
        <div style="<?php
 if (!empty($usuario["banner"])) {
     echo "margin-top:55px;";
 } else {
     echo "margin-top:125px;";
 }
 ?>" class="profile-wrap mb-2rem">
            <div class="profile-avatar">
                <div class="circ-story circ-gradient"></div>
                <a id="openModalBtn">
                <img class="borde dark-mode" src="perfiles/<?php echo $usuario["imagen"] ?>">
                </a>
<script>
const openModalBtn = document.getElementById("openModalBtn");
const closeModalBtn = document.getElementById("closeModalBtn");
const modal = document.getElementById("modal");
const modalImg = document.querySelector(".modal-img");

let isDragging = false;  // Control para saber si el usuario está deslizando
let scale = 1;  // Control de escala para el zoom
let lastScale = 1;
let startX, startY, initialX = 0, initialY = 0;
let xDown = null, yDown = null;
let initialDist = 0;
let pinchCenterX = 0, pinchCenterY = 0;
let zoomThreshold = 0.1;  // Umbral de zoom para detectar un gesto fuerte
let swipeThreshold = 200;  // Umbral de deslizamiento fuerte para cerrar el modal
let isMoved = false;  // Para saber si la imagen ha sido movida

openModalBtn.addEventListener("click", () => {
    modal.style.display = "flex";
    resetImage();  // Resetear la imagen al abrir el modal
});

window.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        closeModal();
    }
});

// Evento para cerrar el modal con doble clic
modal.addEventListener("dblclick", closeModal);

modal.addEventListener("touchstart", handleTouchStart, false);
modal.addEventListener("touchmove", handleTouchMove, false);
modal.addEventListener("touchend", handleTouchEnd, false);
modal.addEventListener("touchstart", handlePinchStart, { passive: false });
modal.addEventListener("touchmove", handlePinchMove, { passive: false });

function handleTouchStart(evt) {
    if (evt.touches.length === 1) {
        const firstTouch = evt.touches[0];
        xDown = firstTouch.clientX;
        yDown = firstTouch.clientY;

        startX = evt.touches[0].clientX - initialX;
        startY = evt.touches[0].clientY - initialY;
    }
}

function handleTouchMove(evt) {
    if (evt.touches.length === 1 && !isPinching(evt)) {
        // Si solo hay un dedo tocando, permite mover la imagen
        isDragging = true;
        isMoved = true;  // La imagen ha sido movida
        const currentX = evt.touches[0].clientX - startX;
        const currentY = evt.touches[0].clientY - startY;
        modalImg.style.transform = `translate(${currentX}px, ${currentY}px) scale(${scale})`;
    }

    if (!xDown || !yDown) return;

    const xUp = evt.touches[0].clientX;
    const yUp = evt.touches[0].clientY;
    const xDiff = xDown - xUp;
    const yDiff = yDown - yUp;

    if (Math.abs(xDiff) > Math.abs(yDiff)) {
        // Desliza horizontalmente (no lo usamos)
    } else {
        if (yDiff > swipeThreshold) {
            // Deslizar fuerte hacia arriba, cerrar el modal
            closeModal();
        } else if (yDiff < -swipeThreshold) {
            // Deslizar fuerte hacia abajo, cerrar el modal
            closeModal();
        }
    }
}

function handleTouchEnd(evt) {
    // Reinicia la bandera de arrastre después de soltar el toque
    isDragging = false;

    if (isMoved) {
        // Si la imagen ha sido movida, restablecerla a su posición original
        modalImg.style.transform = `translate(0, 0) scale(${scale})`;
        initialX = 0;
        initialY = 0;
        isMoved = false;  // Reiniciar bandera de movimiento
    }

    // Si no hay más dedos tocando la pantalla, restablecer el zoom
    if (evt.touches.length === 0) {
        resetImage();
    }
}

function handlePinchStart(evt) {
    if (evt.touches.length === 2) {
        lastScale = scale;

        // Obtener la distancia inicial entre los dos dedos
        initialDist = getPinchDistance(evt.touches[0], evt.touches[1]);

        // Calcular el centro del pellizco
        pinchCenterX = (evt.touches[0].clientX + evt.touches[1].clientX) / 2;
        pinchCenterY = (evt.touches[0].clientY + evt.touches[1].clientY) / 2;
    }
}

function handlePinchMove(evt) {
    if (evt.touches.length === 2) {
        evt.preventDefault();  // Evitar comportamiento por defecto del navegador

        const newDist = getPinchDistance(evt.touches[0], evt.touches[1]);
        
        // Calcular el nuevo zoom basado en la distancia actual y la inicial
        const newScale = lastScale * (newDist / initialDist);

        if (newScale > zoomThreshold) {
            // Aplicar el zoom a la imagen, manteniendo el centro del pellizco
            const deltaX = pinchCenterX - modalImg.getBoundingClientRect().left;
            const deltaY = pinchCenterY - modalImg.getBoundingClientRect().top;
            modalImg.style.transformOrigin = `${deltaX}px ${deltaY}px`;
            modalImg.style.transform = `scale(${newScale})`;

            // Actualizar la escala global
            scale = newScale;
        }
    }
}

function getPinchDistance(touch1, touch2) {
    return Math.sqrt(
        Math.pow(touch2.clientX - touch1.clientX, 2) +
        Math.pow(touch2.clientY - touch1.clientY, 2)
    );
}

function closeModal() {
    modal.style.display = "none";
}

function resetImage() {
    // Resetea el estado de la imagen cuando se abre el modal
    modalImg.style.transform = "translate(0, 0) scale(1)";
    modalImg.style.transformOrigin = "center";  // Restablecer el origen de transformación
    initialX = 0;
    initialY = 0;
    scale = 1;
}

function isPinching(evt) {
    return evt.touches.length === 2;
}
</script>
               
            </div>
            <div class="profile-info">
                <div class="profile-title mb-1rem">
                    <h2 style=" margin-bottom: 9px;">'.$id.'<?php
// Cargar el contenido del archivo verificado.json
$verificados_json = file_get_contents("verificado.json");

// Decodificar el JSON en un array asociativo
$verificados_data = json_decode($verificados_json, true);


// Verificar si el valor de $d está en la lista de verificados
if (in_array("'.$id.'", $verificados_data["verificados"])) {
    // Si $d está verificado, mostrar el SVG
    echo \'<svg style="margin-left: 4px;" width="18" height="18" fill="#03a9f4" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="m23.126,9.868h0l-2.151-2.154v-1.718c0-1.651-1.342-2.995-2.991-2.995h-1.716l-2.151-2.153c-1.131-1.131-3.101-1.131-4.231,0l-2.151,2.153h-1.716c-1.65,0-2.991,1.343-2.991,2.995v1.718l-2.152,2.154c-1.165,1.168-1.165,3.067,0,4.235l2.151,2.154v1.718c0,1.651,1.342,2.995,2.991,2.995h1.716l2.151,2.153c.565.565,1.317.877,2.116.877s1.55-.312,2.115-.877l2.151-2.153h1.716c1.65,0,2.991-1.343,2.991-2.995v-1.718l2.152-2.154c1.165-1.168,1.165-3.067,0-4.235Zm-4.922.343l-5.054,4.995c-.614.61-1.423.916-2.231.916s-1.613-.305-2.229-.913l-2.599-2.499c-.392-.389-.396-1.021-.007-1.414.39-.391,1.021-.396,1.415-.007l2.598,2.498c.453.449,1.19.45,1.644,0l5.055-4.996c.394-.39,1.026-.386,1.415.007s.385,1.025-.007,1.414Z"/>
  </svg>\';
} else {
    // Si no está verificado, mostrar un mensaje o SVG alternativo
    echo \'\';
}
?>

<?php
// Cargar el contenido del archivo verificado.json
$verificados_json = file_get_contents("emp.json");

// Decodificar el JSON en un array asociativo
$verificados_data = json_decode($verificados_json, true);


// Verificar si el valor de $d está en la lista de verificados
if (in_array("'.$id.'", $verificados_data["verificados"])) {
    // Si $d está verificado, mostrar el SVG
    echo \'<svg style="margin-left: 4px;" width="18" height="18" fill="red" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="m23.126,9.868h0l-2.151-2.154v-1.718c0-1.651-1.342-2.995-2.991-2.995h-1.716l-2.151-2.153c-1.131-1.131-3.101-1.131-4.231,0l-2.151,2.153h-1.716c-1.65,0-2.991,1.343-2.991,2.995v1.718l-2.152,2.154c-1.165,1.168-1.165,3.067,0,4.235l2.151,2.154v1.718c0,1.651,1.342,2.995,2.991,2.995h1.716l2.151,2.153c.565.565,1.317.877,2.116.877s1.55-.312,2.115-.877l2.151-2.153h1.716c1.65,0,2.991-1.343,2.991-2.995v-1.718l2.152-2.154c1.165-1.168,1.165-3.067,0-4.235Zm-4.922.343l-5.054,4.995c-.614.61-1.423.916-2.231.916s-1.613-.305-2.229-.913l-2.599-2.499c-.392-.389-.396-1.021-.007-1.414.39-.391,1.021-.396,1.415-.007l2.598,2.498c.453.449,1.19.45,1.644,0l5.055-4.996c.394-.39,1.026-.386,1.415.007s.385,1.025-.007,1.414Z"/>
  </svg>\';
} else {
    // Si no está verificado, mostrar un mensaje o SVG alternativo
    echo \'\';
}
?></h2>
                    <button  type="submit" style="display: <?php
                    $soy_Y = "'.$id.'";
                    $soy_X = "'.$d.'";
                    if ($soy_Y == $soy_X) {
                        echo "none";
                    } else {
                        // Si las variables son diferentes, se redirige a la página anterior
                        echo "block";
                    }
                    ?>; padding: 9px 15px; font-size: 15px; margin-left: 0px; border-radius: 30px; border: none; font-weight: 500; background-color: 
<?php
$archivo_json = "flow.json";
$usuario_actual = "'.$id.'"; // Cambia esto al valor correspondiente al usuario actual
$otro_usuario = "'.$d.'"; // Cambia esto al valor correspondiente al otro usuario

if (file_exists($archivo_json)) {
    $json_data = file_get_contents($archivo_json);
    $datos = json_decode($json_data);

    if ($datos !== null) {
        $siguiendo = false;

        foreach ($datos as $dato) {
            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                $siguiendo = true;
                break; // Sal del bucle una vez que encuentres una coincidencia
            }
        }

        echo ($siguiendo && $otro_usuario === "'.$d.'") ? "rgb(239, 239, 239)" : "#0095f6";
    } else {
        echo "#0095f6";
    }
} else {
    echo "#0095f6";
}
?>;" class="">
                                  <form style="width:100%;" id="<?php
                                  $archivo_json = "flow.json";
                                  $usuario_actual = "'.$id.'"; // Cambia esto al valor correspondiente al usuario actual
                                  $otro_usuario = "'.$d.'"; // Cambia esto al valor correspondiente al otro usuario
                                  
                                  if (file_exists($archivo_json)) {
                                      $json_data = file_get_contents($archivo_json);
                                      $datos = json_decode($json_data);
                                  
                                      if ($datos !== null) {
                                          $siguiendo = false;
                                  
                                          foreach ($datos as $dato) {
                                              if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                                                  $siguiendo = true;
                                                  break; // Sal del bucle una vez que encuentres una coincidencia
                                              }
                                          }
                                  
                                          echo ($siguiendo && $otro_usuario === "'.$d.'") ? "elim" : "nain";
                                      } else {
                                          echo "elim";
                                      }
                                  } else {
                                      echo "elim";
                                  }
                                  ?>" action="<?php
$archivo_json = "flow.json";
$usuario_actual = "'.$id.'"; // Cambia esto al valor correspondiente al usuario actual
$otro_usuario = "'.$d.'"; // Cambia esto al valor correspondiente al otro usuario

if (file_exists($archivo_json)) {
    $json_data = file_get_contents($archivo_json);
    $datos = json_decode($json_data);

    if ($datos !== null) {
        $siguiendo = false;

        foreach ($datos as $dato) {
            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                $siguiendo = true;
                break; // Sal del bucle una vez que encuentres una coincidencia
            }
        }

        echo ($siguiendo && $otro_usuario === "'.$d.'") ? "flow.php" : "flow_'.$id.'.php";
    } else {
        echo "flow_'.$id.'.php";
    }
} else {
    echo "flow_'.$id.'.php";
}
?>" method="post" enctype="multipart/form-data">
              
<input style="display:none;" type="text" name="foto" value="<?php echo $usuario["nombre_completo"]; ?>">
<input style="display:none;" type="text" name="ft" value="<?php echo $usuario["imagen"]; ?>">
<input style="display:none;" type="text" name="tiempo" value="<?php echo date("d/M/Y");?>">
<input style="display:none;" type="text" name="texto" value="'.$d.'">
<input style="display:none;" type="text" name="nombre" value="'.$id.'">
                                  <svg xmlns="http://www.w3.org/2000/svg" style="margin-bottom:-3px;" width="16" height="16" fill="<?php
$archivo_json = "flow.json";
$usuario_actual = "'.$id.'"; // Cambia esto al valor correspondiente al usuario actual
$otro_usuario = "'.$d.'"; // Cambia esto al valor correspondiente al otro usuario

if (file_exists($archivo_json)) {
    $json_data = file_get_contents($archivo_json);
    $datos = json_decode($json_data);

    if ($datos !== null) {
        $siguiendo = false;

        foreach ($datos as $dato) {
            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                $siguiendo = true;
                break; // Sal del bucle una vez que encuentres una coincidencia
            }
        }

        echo ($siguiendo && $otro_usuario === "'.$d.'") ? "black" : "white";
    } else {
        echo "white";
    }
} else {
    echo "white";
}
?>" class="bi bi-person-plus" viewBox="0 0 16 16">
 <?php
$archivo_json = "flow.json";
$usuario_actual = "'.$id.'"; // Cambia esto al valor correspondiente al usuario actual
$otro_usuario = "'.$d.'"; // Cambia esto al valor correspondiente al otro usuario

if (file_exists($archivo_json)) {
    $json_data = file_get_contents($archivo_json);
    $datos = json_decode($json_data);

    if ($datos !== null) {
        $siguiendo_actual = false;
        $siguiendo_otro = false;

        foreach ($datos as $dato) {
            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                $siguiendo_actual = true;
            }
            if ($dato->nombre === $otro_usuario && $dato->texto === $usuario_actual) {
                $siguiendo_otro = true;
            }
        }

        if ($siguiendo_actual && $siguiendo_otro) {
            echo \'<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M12.331 9.5a1 1 0 0 1 0 1A4.998 4.998 0 0 1 8 13a4.998 4.998 0 0 1-4.33-2.5A1 1 0 0 1 4.535 9h6.93a1 1 0 0 1 .866.5zM7 6.5c0 .828-.448 0-1 0s-1 .828-1 0S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 0-1 0s-1 .828-1 0S9.448 5 10 5s1 .672 1 1.5z"/>\';
        } elseif ($siguiendo_actual && !$siguiendo_otro) {
            echo \'<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M11.354 4.646a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 .708.708l6-6a.5.5 0 0 0 0-.708z"/>\';
        } elseif (!$siguiendo_actual && $siguiendo_otro) {
            echo \'<path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>\';
        } else {
            echo \'<path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
  <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>\';
        }
    } else {
        echo \'<path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
  <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>\';
    }
} else {
    echo \'<path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
  <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>\';
}
?>
</svg> 
<<?php
$archivo_json = "flow.json";
$usuario_actual = "'.$id.'"; // Cambia esto al valor correspondiente al usuario actual
$otro_usuario = "'.$d.'"; // Cambia esto al valor correspondiente al otro usuario

if (file_exists($archivo_json)) {
    $json_data = file_get_contents($archivo_json);
    $datos = json_decode($json_data);

    if ($datos !== null) {
        $siguiendo_actual = false;
        $siguiendo_otro = false;

        foreach ($datos as $dato) {
            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                $siguiendo_actual = true;
            }
            if ($dato->nombre === $otro_usuario && $dato->texto === $usuario_actual) {
                $siguiendo_otro = true;
            }
        }

        if ($siguiendo_actual && $siguiendo_otro) {
            echo "a";
        } elseif ($siguiendo_actual && !$siguiendo_otro) {
            echo "a";
        } elseif (!$siguiendo_actual && $siguiendo_otro) {
            echo "a";
        } else {
            echo "a";
        }
    } else {
        echo "a";
    }
} else {
    echo "a";
}
?> href="<?php
$archivo_json = "flow.json";
$usuario_actual = "'.$id.'"; // Cambia esto al valor correspondiente al usuario actual
$otro_usuario = "'.$d.'"; // Cambia esto al valor correspondiente al otro usuario

if (file_exists($archivo_json)) {
    $json_data = file_get_contents($archivo_json);
    $datos = json_decode($json_data);

    if ($datos !== null) {
        $siguiendo = false;

        foreach ($datos as $dato) {
            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                $siguiendo = true;
                break; // Sal del bucle una vez que encuentres una coincidencia
            }
        }

        echo ($siguiendo && $otro_usuario === "'.$d.'") ? "flow_'.$id.'.php" : "flow_'.$id.'.php";
    } else {
        echo "flow_'.$id.'.php";
    }
} else {
    echo "flow_'.$id.'.php";
}
?>" onclick="<?php
$archivo_json = "flow.json";
$usuario_actual = "'.$id.'"; // Cambia esto al valor correspondiente al usuario actual
$otro_usuario = "'.$d.'"; // Cambia esto al valor correspondiente al otro usuario

if (file_exists($archivo_json)) {
    $json_data = file_get_contents($archivo_json);
    $datos = json_decode($json_data);

    if ($datos !== null) {
        $siguiendo_actual = false;
        $siguiendo_otro = false;

        foreach ($datos as $dato) {
            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                $siguiendo_actual = true;
            }
            if ($dato->nombre === $otro_usuario && $dato->texto === $usuario_actual) {
                $siguiendo_otro = true;
            }
        }

        if ($siguiendo_actual && $siguiendo_otro) {
            echo "openModal()";
        } elseif ($siguiendo_actual && !$siguiendo_otro) {
            echo "openModal()";
        } elseif (!$siguiendo_actual && $siguiendo_otro) {
            echo "";
        } else {
            echo "";
        }
    } else {
        echo "";
    }
} else {
    echo "";
}
?>" style="<?php
$archivo_json = "flow.json";
$usuario_actual = "'.$id.'"; // Cambia esto al valor correspondiente al usuario actual
$otro_usuario = "'.$d.'"; // Cambia esto al valor correspondiente al otro usuario

if (file_exists($archivo_json)) {
    $json_data = file_get_contents($archivo_json);
    $datos = json_decode($json_data);

    if ($datos !== null) {
        $siguiendo_actual = false;
        $siguiendo_otro = false;

        foreach ($datos as $dato) {
            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                $siguiendo_actual = true;
            }
            if ($dato->nombre === $otro_usuario && $dato->texto === $usuario_actual) {
                $siguiendo_otro = true;
            }
        }

        if ($siguiendo_actual && $siguiendo_otro) {
            echo "width:70px; ";
        } elseif ($siguiendo_actual && !$siguiendo_otro) {
            echo "width:70px; ";
        } elseif (!$siguiendo_actual && $siguiendo_otro) {
            echo "";
        } else {
            echo "";
        }
    } else {
        echo "";
    }
} else {
    echo "";
}
?> background-color:transparent; color:<?php
$archivo_json = "flow.json";
$usuario_actual = "'.$id.'"; // Cambia esto al valor correspondiente al usuario actual
$otro_usuario = "'.$d.'"; // Cambia esto al valor correspondiente al otro usuario

if (file_exists($archivo_json)) {
    $json_data = file_get_contents($archivo_json);
    $datos = json_decode($json_data);

    if ($datos !== null) {
        $siguiendo = false;

        foreach ($datos as $dato) {
            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                $siguiendo = true;
                break; // Sal del bucle una vez que encuentres una coincidencia
            }
        }

        echo ($siguiendo && $otro_usuario === "'.$d.'") ? "black" : "white";
    } else {
        echo "white";
    }
} else {
    echo "white";
}
?>; border:solid 0px;" type="<?php
$archivo_json = "flow.json";
$usuario_actual = "'.$id.'"; // Cambia esto al valor correspondiente al usuario actual
$otro_usuario = "'.$d.'"; // Cambia esto al valor correspondiente al otro usuario

if (file_exists($archivo_json)) {
    $json_data = file_get_contents($archivo_json);
    $datos = json_decode($json_data);

    if ($datos !== null) {
        $siguiendo_actual = false;
        $siguiendo_otro = false;

        foreach ($datos as $dato) {
            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                $siguiendo_actual = true;
            }
            if ($dato->nombre === $otro_usuario && $dato->texto === $usuario_actual) {
                $siguiendo_otro = true;
            }
        }

        if ($siguiendo_actual && $siguiendo_otro) {
            echo "submit";
        } elseif ($siguiendo_actual && !$siguiendo_otro) {
            echo "submit";
        } elseif (!$siguiendo_actual && $siguiendo_otro) {
            echo "submit";
        } else {
            echo "submit";
        }
    } else {
        echo "submit";
    }
} else {
    echo "submit";
}
?>" value="">
<?php
                $archivo_json = "flow.json";
                
                if (file_exists($archivo_json)) {
                    $json_data = file_get_contents($archivo_json);
                    $datos = json_decode($json_data);
                
                    if ($datos !== null) {
                        $siguiendo_actual = false;
                        $siguiendo_otro = false;
                
                        foreach ($datos as $dato) {
                            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                                $siguiendo_actual = true;
                            }
                            if ($dato->nombre === $otro_usuario && $dato->texto === $usuario_actual) {
                                $siguiendo_otro = true;
                            }
                        }
                
                        if ($siguiendo_actual && $siguiendo_otro) {
                            echo "<span data-key=\'friends\'></span>";
                        } elseif ($siguiendo_actual && !$siguiendo_otro) {
                            echo "<span data-key=\'following\'></span>";
                        } elseif (!$siguiendo_actual && $siguiendo_otro) {
                            echo "<span data-key=\'followers\'></span>";
                        } else {
                            echo "<span data-key=\'follow\'></span>";
                        }
                    } else {
                        echo "<span data-key=\'follow\'></span>";
                    }
                } else {
                    echo "<span data-key=\'follow\'></span>";
                }
                ?>


<?php
$archivo_json = "flow.json";
$usuario_actual = "'.$id.'"; // Cambia esto al valor correspondiente al usuario actual
$otro_usuario = "'.$d.'"; // Cambia esto al valor correspondiente al otro usuario

if (file_exists($archivo_json)) {
    $json_data = file_get_contents($archivo_json);
    $datos = json_decode($json_data);

    if ($datos !== null) {
        $siguiendo_actual = false;
        $siguiendo_otro = false;

        foreach ($datos as $dato) {
            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                $siguiendo_actual = true;
            }
            if ($dato->nombre === $otro_usuario && $dato->texto === $usuario_actual) {
                $siguiendo_otro = true;
            }
        }

        if ($siguiendo_actual && $siguiendo_otro) {
            echo "</a>";
        } elseif ($siguiendo_actual && !$siguiendo_otro) {
            echo "</a>";
        } elseif (!$siguiendo_actual && $siguiendo_otro) {
            echo "";
        } else {
            echo "";
        }
    } else {
        echo "";
    }
} else {
    echo "";
}
?>
</form>
                                </button>
                                <script>
document.getElementById("eliminarDatos").addEventListener("click", function() {
    // Preguntar al usuario si realmente desea eliminar la publicación
    var confirmar = confirm("¿Seguro que quieres dejar de seguir a '.$id.'?");
    
    if (confirmar) {
        // Realizar una solicitud AJAX para cargar el archivo JSON
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "flow.json", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Parsear el JSON
                var data = JSON.parse(xhr.responseText);

                // Filtrar y eliminar el objeto JSON específico
                var newData = data.filter(function(item) {
                    return !(item.nombre === "'.$id.'" && item.texto === "'.$d.'");
                });

                // Convertir el nuevo array de datos en JSON
                var jsonResult = JSON.stringify(newData, null, 2);

                // Realizar una solicitud AJAX para sobrescribir el archivo JSON en el servidor a través de PHP
                var xhr2 = new XMLHttpRequest();
                xhr2.open("POST", "", true); // Dejar en blanco la URL para que la solicitud vaya a la misma página
                xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr2.onreadystatechange = function () {
                    if (xhr2.readyState === 4) {
                        if (xhr2.status === 200) {
                            console.log("Datos eliminados satisfactoriamente.");
                            // Redirigir a perfil.php después de la eliminación
                            alert("Dejaste de seguir a '.$id.'");
                            window.location.href = "@'.$id.'.php";
                            return;
                        } else {
                            console.error("Error al eliminar datos.");
                            alert("Error al eliminar datos.");
                        }
                    }
                };
                xhr2.send("json=" + encodeURIComponent(jsonResult)); // Enviar los datos JSON a través de PHP en la misma página
            }
        };
        xhr.send();
    } else {
        // El usuario canceló la eliminación, no se realiza ninguna acción
        console.log("Eliminación cancelada por el usuario.");
    }
});
</script>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
// Manejar la solicitud POST para sobrescribir el archivo JSON
$json = $_POST["json"];
file_put_contents("flow.json", $json);
echo "OK";

// Eliminar los archivos PHP
$phpFile1 = "kkldddasasff.php";
$phpFile2 = "hhhasfdbvvcvfddv.php";

if (file_exists($phpFile1)) {
    unlink($phpFile1);
}

if (file_exists($phpFile2)) {
    unlink($phpFile2);
}
}
?>

                   </div>
                <!-- Profile Stats -->
                <ul class="profile-numbers mb-1rem">
                     <li>
                <a href="#">
                    <span class="profile-posts darklight dark-mode"><?php

                    // Ruta al archivo data.json
                    $ruta_archivo = "datos.json";
                    
                    // Lee el contenido del archivo en una cadena
                    $contenido = file_get_contents($ruta_archivo);
                    
                    // Decodifica la cadena JSON en un array asociativo
                    $data = json_decode($contenido, true);
                    
                    // Contador para contar las coincidencias
                    $contador = 0;
                    
                    // Itera sobre el array buscando coincidencias
                    foreach ($data as $elemento) {
                        if (isset($elemento["nombre"]) && $elemento["nombre"] === "'.$id.'") {
                            $contador++;
                        }
                    }
                    
                    // Imprime el resultado
                    echo $contador;
                    ?></span>
                    <span data-key="posts" class="darklight dark-mode">Publicaciones</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="profile-followers darklight dark-mode"><?php
                    // Ruta al archivo JSON
                    $archivo_json = "flow.json";
                    
                    // Verificar si el archivo JSON existe
                    if (file_exists($archivo_json)) {
                        // Leer el contenido del archivo JSON
                        $json_data = file_get_contents($archivo_json);
                    
                        // Decodificar el JSON en un array de PHP
                        $datos = json_decode($json_data);
                    
                        // Verificar si la decodificación fue exitosa
                        if ($datos !== null) {
                            // Inicializar un contador
                            $contador_yust = 0;
                    
                            // Recorrer el arreglo de datos
                            foreach ($datos as $dato) {
                                
                                if (strpos($dato->nombre, "'.$id.'") !== false) {
                                    $contador_yust++;
                                }
                            }
                    
                            // Mostrar el resultado
                            echo "<span>$contador_yust</span>";
                        } else {
                            echo "<span>0</span>";
                        }
                    } else {
                        echo "<span>0</span>";
                    }
                    ?></span>
                    <span data-key="followers" class="darklight dark-mode">Seguidores</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="profile-following darklight dark-mode"><?php
                    // Ruta al archivo JSON
                    $archivo_json = "flow.json";
                    
                    // Verificar si el archivo JSON existe
                    if (file_exists($archivo_json)) {
                        // Leer el contenido del archivo JSON
                        $json_data = file_get_contents($archivo_json);
                    
                        // Decodificar el JSON en un array de PHP
                        $datos = json_decode($json_data);
                    
                        // Verificar si la decodificación fue exitosa
                        if ($datos !== null) {
                            // Inicializar un contador
                            $contador_yust = 0;
                    
                            // Recorrer el arreglo de datos
                            foreach ($datos as $dato) {
                                
                                if (strpos($dato->texto, "'.$id.'") !== false) {
                                    $contador_yust++;
                                }
                            }
                    
                            // Mostrar el resultado
                            echo "<span>$contador_yust</span>";
                        } else {
                            echo "<span>0</span>";
                        }
                    } else {
                        echo "<span>0</span>";
                    }
                    ?></span>
                    <span data-key="following" class="darklight dark-mode">Siguiendo</span>
                </a>
            </li>
                </ul>
                <div class="profile-bio">
                    <h1 class="profile-name"><?php echo $usuario["nombre_completo"] ?></h1>
                    <span class="profile-desc">
                    @'.$id.'                       <br> 
                        <br><?php
                        // Procesar y mostrar la biografía con saltos de línea y listas
                        $correo = htmlspecialchars($usuario["correo"]); // Escapar caracteres especiales de HTML
                        $correo = nl2br($correo); // Convertir saltos de línea en <br>
                        $correo = str_replace(
                            array("[ul]", "[/ul]", "[li]","[/li]"), 
                            array("<ul>", "</ul>", "<li>", "</li>"), 
                            $correo
                        );
                        echo $correo;
                        ?> </span>
                    <a href="" target="_blank" class="profile-link"></a>
                </div>
            </div>
        </div>
        
        <!-- RESPONSIVE PROFILE NUMBERS -->
        <ul class="profile-numbers responsive-profile">
             <li>
                <a href="#">
                    <span class="profile-posts darklight dark-mode"><?php

                    // Ruta al archivo data.json
                    $ruta_archivo = "datos.json";
                    
                    // Lee el contenido del archivo en una cadena
                    $contenido = file_get_contents($ruta_archivo);
                    
                    // Decodifica la cadena JSON en un array asociativo
                    $data = json_decode($contenido, true);
                    
                    // Contador para contar las coincidencias
                    $contador = 0;
                    
                    // Itera sobre el array buscando coincidencias
                    foreach ($data as $elemento) {
                        if (isset($elemento["nombre"]) && $elemento["nombre"] === "'.$id.'") {
                            $contador++;
                        }
                    }
                    
                    // Imprime el resultado
                    echo $contador;
                    ?></span>
                    <span data-key="posts" class="darklight dark-mode">Publicaciones</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="profile-followers darklight dark-mode"><?php
                    // Ruta al archivo JSON
                    $archivo_json = "flow.json";
                    
                    // Verificar si el archivo JSON existe
                    if (file_exists($archivo_json)) {
                        // Leer el contenido del archivo JSON
                        $json_data = file_get_contents($archivo_json);
                    
                        // Decodificar el JSON en un array de PHP
                        $datos = json_decode($json_data);
                    
                        // Verificar si la decodificación fue exitosa
                        if ($datos !== null) {
                            // Inicializar un contador
                            $contador_yust = 0;
                    
                            // Recorrer el arreglo de datos
                            foreach ($datos as $dato) {
                                
                                if (strpos($dato->nombre, "'.$id.'") !== false) {
                                    $contador_yust++;
                                }
                            }
                    
                            // Mostrar el resultado
                            echo "<span>$contador_yust</span>";
                        } else {
                            echo "<span>0</span>";
                        }
                    } else {
                        echo "<span>0</span>";
                    }
                    ?></span>
                    <span data-key="followers" class="darklight dark-mode">Seguidores</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="profile-following darklight dark-mode"><?php
                    // Ruta al archivo JSON
                    $archivo_json = "flow.json";
                    
                    // Verificar si el archivo JSON existe
                    if (file_exists($archivo_json)) {
                        // Leer el contenido del archivo JSON
                        $json_data = file_get_contents($archivo_json);
                    
                        // Decodificar el JSON en un array de PHP
                        $datos = json_decode($json_data);
                    
                        // Verificar si la decodificación fue exitosa
                        if ($datos !== null) {
                            // Inicializar un contador
                            $contador_yust = 0;
                    
                            // Recorrer el arreglo de datos
                            foreach ($datos as $dato) {
                                
                                if (strpos($dato->texto, "'.$id.'") !== false) {
                                    $contador_yust++;
                                }
                            }
                    
                            // Mostrar el resultado
                            echo "<span>$contador_yust</span>";
                        } else {
                            echo "<span>0</span>";
                        }
                    } else {
                        echo "<span>0</span>";
                    }
                    ?></span>
                    <span data-key="following" class="darklight dark-mode">Siguiendo</span>
                </a>
            </li>
        </ul>
        <style>
        .taabs.fixed {
    position: relative;
    top: 0;
    width: 100%;
    z-index: 1000;
  }

  @media (max-width: 600px) {
    
  .taabs.fixed {
    position: fixed;
    top: 52px;
    width: 100%;
    border-top: solid 1px #ccc6;
    z-index: 1000;
  }
    }
    .nav-fi{
        display: block;
    }
    @media (max-width: 600px) {
        .nav-fi{
        display: none;
    }
      }
    .f-collage {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2px;
            width: 100%;
        }
        .f-collage video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            aspect-ratio: 1 / 1; /* Mantiene las imágenes cuadradas */
        }
        .f-collage img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            aspect-ratio: 1 / 1; /* Mantiene las imágenes cuadradas */
        }
        </style>
        <!-- CONTENT -->
        <div style="display:none;" class="content-tabs tows inner-wrap taabs dark-mode">
            <div class="tabs">
            <a>
                    <span class="tab-content">
                         <svg xmlns="http://www.w3.org/2000/svg" class="posts nk" fill="#0095f6" style="height:29px; width:29px;" viewBox="0 0 16 16">
                        <path fill="#0095f6" d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
</svg>
                        <span style="color:#0095f6;" data-key="posts" class="tab-text darklight dark-mode">Publicaciones</span>
                    </span>
                </a>
            </div>

            <div class="tabs">
                <a>
                    <span class="tab-content">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" fill="#8e8e8e" class="bi tagged bi-star not_loved nk" viewBox="0 0 24 24" width="12" height="12"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"></path></svg>
                    </span>
                    <span data-key="likes" style="color: gray;" class="tab-text">Me gusta</span>
                </a>
            </div>


        </div>
        <script>
  window.addEventListener("scroll", function() {
    var navbar = document.getElementById("navbar");
    var tabs = document.querySelector(".taabs");
    var tabsPosition = tabs.offsetTop;
    
    if (window.pageYOffset >= tabsPosition) {
      tabs.classList.add("fixed");
      navbar.style.marginBottom = tabs.offsetHeight + "px"; // Añadir espacio al navbar para evitar que el contenido se solape
    } else {
      tabs.classList.remove("fixed");
      navbar.style.marginBottom = "0"; // Restaurar el margen original
    }
  });
</script>
        <!-- GALLERY -->
        <div class="f-collage">
        <?php
$archivo = "datos.json";
$datos = array();
$dedu = 0;
$Art = "'.$id.'";
if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $datos = json_decode($contenido);
}

if (isset($_POST[\'eliminar\'])) {
    $id = $_POST[\'eliminar\'];
    unset($datos->$id);

    $json_datos = json_encode($datos, JSON_PRETTY_PRINT);
    file_put_contents($archivo, $json_datos);

    header("Location: csc.php");
    exit();
}

if (isset($_GET[\'q\'])) {
    $q = $_GET[\'q\'];
    $datos = array_filter($datos, function ($dato) use ($q) {
        return strpos($dato->foto, $q) !== false
            || strpos($dato->nombre, $q) !== false
            || strpos($dato->texto, $q) !== false;
    });
}
$datos = array_reverse($datos);
?>

<?php
$promg = 0;

foreach ($datos as $id => $dato) {
    if ($dato->nombre == $Art) {
        $file = $dato->imagenes[0];

        if ($file) {
            $info = pathinfo($file);
            $extension = strtolower($info[\'extension\']);

            if ($extension === "mp4") {
                echo \'
                <a href="post.php?views=\'.($dato->id).\'">
                <video autoplay muted loop poster="https://i.pinimg.com/564x/4d/4a/93/4d4a93db12fd7400af8c404f0c5fd3d4.jpg" style="margin-bottom: 0px; object-fit: cover;" src="\'.$dato->imagenes[0].\'"></video>
                </a>\';
            }
            else if (in_array($extension, array("jpg", "jpeg", "webp", "gif", "png", "bmp", "tiff"))) {
                $imageData = base64_encode(file_get_contents($file));
                $src = \'data:image/\' . $extension . \';base64,\' . $imageData;
                echo \'
                <a href="post.php?views=\'.($dato->id).\'">
                <img style="object-fit: cover;" src="\'.$dato->imagenes[0].\'">
                </a>\';
            }
            else {
                echo \'

                \';
            }






        } else {
            echo \'<a href="post.php?views=\'.($dato->id).\'">
            <div style="background-color:\' . $dato->a1 . \';" class="contenedor-texto">
        <p class="darklight" style="font-weight:600; text-align: center; backgroud-color: transparent;">\' . (isset($dato) && isset($dato->descripcion) ? (strlen($dato->descripcion) > 45 ? substr($dato->descripcion, 0, 45) . \'...\' : $dato->descripcion) : \'\')  . \'</p>
    </div>
                
                </a>\';
        }
    } else {
        // Hacer algo en caso de que no cumpla la condición
    }
}
?>


        
                    </div>
        <!-- FOOTER -->
        <footer class="inner-wrap">
        <nav>
                <ul style="display:none;" class="links">
                    <li>ABOUT</li>
                    <li>HELP</li>
                    <li>PRESS</li>
                    <li>API</li>
                    <li>JOBS</li>
                    <li>PRVACY</li>
                    <li>TERMS</li>
                    <li>LOCATION</li>
                    
                    <li>HASHTAGS</li>
                    <li>LANGUAGE</li>
                </ul>
            </nav>
        </footer>
        <center>
                © 2024 vinlart from cloudapp corp
</center>
    </div>

     <br><br>
        </div>
        </div>
    </div>
    

        
        <style>
.contenedor-texto { 
            width: 100%;

            height: 100%;

            object-fit: cover;

            aspect-ratio: 1 / 1;

            display: flex;

            text-aling: center;

            padding:10px;

            justify-content: center;

            align-items: center;

            border: 0px solid red;

        }
       

        /* Estilos generales del botón */
        .btn-flotante {
            position: fixed;
            bottom: 50px;
            right: 20px;
            color: white;
            border: none;
            border-radius: 50%;
            padding: 13px;
            display: flex;
            background-color:white;
            border:1px solid black;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            z-index: 1000;
            display: none; /* Ocultar por defecto */
        }

        /* Mostrar el botón en pantallas móviles */
        @media (max-width: 768px) {
            .btn-flotante {
                display: flex;
            }
        }
    </style>
    <a href="share.php" class="btn-flotante" id="floatBtn"><svg style="background-color:transparent; fill:black;" class="darklight" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><g id="_01_align_center" data-name="01 align center"><polygon points="24 11 13 11 13 0 11 0 11 11 0 11 0 13 11 13 11 24 13 24 13 13 24 13 24 11"/></g></svg></a>

<script>
// Acción cuando se hace clic en el botón flotante
document.getElementById("floatBtn").addEventListener("click", function() {
    
});
</script>
<div style="border-bottom:1px #80808000 solid; height: 52px;" class="tabs_bottom tows">
    <div class="tab2 tows" style="border-bottom: 3px solid #03a9f400;" onclick="openTab()"><a href="home.php"><svg class="towse" viewBox="0 0 48 48" width="20" height="20" fill="white" class="r-1jj8364 r-lchren r-ipm5af"><path stroke-width="4" d="M 23.951 2 C 23.631 2.011 23.323 2.124 23.072 2.322 L 8.859 13.52 C 7.055 14.941 6 17.114 6 19.41 L 6 38.5 C 6 39.864 7.136 41 8.5 41 L 18.5 41 C 19.864 41 21 39.864 21 38.5 L 21 28.5 C 21 28.205 21.205 28 21.5 28 L 26.5 28 C 26.795 28 27 28.205 27 28.5 L 27 38.5 C 27 39.864 28.136 41 29.5 41 L 39.5 41 C 40.864 41 42 39.864 42 38.5 L 42 19.41 C 42 17.114 40.945 14.941 39.141 13.52 L 24.928 2.322 C 24.65 2.103 24.304 1.989 23.951 2 Z"></path></svg></a></div>
    <div class="tab2 tows" style="border-bottom: 3px solid #03a9f400;" onclick="openTab()"><a href="search.php"><svg class="tows" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20"><path d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z"></path></svg></a></div>
    <div class="tab2 tows" style="border-bottom: 3px solid #00000000;" onclick="openTab()"><a href="stat.php"><svg class="tows" xmlns="http://www.w3.org/2000/svg" id="Outline" fill="currentColor" class="bi bi-star not_loved" viewBox="0 0 24 24" width="20" height="20"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"></path></svg></a></div>
    <div class="tab2 tows" style="border-bottom: 3px solid #00000000;" onclick="openTab()"><a href="noti.php"><svg class="tows" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20"><path d="M22.555,13.662l-1.9-6.836A9.321,9.321,0,0,0,2.576,7.3L1.105,13.915A5,5,0,0,0,5.986,20H7.1a5,5,0,0,0,9.8,0h.838a5,5,0,0,0,4.818-6.338ZM12,22a3,3,0,0,1-2.816-2h5.632A3,3,0,0,1,12,22Zm8.126-5.185A2.977,2.977,0,0,1,17.737,18H5.986a3,3,0,0,1-2.928-3.651l1.47-6.616a7.321,7.321,0,0,1,14.2-.372l1.9,6.836A2.977,2.977,0,0,1,20.126,16.815Z"></path></svg></a></div>
    <div class="tab2 tows" style="border-bottom: 3px solid #00000000; text-align: center;" onclick="openTab()"><a href="profile.php"><svg class="tows light-mode" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20"><path d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z"></path><path d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z"></path></svg></a></div>
</div>


    <style>
        /* Estilos para el modal y el fondo oscuro */
        .modal2 {
            display: none;
            position: fixed;
            overflow-y: scroll;
            z-index: 99999;
            right: 0;
            top: 0;
            width: 35%;
            height: 100%;
        }

        @media screen and (max-width: 498px){
            .modal2 {
                display: none;
                position: fixed;
                z-index: 99999;
                right: 0;
                top: 0;
                width: 65%;
                height: 100%;
            }
        }

        .modal-contenido {
            top: 5%; /* Comienza fuera de la pantalla */
            left: 0%;
            padding: 25px;
            border-radius: 5px;
            width: 100%;
            height: 96vh;
            position: relative;
        }

        .cerrar-modal {
            top: 5px;
            right: 11px;
            background-color: transparent;
            position: fixed;
            z-index: 99999;
            padding: 0px;
            font-size: 26px;
            border-radius: 5px;
            cursor: pointer;
            animation: 0.5s ease forwards;
        }
    </style>
    <div id="mi-modal" class="modal2 tows dark-mode" style="display: none;">
        <div class="modal-contenido">
            <span class="cerrar-modal" id="cerrar-modal">×</span>
            <h2 class="dark-mode">QR</h2>
            
                       <br>
                       <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
                       <div style="background-color: white; padding: 15px; border-radius: 20px;" id="qrcode"></div>
                       <script>
        // Crear el código QR con la URL de la página actual
        const qrCode = new QRCode(document.getElementById("qrcode"), {
            text: window.location.href,
            width: 150,  // Ancho del QR
            height: 150  // Alto del QR
        });
    </script>
                       <br>
<br><br>
        </div>
    </div>
    <script>
        // Obtener elementos del DOM
        var botonAbrirModal = document.getElementById("abrir-modal");
        var modalc = document.getElementById("mi-modal");
        var botonCerrarModal = document.getElementById("cerrar-modal");

        // Abrir el modal cuando se hace clic en el botón
        botonAbrirModal.addEventListener("click", function() {
            modalc.style.display = "block";
        });

        // Cerrar el modal cuando se hace clic en la "x" o en el fondo oscuro
        botonCerrarModal.addEventListener("click", function() {
            modalc.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target == modalc) {
                modalc.style.display = "none";
            }
        });
    </script>
    
    <button style=" display: none;" id="toggleDarkMode" class="dark-mode">Toggle Dark Mode</button>
    <script src="dark.js"></script>
    <script>

    document.addEventListener("scroll", function() {

    const elemento = document.getElementById("miElemento");
    if (window.scrollY > 0) {
        elemento.classList.replace("hwe", "hnn");
    } else {
        elemento.classList.replace("hnn", "hwe");
    }
});
</script>

        
      


</body></html>
    ';
    // Guardar el contenido en el archivo
    file_put_contents($nombre_archivo, $contenido_archivo);
}
?>


<?php
$archivo = "usuarios.json";
$datos = array();

if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $datos = json_decode($contenido);
}

if (isset($_POST['eliminar'])) {
    $id = $_POST['eliminar'];
    if (isset($datos->$id)) {
        unset($datos->$id);
    }

    $json_datos = json_encode($datos, JSON_PRETTY_PRINT);
    file_put_contents($archivo, $json_datos);

    header("Location: csc.php");
    exit();
}

if (isset($_GET['q'])) {
    $q = $_GET['q'];
    $datos = array_filter($datos, function ($dato) use ($q) {
        return strpos($dato->imagen, $q) !== false
            || strpos($dato->nombre_completo, $q) !== false
            || strpos($dato->correo, $q) !== false;
    });
}
?>
<?php
$promg = 0;
foreach ($datos as $id => $dato) {
    // Código para mostrar los datos de usuario aquí
    // Por ejemplo:

    // Asignar el valor de las variables "tiempo", "foto" y "texto"
    $nombre = ($id);
    
    // Concatenar el valor de las variables en el nombre del archivo
    $nombre_archivo = 'flow_' . $nombre . '.php';
    // Definir el contenido del archivo (por ejemplo, una cadena vacía)
    $contenido_archivo = '
<?php
session_start();

// Verificar si el usuario ha iniciado sesión o si se ha almacenado una cookie de sesión
if (!isset($_SESSION[\'nombre\']) && !isset($_COOKIE[\'nombre\'])) {
  // Si no ha iniciado sesión y no hay una cookie de sesión, redireccionar a la página de registro
  header(\'Location: sign_up.php\');
  exit;
}

// Leer los datos de usuarios del archivo JSON
$usuarios = json_decode(file_get_contents(\'usuarios.json\'), true);

// Obtener los datos del usuario actual
if (isset($_SESSION[\'nombre\'])) {
  // Si hay una sesión activa, obtener los datos del usuario de la sesión
  $nombre = $_SESSION[\'nombre\'];
} else {
  // Si no hay una sesión activa, obtener los datos del usuario de la cookie
  $nombre = $_COOKIE[\'nombre\'];
  // Restaurar la sesión utilizando el nombre de usuario almacenado en la cookie
  $_SESSION[\'nombre\'] = $nombre;
}

// Verificar si el usuario actual existe en el archivo de usuarios
if (!array_key_exists($nombre, $usuarios)) {
  // Si el usuario no existe, redireccionar a la página de registro
  header(\'Location: sign_up.php\');
  exit;
}

// Obtener los datos del usuario actual
$usuario = $usuarios[$nombre];

// Establecer una cookie de sesión para recordar al usuario con una expiración de 3 años
if (!isset($_COOKIE[\'nombre\']) || $_COOKIE[\'nombre\'] !== $nombre) {
  setcookie(\'nombre\', $nombre, time() + (86400 * 365 * 3), \'/\'); // La cookie expirará después de 3 años
}

$d = $nombre;
$dv = $nombre;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title data-key="page"></title>
    <link rel="icon" href="logo.png">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="./dark.css">
    <script>
        (function() {
            const currentMode = localStorage.getItem("mode") || "light";
            document.documentElement.classList.add(`${currentMode}-mode`);
        })();
    </script>
                <style>
            .main-post3{
                margin: 0px 18%;
            }
            @media (max-width: 976px){
    .main-post3{
       margin: 0px 10%;
    }
}

            @media (max-width: 733px){
    .main-post3{
       margin: 0px 5%;
    }
}

            @media (max-width: 533px){
    .main-post3{
       margin: 0px;
    }
}
      
        .post-container {
            margin-top: 7px;
            border-bottom: solid 1px #ccc6;
            width: 100%;
            display: flex;
        }
        .post-image {
            flex: ;
            margin-right: 20px;
            width: 100%;
        }
        .post-image img {
            width: 100%;
            border-radius: 10px;
        }
        .post-content {
            flex: 2;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .post-text {
            margin-bottom: 20px;
        }
        .post-icons {
            display: flex;
            justify-content: flex-end;
        }
        .post-icons i {
            margin-left: 10px;
            font-size: 24px;
            cursor: pointer;
            color: #555;
        }
        .post-icons i:hover {
            color: #000;
        }
    </style>
    <!-- Importa la fuente de iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("carga").style.display = "none";
    });

    window.addEventListener("load", function() {
        document.getElementById("carga").style.display = "block";
    });
</script>
  <div id="carga" style=" display: none;">
    <!-- sidebar -->
    <div style="background-color: transparent; border-right: solid 1px #cccc;" class="sidebar">
        <a href="#" class="logo">
            <img style="width: 40px;" src="logo.png" alt="logo">
        </a>
        <!-- profile image -->
        <div class="profile">
            <div class="profile-img">
                <img style="width: 70px; height: 70px; object-fit: cover;" src="perfiles/<?php echo $usuario["imagen"] ?>" alt="profile">
            </div>
            <br>
            <h4><?php echo $d; ?></h4>
            <span><?php echo $usuario["nombre_completo"] ?></span>
        </div>
        <!-- About -->
        <div style="border: solid 0.5px #cccccc0d;" class="about">
            <!-- Box 1 -->
        </div>

        <!-- Menu -->
        <div class="menu">

            <a href="home.php" class="darklight">
                <span class="icon">
                    <i class="ri-function-line"></i>
                </span>
                <span data-key="home">Feed</span>
            </a>
           
            <a class="darklight" href="noti.php">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="17" height="17"><path d="M22.555,13.662l-1.9-6.836A9.321,9.321,0,0,0,2.576,7.3L1.105,13.915A5,5,0,0,0,5.986,20H7.1a5,5,0,0,0,9.8,0h.838a5,5,0,0,0,4.818-6.338ZM12,22a3,3,0,0,1-2.816-2h5.632A3,3,0,0,1,12,22Zm8.126-5.185A2.977,2.977,0,0,1,17.737,18H5.986a3,3,0,0,1-2.928-3.651l1.47-6.616a7.321,7.321,0,0,1,14.2-.372l1.9,6.836A2.977,2.977,0,0,1,20.126,16.815Z"></path></svg>
                </span>
                <span data-key="notifications">Notifications</span>
            </a>

            <a class="darklight" href="search.php">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="17" height="17"><path d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z"/></svg>
                </span>
                <span data-key="search">Explore</span>
            </a>

            <a class="darklight" href="stat.php">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" fill="currentColor" class="bi bi-star not_loved" viewBox="0 0 24 24" width="17" height="17"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"></path></svg>
                </span>
                <span data-key="stats">Stats</span>
            </a>

            <a class="darklight" href="text.php">
                <span class="icon">
                   <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 -0.5 24 24" width="17" height="17"><path d="M12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"></path><path d="M21.294,13.9l-.444-.256a9.1,9.1,0,0,0,0-3.29l.444-.256a3,3,0,1,0-3-5.2l-.445.257A8.977,8.977,0,0,0,15,3.513V3A3,3,0,0,0,9,3v.513A8.977,8.977,0,0,0,6.152,5.159L5.705,4.9a3,3,0,0,0-3,5.2l.444.256a9.1,9.1,0,0,0,0,3.29l-.444.256a3,3,0,1,0,3,5.2l.445-.257A8.977,8.977,0,0,0,9,20.487V21a3,3,0,0,0,6,0v-.513a8.977,8.977,0,0,0,2.848-1.646l.447.258a3,3,0,0,0,3-5.2Zm-2.548-3.776a7.048,7.048,0,0,1,0,3.75,1,1,0,0,0,.464,1.133l1.084.626a1,1,0,0,1-1,1.733l-1.086-.628a1,1,0,0,0-1.215.165,6.984,6.984,0,0,1-3.243,1.875,1,1,0,0,0-.751.969V21a1,1,0,0,1-2,0V19.748a1,1,0,0,0-.751-.969A6.984,6.984,0,0,1,7.006,16.9a1,1,0,0,0-1.215-.165l-1.084.627a1,1,0,1,1-1-1.732l1.084-.626a1,1,0,0,0,.464-1.133,7.048,7.048,0,0,1,0-3.75A1,1,0,0,0,4.79,8.992L3.706,8.366a1,1,0,0,1,1-1.733l1.086.628A1,1,0,0,0,7.006,7.1a6.984,6.984,0,0,1,3.243-1.875A1,1,0,0,0,11,4.252V3a1,1,0,0,1,2,0V4.252a1,1,0,0,0,.751.969A6.984,6.984,0,0,1,16.994,7.1a1,1,0,0,0,1.215.165l1.084-.627a1,1,0,1,1,1,1.732l-1.084.626A1,1,0,0,0,18.746,10.125Z"></path></svg>
                </span>
                <span data-key="edit">Settings</span>
            </a>

            <a class="darklight" href="logout.php">
                <span class="icon">
                    <i class="ri-logout-box-line"></i>
                </span>
                <span data-key="logout">Logout</span>
            </a>

            <a href="profile.php?user=<?php echo $d; ?>"><div style=" position: absolute; bottom: 0; width: 90%; padding: 6px; margin-bottom: 9px; border-radius: 10px;" class="post-info colors">
                    <div style=" border: solid 0px;" class="post-img">
                        <img style="width: 26px; height: 26px; object-fit: cover; border-radius: 50%; border: solid 0px;" src="perfiles/<?php echo $usuario["imagen"] ?>" alt="profile">
                    </div>
                    <h5><?php echo $d; ?></h5>
                </div></a>
        </div>
    </div>
    <!-- Main Home -->
    <div class= "main-home">
    <style>
    
    #refreshContainer {
      position: fixed;
      margin-top: 80px;
      top: 50px; /* Inicialmente oculto */
      left: 50%;
      transform: translateX(-50%);
      width: 50px;
      z-index:99999;
    object-fit: cover;
    border-radius: 30%;
      height: 30px;
      display: none;
    }

    #refreshIcon {
       width: 30px;
      z-index:99999;
    object-fit: cover;
    border-radius: 50%;
    height: 30px;
      animation: spin 1s linear infinite; /* Efecto de rotación */
    }

    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

  </style>
    <div id="refreshContainer">
    <img id="refreshIcon" src="https://i.pinimg.com/564x/40/c5/1b/40c51baaf681fe429ecc56e8dc56de81.jpg" alt="Refresh" />
  </div>

<script>
    let isRefreshing = false;
    let startY = 0;
    let pullDownThreshold = 150; // Distancia mínima para activar el refresco
    const refreshContainer = document.getElementById("refreshContainer");

    window.addEventListener("touchstart", function(e) {
        // Solo iniciar si estamos en la parte superior de la página
        if (window.scrollY === 0) {
            startY = e.touches[0].clientY;
        }
    });

    window.addEventListener("touchmove", function(e) {
        const currentY = e.touches[0].clientY;

        // Si estamos en la parte superior y el usuario desliza más de lo permitido
        if (window.scrollY === 0 && currentY - startY > pullDownThreshold) {
            refreshContainer.style.display = "block"; // Mostrar el icono de refresco
            refreshContainer.style.top = "20px"; // Moverlo a la vista
            isRefreshing = true;
        }
    });

    window.addEventListener("touchend", function() {
        if (isRefreshing) {
            // Recargar la página
            setTimeout(function() {
                location.reload(); // Recargar la página
            }, 1000); // Retardo para mostrar el icono girando

            // Restablecer el icono de refresco después de un tiempo
            setTimeout(function() {
                refreshContainer.style.display = "none";
                refreshContainer.style.top = "-100px"; // Ocultar el icono nuevamente
            }, 1500);

            isRefreshing = false; // Permitir refrescos nuevamente
        }
    });
</script>
        <div style="flex-direction: column; justify-content: center; align-items: center; color: white; position: fixed; top: 0; left: 0; z-index: 100; width: 100%; height: 32px;" class="glass-effect mass tows">
        <style>
        /* Estilos generales para el fondo */
        /* Efecto cristal */
        .glass-effect {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2); /* Borde semi-transparente */
        }
        
         @media only screen and (max-width: 768px) {
    .glass-effect {
            border-bottom: 0px solid rgba(255, 255, 255, 0.2); /* Borde semi-transparente */
        }
    }

        /* Estilos para el contenido dentro del div */
        .glass-effect h2 {
            font-size: 24px;
            margin-bottom: 0px;
        }

        .glass-effect p {
            font-size: 16px;
            line-height: 1.5;
            text-align: center;
        }
    </style>
    </div>
        <div style="border-bottom: 1px #80808021 solid; margin-top: 26px;" class="header tows">
            <!-- search -->
            <style>
            .pl{
            display: none;
        }
        @media (min-width: 768px) {
            .pl{
                display: block;
}
        }
        .pl2{
            display: block;
        }
        @media (min-width: 768px) {
            .pl2{
                display: none;
}
        }
    </style>
            <img class="pl2" style="width: 35px;" src="logo.png" alt="logo">
            <a class="pl" href="search.php"><div class="search colors">
                <svg  class="darklight" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="24" height="24"><path d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z"/></svg>
                <input type="text" name="" id="" placeholder="Search">
            </div></a>
            <div class="header-content">
                
                
                <!-- Button -->
                <a style="margin-right:5px; justify-content: center; align-items: center; padding:0px; background-color:transparent;" href="share.php">         
                    <svg style="margin-top:8px; background-color:transparent" class="tows" xmlns="http://www.w3.org/2000/svg" id="Layer_1" width="21" height="21" viewBox="0 0 24 24" data-name="Layer 1"><path d="m12 0a12 12 0 1 0 12 12 12.013 12.013 0 0 0 -12-12zm0 22a10 10 0 1 1 10-10 10.011 10.011 0 0 1 -10 10zm5-10a1 1 0 0 1 -1 1h-3v3a1 1 0 0 1 -2 0v-3h-3a1 1 0 0 1 0-2h3v-3a1 1 0 0 1 2 0v3h3a1 1 0 0 1 1 1z"></path></svg>
                </a>
            </div>
    
        </div>
        <br>
        <div style="padding: 20px;">
        
        
       
        <div  class="main-post3">
            <!--Box 1-->
   <style>
* {
  box-sizing: border-box;
}

nav {
  z-index: 999;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 59px;
  display: flex;
  box-shadow: 0 2px 4px rgb(0 0 0 / 6%);
  align-items: center;
  justify-content: space-between;
  background-color: white;
  padding: 14px 20px;
}

.nav-logo {
  display: inline-block;
  width: 30px;
  height: 30px;
  font-size: 18px;
  color: black;
  font-family: helvetica;
  margin-right: 10px;
}

.nav-text {
  flex-grow: 1;
  text-align: center;
}

.nav-logo-right {
  display: inline-block;
  width: 30px;
  height: 30px;
  font-size: 20px;
  color: red;
  font-family: helvetica;
  margin-left: 10px;
  margin-right: 10px;
}

#eee:focus-visible{
    border:solid 0px transparent;
    outline-offset: 0px;
    border-color:transparent;
    outline: -webkit-focus-ring-color auto 0px;
}
.jjk:focus-visible{
    border:solid 0px transparent;
    outline-offset: 0px;
    border-color:transparent;
    outline: -webkit-focus-ring-color auto 0px;
}
.stories-title {
  display: flex;
  justify-content: space-between;
  margin-top: 2rem;
}
.stories-title h1 {
  font-size: 1.8rem;
}
.stories-title .btn {
  display: flex;
  align-items: center;
}
.stories-title .btn i {
  font-size: 24px;
  margin-right: 10px;
}
.stories {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 2rem;
}
.stories-img {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 80px;
  height: 80px;
  border-radius: 50%;
  border: 2px solid #e2336b;
}
.stories-img img {
  width: 70px;
  height: 70px;
  object-fit: cover;
  border-radius: 50%;
  object-position: center;
}
.stories-img .color {
  border: 2px solid #dbdbdb;
}
.stories-img .add {
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  width: 70px;
  height: 70px;
  border-radius: 50%;
  color: #fff;
  background: hsla(246, 100%, 67%, 0.7);
}
.post-info {
  display: flex;
  align-items: center;
  justify-content: left;
}
.post-img {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 35px;
  height: 35px;
  margin-right: 3px;
  border: 2px solid #e2336b;
  border-radius: 50%;
}
.post-imge{
  width: auto;
  border-radius: 50%;
}
.post-img img {
  width: 27px;
  height: 27px;
  object-fit: cover;
  border-radius: 50%;
  object-position: center;
}
.post-profile {
  display: flex;
  align-items: center;
}
.post-profile h3 {
  font-size: 12px;
  font-weight: 600px;
  margin-left: 5px;
}
</style>

<div class="container mx-auto">
  <br><br>

        <div style="border-bottom:solid 1px #94909054;" class="ghu">
            <span style="margin-bottom:10px; font-family:helvetica; color:#7e7e7ecf; font-size:13px;">
            <div class="perfil">
            
            <div style="padding: 0px 7px;" class="stories-title darklight dark-mode">
        
            <div class="post-info">
                <div style="border: solid 0px; margin-left: 4px" class="post-img">
                    <img style="object-fit: cover; border-radius: 50%; max-width: 45px; max-height: 45px; min-width: 45px; min-height: 45px;" src="<?php
    $nombreUsuario = "'.$id.'";
                     
    // Obtener el contenido del archivo JSON
    $json = file_get_contents("usuarios.json");
                     
    // Decodificar el JSON en un array de PHP
    $data = json_decode($json, true);
                     
    // Verificar si el usuario "hola5" existe en el archivo JSON
    if (isset($data[$nombreUsuario])) {
        $usuario = $data[$nombreUsuario];
                         
        // Verificar si el usuario tiene el campo "imagen" y si no está vacío
        if (isset($usuario["imagen"]) && !empty($usuario["imagen"])) {
            $rutaImagen = "perfiles/" . $usuario["imagen"];
            echo $rutaImagen; // Corrección: se agregó el cierre de comillas y punto y coma
        } else {
            echo "El usuario no tiene una imagen definida o está vacía.";
        }
    } else {
        echo "El usuario no existe en el archivo JSON.";
    }
    ?>" alt="profile">
                </div>
                <div style="position: relative; text-align: left; display: flex; flex-direction: column; align-items: left; justify-content: center; margin-left: 0.4rem;">
                    <span style="text-align: left;"><?php
      $nombreUsuario = "'.$id.'";
                       
      // Obtener el contenido del archivo JSON
      $json = file_get_contents("usuarios.json");
                       
      // Decodificar el JSON en un array de PHP
      $data = json_decode($json, true);
                       
      // Verificar si el usuario "hola5" existe en el archivo JSON
      if (isset($data[$nombreUsuario])) {
          $usuario = $data[$nombreUsuario];
                           
          // Verificar si el usuario tiene el campo "imagen" y si no está vacío
          if (isset($usuario["nombre_completo"]) && !empty($usuario["nombre_completo"])) {
              $rutaImagen = "" . $usuario["nombre_completo"];
              echo $rutaImagen; // Corrección: se agregó el cierre de comillas y punto y coma
          } else {
              echo "El usuario no tiene una imagen definida o está vacía.";
          }
      } else {
          echo "El usuario no existe en el archivo JSON.";
      }
      ?></span>
                    <div style="font-size: 12px; color: gray; text-align: left;"><?php
                                    // Ruta al archivo JSON
                                    $archivo_json = "flow.json";
                                    
                                    // Verificar si el archivo JSON existe
                                    if (file_exists($archivo_json)) {
                                        // Leer el contenido del archivo JSON
                                        $json_data = file_get_contents($archivo_json);
                                    
                                        // Decodificar el JSON en un array de PHP
                                        $datos = json_decode($json_data);
                                    
                                        // Verificar si la decodificación fue exitosa
                                        if ($datos !== null) {
                                            // Inicializar un contador
                                            $contador_yust = 0;
                                    
                                            // Recorrer el arreglo de datos
                                            foreach ($datos as $dato) {
                                                
                                                if (strpos($dato->nombre, "'.$id.'") !== false) {
                                                    $contador_yust++;
                                                }
                                            }
                                    
                                            // Mostrar el resultado
                                            echo "<span>$contador_yust</span>";
                                        } else {
                                            echo "<span>0</span>";
                                        }
                                    } else {
                                        echo "<span>0</span>";
                                    }
                                    ?> <span data-key="follow">Seguidor</span></div>
                </div>
            </div>
            <span class="btn darklight dark-mode">
                <<?php
    $archivo_json = "flow.json";
    $usuario_actual = "' . $id . '"; // Cambia esto al valor correspondiente al usuario actual
    $otro_usuario = "'.$d.'"; // Cambia esto al valor correspondiente al otro usuario
    
    if (file_exists($archivo_json)) {
        $json_data = file_get_contents($archivo_json);
        $datos = json_decode($json_data);
    
        if ($datos !== null) {
            $siguiendo = false;
    
            foreach ($datos as $dato) {
                if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                                $siguiendo_actual = true;
                            }
            }
    
            echo ($siguiendo && $otro_usuario === "'.$d.'") ? "a" : "form";
        } else {
            echo "form";
        }
    } else {
        echo "form";
    }
    ?> id="comment-form" style="display: <?php
$soy_Y = "'.$id.'";
$soy_X = "'.$d.'";
if ($soy_Y == $soy_X) {
    echo "none";
} else {
    // Si las variables son diferentes, se redirige a la página anterior
    echo "block";
}
?>;" action="<?php
                $archivo_json = "flow.json";
                
                if (file_exists($archivo_json)) {
                    $json_data = file_get_contents($archivo_json);
                    $datos = json_decode($json_data);
                
                    if ($datos !== null) {
                        $siguiendo = false;
                
                        foreach ($datos as $dato) {
                            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                                $siguiendo = true;
                                break; // Sal del bucle una vez que encuentres una coincidencia
                            }
                        }
                
                        echo ($siguiendo && $otro_usuario === "'.$d.'") ? "flow.php" : "seguir.php";
                    } else {
                        echo "seguir.php";
                    }
                } else {
                    echo "seguir.php";
                }
                ?>" method="post" enctype="multipart/form-data">
                              
                <input style="display:none;" type="text" name="foto" value="<?php echo $usuario["nombre_completo"]; ?>">
                <input style="display:none;" type="text" name="ft" value="<?php echo $usuario["imagen"]; ?>">
                <input style="display:none;" type="text" name="tiempo" value="<?php echo date("d/M/Y");?>">
                <input style="display:none;" type="text" name="texto" value="<?php echo $d ?>">
                <input style="display:none;" type="text" name="nombre" value="' . $id . '"> 
                <<?php
                $archivo_json = "flow.json";
               
                if (file_exists($archivo_json)) {
                    $json_data = file_get_contents($archivo_json);
                    $datos = json_decode($json_data);
                
                    if ($datos !== null) {
                        $siguiendo_actual = false;
                        $siguiendo_otro = false;
                
                        foreach ($datos as $dato) {
                             if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                                $siguiendo_actual = true;
                            }
                            if ($dato->nombre === $otro_usuario && $dato->texto === $usuario_actual) {
                                $siguiendo_otro = true;
                            }
                        }
                
                        if ($siguiendo_actual && $siguiendo_otro) {
                            echo "button";
                        } elseif ($siguiendo_actual && !$siguiendo_otro) {
                            echo "button";
                        } elseif (!$siguiendo_actual && $siguiendo_otro) {
                            echo "button";
                        } else {
                            echo "button";
                        }
                    } else {
                        echo "button";
                    }
                } else {
                    echo "button";
                }
                ?> onclick="<?php
                $archivo_json = "flow.json";
                
                if (file_exists($archivo_json)) {
                    $json_data = file_get_contents($archivo_json);
                    $datos = json_decode($json_data);
                
                    if ($datos !== null) {
                        $siguiendo_actual = false;
                        $siguiendo_otro = false;
                
                        foreach ($datos as $dato) {
                             if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                                $siguiendo_actual = true;
                            }
                            if ($dato->nombre === $otro_usuario && $dato->texto === $usuario_actual) {
                                $siguiendo_otro = true;
                            }
                        }
                
                        if ($siguiendo_actual && $siguiendo_otro) {
                            echo "openModal()";
                        } elseif ($siguiendo_actual && !$siguiendo_otro) {
                            echo "openModal()";
                        } elseif (!$siguiendo_actual && $siguiendo_otro) {
                            echo "";
                        } else {
                            echo "";
                        }
                    } else {
                        echo "";
                    }
                } else {
                    echo "";
                }
                ?>" style="background-color: <?php
                $archivo_json = "flow.json";
               
                if (file_exists($archivo_json)) {
                    $json_data = file_get_contents($archivo_json);
                    $datos = json_decode($json_data);
                
                    if ($datos !== null) {
                        $siguiendo = false;
                
                        foreach ($datos as $dato) {
                            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                                $siguiendo = true;
                                break; // Sal del bucle una vez que encuentres una coincidencia
                            }
                        }
                
                        echo ($siguiendo && $otro_usuario === "'.$d.'") ? "#202020" : "transparent";
                    } else {
                        echo "transparent";
                    }
                } else {
                    echo "transparent";
                }
                ?>; color:<?php
                $archivo_json = "flow.json";
                
                if (file_exists($archivo_json)) {
                    $json_data = file_get_contents($archivo_json);
                    $datos = json_decode($json_data);
                
                    if ($datos !== null) {
                        $siguiendo = false;
                
                        foreach ($datos as $dato) {
                            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                                $siguiendo = true;
                                break; // Sal del bucle una vez que encuentres una coincidencia
                            }
                        }
                
                        echo ($siguiendo && $otro_usuario === "'.$d.'") ? "white" : "rgb(3, 169, 244)";
                    } else {
                        echo "rgb(3, 169, 244)";
                    }
                } else {
                    echo "rgb(3, 169, 244)";
                }
                ?>; justify-content: center; transform: rotate(0deg); display: flex; padding: 8px 15px; border-radius: 26px; border:solid 1px <?php
                $archivo_json = "flow.json";
                
                if (file_exists($archivo_json)) {
                    $json_data = file_get_contents($archivo_json);
                    $datos = json_decode($json_data);
                
                    if ($datos !== null) {
                        $siguiendo = false;
                
                        foreach ($datos as $dato) {
                            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                                $siguiendo = true;
                                break; // Sal del bucle una vez que encuentres una coincidencia
                            }
                        }
                
                        echo ($siguiendo && $otro_usuario === "'.$d.'") ? "transparent" : "rgb(3, 169, 244)";
                    } else {
                        echo "rgb(3, 169, 244)";
                    }
                } else {
                    echo "rgb(3, 169, 244)";
                }
                ?>; font-size: 16px;" type="<?php
                $archivo_json = "flow.json";
               
                if (file_exists($archivo_json)) {
                    $json_data = file_get_contents($archivo_json);
                    $datos = json_decode($json_data);
                
                    if ($datos !== null) {
                        $siguiendo_actual = false;
                        $siguiendo_otro = false;
                
                        foreach ($datos as $dato) {
                             if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                                $siguiendo_actual = true;
                            }
                            if ($dato->nombre === $otro_usuario && $dato->texto === $usuario_actual) {
                                $siguiendo_otro = true;
                            }
                        }
                
                        if ($siguiendo_actual && $siguiendo_otro) {
                            echo "text";
                        } elseif ($siguiendo_actual && !$siguiendo_otro) {
                            echo "text";
                        } elseif (!$siguiendo_actual && $siguiendo_otro) {
                            echo "submit";
                        } else {
                            echo "submit";
                        }
                    } else {
                        echo "submit";
                    }
                } else {
                    echo "submit";
                }
                ?>" id="<?php
                $archivo_json = "flow.json";
                
                if (file_exists($archivo_json)) {
                    $json_data = file_get_contents($archivo_json);
                    $datos = json_decode($json_data);
                
                    if ($datos !== null) {
                        $siguiendo = false;
                
                        foreach ($datos as $dato) {
                            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                                $siguiendo = true;
                                break; // Sal del bucle una vez que encuentres una coincidencia
                            }
                        }
                
                        echo ($siguiendo && $otro_usuario === "'.$d.'") ? "eliminarDatos" : "";
                    } else {
                        echo "";
                    }
                } else {
                    echo "";
                }
                ?>"><?php
                $archivo_json = "flow.json";
                
                if (file_exists($archivo_json)) {
                    $json_data = file_get_contents($archivo_json);
                    $datos = json_decode($json_data);
                
                    if ($datos !== null) {
                        $siguiendo_actual = false;
                        $siguiendo_otro = false;
                
                        foreach ($datos as $dato) {
                            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                                $siguiendo_actual = true;
                            }
                            if ($dato->nombre === $otro_usuario && $dato->texto === $usuario_actual) {
                                $siguiendo_otro = true;
                            }
                        }
                
                        if ($siguiendo_actual && $siguiendo_otro) {
                            echo "<span data-key=\'friends\'></span>";
                        } elseif ($siguiendo_actual && !$siguiendo_otro) {
                            echo "<span data-key=\'following\'></span>";
                        } elseif (!$siguiendo_actual && $siguiendo_otro) {
                            echo "<span data-key=\'followers\'></span>";
                        } else {
                            echo "<span data-key=\'follow\'></span>";
                        }
                    } else {
                        echo "<span data-key=\'follow\'></span>";
                    }
                } else {
                    echo "<span data-key=\'follow\'></span>";
                }
                ?>
                <?php
                $archivo_json = "flow.json";
                
                if (file_exists($archivo_json)) {
                    $json_data = file_get_contents($archivo_json);
                    $datos = json_decode($json_data);
                
                    if ($datos !== null) {
                        $siguiendo_actual = false;
                        $siguiendo_otro = false;
                
                        foreach ($datos as $dato) {
                            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                                $siguiendo_actual = true;
                            }
                            if ($dato->nombre === $otro_usuario && $dato->texto === $usuario_actual) {
                                $siguiendo_otro = true;
                            }
                        }
                
                        if ($siguiendo_actual && $siguiendo_otro) {
                            echo "</button>";
                        } elseif ($siguiendo_actual && !$siguiendo_otro) {
                            echo "</button>";
                        } elseif (!$siguiendo_actual && $siguiendo_otro) {
                            echo "</button>";
                        } else {
                            echo "</button>";
                        }
                    } else {
                        echo "</button>";
                    }
                } else {
                    echo "</button>";
                }
                ?>
                </<?php
                $archivo_json = "flow.json";
               
                if (file_exists($archivo_json)) {
                    $json_data = file_get_contents($archivo_json);
                    $datos = json_decode($json_data);
                
                    if ($datos !== null) {
                        $siguiendo = false;
                
                        foreach ($datos as $dato) {
                            if ($dato->nombre === $usuario_actual && $dato->texto === $otro_usuario) {
                                $siguiendo = true;
                                break; // Sal del bucle una vez que encuentres una coincidencia
                            }
                        }
                
                        echo ($siguiendo && $otro_usuario === "'.$d.'") ? "a" : "form";
                    } else {
                        echo "form";
                    }
                } else {
                    echo "form";
                }
                ?>>
                <script>
        document.getElementById("eliminarDatos").addEventListener("click", function() {
            // Preguntar al usuario si realmente desea eliminar la publicación
            var confirmar = confirm("¿Seguro que quieres dejar de seguir a '.$id.'?");
            
            if (confirmar) {
                // Realizar una solicitud AJAX para cargar el archivo JSON
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "flow.json", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Parsear el JSON
                        var data = JSON.parse(xhr.responseText);

                        // Filtrar y eliminar el objeto JSON específico
                        var newData = data.filter(function(item) {
                            return !(item.nombre === "'.$id.'" && item.texto === "'.$d.'");
                        });

                        // Convertir el nuevo array de datos en JSON
                        var jsonResult = JSON.stringify(newData, null, 2);

                        // Realizar una solicitud AJAX para sobrescribir el archivo JSON en el servidor a través de PHP
                        var xhr2 = new XMLHttpRequest();
                        xhr2.open("POST", "", true); // Dejar en blanco la URL para que la solicitud vaya a la misma página
                        xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr2.onreadystatechange = function () {
                            if (xhr2.readyState === 4) {
                                if (xhr2.status === 200) {
                                    console.log("Datos eliminados satisfactoriamente.");
                                    // Redirigir a perfil.php después de la eliminación
                                    alert("Dejaste de seguir a '.$id.'");
                                    window.location.href = "@'.$id.'.php";
                                    return;
                                } else {
                                    console.error("Error al eliminar datos.");
                                    alert("Error al eliminar datos.");
                                }
                            }
                        };
                        xhr2.send("json=" + encodeURIComponent(jsonResult)); // Enviar los datos JSON a través de PHP en la misma página
                    }
                };
                xhr.send();
            } else {
                // El usuario canceló la eliminación, no se realiza ninguna acción
                console.log("Eliminación cancelada por el usuario.");
            }
        });
    </script>


    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Manejar la solicitud POST para sobrescribir el archivo JSON
        $json = $_POST["json"];
        file_put_contents("flow.json", $json);
        echo "OK";

        // Eliminar los archivos PHP
        $phpFile1 = "kkk.php";
        $phpFile2 = "@kkk.php";

        if (file_exists($phpFile1)) {
            unlink($phpFile1);
        }

        if (file_exists($phpFile2)) {
            unlink($phpFile2);
        }
    }
    ?>
            </span>
        </div>
            
          
    
  </div>
        </span>
        <br>
        


        <div class="tabs">
            

            <div class="tab" style="border-bottom: 3px solid #03a9f400; color: #78858f; font-weight: 400; text-align:left;">
            <a href="@'.$id.'.php"><span style="display:none; color: white; padding: 5px 9px; font-size: 15px; margin-left: 0px; border-radius: 10px; border: none; font-weight: 500; background-color: transparent;" class="">
    <?php

    // Ruta al archivo data.json
    $ruta_archivo = "datos.json";
    
    // Lee el contenido del archivo en una cadena
    $contenido = file_get_contents($ruta_archivo);
    
    // Decodifica la cadena JSON en un array asociativo
    $data = json_decode($contenido, true);
    
    // Contador para contar las coincidencias
    $contador = 0;
    
    // Itera sobre el array buscando coincidencias
    foreach ($data as $elemento) {
        if (isset($elemento["nombre"]) && $elemento["nombre"] === "'.$id.'") {
            $contador++;
        }
    }
    
    // Imprime el resultado
    echo $contador;
    ?> <span class="pat" style="font-weight: 400; color: white;">Post</span>
                                    </span></a>
                                    </div>

            

        </div>
<div style="border-top: solid 1px #80808036; display:none; padding-top: 9px;" class="tabs">
                    <div class="tab" style="border-bottom: 3px solid #03a9f400; text-align:center; display:block;">
            <a class="" href="@'.$dato->nombre.'.php"><svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="22" height="22"><path d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z"/><path d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z"/></svg></a>
            </div> 

            <div class="tab" style="border-bottom: 3px solid #03a9f400;text-align: center;"><a class="" href="status_'.$dato->nombre.'.php"><svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" height="22" viewBox="0 0 24 24" width="22" data-name="Layer 1"><path d="M20.494,7.968l-9.54-7A5,5,0,0,0,3,5V19a5,5,0,0,0,7.957,4.031l9.54-7a5,5,0,0,0,0-8.064Zm-1.184,6.45-9.54,7A3,3,0,0,1,5,19V5A2.948,2.948,0,0,1,6.641,2.328,3.018,3.018,0,0,1,8.006,2a2.97,2.97,0,0,1,1.764.589l9.54,7a3,3,0,0,1,0,4.836Z"></path></svg></a></div>
            
            <div class="tab" style="border-bottom: 3px solid #03a9f400;text-align: center;"><form id="miFormulario" action="share.php" method="post">
    <input type="hidden" name="texto" value="@'.$dato->nombre.'">
    <button style="background-color:transparent; border:0px solid;" type="submit">
    <a><span class="pat" style="font-size: 16px; font-weight: 400; color: #7b8892;"><svg onclick="toggleList()" xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="white" class="bi bi-camera-video" viewBox="0 0 16 16">     <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path></svg></span></a>
    </button>
</form></div>

            <div class="tab" style="border-bottom: 3px solid #03a9f400; text-align:center;">
            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="22" height="22"><path d="M20.358,7.5l3.237-4.297c.459-.609,.533-1.413,.192-2.096s-1.026-1.107-1.79-1.107H4C1.794,0,0,1.794,0,4V23c0,.553,.448,1,1,1s1-.447,1-1V15H21.998c.764,0,1.449-.425,1.79-1.107s.267-1.486-.192-2.096l-3.237-4.297ZM2,13V4c0-1.103,.897-2,2-2H21.998l-3.69,4.898c-.268,.356-.268,.847,0,1.203l3.69,4.898H2Z"/></svg>
            </div>
        </div>


    </div>
       


                </div>
  <br>
</div>


        <br><br>
        </div>
        </div>
    </div>
    

    <div style="border-bottom:1px #80808000 solid;" class="tabs_bottom tows">
        <div class="tab2 tows" style="border-bottom: 3px solid #03a9f400;" onclick="openTab()"><a href="home.php"><svg class="towse" viewBox="0 0 48 48" width="20" height="20"  fill="transparent" class="r-1jj8364 r-lchren r-ipm5af"><path stroke-width="4" d="M 23.951 2 C 23.631 2.011 23.323 2.124 23.072 2.322 L 8.859 13.52 C 7.055 14.941 6 17.114 6 19.41 L 6 38.5 C 6 39.864 7.136 41 8.5 41 L 18.5 41 C 19.864 41 21 39.864 21 38.5 L 21 28.5 C 21 28.205 21.205 28 21.5 28 L 26.5 28 C 26.795 28 27 28.205 27 28.5 L 27 38.5 C 27 39.864 28.136 41 29.5 41 L 39.5 41 C 40.864 41 42 39.864 42 38.5 L 42 19.41 C 42 17.114 40.945 14.941 39.141 13.52 L 24.928 2.322 C 24.65 2.103 24.304 1.989 23.951 2 Z"></path></svg></a></div>
        <div class="tab2 tows" style="border-bottom: 3px solid #03a9f400;" onclick="openTab()"><a href="search.php"><svg class="tows" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20"><path d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z"></path></svg></a></div>
        <div class="tab2 tows" style="border-bottom: 3px solid #00000000;" onclick="openTab()"><a href="stat.php"><svg class="tows" xmlns="http://www.w3.org/2000/svg" id="Outline" fill="currentColor" class="bi bi-star not_loved" viewBox="0 0 24 24" width="20" height="20"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"></path></svg></a></div>
        <div class="tab2 tows" style="border-bottom: 3px solid #00000000;" onclick="openTab()"><a href="noti.php"><svg class="tows" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20"><path d="M22.555,13.662l-1.9-6.836A9.321,9.321,0,0,0,2.576,7.3L1.105,13.915A5,5,0,0,0,5.986,20H7.1a5,5,0,0,0,9.8,0h.838a5,5,0,0,0,4.818-6.338ZM12,22a3,3,0,0,1-2.816-2h5.632A3,3,0,0,1,12,22Zm8.126-5.185A2.977,2.977,0,0,1,17.737,18H5.986a3,3,0,0,1-2.928-3.651l1.47-6.616a7.321,7.321,0,0,1,14.2-.372l1.9,6.836A2.977,2.977,0,0,1,20.126,16.815Z"></path></svg></a></div>
        <div class="tab2 tows" style="border-bottom: 3px solid #00000000; text-align: center;" onclick="openTab()"><a href="profile.php"><svg class="tows" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20"><path d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z"/><path d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z"/></svg></a></div>
    </div>
    <button style=" display: none;" id="toggleDarkMode" class="dark-mode">Toggle Dark Mode</button>
    <script src="dark.js"></script>
</div>
</body>

</html>

    ';
    // Guardar el contenido en el archivo
    file_put_contents($nombre_archivo, $contenido_archivo);
}
?>