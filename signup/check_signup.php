<?php

  $conn=mysqli_connect('localhost','root','');
  $db=mysqli_select_db($conn,'weclub');

   if($_SERVER['REQUEST_METHOD']=='POST'){
      if(isset($_POST['signup'])){
          if(empty($_POST['f_name']) || empty($_POST['l_name']) ||  empty($_POST['m_no']) ||  empty($_POST['email']) ||  empty($_POST['pass']) || empty($_POST['r_pass'])|| ($_FILES['img']['size'] == 0) ){
            
            echo "<script> alert('Fill all the details'); window.location.href='../signup/index.php'; </script>";

            
          }
          elseif($_POST['pass'] != $_POST['r_pass']){
            echo "<script> alert('pasword doesnot match');  window.location.href='../signup/index.php'; </script>" ;
          }
          else{
              $pass=mysqli_real_escape_string($conn,$_POST['pass']);
              $mno=mysqli_real_escape_string($conn,$_POST['m_no']);
              $email=mysqli_real_escape_string($conn,$_POST['email']);
              if(strlen($pass) >= 8 && strlen($pass) <= 15){
                
                     $query="SELECT * FROM user WHERE email='$email' OR m_no='$mno'";
                     $result=mysqli_query($conn,$query);
                     $n_row=mysqli_num_rows($result);
                     if($n_row == 0){
                                     $size=$_FILES['img']['size']; 
                        $type=$_FILES['img']['type'];
                        if($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/jpg'){
                             
                              $file_d=$_FILES['img']['tmp_name'];
                              
                              if(file_exists('img/'.$_FILES['img']['name'])){
                                echo "<script> alert( 'file name is already exist change the name'); window.location.href='../signup/index.php'; </script>";
                              }
                              
                          else{
                         
                           if(move_uploaded_file($file_d,'img/'.$_FILES['img']['name'])){
                             $fi_name=$_FILES['img']['name'];
                             $fname=mysqli_real_escape_string($conn,$_POST['f_name']);
                             $lname=mysqli_real_escape_string($conn,$_POST['l_name']);
                             $d='img/'.$fi_name;
                             $sql="INSERT INTO `user`(`u_id`, `f_name`, `l_name`, `m_no`, `email`, `pass`, `time`, `img_path`) VALUES (NULL,'$fname','$lname','$mno','$email','$pass',NULL,'$d')";
                                    
                             $result=mysqli_query($conn,$sql)or die(header('Location:../signup'));
                             session_start();
                             $_SESSION['uid']=$mno;
                             $_SESSION['pass']=$pass;
                             $_SESSION['authentication']=true;
                             header("Location:../home");
                             exit();
                            }
                          }
                          
                     }
                 else{
                    echo"<script> alert('file format is no allowed'); window.location.href='../signup/index.php'; </script>";
                 }   
                     }
                     else{
                        echo"<script> alert( 'email or mobile number is already registered'); window.location.href='../signup/index.php'; </script>";
                     }
                
              }
              else{
                  echo "<script> alert( 'too small or big password'); window.location.href='../signup/index.php'; </script>";
              }
          }
      }
      else{
         header("Location:../");
         exit();
      }
   }
   else{
       header("Location:../");
       exit();
   }

?>