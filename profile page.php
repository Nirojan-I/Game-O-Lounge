<html>
<body>
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
if(isset($_POST['submit'])){
$sql="UPDATE sign_up SET Profile_Pic = '$_POST[uploadPic]' WHERE Username='$_SESSION[user]'";
if(!mysqli_query($conn,$sql)){
	die("Error: ".mysqli_error($conn));
}
}
$result=mysqli_query($conn,"SELECT * FROM sign_up");
while($row = mysqli_fetch_assoc($result)){
if($row["Username"] == $_SESSION["user"] && $row["Profile_Pic"] != NULL){
$uploadPic=$row['Profile_Pic'];
}
else if($row["Username"] == $_SESSION["user"] && $row["Profile_Pic"] == NULL){
$uploadPic="ppp.png";	
}
}
if(isset($_POST['newSubmit'])){
mysqli_query($conn,"UPDATE sign_up SET Username='$_POST[username]' , Password='$_POST[password]', C_Password='$_POST[password]', Email='$_POST[email]' WHERE Username='$_SESSION[user]'");
header("Location: login page.html");
}
mysqli_close($conn);


?>
<head>
<title>Settings Page</title>
<link rel="shortcut icon" href="icon.ico">
<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body style="margin:0">

<div style="width:100%;height:10%;background:#333333">
<img src="logo.png" alt="logo" style="max-height:80%;max-width:100%;margin-left:15px;margin-top:7px">
<img src="setting.png" style="max-height:80%;max-width:100%;margin-left:1070px;margin-top:7px">
</div>
<div style="height:88%;width:100%;background:url('body.png') no-repeat">
<div style="display:inline-block;width:400px;height:400px;position:relative;top:100px;left:470px;">

<form  name="myForm" align="center" action="profile page.php" method="post"  >

<img src="<?php echo $uploadPic;?>" align="center"  width="120" height="120" alt="Profile Picture" style="color:white">
<input class="lbl" name="profileName" value="<?php echo $_SESSION['user'];?>">
<br><br><input type="file" class="buttonA file" style="width:80px;padding:4px 8px" name="uploadPic" value="">
<br><br>

<input type="button" class="buttonA" name="change_account" align="center" value="Change account details" onclick="document.getElementById('id01').style.display='block'">

<!--<input type="button" class="buttonA" name="change_password" align="center" value="change password">
<br><br>-->

<br><br>
<input type="submit" class="buttonA" name="submit" align="center" value="Save Changes"><br>
</form>
<form action="logout.php" align="center" method="post">
<input type="submit" class="buttonA" name="Log_out" align="center" value="Log out">
</div>
</form>

</div>
<div id="id01" class="modal">
<form class="modal-content animate" action="" method="post">
<div class="imgcontainer">
<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close">&times;</span>
</div>
<div class="container">    
<div class="container">
<h2>Change Account Details</h2>             
<div >
<form action="profile page.php" id="forgot_password" role="form" autocomplete="off" class="form" method="post">
<input type="text" name="username" placeholder="Email or username" class="user" required>
<br><br>
<input name="password" id="id_password" type="password" placeholder="Password" class="password" style="margin-left:-40px" required>
<br><br>
<input id="email" name="email" placeholder="Email address" type="email" style="margin-left:0px;color:white;width:300px;background:transparent;border:none;line-height:2em;border-bottom:2px solid maroon" required>
<br><br>
<div class="form-group">
<input name="newSubmit" class="btn silver round hover-silver" value="Reset" type="submit" >
</div>
</form>
</div>
</div>
</div>
</form>
</div>
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