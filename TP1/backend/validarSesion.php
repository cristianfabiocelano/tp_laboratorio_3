<?php

function validarSesion(){
    session_start();
    if($_SESSION["DNIEmpleado"]){
        return true;
    }
    else
    {
        if(file_exists('../Login.html'))
        header("Location: ../Login.html");
        if(file_exists('./Login.html'))
        header("Location: ./Login.html");
        
    }

}

?>