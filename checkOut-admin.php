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
<?php
session_start(); 
$s_kid = $_SESSION['s_kid'];
$role = $_SESSION['role'];
$userid=$s_kid;
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

<div style="width:800px; margin:auto; ">
    
    <table >
        <tr >
            <th>ISBN</th>
            <th>ID</th>
            <th>Borrow Date </th>
            <th>Due_Date </th>
            <th>Renew</th>
            <th>Return</th>
            
        </tr>
        <?php
      
                    $user = 'root';
                    $pass = '';
                    $db   = 'library1';
                    $conn = new mysqli('localhost',$user,$pass,$db) or die("Unable to connect");
             
                     $sql= "SELECT ISBN,kfupm_id,Due_Date,Borrow_date FROM check_out WHERE kfupm_id=$userid";
                            $result= $conn-> query($sql);
                            $incrementer =0;
                     if($result -> num_rows>0){ 
                     while($row= $result-> fetch_assoc()){
                      // I was trying to find a way to link each button with isbn with action
                       echo "<tr><td>".$row["ISBN"]."</td><td>". $row["kfupm_id"]."</td><td>".$row["Borrow_date"]."</td><td>".$row["Due_Date"]."</td><td>";
                       echo "<form action=\"checkOut-admin.php\" method=\"get\">";
                       echo "<button type=\"submit\"  name=\"renew\" value=\"".$row["ISBN"]."\">renew</button>"."</td><td>";
                       echo "</form>";

                       echo "<form action=\"checkOut-admin.php\" method=\"get\">";
                       echo "<button type=\"submit\"  name=\"return\" value=\"".$row["ISBN"]."\">return</button>"."</td><td>";
                       echo "</form>";
                       
                       }
                       if(isset($_GET['renew'])){
                         $newinput = $_GET['renew'];
                         $sql121 ="SELECT Due_Date FROM `check_out` WHERE ISBN='$newinput' AND kfupm_id='$userid'";
                         $date = $conn->query($sql121)->fetch_row()[0];  
                         $newDate = date('Y-m-d', strtotime($date. ' +1  Week'));
                         //echo '<script type = "text/javascript"> alert ("Something went wrong '.$date.$newDate.'") </script>';
                         $sql122 ="UPDATE `check_out` SET `Due_Date` = '$newDate' WHERE `check_out`.`ISBN` = '$newinput' AND `check_out`.`kfupm_id` = '$userid'";
                         $result= $conn-> query($sql122);
                          echo '<script type = "text/javascript"> alert("Due date Extended"); </script>';
                         echo '<script type="text/JavaScript"> 
                         location.replace("checkOut-admin.php"); </script>';
                         
                       }elseif (isset($_GET['return'])) {
                           // RISBN to store isbn from return button
                         $RISBN = $_GET['return'];

                         // sql query to insert to returned table
                         $sql123 ="INSERT INTO returned SELECT ISBN,kfupm_id,Due_Date FROM check_out WHERE ISBN='$RISBN' AND kfupm_id='$userid'";
                         $r = $conn->query($sql123);  
                         // sql query to  delete isbn fromm check_out table

                            $sql124 ="delete FROM check_out WHERE  ISBN=$RISBN AND kfupm_id = $userid";
                            $result= $conn-> query($sql124);
                         // UPDATING AVAILABLITY AT BOOK TABLE
                          $sql129 ="UPDATE book SET Avalibale='0' WHERE ISBN=$RISBN AND Avalibale='1' ";
                          $result= $conn-> query($sql129);
                            echo '<script type = "text/javascript"> alert("Book Returned"); </script>';

                        echo '<script type="text/JavaScript"> 
                        location.replace("checkOut-admin.php"); </script>';
                           
}

                       

     
              
                   

                     echo "</table>";
                     }
                     else{
                     echo "0 result";
                     }

                     
                     $conn -> close();
        
                     
                     
                     
                     ?>
    </table>


</div>
  
</body>
</html>