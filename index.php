




<style>

.blockTop{
	display: block;
	position: fixed;
	
	width: 100%;
}


</style>







    <?php
        session_start();

if(isset($_REQUEST["e"]))
{
    unset($_SESSION["cod"]);
}
       
                ?>


<!DOCTYPE html>
<!--
first page of the site
has a nav bar and is also the about page of the site
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
  <img src="pics/drop2.png" width="100px" height="50px"/>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Main<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link " href="request.php">Search <span class="sr-only"></span></a>
      </li>
      <li class='nav-item active' ><a class='nav-link' href="displayrequest.php">Blood Requests</a></li>
      
      <?php
        if(isset($_SESSION["cod"]))
        {
            echo "<li class='nav-item'>
        <a class='nav-link active' href=user/home.php>My Page</a>
      </li>
      <li class='nav-item active' ><a class='nav-link' href=index.php?e=f>Logout</a></li>";
        }
        else
        {
            echo "<li class=nav-item>
        <a class='nav-link active' href=login.php#toregister>Register</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link active' href=login.php>Login</a>
      </li>";
        }
      ?>
      
      
    </ul>
    <span class="navbar-text">
      Welcome
    </span>
  </div>
</nav>
            <!--<img src="pics/red top.jpg" width="100%" height="50px"/>-->
        </div>
        
       <div style="margin-left:20%;padding:1px 16px;height:1000px;">
        <br><br><br><br><br>
  <!--<h2>Fixed Full-height Side Nav</h2>
  <h4>Try to scroll this area, and see how the sidenav sticks to the page</h4>
  <p>Notice that this div element has a left margin of 25%. This is because the side navigation is set to 25% width. If you remove the margin, the sidenav will overlay/sit on top of this div.</p>
  <p>Also notice that we have set overflow:auto to sidenav. This will add a scrollbar when the sidenav is too long (for example if it has over 50 links inside of it).</p>
  -->
  <img src="pics/blood-types.png" >
  <br>
  <p><strong>Important:</strong> All Voluntary Donors are warned of likely misuse of blood donated by them at the hospital with
      or without the knowledge of the hospital management. At some places the hospital staff have taken the blood and sold it to
      others for a price. As a responsible citizen/voluntary blood donor, we request you to keep a watch on such people and 
      hospitals. Donors must inform the BFH team members/coordinators of such areas in case of any doubt.</p>
 <!-- <p>Some text..</p>
  <p>Some text..</p>
  <p>Some text..</p>
  <p>Some text..</p>
  <p>Some text..</p>
  <p>Some text..</p> -->
            </div>
        
        
        
    </body>
</html>
