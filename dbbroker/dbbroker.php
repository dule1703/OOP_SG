<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '/home/ddweba/testing-PHP-JS.ddwebapps.com/OOP_MVC_SG/model/SigurniGlasovi.php';

class DBBroker {

    private $servername = "localhost:3306";
    private $username = "ddweba_snpdbuser";
    private $password = "7)hG5T9d-WAB";
    private $dbname = "ddweba_snpdb";
    static $conn;

    //Connect to Database
    public function connectToDB() {

        self::$conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $conn = self::$conn;
        $conn->autocommit(FALSE);

        if ($conn->connect_error) {
            die("Neuspela konekcija: " . $conn->connect_error);
        }
        // echo 'Uspesna konekcija!<br>';     
    }

    //Commit transaction
    public function potvrdiDBTransakciju() {
        self::$conn->commit();
        self::$conn->close();
    }

    //Rollback transaction
    public function ponistiDBTransakciju() {
        self::$conn->rollback();
        self::$conn->close();
    }

    public function uzmiGlasaca() {
        $conn = self::$conn;

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

            return $voiceArray;
        } else {
            return NULL;
        }
    }

    public function checkLogin($username, $password) {
        $conn = self::$conn;
        $_SESSION["username"] = $username;
        $_SESSION["superadmin"] = "rosnp_superadmin";
        $_SESSION["admin"] = "rosnp_admin";

        $conn->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
        $sqlUpit = "SELECT username, password FROM snp_glasaci WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sqlUpit);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertVoiceBearer($ime, $prezime, $adresa, $sifraMesta, $biracko_mesto, $broj_telefona, $jmbg, $datum_rodj, $nosilac_glasova, $ime_nosioca_glasova) {

        $conn = self::$conn;
        date_default_timezone_set("Europe/Belgrade");
        $datum = date("d/m/Y H:i:s");
        $opstinski_poverenik = '';
        $regionalni_poverenik = '';
        $republicki_poverenik = '';
        $username = '';
        $password = '';

        $conn->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
        $sqlQuery = "INSERT INTO snp_glasaci(ime, prezime, adresa, mesto, biracko_mesto, broj_telefona, datum, jmbg, datum_rodj, nosilac_glasova, ime_nosioca_glasova, opstinski_poverenik, regionalni_poverenik, republicki_poverenik, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bind_param("sssissssssssssss", $ime, $prezime, $adresa, $sifraMesta, $biracko_mesto, $broj_telefona, $datum, $jmbg, $datum_rodj, $nosilac_glasova, $ime_nosioca_glasova, $opstinski_poverenik, $regionalni_poverenik, $republicki_poverenik, $username, $password);

        $res = $stmt->execute();

        return $res;
    }

    public function checkJMBG($jmbg) {
        $conn = self::$conn;

        $conn->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
        //odsecanje svih znakova osim brojeva
        $pom = preg_replace("/[^0-9]/", "", $jmbg);

        $sqlUpit = "SELECT jmbg FROM snp_glasaci";
        $result = $conn->query($sqlUpit);

        $nizJMBG = array();

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $value = preg_replace("/[^0-9]/", "", $row["jmbg"]);
                array_push($nizJMBG, $value); //punjenje niza
            }

            //provera da li u bazi vec postoji  JMBG broj koji se unosi
            if (in_array($pom, $nizJMBG)) {
                $message = "Изабрали сте постојећи JMBG, покушајте поново! (Existing IDN, try again!)";
                return $message;
            } else {
                $message = "";
                return $message;
            }
        }
    }

    public function checkTel($tel) {
        $conn = self::$conn;

        $conn->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
        //odsecanje svih znakova osim brojeva
        $pom = preg_replace("/[^0-9]/", "", $tel);

        $sqlUpit = "SELECT broj_telefona FROM snp_glasaci";
        $result = $conn->query($sqlUpit);

        $nizTel = array();

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $value = preg_replace("/[^0-9]/", "", $row["broj_telefona"]);
                array_push($nizTel, $value); //punjenje niza
            }

            //provera da li u bazi vec postoji  JMBG broj koji se unosi
            if (in_array($pom, $nizTel)) {
                $message = "Изабрали сте постојећи број, покушајте поново! (Existing phone number, try again!)";
                return $message;
            } else {
                $message = "";
                return $message;
            }
        }
    }

    public function loadOpstine() {
        $conn = self::$conn;
        $username = $_SESSION["username"];
        $_SESSION["superadmin"] = "rosnp_superadmin";
        $_SESSION["admin"] = "rosnp_admin";

        $conn->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
        $sqlUpit = "SELECT  so.naziv_opstine  FROM spisak_opstina so 
                             INNER JOIN opstine o ON o.opstina_id = so.id
                             INNER JOIN regioni r ON r.id = o.region_id
           
            WHERE o.region_id = (SELECT id FROM regioni WHERE naziv_regiona= (SELECT r.naziv_regiona FROM regioni r 
                                                                                                        INNER JOIN opstine o ON r.id = o.region_id
                                                                                                        INNER JOIN spisak_opstina so ON so.id = o.opstina_id                                                                                                  
                                                                                                        INNER JOIN snp_glasaci g ON so.id = g.mesto
                       										    WHERE g.username='$username' AND g.regionalni_poverenik='да'))
            OR so.naziv_opstine=(SELECT so.naziv_opstine FROM opstine o                               
                             INNER JOIN spisak_opstina so ON so.id = o.opstina_id  
                             INNER JOIN regioni r ON o.region_id = r.id
                             INNER JOIN snp_glasaci g ON so.id = g.mesto
                              WHERE g.username='$username' AND g.opstinski_poverenik='да')";


        if ($username === $_SESSION["admin"] || $username === $_SESSION["superadmin"]) {
            $sqlUpit = "SELECT DISTINCT so.naziv_opstine FROM spisak_opstina so 
                                      INNER JOIN opstine o ON o.opstina_id = so.id";
        } elseif ($username === '') {
            header("location: ../index.php");
        }


        $result = $conn->query($sqlUpit);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option>" . $row['naziv_opstine'] . "</option>";
            }
        }
    }

    public function selectNosiociGlasova($opstina) {
        $conn = self::$conn;
        

        $conn->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
        $sql = "SELECT DISTINCT g.jmbg, g.ime, g.prezime, g.mesto, so.naziv_opstine  FROM snp_glasaci g
        INNER JOIN spisak_opstina so ON so.id = g.mesto       
        WHERE g.nosilac_glasova='Ја сам носилац' AND mesto=(SELECT id FROM spisak_opstina WHERE naziv_opstine LIKE'%$opstina')";

        $result = $conn->query($sql);       
        
        $rezSelect = '';

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {               
                $rezSelect .= $row['ime'] . " " . $row['prezime'] . " (" . $row['naziv_opstine'] . ") - ЈМБГ: " . $row['jmbg'] . ",";                  
            }
            echo $rezSelect;           
        }else{
          echo  $rezSelect;
        }
    }

}

//$test = new DBBroker();
//$test->connectToDB();
//$test->selectNosiociGlasova("Мали Зворник");
//$test->checkLogin("oo_mzvornik", "oo_mzvornik");
//$test->insertVoiceBearer('Дајана', 'Петковић', 'Његошева 33', 5, 'Средња школа', '3634634634', '5463235664334', '20/03/1985', 'Не, немам носиоца', '');
//$test->checkTel("35635353535");


