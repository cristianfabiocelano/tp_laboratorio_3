<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML5-Listado de Empleados</title>
</head>
</html>
<?php
include_once "Empleado.php";
$path ="../archivos/empleados.txt";

$file=fopen($path,"r");
echo "<h2>Listado de Empleados</h2>";
echo "<table align='Center'>";
echo "<tr><td colspan='2' ><h4>info</h4></td></td>";
echo "<tr><td colspan='2'><hr></td></td>";

while(!feof($file))
{
    $stringCompleto = fgets($file);
    $stringCompleto=trim($stringCompleto);
    $arrayEmp= explode("-",$stringCompleto);
    //var_dump( $arrayEmp);
    echo "<tr>";
    if(count($arrayEmp)>1)
    {   
        $emp = new Empleado($arrayEmp[0],$arrayEmp[1],$arrayEmp[2],$arrayEmp[3],$arrayEmp[4],$arrayEmp[5],$arrayEmp[6]);
        echo "<td>".$emp->ToString()."</td>";
        echo '<td> <a href="Eliminar.php?leg='.$emp->GetLegajo().'"> Eliminar </a> </td>';   
    }
    echo "</tr>";
}  
echo "<tr><td colspan='2'><hr></td></td>";
echo "</table>";

    fclose($file);
    
    echo "<a href='../index.html'> Alta de Empleados </a>";
    

?>