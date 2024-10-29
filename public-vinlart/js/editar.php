<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    // Si no ha iniciado sesión, redireccionar a la página de inicio de sesión
    header('Location: login.php');
    exit;
}

// Leer los datos de usuarios del archivo JSON
$usuarios = json_decode(file_get_contents('usuarios.json'), true);

// Obtener los datos del usuario actual
$nombre = $_SESSION['nombre'];
$usuario = $usuarios[$nombre];

// Procesar el formulario de edición de foto de perfil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se envió un archivo
    if (isset($_FILES['imagen']) && $_FILES['imagen']['name'] !== '') {
        $foto = $_FILES['imagen'];

        // Obtener el nombre del archivo
        $nombre_archivo = $foto['name'];

        // Obtener la ruta temporal del archivo
        $ruta_temporal = $foto['tmp_name'];

        // Mover el archivo a la carpeta de imágenes
        $destino = 'perfiles/' . $nombre_archivo;
        move_uploaded_file($ruta_temporal, $destino);

        // Actualizar el nombre de la imagen en los datos del usuario
        $usuario['imagen'] = $nombre_archivo;
    } else {
        // Si no se sube ninguna imagen, establecer la imagen por defecto
        $usuario['imagen'] = 'd/perfildefault.jpg';
    }

    // Guardar los cambios en el archivo JSON
    $usuarios[$nombre] = $usuario;
    file_put_contents('usuarios.json', json_encode($usuarios, JSON_PRETTY_PRINT));

    // Redireccionar a perfil.php
    header('Location: profile.php?user=<?php echo $d; ?>');
    exit;
}
?>
<!DOCTYPE html>
<html style="background-color:white;" lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <link rel="stylesheet" type="text/css" href="./dark.css" />
    <title>Vanne - <?php echo $usuario['nombre_completo']; ?> (@<?php echo $d; ?>) / vanneUser</title>
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

#image-container {
      width: 350px;
      height: 350px;
      margin: auto;
      border: 1px solid #ddd;
      border-radius: 50%;
      overflow: hidden;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center center;
    }
</style>
    <link rel="icon" href="vanne.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200&family=Nanum+Gothic&family=Nunito:wght@200;300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./sass/vender/bootstrap.css">
    <link rel="stylesheet" href="./sass/vender/bootstrap.min.css">
    <link rel="stylesheet" href="./owlcarousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="./owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css">
    <link rel="stylesheet" href="./sass/main.css">
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
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <div class="post_page">
        <!--***** nav menu start ****** -->
         <style>
.nav_menu {

}
@media screen and (max-width: 767px) {
    
 .nav_menu {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #ffffff;
    border-bottom: none;
    transition: transform 0.3s, top 0.3s, border-bottom 0.3s;
    z-index: 1000;
}

.nav_menu.border-visible {
    border-bottom: solid 1px #ccc;
}
}
</style>
<script>
let prevScrollPos = window.pageYOffset;

window.onscroll = function() {
    let currentScrollPos = window.pageYOffset;

    if (prevScrollPos > currentScrollPos) {
        // El usuario está desplazando hacia arriba, muestra el menú
        document.getElementById("navbar").style.top = "0";
    } else {
        // El usuario está desplazando hacia abajo, oculta el menú
        document.getElementById("navbar").style.top = "-100px";
    }

    prevScrollPos = currentScrollPos;
}

</script>


        <div style="display: none;" id="navbar" class="nav_menu">
            <div class="fix_top">
                <!-- nav for big->medium screen -->
                <div class="nav">
                    <div class="logo">
                        <a href="g.php">
                            <img class="d-block d-lg-none small-logo" src="./images/corazon.png" alt="logo">
                            <img style="width:120px;" class="pat2 d-none d-lg-block" src="./images/logo_menu.png" alt="logo">
                        </a>
                    </div>
                    <div class="menu">
 <ul>
                            <style>
                                .fakls{
                                    background-color: transparent;
                                    border-radius: 10px;
                                    padding:0px 5px;
                                }
                                .fakls:hover{
                                    background-color: rgb(210 201 201 / 35%);
                                    border-radius: 10px;
                                    padding:10px 5px;
                                }
                            </style>
                            <li>
                                <a class="fakls" href="index.php">
<svg viewBox="0 0 48 48" width="25" height="25" stroke="currentColor" fill="none" class="r-1jj8364 r-lchren r-ipm5af" style="color: black; margin-right:3px; padding-bottom:3px;"><path stroke-width="4" d="M 23.951 2 C 23.631 2.011 23.323 2.124 23.072 2.322 L 8.859 13.52 C 7.055 14.941 6 17.114 6 19.41 L 6 38.5 C 6 39.864 7.136 41 8.5 41 L 18.5 41 C 19.864 41 21 39.864 21 38.5 L 21 28.5 C 21 28.205 21.205 28 21.5 28 L 26.5 28 C 26.795 28 27 28.205 27 28.5 L 27 38.5 C 27 39.864 28.136 41 29.5 41 L 39.5 41 C 40.864 41 42 39.864 42 38.5 L 42 19.41 C 42 17.114 40.945 14.941 39.141 13.52 L 24.928 2.322 C 24.65 2.103 24.304 1.989 23.951 2 Z"></path></svg>
                                    <span class="d-none d-lg-block "><?php

switch ($usuario['ideoma']) {
    case 'Español':
        echo "Inicio";
        break;
    case 'Deutsch':
        echo "Start";
        break;
    case '日本語':
        echo "始める";
        break;
    case 'Русский':
        echo "Начинать";
        break;
    case 'English':
        echo "Home";
        break;
    default:
        echo "Inicio";
        break;
}
?></span>
                                </a>
                            </li>
                            <li id="search_icon">
                            <a class="fakls" href="#">
                                <svg style="margin-right:3px; padding-bottom:3px;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
</svg>
                                    <span class="d-none d-lg-block "><?php

switch ($usuario['ideoma']) {
    case 'Español':
        echo "Busquedas";
        break;
    case 'Deutsch':
        echo "Suchen";
        break;
    case '日本語':
        echo "検索";
        break;
    case 'Русский':
        echo "Поиски";
        break;
    case 'English':
        echo "Searches";
        break;
    default:
        echo "Busquedas";
        break;
}
?></span>
                                </a>
                            </li>
                            
                            
                            <li>
                                <a href="#" class="fakls" data-bs-toggle="modal" data-bs-target="#create_modal">
                               <svg aria-label="Nueva publicación" class="x1lliihq x1n2onr6 x5n08af" fill="currentColor" height="25" role="img" viewBox="0 0 24 24" width="25" style="color: black; margin-right:3px; padding-bottom:3px;"><title>Nueva publicación</title><path d="M2 12v3.45c0 2.849.698 4.005 1.606 4.944.94.909 2.098 1.608 4.946 1.608h6.896c2.848 0 4.006-.7 4.946-1.608C21.302 19.455 22 18.3 22 15.45V8.552c0-2.849-.698-4.006-1.606-4.945C19.454 2.7 18.296 2 15.448 2H8.552c-2.848 0-4.006.699-4.946 1.607C2.698 4.547 2 5.703 2 8.552Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="6.545" x2="17.455" y1="12.001" y2="12.001"></line><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="12.003" x2="12.003" y1="6.545" y2="17.455"></line></svg>
                               
                                    <span class="d-none d-lg-block "><?php

switch ($usuario['ideoma']) {
    case 'Español':
        echo "Crear";
        break;
    case 'Deutsch':
        echo "Erstellen";
        break;
    case '日本語':
        echo "作成する";
        break;
    case 'Русский':
        echo "Создавать";
        break;
    case 'English':
        echo "Create";
        break;
    default:
        echo "Crear";
        break;
}
?></span>
                                </a>

                            </li>
                            <li>
                            <a class="fakls" href="g.php">
                                <svg fill="none" viewBox="0 0 24 24" width="26" height="26" stroke-width="2" stroke="currentColor" style="color: black; margin-right:3px; padding-bottom:3px;"><path d="M 11.642 2 H 12.442 A 8.6 8.55 0 0 1 21.042 10.55 V 18.1 A 1 1 0 0 1 20.042 19.1 H 4.042 A 1 1 0 0 1 3.042 18.1 V 10.55 A 8.6 8.55 0 0 1 11.642 2 Z"></path><line x1="9" y1="22" x2="15" y2="22"></line></svg>
                                    <span class="d-none d-lg-block "><?php

switch ($usuario['ideoma']) {
    case 'Español':
        echo "Notificaciones";
        break;
    case 'Deutsch':
        echo "Benachrichtigungen";
        break;
    case '日本語':
        echo "通知";
        break;
    case 'Русский':
        echo "Уведомления";
        break;
    case 'English':
        echo "Notifications";
        break;
    default:
        echo "Notificaciones";
        break;
}

?></span>
                                </a>
                            </li>
                            <li>
                            <a class="fakls" href="save.php">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Outline" fill="currentColor" class="bi bi-star not_loved" viewBox="0 0 24 24" width="25" height="25" style="color: black; margin-right:3px; padding-bottom:3px;"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"></path></svg>
                                    <span class="d-none d-lg-block "><?php

switch ($usuario['ideoma']) {
    case 'Español':
        echo "Guardados";
        break;
    case 'Deutsch':
        echo "Gerettet";
        break;
    case '日本語':
        echo "保存されました";
        break;
    case 'Русский':
        echo "Сохранено";
        break;
    case 'English':
        echo "Saved";
        break;
    default:
        echo "Guardados";
        break;
}
?></span>
                                </a>
                            </li>
                            <li>
                            <a class="fakls" href="configuracion.php">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="25" height="25" style="color: black; margin-right:3px; padding-bottom:3px;"><path d="M12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"/><path d="M21.294,13.9l-.444-.256a9.1,9.1,0,0,0,0-3.29l.444-.256a3,3,0,1,0-3-5.2l-.445.257A8.977,8.977,0,0,0,15,3.513V3A3,3,0,0,0,9,3v.513A8.977,8.977,0,0,0,6.152,5.159L5.705,4.9a3,3,0,0,0-3,5.2l.444.256a9.1,9.1,0,0,0,0,3.29l-.444.256a3,3,0,1,0,3,5.2l.445-.257A8.977,8.977,0,0,0,9,20.487V21a3,3,0,0,0,6,0v-.513a8.977,8.977,0,0,0,2.848-1.646l.447.258a3,3,0,0,0,3-5.2Zm-2.548-3.776a7.048,7.048,0,0,1,0,3.75,1,1,0,0,0,.464,1.133l1.084.626a1,1,0,0,1-1,1.733l-1.086-.628a1,1,0,0,0-1.215.165,6.984,6.984,0,0,1-3.243,1.875,1,1,0,0,0-.751.969V21a1,1,0,0,1-2,0V19.748a1,1,0,0,0-.751-.969A6.984,6.984,0,0,1,7.006,16.9a1,1,0,0,0-1.215-.165l-1.084.627a1,1,0,1,1-1-1.732l1.084-.626a1,1,0,0,0,.464-1.133,7.048,7.048,0,0,1,0-3.75A1,1,0,0,0,4.79,8.992L3.706,8.366a1,1,0,0,1,1-1.733l1.086.628A1,1,0,0,0,7.006,7.1a6.984,6.984,0,0,1,3.243-1.875A1,1,0,0,0,11,4.252V3a1,1,0,0,1,2,0V4.252a1,1,0,0,0,.751.969A6.984,6.984,0,0,1,16.994,7.1a1,1,0,0,0,1.215.165l1.084-.627a1,1,0,1,1,1,1.732l-1.084.626A1,1,0,0,0,18.746,10.125Z"/></svg>
                                
                                    <span class="d-none d-lg-block "><?php

switch ($usuario['ideoma']) {
    case 'Español':
        echo "Configurar";
        break;
    case 'Deutsch':
        echo "Aufstellen";
        break;
    case '日本語':
        echo "設定";
        break;
    case 'Русский':
        echo "Настраивать";
        break;
    case 'English':
        echo "Set up";
        break;
    default:
        echo "Configurar";
        break;
}

?></span>
                                </a>
                            </li>
                            <li>
                                <a class="fakls" href="perfil.php">
                                    <img style="min-width:24px; border: 2px solid rgb(38, 38, 38); min-height:24px; background-color: #808080ad; max-height:24px; max-width:24px;" class="circle story" src="perfiles/<?php echo $usuario['imagen']; ?>">
                                    <span class="d-none d-lg-block "><?php

switch ($usuario['ideoma']) {
    case 'Español':
        echo "Perfil";
        break;
    case 'Deutsch':
        echo "Profil";
        break;
    case '日本語':
        echo "プロフィール";
        break;
    case 'Русский':
        echo "Профиль";
        break;
    case 'English':
        echo "Profile";
        break;
    default:
        echo "Perfil";
        break;
}
?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="more">
                        <div class="btn-group dropup">
                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img class="pat2" src="./images/menu.png">
                                <span class="d-none d-lg-block ">More</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">
                                        <span>Report a problem</span>
                                        <img src="./images/problem.png">
                                    </a></li>
                                
                                    <li><a class="dropdown-item" href="logout.php">
                                    <span style="color: red;">Cerrar sesion</span>
                                    </a></li>
                            </ul>
                        </div>
                        <!--  -->

                    </div>
                </div>
                <!-- nav for small screen  -->
                <div class="nav_sm">
                    <div class="content">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img class="logo" style="width: 52px;" src="./images/logo2.png">
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">
                                        <span>Following</span>
                                        <img src="./images/add-friend.png">
                                    </a></li>
                                <li><a class="dropdown-item" href="#">
                                        <span>Favorites</span>
                                        <img src="./images/star.png">
                                    </a></li>
                            </ul>
                        </div>
                        <div class="left">
                            <div class="search_bar">
                                <div class="input-group">
                                    
                                </div>
                            </div>
                            <div class="notifications notification_icon">
                            <a href="save.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-stars" viewBox="0 0 16 16">
<path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
</svg>
                        </a>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- nav for ex-small screen  -->
                <div style="border-bottom:solid 1px #cccccc36; background-image: url(<?php echo $usuario['banner']; ?>); background-size: cover; background-repeat: no-repeat; background-position: center top;" class="nav_xm">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="logo" style="width: 52px;" src="./images/logo2.png">
                        </button>
                        
                    </div>
                    <div class="left">
                        <div style="background-color:transparent; padding: 9px; margin-right:-3px; border-radius: 8px;" class="save not_saved">
                            
                            </div>
                        <div style="background-color:transparent; padding: 9px; margin-right:-3px; border-radius: 8px;" class="save not_saved">
                        <a id="abrir-modal" style="margin-right:16px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-stars" viewBox="0 0 16 16">
<path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
</svg>
                        </a>
<style>
        /* Estilos para el modal y el fondo oscuro */
        .modal2 {
            display: none;
            position: fixed;
            overflow-y: scroll;
            z-index: 99999;
            right: 0;
            top: 0;
            width: 40%;
            height: 100%;
            background-color: white;
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
                background-color: white;
            }
        }

        .modal-contenido {
            background-color: #fff;
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
            color: black;
            position: fixed;
            z-index: 99999;
            padding: 0px;
            font-size: 26px;
            border-radius: 5px;
            cursor: pointer;
            animation: 0.5s ease forwards;
        }
    </style>
<div id="mi-modal" class="modal2">
        <div class="modal-contenido">
            <span class="cerrar-modal" id="cerrar-modal">×</span>
            <h2>Mas opciones</h2>
            <p><a style="color:black;" href="configuracion.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="black" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"></path>
  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"></path>
