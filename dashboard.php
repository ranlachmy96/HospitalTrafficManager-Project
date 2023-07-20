<?php
include "db.php";
include "config.php";

?>
<?php
session_start();
if (!$_SESSION["user_id"]) {
    echo "no user id";
    header('Location:' . URL . 'index.php');
}

?>


<?php
mysqli_set_charset($connection, "utf8");
$query = "SELECT * FROM tbl_213_queues";
$result = mysqli_query($connection, $query);
if (!$result) {
    die("DB query failed.");
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Medula+One&family=Metamorphous&family=Rubik&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/2a6eac1b83.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <title>dashboard</title>
</head>

<body>
    <header>
        <section id="mobile-profile-picture">
            <!-- <img src="images/hanna_persona_mobile_profile.png" alt="mobile profile photo" title="mobile profile photo"> -->
            <!-- <?php echo '<img src="' . $row1["img_user_menu_mobile"] . '">'; ?> -->

        </section>
        <section class="logo-con">
            <a href="index.php" id="logo"></a>
            <a href="index.php" id="logo-mobile"></a>
        </section>
        <nav>
            <!-- mobile -->
            <section>
                <input type="checkbox" id="menu-toggle" class="mobile-toggle-menu">
                <div class="hamburger"></div>
                <ul class="mobile-menu">
                    
                    <li  id="mobile-menu-header"><?php echo '<img src="' . $row1["img_user_menu"] . '"class="img-menu-aside">'; ?></li>
                       <li class="divider-item-space"></li>
                    <li><a href="dashboard.php"><i class="fa-solid fa-house"></i>&nbsp;לוח בקרה</a></li>
                    <li><a href="#"><i class="fa-solid fa-temperature-half"></i>&nbsp; מכסה מטופלים</a></li>
                    <li><a href="appointment.php"><i class="fa-regular fa-calendar-check"></i>&nbsp;זימון תורים</a>
                    </li>
                    <li class="divider-item"><a href="list.php"><i class="fa-solid fa-table-list"></i>&nbsp;רשימת
                            מטופלים</a></li>
                    <!-- <li class="divider-item-space"></li> -->
                    <li><a href="#"><i class="fa-solid fa-box"></i>&nbsp;לוגיסטיקה</a></li>
                    <li><a href="#"><i class="fa-solid fa-gear"></i>&nbsp;הגדרות</a></li>
                    
                                
                    <li><a href="editProfile.php"> <i class="fa-solid fa-pen"></i>&nbsp;עריכת פרופיל</a></li>
                    <?php
                    if ($_SESSION["user_type"] == "admin") {
                        echo '<li><a href="addUsers.php"><i class="fa-solid fa-address-card"></i>&nbsp; הוספת משתמש</a></li>';
                    }
                    ?>
                    <li><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;התנתקות</a></li>


                    <!-- <li class="white-color-divide"></li>
                    <li>
                        <a href="index.php" id="second-logo-mobile"></a>
                    </li> -->

                </ul>
            </section>
            <!-- web -->
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
                    <a class="nav-link active" aria-current="page" href="#">לוח בקרה </a>
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
                        }
                        ?>
                        <li><a class="dropdown-item" href="#">הגדרות</a></li>
                        <li><a class="dropdown-item" href="logout.php">התנתקות</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <main>

        <!-- chart -->


        <div class="graphbox">

            <div class="box">
                <h4>ניטור קיבולת מטופלים: מחלקת דימות</h4>

                <div class="chart-size"> <canvas id="myChart"></canvas></div>
            </div>
            <div class="box box-row2-col2">
                <h4>מכסה מטופלים -עומס</h4>
                <div class="chart-size"><canvas id="myChartload" class="myChartload1"></canvas></div>
            </div>
            <div class="box box-calendar">
                <!-- calender -->
                <div class="calendar">
                    <div class="header-calnder">
                        <button id="prevBtn">&lt;</button>
                        <div class="month" id="current-month">יולי 2023</div>
                        <button id="nextBtn">&gt;</button>
                    </div>
                    <div class="weekdays">
                        <div class="day">ראשון</div>
                        <div class="day">שני</div>
                        <div class="day">שלישי</div>
                        <div class="day">רביעי</div>
                        <div class="day">חמישי</div>
                        <div class="day">שישי</div>
                        <div class="day">שבת</div>
                    </div>
                    <div class="days" id="calendar-days">
                    </div>
                </div>
            </div>



            <!-- row2 -->

            <div class="box box-task-manager">
                <div class="task-manager">
                    <h4>הוספת משימה</h4>
                    <div class="add-task">
                        <input type="text" id="taskInput" placeholder="משימה חדשה">
                        <button id="addButton">הוספה</button>
                    </div>
                    <ul id="taskList"></ul>
                </div>
            </div>
            <div class="box">
                <h4>מלאי לוגיסטיקה </h4>
                <div class="chart-size"> <canvas id="chart-col"></canvas></div>
            </div>
            <div class="box box-messages">
                <div class="dashboard-flex-h4">
                    <h4>הודעות אחרונות</h4>
                    <i class="fa-regular fa-envelope" id="dashborad-icon"></i>
                </div>
                <div class="dashboard-divider-gray"></div>
                <div class="dashboard-flex-table">
                    <table class="table">
                        <thead class="dashboard-table-message">
                            <tr>
                                <th>מוען</th>
                                <th>נושא</th>
                                <th>שעה</th>
                            </tr>
                        </thead>
                        <tbody class="dashboard-table-message">
                            <tr class="dashboard-system-message">
                                <td> מערכת</td>
                                <td>עומס קל</td>
                                <td>9:55</td>
                            </tr>
                            <tr>
                                <td>ד"ר ארז</td>
                                <td>בקשה העברה</td>
                                <td>9:00</td>
                            </tr>
                            <tr>
                                <td>ד"ר אבי</td>
                                <td>קביעה פגישה</td>
                                <td>8:50</td>
                            </tr>
                            <tr>
                                <td>ד"ר נוי</td>
                                <td>קביעה פגישה</td>
                                <td>8:00</td>
                            </tr>
                            <tr>
                                <td>ד"ר רן</td>
                                <td>ביטול פגישה</td>
                                <td>7:40</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- row 3 -->
        <div class="dashbord-list-Patients">
            <div class="box box-list">
                <!-- list patients -->
                <section class="list-Wrapper-table">
                    <h4 class="dashboard-h4">רשימת תורים במחלקות ביה"ח</h4>
                    <table class="table">
                        <thead class="table-dashboard">
                            <tr>
                                <th class="tbl-color-dashboard"></th>
                                <th class="tbl-color-dashboard" scope="col">שם מחלקה</th>
                                <th class="tbl-color-dashboard" scope="col">קיבולת מטופלים </th>
                                <th class="tbl-color-dashboard" scope="col">כמות מטופלים כרגע</th>
                                <th class="tbl-color-dashboard" scope="col">מצב קשה </th>
                                <th class="tbl-color-dashboard" scope="col">מצב בינוני</th>
                                <th class="tbl-color-dashboard" scope="col">מצב קל</th>
                                <th class="tbl-color-dashboard" scope="col">כמות צוות רפואי</th>
                                <th class="tbl-color-dashboard" scope="col"> אחראי מחלקה</th>
                                <th class="tbl-color-dashboard" scope="col">תפקיד</th>

                            </tr>
                        </thead>
                        <tbody class="table-dashboard">
                            <?php
                            for ($i = 0; $i < 5 && $row = mysqli_fetch_assoc($result); $i++) {
                                echo '<tr class="colored-row">';
                                echo '<td class="color-according"></td>';
                                echo '<td class="color-according" data-title="שם מחלקה">' . $row["name_department"] . '</td>';
                                echo '<td class="color-according dash-capacity" data-title="קיבולת מטופלים">' . $row["capacity"] . '</td>';
                                echo '<td class="color-according dash-current" data-title="כמות מטופלים כרגע">' . $row["Number_of_patients_currently"] . '</td>';
                                echo '<td class="color-according" data-title=" מצב קשה">' . $row["severe"] . '</td>';
                                echo '<td class="color-according" data-title="מצב בינוני">' . $row["medium"] . '</td>';
                                echo '<td class="color-according" data-title="מצב קל">' . $row["easy"] . '</td>';
                                echo '<td class="color-according" data-title="כמות צוות רפואי">' . $row["quantity_of_medical_staff"] . '</td>';
                                echo '<td  class="color-according" data-title="אחראי מחלקה">' . $row["responsible_manager"] . '</td>';
                                echo '<td class="color-according"  data-title="תפקיד">' . $row["type_responsible_manager"] . '</td>';
                                echo '<i class="bi bi-chevron-left"></i></a></td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </section>
                <?php
                mysqli_free_result($result);
                ?>
                </section>
            </div>
        </div>
        <div class="dashboard-mobile">
            <div class="dashboard-mobile-Container">
                <div class="dashboard-mobile-h3">
                            <div class="dashboard-flex-h4">
                            <h4>הודעות אחרונות</h4>
                            <i class="fa-regular fa-envelope" id="dashborad-icon"></i>
                        </div>
                </div>


                <div class="dashboard-mobile-divider"></div>
                <div class="dashboard-mobile-h4">
                    <div>
                        <h4>הודעת מערכת</h4>
                    </div>
                    <div>
                        <h4> עומס קל בבדיקה ראשונית</h4>
                    </div>
                    <div>
                        <h4> 9:30</h4>
                    </div>
                </div>
            </div>

            <div class="dashboard-mobile-grid">
                <div class="dashboard-box-mobile">
                    <h3><a class="nav-link" href="list.php">רשימת מטופלים</a></h3>

                    <a class="nav-wrapper" href="list.php">
                        <i class="fa-solid fa-clipboard-list" id="size-mobile-icon1"></i>
                    </a>
                </div>
                <div class="dashboard-box-mobile" id="dashboard-box-mobile-savebutton">
                    <h3><a class="nav-link" href="#"> לחצן מצוקה</a></h3>

                    <a class="nav-wrapper" href="#">
                        <i class="fa-solid fa-bell" id="size-mobile-icon2"></i>
                    </a>
                    <div id="message-overlay">
                        <div id="message-box">
                            <span id="message-text"></span>
                            <i class="bi bi-check-lg"></i>
                        </div>
                    </div>

                </div>
                <div class="dashboard-box-mobile">

                    <h3><a class="nav-link" href="logout.php"> התנתקות</a></h3>

                    <a class="nav-wrapper" href="logout.php">
                        <i class="fa-solid fa-arrow-right-from-bracket" id="size-mobile-icon3"></i>
                    </a>

                </div>
            </div>

        </div>


    </main>


    <script src="js/script.js"></script>
</body>

</html>
<?php
mysqli_close($connection);
?>