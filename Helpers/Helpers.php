<?php
    //Retorna la Ruta del proyecto
    function base_url()
    {
        return BASE_URL;
    }
    //Retorna la url del Assets
    function media(){
        return BASE_URL."Assets/";
    }
    //Muestra la informacion en un formato
    function dep($data)
    {
        $format = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('</pre>');
        return $format;
    }
    function getModal(string $nameModal, $data){
        $view_modal = "views/Templates/{$nameModal}.php";
        require_once $view_modal;
    }

    //Copiar funcion de eliminar espacios despues 


    //Generar contraseñas 
    function passGenerador($length = 10)
    {
        $pass ="";
        $longitudPass=$length;
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena=strlen($cadena);
        for ($i=1; $i <=$longitudPass; $i++) { 
            $pos = rand(0,$longitudCadena-1);
            $pass .= substr($cadena,$pos,1);
        }
        return $pass;
    }
    //generar token
    function token()
    {
        $r1 = bin2hex(random_bytes(10));
        $r2 = bin2hex(random_bytes(10));
        $r3 = bin2hex(random_bytes(10));
        $r4 = bin2hex(random_bytes(10));
        return $r1.'-'.$r2.'-'.$r3.'-'.$r4;
    }
    //Formato para valores monetarios 
    function formatMoney($cantidad)
    {
        return number_format($cantidad,2,SPD,SPM);
    }
?>
