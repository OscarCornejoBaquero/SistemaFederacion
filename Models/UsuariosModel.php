<?php
require_once("Controllers/ExcepcionesUsuarios.php");
require_once ("Librerias/Objetos/ObjPersona.php");
	class UsuariosModel extends Mysql
	{
	    private ObjPersona $objPersona;
        private ErrorsUsuarios $valExcepcionesUsuario;
		public function __construct()
		{
			parent::__construct();
            $this->valExcepcionesUsuario = new ErrorsUsuarios();
		}	
        public function insertUsuario(ObjPersona $objPersona){
            try {
                $this->objPersona = $objPersona;
                $sql = "SELECT * FROM persona WHERE 
					email_user = '{$this->objPersona->getEmail()}' or cedula = '{$this->objPersona->getCedula()}' ";
                $request = $this->select_all($sql);
                $this->valExcepcionesUsuario->validarQueryInsertar($request);
                $query_insert  = "INSERT INTO persona(cedula,nombres,apellidos,telefono,email_user,password,id_rol,status) 
								  VALUES(?,?,?,?,?,?,?,?)";
                $arrData = array($this->objPersona->getCedula(),
                    $this->objPersona->getNombre(),
                    $this->objPersona->getApellidos(),
                    $this->objPersona->getTelefono(),
                    $this->objPersona->getEmail(),
                    $this->objPersona->getPassword(),
                    $this->objPersona->getTipoId(),
                    $this->objPersona->getStatus());
                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;
            }catch (Exception $e){
                $return = $e->getMessage();
            }
            return $return;
        }

        public function updateUsuario(ObjPersona $objPersona){
            $this->objPersona = $objPersona;
            $sql = "SELECT * FROM persona WHERE (email_user = '{$this->objPersona->getEmail()}' AND idpersona != '{$this->objPersona->getIdPersona()}')
										  OR (cedula = '{$this->objPersona->getCedula()}' AND idpersona != '{$this->objPersona->getIdPersona()}') ";
            $request = $this->select_all($sql);
            try {
                $this->valExcepcionesUsuario->validarQueryInsertar($request);
                if(empty($this->objPersona->getPassword()))
                {
                    $sql = "UPDATE persona SET cedula=?, nombres=?, apellidos=?, telefono=?, email_user=?, password=?, id_rol=?, status=? 
							WHERE idpersona = '{$this->objPersona->getIdPersona()}' ";
                    $arrData = array($this->objPersona->getCedula(),
                        $this->objPersona->getNombre(),
                        $this->objPersona->getApellidos(),
                        $this->objPersona->getTelefono(),
                        $this->objPersona->getEmail(),
                        $this->objPersona->getPassword(),
                        $this->objPersona->getTipoId(),
                        $this->objPersona->getStatus());
                }else{
                    $sql = "UPDATE persona SET cedula=?, nombres=?, apellidos=?, telefono=?, email_user=?, password=?, id_rol=?, status=? 
							WHERE idpersona = '{$this->objPersona->getIdPersona()}' ";
                    $arrData = array($this->objPersona->getCedula(),
                        $this->objPersona->getNombre(),
                        $this->objPersona->getApellidos(),
                        $this->objPersona->getTelefono(),
                        $this->objPersona->getEmail(),
                        $this->objPersona->getPassword(),
                        $this->objPersona->getTipoId(),
                        $this->objPersona->getStatus());
                }
                $request = $this->update($sql,$arrData);
            }catch (Exception $e){
                $request = $e->getMessage();
            }
            return $request;
        }

        public function selectUsuarios()
		{
			$sql = "SELECT p.idpersona,p.cedula,p.nombres,p.apellidos,p.telefono,p.email_user,p.status,r.nombre_rol 
					FROM persona p 
					INNER JOIN rol r
					ON p.id_rol = r.id_rol
					WHERE p.status != 0 ";
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectUsuario(int $idpersona){
			$this->intIdUsuario = $idpersona;
			$sql = "SELECT p.idpersona,p.cedula,p.nombres,p.apellidos,p.telefono,p.email_user,r.id_rol,r.nombre_rol,p.status, DATE_FORMAT(p.datecreated, '%d-%m-%Y') as fechaRegistro 
					FROM persona p
					INNER JOIN rol r
					ON p.id_rol = r.id_rol
					WHERE p.idpersona = $this->intIdUsuario";
			$request = $this->select($sql);
			return $request;
		}

		public function deleteUsuario(int $intIdpersona)
		{
			$this->intIdUsuario = $intIdpersona;
			$sql = "UPDATE persona SET status = ? WHERE idpersona = $this->intIdUsuario ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

	}
 ?>