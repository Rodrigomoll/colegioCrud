<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/Models/MaestrosClase.php");

class MaestrosClaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new MaestrosClase();
    }

    public function index()
    {
        $query = "
        SELECT mc.id, u.nombre AS nombre_maestro, c.nombre AS nombre_clase
        FROM maestros_clase mc
        JOIN clases c ON mc.clase_id = c.id
        JOIN maestros_clase mc_alumno ON c.id = mc_alumno.clase_id
        JOIN usuarios u ON mc.usuario_id = u.id
        WHERE mc_alumno.usuario_id = 2;
        ";

        $maestrosclasses = $this->model->customQuery($query);
        $inscritos = $maestrosclasses->fetch_all(MYSQLI_ASSOC);


        include $_SERVER["DOCUMENT_ROOT"] . "/views/maestros_clases/read.php";
    }

}