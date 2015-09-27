<?php
include("includes/app_top.php");
$pcat="Miscellaneous";
$pagetitle="Reports";
$getid = getid('id');
checkAdminLogin();
checkState();?>
<?php include("includes/styles.php");?> 
<?php include("includes/colorbox.php");?> 
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
 <div class="pageHeadingBlock ">
        	<div class="grayBackground">
             
        	<h3 class="title">Reports</h3>
            <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
        	</div>
        </div>
        
        <div class="clearfix sepH_b"></div>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="34%"><b>User Registrations:</b><br />

		<?php 
$r1=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from users where state_id=".$stateid." and date(datecreated) ='".$date2. "'"));
$r2=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from users where state_id=".$stateid." and date(datecreated) ='".$date2. "' and status2=1"));
$r3=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from users where state_id=".$stateid." and date(datecreated) ='".$date2. "' and status2=0"));
$r4=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from users where state_id=".$stateid));
$r5=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from users where state_id=".$stateid." and status2=1"));
$r6=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from users where state_id=".$stateid." and status2=0"));
$r7=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from users where state_id=".$stateid." and status2=2"));
echo 'Total users Registered Today : '.$r1['cnt'];
echo '<br/>Total Active Registered users Today : '.$r2['cnt'];
echo '<br/>Total Inactive Registered users Today : '.$r3['cnt'];
echo '<br/><br/>Total users Registered : '.$r4['cnt'];
echo '<br/>Total Active Registered users  : '.$r5['cnt'];
echo '<br/>Total Inactive Registered users : '.$r6['cnt'];
echo '<br/>Total Blocked users : '.$r7['cnt'];
?></td>
    <td width="33%"><b>Contacts Called :</b><br />
<?php 
$r1=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=1  and userid !=0"));
$r2=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=0 and userid !=0 and iscalled=1"));
$r3=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=2 and userid !=0"));
$r4=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled=2"));
$r5=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled=3"));
$r6=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled=4"));
$r7=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled=5"));
echo 'Total Votes - Yes : '.$r1['cnt'];
echo '<br/>Total Votes - No : '.$r2['cnt'];
echo '<br/>Total Votes - Undecided :'.$r3['cnt'];
echo '<br/>Total Wrong Calls : '.$r4['cnt'];
echo '<br/>Total Not Reached Calls : '.$r6['cnt'];
echo '<br/>Total No Voter ID Calls: '.$r7['cnt'];
echo '<br/><br/>Total Calls Contacted : '. number_format($r1['cnt']+$r2['cnt']+$r3['cnt']+$r4['cnt']+$r6['cnt']+$r7['cnt']);
echo '<br/>Total Call Later : '.$r5['cnt'];
?></td>
   <td width="33%"><b>Today Contacts  Called :</b><br />
<?php 
$r1=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=1  and date(contactdate) ='".$date2. "' and userid !=0"));
$r2=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=0 and date(contactdate) ='".$date2. "' and userid !=0 and iscalled=1"));
$r3=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=2 and date(contactdate) ='".$date2. "' and userid !=0"));
$r4=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled=2 and date(contactdate) ='".$date2. "'"));
$r5=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled=3 and date(contactdate) ='".$date2. "'"));
$r6=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled=4 and date(contactdate) ='".$date2. "'"));
$r7=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled=5 and date(contactdate) ='".$date2. "'"));
echo 'Today Votes - Yes : '.$r1['cnt'];
echo '<br/>Today Votes - No : '.$r2['cnt'];
echo '<br/>Today Votes - Undecided :'.$r3['cnt'];
echo '<br/>Today Wrong Calls : '.$r4['cnt'];
echo '<br/>Today Not Reached Calls : '.$r6['cnt'];
echo '<br/>Today No Voter ID Calls: '.$r7['cnt'];
echo '<br/><br/>Today Calls Contacted : '. number_format($r1['cnt']+$r2['cnt']+$r3['cnt']+$r4['cnt']+$r6['cnt']+$r7['cnt']);
echo '<br/>Today Call Later : '.$r5['cnt'];
?></td>
  </tr>
</table>
   
<br />
 

<h2>Users Today Contacted Calls List (Top 50 users)</h2>
<?php $query="
SELECT
  count(`users`.`id`) as cnt, users.name,users.genuine, users.email, users.status2,  users.phone, `".$tablename."`.`userid`, concat(format((100*sum(if(".$tablename.".vote=1,1,0)))/sum(if(iscalled=1,1,0)),0),'/',format((100*sum(if(".$tablename.".vote=0,if(iscalled=1,1,0),0)))/sum(if(iscalled=1,1,0)),0),'/',format((100*sum(if(".$tablename.".vote=2,1,0)))/sum(if(iscalled=1,1,0)),0)) as votesplit, concat(format((100*sum(if(".$tablename.".iscalled=1,1,0)))/count(*),0),'/',format((100*sum(if(".$tablename.".iscalled>2,1,0)))/count(*),0),'/',format((100*sum(if(".$tablename.".iscalled=2,1,0)))/count(*),0)) as callsplit
