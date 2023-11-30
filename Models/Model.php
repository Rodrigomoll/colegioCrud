<?php
class Model
{
    private $db;
    protected $table;

    public function __construct()
    {
        $config = include($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

        try {
            $this->db = new mysqli(
                $config["host"],
                $config["username"],
                $config["password"],
                $config["dbname"]
            );
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Método para todos los registros de la tabla.
     *
     * @return array Arreglo con todos los registro de la tabla.
     */
    public function allPermisos()
    {
        $query = "SELECT usuarios.id, usuarios.correo, roles.nombre as rol_nombre FROM usuarios 
              JOIN roles ON usuarios.rol_id = roles.id";

        $res = $this->db->query($query);
        $data = $res->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    /**
     * Método para obtener un registro por su id.
     *
     * @param integer $id Id de la fila (recurso) a buscar.
     * @return array Arreglo con los datos de la fila o recurso encontrado.
     */
    public function find($id)
    {
        $res = $this->db->query("select * from {$this->table} where id = $id");
        $data = $res->fetch_assoc();

        return $data;
    }

    /**
     * Método para obtener todos los roles
     *
     * 
     * 
     */
    public function allRoles()
    {
        $query = "SELECT * FROM roles";
        $res = $this->db->query($query);

        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return $data;
        } else {
            // Manejo de errores si la consulta falla
            echo "Error en la consulta: " . $this->db->error;
            return [];
        }
    }

        /**
     * Método para crear un nuevo registro en la tabla.
     *
     * @param array $data Arreglo asociativo con los datos a ingresar.
     * @return array Arreglo con los datos de la fila ingresada.
     */
    public function create($data)
    {
        try {
            // Esto hace que sin importar los pares de clave y valor de la variable $data, el $query sea reutilizable.
            $keys = array_keys($data);
            $keysString = implode(", ", $keys);

            $values = array_values($data);
            $valuesString = implode("', '", $values);
            $query = "insert into {$this->table}($keysString) values ('$valuesString')";

            $res = $this->db->query($query);

            if ($res) {
                $ultimoId = $this->db->insert_id;
                $data = $this->find($ultimoId);

                return $data;
            } else {
                return "No se pudo crear el cliente";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Método para actualizar un registro en la tabla.
     *
     * @param array $data Arreglo asociativo con los datos a actualizar.
     */
    public function update($data)
    {
        // Esto hace que sin importar los pares de clave y valor de la variable $data, el $query sea reutilizable.
        $updatePairs = [];

        foreach ($data as $key => $value) {
            // Excluir columna de 'correo'
            if ($key !== 'correo') {
                $updatePairs[] = "$key = '$value'";
            }
        }

        session_start();
        $query = "UPDATE {$this->table} SET " . implode(", ", $updatePairs) . " WHERE id = '{$_SESSION["permisoid_edit"]}'";

        // Imprime la consulta para depuración
        var_dump($query);

        $this->db->query($query);
    }

    /**
     * Método para eliminar un registro en la tabla.
     *
     * @param integer $id
     */
    public function destroy($id)
    {
        $this->db->query("delete from {$this->table} where id = $id");
    }


    public function allClaseAsignada()
    {
        $query = "SELECT * FROM clases";

        $res = $this->db->query($query);

        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return $data;
        } else {
            // Manejo de errores si la consulta falla
            echo "Error en la consulta: " . $this->db->error;
            return [];
        }
    }
    // Métodos específicos para Clases
    public function allClases()
    {
        $query = "SELECT clases.id, clases.nombre as clase, usuarios.nombre as maestro 
        FROM clases 
        LEFT JOIN usuarios ON clases.maestro_id = usuarios.id";

        $res = $this->db->query($query);
        $data = $res->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    public function allMaestros()
    {
        $rolMaestro = 2; // Reemplaza con el ID del rol de maestro en tu base de datos
        $query = "SELECT * FROM usuarios WHERE rol_id = $rolMaestro";

        $res = $this->db->query($query);

        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return $data;
        } else {
            // Manejo de errores si la consulta falla
            echo "Error en la consulta: " . $this->db->error;
            return [];
        }
    }

    /**
     * Método para crear un nuevo registro en la tabla.
     *
     * @param array $data Arreglo asociativo con los datos a ingresar.
     * @return array Arreglo con los datos de la fila ingresada.
     */
    public function createClase($data)
    {
        try {
            // Esto hace que sin importar los pares de clave y valor de la variable $data, el $query sea reutilizable.
            $keys = array_keys($data);
            $keysString = implode(", ", $keys);

            $values = array_values($data);
            $valuesString = implode("', '", $values);
            $query = "insert into {$this->table}($keysString) values ('$valuesString')";
            var_dump("$query");

            $res = $this->db->query($query);

            if ($res) {
                $ultimoId = $this->db->insert_id;
                $data = $this->findClase($ultimoId);

                return $data;
            } else {
                return "No se pudo crear la clase";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function findClase($id)
    {
        $res = $this->db->query("select * from clases where id = $id");
        $data = $res->fetch_assoc();

        return $data;
    }

    public function updateClase($data)
    {
        // Esto hace que sin importar los pares de clave y valor de la variable $data, el $query sea reutilizable.
        $updatePairs = [];

        foreach ($data as $key => $value) {
            // Excluir columnas específicas si es necesario
            if ($key !== 'nombre' && $key !== 'maestro_id') {
                $updatePairs[] = "$key = '$value'";
            }
        }

        session_start();

        // Agrega la columna maestro_id a la lista de pares para actualizar
        $updatePairs[] = "maestro_id = '{$data["maestro_id"]}'";

        $query = "UPDATE {$this->table} SET " . implode(", ", $updatePairs) . " WHERE id = '{$_SESSION["claseid_edit"]}'";

        // Imprime la consulta para depuración
        var_dump($query);

        $this->db->query($query);
    }

    public function destroyClase($id)
    {
        // Lógica específica para la tabla de clases si es necesario
        // ...

        // Llamada al método destroy genérico
        $this->destroy($id);
    }

    /**
     * Método para obtener un alumno por su ID.
     *
     * @param integer $id ID del alumno.
     * @return array|null Arreglo con los datos del alumno o null si no se encuentra.
     */
    public function findMaestro()
    {
        $query = "SELECT usuarios.id, usuarios.nombre, usuarios.correo, usuarios.direccion, usuarios.fec_nac, clases.nombre as clase_asignada
        FROM usuarios
        LEFT JOIN clases ON usuarios.clase_id = clases.id
        WHERE usuarios.rol_id = 2";

        $res = $this->db->query($query);
        $data = $res->fetch_all(MYSQLI_ASSOC);

        return $data;
    }


    /**
     * Método para crear un nuevo registro en la tabla.
     *
     * @param array $data Arreglo asociativo con los datos a ingresar.
     * @return array Arreglo con los datos de la fila ingresada.
     */
    public function createMaestro($data)
    {
        try {
            // Esto hace que sin importar los pares de clave y valor de la variable $data, el $query sea reutilizable.
            $keys = array_keys($data);
            $keysString = implode(", ", $keys);

            $values = array_values($data);
            $valuesString = implode("', '", $values);
            $query = "insert into {$this->table}($keysString) values ('$valuesString')";
            var_dump("$query");

            $res = $this->db->query($query);

            if ($res) {
                $ultimoId = $this->db->insert_id;
                $data = $this->findClase($ultimoId);

                return $data;
            } else {
                return "No se pudo crear la clase";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    


    /**
     * Método para actualizar un alumno.
     *
     * @param array $data Arreglo asociativo con los datos a actualizar.
     * @return void
     */
    public function updateMaestro($data)
    {
        // Este array almacenará los pares columna-valor para la consulta de actualización
        $updatePairs = [];

        foreach ($data as $key => $value) {
            // Excluir la columna 'correo' de la actualización
            if ($key !== 'correo') {
                $updatePairs[] = "$key = '$value'";
            }
        }

        // Construir la consulta de actualización en la tabla 'usuarios'
        session_start();
        $userId = $_SESSION["maestroid_edit"];
        $query = "UPDATE usuarios SET " . implode(", ", $updatePairs) . " WHERE id = '$userId' AND rol_id = 2";

        $this->db->query($query);
    }

    /**
     * Método para eliminar un alumno por su ID.
     *
     * @param integer $id ID del alumno a eliminar.
     * @return void
     */
    public function destroyMaestro($id)
    {
        // Llamada al método destroy genérico
        $this->destroy($id);
    }


    /**
     * Método para obtener un alumno por su ID.
     *
     * @param integer $id ID del alumno.
     * @return array|null Arreglo con los datos del alumno o null si no se encuentra.
     */
    public function findAlumno($id)
    {
        $res = $this->db->query("SELECT * FROM usuarios WHERE rol_id = 3 AND id = $id");
        $data = $res->fetch_assoc();

        return $data;
    }

    /**
     * Método para crear un nuevo alumno.
     *
     * @param array $data Arreglo asociativo con los datos del nuevo alumno.
     * @return array|null Arreglo con los datos del nuevo alumno o null si no se pudo crear.
     */
    public function createAlumno($data)
    {
        // Asegúrate de que el rol sea el correspondiente al alumno
        $data['rol_id'] = 3;

        try {
            // Esto hace que sin importar los pares de clave y valor de la variable $data, el $query sea reutilizable.
            $keys = array_keys($data);
            $keysString = implode(", ", $keys);

            $values = array_values($data);
            $valuesString = implode("', '", $values);

            // Construir el query de inserción en la tabla 'usuarios'
            $query = "INSERT INTO {$this->table}($keysString) VALUES ('$valuesString')";

            echo "Query: " . $query;

            $res = $this->db->query($query);

            if ($res) {
                $ultimoId = $this->db->insert_id;
                $data = $this->findAlumno($ultimoId);

                return $data;
            } else {
                return null;
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Método para actualizar un alumno.
     *
     * @param array $data Arreglo asociativo con los datos a actualizar.
     * @return void
     */
    public function updateAlumno($data)
    {
        // Este array almacenará los pares columna-valor para la consulta de actualización
        $updatePairs = [];

        foreach ($data as $key => $value) {
            // Excluir la columna 'correo' de la actualización
            if ($key !== 'correo') {
                $updatePairs[] = "$key = '$value'";
            }
        }

        // Construir la consulta de actualización en la tabla 'usuarios'
        session_start();
        $userId = $_SESSION["alumnoid_edit"];
        $query = "UPDATE usuarios SET " . implode(", ", $updatePairs) . " WHERE id = '$userId' AND rol_id = 3";

        $this->db->query($query);
    }

    /**
     * Método para eliminar un alumno por su ID.
     *
     * @param integer $id ID del alumno a eliminar.
     * @return void
     */
    public function destroyAlumno($id)
    {
        // Llamada al método destroy genérico
        $this->destroy($id);
    }

    /**
     * Método para encontrar un dato utilizando la columna, operador y valor.
     *
     * @param string $column Columna de la tabla en la que se quiere buscar.
     * @param string $operator Operador para hacer la comparación. Ej: =, !=, <, >, etc.
     * @param string $value Valor a encontrar en la columna.
     * 
     * @return array Data encontrada.
     */
    public function where($column, $operator, $value)
    {
        $res = $this->db->query("select * from {$this->table} where $column $operator '$value'");
        $data = $res->fetch_all(MYSQLI_ASSOC);

        return $data;
    }
    
    public function customQuery($queryString)
    {
        $res = $this->db->query($queryString);
        return $res;
    }
}
