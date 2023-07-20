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
mysqli_set_charset($connection, "utf8");
$query = "SELECT * FROM tbl_213_patients";
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://kit.fontawesome.com/2a6eac1b83.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>List</title>
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

          <li id="mobile-menu-header">
            <?php echo '<img src="' . $row1["img_user_menu"] . '"class="img-menu-aside">'; ?>
          </li>
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
      <ul class="nav nav-tabs">

        <li class="nav-item">
          <a class="nav-link" href="#">לוגיסטיקה</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="list.php">רשימת מטופלים</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="appointment.php">זימון תורים</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">מכסה מטופלים</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="dashboard.php">לוח בקרה
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
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
    <section id="listWrapper">
      <section id="view_real_time">
        <section class="blue-view">
          <section class="all-container">
            <section class="title-text">
              <h6>MRI</h6>
            </section>
            <section class="blue">
              <section class="text-blue">
                <h6>שם: שלומי שבת</h6>
                <h6>M15 :מספר</h6>
              </section>
            </section>
          </section>

          <section class="all-container">
            <section class="title-text">
              <h6>CT</h6>
            </section>
            <section class="blue">
              <section class="text-blue">
                <h6>שם: דביר ישראל</h6>
                <h6>C15 :מספר</h6>
              </section>
            </section>
          </section>
          <section class="all-container">
            <section class="title-text">
              <h6>רנגטן</h6>
            </section>
            <section class="blue">
              <section class="text-blue">
                <h6>שם: אנה קשתי</h6>
                <h6>R10 :מספר</h6>
              </section>
            </section>
          </section>
          <section class="all-container">
            <section class="title-text">
              <h6>אולטרסאונד</h6>
            </section>
            <section class="blue">
              <section class="text-blue">
                <h6>שם: עומר דרור</h6>
                <h6>A11 :מספר</h6>
              </section>
            </section>
          </section>
          <section class="text-aside">
            <section class="text-blue">
              <h6>בטיפול</h6>
              <h6>כרגע</h6>
            </section>
          </section>
        </section>
      </section>
      <!-- form search -->
      <section class="container-list">
        <!-- <section class="center-form-search">
          <section class="form_container">
            <form id="search-list">
              <div class="form-control-wrapper">
                <label class="form-label">
                </label>
                <input type="search" id="form-control-list" class="form-control" placeholder="חיפוש">
              </div>
            </form>
          </section>
        </section> -->
        <section class="search-wrapper-pluse">
          <section class="plus">
            <a href="appointment.php">
              <i class="bi bi-plus-circle-fill"></i>
            </a>
            <p>הוספה</p>
          </section>
        </section>
      </section>

      <br>
      <!-- list patients -->
      <section class="list-Wrapper-table">
        <table class="table" id="example">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th scope="col">מספר</th>
              <th scope="col">שם פרטי</th>
              <th scope="col">שם משפחה</th>
              <th scope="col">גיל</th>
              <th scope="col">מין</th>
              <th scope="col">דחיפות</th>
              <th scope="col">סוגי דימות</th>
              <th scope="col">שעה</th>
              <th scope="col">תאריך</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM tbl_213_patients ORDER BY 
            CASE urgency
              WHEN 'קשה' THEN 1
              WHEN 'בינוני' THEN 2
              WHEN 'קל' THEN 3
              ELSE 4  -- Handles any other urgency value that may exist
            END DESC,
            STR_TO_DATE(date, '%Y-%m-%d') ASC";

            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
              echo '<tr>';
              echo '<td class="list-icons">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteModal" data-person-id="' . $row["id_number"] . '">
              <i class="bi bi-x-circle-fill"></i></button></td>';
              echo '<td class="list-icons">
              <button type="button" class="btn btn-primary editbtn" data-bs-toggle="modal" data-bs-target="#updateModal" data-person-id="' . $row["id_number"] . '">
              <i class="bi bi-pencil"></i></button></td>';
              echo '<td data-title="מספר">' . $row["id_number"] . '</td>';
              echo '<td data-title="שם פרטי">' . $row["first_name"] . '</td>';
              echo '<td data-title="שם משפחה">' . $row["last_name"] . '</td>';
              echo '<td data-title="גיל">' . $row["age"] . '</td>';
              echo '<td data-title="מין">' . $row["gender"] . '</td>';
              echo '<td data-title="דחיפות">' . $row["urgency"] . '</td>';
              echo '<td data-title="סוגי דימות">' . $row["type"] . '</td>';
              echo '<td data-title="שעה">' . $row["time"] . '</td>';
              echo '<td data-title="תאריך">' . $row["date"] . '</td>';
              echo '<td class="left-arrow" data-title="כניסה">';
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

    
    <!-- Modal-Delete-Data -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title" id="deleteModalLabel">ביטול התור</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="deleteData.php" method="POST" id="deleteForm">
            <input type="hidden" name="delete_id" id="delete_id">
            <div class="modal-body">
              לבטל את התור?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                id="list-delete-cancel-button">ביטול</button>
              <button type="submit" name="deletedata" class="btn btn-primary"
                id="list-delete-agree-button">אישור</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal-Update-Data -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" id="list-update-modal-content">
          <div class="modal-header" id="list-update-modal-header">
            <h5 class="modal-title" id="updateModalLabel">עריכת פרטים</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="UpdateData.php" method="POST" id="updateForm">
            <input type="hidden" name="update_id" id="update_id">
            <div class="modal-body" id="list-update-modal-body-wrapper">
              <label>שם פרטי</label>
              <input type="text" class="form-control written" name="first_name" value=""
                pattern="[A-Za-z\u0590-\u05FF]+" id="first_name">
              <label>שם משפחה</label>
              <input type="text" class="form-control written" name="last_name" value="" pattern="[A-Za-z\u0590-\u05FF]+"
                id="last_name">
              <label>גיל</label>
              <input type="number" class="form-control" name="age" min="0" max="120 " value="" id="age">
              <label>מגדר</label>
              <select name="gender" class="form-select" required id="gender">
                <option value="נקבה">נקבה</option>
                <option value="זכר">זכר</option>
                <option value="אחר">אחר</option>
              </select>
              <label>דחיפות רפואית</label>
              <select name="urgency" class="form-select" id="urgency" required>
                <option value="קל">קל</option>
                <option value="בינוני">בינוני</option>
                <option value="קשה">קשה</option>
              </select>
              <label>סוג דימות</label>
              <select name="image_type" class="form-select" required id="image_type">
                <option value="">-</option>
                <option value="x-ray">רנטגן</option>
                <option value="C.T">C.T</option>
                <option value="ultrasound">אולטרסאונד</option>
                <option value="M.R.I">M.R.I</option>
              </select>
              <label>שעה</label>
              <input type="time" class="form-control written" name="time" value="" id="time">
              <label>תאריך</label>
              <input type="date" class="form-control written" name="date" value="" id="date">
            </div>
            <div class="modal-footer" id="list-update-modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                id="list-update-cancel-button">ביטול</button>
              <button type="submit" name="updatedata" class="btn btn-primary"
                id="list-update-agree-button">אישור</button>
            </div>
          </form>
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