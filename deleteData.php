<?php
include "db.php";
if (isset($_POST['deletedata'])) {
    $idNumber = $_POST['delete_id'];
    $query = "DELETE FROM tbl_213_patients WHERE id_number='$idNumber'";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        header("location:list.php");
    } else {
        echo '<script>alert("Data Not Deleted"); </script>';
    }
}
?>