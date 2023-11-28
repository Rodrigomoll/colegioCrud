<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/models/User.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Clases.php";

class MaestrosController
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
        $this->model = new Clases();
    }

    public function index()
    {
        // Método para mostrar la lista de maestros con sus clases asignadas
        $maestrosConClase = $this->model->allMaestrosClase();
        include $_SERVER["DOCUMENT_ROOT"] . "/views/maestros/read.php";
    }

    public function create()
    {
        // Método para mostrar el formulario de creación de maestros
        $roles = $this->model->allRoles(); // Puedes necesitar obtener los roles para el formulario
        include $_SERVER["DOCUMENT_ROOT"] . "/views/maestros/create.php";
    }

    public function edit($id)
    {
        // Método para mostrar el formulario de edición de maestros
        $maestro = $this->model->findMaestro($id);
        $clasesMaestros = $this->model->allClasesMaestros(); // Puedes necesitar obtener los roles para el formulario
        include $_SERVER["DOCUMENT_ROOT"] . "/views/maestros/edit.php";
    }

    public function update($request)
    {
        // Método para actualizar un maestro en la base de datos
        $this->model->updateMaestro($request);
        // Puedes redirigir a la página de detalles del maestro actualizado o a la lista de maestros, por ejemplo
        header("Location: /maestros");
    }

    public function store($request)
    {
        // Método para almacenar un nuevo maestro en la base de datos
        $response = $this->model->create($request);
        // Puedes redirigir a la página de detalles del maestro creado o a la lista de maestros, por ejemplo
        header("Location: /maestros");
    }

    public function delete($id)
    {
        // Método para eliminar un maestro de la base de datos
        $this->model->destroyMaestro($id);
        // Puedes redirigir a la lista de maestros u otra página después de la eliminación
        header("Location: /maestros");
    }
}
