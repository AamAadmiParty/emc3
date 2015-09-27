<?php
include("includes/app_top.php");
$pcat="Members";
$pagetitle="Referrals";
$getid = getid('id');
$mid = getid('mid');
checkAdminLogin();
checkState();
?>
<?php include("includes/styles.php");?>
<?php include("includes/colorbox.php");?>  
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
 <div class="pageHeadingBlock ">
        	<div class="grayBackground">
            <!--<div class="fR t-r p_b">
            <a href="export-members.php">Export Details to Excel</a>
            </div>-->
        	<h3 class="title">Referrals</h3>
            <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
        	</div>
        </div>
        
        <div class="clearfix sepH_b"></div>
        

        <?php 
				  if($page=="")
						  {
				$sql="
				SELECT `referrals`.`email`, referrals.userto as rto, (SELECT name FROM users WHERE rto!=0 and users.id=rto) AS uname, (SELECT COUNT(id) FROM referrals WHERE referrals.userfrom = rto) AS referralcount,(SELECT COUNT(id) FROM contacts WHERE contacts.userid = referrals.userto and referrals.userto!=0) AS contactscount FROM `referrals` left JOIN `users` ON `referrals`.`email` = `users`.`email` where referrals.userfrom=".$mid;
						 }						 
						 else
						 $sql=$_SESSION['sql'];
							//echo $sql;
				include("includes/paging2.php");   
				$res=mysqli_query($mysqli, $sql); 
			 
              ?>
        <table width="100%"  class="table table-hover  table_vam table-black">
                           <thead>
                           <tr>
                           	<th>No.</th>
                            <th>Email</th>
                            <th>Name</th>
                             <th>Calls</th>
                             <th>Reffered</th>
                             </tr>
                           </thead>
                           <?php 
                           if(mysqli_num_rows($res) == 0)
                                           {
                                       ?>
                                <tr>
                                  <td  class="norecords" colspan="5">No Referrals <?php if($action=="show")echo " with this filter";?></td>
                                </tr >
                                <?php  }  
								 while($row=mysqli_fetch_assoc($res))
                                           {  $cnt++;
                                       ?>
                           <tr>
                              
                             <td ><?php echo $cnt ?></td>
                            <td><?php echo $row['email'];?></td>
                            <td ><?php echo $row['uname'];?></td>
                            <td ><?php echo $row['contactscount'];?></td>
                            <td ><?php echo $row['referralcount'];?></td>
                           </tr>
                           <?php    } 										  
                                       ?>
                                       </table>    
									  <?php
include("includes/paging.php"); ?>             
	<?php include("includes/footer.php");?>
</body>
</html>
