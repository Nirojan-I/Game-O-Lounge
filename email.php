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
$result=mysqli_query($conn,"SELECT * FROM sign_up WHERE Email = '$_POST[email]'");
while($row = mysqli_fetch_assoc($result))
{
	$Token = $row["Token"];
	$to = $row["Email"];
	$subject = "Password Recovery";
	$message = "Hi ".$row["Username"].", your Token is: ".$Token;
	$message .= "
	<html>
	<body>
	<br>
	Use the above token to reset your password.
	<br>
	<a href='http://localhost/PHP/forgot_password.php'>Click here to reset your password.
	</a>
	</body>
	</html>";
	$from = "nirojani.1217@gmail.com";
	$headers = "From: Game-O-Lounge";
	$headers .= "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	if(mail($to,$subject,$message,$headers)){
		echo "mail sent.";}
	else {echo "No";}
}
?>
</body>
</html>
