<?php

sleep(4);
session_start();

$conn=mysqli_connect('localhost','root','');
$db=mysqli_select_db($conn,'weclub');

if($_SESSION['authentication']){
    $uid=$_SESSION['uid'];
    $pass=$_SESSION['pass'];
    

    $sql="SELECT * FROM user WHERE m_no='$uid' AND pass='$pass'";
    $result=mysqli_query($conn,$sql);
    $n_row=mysqli_num_rows($result);
    if($n_row == 1){
         
        if($_SERVER["REQUEST_METHOD"]=='POST'){
            
            $row=mysqli_fetch_array($result);
            $uid=$row['u_id'];
            $eid=$_POST['eid'];
            
            $q1="INSERT INTO `enroll`(`enroll_id`, `event_id`, `u_id`, `en_time`) VALUES (NULL,'$eid','$uid',NULL)";
            if(mysqli_query($conn,$q1)){
                echo "<script>alert('ok'); window.location.href='../home/index.php'; </script>";
            }
            else{
                echo "<script>alert('Not enrolled'); window.location.href='../home/index.php'; </script>";
            }
        }
        else{
            echo "<script>alert('Not right method'); window.location.href='../home/index.php'; </script>";
        }
         
    }
    else{
        echo "<script>alert('not right user'); window.location.href='../home/index.php'; </script>";
    }
}


?>