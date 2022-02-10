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
<h1 style="color:black;">Modifying a book</h1>
    <img src="logo.png" alt="logo" class="resize">
  
  <?php
  $user = 'root';
  $pass = '';
  $db = 'library1';
  $db = new mysqli('localhost',$user,$pass,$db) or die("Unable to connect");
  $sql = "SELECT ISBN FROM `book`";   
  $result = $db->query($sql);
  $checker_two = 0;
  $checker_first = True;
?>

 <form action="" class="" method="GET" >
<!---------------------- Get ISBNs ------------------------->
<div class="card card-body" style="margin-top: 2%;" >
  <select class="form-select" aria-label="Default select example" method = "GET" name = "selectISBN">
    <option selected>Choose the ISBN</option>
<?php
  while($row = $result->fetch_assoc()) {
    $ISBN = $row['ISBN'];
   echo "<option value='$ISBN'>$ISBN</option>"; 
  }
 $ISBNvalue = $_GET['selectISBN'];
?> 
</select>
    </div>
<!---------------------- Availability ------------------------->
   <div class="" id="collapseExample">
  <div class="card card-body">
  <label for="exampleInputEmail1" class="form-label">Change Availability</label>
  <select class="form-select" aria-label="Default select example" name = "Avaliable">

<option selected>Select</option>
<option  value="0">Avaliable</option>
<option  value="1">Unavaliable</option>
</select>
       <button name = "update1" style="margin: 4%;" type="submit" class="btn btn-success">Update</button>
  </div>
</div>
<!---------------------- Title ------------------------->
<div class="" id="collapseExample">
  <div class="card card-body">
  <label for="exampleInputEmail1" class="form-label">Change Title</label>
    <input placeholder="Enter the title" type="aval" class="form-control" name = "title" id="exampleInputEmail1">   
    <button name = "update2" style="margin: 4%;" type="submit" class="btn btn-success">Update</button>
  </div>
</div>
<!---------------------- Publish Date ------------------------->
<div class="" id="collapseExample">
  <div class="card card-body">
  <label for="exampleInputEmail1" class="form-label">Change Publish Date</label>
    <input placeholder="Enter the publish date" type="aval" class="form-control" name = "pub" id="exampleInputEmail1">   
    <button name = "update3" style="margin: 4%;" type="submit" class="btn btn-success">Update</button>
  </div>
</div>
<!---------------------- Rack Number ------------------------->
<div class="" id="collapseExample">
  <div class="card card-body">
  <label for="exampleInputEmail1" class="form-label">Change Rack Number</label>
    <input placeholder="Enter the rack number" type="aval" class="form-control" name = "rack" id="exampleInputEmail1">   
    <button name = "update4" style="margin: 4%;" type="submit" class="btn btn-success">Update</button>
  </div>
</div>
<!---------------------- Image ------------------------->
<div class="" id="collapseExample">
  <div class="card card-body">
  <label for="exampleInputEmail1" class="form-label">Add URL to change the image</label>
    <input placeholder="Enter the image URL" type="aval" class="form-control" name = "img" id="exampleInputEmail1">   
    <button name = "update5" style="margin: 4%;" type="submit" class="btn btn-success">Update</button>
  </div>
</div>
<!---------------------- Add an Author ------------------------->
<div class="" id="collapseExample">
  <div class="card card-body">
  <label for="exampleInputEmail1" class="form-label">Add an author for the selected book</label>
    <input placeholder="Enter the author name" type="aval" class="form-control" name = "Addauthor" id="exampleInputEmail1">   
    <button name = "update6" style="margin: 4%;" type="submit" class="btn btn-success">Update</button>
  </div>
</div>
<!---------------------- Delete an Author ------------------------->
<div class="" id="collapseExample">
  <div class="card card-body">
  <label for="exampleInputEmail1" class="form-label">Delete an author for the selected book</label>
    <input placeholder="Enter the author name" type="aval" class="form-control" name = "deleteauthor" id="exampleInputEmail1">   
    <button name = "update7" style="margin: 4%;" type="submit" class="btn btn-success">Update</button>
  </div>
