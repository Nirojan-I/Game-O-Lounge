<html>
<head>
<link rel="shortcut icon" href="icon.ico">
<link rel="stylesheet" type="text/css" href="login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="signup.js"></script>
</head>
<body>
<div class="header">
<img src="logo.png" alt="logo" class="logo">
</div>
<div class="bodyImg">
<div class="body">
<form  name="resetPass" align="center" action="forgot_password.php" method="post" >
<input type="text" name="token" placeholder="Token" class="user" required>
<br><br>
<input name="newPassword" id="id_password" type="password" placeholder="Enter new password" class="password" required>
<i style="position:relative;right:15px;" id="togglePassword" class="fa fa-eye-slash"></i>
<br><br><br>
<button type="submit" name="submit" class="button black round hover-black">Reset Password</button>
<button type="reset" name="cancel" class="button black round hover-black">Cancel</button>
</form>
</div>
</div>
<?php
function resetPassword()
{
$username="root";
$password="";
$dbname="game_o_lounge";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
die("Connection Failed: ".mysqli_connect_error());
}
$result=mysqli_query($conn,"SELECT * FROM sign_up");
while($row = mysqli_fetch_assoc($result))
{
$token=rand(100000,900000);
if($row['Token']!='token' && $row['Token']==$_POST['token']){
mysqli_query($conn,"UPDATE sign_up SET Password='$_POST[newPassword]',C_Password ='$_POST[newPassword]',Token='$token' WHERE Token= '$_POST[token]'");
header("Location: login page.html");
}
else echo "<script> alert('Invalid Token'); window.location.href='forgot_password.php';</script>";
}
}
if(isset($_POST['submit']))
{
   resetPassword();
} 
?>
<script>
    const togglePassword = document.querySelector('#togglePassword');
	const password = document.querySelector('#id_password');
	
  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
	this.classList.toggle('fa-eye');
    const type = password.getAttribute('type') == 'text' ? 'password' : 'text';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>
</body>
</html>
