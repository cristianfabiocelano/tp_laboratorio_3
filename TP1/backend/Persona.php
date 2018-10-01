<?php 
    abstract class Persona{

        private $_apellido;//string
        private $_dni;//int
        private $_nombre;//string
        private $_sexo;//char f/m

        public function __construct($nombre ,$apellido,$dni,$sexo) 
        {
            $this->_nombre = $nombre;
            $this->_apellido = $apellido;
            $this->_dni = $dni;
            $this->_sexo = $sexo;
        }

        public function GetApellido()
        {
            return $this->_apellido;
        }
        public function GetNombre()
        {
            return $this->_nombre;
        }
        public function GetSexo()
        {
            return $this->_sexo;
        }
        public function GetDni()
        {
            return $this->_dni;
        }

        abstract public function Hablar($idioma);

        public function ToString()
        {
            return "{$this->_nombre}-{$this->_apellido}-{$this->_dni}-{$this->_sexo}";
        }
    }
?>