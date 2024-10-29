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
<!DOCTYPE html>

<head>
     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title data-key="home"></title>
    <link rel="icon" href="logo.png">
<meta property="og:title" content="Vinlart">
    <meta name="description" content="Vinlart es una red social de retroalimentación. Sube tus fotos y vídeos." lang="es">
    <meta name="description" content="Vinlart is a feedback social network. Upload your photos and videos." lang="en">
    <meta name="description" content="Vinlart est un réseau social de rétroaction. Téléchargez vos photos et vidéos." lang="fr">
    <meta name="description" content="Vinlart è una rete sociale di feedback. Carica le tue foto e video." lang="it">
    <meta name="description" content="Vinlart é uma rede social de feedback. Faça upload das suas fotos e vídeos." lang="pt">
    <meta name="description" content="Vinlart es una red social de retroalimentación. Carrega as tuas fotos e vídeos." lang="gl">
    <meta name="keywords" content="fotos, photo, video, social, entretenimiento, feedback, vinlart">
    <meta name="author" content="vinlart corp">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./dark.css" />
    <link rel="manifest" href="/manifest.json">

    <ul style="display:none;">
                <li><a href="home.php">home</a></li>
                <li><a href="login.php">login</a></li>
                <li><a href="share.php">share</a></li>
            </ul>
    <script>
        (function() {
            const currentMode = localStorage.getItem('mode') || 'light';
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
    .form-container {
            margin: 20px;
        }
        /* Estilos del modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgb(68 68 68 / 25%);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }
        .close {
            float: right;
            font-size: 20px;
            cursor: pointer;
        }

        /* Posicionar modal en el centro para pantallas grandes (PC) */
        @media (min-width: 768px) {
            .modal {
                justify-content: center;
                align-items: center;
            }
        }

        /* Posicionar modal en la parte inferior para pantallas pequeñas (móviles) */
        @media (max-width: 767px) {
            .modal-content {
                position: absolute;
                bottom: 0;
                width: 100%;
                border-radius: 15px 15px 0 0;
            }
        }

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
            <a href=" profile.php?user=<?php echo $d; ?>"><div class="profile-img">
                <img style="width: 70px; height: 70px; object-fit: cover;<?php
session_start();

$usuarios = json_decode(file_get_contents('usuarios.json'), true);

if (isset($_SESSION['nombre'])) {
    $nombre = $_SESSION['nombre'];
} elseif (isset($_COOKIE['nombre'])) {
    $nombre = $_COOKIE['nombre'];
    $_SESSION['nombre'] = $nombre;
}

if (isset($nombre) && array_key_exists($nombre, $usuarios)) {
    echo '';
} else {
    echo 'display:none;';
}
?>" src="perfiles/<?php echo $usuario['imagen'] ?>" alt="profile">
            </div></a>
            <br>
            <h4><?php echo $d; ?></h4>
            <span><?php echo $usuario['nombre_completo'] ?></span>
        </div>
        <!-- About -->
        <div style="border: solid 0.5px #cccccc0d;" class="about">
            <!-- Box 1 -->
        </div>

        <!-- Menu -->
        <div class="menu">
            <a href="home.php" class=active>
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

            <a style="<?php
session_start();

$usuarios = json_decode(file_get_contents('usuarios.json'), true);

if (isset($_SESSION['nombre'])) {
    $nombre = $_SESSION['nombre'];
} elseif (isset($_COOKIE['nombre'])) {
    $nombre = $_COOKIE['nombre'];
    $_SESSION['nombre'] = $nombre;
}

if (isset($nombre) && array_key_exists($nombre, $usuarios)) {
    echo '';
} else {
    echo 'display:none;';
}
?>" href="profile.php?user=<?php echo $d; ?>"><div style=" position: absolute; bottom: 0; width: 90%; padding: 6px; margin-bottom: 9px; border-radius: 10px;" class="post-info colors">
                    <div style=" border: solid 0px;" class="post-img">
                        <img style="width: 26px; height: 26px; object-fit: cover; border-radius: 50%; border: solid 0px;" src="perfiles/<?php echo $usuario['imagen'] ?>" alt="profile">
                    </div>
                    <h5><?php echo $d; ?></h5>
                </div></a>
        </div>

    </div>
    <!-- Main Home -->
    <div class= "main-home">
        <div style="flex-direction: column; justify-content: center; align-items: center; color: white; position: fixed; top: 0; left: 0; z-index: 100; width: 100%; height: 32px;" class="glass-effect mass tows">
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
    <center><img style="<?php
session_start();

$usuarios = json_decode(file_get_contents('usuarios.json'), true);

if (isset($_SESSION['nombre'])) {
    $nombre = $_SESSION['nombre'];
} elseif (isset($_COOKIE['nombre'])) {
    $nombre = $_COOKIE['nombre'];
    $_SESSION['nombre'] = $nombre;
}

if (isset($nombre) && array_key_exists($nombre, $usuarios)) {
    echo '';
} else {
    echo 'display:none;';
}
?> margin-top: 7px; width: 12px; height: 12px; object-fit: cover; border-radius: 50%; border: solid 0px;" src="perfiles/<?php echo $usuario['imagen'] ?>" alt="profile">
    <img style="margin-top: 7px; width: 12px; height: 12px; object-fit: cover; border-radius: 50%; border: solid 0px;" src="https://i.pinimg.com/564x/87/03/3f/87033fcb65eaf4cadac3cdc2b60ffe25.jpg" alt="profile">
    <img style="margin-top: 7px; width: 12px; height: 12px; object-fit: cover; border-radius: 50%; border: solid 0px;" src="https://i.pinimg.com/564x/40/c5/1b/40c51baaf681fe429ecc56e8dc56de81.jpg" alt="profile">
    </center>
    </div>
        <div style="border-bottom: 1px #80808021 solid; margin-top: 32px;" class="header tows">
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
                
 <a href="login.php" style="margin-right:8px; background-color:red; color:white; <?php
session_start();

$usuarios = json_decode(file_get_contents('usuarios.json'), true);

if (isset($_SESSION['nombre'])) {
    $nombre = $_SESSION['nombre'];
} elseif (isset($_COOKIE['nombre'])) {
    $nombre = $_COOKIE['nombre'];
    $_SESSION['nombre'] = $nombre;
}

if (isset($nombre) && array_key_exists($nombre, $usuarios)) {
    echo 'display:none;';
} else {
    echo '';
}
?>" data-key="login" class="btn">         
                    login
                </a>
                <!-- Button -->
                <a style="margin-right:5px; justify-content: center; align-items: center; padding:0px; background-color:transparent;" href="share.php">         
                    <svg style="margin-top:8px; background-color:transparent" class="tows" xmlns="http://www.w3.org/2000/svg" id="Layer_1" width="21" height="21" viewBox="0 0 24 24" data-name="Layer 1"><path d="m12 0a12 12 0 1 0 12 12 12.013 12.013 0 0 0 -12-12zm0 22a10 10 0 1 1 10-10 10.011 10.011 0 0 1 -10 10zm5-10a1 1 0 0 1 -1 1h-3v3a1 1 0 0 1 -2 0v-3h-3a1 1 0 0 1 0-2h3v-3a1 1 0 0 1 2 0v3h3a1 1 0 0 1 1 1z"></path></svg>
                </a>
            </div>
    
        </div>
        <br><br>
        <div style="padding: 20px;">
        <div class="stories-title darklight">
            <h1 data-key="views">views</h1>
            <span href="#" class="btn darklight">
                <i class="ri-play-circle-fill"></i>
                <div data-key="explore" class="text">
                    Watch all
                </div>
            </span> 
        </div>
        
        <div class="feed">
                <h1 data-key="feed">Feed</h1>
                <div class="feed-text">
                    <br><span data-key="post">Latest </h2>
                    <span data-key="popular">Popular</span>
                </div>
        </div>
        <div  class="main-post3">
            <!--Box 1-->
            <?php $yd = $usuario['ideoma'] ?>
            <?php
				$n1 = $usuario['link'];
				$n2 = $usuario['redaccion'];
				$n3 = $usuario['ideoma'];
				?>
            <?php
$archivo = "datos.json";
$datos = array();
if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $datos = json_decode($contenido, true); // Decodificar como array asociativo
}

if (isset($_POST['eliminar'])) {
    $id = $_POST['eliminar'];
    unset($datos[$id]);

    $json_datos = json_encode($datos, JSON_PRETTY_PRINT);
    file_put_contents($archivo, $json_datos);

    header("Location: csc.php");
    exit();
}

if (isset($_GET['q'])) {
    $q = $_GET['q'];
    $datos = array_filter($datos, function ($dato) use ($q) {
        return strpos($dato['imagenes'][0], $q) !== false
            || strpos($dato['nombre'], $q) !== false
            || strpos($dato['categoria'], $q) !== false
            || strpos($dato['id'], $q) !== false
            || strpos($dato['descripcion'], $q) !== false;
    });
}

// Dividir los datos en dos grupos: uno que cumple con las condiciones y otro que no
$datos_cumplen = array_filter($datos, function ($dato) use ($n1, $n2, $n3) {
    return $dato['pais'] === $n3;
});

$datos_no_cumplen = array_diff_key($datos, $datos_cumplen);

// Barajar los datos que cumplen con las condiciones
shuffle($datos_cumplen);

// Obtener los primeros 40 elementos de $datos_cumplen
$datos_cumplen = array_slice($datos_cumplen, 0, 1000);

// Obtener los primeros 10 elementos de $datos_no_cumplen
$datos_no_cumplen = array_slice($datos_no_cumplen, 0, 50);

// Combinar ambos arrays
$datos_finales = array_merge($datos_cumplen, $datos_no_cumplen);

// Barajar los datos finales
shuffle($datos_finales);

// Mostrar los datos finales
foreach ($datos_finales as $id => $dato) {
    
?>
<?php $datoed = $dato['id']; ?>
<div class="post-container">
        <div style="" class="post-image">
        <a href="@<?php echo $dato['nombre'] ?>.php"><div class="post-info">
                    <div style=" border: solid 0px; margin-left: -3px" class="post-img">
                        <img style="width: 28px; height: 28px; object-fit: cover; border-radius: 50%;" src="perfiles/<?php
$clave = $dato['nombre'];
// Obtener el contenido del archivo JSON
$json = file_get_contents('usuarios.json');
// Decodificar el JSON en un array de PHP
$data = json_decode($json, true);

// Acceder a los datos de la cadena específica
$cadena = $data[$clave];

// Verificar si la cadena tiene el campo "imagen"
if (isset($cadena['imagen']) && !empty($cadena['imagen'])) {
    echo $cadena['imagen'];
} else {
    // Si $dato->imagen no tiene valor, muestra la imagen por defecto
    echo 'defaulvaneetimestory773ytr36tgte6wfdstf5qfwasgtdtwasztcfxztfsaygfcxtyvscxgvstxzgcsdrxfvxsgvtsyxvgtcfsvxgv.jpg'; // Reemplaza con la ruta de tu imagen por defecto
}
?>" alt="profile">
                    </div>
                    <h5 style="background-color: transparent;" class="tows"><?php
$clave = $dato['nombre'];
// Obtener el contenido del archivo JSON
$json = file_get_contents('usuarios.json');
// Decodificar el JSON en un array de PHP
$data = json_decode($json, true);

// Acceder a los datos de la cadena específica
$cadena = $data[$clave];

// Verificar si la cadena tiene el campo "imagen"
if (isset($cadena['nombre_completo']) && !empty($cadena['nombre_completo'])) {
    echo $cadena['nombre_completo'];
} else {
    // Si $dato->imagen no tiene valor, muestra la imagen por defecto
    echo 'defaulvaneetimestory773ytr36tgte6wfdstf5qfwasgtdtwasztcfxztfsaygfcxtyvscxgvstxzgcsdrxfvxsgvtsyxvgtcfsvxgv.jpg'; // Reemplaza con la ruta de tu imagen por defecto
}
?></h5><?php
// Cargar el contenido del archivo verificado.json
$verificados_json = file_get_contents("verificado.json");

// Decodificar el JSON en un array asociativo
$verificados_data = json_decode($verificados_json, true);

// Obtener el valor de $d (este valor podría venir de un formulario o cualquier fuente)
 // Cambia esto según tu caso o usa un valor dinámico

// Verificar si el valor de $d está en la lista de verificados
if (in_array($dato['nombre'], $verificados_data["verificados"])) {
    // Si $d está verificado, mostrar el SVG
    echo '<svg style="margin-left: 4px;" width="15" height="15" fill="#03a9f4" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
    <path d="m23.126,9.868h0l-2.151-2.154v-1.718c0-1.651-1.342-2.995-2.991-2.995h-1.716l-2.151-2.153c-1.131-1.131-3.101-1.131-4.231,0l-2.151,2.153h-1.716c-1.65,0-2.991,1.343-2.991,2.995v1.718l-2.152,2.154c-1.165,1.168-1.165,3.067,0,4.235l2.151,2.154v1.718c0,1.651,1.342,2.995,2.991,2.995h1.716l2.151,2.153c.565.565,1.317.877,2.116.877s1.55-.312,2.115-.877l2.151-2.153h1.716c1.65,0,2.991-1.343,2.991-2.995v-1.718l2.152-2.154c1.165-1.168,1.165-3.067,0-4.235Zm-4.922.343l-5.054,4.995c-.614.61-1.423.916-2.231.916s-1.613-.305-2.229-.913l-2.599-2.499c-.392-.389-.396-1.021-.007-1.414.39-.391,1.021-.396,1.415-.007l2.598,2.498c.453.449,1.19.45,1.644,0l5.055-4.996c.394-.39,1.026-.386,1.415.007s.385,1.025-.007,1.414Z"/>
  </svg>';
} else {
    // Si no está verificado, mostrar un mensaje o SVG alternativo
    echo '';
}
?>

<?php
// Cargar el contenido del archivo verificado.json
$verificados_json = file_get_contents("emp.json");

// Decodificar el JSON en un array asociativo
$verificados_data = json_decode($verificados_json, true);

// Obtener el valor de $d (este valor podría venir de un formulario o cualquier fuente)
 // Cambia esto según tu caso o usa un valor dinámico

// Verificar si el valor de $d está en la lista de verificados
if (in_array($dato['nombre'], $verificados_data["verificados"])) {
    // Si $d está verificado, mostrar el SVG
    echo '<svg style="margin-left: 4px;" width="15" height="15" fill="red" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
    <path d="m23.126,9.868h0l-2.151-2.154v-1.718c0-1.651-1.342-2.995-2.991-2.995h-1.716l-2.151-2.153c-1.131-1.131-3.101-1.131-4.231,0l-2.151,2.153h-1.716c-1.65,0-2.991,1.343-2.991,2.995v1.718l-2.152,2.154c-1.165,1.168-1.165,3.067,0,4.235l2.151,2.154v1.718c0,1.651,1.342,2.995,2.991,2.995h1.716l2.151,2.153c.565.565,1.317.877,2.116.877s1.55-.312,2.115-.877l2.151-2.153h1.716c1.65,0,2.991-1.343,2.991-2.995v-1.718l2.152-2.154c1.165-1.168,1.165-3.067,0-4.235Zm-4.922.343l-5.054,4.995c-.614.61-1.423.916-2.231.916s-1.613-.305-2.229-.913l-2.599-2.499c-.392-.389-.396-1.021-.007-1.414.39-.391,1.021-.396,1.415-.007l2.598,2.498c.453.449,1.19.45,1.644,0l5.055-4.996c.394-.39,1.026-.386,1.415.007s.385,1.025-.007,1.414Z"/>
  </svg>';
} else {
    // Si no está verificado, mostrar un mensaje o SVG alternativo
    echo '';
}
?>
                </div></a>
<a href="post?views=<?php echo $dato['id']; ?>"><p style="background-color: transparent;" class="tows"><?php echo $dato['descripcion']; ?></p>
                <div class="carousel-container">
    <div class="carousel">
      <div style="<?php
if (isset($dato['imagenes'][0]) && !empty($dato['imagenes'][0])) {
    echo "display: block; margin-right:3px;";
} else {
    echo "display: none;";
}
?>" class="carousel-item">
<?php
$imagenes = $dato['imagenes'];
$num_imagenes = count($imagenes);


if ($num_imagenes == 1) {

    echo '';
} elseif ($num_imagenes == 2) {
    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">1/2</span>';
} elseif ($num_imagenes == 3) {
    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">1/3</span>';
} elseif ($num_imagenes == 4) {
    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">1/4</span>';
} elseif ($num_imagenes == 5) {
    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">1/5</span>';
} elseif ($num_imagenes == 6) {
    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">1/6</span>';
} elseif ($num_imagenes == 7) {
    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">1/7</span>';
} elseif ($num_imagenes == 8) {
    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">1/8</span>';
} elseif ($num_imagenes == 9) {
    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">1/9</span>';
}

?>
        <video class="colors" style="padding-right: 0px; width: 100%; border-radius: 15px; min-height: 260px; background-color:<?php echo $dato['a1']; ?>;" autoplay muted loop poster="<?php echo $dato['imagenes'][0]; ?>" src="<?php echo $dato['imagenes'][0]; ?>" alt="Imagen 1"></video>
      </div>
      <div style="<?php
if (isset($dato['imagenes'][1]) && !empty($dato['imagenes'][1])) {
    echo "display: block; margin-right:3px;";
} else {
    echo "display: none;";
}
?>" class="carousel-item">
<?php
$imagenes = $dato['imagenes'];
$num_imagenes = count($imagenes);

if ($num_imagenes > 1) {
    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">2/' . $num_imagenes . '</span>';
}
?>
       <video class="colors" style="padding-right: 0px; width: 100%; border-radius: 15px; min-height: 260px; background-color:<?php echo $dato['a1']; ?>;" loop poster="<?php echo $dato['imagenes'][1]; ?>" src="<?php echo $dato['imagenes'][1]; ?>" alt="Imagen 2"></video>
      </div>
      <div style="<?php
if (isset($dato['imagenes'][2]) && !empty($dato['imagenes'][2])) {
    echo "display: block; margin-right:3px;";
} else {
    echo "display: none;";
}
?>" class="carousel-item">
<?php
$imagenes = $dato['imagenes'];
$num_imagenes = count($imagenes);

if ($num_imagenes > 2) {

    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">3/' . $num_imagenes . '</span>';

}
?>
        <video class="colors" style="padding-right: 0px; width: 100%; border-radius: 15px; min-height: 260px; background-color:<?php echo $dato['a1']; ?>;" loop poster="<?php echo $dato['imagenes'][2]; ?>" src="<?php echo $dato['imagenes'][2]; ?>" alt="Imagen 3"></video>
      </div>
      
<div style="<?php
if (isset($dato['imagenes'][3]) && !empty($dato['imagenes'][3])) {
    echo "display: block; margin-right:3px;";
} else {
    echo "display: none;";
}
?>" class="carousel-item">
<?php
$imagenes = $dato['imagenes'];
$num_imagenes = count($imagenes);

if ($num_imagenes > 3) {
    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">4/' . $num_imagenes . '</span>';
}
?>
        <video class="colors" style="padding-right: 0px; width: 100%; border-radius: 15px; min-height: 260px; background-color:<?php echo $dato['a1']; ?>;" loop poster="<?php echo $dato['imagenes'][3]; ?>" src="<?php echo $dato['imagenes'][3]; ?>" alt="Imagen 4"></video>
      </div>
      
<div style="<?php
if (isset($dato['imagenes'][4]) && !empty($dato['imagenes'][4])) {
    echo "display: block; margin-right:3px;";
} else {
    echo "display: none;";
}
?>" class="carousel-item">
<?php
$imagenes = $dato['imagenes'];
$num_imagenes = count($imagenes);

if ($num_imagenes > 4) {
    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">5/' . $num_imagenes . '</span>';
}
?>
        <video class="colors" style="padding-right: 0px; width: 100%; border-radius: 15px; min-height: 260px; background-color:<?php echo $dato['a1']; ?>;" loop poster="<?php echo $dato['imagenes'][4]; ?>" src="<?php echo $dato['imagenes'][4]; ?>" alt="Imagen 5"></video>
      </div>
      
<div style="<?php
if (isset($dato['imagenes'][5]) && !empty($dato['imagenes'][5])) {
    echo "display: block; margin-right:3px;";
} else {
    echo "display: none;";
}
?>" class="carousel-item">
<?php
$imagenes = $dato['imagenes'];
$num_imagenes = count($imagenes);

if ($num_imagenes > 5) {
    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">6/' . $num_imagenes . '</span>';
}
?>
        <video class="colors" style="padding-right: 0px; width: 100%; border-radius: 15px; min-height: 260px; background-color:<?php echo $dato['a1']; ?>;" loop poster="<?php echo $dato['imagenes'][5]; ?>" src="<?php echo $dato['imagenes'][5]; ?>" alt="Imagen 6"></video>
      </div>
      
<div style="<?php
if (isset($dato['imagenes'][6]) && !empty($dato['imagenes'][6])) {
    echo "display: block; margin-right:3px;";
} else {
    echo "display: none;";
}
?>" class="carousel-item">
<?php
$imagenes = $dato['imagenes'];
$num_imagenes = count($imagenes);

if ($num_imagenes > 6) {
    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">7/' . $num_imagenes . '</span>';
}
?>
        <video class="colors" style="padding-right: 0px; width: 100%; border-radius: 15px; min-height: 260px; background-color:<?php echo $dato['a1']; ?>;" loop poster="<?php echo $dato['imagenes'][6]; ?>" src="<?php echo $dato['imagenes'][6]; ?>" alt="Imagen 7"></video>
      </div>
      
<div style="<?php
if (isset($dato['imagenes'][7]) && !empty($dato['imagenes'][7])) {
    echo "display: block; margin-right:3px;";
} else {
    echo "display: none;";
}
?>" class="carousel-item">
<?php
$imagenes = $dato['imagenes'];
$num_imagenes = count($imagenes);

if ($num_imagenes > 7) {
    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">8/' . $num_imagenes . '</span>';
}
?>
        <video class="colors" style="padding-right: 0px; width: 100%; border-radius: 15px; min-height: 260px; background-color:<?php echo $dato['a1']; ?>;" loop poster="<?php echo $dato['imagenes'][7]; ?>" src="<?php echo $dato['imagenes'][7]; ?>" alt="Imagen 8"></video>
      </div>
      
<div style="<?php
if (isset($dato['imagenes'][8]) && !empty($dato['imagenes'][8])) {
    echo "display: block; margin-right:3px;";
} else {
    echo "display: none;";
}
?>" class="carousel-item">
<?php
$imagenes = $dato['imagenes'];
$num_imagenes = count($imagenes);

if ($num_imagenes > 8) {
    echo '<span class="colors" float:right; style="font-size: 10px; left: 10px; text-align: center; z-index: 99;position:relative; bottom: -33px; padding:5px; border-radius: 6px;">9/' . $num_imagenes . '</span>';
}
?>
        <video class="colors" style="padding-right: 0px; width: 100%; border-radius: 15px; min-height: 260px; background-color:<?php echo $dato['a1']; ?>;" loop poster="<?php echo $dato['imagenes'][8]; ?>" src="<?php echo $dato['imagenes'][8]; ?>" alt="Imagen 9"></video>
      </div>
      
    </div>
  </div></a>
                
        </div>
        <div class="post-content">
            
           <div class="fvf" style="margin-top: 19px; padding: 5px; align-items: end; right: 0;float: right;position: relative;flex-direction: column;">
            <div style="align-items: center; display: flex;flex-direction: column; padding-top: 22px;">
            <<?php
// Cargar el contenido del archivo JSON
$jsonData = file_get_contents("save.json");

// Decodificar el contenido JSON en un array asociativo
$data = json_decode($jsonData, true);

// Nombre y valor a buscar
$nombreBuscado = $d;
$tdBuscado = $dato['nombre'];
$zz = $dato['hora'];
// Utilizar array_filter para buscar las coincidencias
$resultado = array_filter($data, function ($item) use ($nombreBuscado, $tdBuscado, $zz) {
    return isset($item['nombre']) && isset($item['td']) && isset($item['tiempo']) &&
           $item['nombre'] === $nombreBuscado && $item['td'] === $tdBuscado  && $item['tiempo'] === $zz;
});

if (!empty($resultado)) {
    echo "div";
} else {
    echo "form";
}
?> action="<?php
// Cargar el contenido del archivo JSON
$jsonData = file_get_contents("save.json");

// Decodificar el contenido JSON en un array asociativo
$data = json_decode($jsonData, true);

// Valores a buscar
$nombreBuscado = $d;
$tdBuscado = $dato['nombre'];
$zz = $dato['hora'];

// Utilizar array_filter para buscar las coincidencias
$resultado = array_filter($data, function ($item) use ($nombreBuscado, $tdBuscado, $zz) {
    return isset($item['nombre']) && isset($item['td']) && isset($item['tiempo']) &&
           $item['nombre'] === $nombreBuscado && $item['td'] === $tdBuscado && $item['tiempo'] === $zz;
});

if (!empty($resultado)) {
    echo "save.php";
} else {
    echo "procesa.php";
}
?>" style=" height: 34px;<?php
session_start();

$usuarios = json_decode(file_get_contents('usuarios.json'), true);

if (isset($_SESSION['nombre'])) {
    $nombre = $_SESSION['nombre'];
} elseif (isset($_COOKIE['nombre'])) {
    $nombre = $_COOKIE['nombre'];
    $_SESSION['nombre'] = $nombre;
}

if (isset($nombre) && array_key_exists($nombre, $usuarios)) {
    echo '';
} else {
    echo 'display:none;';
}
?>" method="POST">
   <input type="text" style="display:none;" value="<?php echo ($dato['id']) ?>" name="gmail">
   <input type="text" style="display:none;" value="<?php echo $d ?>" name="nombre">
   <input type="text" style="display:none;" value="<?php echo ($dato['hora']) ?>" name="tiempo">
   <input type="text" style="display:none;" value="<?php echo ($dato['detalles']) ?>" name="voto">
   <input type="text" style="display:none;" value="<?php echo ($dato['imagenes'][0]) ?>" name="foto">
   <input type="text" style="display:none;" value="perfiles/<?php echo $usuario['imagen']; ?>" name="link">
   <input type="text" style="display:none;" value="<?php echo ($dato['precio']) ?>" name="code">
   <input type="text" style="display:none;" value="<?php echo ($dato['imagenes'][1]) ?>" name="ft">
   <input type="text" style="display:none;" value="<?php echo ($dato['descripcion']) ?>" name="texto">
   <input type="text" style="display:none;" value="<?php echo ($dato['nombre']) ?>" name="td">
            <button style="background-color: transparent; padding: 0px; border:solid 0px;" class="dropdown-btn transparent-btn" type="submit" title="More info">
            <div class="like">


<svg style="background-color: transparent; margin-right: 0px; display: <?php
// Cargar el contenido del archivo JSON
$jsonData = file_get_contents("save.json");

// Decodificar el contenido JSON en un array asociativo
$data = json_decode($jsonData, true);

// Valores a buscar
$nombreBuscado = $d;
$tdBuscado = $dato['nombre'];
$zz = $dato['hora'];

// Utilizar array_filter para buscar las coincidencias
$resultado = array_filter($data, function ($item) use ($nombreBuscado, $tdBuscado, $zz) {
    return isset($item['nombre']) && isset($item['td']) && isset($item['tiempo']) &&
           $item['nombre'] === $nombreBuscado && $item['td'] === $tdBuscado && $item['tiempo'] === $zz;
});

if (!empty($resultado)) {
    echo "none";
} else {
    echo "block";
}
?>;" xmlns="http://www.w3.org/2000/svg" id="Outline" fill="" class="<?php
// Cargar el contenido del archivo JSON
$jsonData = file_get_contents("save.json");

// Decodificar el contenido JSON en un array asociativo
$data = json_decode($jsonData, true);

// Nombre y valor a buscar
$nombreBuscado = $d;
$tdBuscado = $dato['nombre'];
$zz = $dato['hora'];
// Utilizar array_filter para buscar las coincidencias
$resultado = array_filter($data, function ($item) use ($nombreBuscado, $tdBuscado, $zz) {
    return isset($item['nombre']) && isset($item['td']) && isset($item['tiempo']) &&
           $item['nombre'] === $nombreBuscado && $item['td'] === $tdBuscado  && $item['tiempo'] === $zz;
});

if (!empty($resultado)) {
    echo "";
} else {
    echo "";
}
?> tows" viewBox="0 0 24 24" width="20" height="20"><path d="M20.602,4.702c-1.218-1.136-2.812-1.752-4.385-1.686-1.423,.059-2.735,.672-3.695,1.727l-.521,.574-.521-.574c-.96-1.055-2.272-1.668-3.695-1.727-1.575-.068-3.168,.55-4.385,1.686-1.127,1.052-2.431,3.188-2.397,5.744,.033,2.582,1.355,5.049,3.93,7.331,.857,.76,1.87,1.465,3.095,2.157,1.223,.69,2.598,1.055,3.975,1.055s2.752-.365,3.976-1.055c1.224-.691,2.236-1.397,3.094-2.157,2.574-2.282,3.896-4.749,3.93-7.331,.033-2.556-1.271-4.692-2.397-5.744Zm-2.858,11.578c-.751,.666-1.651,1.291-2.751,1.912-1.848,1.043-4.138,1.042-5.983,0-1.101-.622-2.001-1.247-2.752-1.912-2.135-1.893-3.23-3.865-3.257-5.86-.026-2.036,1.097-3.633,1.764-4.256,.79-.737,1.8-1.152,2.793-1.152,.984,0,1.836,.411,2.441,1.077l1.262,1.388c.379,.417,1.102,.417,1.48,0l1.262-1.388c.605-.666,1.399-1.038,2.297-1.074,1.038-.042,2.109,.376,2.938,1.149,.667,.623,1.79,2.221,1.764,4.256-.026,1.996-1.122,3.967-3.257,5.86Z"/></svg>



<svg style="margin-right: 0px; display: <?php
// Cargar el contenido del archivo JSON
$jsonData = file_get_contents("save.json");

// Decodificar el contenido JSON en un array asociativo
$data = json_decode($jsonData, true);

// Valores a buscar
$nombreBuscado = $d;
$tdBuscado = $dato['nombre'];
$zz = $dato['hora'];

// Utilizar array_filter para buscar las coincidencias
$resultado = array_filter($data, function ($item) use ($nombreBuscado, $tdBuscado, $zz) {
    return isset($item['nombre']) && isset($item['td']) && isset($item['tiempo']) &&
           $item['nombre'] === $nombreBuscado && $item['td'] === $tdBuscado && $item['tiempo'] === $zz;
});

if (!empty($resultado)) {
    echo "block";
} else {
    echo "none";
}
?>;" xmlns="http://www.w3.org/2000/svg" id="Filled" fill="#ff3040" class="<?php
// Cargar el contenido del archivo JSON
$jsonData = file_get_contents("save.json");

// Decodificar el contenido JSON en un array asociativo
$data = json_decode($jsonData, true);

// Nombre y valor a buscar
$nombreBuscado = $d;
$tdBuscado = $dato['nombre'];
$zz = $dato['hora'];
// Utilizar array_filter para buscar las coincidencias
$resultado = array_filter($data, function ($item) use ($nombreBuscado, $tdBuscado, $zz) {
    return isset($item['nombre']) && isset($item['td']) && isset($item['tiempo']) &&
           $item['nombre'] === $nombreBuscado && $item['td'] === $tdBuscado  && $item['tiempo'] === $zz;
});

if (!empty($resultado)) {
    echo "";
} else {
    echo "";
}
?>" viewBox="0 0 24 24" width="20" height="20"><path d="M20.602,4.702c-1.218-1.136-2.812-1.752-4.385-1.686-1.423,.059-2.735,.672-3.695,1.727l-.521,.574-.521-.574c-.96-1.055-2.272-1.668-3.695-1.727-1.575-.068-3.168,.55-4.385,1.686-1.127,1.052-2.431,3.188-2.397,5.744,.033,2.582,1.355,5.049,3.93,7.331,.857,.76,1.87,1.465,3.095,2.157,1.223,.69,2.598,1.055,3.975,1.055s2.752-.365,3.976-1.055c1.224-.691,2.236-1.397,3.094-2.157,2.574-2.282,3.896-4.749,3.93-7.331,.033-2.556-1.271-4.692-2.397-5.744Z"/></svg>
                                      </div>
            </button>
            </<?php
// Cargar el contenido del archivo JSON
$jsonData = file_get_contents("save.json");

// Decodificar el contenido JSON en un array asociativo
$data = json_decode($jsonData, true);

// Nombre y valor a buscar
$nombreBuscado = $d;
$tdBuscado = $dato['nombre'];
$zz = $dato['hora'];
// Utilizar array_filter para buscar las coincidencias
$resultado = array_filter($data, function ($item) use ($nombreBuscado, $tdBuscado, $zz) {
    return isset($item['nombre']) && isset($item['td']) && isset($item['tiempo']) &&
           $item['nombre'] === $nombreBuscado && $item['td'] === $tdBuscado  && $item['tiempo'] === $zz;
});

if (!empty($resultado)) {
    echo "div";
} else {
    echo "form";
}
?>>
                    <span style="padding-bottom: 13px;<?php
session_start();

$usuarios = json_decode(file_get_contents('usuarios.json'), true);

if (isset($_SESSION['nombre'])) {
    $nombre = $_SESSION['nombre'];
} elseif (isset($_COOKIE['nombre'])) {
    $nombre = $_COOKIE['nombre'];
    $_SESSION['nombre'] = $nombre;
}

if (isset($nombre) && array_key_exists($nombre, $usuarios)) {
    echo '';
} else {
    echo 'display:none;';
}
?>"><?php
// Leer el contenido del archivo save.json
$jsonData = file_get_contents('save.json');

// Verificar si se pudo leer el contenido del archivo
if ($jsonData !== false) {
    // Contar cuántas veces aparece el texto específico
    $pattern = $datoed; // Reemplaza esto con el texto que buscas
    $count = substr_count($jsonData, $pattern);

    // Si no se encuentra el texto, $count será 0
    echo $count;
} else {
    // En caso de que no se pueda leer el archivo, muestra 0
    echo "0";
}
?>
</span>
                    <a href="Comment_<?php echo ($dato['id']) ?>.php"><svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none">

<g id="SVGRepo_bgCarrier" stroke-width="0"></g>

<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>

<g id="SVGRepo_iconCarrier"> <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 13.5997 2.37562 15.1116 3.04346 16.4525C3.22094 16.8088 3.28001 17.2161 3.17712 17.6006L2.58151 19.8267C2.32295 20.793 3.20701 21.677 4.17335 21.4185L6.39939 20.8229C6.78393 20.72 7.19121 20.7791 7.54753 20.9565C8.88837 21.6244 10.4003 22 12 22Z" class="towse" stroke-width="1.972"></path> </g>

</svg></a>
                    <span style="padding-bottom: 13px;"><?php
// Obtener las propiedades necesarias de $dato
$nombres = $dato['id'];

// Construir la ruta al archivo JSON
$archivoDatos = "time={$nombres}.json";

// Verificar si el archivo existe
if (file_exists($archivoDatos)) {
    // Lee el contenido del archivo
    $contenido = file_get_contents($archivoDatos);

    // Decodifica el contenido JSON en un array PHP
    $datos = json_decode($contenido);

    // Verifica si se decodificó correctamente
    if ($datos !== null) {
        // Cuenta la cantidad de objetos en el array
        $contador = count($datos);

        // Muestra el resultado
        echo "$contador <b></b>";
    } else {
        echo "0 <b></b>";
    }
} else {
    echo "0 <b></b>";
}
?></span>
                    
                   <form style="display:none;" id="miFormulario" action="repost.php" method="post">
    <input type="hidden" name="descripcion" value="<?php echo ($dato['descripcion']) ?>">
    <input type="hidden" name="nombre" value="lucia">
    <input type="hidden" name="tiempo" value="2024-10-20 22:48:55">
    <input type="hidden" name="voto" value="2023-12-26 21:13:12">
    <input type="hidden" id="foto" name="foto" value="<?php echo ($dato['imagenes'][0]) ?>">
    <input type="hidden" name="fc" value="">
    <input type="hidden" name="ft" value="perfiles/IMG_20230916_182633.jpg">
    <input type="hidden" name="texto" value="Divina">
    <input type="hidden" name="td" value="privado">
    <button style="padding:0px; background-color:transparent; border:0px solid;" type="submit"><svg style="margin-top:1px;" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="19" height="19"><path d="M24,12c0,4.411-3.589,8-8,8H3l2.293,2.293c.391,.391,.391,1.023,0,1.414-.195,.195-.451,.293-.707,.293s-.512-.098-.707-.293l-3.293-3.293c-.78-.779-.78-2.049,0-2.828l3.293-3.293c.391-.391,1.023-.391,1.414,0s.391,1.023,0,1.414l-2.293,2.293h13c3.309,0,6-2.691,6-6,0-.553,.448-1,1-1s1,.447,1,1ZM1,13c.552,0,1-.447,1-1,0-3.309,2.691-6,6-6h13l-2.293,2.293c-.391,.391-.391,1.023,0,1.414,.195,.195,.451,.293,.707,.293s.512-.098,.707-.293l3.293-3.293c.78-.779,.78-2.049,0-2.828L20.121,.293c-.391-.391-1.023-.391-1.414,0s-.391,1.023,0,1.414l2.293,2.293H8C3.589,4,0,7.589,0,12c0,.553,.448,1,1,1Z"></path></svg></button>
</form>
                    
                    </div>
                    </div>
                    <div style="display: flex; margin-bottom: 7px; flex-direction: column; justify-content: end; align-items: center;">
                    <form id="form1" class="share">
        <input style="display: none;" type="text" name="nombre" value="Post vin: <?php echo ($dato['nombre']) ?>">
        <input style="display: none;" type="email" name="email" value="https://vinlart.com/post.php?views=<?php echo ($dato['id']) ?>">
        <svg style="background-color: transparent; margin-bottom: 14px; display: block;" xmlns="http://www.w3.org/2000/svg" class="tows share-btn" id="Outline" viewBox="0 0 24 24" width="19" height="19"><path d="M0,23V16A9.01,9.01,0,0,1,9,7h4.83V5.414A2,2,0,0,1,17.244,4l5.88,5.879a3,3,0,0,1,0,4.242L17.244,20a2,2,0,0,1-3.414-1.414V17H8a6.006,6.006,0,0,0-6,6,1,1,0,0,1-2,0ZM15.83,8a1,1,0,0,1-1,1H9a7.008,7.008,0,0,0-7,7v1.714A7.984,7.984,0,0,1,8,15h6.83a1,1,0,0,1,1,1v2.586l5.879-5.879a1,1,0,0,0,0-1.414L15.83,5.414Z"></path></svg>
    </form>
    <form class="plus">
    <input style="display: none;" type="text" name="nombre" value="Post vin: <?php echo ($dato['nombre']) ?>">
        <input style="display: none;" type="email" name="email" value="vin-<?php echo ($dato['id']) ?>.php">
    <svg style="padding: 6px; border: solid 1px #cccccc30; border-radius: 50%; background-color: #cccccc2e;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-three-dots-vertical plus-btn" viewBox="0 0 16 16">
                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                      </svg>
</form>
                    </div>
        </div>
    </div>

    <?php
}

// Barajar los datos que no cumplen con las condiciones
shuffle($datos_no_cumplen);

// Mostrar luego los datos que no cumplen con las condiciones en un orden aleatorio
foreach ($datos_no_cumplen as $id => $dato) {
    
    
?>

<?php
}
?>
<div id="shareModal" class="modal">
    <div class="modal-content tows">
        <span class="close" onclick="closeModal()">&times;</span>
        <span data-key="share"></span>
        <a id="modal-link1" href="" target="_blank"><div style="width: 100%;padding: 6px;margin-bottom: 0px;border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;display:none;" class="post-info colors">

                    <div style=" border: solid 0px;" class="post-img">

                        <img style="width: 27px; height: 27px; object-fit: cover; border-radius: 50%; border: solid 0px;" src="https://cdn-icons-png.flaticon.com/256/3983/3983909.png" alt="profile">
                    </div>
                    <h5>YouTube</h5>
                </div></a>

        <a id="modal-link2" href="" target="_blank"><div style="width: 100%;padding: 6px;margin-bottom: 0px;border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;" class="post-info colors">
                    <div style=" border: solid 0px;" class="post-img">
                        <img style="width: 27px; height: 27px; object-fit: cover; border-radius: 50%; border: solid 0px;" src="https://static-00.iconduck.com/assets.00/reddit-icon-256x256-8snmtp9g.png" alt="profile">
                    </div>
                    <h5>Reddit</h5>
                </div></a>
        <a id="modal-link3" href="" target="_blank"><div style="width: 100%;padding: 6px;margin-bottom: 0px;border-radius: 0px;" class="post-info colors">
                    <div style=" border: solid 0px;" class="post-img">
                        <img style="width: 27px; height: 27px; object-fit: cover; border-radius: 50%; border: solid 0px;" src="https://upload.wikimedia.org/wikipedia/commons/b/b9/2023_Facebook_icon.svg" alt="profile">
                    </div>
                    <h5>Facebook</h5>
                </div></a>
                
        <a id="modal-link4" href="" target="_blank"><div style="width: 100%;padding: 6px;margin-bottom: 0px;border-radius: 0px;" class="post-info colors">
                    <div style=" border: solid 0px;" class="post-img">
                        <img style="width: 27px; height: 27px; object-fit: cover; border-radius: 50%; border: solid 0px;" src="https://graffica.ams3.digitaloceanspaces.com/2023/07/F1ySdm9WYAIbjHo-1024x1024.jpeg" alt="profile">
                    </div>
                    <h5>X (Twitter)</h5>
                </div></a>

        <a id="modal-link5" href="" target="_blank"><div style="width: 100%;padding: 6px;margin-bottom: 0px;border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;" class="post-info colors">
                    <div style=" border: solid 0px;" class="post-img">
                        <img style="width: 26px; height: 26px; object-fit: cover; border-radius: 50%; border: solid 0px;" src="https://cdn-icons-png.freepik.com/256/15707/15707917.png?semt=ais_hybrid" alt="profile">
                    </div>
                    <h5>Whatsapp</h5>
                </div></a><br><br>
        <button style="display: none;" onclick="closeModal()">Cerrar</button>
    </div>
</div>
<!-- Modal de Plus -->
<div id="plusModal" class="modal">
    <div class="modal-content tows">
        <span class="close" onclick="closePlusModal()">&times;</span>
        <span data-key="options"></span>
        <a id="plus-modal-link1" href="" target="_blank"><div style="width: 100%;padding: 6px;margin-bottom: 0px;border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;" class="post-info colors">
                    <div style=" border: solid 0px;" class="post-img">
                    <svg xmlns="http://www.w3.org/2000/svg" class="darklight" id="Outline" viewBox="0 0 24 24" width="17" height="17"><path d="M21,4H17.9A5.009,5.009,0,0,0,13,0H11A5.009,5.009,0,0,0,6.1,4H3A1,1,0,0,0,3,6H4V19a5.006,5.006,0,0,0,5,5h6a5.006,5.006,0,0,0,5-5V6h1a1,1,0,0,0,0-2ZM11,2h2a3.006,3.006,0,0,1,2.829,2H8.171A3.006,3.006,0,0,1,11,2Zm7,17a3,3,0,0,1-3,3H9a3,3,0,0,1-3-3V6H18Z"/><path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18Z"/><path d="M14,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/></svg>
                    </div>
                    <h5 data-key="delete">Delate</h5>
                </div></a>

        <a id="plus-modal-link2" style=" display: none;" href="" target="_blank"><div style="width: 100%;padding: 6px;margin-bottom: 0px;border-radius: 0px;" class="post-info colors">
                    <div style=" border: solid 0px;" class="post-img">
                        <img style="width: 27px; height: 27px; object-fit: cover; border-radius: 50%; border: solid 0px;" src="https://static-00.iconduck.com/assets.00/reddit-icon-256x256-8snmtp9g.png" alt="profile">
                    </div>
                    <h5 data-key="block">Block</h5>
                </div></a>

                <a onclick="window.location.reload(); return false;"><div style="width: 100%;padding: 6px;margin-bottom: 0px;border-radius: 0px;" class="post-info colors">
                    <div style=" border: solid 0px;" class="post-img">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" height="17" class="darklight" viewBox="0 0 24 24" width="17" data-name="Layer 1"><path d="m12 0a12 12 0 1 0 12 12 12.013 12.013 0 0 0 -12-12zm0 22a10 10 0 1 1 10-10 10.011 10.011 0 0 1 -10 10zm0-15a2.993 2.993 0 0 0 -1 5.816v3.184a1 1 0 0 0 2 0v-3.184a2.993 2.993 0 0 0 -1-5.816zm0 4a1 1 0 1 1 1-1 1 1 0 0 1 -1 1z"/></svg>
                    </div>
                    <h5 data-key="block">Block</h5>
                </div></a>
        <a id="plus-modal-link3" style=" display: none;" href="" target="_blank"><div style="width: 100%;padding: 6px;margin-bottom: 0px;border-radius: 0px;" class="post-info colors">
                    <div style=" border: solid 0px;" class="post-img">
                        <img style="width: 27px; height: 27px; object-fit: cover; border-radius: 50%; border: solid 0px;" src="https://upload.wikimedia.org/wikipedia/commons/b/b9/2023_Facebook_icon.svg" alt="profile">
                    </div>
                    <h5>Facebook Plus</h5>
                </div></a>
                
        <a id="plus-modal-link4"  style=" display: none;" href="" target="_blank"><div style="width: 100%;padding: 6px;margin-bottom: 0px;border-radius: 0px;" class="post-info colors">
                    <div style=" border: solid 0px;" class="post-img">
                        <img style="width: 27px; height: 27px; object-fit: cover; border-radius: 50%; border: solid 0px;" src="https://graffica.ams3.digitaloceanspaces.com/2023/07/F1ySdm9WYAIbjHo-1024x1024.jpeg" alt="profile">
                    </div>
                    <h5>X (Twitter) Plus</h5>
                </div></a>

        <a id="plus-modal-link5" href="" target="_blank"><div style="width: 100%;padding: 6px;margin-bottom: 0px;border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;" class="post-info colors">
                    <div style=" border: solid 0px;" class="post-img">
                    <svg xmlns="http://www.w3.org/2000/svg" class="darklight" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="17" height="17"><path d="M3.337,3.478A2,2,0,1,0,1,3.723V24H3V20.664L23.577,12ZM3,5.506,18.423,12,3,18.494Z"/></svg>
                    </div>
                    <h5 data-key="report">Report</h5>
                </div></a><br><br>
        <button style="display: none;" onclick="closePlusModal()">Cerrar</button>
    </div>
</div>

<script>
   // Selecciona solo los formularios que tienen la clase "share" y "plus"
const shareForms = document.querySelectorAll('form.share');
const plusForms = document.querySelectorAll('form.plus');

// Agrega eventos a los botones dentro de los formularios que tienen clase 'share'
shareForms.forEach((form, index) => {
    form.querySelector('.share-btn').addEventListener('click', () => openShareModal(form));
});

// Agrega eventos a los botones dentro de los formularios que tienen clase 'plus'
plusForms.forEach((form, index) => {
    form.querySelector('.plus-btn').addEventListener('click', () => openPlusModal(form));
});

// Función para abrir el modal de compartir con los datos del formulario correspondiente
function openShareModal(form) {
    const name = form.elements['nombre'].value;
    const email = form.elements['email'].value;

    // Generar URLs de redes sociales con los datos del formulario
    const urls = {
        youtube: `https://discord.com/channels/@me?message=${encodeURIComponent(name)}%20${encodeURIComponent(email)}`,
        linkedin: `https://www.reddit.com/submit?url=${encodeURIComponent(email)}&title=${encodeURIComponent(name)}`,
        facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(email)}&quote=${encodeURIComponent(name)}`,
        twitter: `https://twitter.com/intent/tweet?text=${encodeURIComponent(name)} &url=${encodeURIComponent(email)}`,
        whatsapp: `https://api.whatsapp.com/send?text=${encodeURIComponent(name)} ${encodeURIComponent(email)}`
    };

    // Enlazar las URLs a los enlaces del modal
    document.getElementById('modal-link1').href = urls.youtube;
    document.getElementById('modal-link2').href = urls.linkedin;
    document.getElementById('modal-link3').href = urls.facebook;
    document.getElementById('modal-link4').href = urls.twitter;
    document.getElementById('modal-link5').href = urls.whatsapp;

    // Mostrar el modal de compartir
    document.getElementById('shareModal').style.display = 'flex';
}