</svg> Configuraciones</a></p>

<p><a style="color:black;" href="sign_up.php">
                        <svg style="margin-top:-3px;" xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="black" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"></path>
</svg> Nueva cuenta</a></p>

<p><a style="color:black;" href="info.php">
                        <svg style="margin-top:-4.4px;" xmlns="http://www.w3.org/2000/svg" width="19" height="18" fill="black" class="bi bi-gear" viewBox="0 0 16 16">
 <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
</svg> Mi informacion</a></p>

<p><a style="color:black;" href="blog/">
                        <svg style="margin-top:-3px;" xmlns="http://www.w3.org/2000/svg" width="19" height="18" fill="black" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"></path>
  <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4z"></path>
</svg> Blogs</a></p>

<p><a style="color:black;" href="ideoma.php">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="25" height="25"><path d="m7.508,9.196c-.107-.464-.403-.886-.842-1.07-.206-.086-.413-.126-.613-.126-.689,0-1.287.475-1.443,1.147l-1.475,6.252c-.072.307.16.601.476.601.226,0,.422-.155.475-.375l.389-1.625h3.115l.374,1.621c.051.222.249.379.476.379h.012c.314,0,.546-.292.476-.598l-1.422-6.206Zm-2.793,3.804l.869-3.627c.051-.219.244-.373.469-.373.073,0,.149.016.226.049.111.046.213.197.253.371l.827,3.58h-2.645Zm14.805-9H4.52C2.038,4,.02,6.019.02,8.5v7c0,2.481,2.019,4.5,4.5,4.5h15c2.481,0,4.5-2.019,4.5-4.5v-7c0-2.481-2.019-4.5-4.5-4.5ZM1.02,15.5v-7c0-1.93,1.57-3.5,3.5-3.5h7v14h-7c-1.93,0-3.5-1.57-3.5-3.5Zm22,0c0,1.93-1.57,3.5-3.5,3.5h-7V5h7c1.93,0,3.5,1.57,3.5,3.5v7Zm-1-6.009v.018c0,.271-.22.491-.491.491h-.546c-.107.917-.517,2.904-2.085,4.341.701.354,1.574.595,2.658.648.26.013.464.229.464.49v.018c0,.281-.235.505-.516.491-1.469-.071-2.605-.448-3.484-.986-.879.538-2.015.915-3.484.986-.28.014-.516-.21-.516-.491v-.018c0-.26.204-.477.464-.49,1.085-.054,1.957-.295,2.659-.648-.54-.495-.943-1.055-1.243-1.614-.176-.329.059-.727.432-.727.181,0,.345.1.432.259.291.534.695,1.066,1.257,1.519,1.474-1.185,1.862-2.925,1.964-3.777h-5.473c-.271,0-.491-.22-.491-.491v-.018c0-.271.22-.491.491-.491h3.009v-.509c0-.271.22-.491.491-.491h.018c.271,0,.491.22.491.491v.509h3.009c.271,0,.491.22.491.491Z"/></svg> Ideomas</a></p>

<p><a style="color:black;" href="loop.php">
                        <svg style="margin-top:-3px;" xmlns="http://www.w3.org/2000/svg" width="17" height="19" fill="black" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49a68.14 68.14 0 0 0-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 74.663 74.663 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199V2.5zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0zm-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233c.18.01.359.022.537.036 2.568.189 5.093.744 7.463 1.993V3.85zm-9 6.215v-4.13a95.09 95.09 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A60.49 60.49 0 0 1 4 10.065zm-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68.019 68.019 0 0 0-1.722-.082z"></path>
</svg> Politicas</a></p>

<p><a style="color:black;" href="tema.php">
                        <svg style="margin-top:-3px;" xmlns="http://www.w3.org/2000/svg" width="17" height="19" fill="black" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z"/>
  <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
</svg> Apariencia</a></p>

<p>
<details style="font-size:0px;">
<summary style="font-size:0px;"><svg style="margin-right:4px; margin-top: -10px;" xmlns="http://www.w3.org/2000/svg" width="17" height="19" fill="black" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M6 7.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm4.5.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Zm-.5 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
  <path d="M8 0a7.963 7.963 0 0 0-4.075 1.114c-.162.067-.31.162-.437.28A8 8 0 1 0 8 0Zm3.25 14.201a1.5 1.5 0 0 0-2.13.71A7.014 7.014 0 0 1 8 15a6.967 6.967 0 0 1-3.845-1.15 1.5 1.5 0 1 0-2.005-2.005A6.967 6.967 0 0 1 1 8c0-1.953.8-3.719 2.09-4.989a1.5 1.5 0 1 0 2.469-1.574A6.985 6.985 0 0 1 8 1c1.42 0 2.742.423 3.845 1.15a1.5 1.5 0 1 0 2.005 2.005A6.967 6.967 0 0 1 15 8c0 .596-.074 1.174-.214 1.727a1.5 1.5 0 1 0-1.025 2.25 7.033 7.033 0 0 1-2.51 2.224Z"/>
</svg> <span style="font-size:14px;">Cookies</span></summary>
<p>las cookies son usadas para guardar tu usuario, darte contenido que te gusta y muchas funciones mas como likes, comentarios etc...</p>
<script>
        function deleteCookies() {
            if (confirm("¿Estás seguro de que deseas eliminar todas las cookies?")) {
                // Elimina todas las cookies
                var cookies = document.cookie.split(";");
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = cookies[i];
                    var eqPos = cookie.indexOf("=");
                    var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                    document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;";
                }
                alert("Todas las cookies han sido eliminadas.");
            } else {
                alert("Las cookies no han sido eliminadas.");
            }
        }
    </script>
<button onclick="deleteCookies()" style="padding: 5px 15px; font-size: 15px; margin-left: 0px; border-radius: 10px; border: none; font-weight: 500; background-color: rgb(239, 239, 239);" class="">
                                    Eliminar cookies 
                                </button>
</details></p>
<br><br>
        </div>
    </div>
    <script>
        // Obtener elementos del DOM
        var botonAbrirModal = document.getElementById("abrir-modal");
        var modal = document.getElementById("mi-modal");
        var botonCerrarModal = document.getElementById("cerrar-modal");

        // Abrir el modal cuando se hace clic en el botón
        botonAbrirModal.addEventListener("click", function() {
            modal.style.display = "block";
        });

        // Cerrar el modal cuando se hace clic en la "x" o en el fondo oscuro
        botonCerrarModal.addEventListener("click", function() {
            modal.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    </script>
                        </div>
                    <div style="background-color:#efefef; padding: 9px; border-radius: 8px;" class="save not_saved">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                      </svg>
                                <span style="margin-right:12px;" class="bi bi-star hide saved">
                                <center>
                                <a href="https://twitter.com/intent/tweet?url=Mira mi perfil https://vannesocial.000webhostapp.com/@<?php echo $d ?>"><p style="color:black; margin:3px;">Compartir en twitter</p></a>
                                <hr>
                                <a href="login.php"><p style="color:black; margin:3px;">Cambiar cuenta</p></a>
                                <hr>
                                <a href="https://api.whatsapp.com/send?text=Mira mi perfil https://vannesocial.000webhostapp.com/@<?php echo $d ?>"><p style="color:black; margin:3px;">Compartir en whatsapp</p></a>
                                <hr>
                                    <a href="logout.php"><p style="color:red; margin:3px;">Cerrar sesion</p></a>
                                    <hr>
                                    <p style="color:black; margin:3px;">Cerrar</p>
                                    </center>
                                </span>
                               
                            </div>
                        
                    </div>
                </div>
            </div>
            <!-- menu in the botton for smal screen  -->
            <div style="border:solid 1px #cccccc36; padding-top: 9px; padding-right: 20px; padding-bottom: 10px; padding-left: 20px; z-index:99999;" class="nav_bottom">
                <a href="index.php"><svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="22" height="22"><path d="M22,5.724V2c0-.552-.447-1-1-1s-1,.448-1,1v2.366L14.797,.855c-1.699-1.146-3.895-1.146-5.594,0L2.203,5.579c-1.379,.931-2.203,2.48-2.203,4.145v9.276c0,2.757,2.243,5,5,5h3c.553,0,1-.448,1-1V15c0-.551,.448-1,1-1h4c.552,0,1,.449,1,1v8c0,.552,.447,1,1,1h3c2.757,0,5-2.243,5-5V9.724c0-1.581-.744-3.058-2-4Zm0,13.276c0,1.654-1.346,3-3,3h-2v-7c0-1.654-1.346-3-3-3h-4c-1.654,0-3,1.346-3,3v7h-2c-1.654,0-3-1.346-3-3V9.724c0-.999,.494-1.929,1.322-2.487L10.322,2.513c1.02-.688,2.336-.688,3.355,0l7,4.724c.828,.558,1.322,1.488,1.322,2.487v9.276Z"/></svg></a>
<a href="search.php"><svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="22" height="22"><path d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z"/></svg></a>
                <a href="share.php" data-bs-toggle="" data-bs-target="#create_modal"><svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" fill="black" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
</svg></a>
                <a href="g.php"><svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="22" height="22"><path d="M22.555,13.662l-1.9-6.836A9.321,9.321,0,0,0,2.576,7.3L1.105,13.915A5,5,0,0,0,5.986,20H7.1a5,5,0,0,0,9.8,0h.838a5,5,0,0,0,4.818-6.338ZM12,22a3,3,0,0,1-2.816-2h5.632A3,3,0,0,1,12,22Zm8.126-5.185A2.977,2.977,0,0,1,17.737,18H5.986a3,3,0,0,1-2.928-3.651l1.47-6.616a7.321,7.321,0,0,1,14.2-.372l1.9,6.836A2.977,2.977,0,0,1,20.126,16.815Z"/></svg></a>
<a class="pat" href="perfil.php" style="background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    justify-content: center; border:solid 3px black;
    align-items: center; background-color:#cccc; min-width:24px; min-height:24px; border-radius:100px; max-height:24px; max-width:24px; background-image: url('perfiles/<?php echo $usuario["imagen"]; ?>');"></a>
            </div>
        </div>
        </div>
        <!-- search  -->
        <div id="search" class="search_section">
        <h2>Busqueda</h2>
        <form style="background-color: rgb(239 239 239 / 0%);" method="get" action="resultados.php">
 <style>
        #sugerencias {
            position: absolute;
            background-color: white;
            border: 0px solid #ccc;
            overflow-y: auto;
        }

        #sugerencias ul {
            display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    width: 100%;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #sugerencias li {
            padding: 8px;
            cursor: pointer;
            display: inline-block;
            min-weight: 100%;
            width: 100%; /* Ancho fijo para cada sugerencia */
            margin-right: 0px; /* Espacio entre sugerencias */
            border-bottom: 1px solid #cccccc68; /* Borde para separar sugerencias */
            border-radius: 0px; /* Borde redondeado */
        }
    </style>


    <input style="background-color: rgb(239 239 239 / 56%); border-radius: 5px; margin: 4px; width: 94%; border: solid 0px; padding: 12px; margin-bottom: 1.5em;" autocomplete="off" id="busca" type="text" name="q" placeholder="Search...">
    <div id="sugerencias">
        <ul></ul> <!-- Lista de sugerencias -->
    </div>

    <script>
        const input = document.getElementById("busca");
        const sugerencias = document.getElementById("sugerencias");

        // Cargar los datos desde t.json (suponiendo que t.json contiene un array de objetos con propiedades 'texto')
        fetch('t.json')
            .then(response => response.json())
            .then(data => {
                input.addEventListener("input", function () {
                    const inputValue = this.value.trim().toLowerCase(); // Cambio aquí: uso trim() para eliminar espacios en blanco
                    if (inputValue === "") {
                        sugerencias.style.display = "none";
                        return;
                    }
                    const resultados = data.filter(item => item.texto.toLowerCase().includes(inputValue));
                    mostrarSugerencias(resultados);
                });
            })
            .catch(error => {
                console.error("Error al cargar los datos:", error);
            });

        function mostrarSugerencias(sugerenciasArray) {
            sugerencias.innerHTML = "";

            if (sugerenciasArray.length === 0) {
                sugerencias.style.display = "none";
                return;
            }

            sugerencias.style.display = "block";

            const ul = document.createElement("ul");
            sugerencias.appendChild(ul);

            sugerenciasArray.forEach(item => {
                const li = document.createElement("li");
                li.textContent = item.texto;
                li.addEventListener("click", function () {
                    input.value = item.texto;
                    sugerencias.style.display = "none";
                });
                ul.appendChild(li);
            });
        }
    </script>
            </form>
            <div class="find">
                
                
            </div>
        </div>
        <!-- search  -->
        <!-- notification -->
        <div id="notification" class="notification_section">
            <h2>Notifications</h2>
            <div class="notifications">
                <div class="notif follow_notif">
                    <div class="cart">
                        <div>
                            <div class="img">
                                <img src="./images/profile_img.jpg" alt="">
                            </div>
                            <div class="info">
                                <p class="name">
                                    Zineb_essoussi
                                    <span class="desc">started following you.</span>
                                    <span class="time">2h</span>
                                </p>

                            </div>
                        </div>
                        <div class="follow_you">
                            <button class="follow_text">Follow</button>
                        </div>
                    </div>
                </div>
                <div class="notif follow_notif">
                    <div class="cart">
                        <div>
                            <div class="img">
                                <img src="./images/profile_img.jpg" alt="">
                            </div>
                            <div class="info">
                                <p class="name">
                                    Zineb_essoussi
                                    <span class="desc">started following you.</span>
                                    <span class="time">2h</span>
                                </p>

                            </div>
                        </div>
                        <div class="follow_you">
                            <button class="follow_text">Follow</button>
                        </div>
                    </div>
                </div>
                <div class="notif story_notif">
                    <div class="cart">
                        <div>
                            <div class="img">
                                <img src="./images/profile_img.jpg" alt="">
                            </div>
                            <div class="info">
                                <div class="info">
                                    <p class="name">
                                        Zineb_essoussi
                                        <span class="desc">liked your story.</span>
                                        <span class="time">2d</span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="story_like">
                            <img src="./images/img2.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="notif follow_notif">
                    <div class="cart">
                        <div>
                            <div class="img">
                                <img src="./images/profile_img.jpg" alt="">
                            </div>
                            <div class="info">
                                <p class="name">
                                    Zineb_essoussi
                                    <span class="desc">started following you.</span>
                                    <span class="time">2h</span>
                                </p>

                            </div>
                        </div>
                        <div class="follow_you">
                            <button class="follow_text">Follow</button>
                        </div>
                    </div>
                </div>
                <div class="notif story_notif">
                    <div class="cart">
                        <div>
                            <div class="img">
                                <img src="./images/profile_img.jpg" alt="">
                            </div>
                            <div class="info">
                                <div class="info">
                                    <p class="name">
                                        Zineb_essoussi
                                        <span class="desc">liked your story.</span>
                                        <span class="time">2d</span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="story_like">
                            <img src="./images/img2.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="notif follow_notif">
                    <div class="cart">
                        <div>
                            <div class="img">
                                <img src="./images/profile_img.jpg" alt="">
                            </div>
                            <div class="info">
                                <p class="name">
                                    Zineb_essoussi
                                    <span class="desc">started following you.</span>
                                    <span class="time">2h</span>
                                </p>

                            </div>
                        </div>
                        <div class="follow_you">
                            <button class="follow_text">Follow</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--***** nav menu end ****** -->
        <!--Create model-->
       
        <div class="cok modal fade show" id="create_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" style="display: block;  background-color: #ffffff3b;">
            <div class="modal-dialog snok modal-dialog-centered modal-dialog-scrollable">
                <div class="tows cok modal-content">
                    <form class="tows" action="" method="post" id="upload-form" enctype="multipart/form-data">
                        <div class="modal-header">
                        <span class="title_create">
                            <style>
                                @media only screen and (max-width: 600px) {
                                    .snok{
                                        margin:-1px;
                                        height:100vh;
                                    }
                                    .cok{
                                        border-radius:0px;
                                        margin:0px;
                                        height:100vh;
                                    }}
                            </style>
                         <script>
