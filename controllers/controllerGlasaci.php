<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '/home/ddweba/testing-PHP-JS.ddwebapps.com/OOP_MVC_SG/dbbroker/dbbroker.php';

class controllerGlasaci {

    public function checkLogin($username, $password) {
        $newDBB = new DBBroker();
        $newDBB->connectToDB();
        $res = $newDBB->checkLogin($username, $password);

        if ($res) {
            $newDBB->potvrdiDBTransakciju();
        } else {
            $newDBB->ponistiDBTransakciju();
        }
        return $res;
    }

    public function uzmiGlasaca() {
        $newDBB = new DBBroker();
        $newDBB->connectToDB();
        $arrayOfVoices = $newDBB->uzmiGlasaca();
        if (is_null($arrayOfVoices)) {
            $newDBB->ponistiDBTransakciju();
        } else {
            $newDBB->potvrdiDBTransakciju();
        }
        return $arrayOfVoices;
    }

    public function ubaciGlasaca($ime, $prezime, $adresa, $sifraMesta, $biracko_mesto, $broj_telefona, $jmbg, $datum_rodj, $nosilac_glasova, $ime_nosioca_glasova) {
        $newDBB = new DBBroker();
        $newDBB->connectToDB();
        $res = $newDBB->insertVoiceBearer($ime, $prezime, $adresa, $sifraMesta, $biracko_mesto, $broj_telefona, $jmbg, $datum_rodj, $nosilac_glasova, $ime_nosioca_glasova);

        if ($res) {
            $newDBB->potvrdiDBTransakciju();
        } else {
            $newDBB->ponistiDBTransakciju();
        }
        return $res;
    }

    public function checkJMBG($jmbg) {
        $newDBB = new DBBroker();
        $newDBB->connectToDB();

        $res = $newDBB->checkJMBG($jmbg);

        if ($res) {
            $newDBB->potvrdiDBTransakciju();
        } else {
            $newDBB->ponistiDBTransakciju();
        }
        return $res;
    }
    
    public function loadOpstine(){
        $newDBB = new DBBroker();
        $newDBB->connectToDB();

        $res = $newDBB->loadOpstine();
        if($res != ""){
            $newDBB->potvrdiDBTransakciju();
        }else{
            $newDBB->ponistiDBTransakciju();
        }
        
        return $res;
    }

}

//$test = new controllerGlasaci();
//$test->loadOpstine();
//$test->checkJMBG("2050235820585");
//$test->uzmiGlasaca();
//$test->ubaciGlasaca('Марија', 'Огњеновић', 'Његошева 33', 5, 'Средња школа', '3634634634', '30/02/2021', '5463235664334', '20/03/1985', 'Не, немам носиоца', '');