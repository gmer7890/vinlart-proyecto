<?php
session_start();

// Verificar si el usuario ha iniciado sesión o si se ha almacenado una cookie de sesión
if (!isset($_SESSION['nombre']) && !isset($_COOKIE['nombre'])) {
  // Si no ha iniciado sesión y no hay una cookie de sesión, redireccionar a la página de registro
  header('Location: sign_up.php');
  exit;
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
  header('Location: sign_up.php');
  exit;
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

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
  // Si no ha iniciado sesión, redireccionar a la página de inicio de sesión
  header('Location: home.php');
  exit;
}

// Leer los datos de usuarios del archivo JSON
$usuarios = json_decode(file_get_contents('usuarios.json'), true);

// Obtener los datos del usuario actual
$nombre = $_SESSION['nombre'];
$usuario = $usuarios[$nombre];

// Variables para almacenar el estado de los cambios
$nombre_actualizado = false;
$correo_actualizado = false;
$link_actualizado = false;
$contrasena_actualizada = false;

// Procesar el formulario si se ha enviado
if (isset($_POST['submit'])) {
  // Obtener los datos del formulario
  $nuevo_nombre = $_POST['nombre'];
  $nuevo_correo = $_POST['correo'];
  $nuevo_link = $_POST['link'];
  $contrasena_actual = $_POST['contrasena_actual'];
  $nueva_contrasena = $_POST['nueva_contrasena'];
  $confirmar_contrasena = $_POST['confirmar_contrasena'];

  // Actualizar el nombre si ha sido modificado
  if ($nuevo_nombre !== $usuario['nombre_completo']) {
    $usuarios[$nombre]['nombre_completo'] = $nuevo_nombre;
    $nombre_actualizado = true;
  }

    // Actualizar el correo si ha sido modificado

  // Actualizar el correo si ha sido modificado
  if ($nuevo_correo !== $usuario['correo']) {
    $usuarios[$nombre]['correo'] = $nuevo_correo;
    $correo_actualizado = true;
  }

  // Actualizar el link si ha sido modificado
  if ($nuevo_link !== $usuario['link']) {
    $usuarios[$nombre]['link'] = $nuevo_link;
    $link_actualizado = true;
  }

  // Actualizar la contraseña si ha sido modificada y confirmada correctamente
  if (!empty($contrasena_actual) && !empty($nueva_contrasena) && $nueva_contrasena === $confirmar_contrasena) {
    // Verificar la contraseña actual
    if (password_verify($contrasena_actual, $usuario['contrasena'])) {
      // Encriptar la nueva contraseña
      $usuarios[$nombre]['contrasena'] = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
      $contrasena_actualizada = true;
    } else {
      // Contraseña actual incorrecta
      echo "La contraseña actual es incorrecta.";
      exit;
    }
  }

  // Guardar los datos actualizados en el archivo JSON
  file_put_contents('usuarios.json', json_encode($usuarios));

  // Redireccionar a la página de perfil
  header('Location: profile.php?user=$d');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 500</title>
    <link rel="icon" href="logo.png">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./dark.css" />
    <script>
        (function() {
            const currentMode = localStorage.getItem('mode') || 'light';
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
                <img style="width: 70px; height: 70px; object-fit: cover;" src="perfiles/<?php echo $usuario['imagen'] ?>" alt="profile">
            </div>
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
        <a class="darklight dark-mode" href="pass.php">
                <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="17" height="17"><path d="M19,8.424V7A7,7,0,0,0,5,7V8.424A5,5,0,0,0,2,13v6a5.006,5.006,0,0,0,5,5H17a5.006,5.006,0,0,0,5-5V13A5,5,0,0,0,19,8.424ZM7,7A5,5,0,0,1,17,7V8H7ZM20,19a3,3,0,0,1-3,3H7a3,3,0,0,1-3-3V13a3,3,0,0,1,3-3H17a3,3,0,0,1,3,3Z"/><path d="M12,14a1,1,0,0,0-1,1v2a1,1,0,0,0,2,0V15A1,1,0,0,0,12,14Z"/></svg>
                </span>
                <span data-key="password">Password</span>
            </a>
            <a class="darklight dark-mode" href="page.php">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="17" height="17"><path d="M19,1H5C2.24,1,0,3.24,0,6v12c0,2.76,2.24,5,5,5h14c2.76,0,5-2.24,5-5V6c0-2.76-2.24-5-5-5ZM5,3h14c1.65,0,3,1.35,3,3v2H2v-2c0-1.65,1.35-3,3-3Zm14,18H5c-1.65,0-3-1.35-3-3V10H22v8c0,1.65-1.35,3-3,3Zm-1-15.5c0-.83,.67-1.5,1.5-1.5s1.5,.67,1.5,1.5-.67,1.5-1.5,1.5-1.5-.67-1.5-1.5Zm-4,0c0-.83,.67-1.5,1.5-1.5s1.5,.67,1.5,1.5-.67,1.5-1.5,1.5-1.5-.67-1.5-1.5Zm-4,0c0-.83,.67-1.5,1.5-1.5s1.5,.67,1.5,1.5-.67,1.5-1.5,1.5-1.5-.67-1.5-1.5Z"></path></svg>
                </span>
                <span data-key="views">Views</span>
            </a>
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

            <a class=active href="text.php">
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

            <a href="profile.php?user=<?php echo $d; ?>"><div style=" position: absolute; bottom: 0; width: 90%; padding: 6px; margin-bottom: 9px; border-radius: 10px;" class="post-info tows">
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
       <div style="border-bottom: 1px #80808021 solid;" class="header tows">
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
                <a href="share.php" class="btn">         
                    <svg fill="white" xmlns="http://www.w3.org/2000/svg" id="Layer_1" width="20" height="20" viewBox="0 0 24 24" data-name="Layer 1"><path d="m12 0a12 12 0 1 0 12 12 12.013 12.013 0 0 0 -12-12zm0 22a10 10 0 1 1 10-10 10.011 10.011 0 0 1 -10 10zm5-10a1 1 0 0 1 -1 1h-3v3a1 1 0 0 1 -2 0v-3h-3a1 1 0 0 1 0-2h3v-3a1 1 0 0 1 2 0v3h3a1 1 0 0 1 1 1z"></path></svg>
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
</style>

<div class="container mx-auto">
  <br><br><br>
  <center>
        <img style="
        outline: .5px solid rgb(221 238 255 / 30%);
            text-align: center;
        border-radius: 50%; object-fit: cover;
        border:solid 0px rgb(255, 255, 255); margin-top:5px; width:79px; height:79px;" src="perfiles/<?php echo $usuario['imagen']; ?>">
        </center>
  <br><br>
  <center>
      <h1 style="font-size:65px;">
          500
      </h1>
      <button onclick="goHome()">Go to Home</button>
  </center>
  <br>
</div>

<script>
        function goHome() {
            window.location.href = 'home.php';
        }
    </script>
        <br><br>
        </div>
        </div>
    </div>
    

    <div style="border-bottom:1px #80808000 solid;" class="tabs_bottom tows">
        <div class="tab2 tows" style="border-bottom: 3px solid #03a9f400;" onclick="openTab('tab2')"><a href="home.php"><svg class="towse" viewBox="0 0 48 48" width="20" height="20" stroke="currentColor" class="r-1jj8364 r-lchren r-ipm5af"><path stroke-width="4" d="M 23.951 2 C 23.631 2.011 23.323 2.124 23.072 2.322 L 8.859 13.52 C 7.055 14.941 6 17.114 6 19.41 L 6 38.5 C 6 39.864 7.136 41 8.5 41 L 18.5 41 C 19.864 41 21 39.864 21 38.5 L 21 28.5 C 21 28.205 21.205 28 21.5 28 L 26.5 28 C 26.795 28 27 28.205 27 28.5 L 27 38.5 C 27 39.864 28.136 41 29.5 41 L 39.5 41 C 40.864 41 42 39.864 42 38.5 L 42 19.41 C 42 17.114 40.945 14.941 39.141 13.52 L 24.928 2.322 C 24.65 2.103 24.304 1.989 23.951 2 Z"></path></svg></a></div>
        <div class="tab2 tows" style="border-bottom: 3px solid #03a9f400;" onclick="openTab('tab2')"><a href="search.php"><svg class="tows" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20"><path d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z"></path></svg></a></div>
        <div class="tab2 tows" style="border-bottom: 3px solid #00000000;" onclick="openTab('tab1')"><a href="stat.php"><svg class="tows" xmlns="http://www.w3.org/2000/svg" id="Outline" fill="currentColor" class="bi bi-star not_loved" viewBox="0 0 24 24" width="20" height="20"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"></path></svg></a></div>
        <div class="tab2 tows" style="border-bottom: 3px solid #00000000;" onclick="openTab('tab1')"><a href="noti.php"><svg class="tows" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20"><path d="M22.555,13.662l-1.9-6.836A9.321,9.321,0,0,0,2.576,7.3L1.105,13.915A5,5,0,0,0,5.986,20H7.1a5,5,0,0,0,9.8,0h.838a5,5,0,0,0,4.818-6.338ZM12,22a3,3,0,0,1-2.816-2h5.632A3,3,0,0,1,12,22Zm8.126-5.185A2.977,2.977,0,0,1,17.737,18H5.986a3,3,0,0,1-2.928-3.651l1.47-6.616a7.321,7.321,0,0,1,14.2-.372l1.9,6.836A2.977,2.977,0,0,1,20.126,16.815Z"></path></svg></a></div>
        <div class="tab2 tows" style="border-bottom: 3px solid #00000000; text-align: center;" onclick="openTab('tab1')"><a href="profile.php"><svg class="tows" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20"><path d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z"/><path d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z"/></svg></a></div>
    </div>
    
    <button style=" display: none;" id="toggleDarkMode">Toggle Dark Mode</button>
    <script src="dark.js"></script>
</div>
</body>

</html>