<?php
include_once 'dboConfig.php';
$password=$_POST['password'];
$hashPassword = sha1($password);
$email = $_POST['email'];
session_start();

try {
    $database = new Connection();
    $db = $database->openConnection();

    $stm = $db->prepare("SELECT * FROM tusers WHERE email=:email AND password=:password");
    $stm->execute(array(':email' => $email, ':password' => $hashPassword));
    $count=$stm->rowCount();
    if ($count>0){
        $_SESSION["username"]=$_POST['email'];
        header("location:main.php");
    }
    else{
        $message="Błędny login lub hasło";
    }
} catch (PDOException $e) {
    echo "Nastąpił błąd w połączeniu z bazą danych. " . $e->getMessage();
}



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
                    echo $message;
                    ?>



            </div>
        </div>




    </div>
</div>
</div>
</div>

<!-- Jquery JS-->
<script src="vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->


