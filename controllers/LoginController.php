<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/User.php";

class LoginController
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * Muestra una vista con el login.
     */
    public function index()
    {
        include $_SERVER["DOCUMENT_ROOT"] . "/views/login.php";
    }

    public function login($correo, $contrasena)
    {
        $usuario = $this->model->where("correo", "=", $correo);

        if (count($usuario) === 1) {
            // Compara la contraseña en texto plano directamente
            if ($contrasena === $usuario[0]["contrasena"]) {
                session_start();
                $_SESSION["user"] = $usuario[0];
                header("Location: /dashboard");
                exit();
            } else {
                echo "Credenciales incorrectas";
            }
        } else {
            echo "Credenciales incorrectas";
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /index.php");
        exit();
    }

    public function dashboard()
    {
        include $_SERVER["DOCUMENT_ROOT"] . "/views/dashboard.php";
    }
}
