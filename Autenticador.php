<?php
    
    class Autenticador{
        public $header;
        public $payload;
        public $signature;

        //Getters
        public function getHeader(){
            return $this->header; 
        }
        public function getPayload(){
            return $this->payload; 
        }
        public function getSignature(){
            return $this->signature; 
        }

        //Setters
        public function setHeader($header){
            $this->header = $header;
        }
        public function setPayload($payload){
            $this->payload = $payload;
        }
        public function setSignature($signature){
            $this->signature = $signature;
        }
    }
