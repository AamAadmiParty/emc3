<?php include("includes/app_top.php");
$campaign = $_SESSION['campaign'];
$campaigninfo = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * from campaigns where name='$campaign'"));
$constituency = $campaigninfo['constituency'];
$blacklist = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT GROUP_CONCAT(`ip_address` SEPARATOR '|') as blacklist from (select distinct ip_address from users where status2=2) A"));
$blockedips = explode("|", $blacklist['blacklist']);

$pagetitle2="Aam Aadmi Party - <?php echo $constituency; ?> Citizen Call campaign";
$pagetitle1="Member Login";

if(isset($_SESSION["userid"])!="")
  {
    header("location:details.php");
    exit();
}

if($action=='send')
{
$email = cleanQuery($_POST['email']);
$pwd = cleanQuery($_POST['password']);
$rtime= time() + 2628000;
if($_POST['remember']) {
setcookie('remember_me', $email, $rtime);
setcookie('key_my_site', $pwd, $rtime);
}
else if(!$_POST['remember']) {
	if(isset($_COOKIE['remember_me'])) {
		$past = time() - 100;
		setcookie('remember_me', '', $past);
		setcookie('key_my_site', '', $past);		
	}
}
	

$pwd2=sha1($pwd);
$sql= "select * from users where email='".$email."' and password='".$pwd2."'"; 
        $res= mysqli_query($mysqli,$sql);
        $row= mysqli_fetch_assoc($res);
		if(mysqli_num_rows($res) == 0)
      {
		 //echo $sql;
		 tep_redirect(tep_href_link('login.php','action1=err2'));
       } 
if($row['status2']==0)	   
      {
		 //echo $sql;
		 tep_redirect(tep_href_link('login.php','action1=err1'));
       } 
else if($row['status2']==2)	   
      {
		 //echo $sql;
		 tep_redirect(tep_href_link('login.php','action1=err3'));
       }
else if(in_array(getenv("REMOTE_ADDR"), $blockedips))
{
    //echo $sql;
    tep_redirect(tep_href_link('login.php','action1=err3'));
}
else
        {
          $_SESSION["user"]=$row['name'];	   
          $_SESSION["userid"]=$row['id'];	
		  $_SESSION['popup']="1";
		  $_SESSION['useremail']=$row['email'];
          if (isset($row['catid']) && $row['catid']!='')
              $_SESSION['usercatid'] = $row['catid'];
		$ip = getenv("REMOTE_ADDR") ;
		$query = "update users set lastlogin= '". $date."' , ip_address= '".$ip."' where id=".$row['id'];
		   $update_sql = mysqli_query($mysqli,$query) or die(mysqli_error());
		   	//echo $query;	  
          header("location:details.php");
         exit();
}
}
?>
<?php include("includes/styles.php");?>
<?php include("../includes/colorbox.php");?>
</head>
<body> 
<?php include("includes/header.php");?>
<div class="division-1">
          
          <img src="../images/aap-logo.png" alt=""  style="float:right" class="hidden-phone hidden-tablet" />
          <div class="hidden-phone hidden-tablet">
         <!-- <p>Login to your account to update your profile, change email, search the directory &amp; more.</p>
          <br />-->
          <div id="messages">
  <?php
if($action1=="success") { echo '<div class="success">Your account has been created. Please login.</div>';}
if($action1=="err1") { echo '<div class="error">Your account is inactive. Please contact admin to active your account.</div>';}
if($action1=="err2") { echo '<div class="error">Invalid email address or password.</div>';}
if($action1=="err4") { echo '<div class="error">Invalid Verification code.</div>';}
if($action1=="err3") { echo '<div class="error">Your Account is blocked.</div><br/><div class="notice2" style="margin:0px 0px 10px 0;" ><span class="maroon">WARNING:</span> This platform and its contents and features belong to Aam Aadmi Party.<br />Any misuse or suspicious activity will be legally dealt with in the strongest possible manner.<br />If you feel you received this message in error, we sincerely apologize and would request you to contact the admin.</div>';}
?>
</div>
          </div>
        <div class="clearfix p5 hidden-phone" style="overflow:hidden;"></div>
          <div id="messages"> </div>
          <div class="form1 bg1">
            <form action="login.php?action=send" method="post" onSubmit="return validatelogin(this)">
              
                 <h1 class="mem hidden-desktop hidden-tablet">Member Login</h1>
             <div class="t-p10"></div>
             <label class="black-t font15">Email ID</label>
             <input type="text" value="<?php if(isset($_COOKIE['remember_me']))echo $_COOKIE['remember_me']; ?>" name="email" class="input" style="width:94%;">
              <div class="clearfix p5"></div>
             <label class="black-t font15">Password</label>
             <input type="password" value="<?php
if(isset($_COOKIE['key_my_site']))echo $_COOKIE['key_my_site']; ?>" name="password" class="input" style="width:94%;">
             
               <div class="clearfix t-p4">
             <label class="black-t font15 checkbox"><input type="checkbox" name="remember" style="width:auto" <?php if(isset($_COOKIE['remember_me'])) {
		echo 'checked="checked"';
	}
	 
	?>>  Remember Me</label> 
             </div>
              <div class="column-row clearfix">
                    <div class="column-2 mobile-t-c"><input type="submit" name="Submit2" class="button2" value="LOGIN"></div>
                    <div class="column-2 t-r t-b-p10 mobile-t-c"><a class="button2" href="forgot-password.php" style="background-color:#F60">Lost Password?</a></div>
              </div>
               <div class="clearfix p15"></div>
              <div class="clearfix t-c t-p10">
              <a class="regis" href="registration.php ">Register Here </a> 
              </div> 
              
               <div class="clearfix p10"></div>
             <div class="notice2" style="margin:0px 0px 10px 0;" ><span class="maroon">WARNING:</span> Any misuse of this system against the Aam Aadmi Party will be legally dealt with in the strongest possible manner. Your IP address has been recorded for security purposes.</div>
            </form>
          </div>
          <div class="clearfix p7"></div>
          <div class="clearfix l-r-p10 t-c hidden-desktop" align="center" >
<img src="../images/aap-logo.png" />
</div>
</div>
         <p align="center" ><br />
<strong class="red">NOTE: </strong>Please also join the <strong><a href="https://www.facebook.com/aapcalldelhi" target="_blank">AAP - Call Delhi</a></strong> Facebook group to get the latest information about the call campaign.</p>
        </div>


<?php include("includes/footer.php");?>
</body>
</html>
