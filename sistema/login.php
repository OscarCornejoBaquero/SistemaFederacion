<?php

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, 
    minumun-scale=1.0">
    <title>Federación de Arbritos</title>
    <link rel="stylesheet" href="../../SistemaFederacionArbritos/sistema/librerias/css/estilosLogin/style.css">

</head>
<body>
    <section id="container">
        <form action="index.php" method="post">

            <h3>Iniciar Sesión</h3>
            
            <img src="../../SistemaFederacionArbritos/archivos/img/login2.png" alt="Login">


            <input type="text" name="Usuario" placeholder="Usuario">
            <input type="password" name="Clave" placeholder="Contraseña">
            <div class="alert" style="  text-align: center;color: red;"><?php echo (isset($alert)? $alert :'' ) ?> </div>
            <input type="submit" value="INGRESAR">
            
        </form>
    
    </section>

</body>
</html>