// Función para abrir el nuevo modal con los datos del formulario correspondiente
function openPlusModal(form) {
    const name = form.elements['nombre'].value;
    const email = form.elements['email'].value;

    // Generar URLs de redes sociales con los datos del formulario
    const urls = {
        youtube: `${encodeURIComponent(email)}`,
        linkedin: `${encodeURIComponent(email)}`,
        facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(email)}&quote=${encodeURIComponent(name)}`,
        twitter: `https://twitter.com/intent/tweet?text=${encodeURIComponent(name)} &url=${encodeURIComponent(email)}`,
        whatsapp: `report-${encodeURIComponent(email)}`
    };

    // Enlazar las URLs a los enlaces del nuevo modal
    document.getElementById('plus-modal-link1').href = urls.youtube;
    document.getElementById('plus-modal-link2').href = urls.linkedin;
    document.getElementById('plus-modal-link3').href = urls.facebook;
    document.getElementById('plus-modal-link4').href = urls.twitter;
    document.getElementById('plus-modal-link5').href = urls.whatsapp;

    // Mostrar el nuevo modal
    document.getElementById('plusModal').style.display = 'flex';
}

// Función para cerrar el modal de compartir
function closeModal() {
    document.getElementById('shareModal').style.display = 'none';
}

// Función para cerrar el nuevo modal
function closePlusModal() {
    document.getElementById('plusModal').style.display = 'none';
}

