<?php
session_start();
include_once 'dboConfig.php';

?>


<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Kalkulator BMI</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>

<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
    <div class="wrapper wrapper--w680">
        <div class="card card-1">
            <div class="card-heading"></div>
            <div class="card-body">
              
            <?php

if (isset($_SESSION["username"])){
    echo 'Jesteś zalogowany jako ' .$_SESSION["username"];
}
else{
    header("location:login.php");
}

?>


<p>


<div class="p-t-20">
                    <button class="btn btn--radius btn--green" type="button" onclick="window.location.href='logout.php'">Wyloguj</button>
                </div>
<br><br><br>
</p>       <form method="POST" action="/bmicalc.php">

                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-1" type="number" placeholder="Podaj wzrost w centymetrach" name="wzrost" id="wzrost" required >
                        </div>
                        <form method="POST">
                            <div class="input-group">
                                <input class="input--style-1" type="number" placeholder="Podaj wagę w kilogramach" name="waga" id="waga" required >
                            </div>


<div class="p-t-20">
            <button class="btn btn--radius btn--green" type="submit">Oblicz</button>
        </div>

</div>


</form>

<?php
echo("Twoje dotychczasowe pomiary ");

try {
$database = new Connection();
$db = $database->openConnection();


$stm = $db->prepare("SELECT date as DATA, weight as WAGA, height as WZROST, bmi as BMI FROM tarchive  WHERE user=:user");
$stm->execute(array(':user' => $_SESSION["username"]));
$result = $stm->fetchAll();
print_r($result);

}
catch (PDOException $e) {
echo "Nastąpił błąd w połączeniu z bazą danych. " . $e->getMessage();
}

?>



            </div>
        </div>




    </div>
</div>
</div>
</div>

</body>

</html>

