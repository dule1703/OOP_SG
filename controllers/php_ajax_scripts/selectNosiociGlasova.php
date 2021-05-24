<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '/home/ddweba/testing-PHP-JS.ddwebapps.com/OOP_MVC_SG/dbbroker/dbbroker.php';


$newDBB = new DBBroker();
$newDBB->connectToDB();

$opstina = (string) $_GET['q'];

$res = $newDBB->selectNosiociGlasova($opstina);


if ($res != "") {
    $newDBB->potvrdiDBTransakciju();
} else {
    $newDBB->ponistiDBTransakciju();
}
return $res;



