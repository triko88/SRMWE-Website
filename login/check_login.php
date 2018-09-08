<?php

  $conn=mysqli_connect('localhost','root','');
  $db=mysqli_select_db($conn,'weclub');

   if($_SERVER['REQUEST_METHOD']=='POST'){
      if(isset($_POST['login'])){
          if(empty($_POST['m_no']) || empty($_POST['pass'])){
            
            echo "<script> alert('Fill all the details.'); window.location.href='../login/index.php'; </script>" ;
            
          }
          else{
              $pass=mysqli_real_escape_string($conn,$_POST['pass']);
              $uname=mysqli_real_escape_string($conn,$_POST['m_no']);
             
            
                $sql="SELECT * FROM user WHERE m_no='$uname' AND pass='$pass'";
                
                if($result=mysqli_query($conn,$sql)){
                    $nro=mysqli_num_rows($result);
                    if($nro == 1){
                             session_start();
                             $_SESSION['uid']=$uname;
                             $_SESSION['pass']=$pass;
                             $_SESSION['authentication']=true;
                             header("Location:../home");
                             exit();
                    }
                    else{
                         echo "<script> alert('InCorrect id or password'); window.location.href='../login/index.php'; </script>" ;
                    }
                }
                else{
                    header("Location:../login");
                    exit();
                }
             
          }
      }
      else{
         header("Location:../login");
         exit();
      }
   }
   else{
       header("Location:../login");
       exit();
   }

?>