<html>
<head>
<style>
body {
    overflow-x:hidden;
}
</style>
<h1>HOSTEL ROOM MANAGEMENT SYSTEM</h1>
    <p><a href="dashboard.html" style="text-decoration: none"><i class="fas fa-sign-out-alt"></i>Go Back To Dashboard</a></p>

<title>Room Report</title>
<link href="roomreport.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
</head>
<body>
    <table>
        <tr>
            <th>Room Number</th>
            <th>Roll Number</th>
            <th>Student Name</th>
            <th>Department</th>
            <th>Year</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Room Status</th>
        </tr>
   
    
    <?php
    $conn=mysqli_connect("localhost","root","","hostelmanagement");
    if($conn-> connect_error) {
        die("Connection failed:".$conn-> connect_error);
    }
    $sql="SELECT * FROM room";
    $result = $conn-> query($sql);
    if($result-> num_rows > 0) {
                 while($row =$result -> fetch_assoc()){
             echo "<tr><td>".$row["RoomNo"]."</td><td>". $row["Roll"]."</td><td>".$row["StudentName"]."</td><td>".$row["Dept"]."</td><td>".$row["StdYear"]."</td><td>".$row["EmailID"]."</td><td>".$row["Contact"]."</td><td>".$row["RoomStatus"]."</td></tr>";
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