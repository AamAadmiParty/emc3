<?php
$campaign = $_SESSION['campaign'];

$action = get('action');
$action1 = get('action1');
$page = get('page');

$pagename=curPageName();
$pageurl=CurPageQS();

$date=date("Y-m-d H:i:s");
$date2=date("Y-m-d");
$thisyear=date("Y");
$page_per_set=6;
$getconnected= array("","Yes","Wrong Number","Call Later","Not Reached","Out of Delhi","Blocked");
$vote4aap= array("No","Yes","Undecided");
$mstatus= array("No","Yes","Block");

$res=mysqli_query($mysqli,"select isother from settings");
$row6=mysqli_fetch_array($res);
$isother=$row6['isother'];

$res1=mysqli_query($mysqli, "select * from states where sitename='$campaign'")or die(mysqli_error());
$row61=mysqli_fetch_array($res1);
$sitename=$row61['sitename'];
$statename=$row61['name'];
$tablename=$row61['tablename'];
$stateid=$row61['id'];
$pagetitle=$row61['pagetitle'];

$res=mysqli_query($mysqli,"select * from settings where state_id=".$stateid);
$row6=mysqli_fetch_array($res);
$adminemail=$row6['adminemail'];
$siteurl=$row6['siteurl'].$sitename.'/';
$sitename=$row6['sitename'];
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
									<a href="'.$facebookurl.'"><img alt="Facebook" border="0" height="24" src="'.$siteurl.'../images/email/facebook.png" width="24" /></a></td>
								<td>
									<a href="'.$twitterurl.'"><img alt="Twitter" border="0" height="24" src="'.$siteurl.'../images/email/twitter.png" width="24" /></a></td>
								 						 
							</tr>
						</tbody>
					</table>';
$additionalinfo=$row61['description'];

if (isset($_SESSION['usercatid'])) {
    $query13 = "select * from categories where id=".$_SESSION['usercatid']." and state_id=$stateid and active=1";
    $chk = mysqli_num_rows(mysqli_query($mysqli, $query13));
    if ($chk>0)
        $categoryid = $_SESSION['usercatid'];
    else
        $_SESSION['usercatid'] = $categoryid;
}
?>