<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/models/User.php";

class MaestrosController
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * Muestra una vista con todos los alumnos.
     */
    public function index()
    {
        // Asumiendo que el rol_id para alumnos es 3
        $maestroTabla = $this->model->findMaestro();

        include $_SERVER["DOCUMENT_ROOT"] . "/views/maestros/read.php";
    }

    /**
     * Muestra un formulario para crear un nuevo alumno.
     */
    public function create()
    {
        $maestrosClase = $this->model->findMaestro();
        include $_SERVER["DOCUMENT_ROOT"] . "/views/maestros/create.php";
    }

    /**
     * Muestra un formulario para editar un alumno.
     */
    public function edit($id)
    {
        $maestrosClase = $this->model->allClaseAsignada();
        $maestro = $this->model->findMaestro($id);
        // Puedes agregar lógica adicional según sea necesario

        include $_SERVER["DOCUMENT_ROOT"] . "/views/maestros/edit.php";
    }

    /**
     * Actualiza los datos de un alumno y redirige al usuario a /alumnos.
     */
    public function update($request)
    {
        // Asumiendo que el rol_id para alumnos es 3
        $request['rol_id'] = 2;
        $this->model->updateMaestro($request);

        header("Location: /maestros");
    }

  /**
     * Guarda el registro de un nuevo alumno y redirige al usuario a /alumnos.
     * 
     * @param array $request Datos del nuevo alumno
     */
    public function store($request)
    {
        // Asumiendo que el rol_id para alumnos es 3
        $request['rol_id'] = 2;
        $response = $this->model->createMaestro($request);

        header("Location: /maestros");
    }


    /**
     * Elimina el registro de un alumno y redirige al usuario a /alumnos.
     */
    public function delete($id)
    {
        $this->model->destroyMaestro($id);

        header("Location: /maestros");
    }
}
?>
