<?php
include "db.php";

if (isset($_GET["insert_data"])) {
    mysqli_set_charset($connection, "utf8mb4");
    $newPatientId = 'D' . rand(10, 99);

    $id = $_GET["id_number"];
    $pnm = $_GET["first_name"];
    $lnm = $_GET["last_name"];
    $mi = $_GET["mail"];
    $age = $_GET["age"];
    $dt = $_GET["date"];
    $im = $_GET["image_type"];
    $add = $_GET["moreToAdd"];
    $ti = $_GET["time"];
    $ge = $_GET["gender"];
    $ur = $_GET["urgency"];

    $query = "INSERT INTO tbl_213_patients (`id`, `id_number`, `first_name`, `last_name`, `age`, `gender`, `urgency`, `type`, `time`, `date`, `id_department`, `email`, `comment`) 
    VALUES ('$id', '$newPatientId', '$pnm', '$lnm', '$age', '$ge', '$ur', '$im', '$ti', '$dt', 1, '$mi', '$add')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        header('location:appointment.php?success=true&date=' . urlencode($dt) . '&time=' . urlencode($ti));
    } else {
        echo '<script>alert("Data Not Saved");</script>';
    }
}
?>