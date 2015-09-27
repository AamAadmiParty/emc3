<?php include("includes/app_top.php");
$pagetitle2="Forgot Password";
$campaign = $_SESSION['campaign'];
    
if($action=="send")
      {
$mailto=cleanQuery($_POST["email"]);	  
$sql= "select * from users where email='". $mailto."'";
        $res= mysqli_query($mysqli,$sql);
        $row=mysqli_fetch_assoc($res);
			if($mailto==$row['email'])
			{			
$verifycode=create_randomid(10);	

$query = "update users set confirmation='".$verifycode."'  where id=".$row['id'];
@mysqli_query($mysqli,$query);
			
$sql2= "select * from email_templates where id=2";
        $res2= mysqli_query($mysqli,$sql2);
        $row2= mysqli_fetch_assoc($res2);
					
		$esubject = $row2['subject'];
		$esubject = str_replace("[NAME]",$row['name'],$esubject); 
		$esubject = str_replace("[SITENAME]",$sitename,$esubject);
		
		$emailtext = $row2['description'];
		$emailtext = str_replace("[NAME]",$row['name'],$emailtext);		
		$emailtext = str_replace("[EMAIL]",$row['email'],$emailtext);	
		$emailtext = str_replace("[VERIFYCODE]",$verifycode."&campaign=".$campaign,$emailtext);
		$emailtext = str_replace("[SITEURL]",'http://emc3.aamaadmiparty.org/delhi/',$emailtext);
		$emailtext = str_replace("[SITENAME]",$sitename,$emailtext);	
		$emailtext = str_replace("[ADMINEMAIL]",$adminemail,$emailtext);												
require 'includes/mailer.php';
sendmail('','',$mailto,$esubject,$emailtext);			
tep_redirect(tep_href_link($pagename,'action1=success'));
//else
//tep_redirect(tep_href_link($pagename,'action1=err2'));
			}
			else {
tep_redirect(tep_href_link($pagename,'action1=err'));
			}
	  }
?>
<?php include("includes/styles.php");?>
<?php include("../includes/colorbox.php");?>
</head>
<body> 
<?php include("includes/header.php");?>
<div class="division-1">
  <h1 class="mem"><?php echo $pagetitle2;?></h1>
  <p>&nbsp;</p><br />
    <div id="messages"><?php  
if($action1=="success"){?>
                          <div class="success">Password has been sent to your email</div>
  <?php } 
if($action1=="err"){?>
                          <div class="error">Email doesn't exist in our database</div>
                        <?php } 
                        if($action1=="err2"){?>
                          <div class="error">Error in sending Email</div>
                        <?php } ?></div>
	<div class="form1 bg1">
  		 <form name="login" action="<?php echo $pagename;?>?action=send" method="post" onSubmit="return validatefp(this)">
    <table align="center"  cellspacing="0"  border="0" >
                  <tbody>
                    <tr>
                      <td align="right"  >&nbsp;</td>
                      <td   >&nbsp;</td>
                    </tr>
                    <tr>
                      <td  align="left" class="tdata" >Email ID<br />
                        <input type="text" autocomplete="off" class="input" name="email" /></td>
                    </tr>
                    <tr>
                  <td align="right"  >&nbsp;</td>
                    <td   >&nbsp;</td>
                  </tr>
                 
                  <tr>
                    <td align="left"  class="tdata" ><table width="100%">
                        <tr>
                          <td height="40" align="left"><input type="submit" value="SUBMIT" class="button2" name="Submit2" /></td>
                        <td height="40" align="right"  ><a href="login.php" class="lost" >Back to Login</a></td>    </tr>
                      </table></td>
                  </tr>
                  <tr>
                  <td align="right"  >&nbsp;</td>
                    <td   >&nbsp;</td>
                  </tr>
                  
                  <tr>
                    <td height="40" align="left" class="tdata1" colspan="2"><a href="registration.php " class="regis" style="padding:10px 70px">New Member Register!</a></td>
                  </tr>
                    </tbody>
                    </table>
  </form>
  	</div>
</div>

<?php include("includes/footer.php");?>
</body>
</html>
