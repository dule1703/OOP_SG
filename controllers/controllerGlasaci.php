<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '/home/ddweba/testing-PHP-JS.ddwebapps.com/OOP_MVC_SG/dbbroker/dbbroker.php';

class controllerGlasaci {
    
    public function checkLogin($username, $password){
        $noviDBBroker = new DBBroker();
        $rez = $noviDBBroker->checkLogin($username, $password);   
        return $rez;
    }

    public function uzmiGlasaca(){
       $noviDBBroker = new DBBroker();         
       $arrayOfVoices = $noviDBBroker->uzmiGlasaca();
     
       return $arrayOfVoices;    
        
    }
    
}

//$test = new controllerGlasaci();
//$test->checkLogin('podrinski', 'podrinski');