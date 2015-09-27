<?php include("includes/app_top.php");

checkUserLogin();
?>
<?php include("includes/styles.php");?>
<?php include("../includes/colorbox.php");?>
</head>
<body>
 <?php include("includes/header.php");?> 
            <div class="division-1">
           <h1>Referrals</h1>    
           <div class="overflow_x-a clearfix"  >               
			<?php 
			$query="select * from referrals where userto=0 and userfrom=".$_SESSION["userid"]; 			
		   		$res=mysqli_query($mysqli, $query); 
					if(mysqli_num_rows($res)>0)
					{
				 while($row=mysqli_fetch_assoc($res))
                     { 
					 $uid=return_field('users','email',$row['email'],'id');
					 if($uid!='')
					 {
					 $query2="update referrals set userto=".$uid." where id=".$row['id'];
						mysqli_query($mysqli, $query2);	
					 }
					 }
					}
			$query="SELECT `referrals`.`email`,`referrals`.`id`, referrals.userto as rto, (SELECT name FROM users WHERE rto!=0 and users.id=rto) AS uname, (SELECT COUNT(id) FROM referrals WHERE referrals.userfrom = rto) AS referralcount,(SELECT COUNT(id) FROM  ".$tablename."   WHERE contacts.userid = referrals.userto and referrals.userto!=0) AS contactscount FROM `referrals` left JOIN `users` ON `referrals`.`email` = `users`.`email` where referrals.userfrom=".$_SESSION["userid"]; 	
					
		   		$res=mysqli_query($mysqli, $query);  
			if(mysqli_num_rows($res) == 0)
                                           {
                                       ?>
                               <p class="norecords">You hadn't reffered any one!!</p>
                                <?php  }
								else
								{ ?>
									 <table class="tblclass" width="100%">
    	<tr>
        <th width="45">S.no</th>
        <th>Email</th>
        <th width="157">Name</th>
		<th width="70">Calls</th>
        <th width="70">Reffered</th>
        <th width="90">Send Message</th>
        
        </tr>
        <?php
						   $cnt=0;
								 while($row=mysqli_fetch_assoc($res))
                                           {  $cnt++;
                                       ?>
        <tr>
        	<td ><?php echo $cnt ?></td>
        	<td><?php echo $row['email'];?></td>
            <td ><?php echo $row['uname'];?></td>
            <td ><?php echo $row['contactscount'];?></td>
            <td ><?php echo $row['referralcount'];?></td>
            <td ><a href="send-message.php?eid=<?php echo $row['id']; ?>" class="report1"><img src="../images/email.png" alt="Send mail" title="Send mail" /></a></td>
        </tr>
        <?php } ?>
    </table><?php }?>
    <?php 
	$query="SELECT `referrals`.`email`,`referrals`.`id`, referrals.userfrom as rto, (SELECT name FROM users WHERE rto!=0 and users.id=rto) AS uname FROM `referrals` left JOIN `users` ON `referrals`.`userfrom` = `users`.`id` where referrals.userto=".$_SESSION["userid"]." limit 1"; 
		   		$res=mysqli_query($mysqli, $query);  
			if(mysqli_num_rows($res)>0)
			{
				$row2=mysqli_fetch_assoc($res);				
			?>
            <p>Send Message to <a href="send-message.php?eid2=<?php echo $row2['rto']; ?>" class="report1"><?php echo $row2['uname'];?></a></p>
            <?php }?>
</div></div>
 <?php include("includes/footer.php");?>           
           </body>
</html>
