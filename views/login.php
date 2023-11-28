<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/dist/output.css" rel="stylesheet">
    <title>Login</title>
</head>

<body class="bg-amber-100 h-screen w-full flex justify-center items-center">
    <div class="bg-amber-100 w-1/4 h-screen flex-col justify-center items-center">
        <img src="../assets/logo.jpg" alt="logo" class="w-2/3 h-1/3 mx-auto my-auto">
        <form class="w-full h-2/6 bg-white text-lg text-black py-4 px-4 flex-col justify-center items-center" action="/login" method="post">
            <h1 class="flex justify-center items-center mb-2">Bienvenido, ingrese con su cuenta</h1>
            <div>
                <input type="email" id="correo" name="correo" placeholder="Email" class="border border-gray-300 w-full p-2 mb-4">
            </div>
            <div>
                <input type="password" id="contrasena" name="contrasena" placeholder="Password" class="border border-gray-w00 w-full p-2">
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 mt-4 self-end">Iniciar sesión</button>
        </form>
    </div>
</body>
<script src="https://cdn.tailwindcss.com"></script>
</html>
