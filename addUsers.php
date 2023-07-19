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
<?php
$user = $_SESSION["user_id"];
mysqli_set_charset($connection, "utf8");
$query1 = "SELECT * FROM tbl_213_users WHERE id = ?";
$stmt = mysqli_prepare($connection, $query1);
mysqli_stmt_bind_param($stmt, "i", $user);
mysqli_stmt_execute($stmt);
$result1 = mysqli_stmt_get_result($stmt);

if ($result1) {
    $row1 = mysqli_fetch_assoc($result1);
} else {
    die("DB query failed.");
}
?>


<!DOCTYPE html>
<html>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <script src="https://kit.fontawesome.com/2a6eac1b83.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>profile patients</title>
</head>

<body id="body-patientProfile">
    <header>
        <section id="mobile-profile-picture">
            <!-- <img src="images/hanna_persona_mobile_profile.png" alt="mobile profile photo" title="mobile profile photo"> -->
            <?php echo '<img src="' . $row1["img_user_menu_mobile"] . '">'; ?>
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
                            מטופלים</a>
                    </li>
                    <li class="divider-item-space"></li>
                    <li><a href="#"><i class="fa-solid fa-box"></i>&nbsp;לוגיסטיקה</a></li>
                    <li><a href="#"><i class="fa-solid fa-gear"></i>&nbsp;הגדרות</a></li>
                    <li class="divider-item"><a href="logout.php"><i
                                class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;התנתקות</a>
                    </li>
                    <li class="white-color-divide"></li>

                    <li>
                        <a href="index.php" id="second-logo-mobile"></a>
                    </li>
                </ul>


            </section>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="#">לוגיסטיקה</a>
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
                        <!-- <img src="images/hanna-persona-profile.png" alt="profile picture" title="profile picture"> -->
                        <?php echo '<img src="' . $row1["img_user_menu"] . '">'; ?>

                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="editProfile.php">עריכת פרופיל</a></li>
                        <?php
                        if ($_SESSION["user_type"] == "admin") {
                            echo '<li><a class="dropdown-item" href="addUsers.php">הוספת משתמש</a></li>';
                        } ?>
                        <li><a class="dropdown-item" href="#">הגדרות</a></li>
                        <li><a class="dropdown-item" href="logout.php">התנתקות</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <nav class="breadcrumb-right" style="--bs-breadcrumb-divider: '<';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">הוספת משתמש</li>
            </ol>
        </nav>
        <section id="addUserWrapper">
            <section id="h1-addUser">
                <h5>הוספת משתמש</h5>
            </section>

            <form action="" method="get" id="addUser-form" accept-charset="UTF-8" class="needs-validation" novalidate>
                <section class="addUser-form-inner-wrapper">
                    <section class="addUser-form-inputs-wrapper">
                        <label class="form-label">שם פרטי</label>
                        <input type="text" class="form-control written" name="first_name"
                            pattern="[A-Za-z\u0590-\u05FF]+">
                        <label class="form-label">ת"ז</label>
                        <input type="number" class="form-control written" name="id_number" min="0" max="9999999999">
                        <label class="form-label"> מחלקה</label>
                        <select name="name-department" class="form-select" id="name-department-select" required>
                            <option value="דימות" selected>דימות</option>
                        </select>
                    </section>

                    <section class="addUser-form-inputs-wrapper">
                        <label class="form-label">שם משפחה</label>
                        <input type="text" class="form-control written" name="last_name"
                            pattern="[A-Za-z\u0590-\u05FF]+">

                        <label class="form-label"> סיסמא</label>
                        <input type="password" class="form-control" name="password">

                        <label>אימייל</label>
                        <input type="email" class="form-control written" name="mail"
                            pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$">
                    </section>
                </section>
                <section class="addUser-form-inputs-wrapper">
                    <label class="form-label">סוג משתמש</label>
                    <select name="name-department" class="form-select" id="name-department-select" required>
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                    </select>
                </section>
                <input type="submit" id="addUser-submit-button" class="btn btn-primary" value="שמור"
                    name="update-profile_data">

            </form>



        </section>
    </main>
    <script src="js/script.js"></script>
</body>

</html>