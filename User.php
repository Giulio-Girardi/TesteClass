<?php
    class User{

        public $nome;
        public $email;

        //Getters
        public function getNome(){
            return $this->nome;
        }
        public function getEmail(){
            return $this->email;
        }
        //Setters
        public function setNome($nome){
            $this->nome=$nome;
        }
        public function setEmail($email){
            $this->email=$email;
        }
    }

?>