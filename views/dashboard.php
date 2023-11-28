<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/dist/output.css" rel="stylesheet">
    <title>Dashboard</title>
</head>

<body class="bg-gray-200 w-full h-screen flex">
    <?php
    session_start();
    ?>

    <div class="bg-gray-700 w-1/5 h-screen p-4 text-white">
        <?php
        // Verificar si el usuario está autenticado
        if (isset($_SESSION["user"])) {
            $nombreUsuario = $_SESSION["user"]["nombre"];
            echo "<p class='mt-4'>Bienvenido, $nombreUsuario</p>";
        }
        ?>
        <h2>Menú</h2>
        <ul class="mt-4">
            <?php
            // Verificar el rol del usuario
            $rol = $_SESSION["user"]["rol_id"];

            // Mostrar elementos específicos para el rol de admin
            if ($rol == 1) {
                echo '<li><a href="/permisos" id="linkPermisos">Permisos</a></li>';
                echo '<li><a href="/maestros">Maestros</a></li>';
                echo '<li><a href="/dashboard/alumnos">Alumnos</a></li>';
                echo '<li><a href="/clases">Clases</a></li>';
            }

            // Mostrar elementos específicos para el rol de maestro
            if ($rol == 2) {
                echo '<li><a href="/dashboard/clases">Clases</a></li>';
                // Puedes personalizar o no mostrar más elementos según el rol de maestro
            }

            // Mostrar elementos específicos para el rol de alumno
            if ($rol == 3) {
                echo '<li><a href="/dashboard/clases">Mis Clases</a></li>';
                // Puedes personalizar o no mostrar más elementos según el rol de alumno
            }
            ?>
        </ul>
    </div>

    <?php
    // Mostrar el contenido específico para el rol de admin
    if ($rol == 1) {
    ?>
        <div class="bg-gray-200 w-4/5 h-screen">
            <header class="bg-gray-500 p-4 text-white flex">
                <h1>Bienvenido al dashboard</h1>
                <a href="/logout" class="float-right">Cerrar Sesión</a>
            </header>
            <!-- Aquí puedes colocar el contenido específico para el rol de admin -->
            <h2 class="text-lg text-black">Dashboard</h2>
        </div>
    <?php
    }

    // Mostrar el contenido específico para el rol de maestro
    if ($rol == 2) {
    ?>
        <div class="bg-gray-200 w-4/5 h-screen">
            <header class="bg-gray-500 p-4 text-white flex">
                <h1>Bienvenido al dashboard</h1>
                <a href="/logout" class="float-right">Cerrar Sesión</a>
            </header>
            <!-- Aquí puedes colocar el contenido específico para el rol de maestro -->
            <h2>Bienvenido, maestro</h2>
        </div>
    <?php
    }

    // Mostrar el contenido específico para el rol de alumno
    if ($rol == 3) {
    ?>
        <div class="bg-gray-200 w-4/5 h-screen">
            <header class="bg-gray-500 p-4 text-white flex">
                <h1>Bienvenido al dashboard</h1>
                <a href="/logout" class="float-right">Cerrar Sesión</a>
            </header>
            <!-- Aquí puedes colocar el contenido específico para el rol de alumno -->
            <h2>Bienvenido, alumno</h2>
        </div>
    <?php
    }
    ?>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
