<html>

    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Scoresheet</title>
        <style type="text/css">
            body {
                background-image: url("body.png");
                margin: 0px;
            }
            
            .topnav {
                background-color: #312F2F;
                overflow: hidden;
            }
            
            .logo 
            {
                width: 15%;
            }
            span 
            {
                float: right;
                margin-top: 20px;
                margin-right: 40px;
                font-size: 18pt;
            }
            table
            {
                width: 50%;
                height: 50%; 
                margin-left: auto;
                margin-right: auto;
                margin-top: 100px;
                border: 1px solid white;
            }
            tr,td,th
            {
                text-align: center;
                border: 1px solid white;
                color: white;
                font-size: 20pt;
            }
            th
            {
                font-size: 24pt;
            }
            .footer div
            {
                display: flex;
                justify-content: center;
            }
            
        </style>
    </head>
<body>  
    <?php  
	session_start();
    $score = $_GET['score'];
	
    //  header
    echo "<div class='topnav'>
        <a href='Homepage.html'><img class='logo' src='logo.png'></a><span> <font color=white>Your Score : $score</font> </span>
    </div>
    ";

        // Create connection
        $conn = mysqli_connect("localhost", "root", "","game_o_lounge");
       
        // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
    else
    {
      echo "<script>console.log('Connected Successfully')</script>";
    }
	
    //retrieving score from database
    $value = mysqli_query($conn,"SELECT Score FROM score WHERE Username = '$_SESSION[user]' AND Game='$_GET[game]'");  #have to use the logged user's name
    while($row = mysqli_fetch_assoc($value)){

    //checking if its a highscore and updating the database
    if ($score>$row["Score"] && $_GET['game'] != 'Memory Game')
    {
        $sql = "UPDATE score SET Score=$score WHERE Username='$_SESSION[user]' AND Game='$_GET[game]'";    #have to use the logged user's name
        if (mysqli_query($conn, $sql)) {
            echo "<script>console.log('record updated successfully')</script>";
            } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        
    }
	else if ($score<$row["Score"] && $_GET['game'] == 'Memory Game' && $score != NULL)
    {
        $sql = "UPDATE score SET Score=$score WHERE Username='$_SESSION[user]' AND Game='$_GET[game]'";    #have to use the logged user's name
        if (mysqli_query($conn, $sql)) {
            echo "<script>console.log('record updated successfully')</script>";
            } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        
    }
	}

    // Scoresheet table retrieved from database
	if ($_GET['game'] != 'Memory Game'){
    $result = mysqli_query($conn, "SELECT * FROM score Where Game='$_GET[game]' ORDER BY Score DESC LIMIT 5");}	# WHERE condition has to be added to retrieve the max 5 
	else if ($_GET['game'] == 'Memory Game'){
	$result = mysqli_query($conn, "SELECT * FROM score Where Game='$_GET[game]' ORDER BY Score ASC LIMIT 5");}	# WHERE condition has to be added to retrieve the max 5 
    
	echo "<table >
            <tr>
            <th>User</th>
            <th>High Scores</th>
            </tr>";
while($row = mysqli_fetch_assoc($result))
{
    echo   "<tr>
            <td>$row[Username]</td>
            <td>$row[Score]</td>
            </tr>";
}
    echo "</table>";
  
    mysqli_close($conn);
    ?>

<br/><br/>
<!-- Reset and exit buttons -->
<?php if($_GET['game']=='2D Breakout Game'){echo "
<div class='footer'><a href='2D Breakout game.html'><img src='restartgame.png' style='width:3%; margin: auto; display: block;'></a></div>
<br/>";}
else if($_GET['game']=='Memory Game'){echo "
<div class='footer'><a href='memoryGame.html'><img src='restartgame.png' style='width:3%; margin: auto; display: block;'></a></div>
<br/>";}
else if($_GET['game']=='Space Invaders'){echo "
<div class='footer'><a href='Space Invaders.html'><img src='restartgame.png' style='width:3%; margin: auto; display: block;'></a></div>
<br/>";}
?>
<div class="footer"><a href="Homepage.html"><img src="exit.png" style="width:5%; margin: auto; display: block;"></a></div>

</body> 
</html>