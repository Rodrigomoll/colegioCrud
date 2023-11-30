<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/models/User.php";

class AlumnosController
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
        $alumnos = $this->model->where('rol_id', '=', 3);

        include $_SERVER["DOCUMENT_ROOT"] . "/views/alumnos/read.php";
    }

    /**
     * Muestra un formulario para crear un nuevo alumno.
     */
    public function create()
    {
        include $_SERVER["DOCUMENT_ROOT"] . "/views/alumnos/create.php";
    }

    /**
     * Muestra un formulario para editar un alumno.
     */
    public function edit($id)
    {
        $alumno = $this->model->findAlumno($id);
        // Puedes agregar lógica adicional según sea necesario

        include $_SERVER["DOCUMENT_ROOT"] . "/views/alumnos/edit.php";
    }

    /**
     * Actualiza los datos de un alumno y redirige al usuario a /alumnos.
     */
    public function update($request)
    {
        // Asumiendo que el rol_id para alumnos es 3
        $request['rol_id'] = 3;
        $this->model->updateAlumno($request);

        header("Location: /alumnos");
    }

    /**
     * Guarda el registro de un nuevo alumno y redirige al usuario a /alumnos.
     * 
     * @param array $request Datos del nuevo alumno
     */
    public function store($request)
    {
        // Asumiendo que el rol_id para alumnos es 3
        $request['rol_id'] = 3;
        $response = $this->model->createAlumno($request);

        header("Location: /alumnos");
    }

    /**
     * Elimina el registro de un alumno y redirige al usuario a /alumnos.
     */
    public function delete($id)
    {
        $this->model->destroyAlumno($id);

        header("Location: /alumnos");
    }
}
?>