</div>
<!---------------------- Add a Category ------------------------->
<div class="" id="collapseExample">
  <div class="card card-body">
  <label for="exampleInputEmail1" class="form-label">Add a category for the selected book</label>
    <input placeholder="Enter the category name" type="aval" class="form-control" name = "Addcat" id="exampleInputEmail1">   
    <button name = "update8" style="margin: 4%;" type="submit" class="btn btn-success">Update</button>
  </div>
</div>
<!---------------------- Delete a Category ------------------------->
<div class="" id="collapseExample">
  <div class="card card-body">
  <label for="exampleInputEmail1" class="form-label">Delete a category for the selected book</label>
    <input placeholder="Enter the category name" type="aval" class="form-control" name = "deletecat" id="exampleInputEmail1">   
    <button name = "update9" style="margin: 4%;" type="submit" class="btn btn-success">Update</button>
  </div>
</div>
</form>









  <!-- <div class="mb-3">
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
    <label for="exampleInputEmail1" class="form-label">Enter the Category(optional):</label>
    <input type="cat" class="form-control" name="cat" id="exampleInputEmail1">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Enter the Author name(optional):</label>
    <input type="AN" class="form-control" name="AN" id="exampleInputEmail1">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Enter the book item(optional):</label>
    <input type="BI" class="form-control" name="BI" id="exampleInputEmail1">
  </div> -->
  
  <!-- <button  style="margin: 4%;" type="submit" class="btn btn-success">Modify</button> -->

</div>
</body>
</html>
</body>
</html>
<?php 

if(isset($_GET['selectISBN'])){
  if(isset($_GET['update1'])){
    $newinput = $_GET['Avaliable'];
    $sql = "UPDATE `book` SET Avalibale = '".$newinput."' WHERE ISBN = '".$ISBNvalue."' "; 
    $query = mysqli_query($db, $sql);
  }
  if(isset($_GET['update2'])){
    $newinput = $_GET['title'];
    $sql = "UPDATE `book` SET Title = '".$newinput."' WHERE ISBN = '".$ISBNvalue."' "; 
    $query = mysqli_query($db, $sql);
  }
  if(isset($_GET['update3'])){
    $newinput = $_GET['pub'];
    $sql = "UPDATE `book` SET Pub_Date = '".$newinput."' WHERE ISBN = '".$ISBNvalue."' "; 
    $query = mysqli_query($db, $sql);
  }
  if(isset($_GET['update4'])){
    $newinput = $_GET['rack'];
    $sql = "UPDATE `book` SET RackNumber = '".$newinput."' WHERE ISBN = '".$ISBNvalue."' "; 
    $query = mysqli_query($db, $sql);
  }
  if(isset($_GET['update5'])){
    $newinput = $_GET['img'];
    $sql = "UPDATE `book` SET img = '".$newinput."' WHERE ISBN = '".$ISBNvalue."' "; 
    $query = mysqli_query($db, $sql);
  }
  if(isset($_GET['update6'])){
    $newinput = $_GET['Addauthor'];
    $sql = "INSERT INTO `author` (`ISBN`, `Name`) VALUES ('$ISBNvalue', '$newinput')"; 
    $query = mysqli_query($db, $sql);
  }
  if(isset($_GET['update7'])){
    $newinput = $_GET['deleteauthor'];
    $sql = "DELETE FROM `author` WHERE ISBN = '".$ISBNvalue."' and `Name`LIKE '%".$newinput."%' "; 
    $query = mysqli_query($db, $sql);
  }
  if(isset($_GET['update8'])){
    $newinput = $_GET['Addcat'];
    $sql = "INSERT INTO `subject` (`ISBN`, `Category`) VALUES ('$ISBNvalue', '$newinput')"; 
    $query = mysqli_query($db, $sql);
  }
  if(isset($_GET['update9'])){
    $newinput = $_GET['deletecat'];
    $sql = "DELETE FROM `subject` WHERE ISBN = '".$ISBNvalue."' and `Category`LIKE '%".$newinput."%' "; 
    $query = mysqli_query($db, $sql);
   } 
    if($query){
      echo '<script type = "text/javascript"> alert ("Data updated, thanks!") </script>';
    }
    else {
      echo '<script type = "text/javascript"> alert ("We are facing a problem, please try again") </script>';
    }
}
?>