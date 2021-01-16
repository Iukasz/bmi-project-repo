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
    <script src="js/canvasjs.min.js"></script>

   
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

              

            
 

               <?php
               $waga=$_POST['waga'];
               $wzrost=$_POST['wzrost'];
               $wzrost=$wzrost/100;
               $bmi=$waga/pow($wzrost, 2);
               $date=date("Y-m-d H:i:s");
               echo ('Twoje BMI to ' .$bmi);
               
                try {
                        $database = new Connection();
                        $db = $database->openConnection();

                        
                        $stm = $db->prepare("INSERT INTO tarchive (date, user, weight, height, bmi) VALUES ( :date, :user, :weight, :height, :bmi)");
                        $stm->execute(array(':date' => $date, ':user' => $_SESSION["username"], ':weight' => $waga, ':height'=>$wzrost, ':bmi'=> $bmi));
                        $message=" -> zapisano wynik do bazy danych.";
                    }
                 catch (PDOException $e) {
                    echo "Nastąpił błąd w połączeniu z bazą danych. " . $e->getMessage();
                }
                echo $message;
                if ($bmi<8.5){
                    $resultMessage="Masz niedowagę.";
                }
                elseif($bmi<18.5 && $bmi>8.5){
                    $resultMessage="Masz wychudzenie.";
                }
                elseif($bmi>18.5 && $bmi<24.9){
                    $resultMessage="Waga prawidłowa";

                }
                elseif($bmi>25 && $bmi<29.9){
                    $resultMessage="Masz nawagę.";
                }
                
                elseif($bmi>30 && $bmi<34.9){
                    $resultMessage="Masz otyłość 1 stopnia.";
                }
                elseif($bmi>35){
                    $resultMessage="Masz otyłość 2 stopnia.";
                }
                
                echo ("<br>".$resultMessage);
                ?>
                <br><br><br>
                 <script>
window.onload = function () {
    var val = "<?php echo $bmi ?>";

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Porównanie Twojego BMI"
	},
  	axisY: {
      includeZero: true
    },
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
      	indexLabelFontSize: 12,
		indexLabelPlacement: "outside",
		dataPoints: [
			{ x: 1, y: <?php echo $bmi; ?>, indexLabel: "\u2605 Twoje BMI" },
			{ x: 2, y: 8.5, indexLabel: "\u2605 Niedowaga"  },
			{ x: 3, y: 24.9, indexLabel: "\u2605 Waga prawidłowa" },
			{ x: 4, y: 29.9, indexLabel: "\u2605 Nadwaga" },
			{ x: 5, y: 34.9, indexLabel: "\u2605 Otyłość 1 stopnia"  }
            
		]
	}]
});
chart.render();

}
</script>

                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                 
                 <div class="p-t-20">
                    <button class="btn btn--radius btn--green" type="button" onclick="window.location.href='main.php'">Powrót do formularza</button>
                </div></div>
</body>

</html>

