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
$query = "SELECT * FROM tbl_213_patients";
$result = mysqli_query($connection, $query);
if (!$result) {
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
                    <li class="divider-item"><a href="#"><i
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
                    <a class="nav-link active" aria-current="page" href="#">לוח בקרה </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">
                        <img src="images/hanna-persona-profile.png" alt="profile picture" title="profile picture">
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">עריכת פרופיל</a></li>
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
                <canvas id="myChart"></canvas>
            </div>
            <div class="box">
                <h4>מכסה מטופלים -עומס</h4>
                <canvas id="myChartload"></canvas>
            </div>
            <div class="box">
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
        </div>
        <div class="dashbord-chart-row2">
            <div class="box">
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
                <canvas id="chart-col"></canvas>
            </div>
            <div class="box">
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
        <div class="dashbord-list-Patients">
            <div class="box">
                <!-- list patients -->
                <section class="list-Wrapper-table">
                    <h4 class="dashboard-h4">רשימת תורים במחלקות ביה"ח</h4>
                    <table class="table">
                        <thead class="table-dashboard">
                            <tr>
                                <th class="tbl-color-dashboard"></th>
                                <th class="tbl-color-dashboard" scope="col">מספר</th>
                                <th class="tbl-color-dashboard" scope="col">שם פרטי</th>
                                <th class="tbl-color-dashboard" scope="col">שם משפחה</th>
                                <th class="tbl-color-dashboard" scope="col">גיל</th>
                                <th class="tbl-color-dashboard" scope="col">מין</th>
                                <th class="tbl-color-dashboard" scope="col">דחיפות</th>
                                <th class="tbl-color-dashboard" scope="col">סוגי דימות</th>
                                <th class="tbl-color-dashboard" scope="col">שעה</th>
                                <th class="tbl-color-dashboard" scope="col">תאריך</th>
                            </tr>
                        </thead>
                        <tbody class="table-dashboard">
                            <?php
                            for ($i = 0; $i < 4 && $row = mysqli_fetch_assoc($result); $i++) {
                                echo '<tr>';
                                echo '<td class="tbl-color-dashboard"></td>';
                                echo '<td class="tbl-color-dashboard" data-title="מספר">' . $row["id_number"] . '</td>';
                                echo '<td class="tbl-color-dashboard" data-title="שם פרטי">' . $row["first_name"] . '</td>';
                                echo '<td class="tbl-color-dashboard" data-title="שם משפחה">' . $row["last_name"] . '</td>';
                                echo '<td class="tbl-color-dashboard" data-title="גיל">' . $row["age"] . '</td>';
                                echo '<td class="tbl-color-dashboard" data-title="מין">' . $row["gender"] . '</td>';
                                echo '<td class="tbl-color-dashboard" data-title="דחיפות">' . $row["urgency"] . '</td>';
                                echo '<td class="tbl-color-dashboard" data-title="סוגי דימות">' . $row["type"] . '</td>';
                                echo '<td class="tbl-color-dashboard" data-title="שעה">' . $row["time"] . '</td>';
                                echo '<td class="tbl-color-dashboard" data-title="תאריך">' . $row["date"] . '</td>';
                                echo '<a href="patientProfile.php?patientId=' . $row["id_number"] . '">';
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
    </main>


    <script src="js/script.js"></script>
</body>

</html>
<?php
mysqli_close($connection);
?>