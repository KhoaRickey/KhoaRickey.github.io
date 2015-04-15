<?php
$dbhost  = 'khoanickey.ipt.oamk.fi';
$dbname  = 'SocialNetwork';  
$dbuser  = 'khoa';   
$dbpass  = '123';   
$appname = "Social Network";

mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());

function queryMysql($query)
{
    $result = mysql_query($query) or die(mysql_error());
	 return $result;
}

function destroySession()
{
    $_SESSION=array();
    
    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
}

function sanitizeString($var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return mysql_real_escape_string($var);
}

function showProfile($user)
{
    if (file_exists("image/$user.jpg"))
        echo "<img src='image/$user.jpg' height=300 width=300 align='left'/>";

    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

    if (mysql_num_rows($result))
    {
        $row = mysql_fetch_row($result);
        echo "<span style='color:#80B054;'>".stripslashes($row[1]). "</span><br clear=left /><br />";
    }
}
?>
