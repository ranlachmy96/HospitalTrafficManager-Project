<?php
include "db.php";
include "config.php";

if (isset($_POST["updatedata"])) {
    mysqli_set_charset($connection, "utf8mb4");

    $id = $_POST["update_id"];
    $pnm = $_POST["first_name"];
    $lnm = $_POST["last_name"];
    $age = $_POST["age"];
    $ge = $_POST["gender"];
    $ur = $_POST["urgency"];
    $im = $_POST["image_type"];
    $ti = $_POST["time"];
    $dt = $_POST["date"];


    $query = "UPDATE tbl_213_patients SET first_name='$pnm', last_name='$lnm', age='$age',gender='$ge',urgency='$ur',type='$im',time='$ti',date='$dt' WHERE id_number='$id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        header("location:list.php");
    } else {
        echo '<script>alert("Data Not Saved");</script>';
    }
}
?>