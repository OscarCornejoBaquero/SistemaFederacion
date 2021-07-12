<?php
    class PermisosModel extends Mysql{
        public $int_id_permiso;
        public $int_rol;
        public $int_modulo_id;
        public $read;
        public $write;
        public $update;
        public $delete;

        public function __construct()
        {
           parent::__construct();
        }

        public function selectModulos(){
            $sql = "SELECT * FROM modulo WHERE status != 0";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectPermisosRol(int $idRol){
            $this->int_rol = $idRol;
            $sql = "SELECT * FROM permisos WHERE id_rol = $this->int_rol";
            $request = $this->select_all($sql);
            return $request;
        }

        public function deletePermisos(int $id_rol)
        {
            $this->int_rol = $id_rol;
            $sql = "DELETE FROM permisos WHERE id_rol = $this->int_rol";
            $request = $this->delete($sql);
            return $request;
        }
        public function insertPermisos(int $intIdrol, int $idModulo, int $read, int $write, int $update, int $delete)
        {
            
            $this->int_rol = $intIdrol;
            $this->int_modulo_id = $idModulo;
            $this->read = $read;
            $this->write = $write;
            $this->update = $update;
            $this->delete = $delete;
            $query_insert = "INSERT INTO `permisos`(`id_rol`, `id_modulo`, `read_permiso`, `write_permiso`, `update_permiso`, `delete_permiso`) VALUES (?,?,?,?,?,?)";
            $arrData = array($this->int_rol, $this->int_modulo_id,$this->read,$this->write,$this->update,$this->delete);
            $request_insert = $this->insert($query_insert,$arrData);
            return $request_insert;
        }
    }
?>