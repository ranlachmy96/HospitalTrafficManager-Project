<?php

session_start();
?>

<?php
include 'db.php';
include "config.php";

if (!empty($_POST["loginMail"])) {
    // echo 'FORM SENT';
    $query = "SELECT * FROM tbl_213_users WHERE email='" . $_POST["loginMail"]
        . "' and password ='"
        . $_POST["loginPass"]
        . "'";

    //print the query check
// echo $query;

    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);


    if (is_array($row)) {
$_SESSION["user_id"]=$row['user_id'];
$_SESSION["user_type"]=$row['user_type'];

        header('Location:' . URL . 'posts.php');

    } else {
        $message = "Invalid Username or Password!";
    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <title>login</title>
</head>

<body>

    <div class="container">
        <h1>Login</h1>
        <form action="#" method="post" id="frm">
            <div class="form-group">
                <label for="loginMail">Email: </label>
                <input type="email" class="form-control" name="loginMail" id="loginMail" aria-describedby="emailHelp"
                    placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="loginPass">Password: </label>
                <input type="password" class="form-control" name="loginPass" id="loginPass"
                    placeholder="Enter Password">
            </div>
            <button type="submit" class="btn btn-primary">Log Me In</button>
            <div class="error-message">
                <?php if (isset($message)) {
                    echo $message;
                } ?>
            </div>
        </form>
    </div>


</body>

</html>