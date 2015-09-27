<?php
include("includes/app_top.php");
$pcat="Website";
$pagetitle="Suggestions/Feedback";
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
        	<h3 class="title">Suggestions/Feedback</h3>
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
                             <th width="172">Email </th>
                             <th >Message</th>
                             <th width="140">Date Sent</th>
                             <th width="60">Status</th>
                          
                             <th width="70">Action</th>
                           </tr>
                           </thead>
						   <?php   
												 $sql="select * from volunteer where state_id=".$stateid."  order by datesent desc"; 
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
										   
										 /*  if($row['userid']!='' && $row['email']=='')
										   {
										   $query="update volunteer set email='" . return_field('users','id',$row['userid'],'email'). "' where id=".$row['id'];
 mysqli_query($mysqli, $query);

										   }*/
                                       ?>
                           <tr>
                             <td  width="41"><?php  echo $cnt; ?></td>
                             <td style="text-align:left"><?php echo $row['email']; ?> </td>
                             <td  ><?php echo ShortenText($row['message'],120); ?> </td>
							   <td style="text-align:left"><?php echo $row['datesent']; ?> </td>
                             <td><i class="pointer <?php echo ($row['status2'] != 0) ? 'icon-ok' : 'icon-ban-circle';?>" id="statusimg_<?php echo $row['id'];?>" onClick="change_status('volunteer','<?php echo $row['id'];?>');" title="change status"></i></td>
                             <td align="center"><a href="vmessage.php?id=<?php  echo $row['id']; ?>" class="details" rel="colorbox"><i class="icon-eye-open"></i></a>&nbsp;&nbsp;<a href="send-mail.php?fid=<?php echo $row['id'];?>"><i class="icon-envelope"></i>&nbsp;&nbsp;<?php echo "<a href=\"\" class='vntdelete' id=\"{$row['id']}\"><i class='icon-trash'></i></a>";?></td>
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