// Función para cerrar el nuevo modal
function closeNewModal() {
    document.getElementById('newModal').style.display = 'none';
}

// Cerrar el modal de compartir si se hace clic fuera de la ventana del modal
window.onclick = function(event) {
    const modal = document.getElementById('shareModal');
    const plusModal = document.getElementById('plusModal');
    const newModal = document.getElementById('newModal');
    if (event.target == modal) {
        closeModal();
    } else if (event.target == plusModal) {
        closePlusModal();
    } else if (event.target == newModal) {
        closeNewModal();
    }
}

// Seleccionar el botón que abre el segundo modal
const openNewModalButton = document.querySelector('.open-new-modal-btn');

// Agregar un evento al botón para abrir el segundo modal
if (openNewModalButton) {
    openNewModalButton.addEventListener('click', () => {
        document.getElementById('newModal').style.display = 'flex';
    });
}
</script>

<script>
 const videos = document.querySelectorAll('video');

const options = {
  root: null,
  rootMargin: '0px',
  threshold: 0.5
};

const observer = new IntersectionObserver((entries, observer) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.play();
      entry.target.muted = false;
    } else {
      entry.target.pause();
      entry.target.muted = false;
    }
  });
}, options);

videos.forEach(video => {
  const src = video.getAttribute('src');

  fetch(src)
    .then(res => res.blob())
    .then(blob => {
      const videoBlob = URL.createObjectURL(blob);
      video.src = videoBlob;
      observer.observe(video);

      video.addEventListener('ended', () => {
        const nextLi = video.closest('li').nextElementSibling;
        if (nextLi) {
          nextLi.scrollIntoView({ behavior: 'smooth' });
        }
      });

      video.addEventListener('click', () => {
        if (video.paused) {
          video.play();
          video.muted = false;
        } else {
          video.pause();
          video.muted = false;
        }
      });

      video.autoplay = true;
      video.muted = false;

      // Agregar contador de tiempo
      const durationDisplay = video.closest('.video-container').querySelector('.duration');
      video.addEventListener('timeupdate', () => {
        const minutes = Math.floor(video.currentTime / 60);
        const seconds = Math.floor(video.currentTime % 60);
        durationDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

        // Actualizar la barra de progreso
        const progressBar = video.closest('.video-container').querySelector('.progress-bar');
        progressBar.value = (video.currentTime / video.duration) * 100;
      });

      // Adelantar o retroceder el video al hacer clic o deslizar la barra de progreso
      const progressBar = video.closest('.video-container').querySelector('.progress-bar');
      progressBar.addEventListener('click', event => {
        const pos = (event.pageX - (progressBar.offsetLeft + progressBar.offsetParent.offsetLeft)) / progressBar.offsetWidth;
        video.currentTime = pos * video.duration;
      });
      progressBar.addEventListener('mousedown', () => {
        video.pause();
      });
      progressBar.addEventListener('mouseup', () => {
        video.play();
      });
      progressBar.addEventListener('touchstart', () => {
        video.pause();
      });
      progressBar.addEventListener('touchend', () => {
        video.play();
      });
      progressBar.addEventListener('touchmove', event => {
        const pos = (event.touches[0].pageX - (progressBar.offsetLeft + progressBar.offsetParent.offsetLeft)) / progressBar.offsetWidth;
        video.currentTime = pos * video.duration;
      });
    });
});

