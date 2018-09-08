<?php
session_start();
if($_SESSION['authentication']){
    session_destroy();
    header('Location:../login');
}
else{
   session_destroy();
   header('Location:../login'); 
}

?>