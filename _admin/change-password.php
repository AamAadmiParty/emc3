<?php
include("includes/app_top.php");
$stcat='Admin';
$pagetitle="Change Password";
checkAdminLogin();
  if($action=="change_pass")
  {
  $pwd = cleanQuery($_POST['password']);
$pwd2=sha1($pwd);
  $newpwd = sha1(cleanQuery($_POST['newpass']));
  
        $sql= "select password from admins where username='".$_SESSION['admin']."'";		
        $res= mysqli_query($mysqli, $sql);
        $row= mysqli_fetch_assoc($res);
        if($pwd2!=$row['password']) 
        {
    tep_redirect(tep_href_link('change-password.php','action1=err'));		
        }  
		else
		{  
    $query="update admins set password='" . $newpwd . "' where username='".$_SESSION['admin']."'";
    mysqli_query($mysqli, $query);
    tep_redirect(tep_href_link('change-password.php','action1=success'));
	}
  }
?>
<?php include("includes/styles.php");?>
<script language="javascript">
function chk_pass(form)
{
 if(form.old.value=="")
  {
     alert("Please Enter Old Password.");
	form.old.focus();	 
     return false;
	 
  }
   
  if(form.newpass.value=="")
  {
     alert("Please Enter New Password.");
	form.newpass.focus();	 
     return false;
  }
  if(form.newpass2.value=="")
  {
     alert("Please Confirm Your New Password.");
	form.newpass2.focus();	 
     return false;
  }
  if(form.newpass2.value!=form.newpass.value)
  {
     alert("Password does not match.");
	form.newpass.focus();	 
     return false;
  }
return true;   
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
                    
                    <h3 class="title">Change Password</h3>
                    
                    </div>
                </div>
                 
                 
                 </td></tr>
   
                 <tr>
                   <td ><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text9">
                    <tr>
                      <td><br />
                          <br />
                          <form action = "change-password.php?action=change_pass" method="post" name="frm_change_m_pass" id="frm_change_m_pass" onSubmit="return chk_pass(this);">
                            <table border="0" width="100%" cellpadding="0" cellspacing="0" class="text12"  align="center">
                              
                            
                              <tr>
                                <td   align="right"><span class="red">* </span>Old password :&nbsp;</td>
                                <td  ><input type="password" name="password" id="password" class="textbox" maxlength="40" style="width:200px;" /></td>
                              </tr>
                              <tr>
                                <td  align="right" ><span class="red">* </span>New password :&nbsp;</td>
                                <td  ><input type="password" name="newpass" id="newpass" class="textbox" maxlength="40" style="width:200px;" /></td>
                              </tr>
                              <tr>
                                <td  align="right"><span class="red">*</span> Confirm password :&nbsp;</td>
                                <td  ><input type="password" name="newpass2" id="newpass2" class="textbox" maxlength="40" style="width:200px;" /></td>
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
                        echo "<div class='alert alert-success'>You have successfully Changed Your Password.</div>";
						}
if($action1=="err") { echo "<div class='alert alert-error'>Wrong password</div>";}?></div></td>
                    </tr>
                </table></td>
                 </tr>
           </table>
 
	<?php include("includes/footer.php");?>
</body>
</html>
