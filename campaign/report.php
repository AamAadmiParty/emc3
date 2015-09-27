<?php include("includes/app_top.php");
checkUserLogin();
if ($action=="send")
{
	$problem=cleanQuery($_POST['problem']);
	$query="insert into problems (report,userid,state_id,datesent) VALUES ('$problem',".$_SESSION['userid'].",'$stateid','$date')";
$a=mysqli_query($mysqli,$query);
$esubject="AAP Call Campaign - Problem";
require 'includes/mailer.php';
    sendmail($_SESSION['useremail'],$_SESSION["user"],$adminemail,$esubject,"User: ".$_SESSION["user"]."<br />Email: ".$_SESSION['useremail']."<br />Campaign: ".$_SESSION['campaign']."<br/><br/>".$problem);
//echo $query;
if($a)
tep_redirect("report.php?action1=success");
else
tep_redirect("report.php?action1=err");
}
?>
<?php include("includes/styles.php");?>
<script type="text/javascript" src="../js/ajax.js"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#report").validate({
              rules: {
						problem:"required",
			 }
});});
</script>
</head>
<body class="bgwhite">
    
            <div id="messages">

					<?php if($action1=="success") { echo '<div class="success">Thank you for Reporting your problem. We will resolve it as soon as possible !!  </div>';}
					 if($action1=="err") { echo '<div class="error">Error in reporting.  </div>';}
?></div>
           <h1>Report Problem</h1>
			<form action="report.php?action=send" name="report" method="post" id="report">
            	<p>Post your problem</p>
                <textarea class="inputstyle w-auto" cols="50" rows="3" name="problem"></textarea><br /><br />
                <input type="submit" class="button2" value="SUBMIT" />
            </form>
			
  
           </body>
</html>
