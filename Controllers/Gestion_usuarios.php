<?php
class Gestion_usuarios extends Controllers{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function gestion_usuarios(){
        $data['tag_page'] = "Gestión de Usuarios";
        $data['page_title'] = "Gestión de Usuario ";
        $data['page_name'] = "Gestión de Roles de Usuario";
        
       $this->views->getView($this,"gestion_usuarios",$data);
    }
}
?>