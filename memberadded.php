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

    $Fname = $_POST['Fname'];
    $Minit = $_POST['Minit'];
    $Lname   = $_POST['Lname'];
    $User_Name   = $_POST['User_Name'];
    $kfupm_id= $_POST['kfupm_id'];
    $sex   = $_POST['sex'];
    $Address  = $_POST['Address'];
    $Bdate  = $_POST['Bdate'];
    $Password  = $_POST['Password'];
    $BC  = $_POST['BC'];
    $MT  = $_POST['MT'];
    $DC  = $_POST['DC'];

    
    $sql = "INSERT INTO `person` (`Fname`, `Minit`, `Lname`, `User_Name`, `kfupm_id`, `Sex`, `Address`, `Bdate`, `PASSWORD`) VALUES ('$Fname', '$Minit', '$Lname', '$User_Name', '$kfupm_id', '$sex', '$Address', '$Bdate', '$Password')";
    $sql2= "INSERT INTO `member` (`kfupm_id`, `Barcode`, `Membership_Type`, `Date_Created`) VALUES ('$kfupm_id', '$BC', '$MT', '$DC')";
    
    if ($db->query($sql) === TRUE) {
        $db->query($sql2);
        echo "New record created successfully<br>";
        echo  "<a href=\"admin-page.php\">Click here to get back to the main page</a><br>";
        echo  "<a href=\"addmember.php\">Or Click here to add another member!</a>";
      } else {
        echo "Error: " . $sql . "<br>" . $db->error;
        echo  "<a href=\"admin-page.php\"><br>Click here to get back to the main page</a><br>";
        echo  "<a href=\"addmember.php\">Or Click here to add another member!</a><br>";
      }

   
    


    
    ?>   
</body>
</html>