const videoContainer = document.querySelector('.video-container');
const videoPlayer = videoContainer.querySelector('.video__player');
const playButton = videoContainer.querySelector('.play-button');

playButton.addEventListener('click', () => {
  videoPlayer.play();
  videoContainer.classList.add('playing');
  playButton.style.display = 'none';
});

videoPlayer.addEventListener('play', () => {
  videoContainer.classList.add('playing');
  playButton.style.display = 'none';
});

videoPlayer.addEventListener('pause', () => {
  videoContainer.classList.remove('playing');
  playButton.style.display = 'block';
});

// Actualizar la barra de progreso
const progressBar = videoPlayer.closest('.video-container').querySelector('.progress-bar');
videoPlayer.addEventListener('timeupdate', () => {
  progressBar.value = (videoPlayer.currentTime / videoPlayer.duration) * 100;
});

// Adelantar o retroceder el video al hacer clic o deslizar la barra de progreso
progressBar.addEventListener('click', event => {
  const pos = (event.pageX - (progressBar.offsetLeft + progressBar.offsetParent.offsetLeft)) / progressBar.offsetWidth;
  videoPlayer.currentTime = pos * videoPlayer.duration;
});
progressBar.addEventListener('mousedown', () => {
  videoPlayer.pause();
});
progressBar.addEventListener('mouseup', () => {
  videoPlayer.play();
});
progressBar.addEventListener('touchstart', () => {
  videoPlayer.pause();
});
progressBar.addEventListener('touchend', () => {
  videoPlayer.play();
});
progressBar.addEventListener('touchmove', event => {
  const pos = (event.touches[0].pageX - (progressBar.offsetLeft + progressBar.offsetParent.offsetLeft)) / progressBar.offsetWidth;
  videoPlayer.currentTime = pos * videoPlayer.duration;
});

