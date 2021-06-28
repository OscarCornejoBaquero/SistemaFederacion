<?php
    class Views{

        function getView($controlller,$view,$data=""){
            $controlller = get_class($controlller);
            if($controlller == "Home"){
                $view = "Views/".$view.".php";
            }else{
                $view = "Views/".$controlller."/".$view.".php";
            }
            require_once ($view);

        }

    }
?>