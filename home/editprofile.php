<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn=mysqli_connect('localhost','root','');
$db=mysqli_select_db($conn,'weclub');

if($_SESSION['authentication']){
    $uid=$_SESSION['uid'];
    $pass=$_SESSION['pass'];
    

    $sql="SELECT * FROM user WHERE m_no='$uid' AND pass='$pass'";
    $result=mysqli_query($conn,$sql);
    $n_row=mysqli_num_rows($result);
    if($n_row == 1){
        $row=mysqli_fetch_array($result);
        $uid=$row['u_id'];
      ?>

<!DOCTYPE html>
<html>
<title>SRMWEclub &mdash; WeEntrepreneur club</title>
<link rel="icon"  href="wee.ico" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}


input[type=email] {
 width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;

}
input[type=password] {
  width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}


</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white" style="z-index:3;width:300px;" id="mySidebar">
  <div style="width: inherit;height: 100px;background-color: transparent;">
    <img src="../img/logo.png" style="width: inherit;height: 100px;">
  </div>
  <div style="width: inherit;height: 5px;float: left;"></div>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
    <center>
        <img src="<?= '../signup/'.$row['img_path'] ?>" style="width:45%;" class="w3-round"><br><br>
        
        <h6><b><?= 'Welcome '.$row['f_name']; ?></b></h6>
        <h6 style="font-family: sans-serif,arial;color: gray;"><?=$row['email'] ?></h6>
        <a href="index.php" style="text-decoration: none;font-size: 13px;color:#2883c5;">Home</a>
    </center>
  </div>
  <hr style="margin-bottom: 5px;margin-top: 15px;">
  <div class="w3-bar-block">
    <center>
        <?php
        $q0="SELECT enroll_id FROM enroll WHERE u_id='$uid'";
        $r0=mysqli_query($conn,$q0);
        $n0=mysqli_num_rows($r0);
        ?>
       <span style="font-size: 20px;color:#2883c5;"><?= $n0 ?></span>
       <br>
       <span style="font-size: 15px;color:gray;font-family:Arial,sans-serif">
          Enrollmemts
       </span>
       <br><br>
    </center>
  </div>
  
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="portfolio">
     <a href="logout.php"><img src="../img/lock.png" style="float: right;padding: 20px;"></a>
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    
    <div class="w3-container">
        <div class="w3-section w3-bottombar w3-padding-16" style="margin: 0 !important;">
       </div>
       <div style="font-family: Arial, Helvetica, sans-serif; padding-top:10px; ">
         <h4>Enter your details for update:</h4>
         <br><br>
        <form method="post" action="updatedetails.php" enctype="multipart/form-data" >
                First Name:<br>
                <input name="f_name" type="text" class="login_input_field" placeholder="First name">
                <br><br>
                Last Name: <br>
                <input name="l_name" type="text" class="login_input_field" placeholder="Last name">
                <br><br>
                E-Mail: <br>
                <input name="email" type="email" class="login_input_field" placeholder="Email">
                <br><br>
                Mobile: <br>
                <input name="m_no" type="text" class="login_input_field" placeholder="Mobile number">
                <br><br>
                Password: <br>
                <input name="pass" type="password" class="login_input_field" placeholder="Password">
                <br><br>
                Re-Enter Password: <br>
                <input name="r_pass" type="password" class="login_input_field" placeholder="Password re-enter">
                <br><br>
                Profile Picture:<br>
                <input name="img" type="file" class="login_input_field">
                <br><br>
                <input name="id" type="hidden"value="<?=$row['u_id'] ?>">
                <br>
                <input style="width: 200px;height: 40px;background-color:#2883c5;border: none;color: white;" name="update" type="submit" value="Update Details" class="login_submit_button">
                </form>
                <br><br>

      </div>



<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>


          <?php
   
    }
    else{
       echo "<script>alert('Not authenticated person'); window.location.href='../home/index.php'; </script>";
    }

}
else{
    session_destroy();
    header('Location:../login');
}

?>