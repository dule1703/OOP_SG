<?php


class SigurniGlasovi {
    private $ime;
    private $adresa;
    private $prezime;
    private $broj_telefona;
    private $mesto;
    private $biracko_mesto;
    private $datum;
    private $jmbg;
    private $datum_rodj;
    private $nosilac_glasova;
    private $ime_nosioca_glasova;
    private $opstinski_poverenik;
    private $regionalni_poverenik;
    private $republicki_poverenik;
    private $username;
    private $password;
   
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

    function getAdresa() {
        return $this->adresa;
    }

    function getMesto() {
        return $this->mesto;
    }

    function getBiracko_mesto() {
        return $this->biracko_mesto;
    }

    function setAdresa($adresa) {
        $this->adresa = $adresa;
    }

    function setMesto($mesto) {
        $this->mesto = $mesto;
    }

    function setBiracko_mesto($biracko_mesto) {
        $this->biracko_mesto = $biracko_mesto;
    }

    function getDatum() {
        return $this->datum;
    }

    function getJmbg() {
        return $this->jmbg;
    }

    function getDatum_rodj() {
        return $this->datum_rodj;
    }

    function getNosilac_glasova() {
        return $this->nosilac_glasova;
    }

    function getIme_nosioca_glasova() {
        return $this->ime_nosioca_glasova;
    }

    function getOpstinski_poverenik() {
        return $this->opstinski_poverenik;
    }

    function getRegionalni_poverenik() {
        return $this->regionalni_poverenik;
    }

    function getRepublicki_poverenik() {
        return $this->republicki_poverenik;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function setDatum($datum) {
        $this->datum = $datum;
    }

    function setJmbg($jmbg) {
        $this->jmbg = $jmbg;
    }

    function setDatum_rodj($datum_rodj) {
        $this->datum_rodj = $datum_rodj;
    }

    function setNosilac_glasova($nosilac_glasova) {
        $this->nosilac_glasova = $nosilac_glasova;
    }

    function setIme_nosioca_glasova($ime_nosioca_glasova) {
        $this->ime_nosioca_glasova = $ime_nosioca_glasova;
    }

    function setOpstinski_poverenik($opstinski_poverenik) {
        $this->opstinski_poverenik = $opstinski_poverenik;
    }

    function setRegionalni_poverenik($regionalni_poverenik) {
        $this->regionalni_poverenik = $regionalni_poverenik;
    }

    function setRepublicki_poverenik($republicki_poverenik) {
        $this->republicki_poverenik = $republicki_poverenik;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }



}
