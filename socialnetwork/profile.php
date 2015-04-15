<?php
include_once 'header.php';

if (!$loggedin) die();

echo "<div class='main'><h3>Your Profile</h3>";

if (isset($_POST['text']))
{
    $text = sanitizeString($_POST['text']);
    $text = preg_replace('/\s\s+/', ' ', $text);   // removing duplicate whitespace.
    
    if (mysql_num_rows(queryMysql("SELECT * FROM profiles
        WHERE user='$user'")))
         queryMysql("UPDATE profiles SET text='$text' where user='$user'");
    else queryMysql("INSERT INTO profiles VALUES('$user', '$text')");
}
else
{
    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
    
    if (mysql_num_rows($result))
    {
        $row  = mysql_fetch_row($result);
        $text = stripslashes($row[1]);
    }
    else $text = "";
}

$text = stripslashes(preg_replace('/\s\s+/', ' ', $text));

if (isset($_FILES['image']['name']))
{
    $saveto = "image/$user.jpg";                                  // save user profile image
    move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
    $typeok = TRUE;
    
    switch($_FILES['image']['type'])
    {
        case "image/gif":   $src = imagecreatefromgif($saveto); break;         // only GIF JPEG PNG are accepted, return FALSE if not
        case "image/jpeg":  // Both regular and progressive jpegs
        case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
        case "image/png":   $src = imagecreatefrompng($saveto); break;
        default:            $typeok = FALSE; break;
    }
    
    if ($typeok)
    {
        list($w, $h) = getimagesize($saveto);

        $max = 100;       // processing image, keep dimension as 100
        $tw  = $w;
        $th  = $h;
        
        if ($w > $h && $max < $w)
        {
            $th = $max / $w * $h;
            $tw = $max;
        }
        elseif ($h > $w && $max < $h)
        {
            $tw = $max / $h * $w;
            $th = $max;
        }
        elseif ($max < $w)
        {
            $tw = $th = $max;
        }
        
        $tmp = imagecreatetruecolor($tw, $th);       // creat new, blank canvas
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);   //resample image
        imageconvolution($tmp, array(array(-1, -1, -1),              // Sharpen image
            array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
        imagejpeg($tmp, $saveto);
        imagedestroy($tmp);      //remove unnecessary image after processing
        imagedestroy($src);
    }
}

showProfile($user);

echo <<<_END
<form method='post' action='profile.php' enctype='multipart/form-data'>
<h3>Enter or edit your details and/or upload an image</h3>                              
<textarea name='text' cols='50' rows='3'>$text</textarea><br />
_END;
?>                   
<!--                some upload form and introduction -->
Image: <input type='file' name='image' size='14' maxlength='30' />                 
<input  class='input' type='submit' value='Save Profile' />
</form></div><br /></body></html>
