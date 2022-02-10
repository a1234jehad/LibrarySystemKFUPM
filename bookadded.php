<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>book adding</title>
</head>
<body>
<?php
session_start(); 
$s_kid = $_SESSION['s_kid'];
$role = $_SESSION['role'];
if($role != 'admin'){
  header('Location: access-denied.php');
}
?>
<?php
    $user = 'root';
    $pass = '';
    $db = 'library1';
    $db = new mysqli('localhost',$user,$pass,$db) or die("Unable to connect");

    $ISBN = $_POST['ISBN'];
    $aval = $_POST['aval'];
    $PD   = $_POST['PD'];
    $BC   = $_POST['BC'];
    $title= $_POST['title'];
    $RC   = $_POST['RC'];
    $img  = $_POST['img'];
    $cat  = $_POST['cat'];
    $cat_array=explode(",",$cat);
    $date = date('Y-m-d');
    $AN = $_POST['AN'];
    $AN_array=explode(",",$AN);
    $BI = $_POST['BI'];
    $BI_array=explode(",",$BI);
    
    $sql = "INSERT INTO `book` (`ISBN`, `Avalibale`, `Pub_Date`, `Barcode`, `Title`, `RackNumber`, `img`) VALUES ('$ISBN', '$aval', '$PD' , '$BC', '$title', '$RC', '$img');";
    
    $sql3= "INSERT INTO `issue` (`ISBN`, `kfupm_id`, `Issue_Date`) VALUES ('$ISBN', '$s_kid', '$date')";
    
    
    
    if ($db->query($sql) === TRUE) {
      foreach($cat_array as $cat_item){
        $sql2= "INSERT INTO `subject` (`ISBN`, `Category`) VALUES ('$ISBN', '$cat_item')";
        $db->query($sql2);
      }
      foreach($AN_array as $AN_item){
        $sql4= "INSERT INTO `author` (`ISBN`, `Name`) VALUES ('$ISBN', '$AN_item')";
        $db->query($sql4);
      } 
      foreach( $BI_array as $BI_item){
        $sql5= "INSERT INTO `book_item` (`ISBN`, `item_number`) VALUES ('$ISBN', '$BI_item')";
        $db->query($sql5);
      }   
        $db->query($sql3);
        echo "New record created successfully<br>";
        echo  "<a href=\"admin-page.php\">Click here to get back to the main page</a><br>";
        echo  "<a href=\"addbook.php\">Or Click here to add another book!</a>";
      } else {
        echo "Error: " . $sql . "<br>" . $db->error;
        echo  "<a href=\"admin-page.php\"><br>Click here to get back to the main page</a><br>";
        echo  "<a href=\"addbook.php\">Or Click here to add another book!</a><br>";
      }

   
    


    
    ?>   
</body>
</html>