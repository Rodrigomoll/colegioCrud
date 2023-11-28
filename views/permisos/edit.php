<?php
!isset($permiso) && header("Location: /permisos");

session_start();
$_SESSION["permisoid_edit"] = $permiso["id"];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>Edit</title>
</head>

<body class="bg-gray-700 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h1 class="text-2xl font-semibold mb-6">Editar cliente</h1>

        <form action="/permisos/update" method="post">
            <div class="mb-4">
                <label for="correo" class="block text-sm font-medium text-gray-600">Correo:</label>
                <input type="text" id="correo" name="correo" value="<?= $permiso["correo"] ?>" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="mb-4">
                <label for="rol" class="block text-sm font-medium text-gray-600">Rol:</label>
                <select id="rol" name="rol_id" class="mt-1 p-2 w-full border rounded-md">
                    <?php
                    // Itera sobre los roles y crea las opciones del select
                    foreach ($roles as $rol) {
                        // Marca como seleccionado el rol actual del permiso
                        $selected = ($rol["id"] == $permiso["rol_id"]) ? "selected" : "";
                        echo "<option value='{$rol["id"]}' $selected>{$rol["nombre"]}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Guardar</button>
        </form>

        <a href="/permisos" class="block mt-4 text-blue-500">VER LISTA DE CLIENTES</a>
    </div>
</body>

</html>
