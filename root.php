



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
        header("location:login.php");
    else{
        include_once 'conn.php';
        $id=$_SESSION["cod"];
        //$qry="update tbbook set booktit='$tit',bookaut='$aut',bookpub='$pub',bookprc=$prc where bookid=$bid";
        $qry="select * from user where id=$id";
        $res=mysqli_query($link, $qry);
        $r=mysqli_fetch_row($res);
        
        if($r[4]!='admin')
            header("location:login.php?e=f");
        
        
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
      
     
        
            <li class="nav-item">
        <a class="nav-link" href="root.php">Admin</a>
      </li>
      <li class="nav-item active" ><a class="nav-link" href="index.php?e=f">Logout</a></li>
        
        
      
    </ul>
    <span class=" navbar-text ">
    
    
          <?php
    echo  "Welcome $r[1]";

?>
    </span>
  </div>
</nav>
   </div>     
        <br><br><br><br>
       <?php
       if($r[4]=='admin')
       {
        $qry="show tables";
        $res=mysqli_query($link, $qry);
        

        
        
        echo "<table class=table>";
        echo "<th><label>Tables</label></th>";
        echo "<th><label>No of Rows</label></th>";
        while($r2=mysqli_fetch_row($res))
        {
            
            $result = mysqli_query($link, "SELECT COUNT(*) AS `count` FROM $r2[0]");
            $row = mysqli_fetch_array($result);
            $count = $row['count'];
               echo" <tr>
                        <td>$r2[0]</td>
                        <td>$count</td>
                        <td><a href=details.php?bid=$r2[0] class='btn btn-primary'>Details</a></td>  
                   </tr>";
            
            
        }
        echo "</table>";
        
       }
       ?>
        
        
        
        
    </body>
</html>
