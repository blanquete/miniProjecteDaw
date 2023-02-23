<?php

    class Question
    {
        private $id;
        private $idUser;
        private $tipusQuestio;
        private $txtPregunta;

        function __constructor($id_, $idUser_, $tipusQuestio_, $txtPregunta_)
        {
            $this->id = $id_;
            $this->idUser = $idUser_;
            $this->tipusQuestio = $tipusQuestio_;
            $this->txtPregunta = $txtPregunta_;
        }

        public function getId()
        {
            return $this->id;
        }
        public function setId($value)
        {
            $this->id = $value;
        }

        public function getIdUser()
        {
            return $this->idUser;
        }
        public function setIdUser($value)
        {
            $this->idUser = $value;
        }

        public function getTipusQuestio()
        {
            return $this->tipusQuestio;
        }
        public function setTipusQuestio($value)
        {
            $this->tipusQuestio = $value;
        }

        public function getTxtPregunta()
        {
            return $this->txtPregunta;
        }
        public function setTxtPregunta($value)
        {
            $this->txtPregunta = $value;
        }
    }

?>