




<style>

.blockTop{
	display: block;
	position: fixed;
	
	width: 100%;
}


</style>




<!--
users main page
after login this page pops up

4 if else condittions are there
    firstly divided into individual and organisation
        for each of both 2 different conditions arises
            1)already entered their personal details
            2)still to enter their details

so total 4 if else conditins

-->
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
        
        if($r[1]=='root')
            header("location:../root.php");
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
    
    
    
    if(isset($_POST["save"]))
    {
       include_once '../conn.php';
        $id=$_SESSION["cod"]; 
    
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $sex=$_POST["sex"];
    $blood=$_POST["bloodtype"];
    $check=$_POST["status"];
    $mbno=$_POST["mobile"];
    $dob=$_POST["dob"];    
    $add=$_POST["add"];
    $city=$_POST["city"];
    $state=$_POST["state"];
    $pin=$_POST["pin"];
    //echo $a;
        if(!$r2){
             $qry="INSERT INTO `singleuser`(`id`,`firstname`,`lastname`,`sex`,`bloodtype`,`checkstatus`,`mobileno`,`dob`,`address`,`city`,`state`,`pincode`)"
            . " VALUES ($id,'$fname','$lname','$sex','$blood','$check',$mbno,$dob,'$add','$city','$state',$pin) ";
        }else{
            //$qry="update tbbook set booktit='$tit',bookaut='$aut',bookpub='$pub',bookprc=$prc where bookid=$bid";
$qry="UPDATE `singleuser` set firstname='$fname',lastname='$lname',sex='$sex',bloodtype='$blood',checkstatus='$check',"
        . "mobileno='$mbno',dob='$dob',address='$add',city='$city',state='$state',pincode=$pin where id=$id ";
        }
    $res=mysqli_query($link, $qry);

   
    if(mysqli_affected_rows($link)==1)
    {$msg="Details saved";header("Refresh:0");}
    else
        $msg="Details not saved ".mysqli_error($link);
    
    }
    if(isset($_POST["save_o"]))
    {
       //include_once '../conn.php';
       // $id=$_SESSION["cod"]; 
    
    $oname=$_POST["oname"];
    $type=$_POST["organisation"];
    $email=$_POST["email"];    
    $mbno=$_POST["mobile"];   
    $add=$_POST["add"];
    $state=$_POST["state"];
    $city=$_POST["city"];
    $pin=$_POST["pin"];
    
    //echo $a;
        if(!$r2){
             $qry="INSERT INTO `organisation`(`id`,`organisation_name`,`type`,`email`,`mobileno`,`address`,`state`,`city`,`pincode`)"
            . " VALUES ($id,'$oname','$type','$email','$mbno','$add','$state','$city',$pin) ";
        }else{
            //$qry="update tbbook set booktit='$tit',bookaut='$aut',bookpub='$pub',bookprc=$prc where bookid=$bid";
$qry="UPDATE `organisation` set organisation_name='$oname',type='$type',email='$email',mobileno='$mbno',address='$add'"
        . ",state='$state',city='$city',pincode=$pin where id=$id ";
        }
    $res=mysqli_query($link, $qry);

   
    if(mysqli_affected_rows($link)==1)
    {$msg="Details saved";header("Refresh:0");}
    else
        $msg="Details not saved \n".mysqli_error($link);
    
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
      <li class='nav-item active' ><a class='nav-link' href="changepwd.php">Change Password</a></li>
        <a class="nav-link active " href="../request.php">Search <span class="sr-only"></span></a>
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
        <h3>Personal Details</h3>
        <br>
       
  
 <?php
     if((!$r2 ||$a=='e') && $r[4]=='individual'){
         
         if ($r2[3]=='Male')
         {$x='checked'; $y='';}       
        else if ($r2[3]=='Female')
        { $y='checked';$x='';}
        else
        {$x='';$y='';}
        
   echo" <form action='home.php' method='post' autocomplete='on'>
       <table class='table table-striped'>
        <tr>
            <td><label for=fname>First Name</label></td>
            <td><input type=text required=required id=fname name=fname value='$r2[1]' placeholder=first name></td>
        </tr>
        <tr>
            <td><label for=lname>Last Name</label></td>
            <td><input type=text required=required id=lname name=lname value='$r2[2]'placeholder=last name></td>
        </tr>
 
            
        <tr>
     
         <td><label for=sex>Sex</label></td>
         <td><input type=radio  name=sex value=male $x size=10>Male &nbsp;&nbsp;&nbsp;&nbsp;
             <input type=radio name=sex value=Female $y size=10>Female
         </td>
    
        </tr>
        <tr>
            <td><label for=inputState>Blood type</label></td>
            <td><select id=inputbloodtype required=required name=bloodtype >
                    <option >select...</option>
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
            <td><label for=inputState>Please confirm your status</label></td>
            <td><select id=inputStatus required=required name=status >
                    <option>Available</option> 
                    <option>UnAvailable</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for=mbno>Mobile No.</label></td>
            <td> <input type=text required=required id=mobile value='$r2[6]' name=mobile placeholder=9876543210></td>
        </tr>
        <tr>
            <td><label for=dob>Date of Birth</label></td>
            <td><input type=date  id=dob name=dob value='$r2[7]'></td>
        </tr>
        <tr>
            <td><label for=inputAddress>Address</label></td>
            <td><input type=text required=required id=inputAddress value='$r2[8]' name=add placeholder=1234 Main St></td>
        </tr>
        <tr>
            <td><label for=inputState>State</label></td>
            <td><select id=inputState required=required name=state >";
                    
                        $qrydep="select * from states";
                        
                        $resdep=  mysqli_query($link, $qrydep);
                        while($rowdep=mysqli_fetch_row($resdep))
                        {
                            if($r2[10]==$rowdep[1])
                            { echo "<option selected> $rowdep[1] </option>";
                            $state_id=$rowdep[0];
                            }
                            else
                                echo "<option > $rowdep[1] </option>";
                        }
                        echo "</select><br>
            </td>
        </tr>
        <tr>
            <td><label for=inputCity>City</label></td>
            <td><input type=text required=required id=inputCity value='$r2[9]' name=city></td>
        </tr>
        <tr>
            <td><label for=pin>Pin Code</label></td>
            <td><input type=text  required=required id=pin value='$r2[11]' name=pin></td>
        </tr>
        <tr> 
        <td></td>
        <td><button type=submit class='btn btn-primary' name=save>Save</button>
        <a href=home.php class='btn btn-primary'>Cancel</a>
        </td> 
        
        </tr>
    </table>
  
   
</form>";
     }
     else if($r2 && $r[4]=='individual'){
         
     
   echo" 
       <table class='table table-striped'>
        <tr>
            <td><label for=fname>First Name</label></td>
            <td>$r2[1]</td>
        </tr>
        <tr>
            <td><label for=lname>Last Name</label></td>
            <td>$r2[2]</td>
        </tr>
 
            
        <tr>
     
         <td><label for=sex>Sex</label></td>
         <td>$r2[3]
         </td>
    
        </tr>
        <tr>
            <td><label for=mbno>Blood Type</label></td>
            <td> $r2[4]</td>
        </tr>
        <tr>
            <td><label for=mbno>Status</label></td>
            <td> $r2[5]</td>
        </tr>
        <tr>
            <td><label for=mbno>Mobile No.</label></td>
            <td> $r2[6]</td>
        </tr>
        <tr>
            <td><label for=dob>Date of Birth</label></td>
            <td>$r2[7]</td>
        </tr>
        <tr>
            <td><label for=inputAddress>Address</label></td>
            <td>$r2[8]</td>
        </tr>
            
  
        <tr>
            <td><label for=inputCity>City</label></td>
            <td>$r2[9]</td>
        </tr>
        <tr>
            <td><label for=inputState>State</label></td>
            <td>$r2[10]
            </td>
        </tr>
        <tr>
            <td><label for=pin>Pin Code</label></td>
            <td>$r2[11]</td>
        </tr>
        <tr> 
        <td></td>
        <td><a href=home.php?bid=e class='btn btn-primary'>Edit</a></td>        
        </tr>
   </table>";
     }
      
     else if((!$r2 ||$a=='e') && $r[4]=='organisation'){
         
         if ($r2[2]=='Hospital')
         {$x='checked'; $y='';}       
        else if ($r2[2]=='NGO')
        { $y='checked';$x='';}
        else
        {$x='';$y='';}
        
   echo" <form action='home.php' method='post' autocomplete='on'>
       <table class='table table-striped'>
        <tr>
            <td><label for=oname>Organisation Name</label></td>
            <td><input type=text required=required id=oname name=oname value='$r2[1]' placeholder=first name></td>
        </tr>
        <tr>
            <td><label for=organisation>Organisation Type</label></td>
            <td><input type=radio  name=organisation value=Hospital $x size=10>Hospital &nbsp;&nbsp;&nbsp;&nbsp;
             <input type=radio name=organisation value=NGO $y size=10>NGO
         </td>
        </tr>
        <tr>
            <td><label for=email>Alternate Email</label></td>
            <td><input type=email required=required id=email name=email value='$r2[3]'></td>
        </tr>
            
        
        <tr>
            <td><label for=mobile>Mobile No.</label></td>
            <td> <input type=text required=required id=mobile value='$r2[4]' name=mobile placeholder=9876543210></td>
        </tr>
        
        <tr>
            <td><label for=inputAddress>Address</label></td>
            <td><input type=text required=required id=inputAddress value='$r2[5]' name=add placeholder=1234 Main St></td>
        </tr>
            
        <tr>
            <td><label for=inputstate>State</label></td>
            <td><select id=inputState required=required name=state >";
                    
                        $qrydep="select * from states";
                        
                        $resdep=  mysqli_query($link, $qrydep);
                        while($rowdep=mysqli_fetch_row($resdep))
                        {
                            if($r2[6]==$rowdep[1])
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
            <td><input type=text required=required id=inputCity value='$r2[7]' name=city></td>
        </tr>
        
        <tr>
            <td><label for=pin>Pin Code</label></td>
            <td><input type=text  required=required id=pin value='$r2[8]' name=pin></td>
        </tr>
        <tr> 
        <td></td>
        <td><button type=submit class='btn btn-primary' name=save_o>Save</button>
        <a href=home.php class='btn btn-primary'>Cancel</a>
        </td> 
        
        </tr>
    </table>
  
   
</form>";
     }
      else if($r2 && $r[4]=='organisation'){
         
        /* if ($r2[3]=='Male')
         {$x='checked'; $y='';}       
        else if ($r2[3]=='Female')
        { $y='checked';$x='';}*/
        
   echo" <form action='home.php' method='post' autocomplete='on'>
       <table class='table table-striped'>
        <tr>
            <td><label for=oname>Organisation Name</label></td>
            <td>$r2[1]</td>
        </tr>
        <tr>
            <td><label for=organsation>Organisation Type</label></td>
            <td>$r2[2]</td>
        </tr>
        <tr>
            <td><label for=email>Alternate Email</label></td>
            <td>$r2[3]</td>
        </tr>
            
        
        <tr>
            <td><label for=mbno>Mobile No.</label></td>
            <td> $r2[4]</td>
        </tr>
        
        <tr>
            <td><label for=inputAddress>Address</label></td>
            <td>$r2[5]</td>
        </tr>
            
        <tr>
            <td><label for=inputstate>State</label></td>
            <td>$r2[6]</td>
        </tr>
        
        <tr>
            <td><label for=inputCity>City</label></td>
            <td>$r2[7]</td>
        </tr>
        
        <tr>
            <td><label for=pin>Pin Code</label></td>
            <td>$r2[8]</td>
        </tr>
        <tr> 
        <td></td>
        <td><a href=home.php?bid=e class='btn btn-primary'>Edit</td> 
        
        </tr>
    </table>
  
   
</form>";
     }
     if(isset($msg))
            echo $msg;
        ?>
        
        
    </body>
</html>
