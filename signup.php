<html>
<body>
<?php 
$servername="localhost";
$username="root";
$password="";
$dbname="game_o_lounge";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
die("Connection Failed: ".mysqli_connect_error());
}

mysqli_query($conn,"INSERT INTO score VALUES('$_POST[username]','Memory Game','30')");
mysqli_query($conn,"INSERT INTO score VALUES('$_POST[username]','2D Breakout Game','0')");
mysqli_query($conn,"INSERT INTO score VALUES('$_POST[username]','Space Invaders','0')");
$result=mysqli_query($conn,"SELECT * FROM sign_up");
$count=1;
while($row = mysqli_fetch_assoc($result))
{
$token=rand(100000,900000);
if($row['Token']!='token' && $count==1){
$sql="INSERT INTO sign_up VALUES('$_POST[username]','$_POST[email]','$_POST[password1]','$_POST[password2]','$token','NULL')";
$count++;
if(!mysqli_query($conn,$sql)){
	die("Error: ".mysqli_error($conn));
}
header("Location: login page.html");
}
}
mysqli_close($conn);
?>
</body>
</html>