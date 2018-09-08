<?php
   session_start();
   
   ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  
  
   if($_SESSION['authentication']){
      
      $conn=mysqli_connect('localhost','root','');
      $db=mysqli_select_db($conn,'weclub');

      if($_SERVER['REQUEST_METHOD']=='POST'){
         if(isset($_POST['upload'])){
            
           if(empty($_POST['e_name']) || empty($_POST['e_desc']) || empty($_POST['e_type']) || empty($_POST['s_date']) || empty($_POST['e_date']) || ($_FILES['img']['size'] == 0)  || ($_FILES['img1']['size'] == 0) || ($_FILES['img2']['size'] == 0) || ($_FILES['img3']['size'] == 0) || empty($_POST['no_t']) || empty($_POST['t_title']) ||
               empty($_POST['t_desc']) || empty($_POST['g_names']) || empty($_POST['g_posts']) || empty($_POST['g_links']) || empty($_POST['g_about']) || empty($_POST['cost']) || empty($_POST['zone']) || empty($_POST['venue']) || empty($_POST['e_s_time']) || empty($_POST['e_e_time'])){
                echo "<script>alert('Enter all Details'); window.location.href='../admin_login/form.php'; </script>";
            }
            else{
                $size=$_FILES['img']['size']; 
                $type=$_FILES['img']['type'];
                $size1=$_FILES['img1']['size']; 
                $type1=$_FILES['img1']['type'];
                $size2=$_FILES['img2']['size']; 
                $type2=$_FILES['img2']['type'];
                $size3=$_FILES['img3']['size']; 
                $type3=$_FILES['img3']['type'];
                
                 if($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/jpg' && $type1 == 'image/jpeg' || $type1 == 'image/png' || $type1 == 'image/jpg' && $type2 == 'image/jpeg' || $type2 == 'image/png' || $type2 == 'image/jpg' && $type3 == 'image/jpeg' || $type3 == 'image/png' || $type3 == 'image/jpg'){
                    
                      $file_d=$_FILES['img']['tmp_name'];
                      $file_d1=$_FILES['img1']['tmp_name'];
                      $file_d2=$_FILES['img2']['tmp_name'];
                      $file_d3=$_FILES['img3']['tmp_name'];

                      if(file_exists('img/'.$_FILES['img']['name'])&&file_exists('img/'.$_FILES['img1']['name'])&&file_exists('img/'.$_FILES['img2']['name'])&&file_exists('img/'.$_FILES['img3']['name'])){
                        echo 'file name is already exist change the name';
                      }
                      else{
                         
                         if(move_uploaded_file($file_d,'img/'.$_FILES['img']['name'])&&move_uploaded_file($file_d,'img/'.$_FILES['img1']['name'])&&move_uploaded_file($file_d,'img/'.$_FILES['img2']['name'])&&move_uploaded_file($file_d,'img/'.$_FILES['img3']['name'])){
                            $f_name=$_FILES['img']['name'];
                            $f_name1=$_FILES['img1']['name'];
                            $f_name2=$_FILES['img2']['name'];
                            $f_name3=$_FILES['img3']['name'];
                            
                            $sql1="SELECT event_id FROM event";
                            $result1=mysqli_query($conn,$sql1);
                            $e_id=mysqli_num_rows($result1)+1;
                            
                            $a=$_SESSION['id'];
                            $b=mysqli_real_escape_string($conn,$_POST['e_name']);
                            $c=mysqli_real_escape_string($conn,$_POST['e_desc']);
                            $d='img/'.$f_name;
                            $d1='img/'.$f_name1;
                            $d2='img/'.$f_name2;
                            $d3='img/'.$f_name3;
                            $e=mysqli_real_escape_string($conn,$_POST['e_type']);
                            $f=mysqli_real_escape_string($conn,$_POST['s_date']);
                            $g=mysqli_real_escape_string($conn,$_POST['e_date']);
                            $h=mysqli_real_escape_string($conn,$_POST['no_t']);
                            $i=mysqli_real_escape_string($conn,$_POST['t_title']);
                            $j=mysqli_real_escape_string($conn,$_POST['t_desc']);
                            $o=mysqli_real_escape_string($conn,$_POST['cost']);
                            $p=mysqli_real_escape_string($conn,$_POST['zone']);
                            $q=mysqli_real_escape_string($conn,$_POST['venue']);
                            $r=mysqli_real_escape_string($conn,$_POST['e_s_time']);
                            $s=mysqli_real_escape_string($conn,$_POST['e_e_time']);
                            
                            $sql2="INSERT INTO `event`(`event_id`, `admin_id`, `event_title`, `e_desc`, `e_img_path`, `img_path1`, `img_path2`, `img_path3`, `e_type`, `e_start`, `e_end`, `no_topic`, `topic_title`, `topic_desc`, `event_upload`, `cost`, `zone`, `venue`, `s_time`, `e_time`) VALUES ('$e_id','$a','$b','$c','$d','$d1','$d2','$d3','$e','$f','$g','$h','$i','$j',NULL,'$o','$p','$q','$r','$s')";
                            if(mysqli_query($conn,$sql2)){
                                $k=mysqli_real_escape_string($conn,$_POST['g_names']);
                                $l=mysqli_real_escape_string($conn,$_POST['g_posts']);
                                $m=mysqli_real_escape_string($conn,$_POST['g_links']);
                                $n=mysqli_real_escape_string($conn,$_POST['g_about']);
                                $sql3="INSERT INTO `guest`(`guest_id`, `admin_id`, `event_id`, `guest_name`, `guest_post`, `guest_link`, `guest_about`, `guest_upload`) VALUES (NULL,'$a','$e_id','$k','$l','$m','$n',NULL)";
                                if(mysqli_query($conn,$sql3)){
                                    header("Location:http://localhost/weclub/admin_login/form.php?ans=1");
                                    exit();
                                }
                                else{
                                    echo 'guest can not be inserted';
                                }
                            }
                            else{
                                echo 'event can not be inserted';
                            }
                            
                            
                         }
                         else{
                            echo 'error in event uploding';
                         }
                         
                      }
                     
                 }
                 else{
                    echo 'file format is no allowed';
                 }
            }
            
         }
      }
   }
   else{
      session_destroy();
      header('Location:./');
   }
?>
   