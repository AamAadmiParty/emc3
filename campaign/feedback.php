<?php include("includes/app_top.php");
checkUserLogin();
if ($action=="send")
{
	$message=cleanQuery($_POST['message']);
	$query="insert into feedback (description,name,email,stateid,datesent) VALUES ('$message','".$_SESSION['user']."','".$_SESSION['useremail']."',$stateid,'$date')";
$a=mysqli_query($mysqli,$query);
require 'includes/mailer.php';
$esubject="AAP Call Campaign - Feedback";
sendmail($_SESSION['useremail'],$_SESSION["user"],$adminemail,$esubject,"User: ".$_SESSION["user"]."<br />Email: ".$_SESSION['useremail']."<br />Campaign: ".$_SESSION['campaign']."<br /><br />".$message);
if($a)
tep_redirect("feedback.php?action1=success");
else
tep_redirect("feedback.php?action1=err");
}
?>
<?php include("includes/styles.php");?>
<script type="text/javascript" src="../js/ajax.js"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#volunteer").validate({
              rules: {
						message:"required",
			 }
});});
</script>
</head>
<body class="bgwhite">
    
            <div id="messages">

					<?php if($action1=="success") { echo '<div class="success">Thank you for sending feedback in our Mission C3 !!  </div>';}
					 if($action1=="err") { echo '<div class="error">Error in sending.  </div>';}
?></div>
           <h1>Suggestion / Feedback</h1>
			<form action="feedback.php?action=send" name="report" method="post" id="report">
            	<p>Post your feedback and/or suggestions</p>
                <textarea class="inputstyle w-auto" cols="50" rows="3" name="message"></textarea><br /><br />
                <input type="submit" class="button2" value="SUBMIT" />
            </form>
			
  
           </body>
</html>
