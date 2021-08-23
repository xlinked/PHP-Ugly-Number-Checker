<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
    <link href='https://fonts.googleapis.com/css?family=Share+Tech|Orbitron:500' rel='stylesheet' type='text/css'>  
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="container">
        <header>
            <h1>The Ugly Number Checker</h1>
        </header>

        <div class="content">
            <!-- notification message -->
            <?php if (isset($_SESSION['success'])) : ?>
            <div class="error success" >
                <h3>
                <?php 
                    echo $_SESSION['success']; 
                    unset($_SESSION['success']);
                ?>
                </h3>
            </div>
            <?php endif ?>

            <!-- logged in user information -->
            <?php  if (isset($_SESSION['username'])) : ?>
                <p>Hello,<br><strong style="text-transform: uppercase;"><?php echo $_SESSION['username']; ?></strong></p>
                <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
            <?php endif ?>
        </div>

        <form action="index.php" method='get'>
                <h2>Enter a number:</h2>
                <input type="number" id="number" name="number">

                <h2>Press to Check</h2>
                <span>↘︎</span>

                <div class="startContainer">
                <button type="submit" class="button pulseBox">Check</button>
                </div>

                <h2 id="result"> 
                <?php
                    $num = '';

                    if(isset($_GET['number'])) {
                        $num = $_GET['number'];
                        echo is_ugly($num);
                    }
                ?>
                </h2>
        </form>

        <?php
            function is_ugly($num) {
                $res = $num;
                if ($num == 0)
                {
                    return "$num is not an ugly number";
                }
            
                $x = array(2, 3, 5);
                foreach ($x as $i)
                {
                    while ($num % $i == 0)
                    {
                        $num /= $i;
                    }
                }         
                if ($num == 1)
                {
                    return "$res is an ugly number";
                }
                else
                {
                    return "$res is not an ugly number";
                }
            }    
        ?> 
        <footer>
        <p> Created by: Tyler Nelson
            <br>
            <br>
            &copy;Copyright 2021. All Rights Reserved.
        </p>
        </footer>
    </div>
</body>
</html>