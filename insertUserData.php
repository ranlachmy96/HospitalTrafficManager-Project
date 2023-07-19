<?php
include "db.php";

if (isset($_GET["add-profile_data"])) {
    mysqli_set_charset($connection, "utf8mb4");

    $id = $_GET["id_number"];
    $pnm = $_GET["first_name"];
    $lnm = $_GET["last_name"];
    $pass = $_GET["password"];
    $nd = $_GET["name-department"];
    $mi = $_GET["mail"];
    $ty = $_GET["user-type"];

    $query = "INSERT INTO tbl_213_users (`id`, `name`, `last_name`, `email`, `password`, `name_department`, `id_departement`, `user_type`) 
    VALUES ('$id','$pnm', '$lnm', '$mi', '$pass', '$nd', 1, '$ty')";
    echo $query;
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        header('location:addUsers.php?success=true');
    } else {
        echo '<script>alert("Data Not Saved");</script>';
    }
}
?>