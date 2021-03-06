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
    function headerAdmin($data=""){
        $view_header = "Views/Template/header_admin.php";
        require_once($view_header);
    }
    function footerAdmin($data=""){
        $view_footer = "Views/Template/footer_admin.php";
        require_once($view_footer);
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
        $view_modal = "Views/Template/Modals/{$nameModal}.php";
        require_once $view_modal;
    }

    //Copiar funcion de eliminar espacios despues 
    function strClean($strCadena){
        $string = preg_replace('/\s\s+/', ' ', $strCadena);
        $string = trim($string);
        $string = stripslashes($string);
        $string = str_ireplace("<>","",$string);
        $string = str_ireplace("</script>","",$string);
        $string = str_ireplace("< src>","",$string);
        $string = str_ireplace("< type=>","",$string);
        $string = str_ireplace("SELECT * FROM","",$string);
        $string = str_ireplace("DELETE * FROM","",$string);
        $string = str_ireplace("INSERT INTO","",$string);
        $string = str_ireplace("DROP TABLE","",$string);
        $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
        $string = str_ireplace("OR '1'='1'","",$string);
        $string = str_ireplace('OR "1"="1"',"",$string);
        $string = str_ireplace('OR ´1´=´1´',"",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("LIKE '","",$string);
        $string = str_ireplace('LIKE "',"",$string);
        $string = str_ireplace("LIKE ´","",$string);
        $string = str_ireplace("OR 'a'='a","",$string);
        $string = str_ireplace('OR "a"="a',"",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("--","",$string);
        $string = str_ireplace("^","",$string);
        $string = str_ireplace("[","",$string);
        $string = str_ireplace("]","",$string);
        $string = str_ireplace("==","",$string);

        return $string;
    }

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
    //Envio de Correos
    function sendEmail($data,$template)
    {
        $asunto = $data['asunto'];
        $emailDestino = $data['email'];
        $empresa = NOMBRE_REMITENTE;
        $remitente = EMAIL_REMITENTE;
        //ENVIO DE CORREO
        $de = "MIME-Version: 1.0\r\n";
        $de .= "Content-type: text/html; charset=UTF-8\r\n";
        $de .= "From: {$empresa} <{$remitente}>\r\n";
        ob_start();
        require_once("Views/Template/Email/".$template.".php");
        $mensaje = ob_get_clean();
        $send = mail($emailDestino, $asunto, $mensaje, $de);
        return $send;
    }
?>
