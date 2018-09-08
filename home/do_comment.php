<?php

session_start();

$conn=mysqli_connect('localhost','root','');
$db=mysqli_select_db($conn,'weclub');

if(isset($_SESSION['authentication'])){
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
            $comment=$_POST['comment'];
            
            $q1="INSERT INTO `comment`(`comment_id`, `event_id`, `u_id`, `comment`, `c_time`) VALUES (NULL,'$eid','$uid','$comment',NULL)";
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
        echo "<script>alert('Not right user'); window.location.href='../home/editprofile.php'; </script>";
    }
}

?>