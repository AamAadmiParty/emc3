<?php
if ($handle = opendir('calldelhi/')) {
    while (false !== ($file = readdir($handle)))
    {
        if (($file != ".") 
         && ($file != ".."))
        {
echo '<a href="slider2.php" title=""><img src="calldelhi/'.$file.'" alt=""  width="850" height="315" title="" /></a>';
        }
    }

    closedir($handle);
}
?>