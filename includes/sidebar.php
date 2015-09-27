</div>
 <div id="right-sidebar">
   <div class="sidebar-inner" style="text-align:center; padding:0px 10px; display:none">
    <a href="http://www.uaeexchange.com/usa/" target="_blank"><img src="pictures/sponsors/moneydart.png" alt="Moneydart" height="50"/></a></div>

            <div class="sidebar-inner">   
                <h3>Sponsors</h3>
<div class="sponsors">                
              <?php 
$query2="select * from sponsors where catid=3 and status2=1 order by orderno"; 
				$result2=mysqli_query($mysqli, $query2);
$total=mysqli_num_rows($result2); ?>
 <script type="text/javascript" src="js/sponsors.js"></script>
        <script type="text/javascript"> 
				var pausecontent=new Array();
<?php $cnt=0;$cnt2=0;
					while ($row2 = mysqli_fetch_assoc($result2))
                     {
					 if($cnt2==0)$s="<ul>";
					 $cnt2++; 
					 $imagesrc = "pictures/sponsors/". $row2['logo'];
											if (!file_exists($imagesrc)||$row2['logo']=="") 
											$imagesrc="pictures/sponsors/noimage.jpg";
											$s=$s.'<li><a href="'.$row2['url'].'" target="'.$row2['target'].'"><img src="'.$imagesrc.'" alt="'.$row2['clientname'].'"  width="214" height="95" /></a></li>';
											if($cnt2==2)
											{ $cnt2=0;
											$s=$s."</ul>";
											if($total>2)
											echo '
pausecontent['.$cnt.']=\''.$s.'\'';
$cnt++;
											}}
											if($cnt2!=0 && $total>2)
											{ 
											echo '
											pausecontent['.$cnt.']=\''.$s.'</ul>\'';
											}
									if($total>2){
					 ?>			
										//new pausescroller(name_of_message_array, CSS_ID, CSS_classname, pause_in_miliseconds)
										new pausescroller(pausecontent, "pscroller", "someclass", 5000)
										<?php }?>
									</script>
                                    <?php if($total<2)
											echo $s.'</ul>';
											else if($total==2)echo $s;
											?> 
