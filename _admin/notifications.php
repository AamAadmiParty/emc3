<?php
include("includes/app_top.php");
$pcat="Members";
$pagetitle="Email Templates";

checkAdminLogin();
checkState();

$getid = getid('id');
?>
<?php include("includes/styles.php");?>  
<?php include("includes/colorbox.php");?>  
</head>
<body>
<?php include("includes/header.php");?> 
<?php include("includes/side-bar.php");?>
        <div class="pageHeadingBlock ">
        	<div class="grayBackground">
        	<div class="fR t-r spcT_c">
                	<a href="manage-notification.php" class="btn btn-small btn-primary coursesMenu">Add Email Templates</a>
                </div>
            <h3 class="title">Email Templates</h3>
            <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
        	</div>
        </div>
        
        <div class="clearfix sepH_b"></div>        
        <!-- account settings -->
        <div class="clearfix">
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
                             <th width="41"  >No.</th>
                             <th    >Heading</th>
                             
                             <th width="72">Preview</th>
                             <th width="42">Edit</th>
                             <th width="60">Delete</th>
                           </tr>
                           </thead>
						   <?php   
                                             $sql="select * from email_templates where state_id=".$stateid." order by datemodified desc"; 
											include("includes/paging2.php");  											 
                                            $result=mysqli_query($mysqli,$sql);		 
					  if(mysqli_num_rows($result) == 0)
                                           {
                                       ?>
                           <tr>
                             <td  class="norecords" colspan="5">No Templates</td>
                           </tr >
                           <?php  }
								  
                                         
                                           while($row=mysqli_fetch_assoc($result))
                                           {  $cnt++;
                                       ?>
                           <tr>
                             <td  width="41"><?php  echo $cnt; ?></td>
                             <td style="text-align:left"><?php echo $row['heading']; ?> </td>
                             
                             <td align="center"><a href="view-template.php?id=<?php  echo $row['id']; ?>" class="profile" rel="colorbox"><i class="icon-eye-open"></i></a></td>
                             <td align="center"><a href="manage-notification.php?id=<?php  echo $row['id']; ?>"><i class="icon-pencil"></i></a></td>
                             <td align="center"><?php echo "<a href=\"\" class='ntdelete' id=\"{$row['id']}\"><i class='icon-trash'></i></a>";?></td>
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
<?php include("includes/footer.php");?> 
</body>
</html>