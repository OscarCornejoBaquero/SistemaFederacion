<?php

require_once("Controllers/ExcepcionesClub.php");
require_once ("Librerias/Objetos/ObjClub.php");
class ClubModel extends Mysql
{
    private ObjClub $objClub;
    private ErrorsClub $valExcepcionesClub;
    public function __construct()
    {
        parent::__construct();
        $this->valExcepcionesClub = new ErrorsClub();
    }

    public function selectClub(int $idClub){
        $idClub = $idClub;
        $sql = "SELECT *
                FROM `club` WHERE id_club = $idClub";
        $request = $this->select($sql);
        return $request;
    }
    public function selectClubs()
    {
        //creacion del query para solicitar los datos
        $sql = "SELECT * FROM club WHERE status !=0";
        //Llamado al metodo select_all donde se ejecuta la consulta a la base de datos
        //en la clase Mysql
        $request = $this->select_all($sql);
        return $request;
    }
    public function insertClub(ObjClub $objClub){
        try {
            $this->objClub = $objClub;
            $sql = "SELECT * FROM club WHERE 
					codigo_club = '{$this->objClub->getCodigoClub()}'";
            $request = $this->select_all($sql);
            $this->valExcepcionesClub->validarQueryInsertar($request);
            $query_insert  = "INSERT INTO club(`codigo_club`, `nombre_club`, `correo_club`, 
                                                `asociacion_futbol`, `direccion_club`, 
                                                `fecha_fundacion`, `presidente`, `status`) 
								  VALUES(?,?,?,?,?,?,?,?)";
            $arrData = array($this->objClub->getCodigoClub(),
                $this->objClub->getNombreClub(),
                $this->objClub->getCorreoClub(),
                $this->objClub->getAsociacionFutbol(),
                $this->objClub->getDireccionClub(),
                $this->objClub->getFechaFundacion(),
                $this->objClub->getPresidente(),
                $this->objClub->getStatus());
            $request_insert = $this->insert($query_insert,$arrData);
            $return = $request_insert;
        }catch (Exception $e){
            $return = $e->getMessage();
        }
        return $return;
    }

    public function updateColegiado(ObjClub $objColegiado){
        $this->objClub = $objColegiado;
        $sql = "SELECT * FROM club WHERE (id_club = '{$this->objClub->getIdClub()}') ";
        $request = $this->select_all($sql);
        try {
            //$this->valExcepcionesColegiados->validarQueryInsertar($request);
            $sql = "UPDATE club SET codigo_club=?, nombre_club=?, correo_club=?, asociacion_futbol=?,
                            direccion_club=?,fecha_fundacion=?,presidente=?,status=?
							WHERE id_club = '{$this->objClub->getIdClub()}' ";
            $arrData = array(
                $this->objClub->getCodigoClub(),
                $this->objClub->getNombreClub(),
                $this->objClub->getCorreoClub(),
                $this->objClub->getAsociacionFutbol(),
                $this->objClub->getDireccionClub(),
                $this->objClub->getFechaFundacion(),
                $this->objClub->getPresidente(),
                $this->objClub->getStatus());

            $request = $this->update($sql,$arrData);
        }catch (Exception $e){
            $request = $e->getMessage();
        }
        return $request;
    }


    public function deleteClub(int $id_club)
    {
        $id_club = $id_club;
        $sql = "DELETE FROM `club` WHERE id_club = $id_club";

        $request = $this->delete($sql);
        return $request;
    }

}