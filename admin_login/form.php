<?php
   session_start();
   
   if($_SESSION['authentication']){
    
    ?>
    
    
    
<br>
<center>
    <a href="logout.php" style="color: red">Logout</a><span>&nbsp (Don't forget to logout)</span>
</center>
<br><hr><br>
   <center>
       <h2>WEClub Event form</h2>
   </center>
<br>
<center>
    <?php
    if($_GET['ans']==1){
        echo '<h3 style="color:green">Event inserted sucessfully</h3>';
    }
    if($_GET['ans']==2){
        echo '<h3 style="color:red">Event occur</h3>';
    }
    ?> 
    
</center> 
<br>
<hr>
<br>
<center>
<form action="upload_event.php" method="post" enctype="multipart/form-data">    
<table style="width:600px;height: auto;">
    <tr style="width: inherit;height: 50px;">
        <td style="width: 300px;height: 50px;">
            Event Name
        </td>
        <td style="width: 300px;height: 50px;">
            <input type="text" name="e_name" placeholder="Event name" style="width: inherit;height: 40px;">
        </td>
    </tr>
    <tr style="width: inherit;height: 50px;">
        <td style="width: 300px;height: 100px;">
            Event description
        </td>
        <td style="width: 300px;height: 100px;">
             <textarea name="e_desc" style="width: inherit;height: inherit;"></textarea>
        </td>
    </tr>
    <tr style="width: inherit;height: 50px;">
        <td style="width: 300px;height: 50px;">
            Event type
        </td>
        <td style="width: 300px;height: 50px;">
           <select name="e_type" style="width: inherit;height: 40px;">
               <option value="seminar">Seminar</option>
               <option value="workshop">Workshop</option>
               <option value="hackathon">Hackathon</option>
           </select>
        </td>
    </tr>
    <tr style="width: inherit;height: 50px;">
        <td style="width: 300px;height: 50px;">
            Event start date<span style="color: red;">&nbsp(be careful)</span>
        </td>
        <td style="width: 300px;height: 50px;">
            <input name="s_date" type="date" style="width: inherit;height: 30px;">
        </td>
    </tr>
    <tr style="width: inherit;height: 50px;">
        <td style="width: 300px;height: 50px;">
            Event end date<span style="color: red;">&nbsp(be careful)</span>
        </td>
        <td style="width: 300px;height: 50px;">
            <input name="e_date" type="date" style="width: inherit;height: 30px;">
        </td>
    </tr>
    <tr style="width: inherit;height: 80px;">
        <td style="width: 300px;height: 80px;">
            Venue<span style="color: red;">&nbsp(be careful)</span>
        </td>
        <td style="width: 300px;height: 80px;">
            <input name="venue" type="text" style="width: inherit;height: 60px;">
        </td>
    </tr>
    <tr style="width: inherit;height: 50px;">
        <td style="width: 300px;height: 50px;">
            Event start time<span style="color: red;">&nbsp(be careful)</span>
        </td>
        <td style="width: 300px;height: 50px;">
            <input name="e_s_time" type="time" style="width: inherit;height: 30px;">
        </td>
    </tr>
    <tr style="width: inherit;height: 50px;">
        <td style="width: 300px;height: 50px;">
            Event end time<span style="color: red;">&nbsp(be careful)</span>
        </td>
        <td style="width: 300px;height: 50px;">
            <input name="e_e_time" type="time" style="width: inherit;height: 30px;">
        </td>
    </tr>
    <tr style="width: inherit;height: 50px;">
        <td style="width: 300px;height: 50px;">
            Event image
        </td>
        <td style="width: 300px;height: 50px;">
            <input type="file" name="img">
        </td>
    </tr>
    <tr style="width: inherit;height: 50px;">
        <td style="width: 300px;height: 50px;">
             Slider Image 1
        </td>
        <td style="width: 300px;height: 50px;">
            <input type="file" name="img1">
        </td>
    </tr>
        <tr style="width: inherit;height: 50px;">
        <td style="width: 300px;height: 50px;">
             Slider Image 2
        </td>
        <td style="width: 300px;height: 50px;">
            <input type="file" name="img2">
        </td>
    </tr>    <tr style="width: inherit;height: 50px;">
        <td style="width: 300px;height: 50px;">
             Slider Image 3
        </td>
        <td style="width: 300px;height: 50px;">
            <input type="file" name="img3">
        </td>
    </tr>
    <tr style="width: inherit;height: 50px;">
        <td style="width: 300px;height: 50px;">
            Number of topics
        </td>
        <td style="width: 300px;height: 50px;">
            <input type="text" name="no_t">
        </td>
    </tr>
    <tr style="width: 600px;height: 100px;">
        <td style="width: 600px;height: 100px;" colspan="2">
            <span style="color: blue">If you have 3 no of topic the you will write topic name like this :-</span><br>
            <span style="color: blue">motivation#Introduction to NLP#NLP and software &nbps </span><br>
            <span style="color: orange">separate by #</span>
        </td>
    </tr>
    <tr style="width: inherit;height: 100px;">
        <td style="width: 300px;height: 100px;">
            Topic titles
        </td>
        <td style="width: 300px;height: 100px;">
            <textarea style="width: inherit;height: inherit;" name="t_title"></textarea>
        </td>
    </tr>
    <tr style="width: 600px;height: 60px;">
        <td style="width: 600px;height: 60px;" colspan="2">
            <span style="color: blue">Same thing do with description :-</span><br>
            <span style="color: orange">separate by #</span>
        </td>
    </tr>
    <tr style="width: inherit;height: 100px;">
        <td style="width: 300px;height: 100px;">
            Topic descriptions
        </td>
        <td style="width: 300px;height: 100px;">
            <textarea style="width: inherit;height: inherit;" name="t_desc"></textarea>
        </td>
    </tr>
</table>
    <br>
    <hr>
    <br>
    <span style="color:blue">Every thing is separated by # if it is more than one <b style="color: red;">(be careful)</b></span>
    <br>
    <br>
<table style="width:600px;height: auto;">
    <tr style="width: inherit;height: 100px;">
        <td style="width: 300px;height: 100px;">
            Guest Names
        </td>
        <td style="width: 300px;height: 100px;">
            <textarea style="width: inherit;height: 100px;" name="g_names"></textarea>
        </td>
    </tr>
    <tr style="width: inherit;height: 100px;">
        <td style="width: 300px;height: 100px;">
            Guest posts
        </td>
        <td style="width: 300px;height: 100px;">
           <textarea style="width: inherit;height: 80px;" name="g_posts"></textarea>
        </td>
    </tr>
    <tr style="width: inherit;height: 100px;">
        <td style="width: 300px;height: 100px;">
            Guest Profile links
        </td>
        <td style="width: 300px;height: 100px;">
            <textarea style="width: inherit;height: 100px;" name="g_links"></textarea>
        </td>
    </tr>
    <tr style="width: inherit;height: 200px;">
        <td style="width: 300px;height: 200px;">
            Guest about
        </td>
        <td style="width: 300px;height: 200px;">
            <textarea style="width: inherit;height: 200px;" name="g_about"></textarea>
        </td>
    </tr>
</table>
    <br><br>
    <hr>
    <br><br>
<table style="width:600px;height: auto;">
    <tr style="width: inherit;height: 50px;">
        <td style="width: 300px;height: 50px;">
            Coast(in Rs.)<span style="color: blue;"> Enter 0 if event is free of cost</span>
        </td>
        <td style="width: 300px;height: 50px;">
            <input style="width: inherit;height: 50px;" name="cost"></input>
        </td>
    </tr>
     <tr style="width: inherit;height: 50px;">
        <td style="width: 300px;height: 50px;">
            Event zone
        </td>
        <td style="width: 300px;height: 50px;">
           <select style="width: inherit;height: 50px;" name="zone">
              <option value="Technology">Technology</option>
              <option value="Business">Business</option>
              <option value="Design">Design</option>
              <option value="Science">Science</option>
              <option value="Entertainment">Entertainment</option>
           </select>
        </td>
    </tr>
</table>
    
    <br><br>
    
    <input type="submit" name="upload" value="Upload event" style="width: 300px;height: 40px;">
     <br><br><br><hr><br><br><br><br><br><br><br><br><br>
</form>
</center>
    
    
    
    <?php
    
   }
   else{
    session_destroy();
    header('Location:./');
   }

?>
