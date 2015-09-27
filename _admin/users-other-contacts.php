<?php
include("includes/app_top.php");
$pcat="Miscellaneous";
$getid = getid('id');
checkAdminLogin();
checkState();
$pagetitle="Users Contacts";	

?>
<?php include("includes/styles.php");?> 
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/colorbox.php");?>  
<?php include("includes/side-bar.php");?>
 <div class="pageHeadingBlock ">
        	<div class="grayBackground">
             
        	<h3 class="title"><?php echo $pagetitle;?></h3>
            <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
        	</div>
        </div>
        <div class="clearfix sepH_b"></div>
 <div id="messages"></div>
        <div class="grayBackground nobL nobR">
        
        <div id="filterReg" class="ui-accordion">
	    <h4><b>Filter Registrations</b></h4>
	    <div>
		<div class="filedsetInner clearfix">
               
                    <div class="row-fluid">
                    <form name="search" method="post" action="<?php echo $pagename;?>?action=show" onSubmit="return validatefilter(this)" class="coursesMenu">
                        	<div class="span3"><?php if($action=="show")
						  { $keyword=cleanQuery($_POST['keyword']); } else {  $keyword="";}
						  ?>
                             <label>Contact <span class="fieldReq">*</span></label>
                            <input type="text" name="keyword" id="keyword" class="input span11"  value="<?php echo $keyword;?>" placeholder="Phone" />
                            </div>
                            
                       
                        <div class="clearfix"><button class="btn btn-primary filterAction">Search</button> <a class="btn btn-inverse filterAction wC" href="<?php echo $pagename;?>">Clear</a> </div></form>
                    </div>
               </div>
	</div>
</div>
        </div>
        <div class="clearfix sepH_b"></div> 
                                   <?php  
                           $sql="SELECT
  `users`.`name`, `other_contacts`.*
FROM
  `other_contacts` LEFT JOIN
  `users` ON `other_contacts`.`userid` = `users`.`id` where userid!=0 and other_contacts.state_id=".$stateid; 
						   
						    if($action=="show")
						  {
						  if($keyword!="")
						  $sql=$sql . " and  (other_contacts.contact LIKE '%".$keyword."%' )";						  
						 }
					 				 
						 $sql=$sql." order by other_contacts.contactdate desc" ;
						 $_SESSION['sql']=$sql;
						 //echo $sql;
						 include("includes/paging2.php"); 
					     $result=mysqli_query($mysqli, $sql); 
						 
						 	?>
                              
                 <form name="contacts" id="contacts" method="post"> 
                 <table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td height="45">
                <tr>
                                  <td> 
                  <table width="100%" class="table table-hover  table_vam table-black">
                    <thead>
									<tr>
										<th>S. No</th>
										
										<th>Contact </th> 
                                        <th>Called User</th>
                                        <th>Vote for APP</th>
                                        <th> Date Called</th>
                                        <th>Caller Status</th>
                                        <th>Voter Id</th>
                                        <th align="center">Action</th>
									</tr>
								</thead>
                                <?php $count=mysqli_num_rows($result);
				 	  if($count == 0)
                                           {
                                       ?>
                  <tr>
                    <td class="norecords" colspan="8">No Contacts <?php  
					 if($action=="show")echo ' with this filter.';?></td>
                  </tr>
                  <?php  }
								  else{?>
                    <?php 
		  $cnt2=0;
                                           while($row=mysqli_fetch_assoc($result))
                                           {  $cnt++;$cnt2++; ?>
                    <tr>
                      <td><?php echo $cnt;?></td>
                      <td><?php echo $row['contact'];?></td>
                     <td ><a href="view-member-details.php?id=<?php echo $row['userid'];?>"  class="details" rel="colorbox2"><?php echo $row['name']; ?></a></td>
                      <td><?php echo $vote4aap[$row['vote']];?></td>
                     
                      <td><?php echo dateformat($row['contactdate']);?></td>
                      <td ><?php echo $getconnected[$row['iscalled']];?></span></td>
                         <td ><?php echo $row['voterid']==1 ? "Yes": "" ;?></td>   
                      <td><a href="view-ocontact-details.php?id=<?php echo $row['id'];?>" class="details" rel="colorbox" ><i class="icon-eye-open"></i></a> 
                      <a href="#" class="ocontdelete" id="<?php echo $row['id'];?>" title="Delete"><i class="icon-trash"></i></a></td>
                     </tr>
                    <?php } ?>
                  </table>                 </td>
              </tr>
                <tr>
                      <td style="padding:10px"><?php include("includes/paging.php"); ?></td>
                    </tr></table></form></td></tr>
                    <?php }?>
                                  </table> 
	<?php include("includes/footer.php");?>
</body>
</html>
