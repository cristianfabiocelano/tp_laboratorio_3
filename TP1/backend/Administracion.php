<?php
    include_once "Empleado.php";
    include_once "Fabrica.php";

    $dni = $_POST["dni"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $sexo = $_POST["sexo"];
    $legajo = $_POST["legajo"];
    $sueldo = $_POST["sueldo"];
    $turno = $_POST["turno"];

    $emp1 = new Empleado($nombre,$apellido,$dni,$sexo,$legajo,$sueldo,$turno);
    $fab = new Fabrica("S.A",7);
    $fab->TraerDeArchivo("empleados.txt");
    if($fab->AgregarEmpleados($emp1))
    {
        $fab->GuardarEnArchivo("empleados.txt");
        echo "<a href='Mostrar.php'> Mostrar php </a>";
    }
    else
    {
        echo "No se pudo agregar el empleado (Cantidad Maxima alcanzada)";
        echo "<a href='../index.html'> index html </a>";
    }


?>