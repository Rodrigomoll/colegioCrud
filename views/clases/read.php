<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <title>Clases</title>
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
                echo '<li><a href="/alumnos">Alumnos</a></li>';
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

    <div class="bg-gray-200 w-4/5 h-screen flex-col justify-center items-center">
        <header class="bg-gray-500 p-4 text-white flex">
            <h1>Bienvenido al dashboard</h1>
            <!-- Puedes ajustar el enlace de cierre de sesión según tus necesidades -->
            <a href="/logout" class="float-right">Cerrar Sesión</a>
        </header>

        <div class=" bg-gray-400 w-full h-full flex flex-col items-center">
            <a href="/clases/create">CREAR NUEVO CLIENTE</a>
            <table class="w-4/5 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-10">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-6">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Clase
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Maestro
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clases as $clase) { ?>
                        <tr class="bh-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $clase["id"] ?>
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $clase["clase"] ?>
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $clase["maestro"] ?>
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white flex">
                                <a href="/clases/edit?id=<?= $clase["id"] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline flex justify-center items-center mr-4"><i class="fas fa-edit"></i></a>
                                <form action="/clases/delete" method="post" style="display: inline">
                                    <input type="number" hidden value="<?= $clase["id"] ?>" name="id">
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