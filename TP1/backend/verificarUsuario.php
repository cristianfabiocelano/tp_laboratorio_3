<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verificar usu</title>
</head>
<body>
    
</body>
</html>
<?php
include_once "Empleado.php";
include_once "validarSesion.php";
/*if(validarSesion())
{
    session_name($_POST["apellido"]);
    session_start();
}*/
session_start();

$dni =  $_POST["dni"];
$apellido= $_POST["apellido"];

$path="../archivos/empleados.txt";
$file=fopen($path,"r");
$flagEstaEmpleado = false;
while(!feof($file))
{
    $stringCompleto = fgets($file);
    $stringCompleto=trim($stringCompleto);
    $arrayEmp= explode("-",$stringCompleto);
    
    if(count($arrayEmp)>1)
    {
        $emp = new Empleado($arrayEmp[0],$arrayEmp[1],$arrayEmp[2],$arrayEmp[3],$arrayEmp[4],$arrayEmp[5],$arrayEmp[6]);
        if($emp->GetDni()==$dni && $emp->GetApellido() ==$apellido)
        {
            $flagEstaEmpleado=true;
            break;
        }
    }
}    
fclose($file);
if(!$flagEstaEmpleado)
{
    echo "No se encontro el empleado <br><a href='../login.html'>Volver al login</a>";
    
}
else
{
    $_SESSION["DNIEmpleado"] = $dni;
    
    header("Location: Mostrar.php");
}
?>