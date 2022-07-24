<?php
    class Pont{
        private $id;
        private $idUsuario;
        private $ponto;
        private $arPerg;
        
        public function getId(){
            return $this->id;
        }
        public function setId($i){
            $this->id = $i;
        }
        public function getIdUsuario(){
            return $this->idUsuario;
        }
        public function setIdUsuario($iu){
            $this->idUsuario = $iu;
        }
        public function getPonto(){
            return $this->ponto;
        }
        public function setPonto($p){
            $this->ponto = $p;
        }
        public function getArPerg(){
            return $this->arPerg;
        }
        public function setArPerg($ap){
            $this->arPerg = $ap;
        }

    }
?>  