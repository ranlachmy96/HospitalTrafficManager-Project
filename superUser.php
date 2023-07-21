<?php
include "db.php";
include "config.php"
    ?>

<?php
session_start();
if (!$_SESSION["user_id"] && $_SESSION["user_type"] !== "admin") {
    header('Location:' . URL . 'index.php');
}
?>
