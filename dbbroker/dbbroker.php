<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '/home/ddweba/testing-PHP-JS.ddwebapps.com/OOP_MVC_SG/model/SigurniGlasovi.php';

class DBBroker {

    private $servername = "localhost:3306";
    private $username = "ddweba_snpdbuser";
    private $password = "7)hG5T9d-WAB";
    private $dbname = "ddweba_snpdb";

    //Connect to Database
    public function connectToDB() {

        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $conn->autocommit(FALSE);

        if ($conn->connect_error) {
            die("Neuspela konekcija: " . $conn->connect_error);
        }

        return $conn;
        // echo 'Uspesna konekcija!<br>';
    }

    //Commit transaction
    public function potvrdiDBTransakciju() {
        $conn = $this->connectToDB();
        if (!$conn->commit()) {
            echo "Commit transaction failed";
            exit();
        }

        $conn->close();
    }

    //Rollback transaction
    public function ponistiDBTransakciju() {
        $conn = $this->connectToDB();
        $conn->rollback();
        $conn->close();
    }

    public function uzmiGlasaca() {

        $conn = $this->connectToDB();

        $conn->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
        $sqlUpit = "SELECT ime, prezime, broj_telefona FROM snp_glasaci";

        $result = $conn->query($sqlUpit);

        if ($result->num_rows > 0) {
            $voiceArray = array();

            while ($row = $result->fetch_assoc()) {
                $voiceObject = new SigurniGlasovi();
                $voiceObject->setIme($row['ime']);
                $voiceObject->setPrezime($row['prezime']);
                $voiceObject->setBroj_telefona($row['broj_telefona']);

                array_push($voiceArray, $voiceObject);
            }
            $this->potvrdiDBTransakciju();
            return $voiceArray;
        } else {
            $this->ponistiDBTransakciju();
            return NULL;
        }
    }

    public function checkLogin($username, $password) {
        $conn = $this->connectToDB();  
        
        $conn->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
        $sqlUpit = "SELECT username, password FROM snp_glasaci WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sqlUpit);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {            
            return true;
        }else{    
            return false;
        }
    }

}

//$test = new DBBroker();
//$test->checkLogin('podrinski', 'podrinski');

