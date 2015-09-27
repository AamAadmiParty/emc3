<?php
include("includes/app_top.php");
$stcat='Admin';
$pagetitle="Profile";
checkAdminLogin();

if($action=="change")
{
$phone=cleanQuery($_POST['phone']);
$username=cleanQuery($_POST['username']);
$email=cleanQuery($_POST['email']);
$designation=cleanQuery($_POST['designation']);
 $query="update admins set username='$username', phone='$phone', email='$email', designation='$designation', datemodified='$date' where id=".$_SESSION['adminid'];
mysqli_query($mysqli, $query);
tep_redirect(tep_href_link($pagename,'action1=success'));
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
            <div class="fR t-r">
            		<a href="profile.php?action=edit" class="btn btn-small btn-primary coursesMenu">Edit Profile</a>
                </div>
        	<h3 class="title">Profile</h3>
            
        	</div>
        </div>
                  </td></tr>
   
                 <tr>
                   <td ><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text9">
                    <tr>
                      <td align="right"></td>
                    </tr>
                    <tr>
                      <td><div id="messages"><?php
if($action1=="err") { echo '<div class="alert alert-error">You cannot access that page. Please contact admin. </div>';}
if($action1=="success") { echo '<div class="alert alert-success">Updated profile successfully.</div>';}
?></div></td>
                    </tr>
                    <tr>
                      <td> <?php $query="select * from admins where id=". $_SESSION['adminid']; 
				 
				$res=mysqli_query($mysqli, $query);
              $row=mysqli_fetch_assoc($res);?><br />
                       <?php if($action=="edit"){?>  <form action="<?php echo $pagename;?>?action=change" method="post"  name="frmadd" id="frmadd"> <table width="96%" border="0" cellspacing="0" cellpadding="4" align="center">
                            <tr>
                              <td width="13%">User Name :</td>
                              <td width="87%"><input type="text" name="username"    value="<?php echo $row['username'];?>"/></td>
                            </tr>
                            <tr>
                              <td>Email :</td>
                              <td><input type="text" name="email"   value="<?php echo $row['email'];?>"/></td>
                            </tr>
                            <tr>
                              <td>Phone :</td>
                              <td><input type="text" name="phone"   value="<?php echo $row['phone'];?>"/></td>
                            </tr>
                            <tr>
                              <td>Designation :</td>
                              <td><input type="text" name="designation"   value="<?php echo $row['designation'];?>"/></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td><input type="submit" name="update" value="Submit" id="update" class="btn btn-small btn-primary" />
                                <a href="<?php echo $pagename;?>" class="btn btn-inverse" >Cancel</a></td>
                            </tr>
                          </table></form>
                       <?php } else {?>   <table width="96%" border="0" cellspacing="0" cellpadding="4" align="center">
                            <tr>
                              <td width="13%">User Name</td>
                              <td width="87%"><?php echo $row['username'];?></td>
                            </tr>
                            <tr>
                              <td>Email</td>
                              <td><?php echo $row['email'];?></td>
                            </tr>
                            <tr>
                              <td>Phone</td>
                              <td><?php echo $row['phone'];?></td>
                            </tr>
                            <tr>
                              <td>Designation</td>
                              <td><?php echo $row['designation'];?></td>
                            </tr>
                          </table><?php }?>
                          <br /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    
                </table></td>
                 </tr>
           </table>
 
	<?php include("includes/footer.php");?>
</body>
</html>
