<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '/home/ddweba/testing-PHP-JS.ddwebapps.com/OOP_MVC_SG/controllers/controllerGlasaci.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="../lib/js/vanillaJS_custom.js" type="text/javascript"></script>
        <script src="../lib/js/jQuery_custom.js" type="text/javascript"></script>
        
        <title>Table overview</title>
    
    </head>
    <body>
        <?php
        $ctrlGlasaci = new controllerGlasaci();
        $arrayOfVoices = $ctrlGlasaci->uzmiGlasaca();
        ?>
        <h2 class="text-center">Sigurni glasovi</h2>

        <table  class="table table-striped table-bordered table-sm" >
            <thead>
                <tr>
                    <th>#</th>                            
                    <th>Име</th>
                    <th>Презиме</th>                           
                    <th>Број телефона</th>   
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $rezTab = '';
                foreach ($arrayOfVoices as $x => $x_value) {
                    $rezTab .= "<tr >";
                    $rezTab .= "<td>" . $i++ . "</td>";
                    $rezTab .= "<td>" . htmlspecialchars($x_value->getIme()) . "</td>";
                    $rezTab .= "<td>" . htmlspecialchars($x_value->getPrezime()) . "</td>";
                    $rezTab .= "<td>" . htmlspecialchars($x_value->getBroj_telefona()) . "</td>";
                    $rezTab .= "</tr>";
                }
                echo $rezTab;
                ?>
              
            </tbody>
        </table>
    </div>


</body>
</html>
