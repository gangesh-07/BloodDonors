



<!--
login/register page page 
using javascript it toggles between the 2
-->
<style>

.blockTop{
	display: block;
	position: fixed;
	
	width: 100%;
}


</style>


<?php

include_once 'conn.php';
if(isset($_POST["btnsignup"]))
{
    
    $uname=$_POST["usernamesignup"];
    $email=$_POST["emailsignup"];
    $pwd=$_POST["passwordsignup"];
    $type=$_POST["usertype"];
    
    //INSERT INTO `user`(`id`, `username`, `email`, `password`, `type`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
    $qry="INSERT INTO `user`(`username`, `email`, `password`, `type`) VALUES ('$uname','$email','$pwd','$type') ";
    $res=mysqli_query($link, $qry);

    
    if(mysqli_affected_rows($link)==1)
        $msg="Registration Successful";
    else
        $msg="Registration not Successful";
}
session_start();

if(isset($_POST["btnsub"]))
{
    $uname=$_POST["username"];
    $pwd=$_POST["password"];
    
    $qry="call logincheck('$uname','$pwd',@cod)";
        $res=  mysqli_query($link, $qry);
        $r=  mysqli_query($link,"select @cod");
        $a=mysqli_fetch_row($r);
       
    if($a[0]==-1)
        $msg="Email Password Incorrect";
    else
    {
       $_SESSION["cod"]=$a[0];
       header("location:user/home.php");
    }
}
?>








<!DOCTYPE html>
<html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login and Registration Form with HTML5 and CSS3</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
               
         <script>
    function xyz()
    {
       // alert('ss');
   var a=document.getElementById('passwordsignup').value;
   //alert(a);
   var b=document.getElementById('passwordsignup_confirm').value;
  // alert(b);
   if(a!=b)
   {
      alert("password and confirm password must be same");
   return false;
   }
   var z=document.getElementById('usertype').value;
  if(z!="individual" && z!="organisation")
   {
      alert("invalid usertype");
   return false;
   }
    }

</script>
    </head>
    <body>
        <div> 
            
  <nav class=" navbar navbar-expand-lg navbar-dark " style="background-color:#d21d1d">
  <img src="pics/drop2.png" width="100px" height="50px"/>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Main  <span class="sr-only">(current)</span></a>
      </li>
      
    </ul>
    <span class="navbar-text">
      Welcome
    </span>
  </div>
</nav> 
        </div>
        <div class="container">
            <br><br>
            <header>
                <h1>Login and Registration Form </h1>
				
            </header>
            <section>				
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form  action="login.php" method="post" autocomplete="on"> 
                                <h1>Log in</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Your email or username </label>
                                    <input id="username" name="username" required="required" type="text" placeholder="myusername or mymail@mail.com"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                                <p class="keeplogin"> 
                                    <input type="checkbox" name="loginkeeping" id="loginkeeping" checked value="loginkeeping" /> 
                                    <label for="loginkeeping">Keep me logged in</label>
				</p>
                                <p class="login button"> 
                                    <input type="submit" value="Login" name="btnsub" /> 
				</p>
                                <br>
                                <?php
                                        if(isset($msg))
                                         echo $msg;    
                                ?>
                                
                                <p class="change_link">
                                    Not a member yet ?
                                    <a href="#toregister" class="to_register">Join us</a>
				</p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form  action="login.php" method="post" autocomplete="on" onsubmit="return xyz()"> 
                                <h1> Sign up </h1> 
                                <p> 
                                    <label for="usernamesignup" class="uname" data-icon="u">Your username</label>
                                    <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="mysuperusername690" />
                                </p>
                                <p> 
                                    <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
                                    <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="mysupermail@mail.com"/> 
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p> 
                                    <label for="usertype" class="uname" data-icon="u">Type</label>
                                    <input id="usertype" name="usertype" required="required" type="text" placeholder="individual/organisation" />
                                </p>
                                
                                <p class="signin button"> 
                                    <input type="submit" value="Sign up" name="btnsignup" /> 
                                     <?php
                                        if(isset($msg))
                                         echo $msg;    
                                        ?>
                                </p>
                                <p class="change_link">  
                                    Already a member ?
                                    <a href="#tologin" class="to_register"> Go and log in </a>
				</p>
                            </form>
                        </div>
						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>