function goBack() {
    window.history.back();
}
</script>
                          <svg onclick="goBack()" style="margin-top:-2px; margin-right:4px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-arrow-left tows" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
</svg> <span data-key="editProfile"></span></span>
                        <button class="A-halgo" id="submit-button" style="width:27%; padding: 5px 15px; font-size: 15px; margin-left: 0px; border-radius: 6px; border: none; font-weight: 500; color: white; background-color: #2196F3;" data-key="post" type="submit">Publicar</button>
                      
                    </div>
                    <div style="overflow-y: scroll; height: 350px; padding: 8px;" class="modal-body">
                        <svg style="display:none;" xmlns="http://www.w3.org/2000/svg" width="39" height="39" fill="currentColor" class="bi bi-upload up_load" viewBox="0 0 16 16">
                            <path d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828l.645-1.937zM3.794 1.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387A1.734 1.734 0 0 0 4.593 5.69l-.387 1.162a.217.217 0 0 1-.412 0L3.407 5.69A1.734 1.734 0 0 0 2.31 4.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387A1.734 1.734 0 0 0 3.407 2.31l.387-1.162zM10.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732L9.1 2.137a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L10.863.1z"/>
                          </svg>
                        
                        <p data-key="image" style="margin:2px;">Sube una foto</p>
                        
                        <button style="background-color:red; border:solid 1px red; border-radius:30px;" class="btn btn-primary btn_upload">
                            Up
                            <label for="archivo" class="upload-label">
            <input class="input_select content_r" type="file" accept="image/*" id="image-upload" name="imagen">
        </label>
                        </button>
                      
                        
 <style>
    /* Estilo para el contenedor del visor de Croppie */
    .croppie-container {
      width: 100%;
      height: 100%;
      position: relative;
      overflow: hidden;
    }

    /* Estilo para la imagen dentro del visor de Croppie */
    .croppie-container img {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
    }
  </style>
  <!-- Agrega la referencia a la librería Croppie -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" rel="stylesheet">
                        <div style="width: 330px; height: 330px; object-fit: cover; background-size: cover; background-repeat: no-repeat; background-position: center center;" id="image-container" class="hide_img cropped-image-container">
                        </div>
                        
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
  
                        <div id="image_description" class="hide_img">
                           

                            <style>
                            <?php
session_start();

// ... (código para cargar y verificar la sesión y los datos del usuario)

// Verificar si la imagen del usuario es "claro" o "oscuro"
if ($usuario['privacidad'] === "claro") {
    // La imagen del usuario es "claro"
    echo "";
} elseif ($usuario['privacidad'] === "oscuro") {
    // La imagen del usuario es "oscuro"
    echo "html {
    filter: invert(100%);
    background-color: black; /* Fondo negro */
    color: white; /* Texto blanco */
}
img, video {
    filter: invert();
}
.pat {
    filter: invert();
}
.pat2 {
    filter: invert(0);
}";
} else {
    // La imagen no coincide con "claro" ni "oscuro"
    echo "";
}
?>
                                    
    .navbar {
        top: 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        left: 0;
        width: 100%;
        height: 50px;
        background-color: white;
        color: black;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 3px;
      }
      
      .navbar i {
        font-size: 20px;
      }
      
      .navbar-center h1 {
        margin: 0;
        font-size: 24px;
        font-weight: bold;
        letter-spacing: 2px;
        text-transform: uppercase;
      }
      
      .navbar-right img {
        width: 30px;
        height: 30px;
        padding:2px;
        margin-right: 12px;
        border-radius: 50%;
      }
      
      .navbar-left {
        padding-left: 12px;
      }
      .bk {
 margin-top:7px;
 border-radius:20px;
 }
@media screen and (max-width: 867px) {
    
 .bk {
 margin-top:0px;
 border-radius:0px;
 }
}
                            </style>
                            <div style="width: 150%;" class="description">
                                <nav class="navbar">
                                    <div class="navbar-left">
                                      
                                    </div>
                                    <div class="navbar-center">
                                    
                                    </div>
                                    <div class="navbar-right">
                                        <button type="submit" class="next_btn_post btn_link">Publicar</button>
                                    </div>
                                  </nav>
                                <div class="cart">
                                    
                                </div>
                                
                                    <textarea type="text" name="texto" id="emoji_create" placeholder="Escribe algo..." style="display: none; border:solid 0px #cccc;"></textarea>
                                    <input name="tiempo" id="tiempo" value=" <?php

$date = new DateTime();
date_default_timezone_set('America/Mexico_City');
echo $date->format("Y-m-d H:i:s");

?>" maxlength="100" style="padding: 0px; margin-top: 1px; font-size:0px; border-radius: 0px; display: none; background-color: #121e2d00;esc border: solid 1px #7e3af200;" class="block w-full mt-1 text-sm dark:bg-gray-700 focus:outline-none focus:shadow-outline-transparent dark:text-gray-300 dark:focus:shadow2-outline-gray" placeholder="Edita">
<input name="nombre" style="width:0px; height:0px; background-color:transparent; display: none; color:transparent;" autocomplete="off" id="mensaje" type="text" maxlength="344" style="width:100%;" value="<?php echo $d; ?>" placeholder="Escribe algo">

<input name="link" style="width:0px; height:0px; background-color:transparent; display: none; color:transparent;" autocomplete="off" id="mensaje" type="text" maxlength="344" style="width:100%;" value="@<?php echo $d; ?>" placeholder="Escribe algo">

<input name="gmail" style="width:0px; height:0px; background-color:transparent; display: none; color:transparent;" autocomplete="off" id="mensaje" type="text" maxlength="344" style="width:100%;" value="<?php echo $usuario['correo']; ?>" placeholder="Escribe algo">

         <input name="voto" style="width:0px; height:0px; background-color:transparent; display: none; color:transparent;" autocomplete="off" id="mensaje" type="text" maxlength="344" style="width:100%;" value="<?php echo $usuario['nombre_completo']; ?>" placeholder="Escribe algo">

         <input name="ft" style="width:0px; height:0px; background-color:transparent; display: none; color:transparent;" autocomplete="off" id="mensaje" type="text" maxlength="344" style="width:100%;" value="<?php echo $usuario['imagen']; ?>" placeholder="Escribe algo">
                                </form>
                            </div>

                            <div class="description">
                                
                                   
                            </div>
                        </div>
                        <div class="post_published hide_img">
                            <img src="./images/uploaded_post.gif" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

        <div style="padding-top:0px; max-width: 600px; display: none;" class="profile_container">
            <div class="profile_info">
            <a href="banner.php"><div class="pat bk" style=" border: solid 0px white; width: 100%; height: 179px; background-color: #ccc; background-image: url('banner/<?php echo $usuario["banner"]; ?>'); background-size: cover; background-repeat: no-repeat; background-position: center center;"></div></a>
                <div>
                        <div style="margin-left:12px;">
                            <a href="editar.php" class="pat image-link" id="open-modal">
                            <img 
                            <?php
session_start();

// ... (código para cargar y verificar la sesión y los datos del usuario)

// Verificar si la imagen del usuario es "claro" o "oscuro"
if ($usuario['privacidad'] === "claro") {
    // La imagen del usuario es "claro"
    echo 'style="border-radius:50%; border:solid 5px rgb(255, 255, 255); width:110px; height:110px;"';
} elseif ($usuario['privacidad'] === "oscuro") {
    // La imagen del usuario es "oscuro"
    echo 'style="border-radius:50%; border:solid 5px black; width:110px; height:110px;"';
} else {
    // La imagen no coincide con "claro" ni "oscuro"
    echo 'style="border-radius:50%; border:solid 5px rgb(255, 255, 255); width:110px; height:110px;"';
}
?> src="perfiles/<?php echo $usuario["imagen"]; ?>" class="pat2 image" alt="">
<svg class="pat2 svg-overlay" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="26" height="26"><path d="M9,12c3.309,0,6-2.691,6-6S12.309,0,9,0,3,2.691,3,6s2.691,6,6,6Zm0-10c2.206,0,4,1.794,4,4s-1.794,4-4,4-4-1.794-4-4,1.794-4,4-4Zm1.75,14.22c-.568-.146-1.157-.22-1.75-.22-3.86,0-7,3.14-7,7,0,.552-.448,1-1,1s-1-.448-1-1c0-4.962,4.038-9,9-9,.762,0,1.519,.095,2.25,.284,.535,.138,.856,.683,.719,1.218-.137,.535-.68,.856-1.218,.719Zm12.371-4.341c-1.134-1.134-3.11-1.134-4.243,0l-6.707,6.707c-.755,.755-1.172,1.76-1.172,2.829v1.586c0,.552,.448,1,1,1h1.586c1.069,0,2.073-.417,2.828-1.172l6.707-6.707c.567-.567,.879-1.32,.879-2.122s-.312-1.555-.878-2.121Zm-1.415,2.828l-6.708,6.707c-.377,.378-.879,.586-1.414,.586h-.586v-.586c0-.534,.208-1.036,.586-1.414l6.708-6.707c.377-.378,1.036-.378,1.414,0,.189,.188,.293,.439,.293,.707s-.104,.518-.293,.707Z"/></svg>
                            </a>
                        </div>
                        </div>
                        
<style>
        /* Estilos generales para el modal */
/* Estilos generales para el modal */
.modalss {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50%;
    max-height: 429px;
    padding: 20px;
    border-top-left-radius:15px;
    border-top-right-radius:15px;
    border-bottom-left-radius:0px;
    border-bottom-right-radius:0px;
    background-color: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    z-index: 9999;
}

/* Estilos para el modal en dispositivos móviles */
@media (max-width: 768px) {
    .modalss {
        width: 100%;
        max-width: none;
        height: 100%;
        bottom: 0px;
        max-height: 409px;
    border-top-left-radius:15px;
    border-top-right-radius:15px;
    border-bottom-left-radius:0px;
    border-bottom-right-radius:0px;
        left: 0;
        transform: translate(0, 0);
    }
}

        /* Estilos para el fondo oscuro detrás del modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;
        }

        /* Estilos para el botón de cerrar */
        .close-button {
            position: absolute;
            top: 14px;
            font-size:23px;
            right: 10px;
            cursor: pointer;
        }
        
        /* Estilos para el enlace */
.image-link {
  position: relative;
  display: inline-block;
  overflow: hidden;
  border-radius: 50%;
  border: solid 5px <?php
session_start();

// ... (código para cargar y verificar la sesión y los datos del usuario)

// Verificar si la imagen del usuario es "claro" o "oscuro"
if ($usuario['privacidad'] === "claro") {
    // La imagen del usuario es "claro"
    echo "white";
} elseif ($usuario['privacidad'] === "oscuro") {
    // La imagen del usuario es "oscuro"
    echo "black";
} else {
    // La imagen no coincide con "claro" ni "oscuro"
    echo "white";
}
?>;
  width: 110px;
  margin-top: -52px;
  height: 110px;
  transition: filter 0.3s ease; /* Agregar transición suave al filtro */
}

/* Estilos para la imagen */
.image-link:hover .image {
  filter: grayscale(60%) blur(5px); /* Aplicar efecto de cristal con filtro al pasar el ratón sobre el enlace */
}

.image {
  display: block;
  width: 100%;
  margin-left: -4.3px;
  margin-top: -5px;
  height: 100%;
  transition: filter 0.3s ease; /* Agregar transición suave al filtro */
}

/* Estilos para el SVG */
.svg-overlay {
  position: absolute;
  top: 49.6%;
  left: 53%;
  transform: translate(-50%, -50%);
  fill: white;
  opacity: 0; /* Ocultar el SVG inicialmente */
  transition: opacity 0.3s ease; /* Agregar transición suave a la opacidad */
}

.image-link:hover .svg-overlay {
  opacity: 1; /* Mostrar el SVG al pasar el ratón sobre el enlace */
}

    </style>
</head>
<body>
    <!-- Botón para abrir el modal -->

    <!-- Modal -->
    <div class="modal-overlay" id="modal-overlay"></div>
    <div class="modalss" id="modalss">
        <span class="close-button" id="close-modal2">&times;</span>
        <h5>Mi cuenta</h5>
        <center>
        <img style="border-radius:50%; border:solid 0px rgb(255, 255, 255); margin-top:5px; width:70px; height:70px;" class="circle" src="perfiles/<?php