</div></div>   
    <?php if(!isset($_SESSION['user'])){?> 
               <div class="sidebar-inner"  >
                 <h3 style="text-transform:none"> Member Login</h3>
                <form method="post" action="login.php?action=send" onSubmit="return validatelogin(this)">
   <table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="right"> 
    Email ID:   </td>
    <td><input type="text" name="email" id="email"  value="" style="width:130px"  autocomplete="off"/></td>
  </tr>
  <tr>
    <td align="right">Password:</td>
    <td><input type="password" name="password" value="" style="width:130px" autocomplete="off" /></td>
  </tr>
  
  <tr>
    <td align="right">&nbsp;</td>
    <td><input type="submit" name="submit" class="button2" value="Login" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="font-size:13px"><a href="forgot-password.php">Forgot Password?</a><br />
<a href="membership.php">Need a userID? Register today</a></td>
    </tr>
</table>
<a href="forgot-password.php"></a>
                </form>
                </div>				
				<?php } else {  
			 
$query2="select * from events where eventdate>='$date' and registration_enddate>='$date' and showlink=1 and registration_url!='' order by eventdate"; 
				$result2=mysqli_query($mysqli, $query2);
				while ($row2 = mysqli_fetch_assoc($result2))
                     {
?>
             <div class="joinmail2">
                 <a href="<?php echo $row2['registration_url'];?>" style="text-align:center; "><?php echo $row2['heading'];?> Registration</a> 
                </div>
                <?php }?>
                <div class="sidebar-inner">
               
                <?php 
				 $picture2="pictures/members/".$_SESSION['userid']."_thumb.jpg";
				if (!file_exists($picture2)) 
				  $picture2="pictures/members/noimage.jpg";?>
                  <img src="<?php echo $picture2;?>" width="150" height="160" alt="<?php echo $_SESSION['user'];?>" />
                 <h3>Hi <?php echo $_SESSION['user'];?>!</h3>
              <ul>
<li><a href="view-profile.php" title="Profile">View Profile</a></li>
<li><a href="edit-profile.php" title="Profile">Edit Profile</a></li>
 <li><a href="profile-picture.php" class="profile" rel="colorbox">Add/Edit Profile Picture</a></li>
<li><a href="family.php" title="Family">Manage Family Details</a></li>
<li><a href="renewal-membership.php" title="Family">Renewal Membership</a></li>
<li><a href="membership-details.php" title="Membership Details">Membership Details</a></li>
<li><a href="change-password.php" title="Change Password">Change Password</a></li>
                <li><a href="logout.php" title="Logout">Logout</a></li>
               </ul> </div>
               <?php }?> 
               <div class="joinmail" style="margin-top:10px">
                 <a href="contactus.php" style="color:#000000"><img src="images/message-box.png" /> Join Mailing List</a> 
                </div>
                 <div class="sidebar-inner1" style="margin:0; ">
                <h3 style="color:#FF6600; text-transform:none"><b>Follow Us on</b></h3>
                <ul> 
                <li><a href="<?php echo ($yahoourl!='' && $yahoourl!='#')?$yahoourl.'" target="_blank':'#';?>" title="Yahoo" class="yahoo">&nbsp;</a></li>
                 <li><a href="<?php echo ($twitterurl!='' && $twitterurl!='#')?$twitterurl.'" target="_blank':'#';?>" title="Twitter" class="twitter">&nbsp;</a></li> 
                 <li><a href="<?php echo ($facebookurl!='' && $facebookurl!='#')?$facebookurl.'" target="_blank':'#';?>" title="Facebook" class="facebook">&nbsp;</a>  </li>              
                 <li><a href="<?php echo ($youtubeurl!='' && $youtubeurl!='#')?$youtubeurl.'" target="_blank':'#';?>" title="Youtube" class="youtube">&nbsp;</a>  </li>              
                 <li><a href="<?php echo ($linkedinurl!='' && $linkedinurl!='#')?$linkedinurl.'" target="_blank':'#';?>" title="LinkedIn" class="linkedin">&nbsp;</a>  </li>              
                 </ul>
                 </div>  
           

               

 <div class="sidebar-inner">
                <h3>Media Partners</h3>
<div class="sponsors">                
              <?php 
$query2="select * from sponsors where catid=4 and status2=1 order by orderno"; 
				$result2=mysqli_query($mysqli, $query2);
$total=mysqli_num_rows($result2); ?>
        <script type="text/javascript"> 
				var pausecontent2=new Array();
<?php $cnt=0;$cnt2=0;
					while ($row2 = mysqli_fetch_assoc($result2))
                     {
					 if($cnt2==0)$s="<ul>";
					 $cnt2++; 
					 $imagesrc = "pictures/sponsors/". $row2['logo'];
											if (!file_exists($imagesrc)||$row2['logo']=="") 
											$imagesrc="pictures/sponsors/noimage.jpg";
											$s=$s.'<li><a href="'.$row2['url'].'" target="'.$row2['target'].'"><img src="'.$imagesrc.'" alt="'.$row2['clientname'].'"  width="214" height="95" /></a></li>';
											if($cnt2==1)
											{ $cnt2=0;
											$s=$s."</ul>";
											if($total>1)
											echo '
pausecontent2['.$cnt.']=\''.$s.'\'';
$cnt++;
											}}
											if($cnt2!=0 && $total>1)
											{ 
											echo '
											pausecontent2['.$cnt.']=\''.$s.'</ul>\'';
											}
									if($total>1){
					 ?>			
										//new pausescroller(name_of_message_array, CSS_ID, CSS_classname, pause_in_miliseconds)
										new pausescroller2(pausecontent2, "pscroller2", "someclass", 5000)
										<?php }?>
									</script>
                                    <?php if($total<2)
											echo $s.'</ul>';
											else if($total==1)echo $s;
											?> 
</div></div>
   <a href="donate.php"><img src="images/donate.jpg" alt="Donate"  style="margin-top:10px;"/></a> 
</div>
            <div class="clear"></div>