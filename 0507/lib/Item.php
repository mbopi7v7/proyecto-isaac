<?php
class Item {
    private $con;
    private $tabla;

    public function __construct($con, $modulo) {
        $this->con = $con;
        // Definir la tabla según el módulo
        switch ($modulo) {
            case "Eventos":
                $this->tabla = "eventos";
                break;
            case "Cursos":
                $this->tabla = "cursos";
                break;
            case "Productos":
                $this->tabla = "productos";
                break;
            default:
                $this->tabla = "eventos"; // por defecto
        }
    }

    // Obtener todos los registros
    public function getALL() {
        $sql = "SELECT * FROM ".$this->tabla;
        return $this->con->query($sql);
    }

    // Obtener un registro por ID
    public function getById($id) {
        $sql = "SELECT * FROM ".$this->tabla." WHERE id=".intval($id);
        return $this->con->query($sql)->fetch_assoc();
    }

    // Insertar nuevo registro
    public function insert($data) {
        // Ajustar según columnas de cada tabla
        $cols = implode(",", array_keys($data));
        $vals = "'".implode("','", array_values($data))."'";
        $sql = "INSERT INTO ".$this->tabla." ($cols) VALUES ($vals)";
        return $this->con->query($sql);
    }

    // Actualizar registro
    public function update($id, $data) {
        $set = [];
        foreach ($data as $col=>$val) {
            $set[] = "$col='$val'";
        }
        $sql = "UPDATE ".$this->tabla." SET ".implode(",", $set)." WHERE id=".intval($id);
        return $this->con->query($sql);
    }

    // Borrar registro
    public function delete($id) {
        $sql = "DELETE FROM ".$this->tabla." WHERE id=".intval($id);
        return $this->con->query($sql);
    }
}
?>
