<?php
include "db.php";
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
  <script src="https://kit.fontawesome.com/2a6eac1b83.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
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

          <li><a href="#"><i class="fa-solid fa-house"></i>&nbsp;לוח בקרה</a></li>
          <li><a href="#"><i class="fa-solid fa-temperature-half"></i>&nbsp; מכסה מטופלים</a></li>
          <li><a href="appointment.php"><i class="fa-regular fa-calendar-check"></i>&nbsp;זימון תורים</a>
          </li>
          <li class="divider-item"><a href="list.php"><i class="fa-solid fa-table-list"></i>&nbsp;רשימת מטופלים</a>
          </li>

          <li class="divider-item-space"></li>
          <li><a href="#"><i class="fa-solid fa-box"></i>&nbsp;לוגיסטיקה</a></li>
          <li><a href="#"><i class="fa-solid fa-gear"></i>&nbsp;הגדרות</a></li>
          <li class="divider-item"><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;התנתקות</a>
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
          <a class="nav-link active" href="list.php">רשימת מטופלים</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="appointment.php">זימון תורים</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">מכסה מטופלים</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">לוח בקרה
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
            <img src="images/hanna-persona-profile.png" alt="profile picture" title="profile picture">
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">עריכת פרופיל</a></li>
            <li><a class="dropdown-item" href="#">הגדרות</a></li>
            <li><a class="dropdown-item" href="#">התנתקות</a></li>
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
        <section class="center-form-search">
          <section class="form_container">
            <form id="search-list">
              <div class="form-control-wrapper">
                <label class="form-label">
                </label>
                <input type="search" class="form-control" placeholder="חיפוש">
              </div>
            </form>
          </section>
        </section>
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
        <table class="table">
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
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<tr>';
              echo '<td class="list-icons">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteModal" data-person-id="' . $row["id_number"] . '">
              <i class="bi bi-x-circle-fill"></i></button></td>';
              echo '<td class="list-icons"><button><i class="bi bi-pencil"></i></button></td>';
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
    <!-- Modal-Delete-Data -->
  </main>
  <script src="js/script.js"></script>
</body>

</html>

<?php
mysqli_close($connection);
?>
