<?php include("includes/app_top.php");
$pagetitle2="Change Password";

if($action=="change_pass")
  {
		 $query="update users set password='" . sha1(cleanQuery($_POST['newpass'])) . "' where id=".$_SESSION['userid'];
    mysqli_query($mysqli,$query);
	
    tep_redirect(tep_href_link('change-password2.php','action1=success'));
	 } 
?>
<?php include("includes/styles.php");?>
<script type="text/javascript" src="../js/ajax.js"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#frm_change_m_pass").validate({
              rules: {
						newpass: "required password",
						newpass2:{required: true, equalTo: "#newpass"},
						}
});
});
</script>
</head>
<body>
 <?php include("includes/header.php");?> 
            <div class="division-1">
           <h1><?php echo $pagetitle2;?></h1><p>&nbsp;</p>
                           <div id="messages"><?php
if($action1=="success")
                        echo "<div class='success'>You have successfully Changed Your Password.</div>";
if($action1=="err")  echo "<div class='error'>Wrong password</div>";?></div>
                     <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td><div class="box-bg-rt">
                          
                           <form action = "change-password2.php?action=change_pass" method="post" name="frm_change_m_pass" id="frm_change_m_pass" onSubmit="return chk_pass(this);">
                            <table border="0"  cellpadding="3" cellspacing="0" class="main-text"  align="center">
                              <tr>
                                <td height="10"  colspan="3"  align="center" ></td>
                              </tr>
                            
                              <tr>
                                <td width="40%"  align="right" ><span class="red">* </span>New password&nbsp;:&nbsp;</td>
                                <td  ><input type="password" name="newpass" id="newpass" class="input" maxlength="40" style="width:160px;" /></td>
                              </tr>
                              <tr>
                                <td  align="right"><span class="red">*</span>&nbsp;Confirm&nbsp;password&nbsp;:&nbsp;</td>
                                <td  ><input type="password" name="newpass2" id="newpass2" class="input" maxlength="40" style="width:160px;" /></td>
                              </tr>
                              <tr>
                                <td  >&nbsp;</td>
                                <td  height="36" colspan="3" ><input type="submit" name="register" value="Submit" id="Button1" class="button2" />                                </td>
                              </tr>
                            </table>
                          </form>
                        </div></td></tr></table>
</div></div>
 <?php include("includes/footer.php");?>           
           </body>
</html>
