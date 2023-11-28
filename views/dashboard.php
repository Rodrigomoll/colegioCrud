<!DOCTYPE html>
<html lang="es">

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

    <div class="bg-gray-700 w-1/5 h-screen p-4 text-white text-lg flex flex-col items-center">
        <?php
        // Verificar si el usuario está autenticado
        if (isset($_SESSION["user"])) {
            $nombreUsuario = $_SESSION["user"]["nombre"];
            echo "<p class='mt-4 text-xl font-semibold'>¡Bienvenido, $nombreUsuario!</p>";
        }
        ?>
        <h2 class="my-4 text-center text-lg font-semibold">Menú</h2>
        <ul class="mt-4">
            <?php
            // Verificar el rol del usuario
            $rol = $_SESSION["user"]["rol_id"];

            // Mostrar elementos específicos para el rol de admin
            if ($rol == 1) {
                echo '<li><a href="/permisos" id="linkPermisos" class="block text-center py-2 hover:bg-gray-600">Permisos</a></li>';
                echo '<li><a href="/maestros" class="block text-center py-2 hover:bg-gray-600">Maestros</a></li>';
                echo '<li><a href="/alumnos" class="block text-center py-2 hover:bg-gray-600">Alumnos</a></li>';
                echo '<li><a href="/clases" class="block text-center py-2 hover:bg-gray-600">Clases</a></li>';
            }

            // Mostrar elementos específicos para el rol de maestro
            if ($rol == 2) {
                echo '<li><a href="/dashboard/clases" class="block text-center py-2 hover:bg-gray-600">Clases</a></li>';
                // Puedes personalizar o no mostrar más elementos según el rol de maestro
            }

            // Mostrar elementos específicos para el rol de alumno
            if ($rol == 3) {
                echo '<li><a href="/dashboard/clases" class="block text-center py-2 hover:bg-gray-600">Mis Clases</a></li>';
                // Puedes personalizar o no mostrar más elementos según el rol de alumno
            }
            ?>
        </ul>
    </div>

    <!-- Resto del contenido -->
    <?php
    // Mostrar el contenido específico para cada rol
    if ($rol == 1 || $rol == 2 || $rol == 3) {
    ?>
        <div class="bg-gray-200 w-4/5 h-screen">
            <header class="bg-gray-500 p-4 text-white flex justify-between items-center">
                <h1 class="text-lg font-semibold">Bienvenido al dashboard</h1>
                <a href="/logout" class="text-sm hover:underline">Cerrar Sesión</a>
            </header>
            <div class="p-8">
                <?php
                // Mostrar contenido específico para cada rol
                if ($rol == 1) {
                    echo '<h2 class="text-xl font-semibold mb-4">Dashboard de Administrador</h2>';
                } elseif ($rol == 2) {
                    echo '<h2 class="text-xl font-semibold mb-4">Dashboard de Maestro</h2>';
                } elseif ($rol == 3) {
                    echo '<h2 class="text-xl font-semibold mb-4">Dashboard de Alumno</h2>';
                }
                ?>
                <!-- Agrega aquí el contenido específico para cada rol -->
            </div>
        </div>
    <?php
    }
    ?>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
