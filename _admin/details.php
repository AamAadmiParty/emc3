<?php include("includes/app_top.php");
$pagetitle2="Get Contacts";
checkUserLogin();
if($action=="send2")
{
$wrong=cleanQuery($_POST['wrong']);	
$vote=cleanQuery($_POST['vote']);	
$_SESSION['getcontact']='';
$getid=cleanQuery($_POST['cid']);
if($wrong==1)
{
$vote=cleanQuery($_POST['vote']);	
$comments=cleanQuery($_POST['comments']);		
$query="update contacts set userid=".$_SESSION['userid'].", iscalled=$wrong, vote=$vote, comments='$comments', contactdate='$date' where id=".$getid;
mysqli_query($mysqli, $query);	
//echo $query;
tep_redirect("details.php?action1=s1");	
}
else if($wrong==2)	
{
$query="update contacts set iscalled=$wrong where id=".$getid;
mysqli_query($mysqli, $query);		
//echo $query;
tep_redirect("details.php?action1=s3");	
}
else if($wrong==3)	
{
$query="update contacts set iscalled=$wrong, userid=".$_SESSION['userid'].", contactdate='$date' where id=".$getid;
mysqli_query($mysqli, $query);
tep_redirect("details.php?action1=s4");	
}
else
{
tep_redirect("details.php?action1=s2");	
}
}
if($action=="send3")
{
$email=cleanQuery($_POST['emailr']);	
$query="insert into referrals (email,userfrom,datesent) values ('$email',".$_SESSION['userid'].",'$date')";
mysqli_query($mysqli, $query);

	
$sql2= "select * from email_templates where id=4";
        $res2= mysqli_query($mysqli,$sql2);
        $row2= mysqli_fetch_assoc($res2);
		$esubject = $row2['subject'];
		$esubject = str_replace("[SITENAME]",$sitename,$esubject);
		
		$emailtext = $row2['description'];
		$emailtext = str_replace("[NAME]",$_SESSION['user'],$emailtext);		
		$emailtext = str_replace("[EMAIL]",$_SESSION['useremail'],$emailtext);	
		$emailtext = str_replace("[SITEURL]",$siteurl,$emailtext);	
		$emailtext = str_replace("[SITENAME]",$sitename,$emailtext);	
		$emailtext = str_replace("[ADMINEMAIL]",$adminemail,$emailtext);												
		$emailtext = str_replace("[SOCIAL_ICONS_MAIL]",$socialicons_mail,$emailtext);														
			
//@mail($email, $esubject, $emailtext, "From: $adminemail\r\nReply-to: $adminemail\r\nContent-type: text/html; charset=us-ascii");
require 'includes/mailer.php';
sendmail('emc3.aap@gmail.com','Aam Aadmi Party',$email,$esubject,$emailtext);
sendmail('emc3.aap@gmail.com','Aam Aadmi Party',$_SESSION['useremail'],$esubject." (".$email.")",$emailtext);
tep_redirect("details.php?action1=s5");
}
?>
<?php include("includes/styles.php");?>
<meta property="og:title" content="Mission C-Cube"/>
<meta property="og:url" content="http://usa.aamaadmiparty.org/missionc3/"/>
<meta property="og:image" content="http://usa.aamaadmiparty.org/missionc3/images/mission-c3.png"/>
<link rel="stylesheet" href="css/autocomplete.css" type="text/css" media="screen">
<link type="text/css" media="screen" rel="stylesheet" href="colorbox/colorbox.css" />
<script src="js/autocomplete.js" type="text/javascript"></script>
<script src="js/ajax.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="colorbox/jquery.colorbox.js"></script>
		<script type="text/javascript">

			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements

				$(".vid").colorbox({iframe:true, innerWidth:550, innerHeight:400});
				$(".report1").colorbox({iframe:true, innerWidth:520, innerHeight:280});
				$(".details").colorbox({iframe:true, innerWidth:650, innerHeight:500});				
				$(".video2").colorbox({iframe:true, innerWidth:550, innerHeight:400});				
				$("#refer").validate({
              rules: {
						emailr: "email required", 
						security_code:"required"
						}
});

		 check2();	 
			});			
	

function check2() {
s=getCheckedRadio('wrong');
if(s==1)
document.getElementById("contact2").style.display="block";	
else
document.getElementById("contact2").style.display="none"; 
}
function check3() {	
if (document.getElementById('vote1')) {
s=getCheckedRadio('vote');	
if(s==1)
{
alert("Update the contact details and Click submit button to save the details.");
return false;
}
else
{
alert("Click submit button to confirm.");
return false;
}
}
else
{
document.getcontact.submit();
}
} 

</script>
</head>
<body>
 <?php include("includes/header.php");?> 
           <div class="conatinetr-1">
 <!-- AddThis Smart Layers BEGIN -->
