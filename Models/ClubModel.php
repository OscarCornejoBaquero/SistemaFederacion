<?php
/*Llamado a los archivos requeridos de la clase*/
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
    /*Funcion que permite seleccionar un club recibe como parametro el Id del club a seleccionar */
    public function selectClub(int $idClub){
        $idClub = $idClub;
        $sql = "SELECT *
                FROM `club` WHERE id_club = $idClub";
        $request = $this->select($sql);
        return $request;
    }
    /*Funcion que selecciona todos los clubs no recibe parametros */
    public function selectClubs()
    {
        //creacion del query para solicitar los datos
        $sql = "SELECT * FROM club WHERE status !=0";
        //Llamado al metodo select_all donde se ejecuta la consulta a la base de datos
        //en la clase Mysql
        $request = $this->select_all($sql);
        return $request;
    }
    /*Funcion que recibe como parametro un Objeto tipo club y procede a insertar un club a la
    base de datos */
    public function insertClub(ObjClub $objClub){
        try {
            //Se asigna al objetio club de la clase el club recibido
            $this->objClub = $objClub;
            $sql = "SELECT * FROM club WHERE
					codigo_club = '{$this->objClub->getCodigoClub()}'";
            $request = $this->select_all($sql);
            $this->valExcepcionesClub->validarQueryInsertar($request);
            $query_insert  = "INSERT INTO club(`codigo_club`, `nombre_club`, `correo_club`,
                                                `asociacion_futbol`, `direccion_club`,
                                                `fecha_fundacion`, `presidente`, `status`)
								  VALUES(?,?,?,?,?,?,?,?)";
            //Ingreso de los datos obtenidos a un arreglo de datos
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
    /*Funcion que recibe como parametro un Objeto tipo club y procede a actualizar un club a la
    base de datos */
    public function updateColegiado(ObjClub $objClub){
        $this->objClub = $objClub;
        $sql = "SELECT * FROM club WHERE (id_club = '{$this->objClub->getIdClub()}') ";
        $request = $this->select_all($sql);
        try {
            $this->valExcepcionesClub->validarQueryInsertar($request);
            $sql = "UPDATE club SET codigo_club=?, nombre_club=?, correo_club=?, asociacion_futbol=?,
                            direccion_club=?,fecha_fundacion=?,presidente=?,status=?
							WHERE id_club = '{$this->objClub->getIdClub()}' ";
            //Ingreso de los datos obtenidos a un arreglo de datos
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

    /*Funcion que permite eliminar un club recibiendo un ID*/
    public function eliminarClub(int $id_club)
    {
        $id_club = $id_club;
        $sql = "DELETE FROM `club` WHERE id_club = 1";

        $request = $this->delete($sql);
        return $request;
    }

}
