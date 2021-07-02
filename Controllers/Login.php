<?php
class login extends Controllers{
    public function __construct()
    {
        parent::__construct();
    }
    public function Login(){
        $data['tag_page'] = "Home";
        $data['page_title'] = "Página prueba pepa";
        $data['page_name'] = "home";
       $this->views->getView($this,"login",$data);
       
    }

}
?>