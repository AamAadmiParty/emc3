<?php
include("includes/app_top.php");
if(isset($_SESSION['admin']))
{
if(stristr($_SESSION['access'],"a"))
  tep_redirect('states.php');
else
{

  tep_redirect("profile.php");
}  
}

if($action=='send')
{
//pN$sm13
$uname = cleanQuery($_POST['username']);
$pwd = $_POST['password'];
$pwd2=sha1($pwd);
$sql= "select * from admins where username='".$uname."' and password='".$pwd2."'"; 
//echo $sql;
        $res= mysqli_query($mysqli, $sql);
        $row= mysqli_fetch_assoc($res);
		if(mysqli_num_rows($res) == 0)		
      {
		 tep_redirect(tep_href_link($pagename,'action1=err'));
       } 
else if($row['status2']==0)	   
      {
		 tep_redirect(tep_href_link($pagename,'action1=err1'));
       } 
else
    {		 				
          $_SESSION["admin"]=$row['username'];
          $_SESSION["adminid"]=$row['id'];	
		  $_SESSION['email']=$row['email'];
		  $_SESSION['access']=$row['access'];
	 
		  $query = "update admins set lastlogin= '". $date."' where id=".$row['id'];
		  $update_sql = mysqli_query($mysqli, $query) or die(mysqli_error());

      if(stristr($_SESSION['access'],"a"))
  tep_redirect('states.php');
else
{
$stateid=return_field('states','access',$row['access'],'id');
$_SESSION['stateid']=$stateid;
tep_redirect("innerpages.php");
}  
}
}
?>


		<?php include("includes/styles.php"); ?>
	</head>
	<body >

<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
         <a href="index.php"><img src="../images/logo.png" alt="<?php echo $sitename;?>"/></a>
        </div>
      </div>
    </div>
    <div class="clear"></div>
		<div class="loginWrapper">	
           
           <div class="loginContent">
                <!-- login form -->
                <div class="loginSection clearfix">
                
                    <form action="login.php?action=send" method="post" class="form login_form marginTop30" id="frmLogin">
                    <input type="hidden" name="login_user" value="1" />
                        <div class="row-fluid">
                            <label>User Name</label>
                            <input type="text" class="span12 text text_medium"  name="username" id="username" value=""  />
                         </div>
                         <div class="row-fluid">
                             <label>Password</label>
                             <input class="span12 text text_medium" type="password" name="password" id="password" value="" />
                        </div>
                        <div class="actionBlock clearfix">
                             <div class="formActionButton">
                            <input type="submit" class="button button_login btn btn-primary" value="Login" />
                            </div> 
                        </div>
                        
                        
                    </form>
                    <div class="clearfix"></div>
                      <div style="float:right"><br />
<a href="../index.php" target="_blank" style="color:#999"><?php echo $sitename;?></a></div>
<div class="clearfix"></div>
<div id="messages"><?php
if($action1=="err1") { echo '<div class="alert alert-info">Please contact admin to active your account.</div>';}
if($action1=="err") { echo '<div class="alert alert-danger">Invalid username or password.</div>';}
?>
                </div>
                
                <!-- end login form --> 
              
           </div>
                
        
        </div>
		</div>
		
	</body>
</html>