<?php


class SigurniGlasovi {
    private $ime;
    private $prezime;
    private $broj_telefona;
    
   /* public function __construct($ime, $prezime, $broj_telefona) {
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->broj_telefona = $broj_telefona;
    }*/
    function getIme() {
        return $this->ime;
    }

    function getPrezime() {
        return $this->prezime;
    }

    function getBroj_telefona() {
        return $this->broj_telefona;
    }

    function setIme($ime) {
        $this->ime = $ime;
    }

    function setPrezime($prezime) {
        $this->prezime = $prezime;
    }

    function setBroj_telefona($broj_telefona) {
        $this->broj_telefona = $broj_telefona;
    }


}
