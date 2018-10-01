<?php
include_once "Empleado.php";
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
    echo $emp->ToString();
}
else
{
    header("Location: Mostrar.php");
}
?>