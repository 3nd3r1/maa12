<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kochin Algoritmi</title>
    <script src="https://viljamiranta.fi/vendor/jquery/jquery.min.js"></script>
</head>
<body>
    <center>
        <h1>Kochin Algoritmi <span style="font-size: 15px"> (By Viljami :) )</span></h1>
        <br>
        <form>
            <label for="n">n=  
            <input style="width:30px;padding:5px;" type="number" value="1" id="n"/>
            </label>
            <br><br>
            <input type="button" id="update" value="Näytä"/>
        </form>
        <br>
        <img id="kochimg" src="backend.php?n=1"/>
    </center>
</body>

<script>
    $("#update").click(function(e) {
        e.preventDefault();
        $("#kochimg").attr("src","backend.php?n="+$("#n").val());
    });
</script>
</html>