<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
session_start();
echo "<!DOCTYPE html>\n<html><head><script src='OSC.js'></script>";
include 'functions.php';

$userstr = ' (Guest)';

if (isset($_SESSION['user']))
{
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
}
else $loggedin = FALSE;
$image = "Oamk.jpg"; 
$width = 50;
$height = 50;
$img = '<img src="'.$image.'" style="position=absolute;
    width:' . $width . 'px;height:' . $height . 'px;float:left;" />';

echo "<title>$appname$userstr</title><link rel='stylesheet' ".
     "href='styles.css' type='text/css' />" .
     "<div class='appname'>$img<span style='position:relative; font-size:15pt;'>$appname</span>";

if ($loggedin)
{
    echo "<ul class='menu' style='position=relative;float:right;'>" .
         "<li><a href='members.php?view=$user'>Home</a></li>" .
         "<li><a href='members.php'>Members</a></li>" .
         "<li><a href='friends.php'>Friends</a></li>" .
         "<li><a href='messages.php'>Messages</a></li>" .
         "<li><a href='profile.php'>Edit Profile</a></li>" .
         "<li><a href='logout.php'>Log out</a></li></ul><br />";
    echo "</div>";
}
else
{
    echo "<ul class='menu' style='position:relative;float:right;'>" .
         "<li><a href='index.php'>Home</a></li>" .
         "<li><a href='signup.php'>Sign up</a></li>" .
         "<li><a href='login.php'>Log in</a></li></ul><br />" ;
    echo "</div><br/><br/>";

}

?>
    </body>
</html>
