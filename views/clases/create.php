<?php
// Asegúrate de iniciar la sesión en el controlador correspondiente

// Verifica si la variable $maestros está definida; si no, establece un valor predeterminado vacío.
$maestros = isset($maestros) ? $maestros : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>Crear Clase</title>
</head>

<body class="bg-gray-700 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h1 class="text-2xl font-semibold mb-6">Crear clase</h1>

        <form action="/clases/create" method="post">
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre de la clase:</label>
                <input type="text" id="nombre" name="nombre" value="" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="mb-4">
                <label for="maestro" class="block text-sm font-medium text-gray-600">Maestro:</label>
                <select id="maestro" name="maestro_id" class="mt-1 p-2 w-full border rounded-md">
                    <?php
                    // Itera sobre los maestros y crea las opciones del select
                    foreach ($maestros as $maestro) {
                        echo "<option value='{$maestro["id"]}'>{$maestro["nombre"]}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Guardar</button>
        </form>

        <a href="/clases" class="block mt-4 text-blue-500">VER LISTA DE CLASES</a>
    </div>
</body>

</html>
