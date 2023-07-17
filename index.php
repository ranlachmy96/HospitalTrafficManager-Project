<?php
session_start();
?>
<?php
include 'db.php';
include "config.php";
if (!empty($_POST["id_user"])) {
    $query = "SELECT * FROM tbl_213_users WHERE id='" . $_POST["id_user"]
        . "' and password ='"
        . $_POST["loginPass"]
        . "'";
      
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
        $_SESSION["user_id"] = $row['id'];
        $_SESSION["user_type"] = $row['user_type'];
        header('Location:' . URL . 'dashboard.php');
    } else {
        $message = "סיסמא או תז לא נכונים";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Medula+One&family=Metamorphous&family=Rubik&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2a6eac1b83.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">

<header class="header-index">
        <div class="index-logo">
       
            <a href="index.php" id="logo"></a>
            <a href="index.php" id="logo-mobile"></a>
     
</div>
        
    </header>






<body>
    <div class="index-backgorund-img">
    <div class="index-container">
    <div class="index-form-box">
        <form action="#" method="post" id="frm">
            <div class="form-group">
                <label class="index-label" for="id_user">ת"ז:</label>
                <input type="text" id="index-form-input" class="form-control" name="id_user" id="id_user" placeholder="הכנס תז">
            </div>
            <div class="form-group">
                <label class="index-label" for="loginPass">סיסמא :</label>
                <input type="password" id="index-form-input" class="form-control" name="loginPass" id="loginPass" placeholder="הכנס סיסמא">
            </div>
            <button type="submit" id="inedx-button" class="btn btn-primary">כניסה</button>
            <div class="error-message">
                <?php if (isset($message)) {
                    echo $message;
                } ?>
            </div>
        </form>

        </div>
    </div>

    </div>
</body>

</html>