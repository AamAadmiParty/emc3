<?php include("includes/app_top.php");
checkUserLogin();
$getid=getid('eid');
$uid=getid('eid2');
if($uid!='')
$emails=return_field('users','id',$uid,'email');
else
$emails=return_field('referrals','id',$getid,'email');

$emailfrom=$_SESSION['useremail'];
if ($action=="send")
{
	$message=cleanQuery($_POST['message']);	
$esubject="Message from ".$_SESSION['user'];	
require '../includes/mailer.php';
sendmail($emailfrom,$_SESSION['user'],$emails,$esubject,$message);
tep_redirect("send-message.php?action1=success");
}
?>
<?php include("includes/styles.php");?>
<script type="text/javascript" src="../js/ajax.js"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#send").validate({
              rules: {
						message:"required",
			 }
});});
</script>
</head>
<body class="bgwhite">
    <h1>Send Message</h1>
    <div id="messages">

					<?php if($action1=="success") { echo '<div class="success">Message Send</div>';}
					 if($action1=="err") { echo '<div class="error">Error in sending mail. </div>';}
?></div>
			<form action="send-message.php?action=send&<?php if($eid!='')echo 'eid='.$getid;if($uid!='')echo 'eid2='.$uid;?>" name="report" method="post" id="send">
            	<p>Message</p>
                <textarea class="inputstyle w-auto" cols="50" rows="3" name="message"></textarea><br /><br />
                <input type="submit" class="button2" value="SUBMIT" />
            </form>
			
  
           </body>
</html>
