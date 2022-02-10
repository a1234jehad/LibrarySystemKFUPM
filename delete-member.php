<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify book</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify book</title>
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
<body style="background-color: white;">
<div>
<?php
session_start(); 
$s_kid = $_SESSION['s_kid'];
$role = $_SESSION['role'];
if($role != 'admin'){
  header('Location: access-denied.php');
}
?>
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
</div>

<div class="cent" style="margin-bottom: 3%;">
<h1 style="color:black;">Deleting a Member!</h1>
    <img src="logo.png" alt="logo" class="resize">
  
  <?php
  $user = 'root';
  $pass = '';
  $db = 'library1';
  $db = new mysqli('localhost',$user,$pass,$db) or die("Unable to connect");
  $sql = "SELECT kfupm_id FROM member ;";   
  $result = $db->query($sql);

?>

 <form action="" class="" method="GET" >
<!---------------------- Get ISBNs ------------------------->
<div class="card card-body" style="margin-top: 2%;" >
  <select class="form-select" aria-label="Default select example" method = "GET" name = "selectISBN">
    <option selected>Choose the KFUPM ID</option>
<?php
  while($row = $result->fetch_assoc()) {
    $ISBN = $row['kfupm_id'];
   echo "<option value='$ISBN'>$ISBN</option>"; 
  }
 $ISBNvalue = $_GET['selectISBN'];
?> 
</select>
<button name = "update1" style="margin: 4%;" type="submit" class="btn btn-success">Delete this member!</button>
    </div>


</form>






</div>
</body>
</html>
</body>
</html>
<?php 

if(isset($_GET['selectISBN'])){
  if(isset($_GET['update1'])){
    $newinput = $_GET['selectISBN'];
    $sql = "DELETE FROM `member` WHERE `kfupm_id` = '$ISBNvalue';"; 
    $query = mysqli_query($db, $sql);
    echo '<script type = "text/javascript"> alert ("Member Deleted!") </script>';
    echo '<script type="text/JavaScript"> 
        location.replace("delete-member.php"); </script>';
  }}