<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/Models/AlumnosClase.php");

class AlumnosClaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new AlumnosClase();
    }

    public function index()
    {
        $query = "
        select
            i.id, i.usuario_id, i.clase_id, c.nombre
        from
            alumnos_clase i
        inner join clases c on
            i.clase_id = c.id
        where
            usuario_id = 2;
        ";



        $query2 = "
        select
            c.id as clase_id, c.nombre
        from
            clases c
        where
            not exists(
            select
                clase_id
            from
                alumnos_clase i
            where
                i.clase_id = c.id and i.usuario_id = 2
        );
        ";

        $resInscripciones = $this->model->customQuery($query);
        $inscripciones = $resInscripciones->fetch_all(MYSQLI_ASSOC);

        $resFaltantes = $this->model->customQuery($query2);
        $faltantes = $resFaltantes->fetch_all(MYSQLI_ASSOC);

        include $_SERVER["DOCUMENT_ROOT"] . "/views/alumnos_clase/inscripciones.php";
    }

    public function store($idUsuario, $idClase)
    {
        $dataIngresada = $this->model->create([
            "usuario_id" => $idUsuario,
            "clase_id" => $idClase
        ]);

        header("Location: /alumnos_clase");
    }

    public function destroy($idInscripcion)
    {
        $this->model->destroy($idInscripcion);

        header("Location: /alumnos_clase");
    }
}