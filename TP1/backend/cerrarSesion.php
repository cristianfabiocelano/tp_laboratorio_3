<?php

    session_start();
    if($_SESSION["DNIEmpleado"]){
        session_unset();
        session_destroy();
    }
    header('Location: ../login.html');

?>