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

    <div class="bg-gray-200 w-4/5 h-screen">
        <header class="bg-gray-500 p-4 text-white flex justify-between items-center">
            <h1>Bienvenido al dashboard</h1>
            <!-- Puedes ajustar el enlace de cierre de sesión según tus necesidades -->
            <a href="/logout" class="float-right">Cerrar Sesión</a>
        </header>

        <div class=" bg-gray-400 w-full h-full flex flex-col items-center">
            <a href="/alumnos/create">CREAR NUEVO ALUMNO</a>
            <table class="w-4/5 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-10">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-6">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-6">
                            DNI
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Correo
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Dirección
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Fecha de Nacimiento
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $alumno) { ?>
                        <tr class="bh-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $alumno["id"] ?>
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $alumno["DNI"] ?>
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $alumno["nombre"] ?>
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $alumno["correo"] ?>
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $alumno["direccion"] ?>
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $alumno["fec_nac"] ?>
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white flex">
                                <a href="/alumnos/edit?id=<?= $alumno["id"] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline flex justify-center items-center mr-4"><i class="fas fa-edit"></i></a>
                                <form action="/alumnos/delete" method="post" style="display: inline">
                                    <input type="number" hidden value="<?= $alumno["id"] ?>" name="id">
                                    <button type="submit" class="text-red-500">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </th>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
