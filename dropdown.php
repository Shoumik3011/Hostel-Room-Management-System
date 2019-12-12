<?php

$connect =mysqli_connect("localhost","root","","hostelmanagement");
$query="SELECT * FROM room where RoomStatus='vacant' ";
$result1=mysqli_query($connect,$query);
$options="";
while($row1=mysqli_fetch_array($result1))
{
    $options=$options."<option>$row1[0]</option>";
}
?>