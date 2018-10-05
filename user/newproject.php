



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
        if($r[4]=='individual')        
               header("location:home.php");
        //if($r[1]=='root')
           // header("location:../root.php");
            if(isset($_GET["pid"]))
                     $p=$_GET["pid"];
            else
                $p=0;
             if(isset($_GET["bid"]))
                     $a=$_GET["bid"];
                else
                    $a='n';
        
        
        
        
         if($r[4]=='organisation'){
                if($p){
                $qry="select * from project where organisation_id=$id and project_id=$p";
                $res=mysqli_query($link, $qry);
                $r2=mysqli_fetch_row($res);
                }
                else 
                    $r2=null;
                
                $qqry="select * from organisation where id=$id ";
                $rres=mysqli_query($link, $qqry);
                $ro=mysqli_fetch_row($rres); 
               }
                                                                                
    }
    if(isset($_POST["save"]))
    {
       
        
    
    $pname=$_POST["pname"];
    //$oname=$_POST["oname"];
    $dsc=$_POST["txtdsc"];
    $status=$_POST["status"];
    $add=$_POST["add"];
    $city=$_POST["city"];
    $state=$_POST["state"];
    
    //echo $a;
        if(!$r2){
             $qry="INSERT INTO `project`(`project_name`,`organisation_id`,`project_desc`,`status`,`address`,`state`,`city`)"
            . " VALUES ('$pname','$id','$dsc','$status','$add','$state','$city') ";
        }else{
            //$qry="update tbbook set booktit='$tit',bookaut='$aut',bookpub='$pub',bookprc=$prc where bookid=$bid";
$qry="UPDATE `project` set project_name='$pname',project_desc='$dsc',status='$status',"
        . "address='$add',state='$state',city='$city' where project_id=$p ";
        }
    $res=mysqli_query($link, $qry);

   
    if(mysqli_affected_rows($link)==1)
    {$msg="Details saved";header("projects.php");}
    else
        $msg="Details not saved ".mysqli_error($link);
    
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
   
    
        echo "<li class='nav-item active' ><a class='nav-link' href=projects.php>Project list</a></li>";
     if($r[4]=='organisation')
      echo "<li class='nav-item active' ><a class='nav-link' href=projects.php?bid=my>My Projects</a></li>";
      
       echo "<li class='nav-item active' ><a class='nav-link' href=../index.php?e=f>Logout</a></li>";
?>
    </ul>
    <span class="navbar-text">
        <?php
        if($ro)
            echo "Welcome $ro[1]";
        else
            echo "Welcome $r[1]";

?>
    </span>
  </div>
</nav>
  </div>
        <br><br>
        <br><br>
        
        
        <?php
         if((!$r2 ||$a=='e')){
        
   echo" <form action='newproject.php' method='post' autocomplete='on'>
       <table class='table table-striped'>
       
        <tr>
            <td><label for=pname>Project Name</label></td>
            <td><input type=text required=required id=pname name=pname value='$r2[1]' placeholder=project name></td>
        </tr>
        <tr>
            <td><label for=oname>Organisation Name</label></td>
            <td>$ro[1]</td>
        </tr>
        
        <tr>
            <td><label for=pname>Project Description</label></td>
            <td><textarea class='form-control' name='txtdsc' rows='6' cols='70' id='txtdsc'>$r2[4]</textarea></td>
        </tr>

        
        
        <tr>
            <td><label for=status>Status</label></td>
            <td> <input type=text required=required id=status value='$r2[5]' name=status placeholder=closed/ongoing/completed/upcoming></td>
        </tr>
        
        <tr>
            <td><label for=inputAddress>Address</label></td>
            <td><input type=text required=required id=inputAddress value='$r2[6]' name=add placeholder=1234 Main St></td>
        </tr>
            
        <tr>
            <td><label for=inputstate>State</label></td>
            <td><select id=inputState required=required name=state >";
                    
                        $qrydep="select * from states";
                        
                        $resdep=  mysqli_query($link, $qrydep);
                        while($rowdep=mysqli_fetch_row($resdep))
                        {
                            if($r2[7]==$rowdep[1])
                            { echo "<option selected> $rowdep[1] </option>";
                            $state_id=$rowdep[0];
                            }
                            else
                                echo "<option > $rowdep[1] </option>";
                        }
                        echo "</select><br>
        </tr>
        
        <tr>
            <td><label for=inputCity>City</label></td>
            <td><input type=text required=required id=inputCity value='$r2[8]' name=city></td>
        </tr>
        
       
        <tr> 
        <td></td>
        <td><button type=submit class='btn btn-primary' name=save>Save</button>
        <a href=newproject.php class='btn btn-primary'>Cancel</a>
        </td> 
        
        </tr>
    </table>
  
   
</form>";
     }
      else if($r2){
         
        
   echo" 
       <table class='table table-striped'>
        <tr>
            <td><label for=pname>Project Name</label></td>
            <td>$r2[1]</td>
        </tr>
        <tr>
            <td><label for=organsation>Organisation Name</label></td>
            <td>$r2[3]</td>
        </tr>
        <tr>
            <td><label for=pname>Project Description</label></td>
            <td>$r2[4]</td>
        </tr>           
        
        <tr>
            <td><label for=status>Status</label></td>
            <td> $r2[5]</td>
        </tr>
        
        <tr>
            <td><label for=inputAddress>Address</label></td>
            <td>$r2[6]</td>
        </tr>
            
        <tr>
            <td><label for=inputstate>State</label></td>
            <td>$r2[7]</td>
        </tr>
        
        <tr>
            <td><label for=inputCity>City</label></td>
            <td>$r2[8]</td>
        </tr>
        
        
        <tr> 
        <td></td>
        <td><a href=newproject.php?bid=e&pid=$r2[0] class='btn btn-primary'>Edit</td> 
        
        </tr>
    </table>";
  
   

     }
     if(isset($msg))
            echo $msg;
        ?>
     
        
    </body>
</html>