$clave = $d;
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
?>">
        <br><br>
        <a href="editar.php" style="text-align:center; color:black; font-family: Nunito; font-size:16px;">Editar foto de perfil</a>
        <hr style="margin-bottom:9px; margin-top:9px;">
        <a href="play.php" style="text-align:center; color:black; font-family: Nunito; font-size:16px;">Editar cancion de perfil</a>
        <hr style="margin-bottom:9px; margin-top:9px;">
        <a href="sign_up.php" style="text-align:center; color:black; font-family: Nunito; font-size:16px;">Crear nueva cuenta</a>
        <hr style="margin-bottom:9px; margin-top:9px;">
        <a href="login.php" style="text-align:center; color:black; font-family: Nunito; font-size:16px;">Cambiar a otra cuenta</a>
        <hr style="margin-bottom:9px; margin-top:9px;">
        <a href="tema.php" style="text-align:center; color:black; font-family: Nunito; font-size:16px;">Modo oscuro</a>
        <hr style="margin-bottom:9px; margin-top:9px;">
        <a href="logout.php" style="text-align:center; color:red; font-family: Nunito; font-size:16px;">Eliminar cuenta</a>
        </center>
    </div>
 <script>
        const openModalLink = document.getElementById("open-modal");
        const modal = document.getElementById("modalss");
        const modalOverlay = document.getElementById("modal-overlay");
        const closeModalButton = document.getElementById("close-modal2");

        openModalLink.addEventListener("click", (e) => {
            e.preventDefault(); // Evita que el enlace siga el enlace predeterminado
            modal.style.display = "block";
            modalOverlay.style.display = "block";
        });

        closeModalButton.addEventListener("click", () => {
            modal.style.display = "none";
            modalOverlay.style.display = "none";
        });
    </script>


                        <center>
                             <script>
  const emojiMap = {
  "😀": "https://twemoji.maxcdn.com/v/latest/svg/1f600.svg", // Cara sonriendo con ojos abiertos
  "😃": "https://twemoji.maxcdn.com/v/latest/svg/1f603.svg", // Cara sonriendo con ojos cerrados
  "😄": "https://twemoji.maxcdn.com/v/latest/svg/1f604.svg", // Cara sonriendo con boca abierta y ojos sonrientes
  "😁": "https://twemoji.maxcdn.com/v/latest/svg/1f601.svg", // Cara sonriendo con ojos cerrados y boca abierta
  "😆": "https://twemoji.maxcdn.com/v/latest/svg/1f606.svg", // Cara sonriendo con boca abierta y ojos cerrados
  "😅": "https://twemoji.maxcdn.com/v/latest/svg/1f605.svg", // Cara sonriendo con ojos cerrados y gota de sudor
  "🤣": "https://twemoji.maxcdn.com/v/latest/svg/1f923.svg", // Cara rodando de la risa
  "😂": "https://twemoji.maxcdn.com/v/latest/svg/1f602.svg", // Cara llorando de risa
  "🙂": "https://twemoji.maxcdn.com/v/latest/svg/1f642.svg", // Cara sonriendo
  "🙃": "https://twemoji.maxcdn.com/v/latest/svg/1f643.svg", // Cara al revés
  "😉": "https://twemoji.maxcdn.com/v/latest/svg/1f609.svg", // Cara guiñando un ojo
  "😊": "https://twemoji.maxcdn.com/v/latest/svg/1f60a.svg", // Cara sonriente con ojos sonrientes
  "😇": "https://twemoji.maxcdn.com/v/latest/svg/1f607.svg", // Cara sonriente con halo
  "🥰": "https://twemoji.maxcdn.com/v/latest/svg/1f970.svg", // Cara con corazones
  "😍": "https://twemoji.maxcdn.com/v/latest/svg/1f60d.svg", // Cara sonriendo con corazones en los ojos
  "🤩": "https://twemoji.maxcdn.com/v/latest/svg/1f929.svg", // Cara con estrellas en los ojos
  "😘": "https://twemoji.maxcdn.com/v/latest/svg/1f618.svg", // Cara lanzando un beso
  "😗": "https://twemoji.maxcdn.com/v/latest/svg/1f617.svg", // Cara besando
  "☺️": "https://twemoji.maxcdn.com/v/latest/svg/263a.svg", // Cara sonriendo clásica
  "😚": "https://twemoji.maxcdn.com/v/latest/svg/1f61a.svg", // Cara besando con ojos cerrados
  "😙": "https://twemoji.maxcdn.com/v/latest/svg/1f619.svg", // Cara besando con ojos sonrientes
  "😋": "https://twemoji.maxcdn.com/v/latest/svg/1f60b.svg", // Cara saboreando comida
  "😛": "https://twemoji.maxcdn.com/v/latest/svg/1f61b.svg", // Cara sacando la lengua
  "😜": "https://twemoji.maxcdn.com/v/latest/svg/1f61c.svg", // Cara guiñando un ojo y sacando la lengua
  "🤪": "https://twemoji.maxcdn.com/v/latest/svg/1f92a.svg", // Cara con ojos cruzados y lengua fuera
  "😝": "https://twemoji.maxcdn.com/v/latest/svg/1f61d.svg", // Cara con ojos cerrados y lengua fuera
  "🤑": "https://twemoji.maxcdn.com/v/latest/svg/1f911.svg", // Cara con dinero en la boca
  "🤗": "https://twemoji.maxcdn.com/v/latest/svg/1f917.svg", // Cara abrazando
  "🤭": "https://twemoji.maxcdn.com/v/latest/svg/1f92d.svg", // Cara con mano sobre la boca
  "🤫": "https://twemoji.maxcdn.com/v/latest/svg/1f92b.svg", // Cara diciendo "shh"
  "🤔": "https://twemoji.maxcdn.com/v/latest/svg/1f914.svg", // Cara pensativa
  "🤐": "https://twemoji.maxcdn.com/v/latest/svg/1f910.svg", // Cara con cremallera en la boca
  "🤨": "https://twemoji.maxcdn.com/v/latest/svg/1f928.svg", // Cara con cejas levantadas
  "😐": "https://twemoji.maxcdn.com/v/latest/svg/1f610.svg", // Cara neutral
  "😑": "https://twemoji.maxcdn.com/v/latest/svg/1f611.svg", // Cara inexpresiva
  "😶": "https://twemoji.maxcdn.com/v/latest/svg/1f636.svg", // Cara sin boca
  "😏": "https://twemoji.maxcdn.com/v/latest/svg/1f60f.svg", // Cara sonriendo con sonrisa socarrona
  "😒": "https://twemoji.maxcdn.com/v/latest/svg/1f612.svg", // Cara decepcionada
  "🙄": "https://twemoji.maxcdn.com/v/latest/svg/1f644.svg", // Cara con ojos en blanco
  "😬": "https://twemoji.maxcdn.com/v/latest/svg/1f62c.svg", // Cara sonriendo con boca cerrada
  "🤥": "https://twemoji.maxcdn.com/v/latest/svg/1f925.svg", // Cara mintiendo
  "😌": "https://twemoji.maxcdn.com/v/latest/svg/1f60c.svg", // Cara aliviada
  "😔": "https://twemoji.maxcdn.com/v/latest/svg/1f614.svg", // Cara abatida
  "😪": "https://twemoji.maxcdn.com/v/latest/svg/1f62a.svg", // Cara dormida
  "🤤": "https://twemoji.maxcdn.com/v/latest/svg/1f924.svg", // Cara babeando
  "😴": "https://twemoji.maxcdn.com/v/latest/svg/1f634.svg", // Cara durmiendo
  "😷": "https://twemoji.maxcdn.com/v/latest/svg/1f637.svg", // Cara con mascarilla médica
  "🤒": "https://twemoji.maxcdn.com/v/latest/svg/1f912.svg", // Cara con termómetro
  "🤕": "https://twemoji.maxcdn.com/v/latest/svg/1f915.svg", // Cara con venda en la cabeza
  "🤢": "https://twemoji.maxcdn.com/v/latest/svg/1f922.svg", // Cara de náuseas
  "🤮": "https://twemoji.maxcdn.com/v/latest/svg/1f92e.svg", // Cara vomitando
  "🤧": "https://twemoji.maxcdn.com/v/latest/svg/1f927.svg", // Cara con pañuelo
  "🥵": "https://twemoji.maxcdn.com/v/latest/svg/1f975.svg", // Cara con calor
  "🥶": "https://twemoji.maxcdn.com/v/latest/svg/1f976.svg", // Cara con frío
  "🥴": "https://twemoji.maxcdn.com/v/latest/svg/1f974.svg", // Cara borracha
  "😵": "https://twemoji.maxcdn.com/v/latest/svg/1f635.svg", // Cara mareada
  "🤯": "https://twemoji.maxcdn.com/v/latest/svg/1f92f.svg", // Cara explotando la cabeza
  "🤠": "https://twemoji.maxcdn.com/v/latest/svg/1f920.svg", // Cara de vaquero
  "🥳": "https://twemoji.maxcdn.com/v/latest/svg/1f973.svg", // Cara de fiesta
  "😖": "https://twemoji.maxcdn.com/v/latest/svg/1f616.svg", // Cara con una ceja levantada
  "😸": "https://twemoji.maxcdn.com/v/latest/svg/1f638.svg", // Cara sonriente de gato con la boca abierta
  "🎃": "https://twemoji.maxcdn.com/v/latest/svg/1f383.svg", // Calabaza de Halloween
  "💀": "https://twemoji.maxcdn.com/v/latest/svg/1f480.svg", // Calavera
  "👻": "https://twemoji.maxcdn.com/v/latest/svg/1f47b.svg", // Fantasma
  "🌞": "https://twemoji.maxcdn.com/v/latest/svg/2600.svg", // Sol con cara
  "☃️": "https://twemoji.maxcdn.com/v/latest/svg/2603.svg", // Muñeco de nieve
  "😤": "https://twemoji.maxcdn.com/v/latest/svg/1f624.svg", // Cara con vapor por la nariz
  "💩": "https://twemoji.maxcdn.com/v/latest/svg/1f4a9.svg", // Caca
  "☕": "https://twemoji.maxcdn.com/v/latest/svg/2615.svg", // Taza de café
  "🥺": "https://twemoji.maxcdn.com/v/latest/svg/1f97a.svg", // Cara 
  "🐶": "https://twemoji.maxcdn.com/v/latest/svg/1f436.svg", // Perro
  "🐱": "https://twemoji.maxcdn.com/v/latest/svg/1f431.svg", // Gato
  "🐭": "https://twemoji.maxcdn.com/v/latest/svg/1f42d.svg", // Ratón
  "🐹": "https://twemoji.maxcdn.com/v/latest/svg/1f439.svg", // Hámster
  "🐰": "https://twemoji.maxcdn.com/v/latest/svg/1f430.svg", // Conejo
  "🦊": "https://twemoji.maxcdn.com/v/latest/svg/1f98a.svg", // Zorro
  "🐻": "https://twemoji.maxcdn.com/v/latest/svg/1f43b.svg", // Oso
  "🐼": "https://twemoji.maxcdn.com/v/latest/svg/1f43c.svg", // Panda
  "🐨": "https://twemoji.maxcdn.com/v/latest/svg/1f428.svg", // Koala
  "🐯": "https://twemoji.maxcdn.com/v/latest/svg/1f42f.svg", // Tigre
  "🦁": "https://twemoji.maxcdn.com/v/latest/svg/1f981.svg", // León
  "🐮": "https://twemoji.maxcdn.com/v/latest/svg/1f42e.svg", // Vaca
  "🐷": "https://twemoji.maxcdn.com/v/latest/svg/1f437.svg", // Cerdo
  "🐸": "https://twemoji.maxcdn.com/v/latest/svg/1f438.svg", // Rana
  "🐵": "https://twemoji.maxcdn.com/v/latest/svg/1f435.svg", // Mono
  "🐔": "https://twemoji.maxcdn.com/v/latest/svg/1f414.svg", // Gallina
  "🐧": "https://twemoji.maxcdn.com/v/latest/svg/1f427.svg", // Pingüino
  "🐦": "https://twemoji.maxcdn.com/v/latest/svg/1f426.svg", // Pájaro
  "🐤": "https://twemoji.maxcdn.com/v/latest/svg/1f424.svg", // Pollito
  "🦆": "https://twemoji.maxcdn.com/v/latest/svg/1f986.svg", // Pato
  "🦅": "https://twemoji.maxcdn.com/v/latest/svg/1f985.svg", // Águila
  "🦉": "https://twemoji.maxcdn.com/v/latest/svg/1f989.svg", // Búho
  "🦇": "https://twemoji.maxcdn.com/v/latest/svg/1f987.svg", // Murciélago
  "🐺": "https://twemoji.maxcdn.com/v/latest/svg/1f43a.svg", // Lobo
  "🐗": "https://twemoji.maxcdn.com/v/latest/svg/1f417.svg", // Jabalí
  "🐴": "https://twemoji.maxcdn.com/v/latest/svg/1f434.svg", // Caballo
  "🦄": "https://twemoji.maxcdn.com/v/latest/svg/1f984.svg", // Unicornio
  "🐝": "https://twemoji.maxcdn.com/v/latest/svg/1f41d.svg", // Abeja
  "🐛": "https://twemoji.maxcdn.com/v/latest/svg/1f41b.svg", // Oruga
  "🦋": "https://twemoji.maxcdn.com/v/latest/svg/1f98b.svg", // Mariposa
  "🐌": "https://twemoji.maxcdn.com/v/latest/svg/1f40c.svg", // Caracol
  "🐞": "https://twemoji.maxcdn.com/v/latest/svg/1f41e.svg", // Mariquita
  "🐜": "https://twemoji.maxcdn.com/v/latest/svg/1f41c.svg", // Hormiga
  "🦗": "https://twemoji.maxcdn.com/v/latest/svg/1f997.svg", // Grillo
  "🕷️": "https://twemoji.maxcdn.com/v/latest/svg/1f577.svg", // Araña
  "🦂": "https://twemoji.maxcdn.com/v/latest/svg/1f982.svg", // Escorpión
  "🦟": "https://twemoji.maxcdn.com/v/latest/svg/1f99f.svg", // Mosquito
  "🦠": "https://twemoji.maxcdn.com/v/latest/svg/1f9a0.svg", // Microbio
  "🐢": "https://twemoji.maxcdn.com/v/latest/svg/1f422.svg", // Tortuga
  "🐍": "https://twemoji.maxcdn.com/v/latest/svg/1f40d.svg", // Serpiente
  "🦎": "https://twemoji.maxcdn.com/v/latest/svg/1f98e.svg", // Lagarto
  "🦖": "https://twemoji.maxcdn.com/v/latest/svg/1f996.svg", // Dinosaurio
  "🦕": "https://twemoji.maxcdn.com/v/latest/svg/1f995.svg", // Dinosaurio
  "🐙": "https://twemoji.maxcdn.com/v/latest/svg/1f419.svg", // Pulpo
  "🦑": "https://twemoji.maxcdn.com/v/latest/svg/1f991.svg", // Calamar
  "🦐": "https://twemoji.maxcdn.com/v/latest/svg/1f990.svg", // Langostino
  "🦞": "https://twemoji.maxcdn.com/v/latest/svg/1f99e.svg", // Langosta
  "🦀": "https://twemoji.maxcdn.com/v/latest/svg/1f980.svg", // Cangrejo
  "🐡": "https://twemoji.maxcdn.com/v/latest/svg/1f421.svg", // Pez globo
  "🐠": "https://twemoji.maxcdn.com/v/latest/svg/1f420.svg", // Pez tropical
  "🐟": "https://twemoji.maxcdn.com/v/latest/svg/1f41f.svg", // Pez
  "🐬": "https://twemoji.maxcdn.com/v/latest/svg/1f42c.svg", // Delfín
  "🐳": "https://twemoji.maxcdn.com/v/latest/svg/1f433.svg", // Ballena
  "🐋": "https://twemoji.maxcdn.com/v/latest/svg/1f40b.svg", // Tiburón
  "🦈": "https://twemoji.maxcdn.com/v/latest/svg/1f988.svg", // Tiburón
  "🐊": "https://twemoji.maxcdn.com/v/latest/svg/1f40a.svg", // Cocodrilo
  "🐆": "https://twemoji.maxcdn.com/v/latest/svg/1f406.svg", // Leopardo
  "🐅": "https://twemoji.maxcdn.com/v/latest/svg/1f405.svg", // Tigre
  "🐘": "https://twemoji.maxcdn.com/v/latest/svg/1f418.svg", // Elefante
  "🦏": "https://twemoji.maxcdn.com/v/latest/svg/1f98f.svg", // Rinoceronte
  "🦍": "https://twemoji.maxcdn.com/v/latest/svg/1f98d.svg", // Gorila
  "🐪": "https://twemoji.maxcdn.com/v/latest/svg/1f42a.svg", // Camello
  "🐫": "https://twemoji.maxcdn.com/v/latest/svg/1f42b.svg", // Dromedario
  "🦒": "https://twemoji.maxcdn.com/v/latest/svg/1f992.svg", // Jirafa
  "🐃": "https://twemoji.maxcdn.com/v/latest/svg/1f403.svg", // Búfalo
  "🐂": "https://twemoji.maxcdn.com/v/latest/svg/1f402.svg", // Toro
  "🐄": "https://twemoji.maxcdn.com/v/latest/svg/1f404.svg", // Vaca
  "🐎": "https://twemoji.maxcdn.com/v/latest/svg/1f40e.svg", // Caballo
  "🐖": "https://twemoji.maxcdn.com/v/latest/svg/1f416.svg", // Cerdo
  "🐏": "https://twemoji.maxcdn.com/v/latest/svg/1f40f.svg", // Carnero
  "🐑": "https://twemoji.maxcdn.com/v/latest/svg/1f411.svg", // Oveja
  "🐐": "https://twemoji.maxcdn.com/v/latest/svg/1f410.svg", // Cabra
  "🐕": "https://twemoji.maxcdn.com/v/latest/svg/1f415.svg", // Perro
  "🐩": "https://twemoji.maxcdn.com/v/latest/svg/1f429.svg", // Caniche
  "🐈": "https://twemoji.maxcdn.com/v/latest/svg/1f408.svg", // Gato
  "🐇": "https://twemoji.maxcdn.com/v/latest/svg/1f407.svg", // Conejo
  "🐾": "https://twemoji.maxcdn.com/v/latest/svg/1f43e.svg", // Huella de pata
  "🦔": "https://twemoji.maxcdn.com/v/latest/svg/1f994.svg", // Erizo
  "🦇": "https://twemoji.maxcdn.com/v/latest/svg/1f987.svg", // Murciélago
  "🐻": "https://twemoji.maxcdn.com/v/latest/svg/1f43b.svg", // Oso
  "🐨": "https://twemoji.maxcdn.com/v/latest/svg/1f428.svg", // Koala
  "🐼": "https://twemoji.maxcdn.com/v/latest/svg/1f43c.svg", // Panda
  "🦘": "https://twemoji.maxcdn.com/v/latest/svg/1f998.svg", // Canguro
  "🦡": "https://twemoji.maxcdn.com/v/latest/svg/1f9a1.svg", // Tejón
  "🐾": "https://twemoji.maxcdn.com/v/latest/svg/1f43e.svg", // Huella de pata
  "🦃": "https://twemoji.maxcdn.com/v/latest/svg/1f983.svg", // Pavo real
  "🐔": "https://twemoji.maxcdn.com/v/latest/svg/1f414.svg", // Gallina
  "🐓": "https://twemoji.maxcdn.com/v/latest/svg/1f413.svg", // Gallo
  "🐣": "https://twemoji.maxcdn.com/v/latest/svg/1f423.svg", // Pollito
  "🐤": "https://twemoji.maxcdn.com/v/latest/svg/1f424.svg", // Pollito
  "🐥": "https://twemoji.maxcdn.com/v/latest/svg/1f425.svg", // Pollito
  "🐦": "https://twemoji.maxcdn.com/v/latest/svg/1f426.svg", // Pájaro
  "🐧": "https://twemoji.maxcdn.com/v/latest/svg/1f427.svg", // Pingüino
  "🕊️": "https://twemoji.maxcdn.com/v/latest/svg/1f54a.svg", // Paloma
  "🦅": "https://twemoji.maxcdn.com/v/latest/svg/1f985.svg", // Águila
  "🦆": "https://twemoji.maxcdn.com/v/latest/svg/1f986.svg", // Pato
  "🦉": "https://twemoji.maxcdn.com/v/latest/svg/1f989.svg", // Búho
  "🐸": "https://twemoji.maxcdn.com/v/latest/svg/1f438.svg", // Rana
  "🐊": "https://twemoji.maxcdn.com/v/latest/svg/1f40a.svg", // Cocodrilo
  "🐢": "https://twemoji.maxcdn.com/v/latest/svg/1f422.svg", // Tortuga
  "🦎": "https://twemoji.maxcdn.com/v/latest/svg/1f98e.svg", // Lagarto
  "🦖": "https://twemoji.maxcdn.com/v/latest/svg/1f996.svg", // Dinosaurio
  "🦕": "https://twemoji.maxcdn.com/v/latest/svg/1f995.svg", // Dinosaurio
  "🐙": "https://twemoji.maxcdn.com/v/latest/svg/1f419.svg", // Pulpo
  "🦑": "https://twemoji.maxcdn.com/v/latest/svg/1f991.svg", // Calamar
  "🦐": "https://twemoji.maxcdn.com/v/latest/svg/1f990.svg", // Langostino
  "🦞": "https://twemoji.maxcdn.com/v/latest/svg/1f99e.svg", // Langosta
  "🦀": "https://twemoji.maxcdn.com/v/latest/svg/1f980.svg", // Cangrejo
  "🐡": "https://twemoji.maxcdn.com/v/latest/svg/1f421.svg", // Pez globo
  "🐠": "https://twemoji.maxcdn.com/v/latest/svg/1f420.svg", // Pez tropical
  "🐟": "https://twemoji.maxcdn.com/v/latest/svg/1f41f.svg", // Pez
  "🐬": "https://twemoji.maxcdn.com/v/latest/svg/1f42c.svg", // Delfín
  "🐳": "https://twemoji.maxcdn.com/v/latest/svg/1f433.svg", // Ballena
  "🪳": "https://twemoji.maxcdn.com/v/latest/svg/1f98b.svg", // Termita
  "🕷️": "https://twemoji.maxcdn.com/v/latest/svg/1f577.svg", // Araña
  "💐": "https://twemoji.maxcdn.com/v/latest/svg/1f490.svg", // Ramo de flores
  "🌸": "https://twemoji.maxcdn.com/v/latest/svg/1f338.svg", // Flor de cerezo
  "💮": "https://twemoji.maxcdn.com/v/latest/svg/1f4ae.svg", // Flor blanca japonesa
  "🏵️": "https://twemoji.maxcdn.com/v/latest/svg/1f3f5.svg", // Roseta
  "🌹": "https://twemoji.maxcdn.com/v/latest/svg/1f339.svg", // Rosa
  "🥀": "https://twemoji.maxcdn.com/v/latest/svg/1f940.svg", // Rosa marchita
  "🌺": "https://twemoji.maxcdn.com/v/latest/svg/1f33a.svg", // Hibisco
  "🌻": "https://twemoji.maxcdn.com/v/latest/svg/1f33b.svg", // Girasol
  "🌼": "https://twemoji.maxcdn.com/v/latest/svg/1f33c.svg", // Flor
  "🌷": "https://twemoji.maxcdn.com/v/latest/svg/1f337.svg", // Tulipán
  "🌱": "https://twemoji.maxcdn.com/v/latest/svg/1f331.svg", // Brote verde
  "🌲": "https://twemoji.maxcdn.com/v/latest/svg/1f332.svg", // Árbol de pino
  "🌳": "https://twemoji.maxcdn.com/v/latest/svg/1f333.svg", // Árbol
  "🌴": "https://twemoji.maxcdn.com/v/latest/svg/1f334.svg", // Palmera
  "🌵": "https://twemoji.maxcdn.com/v/latest/svg/1f335.svg", // Cactus
  "🌾": "https://twemoji.maxcdn.com/v/latest/svg/1f33e.svg", // Arroz maduro
  "🌿": "https://twemoji.maxcdn.com/v/latest/svg/1f33f.svg", // Hierba
  "☘️": "https://twemoji.maxcdn.com/v/latest/svg/2618.svg", // Trébol de cuatro hojas
  "🍀": "https://twemoji.maxcdn.com/v/latest/svg/1f340.svg", // Trébol de cuatro hojas
  "🍁": "https://twemoji.maxcdn.com/v/latest/svg/1f341.svg", // Hoja de arce
  "🍂": "https://twemoji.maxcdn.com/v/latest/svg/1f342.svg", // Hoja que cae
  "🍃": "https://twemoji.maxcdn.com/v/latest/svg/1f343.svg", // Hojas movidas por el viento
  "🎋": "https://twemoji.maxcdn.com/v/latest/svg/1f38b.svg", // Kadomatsu
  "🎍": "https://twemoji.maxcdn.com/v/latest/svg/1f38d.svg", // Pino decorativo
  "🚗": "https://twemoji.maxcdn.com/v/latest/svg/1f697.svg", // Coche
  "🚕": "https://twemoji.maxcdn.com/v/latest/svg/1f695.svg", // Taxi
  "🚙": "https://twemoji.maxcdn.com/v/latest/svg/1f699.svg", // Coche todoterreno
  "🚌": "https://twemoji.maxcdn.com/v/latest/svg/1f68c.svg", // Autobús
  "🚎": "https://twemoji.maxcdn.com/v/latest/svg/1f68e.svg", // Trolebús
  "🏎️": "https://twemoji.maxcdn.com/v/latest/svg/1f3ce.svg", // Coche de carreras
  "🚓": "https://twemoji.maxcdn.com/v/latest/svg/1f693.svg", // Coche de policía
  "🚑": "https://twemoji.maxcdn.com/v/latest/svg/1f691.svg", // Ambulancia
  "🚒": "https://twemoji.maxcdn.com/v/latest/svg/1f692.svg", // Coche de bomberos
  "🚐": "https://twemoji.maxcdn.com/v/latest/svg/1f690.svg", // Furgoneta
  "🚚": "https://twemoji.maxcdn.com/v/latest/svg/1f69a.svg", // Camión
  "🚛": "https://twemoji.maxcdn.com/v/latest/svg/1f69b.svg", // Camión articulado
  "🚜": "https://twemoji.maxcdn.com/v/latest/svg/1f69c.svg", // Tractor
  "🦽": "https://twemoji.maxcdn.com/v/latest/svg/1f9bd.svg", // Silla de ruedas manual
  "🦼": "https://twemoji.maxcdn.com/v/latest/svg/1f9bc.svg", // Silla de ruedas motorizada
  "🛴": "https://twemoji.maxcdn.com/v/latest/svg/1f6f4.svg", // Patinete
  "🚲": "https://twemoji.maxcdn.com/v/latest/svg/1f6b2.svg", // Bicicleta
  "🛵": "https://twemoji.maxcdn.com/v/latest/svg/1f6f5.svg", // Moto
  "🏍️": "https://twemoji.maxcdn.com/v/latest/svg/1f3cd.svg", // Moto de carreras
  "🛺": "https://twemoji.maxcdn.com/v/latest/svg/1f6fa.svg", // Tuk-tuk
  "🚨": "https://twemoji.maxcdn.com/v/latest/svg/1f6a8.svg", // Luz de emergencia
  "🚔": "https://twemoji.maxcdn.com/v/latest/svg/1f694.svg", // Coche de policía en servicio
  "🚍": "https://twemoji.maxcdn.com/v/latest/svg/1f68d.svg", // Autobús de servicio
  "🚘": "https://twemoji.maxcdn.com/v/latest/svg/1f698.svg", // Coche en servicio
  "🚖": "https://twemoji.maxcdn.com/v/latest/svg/1f696.svg", // Taxi en servicio
  "🚡": "https://twemoji.maxcdn.com/v/latest/svg/1f6a1.svg", // Teleférico
  "🚠": "https://twemoji.maxcdn.com/v/latest/svg/1f6a0.svg", // Funicular
  "🚟": "https://twemoji.maxcdn.com/v/latest/svg/1f69f.svg", // Tranvía
  "🚃": "https://twemoji.maxcdn.com/v/latest/svg/1f683.svg", // Tranvía de tren ligero
  "🚋": "https://twemoji.maxcdn.com/v/latest/svg/1f68b.svg", // Tranvía de tren
  "🚞": "https://twemoji.maxcdn.com/v/latest/svg/1f69e.svg", // Tren de montaña
  "🚝": "https://twemoji.maxcdn.com/v/latest/svg/1f69d.svg", // Monorraíl
  "🚄": "https://twemoji.maxcdn.com/v/latest/svg/1f684.svg", // Tren de alta velocidad
  "🚅": "https://twemoji.maxcdn.com/v/latest/svg/1f685.svg", // Tren bala
  "🚈": "https://twemoji.maxcdn.com/v/latest/svg/1f688.svg", // Tren ligero
  "🚂": "https://twemoji.maxcdn.com/v/latest/svg/1f682.svg", // Locomotora de vapor
  "🚆": "https://twemoji.maxcdn.com/v/latest/svg/1f686.svg", // Tren de pasajeros
  "🚇": "https://twemoji.maxcdn.com/v/latest/svg/1f687.svg", // Metro
  "🚊": "https://twemoji.maxcdn.com/v/latest/svg/1f68a.svg", // Tranvía
  "🚉": "https://twemoji.maxcdn.com/v/latest/svg/1f689.svg", // Estación de tren
  "🚁": "https://twemoji.maxcdn.com/v/latest/svg/1f681.svg", // Helicóptero
  "🛩️": "https://twemoji.maxcdn.com/v/latest/svg/1f6e9.svg", // Avioneta
  "✈️": "https://twemoji.maxcdn.com/v/latest/svg/2708.svg", // Avión
  "🛫": "https://twemoji.maxcdn.com/v/latest/svg/1f6eb.svg", // Avión despegando
  "🛬": "https://twemoji.maxcdn.com/v/latest/svg/1f6ec.svg", // Avión aterrizando
  "🪂": "https://twemoji.maxcdn.com/v/latest/svg/1fa82.svg", // Paracaídas
  "💺": "https://twemoji.maxcdn.com/v/latest/svg/1f4ba.svg", // Asiento de avión
  "🍇": "https://twemoji.maxcdn.com/v/latest/svg/1f347.svg", // Uvas
  "🍈": "https://twemoji.maxcdn.com/v/latest/svg/1f348.svg", // Melón
  "🍉": "https://twemoji.maxcdn.com/v/latest/svg/1f349.svg", // Sandía
  "🍊": "https://twemoji.maxcdn.com/v/latest/svg/1f34a.svg", // Mandarina
  "🍋": "https://twemoji.maxcdn.com/v/latest/svg/1f34b.svg", // Limón
  "🍌": "https://twemoji.maxcdn.com/v/latest/svg/1f34c.svg", // Plátano
  "🍍": "https://twemoji.maxcdn.com/v/latest/svg/1f34d.svg", // Piña
  "🥭": "https://twemoji.maxcdn.com/v/latest/svg/1f96d.svg", // Mango
  "🍎": "https://twemoji.maxcdn.com/v/latest/svg/1f34e.svg", // Manzana roja
  "🍏": "https://twemoji.maxcdn.com/v/latest/svg/1f34f.svg", // Manzana verde
  "🍐": "https://twemoji.maxcdn.com/v/latest/svg/1f350.svg", // Pera
  "🍑": "https://twemoji.maxcdn.com/v/latest/svg/1f351.svg", // Durazno
  "🍒": "https://twemoji.maxcdn.com/v/latest/svg/1f352.svg", // Cereza
  "🍓": "https://twemoji.maxcdn.com/v/latest/svg/1f353.svg", // Fresa
  "🫐": "https://twemoji.maxcdn.com/v/latest/svg/1fac0.svg", // Arándano
  "🥝": "https://twemoji.maxcdn.com/v/latest/svg/1f95d.svg", // Kiwi
  "🍅": "https://twemoji.maxcdn.com/v/latest/svg/1f345.svg", // Tomate
  "🫒": "https://twemoji.maxcdn.com/v/latest/svg/1fac2.svg", // Aceituna
  "🥥": "https://twemoji.maxcdn.com/v/latest/svg/1f965.svg", // Coco
  "🥑": "https://twemoji.maxcdn.com/v/latest/svg/1f951.svg", // Aguacate
  "🍆": "https://twemoji.maxcdn.com/v/latest/svg/1f346.svg", // Berenjena
  "🥔": "https://twemoji.maxcdn.com/v/latest/svg/1f954.svg", // Papa
  "🥕": "https://twemoji.maxcdn.com/v/latest/svg/1f955.svg", // Zanahoria
  "🌽": "https://twemoji.maxcdn.com/v/latest/svg/1f33d.svg", // Mazorca de maíz
  "🌶️": "https://twemoji.maxcdn.com/v/latest/svg/1f336.svg", // Chile
  "🫑": "https://twemoji.maxcdn.com/v/latest/svg/1fab1.svg", // Pimiento
  "🥒": "https://twemoji.maxcdn.com/v/latest/svg/1f952.svg", // Pepino
  "🥬": "https://twemoji.maxcdn.com/v/latest/svg/1f96c.svg", // Lechuga
  "🥦": "https://twemoji.maxcdn.com/v/latest/svg/1f966.svg", // Brócoli
  "🧄": "https://twemoji.maxcdn.com/v/latest/svg/1f9c4.svg", // Ajo
  "🧅": "https://twemoji.maxcdn.com/v/latest/svg/1f9c5.svg", // Cebolla
  "🍄": "https://twemoji.maxcdn.com/v/latest/svg/1f344.svg", // Hongos
  "🥜": "https://twemoji.maxcdn.com/v/latest/svg/1f95c.svg", // Maní
  "🌰": "https://twemoji.maxcdn.com/v/latest/svg/1f330.svg", // Castaña
  "🍞": "https://twemoji.maxcdn.com/v/latest/svg/1f35e.svg", // Pan
  "🥐": "https://twemoji.maxcdn.com/v/latest/svg/1f950.svg", // Croissant
  "🥖": "https://twemoji.maxcdn.com/v/latest/svg/1f956.svg", // Baguette
  "🫓": "https://twemoji.maxcdn.com/v/latest/svg/1fab3.svg", // Pan de focaccia
  "🥨": "https://twemoji.maxcdn.com/v/latest/svg/1f968.svg", // Pretzel
  "🥯": "https://twemoji.maxcdn.com/v/latest/svg/1f96f.svg", // Bagel
  "🥞": "https://twemoji.maxcdn.com/v/latest/svg/1f95e.svg", // Hotcake
  "🧇": "https://twemoji.maxcdn.com/v/latest/svg/1f9c7.svg", // Waffle
  "🧀": "https://twemoji.maxcdn.com/v/latest/svg/1f9c0.svg", // Queso
  "🍖": "https://twemoji.maxcdn.com/v/latest/svg/1f356.svg", // Costilla de carne
  "🍗": "https://twemoji.maxcdn.com/v/latest/svg/1f357.svg", // Pollo
  "🥩": "https://twemoji.maxcdn.com/v/latest/svg/1f969.svg", // Filete de carne
  "🥓": "https://twemoji.maxcdn.com/v/latest/svg/1f953.svg", // Tocino
  "🍔": "https://twemoji.maxcdn.com/v/latest/svg/1f354.svg", // Hamburguesa
  "🍟": "https://twemoji.maxcdn.com/v/latest/svg/1f35f.svg", // Papas fritas
  "🍕": "https://twemoji.maxcdn.com/v/latest/svg/1f355.svg", // Pizza
  "🌭": "https://twemoji.maxcdn.com/v/latest/svg/1f32d.svg", // Perrito caliente
  "🥪": "https://twemoji.maxcdn.com/v/latest/svg/1f96a.svg", // Sándwich
  "🌮": "https://twemoji.maxcdn.com/v/latest/svg/1f32e.svg", // Tacos
  "🌯": "https://twemoji.maxcdn.com/v/latest/svg/1f32f.svg", // Burrito
  "🫔": "https://twemoji.maxcdn.com/v/latest/svg/1fab4.svg", // Tamal
  "🥙": "https://twemoji.maxcdn.com/v/latest/svg/1f959.svg", // Gyro
  "🧆": "https://twemoji.maxcdn.com/v/latest/svg/1f9c6.svg", // Empanada
  "🥚": "https://twemoji.maxcdn.com/v/latest/svg/1f95a.svg", // Huevo
  "🍳": "https://twemoji.maxcdn.com/v/latest/svg/1f373.svg", // Huevo frito
  "🥘": "https://twemoji.maxcdn.com/v/latest/svg/1f958.svg", // Paella
  "🍲": "https://twemoji.maxcdn.com/v/latest/svg/1f372.svg", // Guiso
  "🫕": "https://twemoji.maxcdn.com/v/latest/svg/1fac5.svg", // Fondue
  "🍿": "https://twemoji.maxcdn.com/v/latest/svg/1f37f.svg", // Palomitas de maíz
  "🧂": "https://twemoji.maxcdn.com/v/latest/svg/1f9c2.svg", // Sal
  "🥫": "https://twemoji.maxcdn.com/v/latest/svg/1f96b.svg", // Comida enlatada
  "🍱": "https://twemoji.maxcdn.com/v/latest/svg/1f371.svg", // Bento
  "🍘": "https://twemoji.maxcdn.com/v/latest/svg/1f358.svg", // Arroz crujiente
  "🍙": "https://twemoji.maxcdn.com/v/latest/svg/1f359.svg", // Onigiri
  "🍚": "https://twemoji.maxcdn.com/v/latest/svg/1f35a.svg", // Arroz cocido
  "🍛": "https://twemoji.maxcdn.com/v/latest/svg/1f35b.svg", // Curry
  "🍜": "https://twemoji.maxcdn.com/v/latest/svg/1f35c.svg", // Fideos
  "🍝": "https://twemoji.maxcdn.com/v/latest/svg/1f35d.svg", // Espaguetis
  "🍠": "https://twemoji.maxcdn.com/v/latest/svg/1f360.svg", // Batata
  "🍢": "https://twemoji.maxcdn.com/v/latest/svg/1f362.svg", // Dango
  "🍣": "https://twemoji.maxcdn.com/v/latest/svg/1f363.svg", // Sushi
  "🍤": "https://twemoji.maxcdn.com/v/latest/svg/1f364.svg", // Camarón frito
  "🍥": "https://twemoji.maxcdn.com/v/latest/svg/1f365.svg", // Narutomaki
  "🥮": "https://twemoji.maxcdn.com/v/latest/svg/1f96e.svg", // Pastel de luna
  "🍡": "https://twemoji.maxcdn.com/v/latest/svg/1f361.svg", // Oden
  "🥟": "https://twemoji.maxcdn.com/v/latest/svg/1f95f.svg", // Dumpling
  "🥠": "https://twemoji.maxcdn.com/v/latest/svg/1f960.svg", // Galleta de la fortuna
  "🥡": "https://twemoji.maxcdn.com/v/latest/svg/1f961.svg", // Caja de comida para llevar
  "🦪": "https://twemoji.maxcdn.com/v/latest/svg/1f9aa.svg", // Ostra
  "🍦": "https://twemoji.maxcdn.com/v/latest/svg/1f366.svg", // Helado
  "🍧": "https://twemoji.maxcdn.com/v/latest/svg/1f367.svg", // Raspado
  "🍨": "https://twemoji.maxcdn.com/v/latest/svg/1f368.svg", // Helado de bola
  "🍩": "https://twemoji.maxcdn.com/v/latest/svg/1f369.svg", // Dona
  "🍪": "https://twemoji.maxcdn.com/v/latest/svg/1f36a.svg", // Galleta
  "🎂": "https://twemoji.maxcdn.com/v/latest/svg/1f382.svg", // Pastel de cumpleaños
  "🍰": "https://twemoji.maxcdn.com/v/latest/svg/1f370.svg", // Pastel
  "🧁": "https://twemoji.maxcdn.com/v/latest/svg/1f9c1.svg", // Cupcake
  "🥧": "https://twemoji.maxcdn.com/v/latest/svg/1f967.svg", // Pay
  "🍫": "https://twemoji.maxcdn.com/v/latest/svg/1f36b.svg", // Chocolate
  "🍬": "https://twemoji.maxcdn.com/v/latest/svg/1f36c.svg", // Caramelo
  "🍭": "https://twemoji.maxcdn.com/v/latest/svg/1f36d.svg", // Paleta
  "🍮": "https://twemoji.maxcdn.com/v/latest/svg/1f36e.svg", // Flan
  "🍯": "https://twemoji.maxcdn.com/v/latest/svg/1f36f.svg", // Miel
  "🍼": "https://twemoji.maxcdn.com/v/latest/svg/1f37c.svg", // Biberón
  "🥛": "https://twemoji.maxcdn.com/v/latest/svg/1f95b.svg", // Vaso de leche
  "☕": "https://twemoji.maxcdn.com/v/latest/svg/2615.svg", // Taza de café
  "🫖": "https://twemoji.maxcdn.com/v/latest/svg/1fad6.svg", // Tetera
  "🍵": "https://twemoji.maxcdn.com/v/latest/svg/1f375.svg", // Taza de té
  "🍶": "https://twemoji.maxcdn.com/v/latest/svg/1f376.svg", // Sake
  "🍾": "https://twemoji.maxcdn.com/v/latest/svg/1f37e.svg", // Botella con corcho
  "🍷": "https://twemoji.maxcdn.com/v/latest/svg/1f377.svg", // Copa de vino
  "🍸": "https://twemoji.maxcdn.com/v/latest/svg/1f378.svg", // Coctel
  "🍹": "https://twemoji.maxcdn.com/v/latest/svg/1f379.svg", // Bebida tropical
  "🍺": "https://twemoji.maxcdn.com/v/latest/svg/1f37a.svg", // Cerveza
  "🍻": "https://twemoji.maxcdn.com/v/latest/svg/1f37b.svg", // Vasos brindando
  "🥂": "https://twemoji.maxcdn.com/v/latest/svg/1f942.svg", // Copas brindando
  "🥃": "https://twemoji.maxcdn.com/v/latest/svg/1f943.svg", // Vaso de whisky
  "❤️": "https://twemoji.maxcdn.com/v/latest/svg/2764.svg", // Corazón rojo
  "🧡": "https://twemoji.maxcdn.com/v/latest/svg/1f9e1.svg", // Corazón naranja
  "💛": "https://twemoji.maxcdn.com/v/latest/svg/1f49b.svg", // Corazón amarillo
  "💚": "https://twemoji.maxcdn.com/v/latest/svg/1f49a.svg", // Corazón verde
  "💙": "https://twemoji.maxcdn.com/v/latest/svg/1f499.svg", // Corazón azul
  "💜": "https://twemoji.maxcdn.com/v/latest/svg/1f49c.svg", // Corazón morado
  "🖤": "https://twemoji.maxcdn.com/v/latest/svg/1f5a4.svg", // Corazón negro
  "🤍": "https://twemoji.maxcdn.com/v/latest/svg/1f90d.svg", // Corazón blanco
  "💔": "https://twemoji.maxcdn.com/v/latest/svg/1f494.svg", // Corazón roto
  "❣️": "https://twemoji.maxcdn.com/v/latest/svg/2763.svg", // Corazón de exclamation
  "💕": "https://twemoji.maxcdn.com/v/latest/svg/1f495.svg", // Corazones girando
  "💞": "https://twemoji.maxcdn.com/v/latest/svg/1f49e.svg", // Dos corazones
  "💓": "https://twemoji.maxcdn.com/v/latest/svg/1f493.svg", // Corazón latiendo
  "💗": "https://twemoji.maxcdn.com/v/latest/svg/1f497.svg", // Corazones crecientes
  "💖": "https://twemoji.maxcdn.com/v/latest/svg/1f496.svg", // Corazón brillante
  "💘": "https://twemoji.maxcdn.com/v/latest/svg/1f498.svg", // Corazón con flecha
  "🛑": "https://twemoji.maxcdn.com/v/latest/svg/1f6d1.svg", // Alto con mano
  "💡": "https://twemoji.maxcdn.com/v/latest/svg/1f4a1.svg", // Bombilla
  "💼": "https://twemoji.maxcdn.com/v/latest/svg/1f4bc.svg", // Maletín
  "🛎️": "https://twemoji.maxcdn.com/v/latest/svg/1f6ce.svg", // Timbre
  "📝": "https://twemoji.maxcdn.com/v/latest/svg/1f4dd.svg", // Nota escrita
  "📌": "https://twemoji.maxcdn.com/v/latest/svg/1f4cc.svg", // Chincheta
  "📍": "https://twemoji.maxcdn.com/v/latest/svg/1f4cd.svg", // Punto de ubicación
  "📋": "https://twemoji.maxcdn.com/v/latest/svg/1f4cb.svg", // Portapapeles
  "🖇️": "https://twemoji.maxcdn.com/v/latest/svg/1f587.svg", // Clips
  "📎": "https://twemoji.maxcdn.com/v/latest/svg/1f4ce.svg", // Clip
  "📂": "https://twemoji.maxcdn.com/v/latest/svg/1f4c2.svg", // Carpeta
  "📁": "https://twemoji.maxcdn.com/v/latest/svg/1f4c1.svg", // Carpeta abierta
  "🗂️": "https://twemoji.maxcdn.com/v/latest/svg/1f5c2.svg", // Archivador de carpetas
  "📰": "https://twemoji.maxcdn.com/v/latest/svg/1f4f0.svg", // Periódico
  "🔖": "https://twemoji.maxcdn.com/v/latest/svg/1f516.svg", // Etiqueta
  "📚": "https://twemoji.maxcdn.com/v/latest/svg/1f4da.svg", // Libros
  "📖": "https://twemoji.maxcdn.com/v/latest/svg/1f4d6.svg", // Libro abierto
  "🔍": "https://twemoji.maxcdn.com/v/latest/svg/1f50d.svg", // Lupa a la izquierda
  "🔎": "https://twemoji.maxcdn.com/v/latest/svg/1f50e.svg", // Lupa a la derecha
  "🔒": "https://twemoji.maxcdn.com/v/latest/svg/1f512.svg", // Cerrado con llave
  "🔓": "https://twemoji.maxcdn.com/v/latest/svg/1f513.svg", // Abierto con llave
  "🔑": "https://twemoji.maxcdn.com/v/latest/svg/1f511.svg", // Llave
  "🔨": "https://twemoji.maxcdn.com/v/latest/svg/1f528.svg", // Martillo
  "🧰": "https://twemoji.maxcdn.com/v/latest/svg/1f9f0.svg", // Caja de herramientas
  "🔧": "https://twemoji.maxcdn.com/v/latest/svg/1f527.svg", // Llave inglesa
  "🔩": "https://twemoji.maxcdn.com/v/latest/svg/1f529.svg", // Tuerca y tornillo
  "🛠️": "https://twemoji.maxcdn.com/v/latest/svg/1f6e0.svg", // Herramientas
  "⚙️": "https://twemoji.maxcdn.com/v/latest/svg/2699.svg", // Engranajes
  "🧲": "https://twemoji.maxcdn.com/v/latest/svg/1f9f2.svg", // Imán
  "⚖️": "https://twemoji.maxcdn.com/v/latest/svg/2696.svg", // Balanza
  "🔗": "https://twemoji.maxcdn.com/v/latest/svg/1f517.svg", // Eslabón de cadena
  "⛓️": "https://twemoji.maxcdn.com/v/latest/svg/26d3.svg", // Cadena
  "🧷": "https://twemoji.maxcdn.com/v/latest/svg/1f9f7.svg", // Sujetador de seguridad
  "🧿": "https://twemoji.maxcdn.com/v/latest/svg/1f9ff.svg", // Ojo nazar
  "🔮": "https://twemoji.maxcdn.com/v/latest/svg/1f52e.svg", // Bola de cristal
  "🧪": "https://twemoji.maxcdn.com/v/latest/svg/1f9ea.svg", // Matraz de prueba
  "🧫": "https://twemoji.maxcdn.com/v/latest/svg/1f9eb.svg", // Microbio
  "🧬": "https://twemoji.maxcdn.com/v/latest/svg/1f9ec.svg", // Doble hélice de ADN
  "🧯": "https://twemoji.maxcdn.com/v/latest/svg/1f9ef.svg", // Extintor
  "🧴": "https://twemoji.maxcdn.com/v/latest/svg/1f9f4.svg", // Botella con bomba de loción
   "🇲🇽": "https://twemoji.maxcdn.com/v/latest/svg/1f1f2-1f1fd.svg", // Bandera de México
  "🇬🇧": "https://twemoji.maxcdn.com/v/latest/svg/1f1ec-1f1e7.svg", // Bandera del Reino Unido
  "🇺🇸": "https://twemoji.maxcdn.com/v/latest/svg/1f1fa-1f1f8.svg", // Bandera de Estados Unidos
  "🇦🇷": "https://twemoji.maxcdn.com/v/latest/svg/1f1e6-1f1f7.svg", // Bandera de Argentina
  "🇨🇦": "https://twemoji.maxcdn.com/v/latest/svg/1f1e8-1f1e6.svg", // Bandera de Canadá
  "🇫🇷": "https://twemoji.maxcdn.com/v/latest/svg/1f1eb-1f1f7.svg", // Bandera de Francia
  "🇩🇪": "https://twemoji.maxcdn.com/v/latest/svg/1f1e9-1f1ea.svg", // Bandera de Alemania
  // Otras banderas...
  "🇪🇸": "https://twemoji.maxcdn.com/v/latest/svg/1f1ea-1f1f8.svg", // Bandera de España
  "🇮🇹": "https://twemoji.maxcdn.com/v/latest/svg/1f1ee-1f1f9.svg", // Bandera de Italia
  "🇳🇱": "https://twemoji.maxcdn.com/v/latest/svg/1f1f3-1f1f1.svg", // Bandera de los Países Bajos
  "🇧🇷": "https://twemoji.maxcdn.com/v/latest/svg/1f1e7-1f1f7.svg", // Bandera de Brasil
  "🇯🇵": "https://twemoji.maxcdn.com/v/latest/svg/1f1ef-1f1f5.svg", // Bandera de Japón
  "🇨🇳": "https://twemoji.maxcdn.com/v/latest/svg/1f1e8-1f1f3.svg", // Bandera de China
  "🇷🇺": "https://twemoji.maxcdn.com/v/latest/svg/1f1f7-1f1fa.svg", // Bandera de Rusia
  "🇦🇺": "https://twemoji.maxcdn.com/v/latest/svg/1f1e6-1f1fa.svg", // Bandera de Australia
  "🇿🇦": "https://twemoji.maxcdn.com/v/latest/svg/1f1ff-1f1e6.svg", // Bandera de Sudáfrica
  "🇮🇳": "https://twemoji.maxcdn.com/v/latest/svg/1f1ee-1f1f3.svg", // Bandera de India
  "🇰🇷": "https://twemoji.maxcdn.com/v/latest/svg/1f1f0-1f1f7.svg", // Bandera de Corea del Sur
  "🇸🇦": "https://twemoji.maxcdn.com/v/latest/svg/1f1f8-1f1e6.svg", // Bandera de Arabia Saudita
  "🇹🇷": "https://twemoji.maxcdn.com/v/latest/svg/1f1f9-1f1f7.svg", // Bandera de Turquía
  "🇪🇬": "https://twemoji.maxcdn.com/v/latest/svg/1f1ea-1f1ec.svg", // Bandera de Egipto
  "🇬🇷": "https://twemoji.maxcdn.com/v/latest/svg/1f1ec-1f1f7.svg", // Bandera de Grecia
  "🇳🇴": "https://twemoji.maxcdn.com/v/latest/svg/1f1f3-1f1f4.svg", // Bandera de Noruega
  "🇸🇪": "https://twemoji.maxcdn.com/v/latest/svg/1f1f8-1f1ea.svg", // Bandera de Suecia
  "🇫🇮": "https://twemoji.maxcdn.com/v/latest/svg/1f1eb-1f1ee.svg", // Bandera de Finlandia
  "🇩🇰": "https://twemoji.maxcdn.com/v/latest/svg/1f1e9-1f1f0.svg", // Bandera de Dinamarca
  "🇧🇪": "https://twemoji.maxcdn.com/v/latest/svg/1f1e7-1f1ea.svg", // Bandera de Bélgica
  
    // Agrega más emojis y URLs aquí...
  };

  function replaceEmojisWithImages(text) {
      return text.replace(/([\uD800-\uDBFF][\uDC00-\uDFFF])|(#\w+)/g, (match) => {
        const emojiURL = emojiMap[match];
        if (emojiURL) {
          if (match.startsWith("#")) {
            return `<img src="${emojiURL}" alt="${match}" class="pat emoji" style="margin-right:3px; margin-left:3px; margin-top: -2px; height:16px; width:16px;">`;
          } else {
            return `<img src="${emojiURL}" alt="${match}" class="pat emoji" style="margin-right:3px; margin-left:3px; margin-top: -2px; height:16px; width:16px;">`;
          }
        } else {
          return match;
        }
      });
    }

    function replaceEmojisInDocument() {
      const textNodes = document.createTreeWalker(
        document.body,
        NodeFilter.SHOW_TEXT,
        null,
        false
      );

      let node;
      while ((node = textNodes.nextNode())) {
        const originalText = node.nodeValue;
        const newText = replaceEmojisWithImages(originalText);
        if (newText !== originalText) {
          const wrapper = document.createElement("div");
          wrapper.innerHTML = newText;
          const newNodes = wrapper.childNodes;
          while (newNodes.length > 0) {
            node.parentNode.insertBefore(newNodes[0], node);
          }
          node.parentNode.removeChild(node);
        }
      }
    }

    document.addEventListener("DOMContentLoaded", replaceEmojisInDocument);

    const observer = new MutationObserver(replaceEmojisInDocument);
    observer.observe(document.body, { subtree: true, childList: true });
  </script>
                        <audio id="audioPlayer" src="<?php echo $usuario['music']; ?>"></audio>
                        <span style=" display:; right: 0; float: right; padding: 10px 7px 9px 7px; position:relative; margin-right:3px; margin-top:-109px; font-size: 10px; margin-left: 15%; border-radius: 30px; border: none; font-weight: 500; background-color: rgb(239 239 239 / 54%);">
                        <?php
                        // Verificar si la variable $usuario['music'] está definida y no está vacía
    if (isset($usuario['music']) && !empty($usuario['music'])) {
        // La variable $usuario['music'] tiene un valor
        echo '<a style="color:black;" href="play.php"><img src="'.$usuario["postd"].'" style="border-radius:100px; margin-top:-2px; width:25px; height:25px;"></a> '.$usuario["gen"].' <button id="playPauseButton" style="border-radius:100px; background-color:transparent; display:none; border:solid 0px;" onclick="togglePlayPause()">
        <svg width="22" height="22" viewBox="0 0 48 48">
            <path d="M6 6h36v36H6z" fill="none"/>
            <path id="playIcon" d="M16 10v28l22-14z"/>
            <path id="pauseIcon" d="M18 14h4v16h-4zm8 0h4v16h-4z"/>
        </svg>
    </button>';
    } else {
        // La variable $usuario['music'] está vacía o no definida
        echo '<a style="color:black;" href="play.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
  <path d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
</svg> postmusic</a>';
    }
