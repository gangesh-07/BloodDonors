


<style>

.blockTop{
	display: block;
	position: fixed;
	
	width: 100%;
}


</style>



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
        
       // if($r[1]=='root')
         //   header("location:../root.php");
        if($r[4]=='individual'){
        
                $qry="select * from singleuser where id=$id";
                $res=mysqli_query($link, $qry);
                $r2=mysqli_fetch_row($res);
        if(isset($_GET["bid"]))
                     $a=$_GET["bid"];
                else
                    $a='n';
                
        }
        else if($r[4]=='organisation'){
        $qry="select * from organisation where id=$id";
                $res=mysqli_query($link, $qry);
                $r2=mysqli_fetch_row($res);
        
                if(isset($_GET["bid"]))
                     $a=$_GET["bid"];
                else
                    $a='n';
        
        }
        
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
      <li class='nav-item'>
        <a class='nav-link active' href="home.php">My Page</a>
      </li>
      <li class="nav-item active">  
        <a class="nav-link" href="../request.php">Search <span class="sr-only"></span></a>
      </li>
      <li class='nav-item active' ><a class='nav-link' href="../displayrequest.php">Blood Requests</a></li>
         <?php
        
            
    
     if($r[4]=='organisation')
     { echo "<li class='nav-item active' ><a class='nav-link' href=newproject.php>New Project</a></li>";
            if($a=='n')
            echo "<li class='nav-item active' ><a class='nav-link' href='projects.php?bid=m'>My Projects</a></li>";
        else
            echo "<li class='nav-item active' ><a class='nav-link' href='projects.php'>Projects List</a></li>";

     }else
         echo "<li class='nav-item active' ><a class='nav-link' href='projects.php'>Projects List</a></li>";
     
      echo "<li class='nav-item active' ><a class='nav-link' href=../index.php?e=f>Logout</a></li>";
?>
    </ul>
    <span class="navbar-text">
        <?php
        if($r2)
         echo "Welcome $r2[1]";
        else
    echo "Welcome $r[1]";

?>
    </span>
  </div>
</nav>
  </div>
        <br>
        <br>
        
        <br>
        <br>
        <?php 
        if($a=='n')
            echo" <h5 align='center'>List of Projects</h5>";
        else
           echo" <h5 align='center'>My Projects</h5>";
        ?>
        
        <table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">Project Name</th>
      <th scope="col">Organisation Name</th>
      <th scope="col">Project Description</th>
      <th scope="col">Status</th>
      <th scope="col">Location</th>
      <th scope="col">Contact No.</th>
      <th scope="col">City</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
      <?php 
             if($a=='m'){
                  $qry="select * from project where organisation_id=$r2[0]";
                $des=mysqli_query($link, $qry);
                
                
                 
      
                while($d=mysqli_fetch_row($des)){
          
                echo " <tr>
                <td>$d[1]</td>
                <td>$d[3]</td>
                <td>$d[4]</td>
                <td>$d[5]</td>
                <td>$d[6]</td>
                <td>$r2[4]</td>
                <td>$d[8]</td>
                <td><a href=newproject.php?bid=e&pid=$d[0] class='btn btn-primary'>edit</a></td>
                </tr>";
                 
             }
             }
             else{
      
                $qry="select * from project";
                $des=mysqli_query($link, $qry);
                
                //echo $r2[2];
                 
      
                while($d=mysqli_fetch_row($des)){
                    $qry="select * from organisation where id=$d[2]";
                $res=mysqli_query($link, $qry);
                $r9=mysqli_fetch_row($res);
          
                echo " <tr>
                <td>$d[1]</td>
                <td>$d[3]</td>
                <td>$d[4]</td>
                <td>$d[5]</td>
                <td>$d[6]</td>
                <td>$r9[4]</td>
                <td>$d[8]</td>
                </tr>";
      }
             }      
            
    ?>
  </tbody>
</table>
        
        
    </body>
</html>
