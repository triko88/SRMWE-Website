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
          Inrollmemts
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
       <div style="height: 80px;padding: 15px">
             <input type="text" placeholder="Go for anything" style="font-size: 16px;height: 35px;width: 250px;float: right;margin-top: 16px;outline-color:#2883c5;border-radius: 3px;border: solid;border-color: #ccc;border-width: 3px;padding-left: 10px;padding-right: 10px;">
             
        </div>
       
       <div class="w3-section w3-bottombar w3-padding-16" style="margin: 0 !important;">
       </div>
       <div class="w3-section w3-collapse" style="margin: 0 !important;height: 60px !important;background-color: #2883c5;padding: 5px;">
          <h2 style="color:white;"> Upcoming Events </h2>
       </div>
       <div class="w3-section w3-bottombar w3-padding-16" style="padding: 0 !important;margin: 0 !important">
       </div>
    </div>
  </header>
  <br>
    <div class="w3-row-padding">
  <?php
      $uid=$row['u_id'];

      # query for not enrolled Events

      $q1="SELECT * FROM event WHERE event_id NOT IN(SELECT event_id FROM enroll WHERE u_id='$uid') ORDER BY event_id DESC";

      $r1=mysqli_query($conn,$q1);
      $n1=mysqli_num_rows($r1);
      while($eve=mysqli_fetch_array($r1)){
        $eid=$eve['event_id'];
        $q2="SELECT * FROM guest WHERE event_id='$eid'";
        $r2=mysqli_query($conn,$q2);
        $gue=mysqli_fetch_array($r2);
        
        $guests=$gue['guest_name'];
        $guest=explode("#",$guests);
        
        $start=date("Y-m-d");
        $end=$eve['e_start'];
        #$start  = date('Y-m-d H:i:s',$start); 
        #$end    = date('Y-m-d H:i:s',$end); 
        $d_start    = new DateTime($start); 
        $d_end      = new DateTime($end); 
        $diff = $d_start->diff($d_end); 
        
        
  ?>
  <!-- First Photo Grid-->
 
    <div class="w3-third w3-container w3-margin-bottom">
      <a href="../home/event.php?event_id=<?= $eid; ?>">
      <img src="<?= '../admin_login/'.$eve['e_img_path'] ?>" alt="Norway" style="width:100%;height: 250px" class="w3-hover-opacity">
      </a>
      <div class="w3-container w3-white">
        <p style="text-transform: capitalize;"><?php foreach($guest as $g){echo $g.'    ';} ?>
        
        </p>
        <span style="font-family:  sans-serif,arial;"><b><?= $eve['event_title']; ?></b></span><br>
        <div style="width: inherit;height: 100px;background-color: transparent;">
            <?php
            if($diff->format('%R%d') > 0){
                $n=$diff->format('%d');
                if($n == 1){$s=' day';}else{$s=' days';}
                
                $price=$eve['cost'];
                if($price==0){
                    $pr='Free';
                }
                else{
                    $pr='<span style="font-size:20px">&#8377</span> '.$price;
                }
                
                ?>
                
                <div style="width: inherit;height: 80px;background-color: transparent;">
                    <div style="width: inherit;height: 30px;">
                        <div style="width: 100px;height: 20px;float: left;">
                            <span style="text-transform: capitalize;color: #2883c5"><b><?= $eve['e_type'] ?></b></span>
                        </div>
                        <div style="width:80px;height: 20px;font-size: 14px;color: white;background-color: #2883c5;float: right;border-radius:20px;">
                           <center>
                             <span><b>Open</b></span>
                           </center>
                        </div>
                    </div>
                    <div style="width: inherit;height: 50px;">
                        <span style="color: gray;"><b>Enrolment open </b>: before <?= $end; ?></span>
                        <span style="float:right;color: #2883c5;"><?= $pr.'&nbsp'; ?></span><br>
                        <span style="color: gray;"><?= $n.$s.' left only' ?></span>
                    </div>
                </div>
                <?php
            }
            else{
                ?>
                 
                 <div style="width: inherit;height: 80px;background-color: transparent;">
                    <div style="width: inherit;height: 30px;">
                        <div style="width: 100px;height: 20px;float: left;">
                            <span style="text-transform: capitalize;color: #2883c5"><b><?= $eve['e_type'] ?></b></span>
                        </div>
                        <div style="width:80px;height: 20px;font-size: 14px;color: white;background-color: crimson;float: right;border-radius:20px;">
                           <center>
                              <span><b>Closed</b></span>
                           </center>
                        </div>
                    </div>
                    <div style="width: inherit;height: 50px;">
                        <span style="color: gray;"><b>Event start</b> : <?= $end; ?></span><br>
                        <span style="color: gray;"><b>Event end</b> : <?= $eve['e_end']; ?></span>
                    </div>
                </div>
                <?php
            }
            ?>
        
        </div>
        <br>
      </div>
    </div>
  
  <?php
      }
  ?>
    </div>
 
  

    <div style="width: inherit;height:70px;background-color:transparent;padding: 5px;padding-left: 20px;">
        <h5>Enrolled Events</h5>
    </div>
    
     
  <?php

  #Query for enrolled Events

      $q1="SELECT * FROM event WHERE event_id IN(SELECT event_id FROM enroll WHERE u_id='$uid') ORDER BY event_id DESC";

      $r1=mysqli_query($conn,$q1);
      $n1=mysqli_num_rows($r1);
      if($n1==0){
        ?>
        
         
    
   <div style="width: inherit;height: auto;background-color: transparent;padding: 10px;padding-left: 20px;padding-right: 20px;">
       <div style="width: inherit;height: auto;background-color: white;padding: 10px;padding-left: 50px;padding-right: 50px;">
        <br>
        <center>
            <h3>
                No event enrolled yet
            </h3>
        </center>
        <br>
       </div>
   </div>
        
        <?php
      }
      else{?>
      
    <div class="w3-row-padding"> 
      <?php
       
        while($eve=mysqli_fetch_array($r1)){
        $eid=$eve['event_id'];

        $q2="SELECT * FROM guest WHERE event_id='$eid'";
        $r2=mysqli_query($conn,$q2);
        $gue=mysqli_fetch_array($r2);
        
        $guests=$gue['guest_name'];
        $guest=explode("#",$guests);
        
        $start=date("Y-m-d");
        $end=$eve['e_start'];
        #$start  = date('Y-m-d H:i:s',$start); 
        #$end    = date('Y-m-d H:i:s',$end); 
        $d_start    = new DateTime($start); 
        $d_end      = new DateTime($end); 
        $diff = $d_start->diff($d_end); 
        
        
  ?>
  <!-- First Photo Grid-->
 
    <div class="w3-third w3-container w3-margin-bottom">
      <a href="../home/event.php?event_id=<?= $eid; ?>">
      <img src="<?= '../admin_login/'.$eve['e_img_path'] ?>" alt="Norway" style="width:100%;height: 250px" class="w3-hover-opacity">
      </a>
      <div class="w3-container w3-white">
        <p style="text-transform: capitalize;"><?php foreach($guest as $g){echo $g.'    ';} ?>
        
        </p>
        <span style="font-family:  sans-serif,arial;"><b><?= $eve['event_title']; ?></b></span><br>
        <div style="width: inherit;height: 100px;background-color: transparent;">
            <?php
            if($diff->format('%R%d') > 0){
                $n=$diff->format('%d');
                if($n == 1){$s=' day';}else{$s=' days';}
                
                $price=$eve['cost'];
                if($price==0){
                    $pr='Free';
                }
                else{
                    $pr='<span style="font-size:20px">&#8377</span> '.$price;
                }
                
                ?>
                
                <div style="width: inherit;height: 80px;background-color: transparent;">
                    <div style="width: inherit;height: 30px;">
                        <div style="width: 100px;height: 20px;float: left;">
                            <span style="text-transform: capitalize;color: #2883c5"><b><?= $eve['e_type'] ?></b></span>
                        </div>
                        <div style="width:80px;height: 20px;font-size: 14px;color: white;background-color: #2883c5;float: right;border-radius:20px;">
                           <center>
                             <span><b>Open</b></span>
                           </center>
                        </div>
                    </div>
                    <div style="width: inherit;height: 50px;">
                        <span style="color: gray;"><b>Enrolment open </b>: before <?= $end; ?><span style="float:right;color: #2883c5;"><?= $pr.'&nbsp'; ?></span><br>
                        <span style="color: gray;"><?= $n.$s.' left only' ?></span>
                    </div>
                </div>
                <?php
            }
            else{
                ?>
                 
                 <div style="width: inherit;height: 80px;background-color: transparent;">
                    <div style="width: inherit;height: 30px;">
                        <div style="width: 100px;height: 20px;float: left;">
                            <span style="text-transform: capitalize;color: #2883c5"><b><?= $eve['e_type'] ?></b></span>
                        </div>
                        <div style="width:80px;height: 20px;font-size: 14px;color: white;background-color: crimson;float: right;border-radius:20px;">
                           <center>
                              <span><b>Closed</b></span>
                           </center>
                        </div>
                    </div>
                    <div style="width: inherit;height: 50px;">
                        <span style="color: gray;"><b>Event start</b> : <?= $end; ?></span><br>
                        <span style="color: gray;"><b>Event end</b> : <?= $eve['e_end']; ?></span>
                    </div>
                </div>
                <?php
            }
            ?>
        
        </div>
        <br>
      </div>
    </div>
  
  <?php
      }
  ?>
    </div>
    <?php
       
      }
      ?>
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
        echo "<script>alert('not authenticated person'); window.location.href='../home/index.php'; </script>";
    }

}
else{
    session_destroy();
    header('Location:../login');
}

?>