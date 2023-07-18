<?php
include "db.php";
include "config.php"
    ?>

<?php
session_start();
if (!$_SESSION["user_id"]) {
    echo "no user id";
    header('Location:' . URL . 'index.php');
}

?>


<?php
if (isset($_GET["update-profile_data"])) {
    mysqli_set_charset($connection, "utf8mb4");
    echo '<script>console.log(8)</script>';
    $id = $_GET["id_number"];
    $pnm = $_GET["first_name"];
    $lnm = $_GET["last_name"];
    $pass = $_GET["password"];
    $nd = $_GET["name-department"];
    $mi = $_GET["mail"];

    $query = "UPDATE tbl_213_users SET id='$id', name='$pnm', last_name='$lnm', email='$mi', password='$pass', name_department='$nd' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        header("location:editProfile.php");
    } else {
        echo '<script>alert("Data Not Saved");</script>';
    }
}
mysqli_set_charset($connection, "utf8");
$idNumber = $_SESSION["user_id"];
$query = "SELECT * FROM tbl_213_users WHERE id = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "s", $idNumber);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if ($result) {
    $row = mysqli_fetch_assoc($result);
} else {
    die("DB query failed.");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://kit.fontawesome.com/2a6eac1b83.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>appointment</title>
</head>

<body>
    <header>
        <section id="mobile-profile-picture">
            <img src="images/hanna_persona_mobile_profile.png" alt="mobile profile photo" title="mobile profile photo">
        </section>
        <section class="logo-con">
            <a href="index.php" id="logo"></a>
            <a href="index.php" id="logo-mobile"></a>
        </section>
        <nav>
            <section>
                <input type="checkbox" id="menu-toggle" class="mobile-toggle-menu">
                <div class="hamburger"></div>

                <ul class="mobile-menu">
                    <li class="divider-item" id="mobile-menu-header">תפריט</li>

                    <li><a href="dashboard.php"><i class="fa-solid fa-house"></i>&nbsp;לוח בקרה</a></li>
                    <li><a href="#"><i class="fa-solid fa-temperature-half"></i>&nbsp; מכסה מטופלים</a></li>
                    <li><a href="appointment.php"><i class="fa-regular fa-calendar-check"></i>&nbsp;זימון תורים</a>
                    </li>
                    <li class="divider-item"><a href="list.php"><i class="fa-solid fa-table-list"></i>&nbsp;רשימת
                            מטופלים</a></li>

                    <li class="divider-item-space"></li>
                    <li><a href="#"><i class="fa-solid fa-box"></i>&nbsp;לוגיסטיקה</a></li>
                    <li><a href="#"><i class="fa-solid fa-gear"></i>&nbsp;הגדרות</a></li>
                    <li class="divider-item"><a href="logout.php"><i
                                class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;התנתקות</a></li>
                    <li class="white-color-divide"></li>

                    <li>
                        <a href="index.php" id="second-logo-mobile"></a>
                    </li>
                </ul>
            </section>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link " href="#">לוגיסטיקה</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="list.php">רשימת מטופלים</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="appointment.php">זימון תורים</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">מכסה מטופלים</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="dashboard.php">לוח בקרה </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">
                        <img src="images/hanna-persona-profile.png" alt="profile picture" title="profile picture">
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="editProfile.php">עריכת פרופיל</a></li>
                        <li><a class="dropdown-item" href="#">הגדרות</a></li>
                        <li><a class="dropdown-item" href="logout.php">התנתקות</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <nav class="breadcrumb-right" style="--bs-breadcrumb-divider;" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">עריכת פרופיל</li>
            </ol>
        </nav>
        <!-- editProfile -->
        <div class="editProfile-Container-out">
            <div class="editProfile-img">
                <img src="images/hanna-profile-edit.png">
            </div>
            <div class="editProfile-Container">
                <div class="editProfile-Container-inner">
                    <form action="editProfile.php" method="get" id="editProfile-form" accept-charset="UTF-8"
                        class="needs-validation" novalidate>
                        <div class="editProfile-col1-group">
                            <div class="editProfile-col1">
                                <label class="form-label">ת"ז</label>
                                <input type="number" class="form-control written" name="id_number" min="0"
                                    max="9999999999" <?php echo 'placeholder="' . $row["id"] . '" value="' . $row["id"] . '"'; ?>>
                                <label class="form-label">שם פרטי</label>
                                <input type="text" class="form-control written" name="first_name" <?php echo 'placeholder="' . $row["name"] . '" value="' . $row["name"] . '" '; ?>
                                    pattern="[A-Za-z\u0590-\u05FF]+">
                                <label class="form-label"> מחלקה</label>
                                <select name="name-department" class="form-select" id="name-department-select" <?php echo 'placeholder="' . $row["name_department"] . '"'; ?> required>
                                    <option value=""></option>
                                    <option value="דימות" selected>דימות</option>
                                    <option value=""></option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="editProfile-col2">
                                <label>אימייל</label>
                                <input type="email" class="form-control written" name="mail"
                                    pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" <?php echo 'placeholder="' . $row["email"] . '" value="' . $row["email"] . '" '; ?>>
                                <label class="form-label">שם משפחה</label>
                                <input type="text" class="form-control written" name="last_name"
                                    pattern="[A-Za-z\u0590-\u05FF]+" <?php echo 'placeholder="' . $row["last_name"] . '" value="' . $row["last_name"] . '"'; ?>>
                                <label class="form-label"> סיסמא</label>
                                <input type="password" class="form-control" name="password" <?php echo 'placeholder="' . $row["password"] . '" value="' . $row["password"] . '"'; ?>>
                            </div>
                        </div>
                        <div class="editProfile-col3">
                            <input type="submit" id="editProfile-submit-button" class="btn btn-primary" value="שמור"
                                name="update-profile_data">
                        </div>
                    </form>
                </div>
            </div>
        </div>











        <br>
    </main>

</body>

</html>