<!-- Go to http://www.addthis.com/get/smart-layers to customize -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-523d492c2a6757ed"></script>
<script type="text/javascript">
  addthis.layers({
    'theme' : 'light',
    'share' : {
      'position' : 'left',
      'numPreferredServices' : 5
    },  
    'whatsnext' : {}  
  });
</script>
<!-- AddThis Smart Layers END -->          
            <div class="hea"><span class="h-t">Citizen Call Campaign </span><div class="memberselect">
        <?php
			$res1=mysqli_query($mysqli, "SELECT id from contacts where vote=1 and userid !=0");
			$yes=mysqli_num_rows($res1);
			$res2=mysqli_query($mysqli, "SELECT id from contacts where vote=0 and userid !=0");
			$no=mysqli_num_rows($res2);
			$res3=mysqli_query($mysqli, "SELECT id from contacts where vote=2 and userid !=0");
			$und=mysqli_num_rows($res3);
			$res5=mysqli_query($mysqli, "SELECT count(id) as cnt from contacts where userid!=0");
			 $row5=mysqli_fetch_assoc($res5);
			
		 ?>
          <table  border="0" cellpadding="0" cellspacing="0">
            
            <tr>
              <td width="63" class="yesfont">YES</td>
              <td width="63" class="nofont">NO</td>
              <td width="98" class="undedidefont">UN DECIDED</td>
              <td width="135" class="bluefont14" style="font-size:16px">TOTAL CALLED</td>
            </tr>
            <tr>
              <td ><span class="yesbt"><?php echo $yes; ?></span></td>
              <td  ><span class="nobt"><?php echo $no; ?></span></td>
              <td  ><span class="undecidebt"><?php echo $und; ?></span></td>
              <td><span   class="totalcontactbt" style="display:inline-block; width:135px"><?php echo $row5['cnt']; ?></span></td>
            </tr>
            
          </table>
        </div></div>
            <div  id="messages" style="padding:3px 20px;">
           <?php 
		             if(isset($_POST['submit']))
{
}
else
{
		   if($action1=="s2")
		   {echo '<div class="error">The Earlier Number was recycled back into the system.</div>';
			   }
			    if($action1=="s3")
		   {echo '<div class="error">This Number will skip.</div>';
			   }
			    if($action1=="s4")
		   {echo '<div class="alert">This Number was placed in Call Later. Correspond him later.</div>';
			   }
			   if($action1=="s1")
		   {echo '<div class="success">Updated contacted details.</div>';
			   }
}
			   ?>
           </div>
            <div class="get-connect-conatiner"> 
              <div class="getcont bg-grey">
              <span class="span-1">Get Contact</span>
              <form method="post" name="getcontact" id="getcontact" onSubmit="return check3()">
              
           <input name="submit" type="submit" class="cont" id="submit" value="Get me a Contact"/>
           </form>
              </div>
              <div class="block-mini-2 bg-grey">
              <span class="span-1">How to motivate caller</span>
              <a  title="<?php echo return_field('videos','ishome',1,'heading');?>" class="vid" href="http://www.youtube.com/v/<?php echo return_field('videos','ishome',1,'youtube');?>?autoplay=1" rel="colorbox">watch this video</a> 
<br />
            <span class="motivate" style="display:none"> 
            Read it here (<a href="motivate-english.php" class="details" rel="colorbox4">English</a> / <a href="motivate-hindi.php" class="details" rel="colorbox4">Hindi</a>)</span>
            </div>
            <table width="350" border="0"   cellspacing="0" cellpadding="0" class="bg-grey tbln">
  <tr align="center">
    <td style="border-right:#dddddd 1px solid"><strong><a href="objective.php" class="details" rel="colorbox5">Objective<br />
of Telecalling</a></strong></td>
    <td><a href="message-to-citizen.php" class="details" rel="colorbox5">Message<br />
to Citizen</a></td>
	</tr>
    <tr align="center">
    <td style="border-right:#dddddd 1px solid; border-top:#dddddd 1px solid">
<a href="tips.php" class="details" rel="colorbox5">Tips &amp; Pointers<br />
for Call</a></td>
    <td style="border-top:#dddddd 1px solid"> <a  title="<?php echo return_field('videos','id',4,'heading');?>" class="video2" href="http://www.youtube.com/v/<?php echo return_field('videos','id',4,'youtube');?>?autoplay=1" rel="colorbox">One Minute<br />
Video</a></td>
  </tr>
</table>
          
          </div>
           
 <?php

 $daystart=$date2." 07:00:00";
$dayend=$date2." 22:30:00";
$date = date_default_timezone_set('Asia/Kolkata');
$now=date("Y-m-d G:i:s");
//echo $daystart.', '.$dayend.', '.$now;
if(check_date_is_within_range($daystart, $dayend, $now)){
} else {
?>	
<p class="talkingtime">The call campaign is taking place between 7AM India Time to 10.30PM India Time. <br />
Thank you for your continued support!</p>
<script type="text/javascript">
document.getElementById("submit").disabled = true;
</script>


    <?php
}

