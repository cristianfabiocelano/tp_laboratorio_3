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
                echo "Empleado eliminado.</br>";
            }
            else
            {
                echo "No se pudo eliminar.</br>";
            }
        }
    }

}
fclose($file);
if($noEstaEmpleado)
{
    echo "Empleado no encontrado.</br>";
}
echo "<a href='../index.html'> index.html </a> </br> <a href='Mostrar.php'> Mostrar.php </a>";

?>