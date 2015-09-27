<?php
include("includes/app_top.php");
$pcat="Contacts";

$getid = getid('id');
checkAdminLogin();
checkState();
$cid = getid('cid');
$t=getid('t');$w= getid('w');
if($t!='')
$_SESSION['t']=$t;
if($page!="")
$t=$_SESSION['t'];

$pagetitle="Contacted";	
if($t==0)
$pagetitle="Not ".$pagetitle;	
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
        	<h3 class="title"><?php echo $pagetitle;?>  <div style="float:right"><a href="export-contacts.php">Export to Excel</a></div></h3>
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
                    <form name="search" method="post" action="contacts.php?action=show<?php if($t==1)echo '&t=1';?>" onSubmit="return validatefilter(this)" class="coursesMenu">
                        	<div class="span3"><?php if($action=="show")
						  { $keyword=cleanQuery($_POST['keyword']);  $cid=$_POST['category'];
						  if($t==1)
						  $vote=cleanQuery($_POST['vote']); 
						   } else {  $keyword=""; $vote="";$cid='';}
						  ?>
                             <label>Contact <span class="fieldReq">*</span></label>
                            <input type="text" name="keyword" id="keyword" class="input span12"  value="<?php echo $keyword;?>" placeholder="Phone" />
                            </div>
                         <?php if($t==1){?>
                            <div class="span3">
                        	<label>Vote</label>
                          <select name="vote" class="input mN" id="vote"  style="width:120px">
                                   <option value="">All</option>								   
                                   <option  value="0" <?php if($vote=="0")echo 'selected="selected"';?>>No</option>
                                   <option  value="1" <?php if($vote=="1")echo 'selected="selected"';?>>Yes</option>
                                   <option  value="2" <?php if($vote=="2")echo 'selected="selected"';?>>Undecided</option>
                                 </select>
                             
                        </div>
                            <?php }?>
                            <div class="span3">
                        	<label>Category</label>
                          <select name="category" class="input mN" id="category" >
                                   <option value="">All</option>
								   <?php
                                          $sql2 = "select * from categories order by catname";
                                          $result2 = mysqli_query($mysqli, $sql2);
                                          while ($row2 = mysqli_fetch_assoc($result2))
                                          {
                                            ?>
                                   <option  value="<?php echo $row2['id'];?>" <?php if($row2['id']==$cid)echo 'selected="selected"';?>> <?php echo $row2['catname'];?> </option>
                                   <?php }?>
                                 </select>
                             
                        </div>
                        
                        <div class="clearfix"><button class="btn btn-primary filterAction">Search</button> <a class="btn btn-inverse filterAction wC" href="<?php echo $pagename;?>">Clear</a> </div></form>
                    </div>
               </div>
	</div>
</div>
        </div>
        <div class="clearfix sepH_b"></div> 
                                   <?php   
						 if($page=="")
						  {
                           $sql="SELECT
  `users`.`name`, ".$tablename.".*
FROM
  ".$tablename." LEFT JOIN
  `users` ON ".$tablename.".`userid` = `users`.`id` where 1"; 
						   
						    if($action=="show")
						  {
						  if($keyword!="")
						  $sql=$sql . " and  (".$tablename.".contact LIKE '%".$keyword."%' )";						  
						  if($vote!="")
						  $sql=$sql . " and  (".$tablename.".vote=".$vote.")";						  
					 
						 if($cid!='' && $cid!=0)
						 $sql=$sql." and ".$tablename.".catid=".$cid;
						 }						 
						  if($t==1)
						 $sql=$sql." and ".$tablename.".userid!=0 and ".$tablename.".iscalled=1";
						  if($t==0)
						 $sql=$sql." and ".$tablename.".userid=0 and ".$tablename.".iscalled=0";
						 $sql=$sql." order by contactdate desc" ;
						 $_SESSION['sql']=$sql;
						 }
						 else
						 $sql=$_SESSION['sql']; 
						// echo $sql;
						 include("includes/paging2.php"); 
					     $result=mysqli_query($mysqli, $sql); 
						 
						 	?>
                              
                 <form name="contacts" id="contacts" method="post"> 
                
                  <table width="100%" class="table table-hover  table_vam table-black">
                    <thead>
									<tr>
										<th>S. No</th>
										<th>Contact Name</th>
										<th>Contact Number</th>
                                        <th>Date Called</th>
                                        <th>Vote</th>
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
                      <td><?php echo $row['contactname'];?></td>
                      <td><?php echo $row['contact'];?></td>
                      <td><?php echo dateformat($row['contactdate']);?></td>
                      <td><?php if($row['iscalled']>0)echo $vote4aap[$row['vote']];?></td>
                      <td><a href="view-contact-details.php?id=<?php echo $row['id'];?>" class="details" rel="colorbox" ><i class="icon-eye-open"></i></a> 
                      <a href="#" class="contdelete" id="<?php echo $row['id'];?>" title="Delete"><i class="icon-trash"></i></a></td>
                     </tr>
                    <?php } ?>
                  </table>    <?php include("includes/paging.php"); ?> </form></td></tr>
                    <?php }?>
                                  </table> 
	<?php include("includes/footer.php");?>
</body>
</html>
