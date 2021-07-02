<?php
class Dashboard extends Controllers{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function dashboard(){
        $data['tag_page'] = "Dahsboard";
        $data['page_title'] = "Página de jejeje Correcto llamado";
        $data['page_name'] = "listo";
        
       $this->views->getView($this,"dashboard",$data);
    }
}
?>