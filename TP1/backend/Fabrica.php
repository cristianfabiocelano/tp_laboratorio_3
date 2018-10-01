<?php
include_once "Empleado.php";
include_once "Interfaces.php";

class Fabrica implements IArchivo{
    private $_cantidadMaxima;//int
    private $_empleados;//Array Empleado
    private $_razonSocial;//string

    public function __construct($razonSocial , $cantidadMaxima=5)
    {
        $this->_razonSocial=$razonSocial;
        $this->_empleados=array();
        $this->_cantidadMaxima= $cantidadMaxima;
    }

    public function AgregarEmpleados($emp)
    {
        $retorno=false;
        if((count($this->_empleados)) < $this->_cantidadMaxima)
        {
            array_push($this->_empleados, $emp);
            $retorno=true;
            $this->EliminarEmpleadosRepetidos();
        }
        return $retorno;
    }

    public function CalcularSueldos()
    {
        $acum=0;

        foreach ($this->_empleados as $emp) {
            $acum += $emp->GetSueldo();
        } 
        return $acum;
    }

    public function EliminarEmpleado($emp)
    {
        $retorno=false;
    
        foreach ($this->_empleados as $empleado) {
            
            if(($emp->GetLegajo()) == ($empleado->GetLegajo()))
            {
                $indice= array_search($emp,$this->_empleados);
                unset($this->_empleados[$indice]);
                $retorno=true;
                break;
            }
                    
        } 
        return $retorno;
    }

    private function EliminarEmpleadosRepetidos ()
    {
        
        $this->_empleados =array_unique($this->_empleados,SORT_REGULAR );
        
    }

    public function ToString()
    {
        $retorno="{$this->_razonSocial}_";
        
        foreach ($this->_empleados as $emp) {
            $retorno .= $emp->ToString();
        }

        return $retorno;
    }

    //implemento de interface
    public function TraerDeArchivo($nombreArchivo)
    {
        $path="../archivos/".$nombreArchivo;
        $file=fopen($path,"r");

        while(!feof($file))
        {
            $stringCompleto = fgets($file);
            $stringCompleto=trim($stringCompleto);
            $arrayEmp= explode("-",$stringCompleto);
            
            if(count($arrayEmp)>1)
            {
                $emp = new Empleado($arrayEmp[0],$arrayEmp[1],$arrayEmp[2],$arrayEmp[3],$arrayEmp[4],$arrayEmp[5],$arrayEmp[6]);
                $this->AgregarEmpleados($emp);
            }
        }    
        fclose($file);
    }

    public function GuardarEnArchivo($nombreArchivo)
    {
        $path ="../archivos/".$nombreArchivo;
        $file = fopen($path, "w");
        $txtListo="";

        foreach ($this->_empleados as $empleado)
        {
            
            $txtListo .= $empleado->ToString();           
        } 

        fwrite($file,$txtListo);
        fclose($file);
    }
}

?>
