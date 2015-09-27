<?php
include("includes/app_top.php");
$pcat="Website";
$pagetitle="Report Problem";
$getid = getid('id');
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
        	<h3 class="title">Report Problem</h3>
            <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
        	</div>
        </div>
        
        <div class="clearfix sepH_b"></div>
 		<div class="clearfix sepH_b"></div>        
        <!-- account settings -->
        <div class="clearfix">
        <div id="messages"><?php if($action1=="success") { echo '<div class="alert alert-success"></div>';}
			 
			  if($action1=="success4") { echo '<div class="alert alert-success">Deleted Selected Members.</div>';}
			  if($action1=="success6") { echo '<div class="alert alert-success">Updated Status Successfully</div>';}
			if($action1=="update") { echo '<div class="alert alert-success">Updated Member status.</div>';}
?></div>
        <div class="listView">

                                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="txt9">
                       <tr>
                       <td style="padding-top:10px"><div id="messages"><?php
if($action1=="err") { echo '<div class="error">Something Error. </div>';}?></div></td>
                     </tr> 
                     <tr>
                       <td><table width="100%" class="table table-hover  table_vam table-black">
                           <thead>
                           <tr>
                             <th >No.</th>
                             <th>Person Name</th>
                             <th width="150">Date Sent</th>
                             <th width="72">View</th>
                             <th width="72">Status</th>
                             <th width="72">Mail</th>
                             <th width="60">Delete</th>
                           </tr>
                           </thead>
						   <?php   
												 $sql="SELECT
	  `users`.`id`, `problems`.*, `users`.`name`
	FROM
	  `problems` INNER JOIN
	  `users` ON `users`.`id` = `problems`.`userid` where `problems`.state_id=".$stateid; 
											include("includes/paging2.php");  											 
                                            $result=mysqli_query($mysqli,$sql);	
											//echo $sql; 
					  if(mysqli_num_rows($result) == 0)
                                           {
                                       ?>
                           <tr>
                             <td  class="norecords" colspan="6">No Reports</td>
                           </tr >
                           <?php  }
								  
                                         
                                           while($row=mysqli_fetch_assoc($result))
                                           {  $cnt++;
                                       ?>
                           <tr>
                             <td  width="41"><?php  echo $cnt; ?></td>
                             <td style="text-align:left"><?php echo $row['name']; ?> </td>
                             <td style="text-align:left"><?php echo $row['datesent']; ?> </td>
                             <td align="center"><a href="problem.php?id=<?php  echo $row['id']; ?>" class="details" rel="colorbox"><i class="icon-eye-open"></i></a></td>
                             <td><i class="pointer <?php echo ($row['status2'] != 0) ? 'icon-ok' : 'icon-ban-circle';?>" id="statusimg_<?php echo $row['id'];?>" onClick="change_status('problems','<?php echo $row['id'];?>');" title="change status"></i></td>
                              <td align="center"><a href="send-mail.php?mid=<?php echo $row['userid'];?>" ><i class="icon-envelope"></i></td>
                             <td align="center"><?php echo "<a href=\"\" class='prbdelete' id=\"{$row['id']}\"><i class='icon-trash'></i></a>";?></td>
                           </tr>
                           <?php    } 										  
                                       ?>
                       </table></td>
                     </tr>
                     <tr>
                       <td style="padding:10px 0"><?php
include("includes/paging.php"); ?>
                       </td>
                     </tr>
                   
                   </table> 
                   </div>
	<?php include("includes/footer.php");?>
</body>
</html>
