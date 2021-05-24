<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '/home/ddweba/testing-PHP-JS.ddwebapps.com/OOP_MVC_SG/dbbroker/dbbroker.php';


$newDBB = new DBBroker();
$newDBB->connectToDB();

$q = (string) $_GET['q'];
//odsecanje svih znakova osim brojeva
$jmbg = preg_replace("/[^0-9]/", "", $q);
$res = $newDBB->checkJMBG($jmbg);
echo $res;

if ($res == "") {
    $newDBB->potvrdiDBTransakciju();
} else {
    $newDBB->ponistiDBTransakciju();
}
return $res;
