<?php
include("includes/app_top.php");
$pcat="Miscellaneous";
$getid = getid('id');
checkAdminLogin();
checkState();
$pagetitle="Other Contacts";	

 if($action=="add")
  {    
$query="insert into other_contacts (contact,state_id) VALUE ('".cleanQuery($_POST['contact'])."','".cleanQuery($_POST['stateid'])."')";
   mysqli_query($mysqli, $query);
  tep_redirect(tep_href_link($pagename,'action1=add'));
}             
 if($action=="change")
  {
$orderno=($_POST['orderno2']!='')?$_POST['orderno2']:0;
  
$query="update other_contacts set contact='" . cleanQuery($_POST['contact']) . "'  where id=".$getid;
mysqli_query($mysqli, $query);
      tep_redirect(tep_href_link($pagename,'action1=update'));
}
?>
<?php include("includes/styles.php");?> 
</head>
<body>
<?php include("includes/header.php");?>

<?php include("includes/side-bar.php");?>
 <div class="pageHeadingBlock ">
        	<div class="grayBackground">
               <div class="fR t-r spcT_c">
               <a onClick="displayadd();"  class="btn btn-primary coursesMenu">Add Other Contact</a>
            </div>
        	<h3 class="title"><?php echo $pagetitle;?></h3>
            <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
        	</div>
        </div>
        <div class="clearfix sepH_b"></div>
 <div id="messages">
 <?php
 if($action1=="add") { echo '<div class="alert alert-success">Added Other Contact.</div>';}
if($action1=="update") { echo '<div class="alert alert-success">Updated Contact.</div>';}	?>
 </div>
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
         <div class="clearfix"></div>
         <div id="addrecord" style="display:none">
                                     <form action="other-contacts.php?action=add" method="post" name="frmadd" id="frmadd">

 										<div class="box-bg-rt" style="width:400px; margin:0 auto">
						
                                         <table width="100%" border="0" cellspacing="0" cellpadding="3" class="table table_vam table-black bN">
                                           <thead>
                                           <tr>
                                             <th align="right">Add Contact</th>
                                             <th>&nbsp;</th>
                                           </tr>
                                           </thead>
                                           
                                           <tr>
                                             <td width="38%" align="right">Contact No :&nbsp;</td>
                                             <td width="62%"><input type="text" name="contact" id="contact"   value=""/>
                                             <input type="hidden" name="stateid" value="<?php echo $stateid;?>"/>
                                             </td>
                                           </tr>
                                           
                                           <tr>
                                             <td>&nbsp;</td>
                                             <td><input type="submit" name="register" value="Submit" id="Button1" class="btn btn-primary" />
                                               &nbsp;&nbsp;<a onClick="closeadd();" class="btn btn-inverse" >Cancel</a></td>
                                           </tr>
                                           
                                         </table>
                                       </div>
                                     </form>
                                   </div> 
                                     <?php
if($action=="edit") { ?>
                                     <?php $query="select * from other_contacts where id=". $getid; 
				 
				$res=mysqli_query($mysqli, $query);
              $row=mysqli_fetch_assoc($res);?>
                                     <form action="other-contacts.php?action=change&amp;id=<?php echo $getid;?>" method="post" enctype="multipart/form-data" name="frmadd" id="frmadd">
                                       <div class="box-bg-rt" style="width:400px; margin:0 auto">
										<table width="100%" border="0" cellspacing="0" cellpadding="3" class="table table_vam table-black bN"> 
                                         <thead>
                                         <tr>
                                           <th align="right">Edit Contact</th>
                                           <th>&nbsp;</th>
                                         </tr>
                                         </thead>
                                         <tr>
                                           <td width="38%" align="right">Contact No:&nbsp;</td>
                                           <td width="62%"><input type="text" name="contact" id="contact"   value="<?php echo $row["contact"];?>"/>                                           </td>
                                         </tr>
                                         
                                         <tr>
                                           <td>&nbsp;</td>
                                           <td><input type="submit" name="submit" value="Submit" id="Button1" class="btn btn-primary" />
                                             &nbsp;&nbsp;<a class="close_editbox btn btn-inverse" > Cancel </a></td>
                                         </tr>
                                        
                                       </table>
                                       </div>
                                     </form>
                                   <?php }?>
        <div class="clearfix sepH_b"></div> 
                                   <?php  
                           $sql="SELECT `users`.`name`, `other_contacts`.* FROM `other_contacts` LEFT JOIN `users` ON `other_contacts`.`userid` = `users`.`id` where userid=0 and other_contacts.state_id=".$stateid; 
						   
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
										<th width="50">S. No</th>
										
										<th>Contact </th> 
                                        <th width="90">Status</th>
                                        <th width="90" align="center">Action</th>
									</tr>
								</thead>
                                <?php $count=mysqli_num_rows($result);
				 	  if($count == 0)
                                           {
                                       ?>
                  <tr>
                    <td class="norecords" colspan="4">No Contacts <?php  
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
                     <td > <i class="pointer <?php echo ($row['status2'] != 0) ? 'icon-ok' : 'icon-ban-circle';?>" id="statusimg_<?php echo $row['id'];?>" onClick="change_status('other_contacts','<?php echo $row['id'];?>');" title="change status"></i></td>   
                      <td><a href="<?php echo $pagename;?>?id=<?php echo $row['id'];?>&action=edit"><i class="icon-pencil"></i></a> &nbsp;
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
