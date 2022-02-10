<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>book Modifying</title>
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
    $date = date('Y-m-d');
    $AN = $_POST['AN'];
    $BI = $_POST['BI'];

    $sql = "UPDATE  `book` SET  book.Avalibale = $aval, book.Pub_Date='$PD', book.Barcode='$BC', book.Title='$title', book.RackNumber='$RC', book.img='$img' WHERE book.ISBN= '$ISBN';";
    $sql2= "UPDATE  `subject` SET subject.Category = '$cat'WHERE subject.ISBN= '$ISBN';";
    $sql3= "INSERT INTO `modify_books` (`ISBN`, `kfupm_id`, `Modify_Date`) VALUES ('$ISBN', '$s_kid', '$date')";
    $sql4= "UPDATE  `book_item` SET book_item.item_number = '$BI'WHERE book_item.ISBN= '$ISBN';";
    $sql5= "UPDATE  `author` SET author.Name = '$AN'WHERE author.ISBN= '$ISBN';";
    if ($db->query($sql) === TRUE) {
      if(!empty($cat)){
        $db->query($sql2);
      }
      if(!empty($BI)){
        $db->query($sql4);
      }
      if(!empty($AN)){
        $db->query($sql5);
      }
        
        $db->query($sql3);
        echo " record Updated successfully<br>";
        echo  "<a href=\"admin-page.php\">Click here to get back to the main page</a><br>";
        echo  "<a href=\"modifybook.php\">Or Click here to modify another book!</a>";
      } else {
        echo "Error: " . $sql . "<br>" . $db->error;
        echo  "<a href=\"admin-page.php\"><br>Click here to get back to the main page</a><br>";
        echo  "<a href=\"modifybook.php\">Or Click here to modify another book!</a><br>";
      }

   
    


    
    ?>   
</body>
</html>