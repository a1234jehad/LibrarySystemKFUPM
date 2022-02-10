<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $user = 'root';
    $pass = '';
    $db = 'library1';
    $db = new mysqli('localhost',$user,$pass,$db) or die("Unable to connect");

    $kfupm_id = $_POST['kid'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM person a WHERE a.kfupm_id ='$kfupm_id'  AND PASSWORD='$password'";
    $result = $db->query($sql);
    if($result->num_rows ==0){
        echo "One of your credintials is wrong <br>";
        echo  "<a href=\"Login.php\">Click here to get back to the main page</a>";
    }
    else{
        $sql = "SELECT * FROM librarian a WHERE a.kfupm_id ='$kfupm_id' ";
        $result = $db->query($sql);
        if($result->num_rows ==0){
            header('Location: member-page.php');
            session_start(); 
            $_SESSION['s_kid']= $kfupm_id;
            $_SESSION['role'] = 'member';

        }
        else{
            header('Location: admin-page.php');
            session_start(); 
            $_SESSION['s_kid']= $kfupm_id;
            $_SESSION['role'] = 'admin';
        }
    }
    


    
    ?>
</body>
</html>