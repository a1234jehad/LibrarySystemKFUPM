<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Returned</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">
    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

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

<div style="width:800px; margin:auto; ">
    
    <table >
        <tr >
            <th>ISBN</th>
            <th>ID</th>
            <th>Reservation_Date </th>
            <th>Wait_Position </th>
           
            
        </tr>
        <?php
                      session_start();
                      $userid= $_SESSION['s_kid'];
        
                      $user = 'root';
                      $pass = '';
                      $db   = 'library1';
                      $conn = new mysqli('localhost',$user,$pass,$db) or die("Unable to connect");
                       $sql= "SELECT ISBN,kfupm_id,Reservation_Date,Wait_Position from reserve where kfupm_id=$userid";
                              $result= $conn-> query($sql);
                              $sql= "SELECT ISBN,kfupm_id,Reservation_Date,Wait_Position from reserve where kfupm_id=$userid";
                              $result= $conn-> query($sql);       
                       if($result -> num_rows>0){
                       while($row= $result-> fetch_assoc()){
  
  
  
                          echo "<tr>
                          <td>".$row["ISBN"]."</td><td>". $row["kfupm_id"]."</td><td>". $row["Reservation_Date"]."</td><td>".$row["Wait_Position"]."</td> </td>";
                          $status = $row["Wait_Position"]; //if wait is 0
                          $status2 = $row["ISBN"]; //if wait is 0
                          $sql19 = "SELECT Avalibale from book where ISBN= '$status2' ";
                         
                          $result2= $conn-> query($sql19)->fetch_row()[0];
                           
                         if( ($status == 0) && ($result2 == 0 )){
                              
                                //Borrow form
                                
        //end of Borrow form
                        echo  "<form  method=\"get\"><td>  <button name=\"Borrow\"type=\"submit\" value=\"".$row["ISBN"]."\" class=\"btn btn-success \">Move to check out</button></td> </form>  </tr>";
                              
                                                       //Borrow form
        // echo "<form action=\"\" method=\"get\">";
        // echo "<button name=\"Borrow\"type=\"submit\" value=\"".$row["ISBN"]."\" class=\"btn btn-success \">Borrow this book!</button>";
        // echo "</form>";
        //end of Borrow form
                      }
                        else {
                          echo  "<td> <form  method=\"get\"> <button disabled name=\"Borrow\"type=\"submit\" value=\"".$row["ISBN"]."\" class=\"btn btn-success \">Not Available yet</button> </form>  </td></tr>";
                        }
                                //Borrow form
        // echo "<form action=\"\" method=\"get\">";
        // echo "<button name=\"Borrow\"type=\"submit\" value=\"".$row["ISBN"]."\" class=\"btn btn-success \">Borrow this book!</button>";
        // echo "</form>";
        //end of Borrow form
                          
                          }
  
                       echo "</table>";
                       }
                       else{
                       ;
                       }

                     
                     ?>
    </table>


</div>
  
</body>
</html>
<?php
      if(isset($_GET['Borrow'])){
        session_start(); 
        $s_kid = $_SESSION['s_kid'];
        $role = $_SESSION['role'];

        $sql30 ="SELECT COUNT(kfupm_id) as BK FROM check_out a WHERE a.kfupm_id = '$s_kid';";

        $number_of_borrowed = $conn-> query($sql30)->fetch_row()[0];
        $newinput = $_GET['Borrow'];
        $date = date("Y/m/d");
        $newDate = date('Y-m-d', strtotime($date. ' + 3 months'));
        $sql18 ="SELECT COUNT(ISBN) as BK FROM check_out a WHERE a.ISBN= '$newinput';";
        $books_taken = $conn->query($sql18)->fetch_row()[0];
        $sql19 ="SELECT COUNT(ISBN) FROM book_item a WHERE a.ISBN= '$newinput';";
        $number_of_books = $conn->query($sql19)->fetch_row()[0];  
        
        $sql15 ="SELECT MIN(Wait_Position) FROM reserve a WHERE a.ISBN = '$newinput';"; 
        $min_pos = $conn->query($sql15)->fetch_row()[0]; 

        if($number_of_borrowed < 5){
        if($books_taken < $number_of_books){
          $sql50 = "INSERT INTO `check_out` (`ISBN`, `kfupm_id`, `Borrow_Date`, `Due_Date`) VALUES ('$newinput', '$s_kid', '$date', '$newDate')";
          $rs1 = $conn->query($sql50);
          $books_taken += 1;
        $sql22 = "DELETE FROM `reserve`  WHERE ISBN = '".$newinput."' AND  kfupm_id = '".$s_kid."' ";
        $result = $conn->query($sql22);
        $sql60 = "UPDATE `reserve` SET Wait_Position = '$min_pos' WHERE ISBN = '$newinput' "; 
        $rs = $conn->query($sql60);
        echo '<script type = "text/javascript"> alert ("The book is added to your check out") </script>';
        if($books_taken >= $number_of_books){
          // echo '<script type = "text/javascript"> alert ("'.$books_taken.' , '.$number_of_books.'") </script>';
          $sql122 = "UPDATE `book` SET Avalibale = '1' WHERE ISBN = '$newinput' "; 
          $rs = $conn->query($sql122);
        
        }
      } }else {
        echo '<script type = "text/javascript"> alert ("Sorry! you have 5 books already") </script>';
      }

        
        
        echo '<script type="text/JavaScript"> 
        location.replace("Reservations.php"); </script>';
      
      }


    
?>