FROM
  `users` INNER JOIN
  `".$tablename."` ON `".$tablename."`.`userid` = `users`.`id` where date(".$tablename.".contactdate) ='".$date2. "' GROUP BY
 `".$tablename."`.`userid` order by cnt desc limit 50";
		   				
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
        <th>User Name</th>
        <th width="120">Phone</th>
        <th >Email</th>
        <th width="150">No.of Contacts</th><th width="100">Vote Split</th><th width="100">Call Split</th>          <th width="50">Status</th>
           <th width="50">Genuine</th>
		</tr>
        </thead>
        <?php
						   $cnt=0;
								 while($row=mysqli_fetch_assoc($res))
                                           {  $cnt++;
                                       ?>
        <tr>
        	<td ><?php echo $cnt ?></td>
        	<td ><a href="view-member-details.php?id=<?php echo $row['userid'];?>"  class="details" rel="colorbox2"><?php echo $row['name']; ?></a></td>
            <td ><?php echo $row['phone'];?></td>
            <td ><?php echo $row['email'];?></td>
            <td align="center"><?php echo '<a href="day-contacts.php?mid='.$row['userid'].'">'.$row['cnt'].'</a>';?></td><td ><?php echo $row['votesplit'];?></td>
<td ><?php echo $row['callsplit'];?></td>
            <td ><i class="pointer <?php if($row['status2']==1)echo 'icon-ok';else if($row['status2']==0)echo 'icon-remove';else echo 'icon-ban-circle';?>" id="statusimg_<?php echo $row['userid'];?>" onClick="change_statusb('users','<?php echo $row['userid'];?>');" title="change status"></i></td>
             <td ><img src="<?php echo ($row['genuine'] != 0) ? '../images/ico_activate.gif' : '../images/ico_deactivate.gif';?>" alt="Status" title="Status" id="statusig_<?php echo $row['userid'];?>"  onClick="change_statusg('users','<?php echo $row['userid'];?>');" class="pointer"/></td> 
        </tr>
        <?php } ?>
    </table><?php }?>
    <br />   
    
<h2>Users Total Contacted Calls List (Top 50 users)</h2>
<?php $query="
SELECT
  count(`users`.`id`) as cnt, users.name,users.genuine, users.email, users.status2,  users.phone, `".$tablename."`.`userid`, concat(format((100*sum(if(".$tablename.".vote=1,1,0)))/sum(if(iscalled=1,1,0)),0),'/',format((100*sum(if(".$tablename.".vote=0,if(iscalled=1,1,0),0)))/sum(if(iscalled=1,1,0)),0),'/',format((100*sum(if(".$tablename.".vote=2,1,0)))/sum(if(iscalled=1,1,0)),0)) as votesplit, concat(format((100*sum(if(".$tablename.".iscalled=1,1,0)))/count(*),0),'/',format((100*sum(if(".$tablename.".iscalled>2,1,0)))/count(*),0),'/',format((100*sum(if(".$tablename.".iscalled=2,1,0)))/count(*),0)) as callsplit
FROM
  `users` INNER JOIN
  `".$tablename."` ON `".$tablename."`.`userid` = `users`.`id`  GROUP BY
 `".$tablename."`.`userid` order by cnt desc limit 50";
		   				
				$res=mysqli_query($mysqli, $query);
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
        <th >User Name</th>
        <th width="120">Phone</th>
        <th >Email</th>        
        <th width="150">No.of Contacts</th>
        <th width="100">Vote Split</th><th width="100">Call Split</th>          <th width="50">Status</th>
           <th width="50">Genuine</th>
		</tr>
        </thead>
        <?php
						   $cnt=0;
								 while($row=mysqli_fetch_assoc($res))
                                           {  $cnt++;
                                       ?>
        <tr>
        	<td ><?php echo $cnt ?></td>
        	<td ><a href="view-member-details.php?id=<?php echo $row['userid'];?>"  class="details" rel="colorbox3"><?php echo $row['name']; ?></a></td>
            <td ><?php echo $row['phone'];?></td>
            <td ><?php echo $row['email'];?>
            
            </td>
            <td align="center"><?php echo '<a href="day-contacts.php?mid='.$row['userid'].'">'.$row['cnt'].'</a>';?></td><td ><?php echo $row['votesplit'];?></td>
<td ><?php echo $row['callsplit'];?></td>
<td ><i class="pointer <?php if($row['status2']==1)echo 'icon-ok';else if($row['status2']==0)echo 'icon-remove';else echo 'icon-ban-circle';?>" id="statusimg_<?php echo $row['userid'];?>" onClick="change_statusb('users','<?php echo $row['userid'];?>');" title="change status"></i></td>			           
            <td ><img src="<?php echo ($row['genuine'] != 0) ? '../images/ico_activate.gif' : '../images/ico_deactivate.gif';?>" alt="Status" title="Status" id="statusig_<?php echo $row['userid'];?>"  onClick="change_statusg('users','<?php echo $row['userid'];?>');" class="pointer"/></td> 
        </tr>
        <?php } ?>
    </table><?php }?>
    <br /> 
<h2>Contacts Categorys</h2>

<?php $query="
SELECT
  count(`".$tablename."`.`id`) as cnt, categories.catname, `".$tablename."`.`catid`, (select count(id) from ".$tablename." as sc where sc.catid=".$tablename.".catid and sc.userid!=0 and iscalled!=0) as ucount 
FROM
  `".$tablename."`  LEFT JOIN
  `categories` ON `".$tablename."`.`catid` = `categories`.`id`  GROUP BY
 `".$tablename."`.`catid` order by categories.id desc";		
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
