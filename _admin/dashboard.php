<?php
include("includes/app_top.php");
$pcat="Website";
$pagetitle="Dashboard";
$getid = getid('id');
checkAdminLogin();
checkState();
?>
<?php include("includes/styles.php");?> 
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
 <div class="pageHeadingBlock ">
        	<div class="grayBackground">
        	<h3 class="title"><?php echo $pagetitle;?></h3>
        	</div>
        </div>
        
        <div class="clearfix sepH_b"></div>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%"><b>User Registrations:</b><br />

		<?php 
$r1=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from users where date(datecreated) ='".$date2. "'"));
$r2=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from users where date(datecreated) ='".$date2. "' and status2=1"));
$r3=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from users where date(datecreated) ='".$date2. "' and status2=0"));
$r4=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from users"));
$r5=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from users where status2=1"));
$r6=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from users where status2=0"));
$r7=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from users where status2=2"));
echo 'Total users Registered Today : '.$r1['cnt'];
echo '<br/>Total Active Registered users Today : '.$r2['cnt'];
echo '<br/>Total Inactive Registered users Today : '.$r3['cnt'];
echo '<br/><br/>Total users Registered : '.$r4['cnt'];
echo '<br/>Total Active Registered users  : '.$r5['cnt'];
echo '<br/>Total Inactive Registered users : '.$r6['cnt'];
echo '<br/>Total Blocked users : '.$r7['cnt'];
?></td>
    <td><b>Contacts Called :</b><br />
<?php 
$r1=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from contacts where vote=1 and userid !=0"));
$r2=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from contacts where vote=0 and userid !=0"));
$r3=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from contacts where vote=2 and userid !=0"));
$r4=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from contacts where userid!=0"));
$r5=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from contacts where iscalled=3"));
$r6=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from contacts where iscalled=2"));
$r7=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from contacts where iscalled=4"));
echo 'Total Votes - Yes : '.$r1['cnt'];
echo '<br/>Total Votes - No : '.$r2['cnt'];
echo '<br/>Total Votes - Undecided :'.$r3['cnt'];
echo '<br/><br/>Total Calls Contacted : '.$r4['cnt'];
echo '<br/>Total Call Later : '.$r5['cnt'];
echo '<br/>Total Wrong Calls : '.$r6['cnt'];
echo '<br/>Total Not Reached Calls : '.$r7['cnt'];
?></td>
  </tr>
</table>
   
<br />
 
<h2>Users Total Contacted Calls List (Top 50 users)</h2>
<?php $query="
SELECT
  count(`users`.`id`) as cnt, users.name, `contacts`.`userid`
FROM
  `users` INNER JOIN
  `contacts` ON `contacts`.`userid` = `users`.`id`  GROUP BY
 `contacts`.`userid` order by cnt desc limit 50";		
		   				
				$res=mysqli_query($mysqli, $query);
				//echo $query;
				$count
				
			 ?>
  
         <?php 
		   if(mysqli_num_rows($res) == 0)
                                           {
                                       ?>
                               <p class="norecords">No Contacts taken</p>
                                <?php  }
								else
								{ ?>
									 <table class="table table-hover  table_vam table-black" width="400">
    	<thead>
        <tr>
        <th width="50">S.no</th>
        <th width="800">User Name</th>
        <th width="150">No.of Contacts</th>
		</tr>
        </thead>
        <?php
						   $cnt=0;
								 while($row=mysqli_fetch_assoc($res))
                                           {  $cnt++;
                                       ?>
        <tr>
        	<td ><?php echo $cnt ?></td>
        	<td ><?php echo $row['name'];?></td>
            <td align="center"><?php echo $row['cnt'];?></td>
            
        </tr>
        <?php } ?>
    </table><?php }?>
    <br />

<h2>Users Today Contacted Calls List (Top 20 users)</h2>
<?php $query="
SELECT
  count(`users`.`id`) as cnt, users.name, `contacts`.`userid`
FROM
  `users` INNER JOIN
  `contacts` ON `contacts`.`userid` = `users`.`id` where date(contacts.contactdate) ='".$date2. "' GROUP BY
 `contacts`.`userid` order by cnt desc limit 20";		
		   				
				$res=mysqli_query($mysqli, $query); 
			 
			 ?>
  
         <?php 
		   if(mysqli_num_rows($res) == 0)
                                           {
                                       ?>
                               <p class="norecords">No Users Call Contacts today.</p>
                                <?php  }
								else
								{ ?>
									 <table class="table table-hover  table_vam table-black" width="400">
    	<thead>
        <tr>
        <th width="50">S.no</th>
        <th width="800">User Name</th>
        <th width="150">No.of Contacts</th>
		</tr>
        </thead>
        <?php
						   $cnt=0;
								 while($row=mysqli_fetch_assoc($res))
                                           {  $cnt++;
                                       ?>
        <tr>
        	<td ><?php echo $cnt ?></td>
        	<td ><?php echo $row['name'];?></td>
            <td align="center"><?php echo $row['cnt'];?></td>
            
        </tr>
        <?php } ?>
    </table><?php }?>
    <br />    
<h2>Contacts Categorys</h2>

<?php $query="
SELECT
  count(`contacts`.`id`) as cnt, categories.catname, `contacts`.`catid`, (select count(id) from contacts as sc where sc.catid=contacts.catid and sc.userid!=0) as ucount 
FROM
  `contacts`  LEFT JOIN
  `categories` ON `contacts`.`catid` = `categories`.`id`  GROUP BY
 `contacts`.`catid` order by categories.id desc";		
		   		//echo $query;		
				$res=mysqli_query($mysqli, $query);
				$count
				
			 ?>
  
         <?php 
		   if(mysqli_num_rows($res) == 0)
                                           {
                                       ?>
                               <p class="norecords">No Contacts</p>
                                <?php  }
								else
								{ ?>
									 <table class="table table-hover  table_vam table-black" width="500">
    	<thead>
        <tr>
        <th>S.no</th>
        <th>Contacts Category Name</th>
        <th>Total Contacts</th>
        <th>Called Contacts</th>
		</tr>
        </thead>
		<?php
						   $cnt=0;
								 while($row=mysqli_fetch_assoc($res))
                                           {  $cnt++;
                                       ?>
        <tr>
        	<td width="35"><?php echo $cnt ?></td>
        	<td width="200"><?php echo $row['catname'];?></td>
            <td  ><?php echo $row['cnt'];?></td>
            <td  ><?php echo $row['ucount'];?></td>
            
        </tr>
        <?php } ?>
    </table><?php }?>
	<?php include("includes/footer.php");?>
</body>
</html>
