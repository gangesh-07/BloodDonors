

<!--
this is the details page for the admin
are admin queries are requested to this page

-->

<style>

.blockTop{
	display: block;
	position: fixed;
	
	width: 100%;
}


</style>




    <?php
        session_start();
        include_once 'conn.php';


    if(!isset($_SESSION["cod"]))
    {$r=null;$id=0;}//header("location:login.php");
    else{
        
        $id=$_SESSION["cod"];
        //$qry="update tbbook set booktit='$tit',bookaut='$aut',bookpub='$pub',bookprc=$prc where bookid=$bid";
        $qry="select * from user where id=$id";
        $res=mysqli_query($link, $qry);
        $r=mysqli_fetch_row($res);
        
        if(isset($_GET["bid"]))
            $a=$_GET["bid"];
        
        
        
        
        
        
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
  <img src="pics/drop2.png" width="100px" height="50px"/>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Main<span class="sr-only">(current)</span></a>
      </li>    
      <li class="nav-item active">
        <a class="nav-link" href="request.php">Search <span class="sr-only"></span></a>
      </li>
      <?php
      if(isset($_SESSION["cod"]))
        {
            echo "<li class='nav-item'>
        <a class='nav-link active' href=user/home.php>My Page</a>
      </li>
      <li class='nav-item active' ><a class='nav-link' href=user/projects.php>Project list</a></li>";
      if($r[4]=='organisation')
      {echo "<li class='nav-item active' ><a class='nav-link' href='user/projects.php?bid=m'>My Projects</a></li>
          <li class='nav-item active' ><a class='nav-link' href=newproject.php>Register Project</a></li>";
      }
      
      echo "<li class='nav-item active' ><a class=nav-link href=index.php?e=f>Logout</a></li>";
        }
        else
        {
            echo "<li class='nav-item'>
        <a class='nav-link' href=login.php#toregister>Register</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href=login.php>Login</a>
      </li>";
        }
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
        <h3 align="center"> Search Blood Request</h3>
        <br>
        <?php
        echo" <form action='displayrequest.php' method='post' autocomplete='on'>
       <table class=table>
       
        <tr>
            <td><label for=inputState>Blood type</label></td>
            <td><select id=inputbloodtype required=required name=bloodtype >
                    <option >any</option>
                    <option>A+</option>
                    <option>A-</option>
                    <option>B+</option>
                    <option>B-</option>
                    <option>AB+</option>
                    <option>AB-</option>
                    <option>O+</option>
                    <option>O-</option>
                   
                </select>
            </td>
        </tr>
        
         <tr>
            <td><label for=inputState>State</label></td>
            <td><select id=inputState required=required name=city >";
                    
                        $qrydep="select * from city";
                        
                        $resdep=  mysqli_query($link, $qrydep);
                        while($rowdep=mysqli_fetch_row($resdep))
                        {                 
                                echo "<option> $rowdep[2] </option>";
                        }
                        echo "</select><br>
            </td>
        </tr>
        
        
        <td></td>
        <td><button type=submit class='btn btn-primary' name=search>Search</button>";
        //<a href=request.php class='btn btn-primary'>Cancel</a>
        echo "
            <a href=displayrequest.php class='btn btn-primary'>Clear</a>                
        </td> 
        
        </tr>
    </table>
  
   
</form><br><br>";
       
     if(isset($_POST["search"]))
     {
         
        //$r=mysqli_fetch_row($res); 
        
       echo "<h5>Search Result</h5>";
       
       
        echo "<table class='table table-dark table-bordered table-striped' >
  <thead>";
      
    echo "<tr>
      <th scope=col>Name</th>
      <th scope=col>Blood Group</th>
      <th scope=col>Units Required</th>
      <th scope=col>Age</th>
      <th scope=col>Mobile No.</th>
      <th scope=col>Hospital</th>
      <th scope=col>Required By</th>
      <th scope=col>City </th>
      <th scope=col>Status</th>
      
     
      </tr>";
    
          
      
 echo" </thead>
  <tbody>";
        
        $blood=$_POST["bloodtype"];
        $city=$_POST["city"];
        //echo $blood;
        //echo $city;
        if($blood=='any')
            $qry="select * from bloodrequest where city='$city'";//where city=$city AND bloodtype=$blood";
        else
            $qry="select * from bloodrequest where city='$city' and bloodtype='$blood'";
        $res=mysqli_query($link, $qry);
        $c=0;
      while($d=mysqli_fetch_array($res)){
          $c++;
       
       echo " <tr>
      <td>$d[2] $d[3]</td>
      <td>$d[4]</td>
      <td>$d[5]</td>
      <td>$d[6]</td>
      <td>$d[7]</td>
      <td>$d[8]</td>
      <td>$d[9]</td>
      <td>$d[11]</td>
      <td>$d[12]</td>   
      
            </tr>";
          }          
      
      if($c==0)
          echo " <tr><td colspan=5>Sorry....no matches</td></tr>";
     }
     else
     {
         
         echo "<table class='table table-dark table-bordered table-striped' >
        <thead>";
      
    echo "<tr>
      <th scope=col>Name</th>
      <th scope=col>Blood Group</th>
      <th scope=col>Units Required</th>
      <th scope=col>Age</th>
      <th scope=col>Mobile No.</th>
      <th scope=col>Hospital</th>
      <th scope=col>Required By</th>
      <th scope=col>City </th>
      <th scope=col>Status</th>
      
     
      </tr>";
    
          
      
 echo" </thead>
  <tbody>";
        
        //$blood=$_POST["bloodtype"];
        //$city=$_POST["city"];
        //echo $blood;
        //echo $city;
       
            $qry="select * from bloodrequest ";//where city=$city AND bloodtype=$blood";
        
        $res=mysqli_query($link, $qry);
        $c=0;
      while($d=mysqli_fetch_array($res)){
          $c++;
       
       echo " <tr>
      <td>$d[2] $d[3]</td>
      <td>$d[4]</td>
      <td>$d[5]</td>
      <td>$d[6]</td>
      <td>$d[7]</td>
      <td>$d[8]</td>
      <td>$d[9]</td>
      <td>$d[11]</td>
      <td>$d[12]</td>
      
            </tr>";
          }      
         
     }
           
    ?>
  </tbody>
</table>
    
        
        
        
     
       
      
        
        
        
        
    </body>
</html>
