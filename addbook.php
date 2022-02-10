<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<?php
session_start(); 
$s_kid = $_SESSION['s_kid'];
$role = $_SESSION['role'];
if($role != 'admin'){
  header('Location: access-denied.php');
}
?>
<body style="background-color: white;">
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
<div class="cent">
<h1 style="color:black;">Adding a book</h1>
    <img src="logo.png" alt="logo" class="resize">
<form action="bookadded.php" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Enter the ISBN:</label>
    <input type="ISBN" class="form-control" name="ISBN" id="exampleInputEmail1">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Enter 0 if Avaliable or 1 if not :</label>
    <input type="aval" class="form-control" name="aval" id="exampleInputEmail1">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Enter the Pub_Date:</label>
    <input type="PD" class="form-control" name="PD" id="exampleInputEmail1">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Enter the Barcode:</label>
    <input type="BC" class="form-control" name="BC" id="exampleInputEmail1">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Enter the Title:</label>
    <input type="title" class="form-control" name="title" id="exampleInputEmail1">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Enter the RackNumber:</label>
    <input type="RC" class="form-control" name="RC" id="exampleInputEmail1">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Enter the url for the image:</label>
    <input type="img" class="form-control" name="img" id="exampleInputEmail1">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Enter the Category(seperated by ","):</label>
    <input type="cat" class="form-control" name="cat" id="exampleInputEmail1">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Enter the Author name(seperated by ","):</label>
    <input type="AN" class="form-control" name="AN" id="exampleInputEmail1">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Enter the book item(seperated by ","):</label>
    <input type="BI" class="form-control" name="BI" id="exampleInputEmail1">
  </div>

  
  <button type="submit" class="btn btn-success">ADD</button>
</form>
</div>
</body>
</html>