?>
                        

    <script>
        const audioPlayer = document.getElementById("audioPlayer");
        const playPauseButton = document.getElementById("playPauseButton");
        const playIcon = document.getElementById("playIcon");
        const pauseIcon = document.getElementById("pauseIcon");

        function togglePlayPause() {
            if (audioPlayer.paused) {
                audioPlayer.play();
                playIcon.style.display = "none";
                pauseIcon.style.display = "block";
            } else {
                audioPlayer.pause();
                playIcon.style.display = "block";
                pauseIcon.style.display = "none";
            }
        }

        // Actualizar el ícono cuando la reproducción se detiene al final del audio
        audioPlayer.addEventListener("ended", function() {
            playIcon.style.display = "block";
            pauseIcon.style.display = "none";
        });
    </script></span>
    
    </center>
                            <p style="margin:13px;" class="name">
                            <b style="font-size:22px; font-family:Nunito;"><?php echo $usuario['nombre_completo']; ?>  <?php
if ($d == "Yust" || $d == "vanne" || $d == "GustavoAMC") {
    echo '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="rgb(26 155 239)" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
  <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
</svg>';
} else {
    echo '';
}
?></b>
                            </p>
                            <vanne>
                            <p style="text-align:left; justify-content: center; margin:13px;" class="name">
                            <?php echo $usuario['correo']; ?>
                                
                            </p></vanne>
                            <div style="margin-left:3px; margin-bottom:5px;">
                            
     <a href="flow.php"><button style="padding: 5px 9px; font-size: 15px; margin-left: 0px; border-radius: 10px; border: none; font-weight: 500; background-color: transparent" class="">
                                    <?php

