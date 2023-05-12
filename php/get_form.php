<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H.T.M - forms</title>
</head>
<body>
    <section><h1>H.T.M: patient form feedback</h1>
        <?php
        $image = array("ultrasound", "x-ray", "C.T", "M.R.I");

        $id  =  $_GET["id_number"];
        $pnm = $_GET["private_name"];
        $lnm = $_GET["last_name"];
        $mi  = $_GET["mail"];     
        $age = $_GET["age"]; 
        $dt  = $_GET["date"]; 
        $im  = $_GET["image_type"]; 
        $add = $_GET["moreToAdd"];
        $ti  = $_GET["time"];
 
        if (in_array($im, $image)) {
            echo "<h2>Patient ".$pnm." ".$lnm." with ID number ".$id."  ".$bc." is on its way!</h2>";
            if (!empty($add)) {
                echo "<p>You also added: ".$add."</p>";
            }
        } else {
            echo "<h2>We're sorry, but the color you entered is not in stock please try another one.</h2>";
        }
        ?>
    </section>
</body>
</html>
