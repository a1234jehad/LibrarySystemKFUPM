<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="admin-styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">
</head>
<body>
<section>
     <div class="container-fluid bg-success ">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
      <div style="float:left;">
       <a class="navbar-brand" href="admin-page.php" id= "website-name">
         <img src="logo.png" alt="" width="100" height="100" class="d-inline-block align-text-mid">
         KFUPM LIBRARY SYSTEM
       </a>
       </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link" href="checkOut-admin.php">Check_Outs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Reservations-admin.php">Reservations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="return-admin.php">Returned</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"style="color: red;" href="addmember.php">Add_Member</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"style="color: red;" href="delete-member.php">Delete_Member</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"style="color: red;" href="addbook.php">Add_Book</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"style="color: red;" href="modifybook.php">Modify_Book</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"style="color: red;" href="reports.php">Reports</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"style="color: red;" href="log-out.php">Log out</a>
          </li>
        </ul>
 <!--Search Form-->
 <form action="searchpage.php" class="d-flex" method="GET">
          <!--Get word-->
          <input name="word" class="form-control me-2" type="search" placeholder="title, author, subject, category publication date" aria-label="Search">
          <button class="btn btn-secondary" type="submit" >Search</button>
        </form>
        <!--End of Search Form-->
      </div>
    </div>
  </nav>
  </div>

</section>
    <div class="container d-flex align-items-center justify-content-center ">
    <div style="margin-top: 2%  ;" class="btn-group-vertical ">
    <form action="" class="btn-group-vertical " method="GET" >
    <button name = "report1"  style="margin-top: 1%;" type="submit" class="btn btn-success">Get New members who were added this year but did not check out any book</button>
    <button name = "report2"  style="margin-top: 1%;" type="submit" class="btn btn-success">Get the List of all members and their penalty amounts</button>
    <button name = "report3"  style="margin-top: 1%;" type="submit" class="btn btn-success">Get the List of members who more than 3 books and who have exceeded 120 days for at least one book.  </button>
    <button name = "report4"  style="margin-top: 1%;" type="submit" class="btn btn-success">Get the List of members who check out books but return them at least one day before due date.  </button>
    </form>
    </div>
    </div>
   
    <?php 
    $user = 'root';
    $pass = '';
    $db = 'library1';
    $db = new mysqli('localhost',$user,$pass,$db) or die("Unable to connect");
    $dateofyear = date('Y-m-d', strtotime('first day of january this year'));
    $date_now = date('Y-m-d');
    $sql1 = "SELECT b.Fname, b.Lname, a.kfupm_id FROM `member` a NATURAL JOIN person b WHERE a.Date_Created >= '$dateofyear' AND a.kfupm_id NOT iN ( SELECT b.kfupm_id FROM check_out b );";
    $sql2 = "SELECT b.Fname, b.Lname, a.kfupm_id FROM member a NATURAL JOIN person b WHERE a.kfupm_id IN( SELECT c.kfupm_id FROM check_out c WHERE c.Due_Date<'$date_now' );";
    $sql4 = "SELECT b.Fname, b.Lname, a.kfupm_id FROM member a NATURAL JOIN person b WHERE a.kfupm_id NOT IN( SELECT c.kfupm_id FROM check_out c WHERE c.Due_Date<'$date_now' );";


    
    if(isset($_GET['report1'])){
        $result = $db->query($sql1);
        if ($result->num_rows > 0) {
            // output data of each row
            echo "<br>";
            echo "<h2 style=\"text-align:center;\">New members who were added this year but did not check out any book:</h2><br>";
            
            while($row = $result->fetch_assoc()) {
                echo "<p style=\"text-align:center;\">id: " . $row["kfupm_id"]. " - Name: " . $row["Fname"]. " " . $row["Lname"]. "</p>";
            }
        } else {
            echo "0 results";
        }
    }
    if(isset($_GET['report2'])){
        $result = $db->query($sql2);
        if ($result->num_rows > 0) {
            // output data of each row
            echo "<br>";
            echo "<h2 style=\"text-align:center;\" >List of all members and their penalty amounts:</h2>";
            while($row = $result->fetch_assoc()) {
                $id = $row["kfupm_id"];
                $sql44 = "SELECT c.Due_Date FROM check_out c WHERE c.Due_Date<'$date_now' AND c.kfupm_id='$id';";
                $Due = $db->query($sql44)->fetch_row()[0];
                $date1 = new DateTime($Due);
                $date2 = new DateTime($date_now);
                $days  = $date2->diff($date1)->format('%a');
                echo "<p style=\"text-align:center;\">id: " . $row["kfupm_id"]. " - Name: " . $row["Fname"]. " " . $row["Lname"]. " Penalty amount: ".($days). "SR</p>";
            }
        } else {
            echo "0 results";
        }
    }
    if(isset($_GET['report3'])){
        $result = $db->query($sql2);
        $check = 0;
        if ($result->num_rows > 0) {
            // output data of each row
            echo "<br>";
            echo "<h2 style=\"text-align:center;\">List of members who more than 3 books and who have exceeded 120 days for at least one book:</h2>";
            while($row = $result->fetch_assoc()) {
                $id = $row["kfupm_id"];
                $sql44 = "SELECT c.Due_Date FROM check_out c WHERE c.Due_Date<'$date_now' AND c.kfupm_id='$id';";
                $Due = $db->query($sql44)->fetch_row()[0];
                $date1 = new DateTime($Due);
                $date2 = new DateTime($date_now);
                $days  = $date2->diff($date1)->format('%a');
                $sql55 = "SELECT COUNT(*) FROM `check_out` WHERE `kfupm_id` = '$id';";
                $numberofbooks = $db->query($sql55)->fetch_row()[0];
                if($days >=120 && $numberofbooks >=3){
                echo "<p style=\"text-align:center;\"> id: " . $row["kfupm_id"]. " - Name: " . $row["Fname"]. " " . $row["Lname"]."</p>";
                $check++;
            }
            }
        } 
        elseif($check=0){
            echo "0 results";
        }
        else {
            echo "0 results";
        }
        
    }
    if(isset($_GET['report4'])){
        $result = $db->query($sql4);
        if ($result->num_rows > 0) {
            // output data of each row
            echo "<br>";
            echo "<h2 style=\"text-align:center;\"> members who check out books but return them at least one day before due date:</h2>";
            while($row = $result->fetch_assoc()) {
                echo "<p style=\"text-align:center;\"> id: " . $row["kfupm_id"]. " - Name: " . $row["Fname"]. " " . $row["Lname"]. "</p>";
            }
        } else {
            echo "0 results";
        }
    }
  
    
    ?>
   


</body>
</html>