switch ($usuario['ideoma']) {
    case 'Español':
        echo "Seguidos";
        break;
    case 'Deutsch':
        echo "gefolgt";
        break;
    case '日本語':
        echo "フォローしました";
        break;
    case 'Русский':
        echo "Последователи";
        break;
    case 'English':
        echo "followed";
        break;
    default:
        echo "Seguidos";
        break;
}

?> (
<?php
// Ruta al archivo JSON
$archivo_json = "flow.json";

// Valor de $nombre a buscar
$nombre = $d; // Asegúrate de definir el valor correcto aquí

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
            // Verificar si el valor de "nombre" contiene $nombre
            if (strpos($dato->texto, $nombre) !== false) {
                $contador_yust++;
            }
        }

        // Mostrar el resultado
        echo "$contador_yust";
    } else {
        echo "0";
    }
} else {
    echo "0";
}
?>
)
                                </button></a>
                                <a href="flowers.php"><button style="padding: 5px 9px; font-size: 15px; margin-left: 0px; border-radius: 10px; border: none; font-weight: 500; background-color: transparent;" class="">
                                     <?php

switch ($usuario['ideoma']) {
    case 'Español':
        echo "Seguidores";
        break;
    case 'Deutsch':
        echo "Anhänger";
        break;
    case '日本語':
        echo "フォロワー";
        break;
    case 'Русский':
        echo "Последователи";
        break;
    case 'English':
        echo "Followers";
        break;
    default:
        echo "Seguidores";
        break;
}

