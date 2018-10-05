

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



    if($_SESSION["cod"]==null)
        header("location:../login.php");
    else{
        include_once 'conn.php';
        $id=$_SESSION["cod"];
        //$qry="update tbbook set booktit='$tit',bookaut='$aut',bookpub='$pub',bookprc=$prc where bookid=$bid";
        $qry="select * from user where id=$id";
        $res=mysqli_query($link, $qry);
        $r=mysqli_fetch_row($res);
        
        if(isset($_GET["bid"]))
            $a=$_GET["bid"];
        
         $q="DESCRIBE $a";
        $des=mysqli_query($link, $q);
        
        $qry="select * from $a";
        $res=mysqli_query($link, $qry);
        
        
        
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
      
    
        
           <li class=nav-item>
        <a class="nav-link" href="root.php">Admin</a>
      </li>
      <li class="nav-item active" ><a class="nav-link" href="index.php?e=f">Logout</a></li>
       
      
    </ul>
    <span class="navbar-text">
    
    
          <?php
    echo "Welcome $r[1]";

?>
    </span>
  </div>
</nav>
  </div>
        <br><br><br>
        <h3 align="center">Details Page</h3>
        <h5>Structure of  <?php echo $a;?></h5>
        
        <table class="table table-dark table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">Field</th>
      <th scope="col">Type</th>
      <th scope="col">Null</th>
      <th scope="col">Key</th>
      <th scope="col">Default</th>
      <th scope="col">Extra</th>
    </tr>
  </thead>
  <tbody>
      <?php 
      $count=0;
      
      while($d=mysqli_fetch_row($des)){
          $count++;
   echo " <tr>
      <td>$d[0]</td>
      <td>$d[1]</td>
      <td>$d[2]</td>
      <td>$d[3]</td>
      <td>$d[4]</td>
      <td>$d[5]</td>
    </tr>";
      }
            
            
    ?>
  </tbody>
</table>
        
        
        <table class="table  table-striped table-bordered">
  <thead>
    <tr>
  <h5>Contents</h5>
        <?php
        
        mysqli_data_seek($des,0);
       while($d=mysqli_fetch_row($des))
        {
             echo "<th scope='col'>$d[0]</th>";
        }
     
              ?>
    </tr>
  </thead>
  <tbody>
      <?php 
      
      while($r2=mysqli_fetch_row($res)){
          
          $i=0;
          echo "<tr>";
          mysqli_data_seek($des,0);
          while($i<$count)
            {
                echo "<td scope='col'>$r2[$i]</td>";
                $i++;
            }
          echo "</tr>";
      }
            
            
    ?>
  </tbody>
</table>
        
        
        
     
       
      
        
        
        
        
    </body>
</html>
