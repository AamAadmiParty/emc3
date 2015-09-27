<?php
$interval = 60*60*24;
$filename = "cache/data.php";
if (file_exists($filename) && (time() - $interval) < filemtime($filename)) {
}
else {
$s="<?php ";
ob_start();

$tb_videos=array();
$s=$s.'$tb_videos=array();';
global $mysqli;
// This function saves all output to a buffer instead of outputting it directly.
$res=mysqli_query($mysqli,"select * from settings");
$row6=mysqli_fetch_array($res);
$adminemail=$row6['adminemail'];
$sitename=$row6['sitename'];
$siteurl=$row6['siteurl'];
$record_per_page=$row6['records']; 
$daylimit=$row6['daylimit'];
$call_later=$row6['call_later'];
$twitterurl=$row6['twitter'];
$facebookurl=$row6['facebook'];
$categoryid=$row6['category'];
$socialicons_mail='<table align="right">
						<tbody>
							<tr>
								<td>
									<a href="'.$facebookurl.'"><img alt="Facebook" border="0" height="24" src="'.$siteurl.'images/email/facebook.png" width="24" /></a></td>
								<td>
									<a href="'.$twitterurl.'"><img alt="Twitter" border="0" height="24" src="'.$siteurl.'images/email/twitter.png" width="24" /></a></td>
								 						 
							</tr>
						</tbody>
					</table>';
$s=$s.'$adminemail="'.$adminemail.'";';
$s=$s.'$sitename="'.$sitename.'";';
$s=$s.'$siteurl="'.$siteurl.'";';
$s=$s.'$record_per_page='.$record_per_page.';';
$s=$s.'$daylimit='.$daylimit.';';
$s=$s.'$call_later='.$call_later.';';
$s=$s.'$twitterurl="'.$twitterurl.'";';
$s=$s.'$facebookurl="'.$facebookurl.'";';
$s=$s.'$categoryid='.$categoryid.';';
$s=$s.'$socialicons_mail=\''.$socialicons_mail.'\';';

$query2 = "select id, heading, youtube from videos";
$result = mysqli_query($mysqli,$query2);
$totalRows = mysqli_num_rows($result);
for ($j=0; $j<$totalRows; $j++) {
$tb_videos[$j] = mysqli_fetch_row($result);
$s=$s.'$tb_videos['.$j.'][0] = "'.$tb_videos[$j][0].'";'; 
$s=$s.'$tb_videos['.$j.'][1] = "'.$tb_videos[$j][1].'";';  
$s=$s.'$tb_videos['.$j.'][2] = "'.$tb_videos[$j][2].'";';  
} 
 $s=$s.' ?>';
            $buff = $s;
// 		echo $s;
          // Retrive the content from the buffer
          // Write the content of the buffer to the cache file
            $file = fopen($filename, "w");
            fwrite($file, $buff);
            fclose($file);
            ob_end_flush();
          // Display the generated page.
}
?>