<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../dbbroker/dbbroker.php';

class controllerGlasaci {
    
    
    public function uzmiGlasaca(){
       $noviDBBroker = new DBBroker();         
       $arrayOfVoices = $noviDBBroker->uzmiGlasaca();
     
       return $arrayOfVoices;    
        
    }
}

/*$test = new controllerGlasaci();
$test->uzmiGlasaca();*/