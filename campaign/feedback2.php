<?php include("includes/app_top.php");
if ($action=="send")
{
	$message=cleanQuery($_POST['message']);
	$email=cleanQuery($_POST['email']);
    $username=cleanQuery($_POST['username']);
	$query="insert into feedback (description,name,email,stateid,datesent) VALUES ('$message','$username','$email',$stateid,'$date')";
$a=mysqli_query($mysqli,$query);
require 'includes/mailer.php';
$esubject="AAP Call Campaign - Feedback";
sendmail($email,$username,$adminemail,$esubject,"User: ".$username."<br/>Email: ".$email."<br />Campaign: ".$_SESSION['campaign']."<br/><br/>".$message);
//echo $query;
if($a)
tep_redirect("feedback2.php?action1=success");
else
tep_redirect("feedback2.php?action1=err");
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
						email: "email required", 
			 }
});});
</script>
</head>
<body class="bgwhite">
    
            <div id="messages">

					<?php if($action1=="success") { echo '<div class="success">Thank you for giving feedback!  </div>';}
					 if($action1=="err") { echo '<div class="error">Error in sending.  </div>';}
?></div>
           <h1>Report Issue / Feedback</h1>
			<form action="feedback2.php?action=send" name="report" method="post" id="report">
        <p>Name:&nbsp;
        <input name="username" id="username" type="text" class="inputstyle"  style="width:200px; background:#FAFAFA" value=""/></p>
            <p>Email ID:&nbsp;
			<input name="email" id="email" type="text" class="inputstyle"  style="width:200px; background:#FAFAFA" value=""/></p>
            
            <p>Post your feedback or problem:</p>
                <textarea class="inputstyle w-auto" cols="50" rows="2" name="message"></textarea><br /><br />
                <input type="submit" class="button2" value="SUBMIT" />
            </form>
			
  
           </body>
</html>
