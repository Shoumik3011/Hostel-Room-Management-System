<html>
<head>
    <style>
body {
    overflow-x:hidden;
    overflow-y:hidden;
}
</style>
<h1>HOSTEL ROOM MANAGEMENT SYSTEM</h1>
<h4><a href="dashboard.html" style="text-decoration: none"><i class="fas fa-sign-out-alt"></i>Go Back To Dashboard</a></h4>

<title>Allot a Room</title>
<link href="allotroom.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
</head>
<body>
    <div class="demo">
    <form action=" " method="POST" align="center">
            <input type="text" name="id" placeholder="Enter 16-digit roll number of the Student" size="35">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <input type="submit"  name="search" value="Search Data">

</div>
<?php
session_start();
$connection=mysqli_connect("localhost","root","");

$db=mysqli_select_db($connection,'hostelmanagement');
if(isset($_POST['search']))
{
   
    $id=$_POST['id'];
    $_SESSION['roll']=$id;
    $query="SELECT Name,Department,CourseYear,Email,PhoneNo FROM student where RollNo='$id' ";
    $query_run=mysqli_query($connection,$query);
    //using while loop for searching
   
    while($row=mysqli_fetch_array($query_run))
    {
        ?>
         <div class="container">
            <!-- <form action="" method="POST"> <br> -->
           
      
           <p>Name :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="nm" value="<?php echo $row['Name'] ?>"></p>
        
            <p>Department :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="dept" value="<?php echo $row['Department'] ?>"></p>
        
            <p>Year :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="yr" value="<?php echo $row['CourseYear'] ?>"></p>
        
            <p>Email :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="email" value="<?php echo $row['Email'] ?>"></p>
        
            <p>Contact :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="contactno" value="<?php echo $row['PhoneNo'] ?>"></p>

            <div class="l1" >Available Rooms:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php include 'dropdown.php';?>
                <select id="l2" name="alot">
                    <?php echo $options; ?>
                </select>
    </div> <br>
            <input type="submit" value="Allot Room" name="allot">

           
            
    </div>
    <?php
    }

}

?>

<?php 
          
          if(isset($_POST['allot']))
              {
            
                  $alloted=$_POST['alot'];
                  $session_value=$_SESSION['roll'];
                  
                  $query2="SELECT RollNo,Name,Department,CourseYear,Email,PhoneNo FROM student where RollNo='".$session_value."'";
                  $output2=mysqli_query($connection,$query2);
                
                  while($row_data=mysqli_fetch_array($output2))
                  {
                      $c_year=$row_data['CourseYear'];
                      $names=$row_data['Name'];
                      $dep=$row_data['Department'];
                      $email_id=$row_data['Email'];
                      $phone=$row_data['PhoneNo'];
                      
                      $qry="select * from room where Roll='".$session_value."'";
                      $res=mysqli_query($connection,$qry);
                      if(mysqli_num_rows($res)>0){
                        echo("<script language='JavaScript'> alert('WARNING!! Student with this Roll Number has already been alloted a room!!')</script>");
                      }
                      else {

                       $query3="UPDATE room SET Roll='".$session_value."',StudentName='".$names."',Dept='".$dep."',StdYear='".$c_year."',EmailID='".$email_id."',Contact='".$phone."',RoomStatus='occupied' WHERE RoomNo='$alloted'";
                      $output3=mysqli_query($connection,$query3);
                      if($output3)
                      {
                          $query4="UPDATE student SET Status='alloted' WHERE RollNo='".$session_value."'";
                          $output4=mysqli_query($connection,$query4);
                          
                           echo("<script language='JavaScript'> alert('Room Alloted Successfully!!')</script>");
                           header('refresh:0.2;url=allotroom.php');
                      }
                    }
                      
                  }
                  
              
              
              }
          ?>
          </form>
</body>
</html>