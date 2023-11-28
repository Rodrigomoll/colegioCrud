<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/Models/User.php";

class AdminController
{
    protected $model;

    public function __construct()
    {
        $this -> model = new User();
    }
    /**
     * Muestra una vista con todos los permisos.
     */
    public function index()
    {
        $permisos = $this->model->allPermisos();

        include $_SERVER["DOCUMENT_ROOT"] . "/views/permisos/read.php";
    }

    /**
     * Muestra un formulario para crear un nuevo cliente.
     */
    public function create()
    {
        include $_SERVER["DOCUMENT_ROOT"] . "/views/permisos/create.php";
    }

    /**
     * Muestra un formulario para editar un cliente.
     */
    public function edit($id)
    {
        $permiso = $this->model->find($id);
        $roles = $this->model->allRoles();

        include $_SERVER["DOCUMENT_ROOT"] . "/views/permisos/edit.php";
    }

    /**
     * Actualiza los datos de un cliente y envía al usuario a /clientes.
     */
    public function update($request)
    {
        $this->model->update($request);

        header("Location: /permisos");
    }

    /**
     * Guarda el registro de un nuevo cliente y envía al usuario a /clientes.
     * 
     * @param array $request Datos del cliente nuevo
     */
    public function store($request)
    {
        $response = $this->model->create($request);

        header("Location: /permisos");
    }

    /**
     * Eliminar el registro de un cliente y envía al usuario a /clientes.
     */
    public function delete($id)
    {
        $this->model->destroy($id);

        header("Location: /permisos");
    }
}