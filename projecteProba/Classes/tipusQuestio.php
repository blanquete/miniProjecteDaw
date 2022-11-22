<?php

    include_once("clauValor.php");

    class tipusQuestio extends ClauValor
    {
        private $idAssignatura;

        function __construct($id_, $valor_, $idAssignatura_)
        {
            parent::__construct($id_, $valor_);
            $this->idAssignatura_ = $idAssignatura_;
        }

        public function getIdAssignatura()
        {
            return $this->idAssignatura;
        }
        public function setIdAssignatura($value)
        {
            $this->idAssignatura = $value;
        }
    }

?>