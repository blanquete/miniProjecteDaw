<?php

    class ClauValor
    {
        private $id;
        private $valor;

        function __constructor($id_, $valor_)
        {
            $this->id = $id_;
            $this->valor = $valor_;
        }

        public function getId()
        {
            return $this->id;
        }
        public function setId($value)
        {
            $this->id = $value;
        }

        public function getValor()
        {
            return $this->valor;
        }
        public function setValor($value)
        {
            $this->valor = $value;
        }
    }

?>