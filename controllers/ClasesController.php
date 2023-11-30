<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Clases.php";

class ClasesController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Clases();
    }

    /**
     * Muestra una vista con todas las clases.
     */
    public function index()
    {
        $clases = $this->model->allClases();

        include $_SERVER["DOCUMENT_ROOT"] . "/views/clases/read.php";
    }

    /**
     * Muestra un formulario para crear una nueva clase.
     */
    public function create()
    {
        $maestros = $this->model->allMaestros();
        
        include $_SERVER["DOCUMENT_ROOT"] . "/views/clases/create.php";
    }

    /**
     * Muestra un formulario para editar una clase.
     */
    public function edit($id)
    {
        $clase = $this->model->find($id);
        $maestros = $this->model->allMaestros();
        // Puedes agregar lógica adicional según sea necesario

        include $_SERVER["DOCUMENT_ROOT"] . "/views/clases/edit.php";
    }

    /**
     * Actualiza los datos de una clase y redirige al usuario a /clases.
     */
    public function update($request)
    {
        $this->model->updateClase($request);

        header("Location: /clases");
    }

    /**
     * Guarda el registro de una nueva clase y redirige al usuario a /clases.
     * 
     * @param array $request Datos de la nueva clase
     */
    public function store($request)
    {
        $response = $this->model->createClase($request);

        header("Location: /clases");
    }

    /**
     * Elimina el registro de una clase y redirige al usuario a /clases.
     */
    public function delete($id)
    {
        $this->model->destroyClase($id);

        header("Location: /clases");
    }
}