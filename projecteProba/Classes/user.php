<?php

    class User
    {
        private $id;
        private $nom;
        private $email;
        private $password;
        private $idRol;
        private $idGrup;

        function __constructor($id_, $nom_, $email_, $password_, $rol_, $grup_)
        {
            $this->id = $id_;
            $this->nom = $nom_;
            $this->email = $email_;
            $this->password = $password_;
            $this->idRol = $rol_;
            $this->idGrup = $grup_;
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

        public function getEmail()
        {
            return $this->email;
        }
        public function setEmail($value)
        {
            $this->email = $value;
        }

        public function getPassword()
        {
            return $this->password;
        }
        public function setPassword($value)
        {
            $this->password = $value;
        }

        public function getRol()
        {
            return $this->idRol;
        }
        public function setRol($value)
        {
            $this->idRol = $value;
        }

        public function getGrup()
        {
            return $this->idGrup;
        }
        public function setGrup($value)
        {
            $this->idGrup = $value;
        }
    }

?>