<?php

  $conn=mysqli_connect('localhost','root','');
  $db=mysqli_select_db($conn,'weclub');

   if($_SERVER['REQUEST_METHOD']=='POST'){
      if(isset($_POST['update'])){
          if(empty($_POST['f_name']) || empty($_POST['l_name']) ||  empty($_POST['m_no']) ||  empty($_POST['email']) ||  empty($_POST['pass']) || empty($_POST['r_pass'])|| ($_FILES['img']['size'] == 0) ||  empty($_POST['id']) ){
            
            echo "<script>alert('Enter all details'); window.location.href='../home/editprofile.php'; </script>";
            
          }
          elseif($_POST['pass'] != $_POST['r_pass']){
              echo "<script>alert('Passwords not matched'); window.location.href='../home/editprofile.php'; </script>";
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
                                  echo "<script>alert('file name is already exist change the name'); window.location.href='../home/editprofile.php'; </script>";
                              }
                              
                          else{
                         
                           if(move_uploaded_file($file_d,'../signup/img/'.$_FILES['img']['name'])){
                             $fi_name=$_FILES['img']['name'];
                             $fname=mysqli_real_escape_string($conn,$_POST['f_name']);
                             $lname=mysqli_real_escape_string($conn,$_POST['l_name']);
                             $id=mysqli_real_escape_string($conn,$_POST['id']);
                             $d='../signup/img/'.$fi_name;
                             $sql="UPDATE user SET f_name='$fname', l_name='$lname', m_no='$mno', email='$email', pass='$pass', img_path='$d' WHERE u_id='$id'";
                             $result=mysqli_query($conn,$sql)or die(header("Location:../home"));
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
                     echo "<script>alert('file format is not allowed'); window.location.href='../home/editprofile.php'; </script>";

                 }   
                     }
                     else{
                         echo "<script>alert('email or mobile number is already registered'); window.location.href='../home/editprofile.php'; </script>";
                     }
                
              }
              else{
                  echo "<script>alert('Enter password which could be accepted'); window.location.href='../home/editprofile.php'; </script>";
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