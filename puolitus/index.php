<?php
require("backend.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="http://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puolituskon</title>
</head>
<body>
    <center>
        <h1>Puolitus kone <span style="font-size: 15px"> (By Viljami :) )</span></h1>
        <br>
        <form method="post">
            <label for="fx">a=  
            <input style="width:30px;padding:5px;" type="number" value="1" name="a" id="a"/>
            </label>
            <label for="b">b= 
            <input style="width:30px;padding:5px" type="number" name="b" value="10" id="b"/>
            </label>
            <br><br>
            <label for="decimal">Tarkkuus= 
            <input style="width:30px;padding:5px" type="number" name="decimal" value="1" id="decimal"/>
            </label>
            <br><br>
            <label for="fx">f(x)= 
            <input style="padding:5px" type="text" name="fx" value="x-5" id="fx"/>
            </label>
            <br><br>
            <input type="submit" name="puolita" value="Puolita"/>
        </form>
        <br>
        <?php
            if(isset($_POST["puolita"]))
            {
                $a = $_POST["a"];
                $b = $_POST["b"];
                $decimal = $_POST["decimal"];
                $fx = $_POST["fx"];

                $pl = new puolitus($a,$b,$decimal,$fx);
                $pl->printImage();
            }
        ?>
    </center>
</body>
</html>