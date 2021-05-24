<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '/home/ddweba/testing-PHP-JS.ddwebapps.com/OOP_MVC_SG/controllers/controllerGlasaci.php';
include '../include/header.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Voice collection form</title>
        <link href="../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>        

    </head>
    <body>
        <?php
        if (isset($_POST['btn-voice-form'])) {
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $jmbg = $_POST['jmbg'];
            $datum_rodj = $_POST['datum_rodj'];
            $adresa = $_POST['adresa'];
            $broj_telefona = $_POST['broj_telefona'];
            $opstina = $_POST['opstina'];
            $biracko_mesto = $_POST['biracko_mesto'];
            $nosilac_glasova = $_POST['nosilac_glasova'];
            $ime_nosioca_glasova = $_POST['ime_nosioca_glasova'];
            if (empty($ime_nosioca_glasova)) {
                $ime_nosioca_glasova = "";
            }
            $ctrlGlasaci = new controllerGlasaci();

            $ctrlGlasaci->ubaciGlasaca($ime, $prezime, $adresa, 5, $biracko_mesto, $broj_telefona, $jmbg, $datum_rodj, $nosilac_glasova, $ime_nosioca_glasova);

            header('Location: ' . $_SERVER['PHP_SELF'] . '?success');
            exit;
        }
        ?>       

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-12 col-12 border rounded main-section">
                    <h3 class="text-center text-inverse">Унос података гласача (Voice collection form)</h3>
                    <hr>
                    <form method="post"  id="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Име (First Name)</label>
                                    <input type="text" class="form-control"  placeholder="Име" name="ime"  required pattern="^[\sa-zA-ZÀ-žљњертзуиопшђасдфгхјклчћжџцвбнмЉЊЕРТЗУИОПШЂАСДФГХЈКЛЧЋЖЏЦВБНМ-]+$"   title="Можете користити само слова и празнине">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Презиме (Last Name)</label>
                                    <input type="text" class="form-control"  placeholder="Презиме" name="prezime"  required pattern="^[\sa-zA-ZÀ-žљњертзуиопшђасдфгхјклчћжџцвбнмЉЊЕРТЗУИОПШЂАСДФГХЈКЛЧЋЖЏЦВБНМ-]+$"   title="Можете користити само слова и празнине">
                                </div>  
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>ЈМБГ (IDN)</label>
                                    <input type="text" class="form-control" onchange="proveriJMBG(this.value)" id="jmbg" placeholder="ЈМБГ" name="jmbg" pattern="^[0-9]{13}$" title="Можете користити само brojeve - 13 цифара">                               
                                    <span class="warning-text" id="ajax_text_jmbg"></span>
                                </div>  
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Датум рођ. (Date of Birth)</label>
                                    <input type="text" class="form-control"  placeholder="Датум рођ.(нпр. 01/01/2001)" name="datum_rodj" pattern="^(0[1-9]|1\d|2\d|3[01])\/(0[1-9]|1[0-2])\/(19|20)\d{2}$" title="Можете користити само brojeve и /">
                                </div>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Адреса (Address)</label>
                                    <input type="text" class="form-control"  placeholder="Адреса" name="adresa"  required>
                                </div>  
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Телефон (Phone)</label>
                                    <input type="text" class="form-control" onchange="proveriTel(this.value)" id="telefon" placeholder="Телефон" name="broj_telefona"  required pattern="^[-+\s0-9/]+$" title="Можете користити само бројеве, празнине, +, -, /">
                                    <span class="warning-text" id="ajax_text_tel"></span>
                                </div>  
                            </div> 
                        </div>
                        <div class="row">                           
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Општина (Municipality)</label>
                                    <select class="custom-select d-block form-control"  id="opstina" name="opstina" onchange="izaberiNosiocaGl(this.value)"  required>
                                        <option value="0">Изаберите општину</option>
                                        <?php
                                        $ctrlGlasaci = new controllerGlasaci();
                                        $ctrlGlasaci->loadOpstine();
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Изаберите општину
                                    </div>
                                </div>  
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Бирачко место (Polling place)</label>
                                    <input type="text" class="form-control"  placeholder="Бирачко место" name="biracko_mesto"  required>
                                </div>  
                            </div>
                        </div> 
                        <div class="row">                           
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Носилац гласова (Bearer of vote)</label>
                                    <select class="custom-select d-block form-control" onchange="izaberiNosioca()" id="nosilac_glasova" name="nosilac_glasova" required disabled>                                        
                                        <option value="Не, немам носиоца">Не, немам носиоца</option>
                                        <option value="Ја сам носилац">Ја сам носилац</option>  
                                    </select>
                                    <div class="invalid-feedback">
                                        Изаберите носиоца
                                    </div>
                                </div>  
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Име носиоца гласова (Bearer of vote name)</label>
                                    <select class="custom-select d-block form-control"  id="ime_nosioca_glasova" name="ime_nosioca_glasova" required disabled>
                                        <option value="0">Изаберите име носиоца гласова</option>                                       
                                    </select>
                                    <div class="invalid-feedback">
                                        Изаберите име носиоца гласова
                                    </div>
                                </div>  
                            </div>
                        </div> 

                        <hr>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-12 text-center">
                                <button class="btn btn-info" id="voice-btn" type="submit" name="btn-voice-form">Подврди (Submit)</button>
                            </div>
                        </div>  
                    </form>

                </div>
            </div>  
        </div>
        <script src="../lib/js/vanillaJS_custom.js" type="text/javascript"></script>
       
        <script>
                (function () {
                    'use strict';
                    window.addEventListener('load', function () {
                        let form = document.getElementById('needs-validation');
                        form.addEventListener('submit', function (event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    }, false);
                })();
        </script>
    </body>
</html>
