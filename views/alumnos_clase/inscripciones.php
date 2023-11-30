<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Agrega el enlace al CDN de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
                echo '<li><a href="/alumnos_clase" class="block text-center py-2 hover:bg-gray-600">Clases</a></li>';
                // Puedes personalizar o no mostrar más elementos según el rol de maestro
            }

            // Mostrar elementos específicos para el rol de alumno
            if ($rol == 3) {
                echo '<li><a href="/alumnos_clase" class="block text-center py-2 hover:bg-gray-600">Mis Clases</a></li>';
                // Puedes personalizar o no mostrar más elementos según el rol de alumno
            }
            ?>
        </ul>
    </div>

    <div class="bg-gray-200 w-4/5 h-screen p-8 flex">
        <div class="w-1/2 pr-8">
            <header class="bg-gray-500 p-4 text-white flex justify-between items-center">
                <h1 class="text-lg font-semibold">Bienvenido al dashboard</h1>
                <!-- Puedes ajustar el enlace de cierre de sesión según tus necesidades -->
                <a href="/logout" class="text-sm hover:underline">Cerrar Sesión</a>
            </header>
            <h1 class="text-2xl font-semibold mb-4">Gestiona tus inscripciones a los cursos</h1>
            <h3 class="text-lg font-semibold mb-4">Alumno ID: 2</h3>
            <table class="w-full table-auto rounded-lg border-gray-500">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Nombre de la clase</th>
                        <th class="border px-4 py-2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inscripciones as $inscripcion) { ?>
                        <tr>
                            <td class="border px-4 py-2"><?= $inscripcion["nombre"] ?></td>
                            <td class="border px-4 py-2"><a href="/delete?id=<?= $inscripcion["id"] ?>" class="text-blue-500 hover:underline">Darse de baja</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <?php
            if (count($faltantes) === 0) {
                echo "<p class='mt-4'>Ya estás inscrito a todas las clases.</p>";
            }
            ?>
        </div>
        <div class="w-1/2 pl-8">
            <?php if (count($faltantes) > 0) { ?>
                <form action="/create" method="post" class="mt-4">
                    <input type="text" hidden value="2" name="alumno_id">

                    <label for="" class="block text-sm font-semibold">Inscríbete a estas clases que son las que te faltan:</label>
                    <select name="clase_id" class="w-full py-2 px-4 border rounded">
                        <?php foreach ($faltantes as $faltante) { ?>
                            <option value="<?= $faltante["clase_id"] ?>"><?= $faltante["nombre"] ?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="mt-2 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Inscribirse</button>
                </form>
            <?php } ?>
        </div>
    </div>
</body>

</html>
