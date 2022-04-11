<?php 
session_start();
$servername="localhost";
$username="root";
$password="";
$dbname="game_o_lounge";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
die("Connection Failed: ".mysqli_connect_error());
}
$result=mysqli_query($conn,"SELECT Username,Password FROM sign_up");
while($row = mysqli_fetch_assoc($result)){
if($row["Username"] == $_POST["username"] && $row["Password"] == $_POST["password"]){
	$_SESSION["user"]=$row['Username'];
	header("Location: Homepage.html");
	return true;
}
else{
	echo "<script> alert('Invalid username and password'); window.location.href='login page.html';</script>";
	
}
}

mysqli_close($conn);
?>