?> (<?php
// Ruta al archivo JSON
$archivo_json = "flow.json";

// Valor de $nombre a buscar
$nombre = $d; // Asegúrate de definir el valor correcto aquí

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
            // Verificar si el valor de "nombre" contiene $nombre
            if (strpos($dato->nombre, $nombre) !== false) {
                $contador_yust++;
            }
        }

        // Mostrar el resultado
        echo "$contador_yust";
    } else {
        echo "0";
    }
} else {
    echo "0";
}
?>)
                                </button></a></div>
<center>
                        <style>
        .tabs {
            display: flex;
            justify-content: space-between;
            margin-top:19px;
            margin-bottom:-12px;
            background-color: transparent;
            padding: 0px;
        }

        .tab {
            flex: 1;
            padding: 0px 6px;
            text-align: center;
            cursor: pointer;
            border: 0px solid #ccc;
        }

        .tab-content {
            display: block;
            padding: 0px;
            border: 0px solid #ccc;
        }

        .tab-content.active {
            display: block;
        }
    </style>


    <div class="tabs">
        <div class="tab" style="border-bottom: 3px solid #03a9f400;" onclick="openTab('tab2')">                            <a href="editar_texto.php"><button style="width:100%; padding: 5px 15px; font-size: 15px; margin-left: 0px; border-radius: 6px; border: none; font-weight: 500; background-color: #2196F3;" class="">
            <b style="color:white; font-family:Nunito;">
                                <?php

switch ($usuario['ideoma']) {
    case 'Español':
        echo "Editar perfil";
        break;
    case 'Deutsch':
        echo "Profil bearbeiten";
        break;
    case '日本語':
        echo "プロファイル編集";
        break;
    case 'Русский':
        echo "Редактировать профиль";
        break;
    case 'English':
        echo "Edit profile";
        break;
    default:
        echo "Editar perfil";
        break;
}

?></b>
                                </button></a></div>
        <div class="tab" style="border-bottom: 3px solid #00000000;" onclick="openTab('tab1')"><a href="configuracion.php"><button style="width:100%; padding: 4.5px 15px; font-size: 15px; margin-left: 0px; border-radius: 6px; border: none; font-weight: 500; background-color: transparent; border:solid 1px #cccc;" class="">
            <b style="color:black; font-family:Nunito;">
                                    <?php

switch ($usuario['ideoma']) {
    case 'Español':
        echo "Configurar";
        break;
    case 'Deutsch':
        echo "Aufstellen";
        break;
    case '日本語':
        echo "設定";
        break;
    case 'Русский':
        echo "Настраивать";
        break;
    case 'English':
        echo "Set up";
        break;
    default:
        echo "Configurar";
        break;
}

