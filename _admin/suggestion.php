<?php
include("includes/app_top.php");
$stcat='Admin';
$pagetitle="Feedbacks to Admin";
checkAdminLogin();
  if($action=="send")
  {
  $name = cleanQuery($_POST['name']);
  $feedback= cleanQuery($_POST['feedback']);
	$query="insert into feedback (name, description, datesent) VALUES ('$name', '$feedback', '$date')";
        $res= mysqli_query($mysqli, $query);
       
     if($res) 
    //echo $query;	
	tep_redirect(tep_href_link('suggestion.php','action1=success'));
	else
	 tep_redirect(tep_href_link('suggestion.php','action1=err'));
  }
?>
<?php include("includes/styles.php");?>
<script language="javascript">
function chk_pass(form)
{
 if(form.name.value=="")
  {
     alert("Please Enter Name.");
	form.name.focus();	 
     return false;
	 
  }
   
  if(form.feedback.value=="")
  {
     alert("Please Enter Your Feedback / Suggestion.");
	form.feedback.focus();	 
     return false;
  }
   
}
 </script>
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="text12" align="center">
                 <tr><td> 
                 <div class="pageHeadingBlock ">
                    <div class="grayBackground">
                    <h3 class="title">Feedbacks to Admin</h3>
                    </div>
                </div>
                 
                 
                 </td></tr>
   
                 <tr>
                   <td ><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text9">
                    <tr>
                      <td><br />
                          <br />
                          <form action = "suggestion.php?action=send" method="post" name="sugg" id="sugg" onSubmit="return chk_pass(this);">
                            <table border="0" width="100%" cellpadding="0" cellspacing="0" class="text12"  align="center">
                              
                            
                              <tr>
                                <td   align="right"><span class="red">* </span>Name :&nbsp;</td>
                                <td  ><input type="text" name="name" id="name"  /></td>
                              </tr>
                              <tr>
                                <td  align="right" ><span class="red">* </span>Feedbacks / Suggestion :&nbsp;</td>
                                <td  ><textarea name="feedback"></textarea></td>
                              </tr>
                             
                              <tr>
                                <td  >&nbsp;</td>
                                <td  height="36" colspan="3" ><input type="submit" name="register" value="Submit" id="Button1" class="btn btn-primary" />                                </td>
                              </tr>
                            </table>
                          </form></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><div id="messages"><?php
if($action1=="success")
                          {
                        echo "<div class='alert alert-success'>You have Suggestion / Feedback is sent to admin successfully.</div>";
						}
if($action1=="err") { echo "<div class='alert alert-error'>Wrong password</div>";}?></div></td>
                    </tr>
                </table></td>
                 </tr>
           </table>
 
	<?php include("includes/footer.php");?>
</body>
</html>
