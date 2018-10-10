<?php
    include_once "Empleado.php";
    include_once "Fabrica.php";

    $dni = $_POST["txtDni"];
    $nombre = $_POST["txtNombre"];
    $apellido = $_POST["txtApellido"];
    $sexo = $_POST["txtSexo"];
    $legajo = $_POST["txtLegajo"];
    $sueldo = $_POST["txtSueldo"];

    if(isset($_POST["TurnoM"])) 
    $turno = "Mañana";
    if(isset($_POST["TurnoT"]))
    $turno = "Tarde";
    if(isset($_POST["TurnoN"]))
    $turno = "Noche";



    $extencionesValidas=array('jpg', 'jpeg', 'gif', 'png', 'bmp');
    $extencion=pathinfo($_FILES['img']['name'],PATHINFO_EXTENSION);
    $path="fotos/".$dni."_".$apellido.".".$extencion;
    move_uploaded_file($_FILES['img']['tmp_name'],$path);
    if(!in_array($extencion,$extencionesValidas) || $_FILES['img']['size'] > 10000000 )
    {
        echo "FOTO INVALIDA!";
        
    }
    else{
        //move_uploaded_file($_FILES['img']['tmp_name'],$path);
        
    }

    $emp1 = new Empleado($nombre,$apellido,$dni,$sexo,$legajo,$sueldo,$turno);

    $emp1->SetPathFoto($path);

    $fab = new Fabrica("S.A",7);
    $fab->TraerDeArchivo("empleados.txt");
    $empleados = $fab->GetEmpleados();
    
    if(isset($_POST["hdnModificar"])){
        foreach($empleados as $empleadoV){
            if($empleadoV->GetDni() == $_POST["hdnModificar"]){
                $fab->EliminarEmpleado($empleadoV);
                break;
            }
        }
    }

    if($fab->AgregarEmpleados($emp1))
    {
        $fab->GuardarEnArchivo("empleados.txt");
        echo "<a href='Mostrar.php'> Mostrar php </a>";
    }
    else
    {
        echo "No se pudo agregar el empleado (Cantidad Maxima alcanzada)";
        echo "<a href='../index.php'> index html </a>";
    }


?>