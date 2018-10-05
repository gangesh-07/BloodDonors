






<style>

.blockTop{
	display: block;
	position: fixed;
	
	width: 100%;
}


</style>

<script>
    function xyz()
    {
       // alert('ss');
   var a=document.getElementById('pwd').value;
   //alert(a);
   var b=document.getElementById('confirm_pwd').value;
  //alert(b);
   if(a!=b)
   {
      alert("password and confirm password must be same");
   return false;
   }
  
    }
 </script>
 <?php
    session_start();
    if($_SESSION["cod"]==null) 
        header("location:../login.php");
    else{
        include_once '../conn.php';
        $id=$_SESSION["cod"];
        //$qry="update tbbook set booktit='$tit',bookaut='$aut',bookpub='$pub',bookprc=$prc where bookid=$bid";
        $qry="select * from user where id=$id";
        $res=mysqli_query($link, $qry);
        $r=mysqli_fetch_row($res);
    }
    if(isset($_POST["change"]))
    {
        $cpwd=$_POST["cpwd"];
        $pwd=$_POST["pwd"];
        if($r[3]==$cpwd){
        $qq="UPDATE `user` set password='$pwd' where id=$r[0]";
        $rr=mysqli_query($link, $qq);
        
        if(mysqli_affected_rows($link)==1)
        $msg="Password Successfully Changed";
             else
        $msg="Password NOT changed";
        }
        else
            $msg="Current Password is Wrong";
    }
        
        
        ?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Blood Management</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    </head>
    <body>
  <div class="blockTop"> 
            
  <nav class=" navbar navbar-expand-lg navbar-dark " style="background-color:#d21d1d">
  <img src="../pics/drop2.png" width="100px" height="50px"/>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">Main  <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../request.php">Search <span class="sr-only"></span></a>
      </li>
      <li class='nav-item active' ><a class='nav-link' href="../displayrequest.php">Blood Requests</a></li>
       <li class='nav-item active' ><a class='nav-link' href="projects.php">Project list</a></li>
    
           <?php
   
    if($r[4]=='individual')
        echo "<li class='nav-item active' ><a class='nav-link' href=bloodrequest.php>Post a Request</a></li>";
     
     if($r[4]=='organisation')
     {   echo "<li class='nav-item active' ><a class='nav-link' href='projects.php?bid=m'>My Projects</a></li>";
         echo "<li class='nav-item active' ><a class='nav-link' href=newproject.php>Register Project</a></li>";}
     echo "<li class='nav-item active' ><a class='nav-link' href=../index.php?e=f>Logout</a></li>";
     ?>
    </ul>
    <span class="navbar-text">
        <?php
            echo "Welcome $r[1]";
            

?>
    </span>
  </div>
</nav>
  </div>      
        <br><br><br><br>
        
        <h3 align="center">Change Password</h3>
        <br><br><br>
        <form action='changepwd.php' method='post' autocomplete='on' onsubmit="return xyz()">
       <table class='table table-striped'>
        <tr>
            <td><label for="cpwd">Current Password</label></td>
            <td><input type="password" required="required" id="cpwd" name="cpwd" ></td>
        </tr>
        <tr>
            <td><label for="pwd">New Password</label></td>
            <td><input type="password" required="required" id="pwd" name="pwd" ></td>
        </tr>
        <tr>
            <td><label for="confirm_pwd">Confirm Password</label></td>
            <td><input type="password" required="required" id="confirm_pwd" name="confirm_pwd" ></td>
        </tr>
               
        <td></td>
        <td><button type="submit" class='btn btn-primary' name="change">Change</button>
            <a href="changepwd.php" class='btn btn-primary'>Cancel</a>
        </td> 
        
        </tr>
    </table>
  
   
</form>
        <?php
        if(isset($msg))
            echo $msg;
        ?>
    </body>
</html>
