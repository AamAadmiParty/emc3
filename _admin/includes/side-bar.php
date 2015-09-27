<div id="sidepanel">
    <div class="sidebar">
		<div class="sidebar_inner">
        	<ul class="nav nav-list submenu">
           
                <li><span class="groupHeading">SETTINGS</span></li>
                <li><a href="profile.php">Profile</a></li>
                <?php if(stristr($_SESSION['access'],"a")){ ?>
                <li><a href="admins.php">Admins</a></li>
                <li><a href="states.php">States</a></li>
                <li><a href="global-statistics.php">Global Stats</a></li>
                <li><a href="feedbacks.php">Feedbacks / Suggetions </a></li>
                <?php }?>  
                <?php if(!stristr($_SESSION['access'],"a")){ ?>
                <li><a href="suggestion.php">Feedbacks to Admin</a></li>
                <?php }?>  
                <li><a href="change-password.php">Change Password</a></li>
            </ul>
            <br />
<br />
<br />
 Copyrights &copy; <a href="../index.php" target="_blank">Citizen Call Campaign</a>. <br />
Developed by <a href="http://arjunweb.com" target="_blank">Arjun web</a>.

		</div>
	</div>
	</div>