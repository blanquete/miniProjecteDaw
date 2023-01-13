<?php

    class Sala
    {
        private $id;
        private $nom;
        private $idProfessor;

        function __construct($id_, $valor_)
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

        public function getNom()
        {
            return $this->nom;
        }
        public function setNom($value)
        {
            $this->nom = $value;
        }

        public function getIdProfessor()
        {
            return $this->idProfessor;
        }
        public function setIdProfessor($value)
        {
            $this->idProfessor = $value;
        }
    }

?>