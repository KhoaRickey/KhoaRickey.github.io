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
include_once 'header.php';

if (isset($_SESSION['user']))
{
    destroySession();
    echo "<div class='socnet'>You have been logged out. Please " .
         "<a class='sth' href='index.php'>click here</a> to refresh the screen.";
}
else echo "<div class='socnet'><br />" .
          "You cannot log out because you are not logged in";
?>

<br /><br /></div></body></html>
