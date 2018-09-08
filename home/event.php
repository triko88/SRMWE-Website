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
        ?>
        
<!DOCTYPE html>
<html>
<title>SRMWEclub &mdash; WeEntrepreneur club</title>
<link rel="icon"  href="wee.ico" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
    
                function do_comment(f,eid,uid){
                 
                    data="eid="+eid+"&uid="+uid+"&comment="+f.comment.value;
                    url="do_comment.php";
                    
                    xhr=createHttpRequest();
                    //create post request
                    xhr.open("POST",url,true);
                                            
                    //set-content type
                    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    xhr.setRequestHeader("Content-length",data.length);
                    xhr.setRequestHeader("Connection","close");
                    //show progress
                    
                    document.getElementById("loadb").style="display:block;float: left;";
                    
                    //call function
                    xhr.onreadystatechange=function(){
                        //only handle loded request
                        if(xhr.readyState == 4){
                            if(xhr.status == 200){
                                document.getElementById("loadb").style="display:none;float: left;";
                                     if(xhr.responseText == 'ok'){
                                         window.location.href = "http://localhost/weclub/home/event.php?event_id="+eid;
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
        
        <?php
        if(isset($_GET['event_id'])){
            $eid=mysqli_real_escape_string($conn,$_GET['event_id']);
            $q1="SELECT * FROM event WHERE event_id=$eid";
            $r1=mysqli_query($conn,$q1);
            $n_r1=mysqli_num_rows($r1);
            if($n_r1 == 1){
                
                //event find
                $eve=mysqli_fetch_array($r1);
                $start=date("Y-m-d");
                $end=$eve['e_start'];
                $d_start    = new DateTime($start); 
                $d_end      = new DateTime($end); 
                $diff = $d_start->diff($d_end); 
                
                $img_address=$eve['e_img_path'];
                $img_address1=$eve['img_path1'];
                $img_address2=$eve['img_path2'];
                $img_address3=$eve['img_path3'];
                
                $ttitle=$eve['topic_title'];
                $t_title=explode("#",$ttitle);
                $tdesc=$eve['topic_desc'];
                $t_desc=explode("#",$tdesc);
                
                $eid=$eve['event_id'];
                
                $price=$eve['cost'];
                if($price==0){
                    $pr='Free';
                }
                else{
                    $pr='&#8377 '.$price;
                }
                
                $q3="SELECT * FROM guest WHERE event_id='$eid'";
                $r3=mysqli_query($conn,$q3);
                $gue=mysqli_fetch_array($r3);
        
                $guests=$gue['guest_name'];
                $guest=explode("#",$guests);
                $guestp=$gue['guest_post'];
                $guest_p=explode("#",$guestp);
                $guestl=$gue['guest_link'];
                $guest_l=explode("#",$guestl);
                $guesta=$gue['guest_about'];
                $guest_a=explode("#",$guesta);
                
                
                $q6="SELECT * FROM enroll WHERE event_id='$eid'";
                $r6=mysqli_query($conn,$q6);
                $n_r6=mysqli_num_rows($r6);
                
                if($diff->format('%R%d') > 0){
                     $uid=$row['u_id'];
                     //event is runnning or in future
                     $q2="SELECT * FROM enroll WHERE event_id='$eid' AND u_id='$uid'";
                     $r2=mysqli_query($conn,$q2);
                     $n_r2=mysqli_num_rows($r2);
                     
                   
                     
                     if($n_r2 == 1){
                      //course is enrolled and enrollment is open
                      $enroll=mysqli_fetch_array($r2);
                      $at=strtotime($enroll['en_time']);
                    ?>
                    

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
             <a href="../home/"><span style="float: left; margin-top: 20px;color:#2883c5;font-size: 20px;"><img src="../img/arrow.png">&nbsp &nbsp Explore more events</span></a>
             
             <span style="float: right">&nbsp &nbsp</span>
            
        </div>
      
       <div class="w3-section w3-bottombar w3-padding-16" style="margin: 0 !important;padding-top: 5px !important;border-bottom-color: #2883c5 !important;">
       </div>
       <div style="width: inherit;height: 400px;background: linear-gradient(#2883c5, #cccccc);">
            
            <div style="width: 65%;height: inherit;float: left;">
                
                <div style="width: 100%;height: inherit;color: white;">
                    
                    <center>
                         <br>
                         <div style="width: inherit;height: 140px;">
                              <h2><?= $eve['event_title']; ?></h2>
                              <span>Jugded By</span><br>
                              <span style="font-family: 'Rouge Script',cursive; font-size: 25px; font-weight: normal; margin-bottom: 0px; text-align: center; text-shadow: 0 1px 1px #fff;">
                              <?php
                                $i=0;
                                $n=count($guest);
                                foreach($guest as $g){
                                    if($i == 0){
                                        echo $g;
                                    }
                                    elseif($i <= $n-1){
                                        echo ' <span style="font-size:17px;font-weight: thin !important;"> and </span>'.$g;
                                    }
                                    $i++;
                                }
                                ?>
                         </span>
                         </div>
                         <div style="width: inherit;height: 130px;background-color: transparent;padding: 10px;">
                            <span><?= $eve['e_desc']; ?></span>
                         </div>
                         <div style="width: inherit;height:20px;background-color: transparent;padding-left: 10px;padding-right: 10px;">
                         </div>
                         <div style="width: inherit;height: 40px;">
                            
                            <button type="submit" name="enroll" style="width: 200px;height: 40px;border-radius: 4px;background-color:#2cd2b1;border: none;color: white;font-family: arial,sans-serif;font-size:16px;font-weight: 200;">
                                <?= $n_r6.' Enrollment | '.$pr; ?>
                            </button>
                              
                         </div>
                         
                    </center>
                </div>
            </div>
       </div>
       <div class="w3-section w3-bottombar w3-padding-16" style="margin: 0 !important;padding: 0px !important;border-bottom-color: #cccccc !important;">
       </div>
       <div style="width: inherit;height:20px;background-color:transparent;padding: 5px;"></div>
       <div style="width: inherit;height:60px;background-color:#2cd2b1;padding: 20px;">
           <center>
            <b style="color: white;">Event has been enrolled by you since &nbsp <span style="color:#2883c5;"><?= date("d M, Y", $at).' at '. date("g:i a", $at)?></span></b>
           </center>
       </div>
       <div style="width: inherit;height:60px;background-color:transparent;padding: 5px;">
           <h5>About the speakers</h5>
       </div>
       <div style="width: inherit;height: auto;background-color: white;padding: 10px;padding-left: 50px;padding-right: 50px;">
        <?php
       
        for($i=0;$i<count($guest);$i++){
            ?>
            <a href="<?= $guest_l[$i]; ?>" style="text-decoration: none;color:#2883c5;" target="_blank">
            <h6 style="text-transform: capitalize;"><?= $guest[$i]; ?></h6>
            </a>
            <span><b><?= $guest_p[$i]; ?></b></span><br>
            <span><?= $guest_a[$i]; ?></span>
            <br><br>
            <?php
        }
        ?>
       </div>
        <div style="width: inherit;height:60px;background-color:transparent;padding: 5px;">
           <h5>Event Venue and time</h5>
       </div>
       <div style="width: inherit;height: auto;background-color: white;padding: 15px;padding-left: 50px;padding-right: 50px;">
		    <br>
            <span style="float: left;color: #2883c5;"><b><?= $eve['venue'] ?></b></span>
            <br><br>
            <span style="float: left;color: gray;">
                <?php
                $format = 'H:i:s';
                $time=DateTime::createFromFormat($format, '00:00:00');
                if(($eve['s_time']== $time->format('H:i:s')) || ($eve['e_time']== $time->format('H:i:s'))){
                    echo '<b>Contact event management for knowing event start and end time.</b>';
                }
                else{
                    //convert time into am pm
                    $s_t=strtotime($eve['s_time']);
                    $e_t=strtotime($eve['e_time']);
                    $s_t=date("g:i a", $s_t);
                    $e_t=date("g:i a", $e_t);
                    ?>
                    
                    <span><b>Event start time : </b><span style="color:#2883c5"><?=  $s_t; ?></span></span><br>
                    <span><b>Event end time : </b><span style="color:#2883c5"><?= $e_t; ?></span></span><br>
                    <?php
                }
                ?>
                
            </span>
            <br>
            <br>
            <br>
       </div>
       <div style="width: inherit;height:60px;background-color:transparent;padding: 5px;">
           <h5>Event Overview</h5>
       </div>
       <div style="width: inherit;height: 50px;background-color: white;padding: 15px;padding-left: 50px;padding-right: 50px;">
		    <span style="float: left;color: gray"><b>Event Start : </b><?= $eve['e_start'] ?></span>
            <span style="float: right;color: gray"><b>Event End : </b><?= $eve['e_end'] ?></span>
       </div>
       <hr style="margin:0;pdding:0;">
       <div style="width: inherit;height: auto;background-color: white;padding: 10px;padding-left: 50px;padding-right: 50px;">

        <?php
        
        for($i=0;$i<count($t_title);$i++){
            ?>
            
           <h6 style="text-transform: capitalize;color:#2883c5;"><?= $t_title[$i]; ?></h6>
            <span><?= $t_desc[$i]; ?></span>
            <br><br>
        <?php
        }
        ?>
       </div>

                <!--carousel here -->
                <div class="container">
  <div style="width: inherit;height:60px;background-color:transparent;padding: 5px;">
           <h5>Updates</h5>
       </div> 
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
      <div class="slideshow-container">

<div class="mySlides fade">
      <div class="numbertext">1 / 3</div>
        <img src="<?= '../admin_login/'.$img_address1; ?>" alt="Image1" style="width:auto; height:615px;">
      </div>
</div>

<div class="mySlides fade">
    <div class="numbertext">2 / 3</div>
        <img src="<?= '../admin_login/'.$img_address2; ?>" alt="Image2" style="width:auto; height:615px;">
      </div>
</div>

<div class="mySlides fade">
      <div class="numbertext">3 / 3</div>
        <img src="<?= '../admin_login/'.$img_address3; ?>" alt="Image3" style="width:auto; height:615px;">
      </div>
</div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>
       <div style="width: inherit;height:60px;background-color:transparent;padding: 5px;">
           <h5>Comments</h5>
       </div>
        <div style="width: inherit;height: auto;background-color: white;padding: 10px;padding-left: 50px;padding-right: 50px;">
        <?php
          $q4="SELECT * FROM comment WHERE event_id='$eid'";
          $r4=mysqli_query($conn,$q4);
          $n_r4=mysqli_num_rows($r4);
          
          if($n_r4 > 0){
             while($comment=mysqli_fetch_array($r4)){
                $uid=$comment['u_id'];
                $q5="SELECT * FROM user WHERE u_id='$uid'";
                $r5=mysqli_query($conn,$q5);
                $commenter=mysqli_fetch_array($r5);
                
                $timestamp = strtotime($comment['c_time']);
                ?>
                  <br>
                  <div style="width: inherit;height: auto">
                      <div style="width: inherit;height:35px">
                         <img src="../img/user.png" style="width: 30px;width: 30px;border-radius: 50%">
                         &nbsp &nbsp
                         <span style="text-transform: capitalize;color:#2883c5;">
                         <?php
                            if($comment['u_id'] == $row['u_id']){
                                echo '<b style="color:green;">'.$commenter['f_name'].' '.$commenter['l_name'].'</b>';
                            }
                            else{
                                echo  $commenter['f_name'].' '.$commenter['l_name'];
                            }
                         ?>
                         <span style="color:#2883c5">&nbsp &#9679 &nbsp <?= date("d M, Y", $timestamp).' @ '. date("g:i A", $timestamp); ?></span>
                         </span>
                      </div>
                      <div style="width: inherit;height:auto;background-color:transparent;padding-left: 50px;padding-right: 50px;">
                         <span><?= $comment['comment'] ?></span>
                         
                      </div>
                      <br>
                  </div>
                <?php
             }
          }
          else{
            ?>
            <br>
            <center>
                <h5>No comment in this event.</h5>
            </center>
            <br>
            <?php
          }
        ?>
        </div>
        <hr>
       <div style="width: inherit;height: 100px;background-color: white;padding: 10px;padding-left: 50px;padding-right: 50px;">
           <br>
            <?php
           $eid=$eve['event_id'];
           $uid=$row['u_id'];
           ?>
           <form onsubmit="do_comment(this,<?= $eid ?>,<?= $uid ?>); return false;"">
               <div style="width: 50%;height: inherit;float: left;">
                  <input type="text" name="comment" placeholder="Your comment...." style="width:100%;height: 35px;padding-left: 10px;padding-right: 10px;">
               </div>
               <div style="width: 49%;height: inherit;float: right;">
                  <img src="../img/load.gif" id="loadb" style="display:none;float: left;">
               </div>
           </form>
           <br>
       </div>
       
       <div style="width: inherit;height:60px;background-color:transparent;padding: 5px;">
          
       </div>
       <div style="width: 200px;height:60px;background-color:transparent;padding: 5px;">
		   <center>
            <button type="submit" name="enroll" style="width: 200px;height: 40px;border-radius: 4px;background-color:#2cd2b1;border: none;color: white;font-family: arial,sans-serif;font-size:16px;font-weight: 200;">
                                <?= $n_r6.' Enrollment | '.$pr; ?>
            </button>
           </center>
       </div>
       
       <br>
    </div>
  </header>
  <br>
</div>
 


   
                    <?php
                        
                     }
                     else{
                        //course does not enroll
                        
                        ?>


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
             <a href="../home/"><span style="float: left; margin-top: 20px;color:#2883c5;font-size: 20px;"><img src="../img/arrow.png">&nbsp &nbsp Explore more events</span></a>

             <span style="float: right">&nbsp &nbsp</span>
             
        </div>
      
       <div class="w3-section w3-bottombar w3-padding-16" style="margin: 0 !important;padding-top: 5px !important;border-bottom-color: #2883c5 !important;">
       </div>
       <div style="width: inherit;height: 400px;background: linear-gradient(#2883c5, #cccccc);">
            
            <div style="width: 100%;height: inherit;float: left;">
                
                <div style="width: 100%;height: inherit;color: white;">
                    
                    <center>
                         <br>
                         <div style="width: inherit;height: 140px;">
                              <h2><?= $eve['event_title']; ?></h2>
                              <span>By</span><br>
                              <span style="font-family: 'Rouge Script',cursive; font-size: 25px; font-weight: normal; margin-bottom: 0px; text-align: center; text-shadow: 0 1px 1px #fff;">
                              <?php
                                $i=0;
                                $n=count($guest);
                                foreach($guest as $g){
                                    if($i == 0){
                                        echo $g;
                                    }
                                    elseif($i <= $n-1){
                                        echo ' <span style="font-size:17px;font-weight: thin !important;"> and </span>'.$g;
                                    }
                                    $i++;
                                }
                                ?>
                         </span>
                         </div>
                         <div style="width: inherit;height: 130px;background-color: transparent;padding: 10px;">
                            <span><?= $eve['e_desc']; ?></span>
                         </div>
                         <div style="width: inherit;height:20px;background-color: transparent;padding-left: 10px;padding-right: 10px;">
                         </div>
                         <div style="width: inherit;height: 40px;">
                            <form action="../home/enroll.php" method="get">
                                 <input type="hidden" name="e_id" value="<?= $eve['event_id']; ?>">
                                 <input type="hidden" name="ref" value="event">
                                 <input type="submit" name="enroll" value="<?= 'Enroll Now | '.$pr; ?>"  style="width: 200px;height: 40px;border-radius: 4px;background-color:#e53c2e;border: none;color: white;font-family: arial,sans-serif;font-size:16px;font-weight: 200;">
                                 <br>
                                 <span style="color:#e53c2e;"><?= $n_r6.' Enrollment' ?></span>
                            </form>
                         </div>
                         
                    </center>
                </div>
            </div>
       </div>
       <div class="w3-section w3-bottombar w3-padding-16" style="margin: 0 !important;padding: 0px !important;border-bottom-color: #cccccc !important;">
       </div>
       <div style="width: inherit;height:60px;background-color:transparent;padding: 5px;">
           <h5>About the speakers</h5>
       </div>
       <div style="width: inherit;height: auto;background-color: white;padding: 10px;padding-left: 50px;padding-right: 50px;">
        <?php
       
        for($i=0;$i<count($guest);$i++){
            ?>
            <a href="<?= $guest_l[$i]; ?>" style="text-decoration: none;color:#2883c5;" target="_blank">
            <h6 style="text-transform: capitalize;"><?= $guest[$i]; ?></h6>
            </a>
            <span><b><?= $guest_p[$i]; ?></b></span><br>
            <span><?= $guest_a[$i]; ?></span>
            <br><br>
            <?php
        }
        ?>
       </div>
        <div style="width: inherit;height:60px;background-color:transparent;padding: 5px;">
           <h5>Event Venue and time</h5>
       </div>
       <div style="width: inherit;height: auto;background-color: white;padding: 15px;padding-left: 50px;padding-right: 50px;">
		    <br>
            <span style="float: left;color: #2883c5;"><b><?= $eve['venue'] ?></b></span>
            <br><br>
            <span style="float: left;color: gray;">
                <?php
                $format = 'H:i:s';
                $time=DateTime::createFromFormat($format, '00:00:00');
                if(($eve['s_time']== $time->format('H:i:s')) || ($eve['e_time']== $time->format('H:i:s'))){
                    echo '<b>Contact event management for knowing event start and end time.</b>';
                }
                else{
                    //convert time into am pm
                    $s_t=strtotime($eve['s_time']);
                    $e_t=strtotime($eve['e_time']);
                    $s_t=date("g:i a", $s_t);
                    $e_t=date("g:i a", $e_t);
                    ?>
                    
                    <span><b>Event start time : </b><span style="color:#2883c5"><?=  $s_t; ?></span></span><br>
                    <span><b>Event end time : </b><span style="color:#2883c5"><?= $e_t; ?></span></span><br>
                    <?php
                }
                ?>
                
            </span>
            <br>
            <br>
            <br>
       </div>
       <div style="width: inherit;height:60px;background-color:transparent;padding: 5px;">
           <h5>Event Overview</h5>
       </div>
       <div style="width: inherit;height: 50px;background-color: white;padding: 15px;padding-left: 50px;padding-right: 50px;">
		    <span style="float: left;color: gray"><b>Event Start : </b><?= $eve['e_start'] ?></span>
            <span style="float: right;color: gray"><b>Event End : </b><?= $eve['e_end'] ?></span>
       </div>
       <hr style="margin:0;pdding:0;">
       <div style="width: inherit;height: auto;background-color: white;padding: 10px;padding-left: 50px;padding-right: 50px;">

        <?php
        
        for($i=0;$i<count($t_title);$i++){
            ?>
            
            <h6 style="text-transform: capitalize;color:#2883c5;"><?= $t_title[$i]; ?></h6>
            <span><?= $t_desc[$i]; ?></span>
            <br><br>
        <?php
        }
        ?>
       </div>

            <!--carousel here -->
            <div class="container">
 <div style="width: inherit;height:60px;background-color:transparent;padding: 5px;">
           <h5>Updates</h5>
       </div>
  <br> 
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="<?= '../admin_login/'.$img_address1; ?>" alt="Image1" style="width:auto; height:615px;">
      </div>

      <div class="item">
        <img src="<?= '../admin_login/'.$img_address2; ?>" alt="Image 2" style="width:auto; height:610px;">
      </div>
    
      <div class="item">
        <img src="<?= '../admin_login/'.$img_address3; ?>" alt="Image 3" style="width:auto; height:605px;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

      
           <br>
       </div>
       
       <div style="width: inherit;height:60px;background-color:transparent;padding: 5px;">
          
       </div>
       <div style="width: 200px;height:60px;background-color:transparent;padding: 5px;">
		   <center>
           <form action="../home/enroll.php" method="get">
               <input type="hidden" name="e_id" value="<?= $eve['event_id']; ?>">
               <input type="hidden" name="ref" value="event">
               <input type="submit" name="enroll" value="<?= 'Enroll Now | '.$pr; ?>" style="width: 200px;height: 40px;border-radius: 4px;background-color:#e53c2e;border: none;color: white;font-family: arial,sans-serif;font-size:16px;font-weight: 200;">
               <br>
               <span style="color:#e53c2e;"><?= $n_r6.' Enrollment' ?></span>
           </form>
       </div>
       
       <br>
    </div>
  </header>
  <br>
</div>
 




               
                        
                     <?php   
                     }
                }
                else{  ?>
                    
 <!--  event end or continue -->


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
             <a href="../home/"><span style="float: left; margin-top: 20px;color:#2883c5;font-size: 20px;"><img src="../img/arrow.png">&nbsp &nbsp Explore more events</span></a>
             <span style="float: right">&nbsp &nbsp</span>
             
        </div>
      
       <div class="w3-section w3-bottombar w3-padding-16" style="margin: 0 !important;padding-top: 5px !important;border-bottom-color: #2883c5 !important;">
       </div>
       <div style="width: inherit;height: 400px;background: linear-gradient(#2883c5, #cccccc);">
            
            <div style="width:100%;height: inherit;float: left;">
                <div style="width: 100%;height: inherit;color: white;">
                    
                    <center>
                         <br>
                         <div style="width: inherit;height: 140px;">
                              <h2><?= $eve['event_title']; ?></h2>
                              <span>By</span><br>
                              <span style="font-family: 'Rouge Script',cursive; font-size: 25px; font-weight: normal; margin-bottom: 0px; text-align: center; text-shadow: 0 1px 1px #fff;">
                              <?php
                                $i=0;
                                $n=count($guest);
                                foreach($guest as $g){
                                    if($i == 0){
                                        echo $g;
                                    }
                                    elseif($i <= $n-1){
                                        echo ' <span style="font-size:17px;font-weight: thin !important;"> and </span>'.$g;
                                    }
                                    $i++;
                                }
                                ?>
                         </span>
                         </div>
                         <div style="width: inherit;height: 130px;background-color: transparent;padding: 10px;">
                            <span><?= $eve['e_desc']; ?></span>
                         </div>
                         <div style="width: inherit;height:20px;background-color: transparent;padding-left: 10px;padding-right: 10px;">
                           
                         </div>
                         
                         
                    </center>
                </div>
            </div>
       </div>
       <div class="w3-section w3-bottombar w3-padding-16" style="margin: 0 !important;padding: 0px !important;border-bottom-color: #cccccc !important;">
       </div>
       <div style="width: inherit;height:60px;background-color:transparent;padding: 5px;">
           <h5>About the speakers</h5>
       </div>
       <div style="width: inherit;height: auto;background-color: white;padding: 10px;padding-left: 50px;padding-right: 50px;">
        <?php
       
        for($i=0;$i<count($guest);$i++){
            ?>
            <a href="<?= $guest_l[$i]; ?>" style="text-decoration: none;color:#2883c5;" target="_blank">
            <h6 style="text-transform: capitalize;"><?= $guest[$i]; ?></h6>
            </a>
            <span><b><?= $guest_p[$i]; ?></b></span><br>
            <span><?= $guest_a[$i]; ?></span>
            <br><br>
            <?php
        }
        ?>
       </div>
       <div style="width: inherit;height:60px;background-color:transparent;padding: 5px;">
           <h5>Event Overview</h5>
       </div>
       <div style="width: inherit;height: 50px;background-color: white;padding: 15px;padding-left: 50px;padding-right: 50px;">
		    <span style="float: left;color: gray"><b>Event Start : </b><?= $eve['e_start'] ?></span>
            <span style="float: right;color: gray"><b>Event End : </b><?= $eve['e_end'] ?></span>
       </div>
       <hr style="margin:0;pdding:0;">
       <div style="width: inherit;height: auto;background-color: white;padding: 10px;padding-left: 50px;padding-right: 50px;">
        <?php
        
        for($i=0;$i<count($t_title);$i++){
            ?>
            
            <h6 style="text-transform: capitalize;color:#2883c5;"><?= $t_title[$i]; ?></h6>
            <span><?= $t_desc[$i]; ?></span>
            <br><br>
        <?php
        }
        ?>
       </div>
              <!--carousel here -->
              <div class="container">
 <div style="width: inherit;height:60px;background-color:transparent;padding: 5px;">
           <h5>Updates</h5>
       </div> 
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
           <div class="item active">
                                   
        <img src="<?= '../admin_login/'.$img_address1; ?>" alt="Image1" style="width:auto; height:615px;">
      </div>

      <div class="item">
        <img src="<?= '../admin_login/'.$img_address2; ?>" alt="Image 2" style="width:auto; height:615px;">
      </div>
    
      <div class="item">
        <img src="<?= '../admin_login/'.$img_address3; ?>" alt="Image 3" style="width:auto; height:615px;">
      </div>
    </div>
 
        <div style="width: inherit;height:60px;background-color:transparent;padding: 5px;">
           
       <br>
    </div>
  </header>
  <br>
  
</div> 




          
                    
                <?php    
                    
                }
                
            }
            else{
                echo 'event not find';
            }
       
        }
        else{
            echo 'event id is not set';

        }
     ?>
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>   
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
        session_destroy();
        header('Location:../login');
    }
}
else{
    session_destroy();
    header('Location:../login');
}

?>
