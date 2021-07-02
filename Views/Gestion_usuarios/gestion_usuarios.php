<!DOCTYPE html>
<html lang="es">
<head>
    <!--LLamado al Archivo head.php que contiene todos los atributos de la página-->
    <?php require_once "includes/head.php";?>
<!--    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
  crossorigin="anonymous"></script> -->
    <!--Llamado al archivo ViewsInicio que se usa para el contendio de la página de inicio-->
    <link rel="stylesheet" href="Librerias/css/estilosVistas/ViewsInicio.css">
    <link rel="stylesheet" href="<?=media()?>css/desing.css">
</head>

<body>
    <div class="contenedor_body">
    <!--Llamado al archivo header que contiene la cabecera del Sistema,
    junto con el Nav para todas las páginas-->
    <div>
        <!--Div para separar el Header y Nav-->
    <?php require_once "includes/header.php"?>
    </div>
    <?php getModal('modal', $data)?>
    <div class="app-content">
        <!--Div para separar el Main y Contenido de la página-->
        <!--Div para separar el Main y Contenido de la página-->
        <h3><?php echo $data['page_title'];?> 
        
        <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> Nuevo Usuario</button></h3>



    </div>
    
    </div>
    <!--LLamado del Footer de la Pagina Web-->
    <?php require_once "includes/footer.php"?>
    <!--Llamado al archivo de Scripts e incorporarlo en las páginas-->
    <?php require_once "includes/scripts.php"?>
</body>

</html>




