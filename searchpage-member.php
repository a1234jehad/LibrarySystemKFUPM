<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">
</head>
<body>
<?php
session_start(); 
$s_kid = $_SESSION['s_kid'];
$role = $_SESSION['role'];
if($role != 'member'){
  header('Location: access-denied.php');
}
?>
<section>
     <div class="container-fluid bg-success ">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
      <div style="float:left;">
       <a class="navbar-brand" href="member-page.php" id= "website-name">
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
            <a class="nav-link" href="checkOut.php">Check_Outs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Reservations.php">Reservations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="return.php">Returned</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"style="color: red;" href="log-out.php">Log out</a>
          </li>
        </ul>
        <!--Search Form-->
        <form action="searchpage-member.php" class="d-flex" method="GET">
          <input name="word" class="form-control me-2" type="search" placeholder="title, author, subject, category publication date" aria-label="Search">
          <button class="btn btn-secondary" type="submit" >Search</button>
        </form>
      </div>
    </div>
  </nav>
  </div>

</section>

<div>
  <!--Print word in the header-->
<h2>Books about "<?php echo $_GET['word']?>"</h2>
<section>

<div id="carouselExampleControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-inner">
  <?php
    $sWord = $_GET['word'];
    $user = 'root';
    $pass = '';
    $db = 'library1';
    $db = new mysqli('localhost',$user,$pass,$db) or die("Unable to connect");
    $sql = "SELECT ISBN, img,title, Avalibale FROM `book` WHERE (`Title`LIKE '%".$sWord."%') or (`Pub_Date`LIKE '%".$sWord."%') or ISBN IN (SELECT ISBN FROM `subject` WHERE Category = '".$sWord."') or ISBN IN (SELECT ISBN FROM `author` WHERE Name LIKE '%".$sWord."%')";    //query to check the word if it exists 
    $result = $db->query($sql);
    $checker_two = 0;
    $checker_first = True;

    while($row = $result->fetch_assoc()) {
      if($checker_first){
        echo "<div class=\"carousel-item active\" >";
        echo "<div class=\"card-group\">";
        $checker_first = false;
      }
      if($checker_two ==2){
        echo "</div>";
        echo "</div>";
        echo "<div class=\"carousel-item\">";
        echo "<div class=\"card-group\">";
        $checker_two = 0;
      }
      echo "<div class=\"card\">";
      echo "<div class=\"img-container center\" style=\"background-color:green;\">";
      echo "<img src=".$row["img"]." class=\"card-img-top\" alt=\"book image\">";
      echo "</div>";
      echo "<div class=\"card-body\">";
      echo "<h5 class=\"card-title\">".$row["title"]."</h5>";
     	
      $status = $row["Avalibale"]; //if status equal 0 the book is available if it is 1 then the book isn't available 
    
      if( $status == 0){
            //Borrow form
            echo "<form action=\"\" method=\"get\">";
            echo "<button name=\"Borrow\"type=\"submit\" value=\"".$row["ISBN"]."\" class=\"btn btn-success \">Borrow this book!</button>";
            echo "</form>";
            //end of Borrow form//borrow if available


      }
    else {
             //Reserve form
             echo "<form action=\"\" method=\"get\">";
             echo   "<button name=\"Reserve\"type=\"submit\" value=\"".$row["ISBN"]."\" class=\"btn btn-light \">Reserve this book!</button>";
             echo "</form>";
             //end of reserve form //reserve if not 
  

    }
          
    echo "</div>";
    echo "</div>";
    $checker_two+=1;
    }
      echo "</div>";
      echo "</div>";
    
    ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
    </div>
    </section>
</div>



<div>


<div>  
</body>
</html>
<?php
      if(isset($_GET['Borrow'])){
        $sql30 ="SELECT COUNT(kfupm_id) as BK FROM check_out a WHERE a.kfupm_id = '$s_kid';";

        $number_of_borrowed = $db->query($sql30)->fetch_row()[0];
        $newinput = $_GET['Borrow'];
        $date = date("Y/m/d");
        $newDate = date('Y-m-d', strtotime($date. ' + 3 months'));
        $sql18 ="SELECT COUNT(ISBN) as BK FROM check_out a WHERE a.ISBN= '$newinput';";
        $books_taken = $db->query($sql18)->fetch_row()[0];
        $sql19 ="SELECT COUNT(ISBN) FROM book_item a WHERE a.ISBN= '$newinput';";
        $number_of_books = $db->query($sql19)->fetch_row()[0];  

        if($number_of_borrowed < 5){
        if($books_taken < $number_of_books){
        $sql20 = "INSERT INTO `check_out` (`ISBN`, `kfupm_id`, `Borrow_Date`, `Due_Date`) VALUES ('$newinput', '$s_kid', '$date', '$newDate')";
        $result = $db->query($sql20);
        $books_taken += 1;
        echo '<script type = "text/javascript"> alert ("The book is added to your check out") </script>';
        if($books_taken >= $number_of_books){
          // echo '<script type = "text/javascript"> alert ("'.$books_taken.' , '.$number_of_books.'") </script>';
          $sql122 = "UPDATE `book` SET Avalibale = '1' WHERE ISBN = '$newinput' "; 
          $rs = $db->query($sql122);
        
        }
      } }else {
        echo '<script type = "text/javascript"> alert ("Sorry! you have 5 books already") </script>';
      }

        
        
        echo '<script type="text/JavaScript"> 
        location.replace("member-page.php"); </script>';
      
      }

      if(isset($_GET['Reserve'])){
        $newinput = $_GET['Reserve'];
        $sql = "SELECT COUNT(ISBN) as BK FROM reserve a WHERE a.ISBN= '$newinput';";
        $position = $db->query($sql)->fetch_row()[0];
        $date = date("Y/m/d");
        $sql = "INSERT INTO `reserve` (`ISBN`, `kfupm_id`, `Reservation_Date`, `Wait_Position`) VALUES ('$newinput', '$s_kid', '$date', '$position')";
        $result = $db->query($sql);
        if($sql){
          echo '<script type = "text/javascript"> alert ("The book has been added to the reservation page") </script>';
          }
        echo '<script type="text/JavaScript"> 
        location.replace("member-page.php"); </script>';
      }


?>