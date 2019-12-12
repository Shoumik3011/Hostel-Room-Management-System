<?php
$rollnumber=$_POST['rollnumber'];
$name=$_POST['name'];
$dob=$_POST['dob'];
$dept=$_POST['dept'];
$year=$_POST['year'];
$emailid=$_POST['emailid'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$cpi=$_POST['cpi'];

if(!empty($rollnumber) || !empty($name) || !empty($dob) || !empty($dept) || !empty($year) || !empty($emailid) || !empty($address) || !empty($phone)) {
    

    //create connection
    $conn=mysqli_connect("localhost","root","","hostelmanagement");
    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    } else {
        //ensure every user have unique roll number
        $SELECT="SELECT RollNo FROM student WHERE RollNo = ? Limit 1";
        $INSERT="INSERT  INTO student(RollNo,Name,DOB,Department,CourseYear,CPI,Email,Address,PhoneNo) VALUES (?,?,?,?,?,?,?,?,?)";
        $dob=date('Y/m/d', strtotime($dob));
        //prepare stmt
        $stmt=$conn->prepare($SELECT);
        $stmt->bind_param("s",$rollnumber);
        $stmt->execute();
        $stmt->bind_result($rollnumber);
        $stmt->store_result();
        $rnum =$stmt->num_rows;

        if($rnum==0)
        {
            if($cpi>=7) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssssssss",$rollnumber,$name,$dob,$dept,$year,$cpi,$emailid,$address,$phone);
            $stmt->execute();
            readfile("registered.html");
            }
            else {
                echo("<script language='JavaScript'> alert('Cannot Register Student with CPI less than 7 !!') </script>");
                header('refresh:0.2;url=newstudent.html');
            }
        } else {
            echo("<script language='JavaScript'> alert('Someone already registered using this Roll Number!!') </script>");
            header('refresh:0.2;url=newstudent.html');
        }
        $stmt->close();
        $conn->close();

    }
} else {
    echo "All fields are Required !!!";
    die();
}

?>