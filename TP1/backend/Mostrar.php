<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../javascript/AdministrarModificar.js"></script>
    <title>HTML5-Listado de Empleados</title>
    
</head>
</html>
<?php
include_once "validarSesion.php";

validarSesion();

include_once "Empleado.php";

    $path ="../archivos/empleados.txt";

    $file=fopen($path,"r");
    echo "<h2>Listado de Empleados</h2>";
    echo "<a href='./cerrarSesion.php' align='Right'>  <h5>Desloguearse</h5> </a>";
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
            $emp->SetPathFoto($arrayEmp[7]);
            echo "<td>".$emp->ToString()."</td>";
            echo "<td> <img src='".$emp->GetPathFoto()."' width='90px' height='90px'></td>";
            echo '<td> <a href="Eliminar.php?leg='.$emp->GetLegajo().'"> Eliminar </a> </td>';   
            echo '<td><input type="button" value="Modificar"  id="btnModificar" onclick="AdministrarModificar('.$emp->GetDni().')"></td>';   

        }
        echo "</tr>";
    }  
    echo "<tr><td colspan='2'><hr></td></td>";
    echo "</table>";

        fclose($file);
        
        echo "<a href='../index.php'> Alta de Empleados </a>";
        echo '<form id="frmModificar" action="../index.php" method="POST">
             <input type="hidden" name="modificar" id="modificar">
             </form>';
    

?>