// Adelantar o retroceder el video al presionar las teclas de la flecha izquierda/derecha o inicio/fin
document.addEventListener('keydown', event => {
  const videos = document.querySelectorAll('video');

  videos.forEach(video => {
    if (document.activeElement === video) {
      switch (event.keyCode) {
        case 37: // Tecla de flecha izquierda
          video.currentTime -= 5;
          break;
        case 39: // Tecla de flecha derecha
          video.currentTime += 5;
          break;
        case 36: // Tecla de inicio
          video.currentTime = 0;
          break;
        case 35: // Tecla de fin
          video.currentTime = video.duration;
          break;
        default:
          break;
      }
    }
  });
});


</script>

        <br><br>
        </div>
        </div>
    </div>
    

    <div style="border-bottom:1px #80808000 solid;" class="tabs_bottom tows">
        <div class="tab2 tows" style="border-bottom: 3px solid #03a9f400;" onclick="openTab('tab2')"><a href="home.php"><svg class="tows" viewBox="0 0 48 48" width="20" height="20" stroke="currentColor"><path fill="currentColor" stroke-width="4" d="m 23.951,2 c -0.32,0.011 -0.628,0.124 -0.879,0.322 L 8.859,13.52 C 7.055,14.941 6,17.114 6,19.41 V 38.5 C 6,39.864 7.136,41 8.5,41 h 8 c 1.364,0 2.5,-1.136 2.5,-2.5 v -12 C 19,26.205 19.205,26 19.5,26 h 9 c 0.295,0 0.5,0.205 0.5,0.5 v 12 c 0,1.364 1.136,2.5 2.5,2.5 h 8 C 40.864,41 42,39.864 42,38.5 V 19.41 c 0,-2.296 -1.055,-4.469 -2.859,-5.89 L 24.928,2.322 C 24.65,2.103 24.304,1.989 23.951,2 Z"></path></svg></a></div>
        <div class="tab2 tows" style="border-bottom: 3px solid #03a9f400;" onclick="openTab('tab2')"><a href="search.php"><svg class="tows" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20"><path d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z"></path></svg></a></div>
        <div class="tab2 tows" style="border-bottom: 3px solid #00000000;" onclick="openTab('tab1')"><a href="stat.php"><svg class="tows" xmlns="http://www.w3.org/2000/svg" id="Outline" fill="currentColor" class="bi bi-star not_loved" viewBox="0 0 24 24" width="20" height="20"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"></path></svg></a></div>
        <div class="tab2 tows" style="border-bottom: 3px solid #00000000;" onclick="openTab('tab1')"><a href="noti.php"><svg class="tows" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20"><path d="M22.555,13.662l-1.9-6.836A9.321,9.321,0,0,0,2.576,7.3L1.105,13.915A5,5,0,0,0,5.986,20H7.1a5,5,0,0,0,9.8,0h.838a5,5,0,0,0,4.818-6.338ZM12,22a3,3,0,0,1-2.816-2h5.632A3,3,0,0,1,12,22Zm8.126-5.185A2.977,2.977,0,0,1,17.737,18H5.986a3,3,0,0,1-2.928-3.651l1.47-6.616a7.321,7.321,0,0,1,14.2-.372l1.9,6.836A2.977,2.977,0,0,1,20.126,16.815Z"></path></svg></a></div>
        <div class="tab2 tows" style="border-bottom: 3px solid #00000000; text-align: center;" onclick="openTab('tab1')"><a href="profile.php"><svg class="tows light-mode" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20"><path d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z"></path><path d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z"></path></svg></a></div>
    </div>
    
    <button style=" display: none;" id="toggleDarkMode">Toggle Dark Mode</button>
    <script src="dark.js"></script>
