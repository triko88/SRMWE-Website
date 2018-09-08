<?php

  $conn=mysqli_connect('localhost','root','');
  $db=mysqli_select_db($conn,'weclub');

   if($_SERVER['REQUEST_METHOD']=='POST'){
      if(isset($_POST['login'])){
          if(empty($_POST['a_name']) || empty($_POST['pass'])){
            
            echo 'set detail';
            
          }
          else{
              $pass=mysqli_real_escape_string($conn,$_POST['pass']);
              $uname=mysqli_real_escape_string($conn,$_POST['a_name']);
             
            
                $sql="SELECT * FROM admin WHERE a_name='$uname' AND a_pass='$pass'";
                
                if($result=mysqli_query($conn,$sql)){
                    $ro=mysqli_fetch_array($result);
                    $nro=mysqli_num_rows($result);
                    if($nro == 1){
                             session_start();
                             $_SESSION['id']=$ro['admin_id'];
                             $_SESSION['a_name']=$uname;
                             $_SESSION['pass']=$pass;
                             $_SESSION['authentication']=true;
                             header("Location:form.php");
                             exit();
                    }
                    else{
                        echo 'encorrect id or passeord';
                    }
                }
                else{
                    header("Location:./");
                    exit();
                }
             
          }
      }
      else{
         header("Location:./");
         exit();
      }
   }
   else{
       header("Location:./");
       exit();
   }

?>