<?php include("includes/app_top.php");
checkUserLogin();
if ($action=="send")
{
	$message=cleanQuery($_POST['message']);
	$query="insert into volunteer (message,userid,datesent) VALUES ('$message',".$_SESSION['userid'].",'$date')";
$a=mysqli_query($mysqli,$query);
//echo $query;
if($a)
tep_redirect("volunteer.php?action1=success");
else
tep_redirect("volunteer.php?action1=err");
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

					<?php if($action1=="success") { echo '<div class="success">Thank you for Volunteering in our Mission C3 !!  </div>';}
					 if($action1=="err") { echo '<div class="error">Error in reporting.  </div>';}
?></div>
           <h1>Wish to Volunteer</h1>
			<form action="volunteer.php?action=send" name="report" method="post" id="report">
            	<p>Post in which you want to volunteer in </p>
                <textarea class="inputstyle w-auto" cols="50" rows="3" name="message"></textarea><br /><br />
                <input type="submit" class="button2" value="SUBMIT" />
            </form>
			
  
           </body>
</html>