</div>
</body>


<?php
$archivo = "datos.json";
$datos = array();
$dedu = 0;
if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $datos = json_decode($contenido, true); // Agregamos el segundo parámetro true para que convierta los objetos en arrays asociativos
}

if (isset($_POST["eliminar"])) {
    $id = $_POST["eliminar"];
    unset($datos[$id]);

    $json_datos = json_encode($datos, JSON_PRETTY_PRINT);
    file_put_contents($archivo, $json_datos);

    header("Location: csc.php");
    exit();
}

// Mezclar las keys (IDs) al azar
$keys_al_azar = array_keys($datos);
shuffle($keys_al_azar);

?>

<?php
$promg = 0;
$count = 0;
foreach ($keys_al_azar as $id) {
    if ($count >= 2) {
        break;
    }
    $count++;
    $dato = $datos[$id];
?>
<script>
// Constante para el intervalo de notificaciones (3 horas en milisegundos)
const TRES_HORAS = 3 * 60 * 60 * 1000; // 3 horas

// Función para pedir permiso para mostrar notificaciones
function pedirPermisoNotificaciones() {
    if (!("Notification" in window)) {
        
    } else if (Notification.permission === "granted") {
        verificarUltimaNotificacion(); // Verificar si se debe mostrar la notificación
    } else if (Notification.permission !== "denied") {
        // Solicitar permiso al usuario
        Notification.requestPermission().then(function (permission) {
            if (permission === "granted") {
                verificarUltimaNotificacion();
            }
        });
    }
}

// Función para verificar si han pasado 3 horas desde la última notificación
function verificarUltimaNotificacion() {
    const ultimaNotificacion = localStorage.getItem('ultimaNotificacion');
    const ahora = Date.now();

    if (!ultimaNotificacion || ahora - ultimaNotificacion >= TRES_HORAS) {
        // Primera notificación a vinall.co
        mostrarNotificacion("<?php echo $dato["descripcion"]; ?>", "@<?php echo $dato["nombre"]; ?>");
        localStorage.setItem('ultimaNotificacion', ahora); // Registrar la hora actual como la última notificación
    }

    // Programar la próxima notificación después de 3 horas
    setTimeout(mostrarNotificacionPeriodica, TRES_HORAS);
}

// Función para mostrar una notificación con imagen
function mostrarNotificacion(titulo, mensaje, url) {
    if (Notification.permission === "granted") {
        var opciones = {
            body: mensaje,
            icon: "logo.png", // Imagen pequeña como ícono (opcional)
            image: "<?php echo $dato["imagenes"][0]; ?>", // Imagen grande opcional
        };

        var notificacion = new Notification(titulo, opciones);

        // Cierra la notificación después de 5 segundos
        setTimeout(notificacion.close.bind(notificacion), 5000);

        // Evento opcional: Cuando el usuario hace clic en la notificación
        notificacion.onclick = function () {
            window.open(url, '_blank'); // Abrir la URL en una nueva pestaña
            window.focus(); // Enfocar la ventana si está en segundo plano
        };
    }
}

// Función para mostrar notificación periódica cada 3 horas
function mostrarNotificacionPeriodica() {
    // Segunda notificación a vdlar.com
    mostrarNotificacion("¡Te extrañamos!", "Vuelve y revisa las novedades.", "https://vinlart.com");
    localStorage.setItem('ultimaNotificacion', Date.now()); // Actualizar el tiempo de la última notificación

    // Programar la próxima notificación para dentro de 3 horas
    setTimeout(mostrarNotificacionPeriodica, TRES_HORAS);
}

// Llamada a la función para pedir permiso al cargar la página
window.onload = function() {
    pedirPermisoNotificaciones();
};

</script>
<?php
}
?>

  
<iframe style="display:none;" src="all.php"></iframe>
</html>