<html>
<head>
<style>
body {
    overflow-x:hidden;
}
</style>
<h1>HOSTEL ROOM MANAGEMENT SYSTEM</h1>
    <p><a href="dashboard.html" style="text-decoration: none"><i class="fas fa-sign-out-alt"></i>Go Back To Dashboard</a></p>

<title>Student Report</title>
<link href="studreport.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
</head>
<body>
    <table>
        <tr>
            <th>Roll Number</th>
            <th>Name</th>
            <th>DOB</th>
            <th>Dept</th>
            <th>Year</th>
            <th>CPI</th>
            <th>Email</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Status</th>
        </tr>
   
    
    <?php
    $conn=mysqli_connect("localhost","root","","hostelmanagement");
    if($conn-> connect_error) {
        die("Connection failed:".$conn-> connect_error);
    }
    $sql="SELECT * FROM student";
    $result = $conn-> query($sql);
    if($result-> num_rows > 0) {
                 while($row =$result -> fetch_assoc()){
             echo "<tr><td>".$row["RollNo"]."</td><td>". $row["Name"]."</td><td>".$row["DOB"]."</td><td>".$row["Department"]."</td><td>".$row["CourseYear"]."</td><td>".$row["CPI"]."</td><td>".$row["Email"]."</td><td>".$row["Address"]."</td><td>".$row["PhoneNo"]."</td><td>".$row["Status"]."</td></tr>";
         }
         echo "</table>";
    }
    else {
        echo "0 results";
    }
    $conn-> close();
?>
</table>
</body>
</html>