if(isset($_POST['submit'])&&$_POST['submit']!="")
{
	$r="select id from contacts where userid=".$_SESSION["userid"]." and contact!='' and contactdate='$date2' and catid=".$categoryid;
	//echo $r;
	$re=mysqli_query($mysqli, $r);	
	if(mysqli_num_rows($re) < $daylimit)
	{	
	if(isset($_SESSION['getcontact'])&&$_SESSION['getcontact']!='')
	{
$contactid=$_SESSION['getcontact'];
	$sql1="SELECT * FROM contacts WHERE id=".$contactid;	
		}	
else
{		
	$sql1="SELECT * FROM contacts WHERE contact!='' and catid=".$categoryid." and userid=0 and iscalled!=2  order by rand() limit 1";	
}
	$res=mysqli_query($mysqli, $sql1);
	//echo $sql1;
	if(mysqli_num_rows($res) >0)
	{
    $row=mysqli_fetch_assoc($res);	
	$_SESSION['getcontact']=$row['id'];	
	?>
   <div class="clear"></div>
  <div class="inner-block">    
	<table class="tabc" align="center" >
    	<tr> 
        <th>Conatct Number</th>
        <th>City</th>
        
        </tr>
        <tr>
        	
        	<td width="200"><strong><?php echo $row['contact'];?></strong></td>
            <td width="120">Delhi</td>
            
        </tr>
    </table>
    <div class="checklist">
   <form method="post" action="details.php?action=send2" onSubmit="return validate2(this)">
    <p>Did the call get connected ?<br /><br />
      <input type="radio" name="wrong"  id="wrong1" checked="checked"  onClick="check2();"   value="1" /> Yes
    <input type="radio" name="wrong" value="0"   id="wrong2"  onClick="check2();" /> Not Reached
    <input type="radio" name="wrong" value="2" id="wrong3"  onClick="check2();" /> Wrong Number
    <input type="radio" name="wrong" value="3" id="wrong4"  onClick="check2();" /> Call Later
    </p>
    
    <div id="contact2" style="display:none">
   <p>Votes for Aam Aadmi Party ? <a href="how-to-judge.php" class="details" rel="colorbox9" style="float:right; color:#990000; font-weight:bold">Tips - How to Judge?</a><br /><br />
      <input type="hidden" name="cid" value="<?php echo $row['id'];?>" />
      <input type="radio" name="vote"  id="vote1" checked="checked" value="1"  /> Yes
    <input type="radio" name="vote" value="0"   id="vote2" /> No
    <input type="radio" name="vote" value="2" id="vote3" /> Un decided</p>
    <p>Comments <br /><br />
    <textarea name="comments" class="txt-area" rows="4" cols="40"></textarea></p>
    <p class="clear_left"><span class="char">140 characters max</span></p></div>
    <p><input name="button" type="submit" class="leftformbt"   id="button" value="Submit" /></p>
	
     </form>
    </div>
   
<?php
}
else
{
?>
    <p class="error">No contacts have to retrieve. Will update soon.</p>
<?php
}
}
else
{
	?>
    <p class="error">Per day maximum <?php echo $daylimit;?> contacts only can get. Limit exceeded.</p>
    <?php
}
}
?><br />
<?php
  if($action1=="s5")
		   {echo '<div class="success">Thank you for referring your friend. Sent about Mission C3 details to the email.</div>';
			   }?>
        
        <div class="refercontainer">
          <form method="post" action="details.php?action=send3" id="refer" name="refer" >
            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td class="referhead" colspan="5">Refer your Friend</td>
              </tr>
              
              <tr valign="top">
                <td class="referfont">Lets get Viral! Please refer your friend.<br /><input type="text"  class="input st" name="emailr" id="emailr" placeholder="Enter Your Friend's Email Id" autocomplete="off" onChange="checkmailr();" value=""  style="width:260px" />
                <div id="email_response" style="width:250px"></div></td>
              
                <td class="referfont">Enter the characters you see
                <br />
                <table   border="0" cellspacing="0" cellpadding="4" class="bn-t">
                           <tr>
                             <td> <input type="text" style="TEXT-TRANSFORM: lowercase; width:100px;float:left;" maxlength="10" 
 size="10" name="security_code" id="security_code" onChange="checkcaptcha()" class="inputstyle st"  /></td>
 							<td width="125"><img src="CaptchaSecurityImages.php?characters=5" alt="" id='captchaimg' height="35" >&nbsp;<a href="javascript: refreshCaptcha();"><img src="images/refresh.jpg" alt="Refresh" /></a></td>
                           </tr>
                         </table><div id="captcha_response"></div>  </td>
              
                <td><input type="submit" value="SUBMIT" class="ref" id="submit" /></td>
              </tr>
              
            </table>
            <div style="color:#000000; text-align:center">Sometimes the emails will end up in Spam folder. So please confirm with your friend.</div></p>
          </form>
         </div>
        
      	<br/>	
</div></div></div>
 <?php include("includes/footer.php");?>           
           </body>
</html>
