<?php 
if(isset($_SESSION['stateid']))
{
$stateid=$_SESSION['stateid'];
$tablename=return_field('states','id',$stateid,'tablename');
$sitename=return_field('states','id',$stateid,'sitename');
$name=return_field('states','id',$stateid,'name');
}
if(isset($pcat))
{
if($pcat=="Website")
{
$tab_website='<div class="btn-group">';

					$tab_website=$tab_website.'<a href="innerpages.php" class="btn';
					if($pagetitle=='Inner Pages') $tab_website=$tab_website.' active';
					$tab_website=$tab_website.'">Inner Pages</a>';

					$tab_website=$tab_website.'<a href="report-problem.php" class="btn';
					 if($pagetitle=='Report Problem') $tab_website=$tab_website.' active';
					 $tab_website=$tab_website.'">Report Problem</a>';

					$tab_website=$tab_website.'<a href="volunteers.php" class="btn';
					 if($pagetitle=='Suggestions/Feedback') $tab_website=$tab_website.' active';
					 $tab_website=$tab_website.'">Suggestions/Feedback</a>';

					$tab_website=$tab_website.'<a href="faqs.php" class="btn';
					 if($pagetitle=='FAQS') $tab_website=$tab_website.' active';
					 $tab_website=$tab_website.'">FAQS</a>';

}
else if($pcat=="Members")
{
$tab_website='<div class="btn-group">';
					$tab_website=$tab_website.'<a href="members.php" class="btn';
					if($pagetitle=='Members') $tab_website=$tab_website.' active';
						$tab_website=$tab_website.'">Members</a>';
					$tab_website=$tab_website.'<a href="day-contacts.php" class="btn';
					if($pagetitle=='Day Contacts') $tab_website=$tab_website.' active';
						$tab_website=$tab_website.'">Day Contacts</a>';
					$tab_website=$tab_website.'<a href="notifications.php" class="btn';
						if($pagetitle=='Email Templates') $tab_website=$tab_website.' active';						
					$tab_website=$tab_website.'">Email Templates</a></div>';
}
else if($pcat=="OtherContacts")
{
$tab_website='<div class="btn-group">';
					$tab_website=$tab_website.'<a href="users-other-contacts.php" class="btn';
					if($pagetitle=='Users Contacts') $tab_website=$tab_website.' active';
						$tab_website=$tab_website.'">Users Contacts</a></div>';
}
else if($pcat=="Miscellaneous")
{
$tab_website='<div class="btn-group">';
					$tab_website=$tab_website.'<a href="statistics.php" class="btn';
					if($pagetitle=='Statistics') $tab_website=$tab_website.' active';
						$tab_website=$tab_website.'">Statistics</a>';
					$tab_website=$tab_website.'<a href="reports.php" class="btn';
					if($pagetitle=='Reports') $tab_website=$tab_website.' active';
						$tab_website=$tab_website.'">Reports</a>';
					$tab_website=$tab_website.'<a href="daily-reports.php" class="btn';
					if($pagetitle=='Daily Reports') $tab_website=$tab_website.' active';
						$tab_website=$tab_website.'">Daily Reports</a>';
$tab_website=$tab_website.'<a href="news.php" class="btn';
					if($pagetitle=='News') $tab_website=$tab_website.' active';
						$tab_website=$tab_website.'">News</a>';
				$tab_website=$tab_website.'<a href="other-contacts.php" class="btn';
					if($pagetitle=='Other Contacts') $tab_website=$tab_website.' active';
						$tab_website=$tab_website.'">Other Contacts</a>';
						$tab_website=$tab_website.'<a href="settings.php" class="btn';
					if($pagetitle=='Settings') $tab_website=$tab_website.' active';
						$tab_website=$tab_website.'">Settings</a>';
						$tab_website=$tab_website.'<a href="users-other-contacts.php" class="btn';
					if($pagetitle=='Users Contacts') $tab_website=$tab_website.' active';
						$tab_website=$tab_website.'">Users Contacts</a></div>';

}
else if($pcat=="Contacts")
{
$tab_website='<div class="btn-group">';
					$tab_website=$tab_website.'<a href="contacts.php?t=0" class="btn';
					if(isset($t)&&$t==0 && $pagetitle=='Not Contacted' ) $tab_website=$tab_website.' active';
						$tab_website=$tab_website.'">Not Contacted</a>';
					$tab_website=$tab_website.'<a href="contacts.php?t=1" class="btn';
					if(isset($t)&&$t==1) $tab_website=$tab_website.' active';
						$tab_website=$tab_website.'">Contacted</a>';
					$tab_website=$tab_website.'<a href="will-volunteer.php" class="btn';
					if($pagetitle=='Will Volunteer') $tab_website=$tab_website.' active';
						$tab_website=$tab_website.'">Will Volunteer</a>';
					$tab_website=$tab_website.'<a href="call-later.php" class="btn';
					if($pagetitle=='Call Later') $tab_website=$tab_website.' active';
						$tab_website=$tab_website.'">Call Later</a>';
					$tab_website=$tab_website.'<a href="blocked.php" class="btn';
					if($pagetitle=='Blocked') $tab_website=$tab_website.' active';
						$tab_website=$tab_website.'">Blocked</a>';
					$tab_website=$tab_website.'<a href="categories.php" class="btn';
						if($pagetitle=='Categories') $tab_website=$tab_website.' active';						
					$tab_website=$tab_website.'">Categories</a></div>';
					}
}				  
?>
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a href="index.php"><img src="../images/logo.png" alt="<?php echo $sitename;?>"/></a>
          <div class="userMenuBlock ">
              <div id="dd" class="wrapper-dropdown-3" >
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <?php echo $_SESSION['admin'];?> <b class="caret"></b></a>
                                    <ul class="dropdown">
										<li><a href="profile.php"><i class="icon-user"></i> My Profile</a></li>
										<li><a href="settings.php"><i class="icon-cog"></i> Settings</a></li>
										<li class="divider"></li>
										<li><a href="logout.php"><i class="icon-off"></i> Log Out</a></li>
                                    </ul>
                                </div>
            </div>
         </div>
      </div>
      
      <!-- breadcumb -->
        <ul class="breadcrumb">
          <li><a href="index.php">Home</a> <span class="divider">/</span></li>
          <?php if(isset($stateid) && isset($pcat)) {;?><li class="active"><?php echo $name;?><span class="divider">/</span></li><?php }?>
          <?php if(isset($pcat)) {;?><li><a href="#"><?php echo $pcat;?></a> <span class="divider">/</span></li><?php }?>
           <?php if(isset($pagetitle)) {;?><li class="active"><?php echo $pagetitle;?></li><?php }?>
           <?php if(isset($sitename)){;?>
          <li class="fR sepV_c"><i class="icon-globe"></i> <a href="../<?php echo $sitename;?>/index.php" target="_blank">View Mainsite</a></li>
          <?php }?>
        </ul><!-- end breadcumb -->
        
    </div>
    <div id="maincontainer">
        <div class="mainContent clearfix">
		<?php if((isset($pcat))&&(isset($pagetitle))!=''){?>
        <div class="tabNavWrapper">
        	<ul>
            	<li><a href="innerpages.php" <?php if($pcat=="Website") echo 'class="active"';?>>Website</a></li>
               <li><a href="members.php" <?php if($pcat=="Members") echo 'class="active"';?>>Members</a></li>
              <li><a href="contacts.php" <?php if($pcat=="Contacts") echo 'class="active"';?>>Contacts</a></li>
             <li><a href="reports.php" <?php if($pcat=="Miscellaneous") echo 'class="active"';?>>Miscellaneous</a></li>
            </ul>
        </div>
        <?php } else {?>
		<div class="tabNavWrapper">
        	<ul>
            	<li><a href="#" <?php if($stcat=="Admin") echo 'class="active"';?>>Admin</a></li>
                </ul>
                </div>
                <?php } ?>