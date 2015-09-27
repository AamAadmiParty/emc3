<?php
include("includes/app_top.php");
$getid = get('id');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $sitename;?></title>
<link rel="shortcut icon" href="favicon.ico" />
</head>
<body style="margin:0">
<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><object height="300" width="450" id="main01" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"><param value="http://www.youtube.com/v/<?php echo $getid;?>&amp;color1=0xb1b1b1&amp;color2=0xcfcfcf&amp;feature=player_embedded&amp;fs=1" name="movie"><param value="high" name="quality"><param value="true" name="allowFullScreen"><param value="true" name="base"><param value="true" name="loop"><param value="transparent" name="wmode"><embed height="300" width="450" src="http://www.youtube.com/v/<?php echo $getid;?>&amp;color1=0xb1b1b1&amp;color2=0xcfcfcf&amp;feature=player_embedded&amp;fs=1" allowfullscreen="true" type="application/x-shockwave-flash"></object></td>
  </tr>
</table>
</body>
</html>
