<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
       <?php 
        include_once 'header.php';

        echo "<div class='socnet'><span id='insoc'>";

        if ($loggedin) echo " $user, you are logged in.";
        else           echo  ("Please <a class='sth' href='login.php?view=$user'>" ."log in</a> to continue....");
                
        echo "</span></div>";
        ?>
    </body>
</html>