?></b>
                                </button></a></div>
                                
                                
        
    </div>
                    </center>
                               
                        <div style="padding:8px;" class="cart">
                        
                        <div style="width:100%;" class="info">
                        
                            <div class="general_info">
                               
                            </div>
                            <p class="nick_name"><svg style="margin-top:-2px;" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="15" height="15"><path d="M17,10.039c-3.859,0-7,3.14-7,7,0,3.838,3.141,6.961,7,6.961s7-3.14,7-7c0-3.838-3.141-6.961-7-6.961Zm0,11.961c-2.757,0-5-2.226-5-4.961,0-2.757,2.243-5,5-5s5,2.226,5,4.961c0,2.757-2.243,5-5,5Zm1.707-4.707c.391,.391,.391,1.023,0,1.414-.195,.195-.451,.293-.707,.293s-.512-.098-.707-.293l-1-1c-.188-.188-.293-.442-.293-.707v-2c0-.552,.447-1,1-1s1,.448,1,1v1.586l.707,.707Zm5.293-10.293v2c0,.552-.447,1-1,1s-1-.448-1-1v-2c0-1.654-1.346-3-3-3H5c-1.654,0-3,1.346-3,3v1H11c.552,0,1,.448,1,1s-.448,1-1,1H2v9c0,1.654,1.346,3,3,3h4c.552,0,1,.448,1,1s-.448,1-1,1H5c-2.757,0-5-2.243-5-5V7C0,4.243,2.243,2,5,2h1V1c0-.552,.448-1,1-1s1,.448,1,1v1h8V1c0-.552,.447-1,1-1s1,.448,1,1v1h1c2.757,0,5,2.243,5,5Z"/></svg> Se unio: <?php echo $usuario['fecha']; ?></p>
                            
                        </div>
                </div>
            </div>
            </center>
             <style>
             .gggg{
                 width:100%;
             }
        .historias-container {
            width: 100%; /* Ancho del carrusel */
            height: auto; /* Altura del carrusel */
            border: 0px solid #ddd;
            white-space: nowrap;
            overflow: hidden; /* Oculta la barra de desplazamiento */
            position: relative; /* Necesario para los eventos táctiles */
            display: flex; /* Hace que las historias estén en línea */
        }
        
        @media screen and (max-width: 767px) {
            .historias-container {
                width: 99%; /* Ancho del carrusel */
            }
        }
        
        .historia {
            width: 120px; /* Ancho de cada historia */
            max-height: 233px; /* Altura máxima de cada historia */
            background-color: white;
            border-radius: 0px;
            margin: 6px;
            border: 0px solid #ddd;
            flex: 0 0 auto; /* Evita que las historias se agranden */
            overflow: hidden;
        }
        
        .historia video {
            width: 120px; /* Ancho de cada historia */
            height: 175px; /* Altura de cada historia */
            background-color: #f2f2f2;
            object-fit:cover;
            border-radius: 15px;
        }
        
        .historia img {
            width: 120px; /* Ancho de cada historia */
            height: 175px; /* Altura de cada historia */
            background-color: #f2f2f2;
            border-radius: 15px;
        }
        
        /* Estilos para los botones (opcional) */
        .scroll-btn {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 30px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        
        .scroll-btn:hover {
            background: rgba(0, 0, 0, 0.7);
        }
        
        .scroll-left {
            left: 0;
        }
        
        .scroll-right {
            right: 0;
        }
    </style>
</head>
<body>
    <center>
        <div class="historias-container" id="historias-container">
            
            <a href="livetime.php">
            <div class="historia">
            <img src="perfiles/<?php echo $usuario['imagen']; ?>" alt="">  
                <p style="border-bottom-right-radius: 15px; border-bottom-left-radius: 15px; border:solid 1px transparent; position: relative;z-index:999;background-color: #ffffff69;margin-top: -45px; height: 45px; color:black;"><svg aria-label="Nueva publicación" class="x1lliihq x1n2onr6 x5n08af" fill="currentColor" height="45" role="img" viewBox="0 0 24 24" width="45" style="border-radius:10px;padding: 5px;margin-top: -140px;background-color: #ffffff69;color: black;margin-right:3px;padding-bottom:3px;"><title>Nueva publicación</title><path d="M2 12v3.45c0 2.849.698 4.005 1.606 4.944.94.909 2.098 1.608 4.946 1.608h6.896c2.848 0 4.006-.7 4.946-1.608C21.302 19.455 22 18.3 22 15.45V8.552c0-2.849-.698-4.006-1.606-4.945C19.454 2.7 18.296 2 15.448 2H8.552c-2.848 0-4.006.699-4.946 1.607C2.698 4.547 2 5.703 2 8.552Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="6.545" x2="17.455" y1="12.001" y2="12.001"></line><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="12.003" x2="12.003" y1="6.545" y2="17.455"></line></svg>
<br>
<span style="font-family: 'Nunito';color: #000000;font-weight:600;">Sube Life</span>    
    </p>
            </div></a>
            <!-- Repite este bloque 12 veces para agregar 12 historias -->
<?php
$soy = $d;
$archivo = "hist.json";
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

// Crear arrays separados para "yustin" y otros usuarios
$datos_yustin = array();
$otros_datos = array();

// Separar los datos en los arrays correspondientes
foreach ($datos as $id => $dato) {
    if ($dato["nombre"] === $soy) {
        $datos_yustin[$id] = $dato;
    } else {
        $otros_datos[$id] = $dato;
    }
}

// Mostrar primero el contenido de "yustin" y luego lo demás
foreach ($datos_yustin as $id => $dato) {
    // Mostrar el contenido relacionado con "yustin"
    ?>
    <a href="views?q=<?php echo $dato["link"]; ?>">
        <div class="historia">
            <video autoplay muted poster="<?php echo $dato["foto"]; ?>" src="<?php echo $dato["foto"]; ?>" alt=""></video>
            <p style="overflow-y: auto; margin:0px; padding-top:3px; color:black;">
                <div style="margin-top: -183px;padding:7px;" class="modal-body">
                    <div class="comments">
                        <div class="comment">
                            <div class="d-flex">
                                <div class="img">
                                    <img style="width: 23px; height: 23px;" src="perfiles/<?php
                                    $clave = $dato["nombre"];
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
                                        echo $cadena['imagen']; // Reemplaza con la ruta de tu imagen por defecto
                                    }
                                    ?>" alt="">
                                </div>
                                <div class="content">
                                    <div class="person">
                                        <h4 class="pat" style="text-align: left; width: 62px; overflow-y: auto; text-shadow: 2px 2px 4px rgb(0 0 0 / 28%); color:white;"><?php
                                            $clave = $dato["nombre"];
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
                                                echo $cadena['nombre_completo']; // Reemplaza con la ruta de tu imagen por defecto
                                            }
                                            ?></h4>
                                        <div class="like">
                                            <svg style="padding-left:4px; padding-right:2px;" fill="white" class="bi bi-suit-heart not_loved" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="18" height="18"><g>
                                                    <circle cx="458.667" cy="256" r="53.333"></circle>
                                                    <circle cx="256" cy="256" r="53.333"></circle>
                                                    <circle cx="53.333" cy="256" r="53.333"></circle>
                                                </g></svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="red" class="bi bi-suit-heart-fill loved" viewBox="0 0 16 16">
                                                <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
                                            </svg>
                                        </div>
                                    </div>

                                    <p class="pat" style="padding-left: 17px;margin-left:-56px;margin-top: 116px;color:white;text-align: left;width: 119px;text-shadow: 2px 2px 4px rgb(0 0 0 / 28%);overflow-y: auto;"><?php echo $dato["texto"]; ?></p>


                                    <div class="answers">

                                    </div>
                                </div>




                            </div>

                        </div>

                    </div>
                </div></p>
        </div>
    </a>
    <?php
}

foreach ($otros_datos as $id => $dato) {
    // Mostrar el contenido de otros usuarios
    ?>
    <a href="views?q=<?php echo $dato["link"]; ?>">
        <div class="historia">
            <video autoplay muted poster="<?php echo $dato["foto"]; ?>" src="<?php echo $dato["foto"]; ?>" alt=""></video>
            <p style="overflow-y: auto; margin:0px; padding-top:3px; color:black;">
                <div style="margin-top: -183px;padding:7px;" class="modal-body">
                    <div class="comments">
                        <div class="comment">
                            <div class="d-flex">
                                <div class="img">
                                    <img style="width: 23px; height: 23px;" src="perfiles/<?php
                                    $clave = $dato["nombre"];
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
                                        echo $cadena['imagen']; // Reemplaza con la ruta de tu imagen por defecto
                                    }
                                    ?>" alt="">
                                </div>
                                <div class="content">
                                    <div class="person">
                                        <h4 class="pat" style="text-align: left; width: 62px; overflow-y: auto; text-shadow: 2px 2px 4px rgb(0 0 0 / 28%); color:white;"><?php
                                            $clave = $dato["nombre"];
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
                                                echo $cadena['nombre_completo']; // Reemplaza con la ruta de tu imagen por defecto
                                            }
                                            ?></h4>
                                        <div class="like">
                                            <svg style="padding-left:4px; padding-right:2px;" fill="white" class="bi bi-suit-heart not_loved" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="18" height="18"><g>
                                                    <circle cx="458.667" cy="256" r="53.333"></circle>
                                                    <circle cx="256" cy="256" r="53.333"></circle>
                                                    <circle cx="53.333" cy="256" r="53.333"></circle>
                                                </g></svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="red" class="bi bi-suit-heart-fill loved" viewBox="0 0 16 16">
                                                <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
                                            </svg>
                                        </div>
                                    </div>

                                    <p class="pat" style="padding-left: 17px;margin-left:-56px;margin-top: 116px;color:white;text-align: left;width: 119px;text-shadow: 2px 2px 4px rgb(0 0 0 / 28%);overflow-y: auto;"><?php echo $dato["texto"]; ?></p>


                                    <div class="answers">

                                    </div>
                                </div>




                            </div>

                        </div>

                    </div>
                </div></p>
        </div>
    </a>
    <?php
}
?>

            <!-- Fin de bloque repetido -->
        </div>
    </center>
    <script>
        const container = document.getElementById('historias-container');
        let isDragging = false;
        let startX;
        let scrollLeft;

        container.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.pageX - container.offsetLeft;
            scrollLeft = container.scrollLeft;
        });

        container.addEventListener('mouseup', () => {
            isDragging = false;
        });

        container.addEventListener('mouseleave', () => {
            isDragging = false;
        });

        container.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.pageX - container.offsetLeft;
            const walk = (x - startX) * 2; // Ajusta la velocidad del desplazamiento
            container.scrollLeft = scrollLeft - walk;
        });

        // Manejo de eventos táctiles para dispositivos móviles
        container.addEventListener('touchstart', (e) => {
            isDragging = true;
            startX = e.touches[0].pageX - container.offsetLeft;
            scrollLeft = container.scrollLeft;
        });

        container.addEventListener('touchend', () => {
            isDragging = false;
        });

        container.addEventListener('touchcancel', () => {
            isDragging = false;
        });

        container.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.touches[0].pageX - container.offsetLeft;
            const walk = (x - startX) * 2; // Ajusta la velocidad del desplazamiento
            container.scrollLeft = scrollLeft - walk;
        });
    </script>
            
            
  <script>
 const videos = document.querySelectorAll("video");

const options = {
  root: null,
  rootMargin: "0px",
  threshold: 0.5
};

const observer = new IntersectionObserver((entries, observer) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.play();
      entry.target.muted = true;
    } else {
      entry.target.pause();
      entry.target.muted = false;
    }
  });
}, options);

videos.forEach(video => {
  const src = video.getAttribute("src");

  fetch(src)
    .then(res => res.blob())
    .then(blob => {
      const videoBlob = URL.createObjectURL(blob);
      video.src = videoBlob;
      observer.observe(video);

      video.addEventListener("ended", () => {
        const nextLi = video.closest("li").nextElementSibling;
        if (nextLi) {
          nextLi.scrollIntoView({ behavior: "smooth" });
        }
      });

      video.addEventListener("click", () => {
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
      const durationDisplay = video.closest(".video-container").querySelector(".duration");
      video.addEventListener("timeupdate", () => {
        const minutes = Math.floor(video.currentTime / 60);
        const seconds = Math.floor(video.currentTime % 60);
        durationDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, "0")}`;

        // Actualizar la barra de progreso
        const progressBar = video.closest(".video-container").querySelector(".progress-bar");
        progressBar.value = (video.currentTime / video.duration) * 100;
      });

      // Adelantar o retroceder el video al hacer clic o deslizar la barra de progreso
      const progressBar = video.closest(".video-container").querySelector(".progress-bar");
      progressBar.addEventListener("click", event => {
        const pos = (event.pageX - (progressBar.offsetLeft + progressBar.offsetParent.offsetLeft)) / progressBar.offsetWidth;
        video.currentTime = pos * video.duration;
      });
      progressBar.addEventListener("mousedown", () => {
        video.pause();
      });
      progressBar.addEventListener("mouseup", () => {
        video.play();
      });
      progressBar.addEventListener("touchstart", () => {
        video.pause();
      });
      progressBar.addEventListener("touchend", () => {
        video.play();
      });
      progressBar.addEventListener("touchmove", event => {
        const pos = (event.touches[0].pageX - (progressBar.offsetLeft + progressBar.offsetParent.offsetLeft)) / progressBar.offsetWidth;
        video.currentTime = pos * video.duration;
      });
    });
});

const videoContainer = document.querySelector(".video-container");
const videoPlayer = videoContainer.querySelector(".video__player");
const playButton = videoContainer.querySelector(".play-button");

playButton.addEventListener("click", () => {
  videoPlayer.play();
  videoContainer.classList.add("playing");
  playButton.style.display = "none";
});

videoPlayer.addEventListener("play", () => {
  videoContainer.classList.add("playing");
  playButton.style.display = "none";
});

videoPlayer.addEventListener("pause", () => {
  videoContainer.classList.remove("playing");
  playButton.style.display = "block";
});

// Actualizar la barra de progreso
const progressBar = videoPlayer.closest(".video-container").querySelector(".progress-bar");
videoPlayer.addEventListener("timeupdate", () => {
  progressBar.value = (videoPlayer.currentTime / videoPlayer.duration) * 100;
});

// Adelantar o retroceder el video al hacer clic o deslizar la barra de progreso
progressBar.addEventListener("click", event => {
  const pos = (event.pageX - (progressBar.offsetLeft + progressBar.offsetParent.offsetLeft)) / progressBar.offsetWidth;
  videoPlayer.currentTime = pos * videoPlayer.duration;
});
progressBar.addEventListener("mousedown", () => {
  videoPlayer.pause();
});
progressBar.addEventListener("mouseup", () => {
  videoPlayer.play();
});
progressBar.addEventListener("touchstart", () => {
  videoPlayer.pause();
});
progressBar.addEventListener("touchend", () => {
  videoPlayer.play();
});
progressBar.addEventListener("touchmove", event => {
  const pos = (event.touches[0].pageX - (progressBar.offsetLeft + progressBar.offsetParent.offsetLeft)) / progressBar.offsetWidth;
  videoPlayer.currentTime = pos * videoPlayer.duration;
});

// Adelantar o retroceder el video al presionar las teclas de la flecha izquierda/derecha o inicio/fin
document.addEventListener("keydown", event => {
  const videos = document.querySelectorAll("video");

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
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const carouselFace = document.querySelector(".carousel-face2");

    // Ajustar la cantidad de imágenes visibles en el carrusel
    const numVisibleItems = 2;
    const itemWidth = carouselFace.clientWidth / numVisibleItems;

    // Configurar el ancho de los elementos del carrusel
    const carouselItems = document.querySelectorAll(".carousel-face__item2");
    carouselItems.forEach(item => {
        item.style.width = "50px";
    });
});

  </script>
  <style>
  .carousel-face {
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding-left:3px;
    height: 295px; /* Altura de cada item, ajusta según sea necesario */
    overflow-x: auto;
    scroll-snap-type: x mandatory;
}

.carousel-face__item {
    flex: 0 0 calc(43.33% - 10px); /* Ancho del 33.33% para 3 imágenes, con 10px de separación entre ellas */
    height: 100%;
    margin-right: 6px;
    margin-left: 6px;
    scroll-snap-align: start;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

.carousel-face__item video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.carousel-face2 {
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding-left:3px;
    height: 230px; /* Altura de cada item, ajusta según sea necesario */
    overflow-x: auto;
    scroll-snap-type: x mandatory;
}

.carousel-face__item2 {
    flex: 0 0 calc(43.33% - 10px); /* Ancho del 33.33% para 3 imágenes, con 10px de separación entre ellas */
    height: 100%;
    margin-right: 6px;
    margin-left: 6px;
    scroll-snap-align: start;
    border-radius: 15px;
    overflow: hidden;
}

.carousel-face__item2 div {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hola{
    display:none;
}

@media (max-width: 768px) {
  .hola {
    display:block;
  }
}

  </style>
        
<style>
.gh {
        
       
min-height: 210px; max-height: 210px;

}
@media screen and (max-width: 567px) {
    
   
.gh {
min-height: 130px; max-height: 130px;
    }
}


.gh2 {
        
       
max-height: 210px;

}
@media screen and (max-width: 567px) {
    
   
.gh2 {
    max-height: 130px;
    }
}
</style>
<style>
        /* Estilos para el contenedor principal */
        .profile-container {
            display: flex;
            margin-top:7px;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        /* Estilos para la foto de perfil */
        .profile-picture {
            width: 45px;
            height: 45px;
            border-radius: 17%;
            margin-right: 10px;
        }

        /* Estilos para el nombre */
        .profile-name {
            font-size: 16px;
            font-weight: 400;
            font-family:helvetica;
            margin-bottom: 3px;
        }

        /* Estilos para la fecha */
        .profile-date {
            font-size: 14px;
            color: #888;
        }
    </style>
    
                  </div>
            </div>
        </div>


<script src="js/push.min.js"></script>

<style>
    .push-notification-image {
        border-radius: 50%;  /* Hacer la imagen redonda */
    }
</style>




    
    <!-- <script src="./sass/vender/bootstrap.bundle.js"></script>
    <script src="./sass/vender/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="./owlcarousel/jquery.min.js"></script>
    <script src="./owlcarousel/owl.carousel.min.js"></script>
    <script src="./js/carousel.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
    <script src="./js/main.js"></script>

<style>
img[src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] {
    display: none;
}
       
    </style>
    <button style=" display: none;" id="toggleDarkMode">Toggle Dark Mode</button>
    <script src="dark.js"></script>
</div>
    <iframe style="width: 100%; height: 100vh;" src="profile.php?user=<?php echo $d; ?>"></iframe>
    
</body></html>