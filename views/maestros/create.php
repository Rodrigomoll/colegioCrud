<?php
// Asegúrate de iniciar la sesión en el controlador correspondiente

// Verifica si la variable $clases y $maestros está definida; si no, establece un valor predeterminado vacío.
$clases = isset($clases) ? $clases : [];
$maestros = isset($maestros) ? $maestros : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>Crear Maestro</title>
</head>

<body class="bg-gray-700 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h1 class="text-2xl font-semibold mb-6">Crear Maestro</h1>

        <form action="/maestros/create" method="post">
            <div class="mb-4">
                <label for="correo" class="block text-sm font-medium text-gray-600">Correo:</label>
                <input type="email" id="correo" name="correo" value="" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="mb-4">
                <label for="direccion" class="block text-sm font-medium text-gray-600">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="mb-4">
                <label for="fec_nac" class="block text-sm font-medium text-gray-600">Fecha de Nacimiento:</label>
                <input type="date" id="fec_nac" name="fec_nac" value="" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="mb-4">
                <label for="clase_asignada" class="block text-sm font-medium text-gray-600">Clase Asignada:</label>
                <select id="clase_asignada" name="clase_asignada" class="mt-1 p-2 w-full border rounded-md">
                    <?php
                    // Itera sobre las clases y crea las opciones del select
                    foreach ($clasesMaestros as $clase) {
                        echo "<option value='{$clase["id"]}'>{$clase["nombre"]}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Guardar Maestro</button>
        </form>

        <a href="/maestros" class="block mt-4 text-blue-500">VER LISTA DE MAESTROS</a>
    </div>
</body>

</html>
