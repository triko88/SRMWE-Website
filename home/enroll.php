<?php


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
         
         $row=mysqli_fetch_array($result);
         $uid=$row['u_id'];
         if(isset($_GET['enroll'])){
              if(isset($_GET['e_id'])){
                  $eid=$_GET['e_id'];
                  
                  $q1="SELECT * FROM event WHERE event_id='$eid'";
                  $r1=mysqli_query($conn,$q1);
                  $n_r1=mysqli_num_rows($r1);
                  $eve=mysqli_fetch_array($r1);
                  if($n_r1 == 1){
                     
                    $start=date("Y-m-d");
                    $end=$eve['e_start'];
                    $d_start    = new DateTime($start); 
                    $d_end      = new DateTime($end); 
                    $diff = $d_start->diff($d_end);
                    
                    if($diff->format('%R%d') > 0){
                      //enrollment open
                      
                      $q2="SELECT * FROM enroll WHERE event_id='$eid' AND u_id='$uid'";
                      $r2=mysqli_query($conn,$q2);
                      $n_r2=mysqli_num_rows($r2);
                      
                      if($n_r2 == 0){
                         //project is not enrolled yet
                         
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
</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">
    
    
    
<script>
      
                var xhr=null;
                                           
                function createHttpRequest(){
                    try{
                        xhr=new XMLHttpRequest();
                            return xhr;
                    }
                    catch(e){
                        xhr=new ActiveXobject("Microsoft.XMLHTTP");
                        return xhr;
                    }
                    
                }
    
                function free_setup(f,id){
                 
                    data="eid="+id;
                    url="setup_enroll.php";
                    
                    xhr=createHttpRequest();
                    //create post request
                    xhr.open("POST",url,true);
                                            
                    //set-content type
                    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    xhr.setRequestHeader("Content-length",data.length);
                    xhr.setRequestHeader("Connection","close");
                    //show progress
                    
                    document.getElementById("loadb").style.display="block";
                    
                    //call function
                    xhr.onreadystatechange=function(){
                        //only handle loded request
                        if(xhr.readyState == 4){
                            if(xhr.status == 200){
                                document.getElementById("loadb").style.display="none";
                                     if(xhr.responseText == 'ok'){
                                         window.location.href = "http://localhost/weclub/home/event.php?event_id="+id;
                                     }
                                     else{                  
                                        
                                     }
                            }
                            else{
                                alert("Error with ajax call");
                                }
                        }
                    
                    }
                    //send variables
                    xhr.send(data);
                    
                }
    
</script>    
    
    

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
        <a href="editprofile.php" style="text-decoration: none;font-size: 13px;color:#2883c5;">Edit your profile</a>
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
  <br>
  <hr style="margin-bottom: 5px;margin-top: 15px;">

    
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
        <div style="height: 80px;padding: 15px">
             <a href="../home/event.php?event_id=<?= $eid; ?>"><span style="float: left; margin-top: 20px;color:#2883c5;font-size: 20px;"><img src="../img/arrow.png">&nbsp &nbsp Back to Event</span></a>
            
             <span style="float: right">&nbsp &nbsp</span>
             
        </div>
      
       <div class="w3-section w3-bottombar w3-padding-16" style="margin: 0 !important;padding-top: 5px !important;border-bottom-color: #2883c5 !important;">
       </div>
       <div style="width: inherit;height: 600px;background-color:white;">
            <div style="width: 42%;height: inherit;float: left;padding: 25px;padding-left: 15px;padding-right: 15px;">
                <h5><span><a href="../home/event.php?event_id=<?= $eid; ?>" style="color: #2883c5;text-decoration: none;"><?= $eve['event_title'] ?></a></span></h5>
                <p>Venue : <span><?=$eve['venue'] ?></span></p>
                <p>Event type : <span><?=$eve['e_type'] ?></span></p>
                <p>Topic : <span><?=$eve['zone'] ?></span></p>
                <p>Number of point discussions : <span><?=$eve['no_topic'] ?></span></p>
                <p>Event start date : <span><?=$eve['e_start'] ?></span></p>
                <p>Event end date : <span><?=$eve['e_start'] ?></span></p>
                <p>Event Fee : <span style="color:#2883c5"><?= '&#8377 '.$eve['cost'] ?></span></p>
                <a href="../home/event.php?event_id=<?= $eid; ?>" style="color:#2883c5;text-decoration: none;">more...</a>
            </div>
            <div style="width: 58%;height: inherit;float: left;border-left: solid;border-left-width: 1px;border-image:linear-gradient(to bottom, #2883c5, #cccccc) 1 100%;padding: 25px;padding-left: 25px;padding-right: 25px;">
                
                <?php
                
                 
                         if($eve['cost'] == 0){
                          ?>
                           <p style="color:#2883c5;"> WEclub povide free accessibility of this event.</p>
                            <p>Event Fee : <span style="color:#2883c5"><?= '&#8377 '.$eve['cost'] ?></span></p>
                            <hr>
                            <p><b>Total Fee : <span style="color:#2883c5"><?= '&#8377 '.$eve['cost'] ?></span></b></p>
                            <br>
                            <form  onsubmit="free_setup(this,<?= $eid ?>); return false;">
                                 <span>
                                    <div style="width: 250px;height: 40px;background-color: transparent;">
                                        <div style="width: 200px;height: inherit;float: left;">
                                            <input  type="submit" name="enroll" value="confirm enrollment"  style="width: 150px;height: 40px;border-radius: 4px;background-color:#2cd2b1;border: none;color: white;font-family: arial,sans-serif;font-size:16px;font-weight: 200;">  
                                        </div>
                                        <div style="width: 50px;height: inherit;float: left;">
                                            <img id="loadb" style="display: none;float: right;" src="../img/load.gif"></span>
                                        </div>
                                    </div>
                                     
                                 </span>
                            </form>
                          <?php  
                          
                         }
                         else{
                        ?>
                            <h3> Upload Your Screenshot here </h3>    
                        <?php
                         }
                
                ?>
               
            </div>
       </div>
       <div class="w3-section w3-bottombar w3-padding-16" style="margin: 0 !important;padding: 0px !important;border-bottom-color: #cccccc !important;">
       </div>

     
       
    
       
       <br>
    </div>
  </header>
  <br>
  
 



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
                         //project is already enrolled by user
                         header("Location:../home/event.php?event_id=$eid");
                         exit();
                      }
                      
                    }
                    else{
                        //enrollment not allowed
                        header("Location:../home/event.php?event_id=$eid");
                        exit();
                    }
                  }
                  else{
                    //event is not avilable
                  }
              }
              else{
                echo "<script>alert('event id not set'); window.location.href='../home/index.php'; </script>";
              }
         }
         else{
          echo "<script>alert('button not pressed'); window.location.href='../home/index.php'; </script>";
         }
        
    }
    else{
        session_destroy();
        header('Location:../login');
    }
}
else{
    session_destroy();
    header('Location:../login');
}


?>
