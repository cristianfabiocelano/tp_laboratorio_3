<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once "/backend/Fabrica.php";
    $nombrePagina = "HTML 5 - Formulario Alta Empleado";
        $titulo = "Alta de empleado";
        $botonTxt = "Enviar";
        $dni = "";
        $apellido = "";
        $nombre = "";
        $sexo = "";
        $sexoD="selected";
        $sexoM="";
        $sexoF="";
        $legajo = "";
        $sueldo = "";
        $turno="";
        $turnoM="checked";
        $turnoT="";
        $turnoN="";
        $readOnly = "";
        $modificar = false;

        if(isset($_POST["modificar"])){
            $nombrePagina = "HTML 5 - Formulario Modificacion Empleado";
            $titulo = "Modificación de empleado";
            $botonTxt = "Modificar";
            
            $fabrica = new Fabrica("fabrica");
            $fabrica->TraerDeArchivo("empleados.txt");
            $empleados = $fabrica->GetEmpleados();
            foreach($empleados as $empleado){
                if($empleado->GetDni() == $_POST["modificar"]){
                    $dni = $empleado->GetDni();
                    $apellido = $empleado->GetApellido();
                    $nombre = $empleado->GetNombre();
                    $sexo = $empleado->GetSexo();
                    $legajo = $empleado->GetLegajo();
                    $sueldo = $empleado->GetSueldo();
                    $turno=$empleado->GetTurno(); 
                    $foto =$empleado->GetPathFoto();
                    $readOnly = "readonly";
                    $modificar = true;
                    $turnoM="";
                    $sexoD="";
                    
                    switch($sexo)
                    {
                        case"M":
                        $sexoM="selected";
                        break;
                        case"F":
                        $sexoF="selected";
                        break;

                    }

                    switch($turno)
                    {
                        case"Noche":
                        $turnoN="checked";
                        break;
                        case"Mañana":
                        $turnoM="checked";
                        break;
                        case"Tarde":
                        $turnoT="checked";
                        break;
                    }
                    break;                   
                }
            }
        }

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $nombrePagina; ?></title>
    <script src="javascript/funciones.js"></script>
    
</head>
<body>
<?php
        include_once "/backend/validarSesion.php"; 
        validarSesion();
    ?>
    <div id="Titulo">
        <h2><?php$titulo?></h2><?php echo "<a href='./backend/cerrarSesion.php' align='Right'>  <h5>Desloguearse</h5> </a>"; ?>
    </div>
    <center>
        <div name="Datos">
            <div name="Personales">

                <br>
                <form method="POST" id="FormularioDatos" name="FormularioDatos" enctype="multipart/form-data">
                    <div>
                        <table>
                            <tr>
                                <td colspan="2">
                                    <h4 align="center">Datos Personales</h4>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td>DNI: </td>
                                <td><input id="txtDni" name="txtDni" type="number" size="8" min="1000000" max="55000000" value=<?php echo $dni;?> <?php echo $readOnly;?>><span style="display:none" id="spanDni">*</span></td>
                            </tr>
                            <tr>
                                <td>Apellido: </td>
                                <td><input id="txtApellido" name="txtApellido" type="text" value=<?php echo $apellido;?>><span style="display:none" id="spanApellido">*</span></td>
                            </tr>
                            <tr>
                                <td>Nombre: </td>
                                <td><input id="txtNombre" name="txtNombre" type="text" value=<?php echo $nombre;?>><span style="display:none" id="spanNombre">*</span></td>
                            </tr>
                            <tr>
                                <td>Sexo: </td>
                                <td> <select  id="txtSexo" name="txtSexo">
                                        <option value="---" <?php echo $sexoD ?>>Seleccione</option>
                                        <option value="M" <?php echo $sexoM ?>>Masculino</option>
                                        <option value="F" <?php echo $sexoF ?>>Femenino</option>
                                    </select><span style="display:none" id="spanSexo">*</span></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h4 align="center">Datos Laborales</h4>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td>Legajo: </td>
                                <td><input type="number" id="txtLegajo" name="txtLegajo" min="100" max="550" value=<?php echo $legajo;?> <?php echo $readOnly;?> ><span style="display:none" id="spanLegajo">*</span></td>
                            </tr>
                            <tr>
                                <td>Sueldo: </td>
                                <td><input type="number" id="txtSueldo" name="txtSueldo" step="500" min="8000" max="25000" value=<?php echo $sueldo;?>><span style="display:none" id="spanSueldo">*</span></td>
                            </tr>
                            <tr>
                                <td>Turno: </td>
                                <td><input type="radio" name="TurnoM" id="RBtnTurnoMañana" value="Mañana" <?php echo $turnoM; ?>>Mañana <br>
                                    <input type="radio" name="TurnoT" id="RBtnTurnoTarde" value="Tarde" <?php echo $turnoT; ?>>Tarde <br>
                                    <input type="radio" name="TurnoN" id="RBtnTurnoNoche" value="Noche" <?php echo $turnoN; ?>>Noche
                                </td>
                            </tr>
                            <tr>
                                <td>Foto: </td>
                                <td> <input type="file" name="img" id="txtImg" ><span style="display:none" id="spanImg">*</span>
                                    <?php
                                    if($modificar){
                                    echo '<input type="hidden" name="hdnModificar" id="hdnModificar" value='.$dni.'>';
                                    }?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right">
                                    <input type="reset" value="Limpiar"  id="brnLimpiar"><br>
                                    <input type="button" value=<?php echo $botonTxt; ?>  id="btnEnviar" onclick="Validar.Validaciones.AdministrarValidaciones()">
                                </td>
                            </tr>
                        </table>
                        <div id="divEmpty"></div>
                    </div>
                </form>
            </div>
        </div>
    </center>
</body>

</html>