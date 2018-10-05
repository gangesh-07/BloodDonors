




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
        
                 if(isset($_GET["v"]))
                     $a=$_GET["v"];
                else
                    $a='n';
                if(isset($_GET["rid"]))
                     $rid=(int)$_GET["rid"];
                else
                    $rid=0;
            
    }
    if(isset($_POST["post"]))
    {
       include_once '../conn.php';
        $id=$_SESSION["cod"]; 
    
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $blood=$_POST["bloodtype"];
    $units=$_POST["units"];
    $age=$_POST["age"];    
    $mbno=$_POST["mobile"];
    $hospital=$_POST["hospital"];
    $date=$_POST["dob"];    
    $add=$_POST["add"];
    $city=$_POST["city"];

    
    $qry="INSERT INTO `bloodrequest`(`user_id`,`fname`,`lname`,`bloodtype`,`units`,`age`,`mobileno`,`hospital`,`date_of_request`,`address`,`city`)"
            . " VALUES ($id,'$fname','$lname','$blood',$units,$age,'$mbno','$hospital','$date','$add','$city') ";
    $res=mysqli_query($link, $qry);

   
    if(mysqli_affected_rows($link)==1)
        $msg="Request Posted";
    else
        $msg="Request not Posted ".mysqli_error($link);
    }
     if(isset($_POST["update"]))
    {
       include_once '../conn.php';
        $id=$_SESSION["cod"]; 
    
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $blood=$_POST["bloodtype"];
    $units=$_POST["units"];
    $age=$_POST["age"];    
    $mbno=$_POST["mobile"];
    $hospital=$_POST["hospital"];
    $date=$_POST["dob"];    
    $add=$_POST["add"];
    $city=$_POST["city"];
    $rid=$_POST["rid"];

    //$qry="UPDATE `singleuser` set firstname='$fname',lastname='$lname',sex='$sex',bloodtype='$blood',checkstatus='$check',"
      //  . "mobileno='$mbno',dob='$dob',address='$add',city='$city',state='$state',pincode=$pin where id=$id ";
    $qry="UPDATE `bloodrequest` set fname='$fname',lname='$lname',bloodtype='$blood',units=$units,age=$age,mobileno='$mbno',"
            . "hospital='$hospital',date_of_request='$date',address='$add',city='$city' WHERE user_id=$id and request_id=$rid"; 
            
    $res=mysqli_query($link, $qry);

   
    if(mysqli_affected_rows($link)==1)
        $msg="Request updated";
    else
        $msg="Request not updated ".mysqli_error($link);
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
      <li>
      <a class="nav-link active" href="../request.php">Search <span class="sr-only"></span></a>
      </li>
      <li class='nav-item active' ><a class='nav-link' href="displayrequest.php">Blood Requests</a></li>
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Personal Info <span class="sr-only"></span></a>
      </li>
     <li class='nav-item active' ><a class='nav-link' href="projects.php">Project list</a></li>
    <li class='nav-item active' ><a class='nav-link' href="../index.php?e=f">Logout</a></li>

    </ul>
    <span class="navbar-text">
        <?php
    echo "Welcome $r[1]";

?>
    </span>
  </div>
</nav>
 </div>
        <br>
        <h3>Patient Details</h3>
        <br>
        
        <?php
        if($a=='c'){
                $qq="select * from bloodrequest where request_id=$rid";
                $rr=mysqli_query($link, $qq);
                $r=mysqli_fetch_row($rr);
                if($r[12]=='pending')
                    $query="UPDATE `bloodrequest` set status='done' WHERE request_id=$rid";
                else
                     $query="UPDATE `bloodrequest` set status='pending' WHERE request_id=$rid";
            $rez=mysqli_query($link, $query);
            
            if(mysqli_affected_rows($link)==1)
        header("location:home.php");
             else
        $msg="Request not updated ".mysqli_error($link);
            
            
        }
        else if($a=='n')
        {
            ?>
        
        <a href="bloodrequest.php?v=h" class='btn btn-primary'>View Request history</a>
        <a href=home.php class='btn btn-primary'>Back</a>
        
        <form action='bloodrequest.php' method='post' autocomplete='on'>
       <table class="table ">
        <tr>
            <td><label for="fname">First Name</label></td>
            <td><input type="text" required="required" id="fname" name="fname" placeholder="first name"></td>
        </tr>
        <tr>
            <td><label for="lname">Last Name</label></td>
            <td><input type="text" required="required" id="lname" name="lname" placeholder="last name"></td>
        </tr>
        
           <tr>
            <td><label for=inputState>Blood type Required</label></td>
            <td><select id=inputState required=required name=bloodtype >
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
            <td><label for="units">Blood Units Required</label></td>
            <td><input type="text" required="required" id="units" name="units" placeholder="1,2,3"></td>
        </tr>
        <tr>
            <td><label for="age">Age</label></td>
            <td><input type="text"  id=dob name="age" ></td>
        </tr>    
        <tr>
            <td><label for="mbno">Mobile No.</label></td>
            <td> <input type="text" required="required" id="mobile" name="mobile" placeholder=9876543210></td>
            
        </tr>
        <tr>
            <td><label for=hospital>Hospital Name</label></td>
            <td><input type=text required=required id="hospital"  name=hospital></td>
        </tr>
        <tr>
         <tr>
            <td><label for=dob>When it is required</label></td>
            <td><input type=date  id=dob name=dob></td>
        </tr>
        
        <tr>
            <td><label for="inputAddress">Address</label></td>
            <td><input type="text" required="required" id="inputAddress"  name="add" placeholder="1234 Main St"></td>
        </tr>
            
  
        <tr>
            <td><label for=inputCity>City</label></td>
            <td><input type=text required=required id=inputCity  name=city></td>
        </tr>
        
        <td></td>
        <td><button type=submit class='btn btn-primary' name=post>Post</button>
        <a href=bloodrequest.php class='btn btn-primary'>Cancel</a>
        </td> 
        
        </tr>
    </table>
  
   
</form>
        <?php
        }
        else if($a=='h')
        {
            echo "<a href=bloodrequest.php class='btn btn-primary'>Back</a>";
            echo "<br><br>";
            $q="DESCRIBE bloodrequest";
            $des=mysqli_query($link, $q);
            mysqli_data_seek($des,2);
            $qry="select * from bloodrequest where user_id=$id";
            $req=mysqli_query($link, $qry);
            
            echo "<table class='table  table-striped table-bordered'>
  <thead>
    <tr>";$count=0;
       while($d=mysqli_fetch_row($des))
        {
            $count++;
             echo "<th scope='col'>$d[0]</th>";
        }
        echo "<th scope='col' >Details</th>";
              
   echo "</tr>
  </thead>
  <tbody>";
            while($d=mysqli_fetch_row($req))
            {
                $i=2;
          echo "<tr>";
          while($i<$count+2)
            {
                echo "<td scope='col'>$d[$i]</td>";
                $i++;
            }
            echo "<td><a href=bloodrequest.php?v=c&rid=$d[0] class='btn btn-primary'>Status change</a>"
            . "   <a href=bloodrequest.php?v=e&rid=$d[0] class='btn btn-primary'>edit</a></td>";
          echo "</tr>";
            }
        }
        else
        {
                    
             $qq="select * from bloodrequest where user_id=$id and request_id=$rid";
             $rr=mysqli_query($link, $qq);
             $dd=mysqli_fetch_row($rr);
            
        echo"<form action='bloodrequest.php' method='post' autocomplete='on'>
       <table class=table >
        <tr>
            <td><label for=fname>First Name</label></td>
            <td><input type=text required=required id=fname name=fname value='$dd[2]' placeholder=first name></td>
        </tr>
        <tr>
            <td><label for=lname>Last Name</label></td>
            <td><input type=text required=required id=lname name=lname value='$dd[3]' placeholder=last name></td>
        </tr>
        
           <tr>
            <td><label for=inputState>Blood type Required</label></td>
            <td><select id=inputState required=required name=bloodtype >
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
            <td><label for=units>Blood Units Required</label></td>
            <td><input type=text required=required id=units name=units value='$dd[5]' placeholder=1,2,3></td>
        </tr>
        <tr>
            <td><label for=age>Age</label></td>
            <td><input type=text  id=dob name=age value='$dd[6]' ></td>
        </tr>    
        <tr>
            <td><label for=mbno>Mobile No.</label></td>
            <td> <input type=text required=required id=mobile name=mobile value='$dd[7]' placeholder=9876543210></td>
            
        </tr>
        <tr>
            <td><label for=hospital>Hospital Name</label></td>
            <td><input type=text required=required id=hospital  value='$dd[8]' name=hospital></td>
        </tr>
        <tr>
         <tr>
            <td><label for=dob>When it is required</label></td>
            <td><input type=date  id=dob name=dob value='$dd[9]'></td>
        </tr>
        
        <tr>
            <td><label for=inputAddress>Address</label></td>
            <td><input type=text required=required id=inputAddress  value='$dd[10]' name=add placeholder=1234 Main St></td>
        </tr>
            
  
        <tr>
            <td><label for=inputCity>City</label></td>
            <td><input type=text required=required id=inputCity  value='$dd[11]' name=city></td>
        </tr>
        
        <td><input type=hidden  id=rid  value='$dd[0]' name=rid></td></td>
        <td><button type=submit class='btn btn-primary' name=update>update</button>
        <a href=bloodrequest.php class='btn btn-primary'>Cancel</a>
        </td> 
        
        </tr>
    </table>
  
   
</form>"; 
            
        }     
       
            if(isset($msg))
                echo $msg;
        ?>
        
        
    </body>
</html>
