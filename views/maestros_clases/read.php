<!-- read.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <title>Alumnos</title>
</head>

<body class="bg-gray-200 w-full h-screen flex">
    <?php
    session_start();
    ?>

<div class="bg-gray-700 w-1/5 h-screen p-4 text-white text-lg flex flex-col items-center">
<div class="flex items-center mb-4">
            <img src="../assets/logo.jpg" alt="Logo de la Universidad" class="w-8 h-8 mr-2">
            <h1 class="text-lg font-semibold">Universidad</h1>
        </div>
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
                echo '<li><a href="/maestros_clases" class="block text-center py-2 hover:bg-gray-600">Administra tus clases</a></li>';
                // Puedes personalizar o no mostrar más elementos según el rol de maestro
            }

            // Mostrar elementos específicos para el rol de alumno
            if ($rol == 3) {
                echo '<li><a href="/maestros_clases" class="block text-center py-2 hover:bg-gray-600">Mis Clases</a></li>';
                // Puedes personalizar o no mostrar más elementos según el rol de alumno
            }
            ?>
        </ul>
    </div>

    <div class="bg-gray-200 w-4/5 h-screen">
            <header class="bg-gray-500 p-4 text-white flex justify-between items-center">
                <h1>Bienvenido al dashboard</h1>
                <a href="/logout" class="float-right">Cerrar Sesión</a>
            </header>

            <div class=" bg-gray-400 w-full h-full flex flex-col items-center">
                <table class="w-4/5 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-10">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-6">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-6">
                                Nombre Maestro
                            </th>
                            <th scope="col" class="px-6 py-6">
                                Nombre Clase
                            </th>
                            <!-- ... (otras columnas según tus necesidades) -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inscritos as $inscrito) { ?>
                            <tr class="bh-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?= $inscrito["id"] ?>
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?= $inscrito["nombre_maestro"] ?>
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?= $inscrito["nombre_clase"] ?>
                                </th>
                                <!-- ... (otras celdas según tus necesidades) -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
