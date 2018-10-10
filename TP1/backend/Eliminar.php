<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redireccion</title>
</head>
<body>
    
</body>
</html>
<?php
include_once "Empleado.php";
include_once "Fabrica.php";

$legajo = $_GET["leg"];

$path="../archivos/empleados.txt";
$file=fopen($path,"r+");
$noEstaEmpleado=true;
while(!feof($file))
{

    $stringCompleto = fgets($file);
    $stringCompleto=trim($stringCompleto);
    $arrayEmp= explode("-",$stringCompleto);
    if(count($arrayEmp)>1)
    { 
        if($arrayEmp[4]==$legajo)
        {   
            $noEstaEmpleado=false;
            $emp1 = new Empleado($arrayEmp[0],$arrayEmp[1],$arrayEmp[2],$arrayEmp[3],$arrayEmp[4],$arrayEmp[5],$arrayEmp[6]);
            $fab = new Fabrica("S.A",7);
            $fab->TraerDeArchivo("empleados.txt");
            if($fab->EliminarEmpleado($emp1))
            {
                $fab->GuardarEnArchivo("empleados.txt");
                echo "<h4>Empleado eliminado.</h4></br>";
            }
            else
            {
                echo "<h4>No se pudo eliminar.</h4></br>";
            }
        }
    }

}
fclose($file);
if($noEstaEmpleado)
{
    echo "<h4>Empleado no encontrado.</h4></br>";
}
echo "<a href='../index.php'> Dar alta a empleado </a> </br> <a href='Mostrar.php'> Mostrar Empleados </a>";

?>