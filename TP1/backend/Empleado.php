<?php 
    include_once "Persona.php";


    class Empleado extends Persona{
        protected $_legajo;//int
        protected $_sueldo;//Double
        protected $_turno;//string

        public function __construct($nombre,$apellido,$dni,$sexo,$legajo,$sueldo,$turno)
        {
            parent::__construct($nombre,$apellido,$dni,$sexo);
            $this->_legajo=$legajo;
            $this->_sueldo=$sueldo;
            $this->_turno=$turno;
        }

        public function GetLegajo()
        {
            return $this->_legajo;
        }
        public function GetSueldo()
        {
            return $this->_sueldo;
        }
        public function GetTurno()
        {
            return $this->_turno;
        }
        
        public function Hablar($idioma)
        {
            return "El empleado habla {$idioma}"; 
        }

        public function ToString()
        {
            return parent::ToString()."-{$this->_legajo}-{$this->_sueldo}-{$this->_turno}\r\n";
        }
    }




?>