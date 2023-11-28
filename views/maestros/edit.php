<?php
// Asegurarse de que la variable $maestro está definida
!isset($maestro) && header("Location: /maestros");

session_start();
$_SESSION["maestroid_edit"] = $maestro["id"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>Editar Maestro</title>
</head>

<body class="bg-gray-700 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h1 class="text-2xl font-semibold mb-6">Editar maestro</h1>

        <form action="/maestros/update" method="post">
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= $maestro["nombre"] ?>" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="mb-4">
                <label for="correo" class="block text-sm font-medium text-gray-600">Correo:</label>
                <input type="email" id="correo" name="correo" value="<?= $maestro["correo"] ?>" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="mb-4">
                <label for="direccion" class="block text-sm font-medium text-gray-600">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?= $maestro["direccion"] ?>" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="mb-4">
                <label for="fec_nac" class="block text-sm font-medium text-gray-600">Fecha de Nacimiento:</label>
                <input type="date" id="fec_nac" name="fec_nac" value="<?= $maestro["fec_nac"] ?>" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="mb-4">
                <label for="clase_id" class="block text-sm font-medium text-gray-600">Clase Asignada:</label>
                <select id="clase_id" name="clase_id" class="mt-1 p-2 w-full border rounded-md">
                    <?php
                    // Itera sobre las clases y crea las opciones del select
                    foreach ($clasesMaestros as $clase) {
                        // Marca como seleccionada la clase actual del maestro
                        $selected = ($clase["id"] == $maestro["clase_id"]) ? "selected" : "";
                        echo "<option value='{$clase["id"]}' $selected>{$clase["nombre"]}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Guardar</button>
        </form>

        <a href="/maestros" class="block mt-4 text-blue-500">VER LISTA DE MAESTROS</a>
    </div>
</body>

</html>