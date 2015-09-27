<?php
include("includes/app_top.php");
$pcat="Contacts";

$getid = getid('id');

$pagetitle="Wrong Numbers";	
checkAdminLogin();
checkState();
$cid = getid('cid');
$t= getid('t');$w= getid('w');
if($cid!='' && $cid!=0)
$_SESSION['cid']=$cid;
if($cid=='' && isset($_SESSION['cid']))
$cid=$_SESSION['cid'];
 
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
 <div id="messages"><?php if($action1=="success2") { echo '<div class="alert alert-success">Deleted Registration.</div>';}
			 
			  if($action1=="success4") { echo '<div class="alert alert-success">Deleted Selected Members.</div>';}
			  if($action1=="success6") { echo '<div class="alert alert-success">Confirmation Status Active and sent confirm mail to Selected Members.</div>';}
			if($action1=="update") { echo '<div class="alert alert-success">Updated Member status.</div>';}
?></div>
        <div class="grayBackground nobL nobR">
        
        <div id="filterReg" class="ui-accordion">
	    <h4><b>Filter Registrations</b></h4>
	    <div>
		<div class="filedsetInner clearfix">
               
                    <div class="row-fluid">
                    <form name="search" method="post" action="contacts.php?action=show" onSubmit="return validatefilter(this)" class="coursesMenu">
                        	<div class="span3"><?php if($action=="show")
						  { $keyword=cleanQuery($_POST['keyword']); } else {  $keyword="";}
						  ?>
                             <label>Contact <span class="fieldReq">*</span></label>
                            <input type="text" name="keyword" id="keyword" class="input span12"  value="<?php echo $keyword;?>" placeholder="Phone" />
                            </div>
                            
                            
                            <div class="span3">
                        	<label>Category</label>
                          <select name="category" class="input mN" id="category"  >
                                   <option value="<?php echo $pagename;?>?cid=0">All</option>
								   <?php
                                          $sql2 = "select * from categories order by catname";
                                          $result2 = mysqli_query($mysqli, $sql2);
                                          while ($row2 = mysqli_fetch_assoc($result2))
                                          {
                                            ?>
                                   <option  value="<?php echo $pagename;?>?cid=<?php echo $row2['id'];?>" <?php if($row2['id']==$cid)echo 'selected="selected"';?>> <?php echo $row2['catname'];?> </option>
                                   <?php }?>
                                 </select>
                             
                        </div>
                        <div class="clearfix"><button class="btn btn-primary filterAction">Search</button> <a class="btn btn-inverse filterAction wC" href="<?php echo $pagename;?>">Clear</a> </div></form>
                    </div>
               </div>
	</div>
</div>
        </div>
        <div class="clearfix"></div>
                                  
                                   <?php   
						 
                        $sql="SELECT
  ".$tablename.".*,   `users`.`name`  
FROM
  `".$tablename."`  INNER JOIN
  `users` ON `".$tablename."`.`userid` = `users`.`id`  where  (".$tablename.".iscalled=2 or ".$tablename.".iscalled=4)"; 
						   
						    if($action=="show")
						  {
						  if($keyword!="")
						  $sql=$sql . " and  (".$tablename.".contact LIKE '%".$keyword."%' )";						  
						 }
						 if($cid!='' && $cid!=0)
						 $sql=$sql." and ".$tablename.".catid=".$cid;
						  						 
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
                     <td ><a href="view-member-details.php?id=<?php echo $row['userid'];?>"  class="details" rel="colorbox2">
					 <?php echo $row['name']; ?></a></td>
                      <td><?php echo $vote4aap[$row['vote']];?></td>
                     
                      <td><?php echo dateformat($row['contactdate']);?></td>
                      <td ><?php echo $getconnected[$row['iscalled']];?></span></td>
                         <td ><?php echo $row['voterid']==1 ? "Yes": "" ;?></td>   
                      <td><a href="view-contact-details.php?id=<?php echo $row['id'];?>" class="details" rel="colorbox" ><i class="icon-eye-open"></i></a> 
                      <a href="#" class="contdelete" id="<?php echo $row['id'];?>" title="Delete"><i class="icon-trash"></i></a></td>
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
