<?php
include("includes/app_top.php");
$pcat="Members";
$pagetitle="Members";
checkAdminLogin();
checkState();

$getid = getid('id');
$uid = getid('uid'); 

if($action=="statusconfirm")
{
$count= (int)$_POST['count'];
$pstatus=$_POST['pstatus2'];

for ($i = 1; $i <= $count; $i++)
 {
$cb='checkbox'.$i;
$userid=$_POST[$cb];
if($userid!="")
{
$query="update users set status2=$pstatus where id=".$userid;
mysqli_query($mysqli,$query);
} 
}
 tep_redirect(tep_href_link($pagename,'action1=success6'));
}

if($action =="delete2")
  { 
$count= (int)$_POST['count'];

for ($i = 1; $i <= $count; $i++)
 {
$cb='checkbox'.$i;
$ppid=$_POST[$cb];
if($ppid!="")
{
  $query="delete from users where id=" . $ppid;
  mysqli_query($mysqli,$query);  
 }
 }  
 tep_redirect(tep_href_link($pagename,'action1=success4'));

} 
 
?>
<?php include("includes/styles.php");?>
<?php include("includes/colorbox.php");?>
<script type="text/javascript">
function clearAll() {
	var aa= document.getElementById('members');
	for (var i =0; i < aa.elements.length; i++) 
	{
	 aa.elements[i].checked = false;
	}
      }

function checkedAll() {
	var aa= document.getElementById('members');
	for (var i =0; i < aa.elements.length; i++) 
	{
	 aa.elements[i].checked = true;
	}
      }	
function validatecb(form)
{
var aa= document.getElementById('members');
var selected=0;
for (var i =0; i < aa.elements.length; i++) 
{
	if(aa.elements[i].checked==true)
	selected=selected+1;
}
if(selected==0)
{
alert("Select atleast one checkbox of members");
exit();
return false;
}
}
function confirm2()
{
validatecb('document.members');
 var1=confirm("Do you want to Delete the selected member?");
    if(var1)
	{
 var2=confirm("Deleted members cannot recover. Are you sure to delete?");
    if(var2)
	{
document.getElementById('members').action="<?php echo $pagename;?>?action=delete2";
document.getElementById('members').submit();
}}
} 
function confirm1()
{
validatecb('document.members');
var aa= document.getElementById('pstatus2').value;
if(aa=="")
{
alert("Select dropdown member status");
document.getElementById('pstatus2').focus();
exit();
return false;
}
document.getElementById('members').action="<?php echo $pagename;?>?action=statusconfirm";
document.getElementById('members').submit();
}
</script>
</head>
<body>
<?php include("includes/header.php");?> 
<?php include("includes/side-bar.php");?>

                                  <div class="pageHeadingBlock ">
        	<div class="grayBackground">
             <div class="fR t-r p_b">
            <a href="export-members.php">Export Showing Members to Excel</a>
            </div>
        	<h3 class="title">Members</h3>
            <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
        	</div>
        </div>
        
        <div class="clearfix sepH_b"></div>
        <div id="messages"><?php if($action1=="success2") { echo '<div class="alert alert-success">Deleted Registration.</div>';}
			 
			  if($action1=="success4") { echo '<div class="alert alert-success">Deleted Selected Members.</div>';}
			  if($action1=="success6") { echo '<div class="alert alert-success">Updated Status Successfully</div>';}
			if($action1=="update") { echo '<div class="alert alert-success">Updated Member status.</div>';}
?></div>
        <div class="grayBackground nobL nobR">
        
        <div id="filterReg" class="ui-accordion">
	    <h4><b>Filter Registrations</b></h4>
	    <div>
		<div class="filedsetInner clearfix">
               
                    <div class="row-fluid">
                    <form name="search" method="post" action="members.php?action=show" onSubmit="return validatefilter(this)" class="coursesMenu">
                        	<div class="span3"><?php if($action=="show")
						  { $keyword=cleanQuery($_POST['keyword']);$date1=$_POST['date1'];$date2=$_POST['date2'];$pstatus=$_POST['pstatus'];  } else { $keyword=""; $date1="";$date2="";$pstatus='';}
						  ?>
                             <label>Search Member </label>
                            <input type="text" name="keyword" id="keyword" class="input span12"  value="<?php echo $keyword;?>" placeholder=" Name / Phone / City / Email" />
                            </div>
                            <div class="span3">
                            	<label for="from" >Date of Registration </label>
									<div class="row-fluid">
                                    <span class="span5"><input type="text" name="date1" id="date1" class="span12 datepicker" placeholder="From" value="<?php echo $date1;?>"></span>
                                    <span class="span2"><div class="tC p_b sml">to</div></span>
                                    <span class="span5"><input type="text" name="date2" id="date2" class="span12 datepicker" placeholder="To" value="<?php echo $date2;?>"> </span>
                                    </div>
                            </div>
                             
                            <div class="span2">
                        	<label>Status</label>
                            <select name="pstatus" class="span10">
                                  <option value="" selected="">All</option>
                                  <option  value="0" <?php if($pstatus=="0")echo 'selected="selected"';?>>No</option>
                                  <option  value="1" <?php if($pstatus=="1")echo 'selected="selected"';?>>Yes</option>
                                  <option  value="2" <?php if($pstatus=="2")echo 'selected="selected"';?>>Block</option>
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
						   $sql="select U.* from users U, (select distinct userid from ".$tablename." where userid!=0) V where U.id=V.userid";
						  if($action=="show")
						  {
						  if($keyword!="")
						  $sql=$sql." and (name LIKE '%".$keyword."%' or phone LIKE '%".$keyword."%' or city='".$keyword."' or email='".$keyword."')";
						  if($pstatus!="")
						  $sql=$sql." and status2=".$pstatus;
						  if ($date1 != '' && $date2 != '')
                                {
                                  $sql = $sql." and datecreated between '".$date1."' and '".$date2."  23:59:00'";
                                }								 
						 } 		  
						  $sql=$sql. " order by datecreated desc";
						 $_SESSION['q']=$sql;
						 }
						 
						 else
						 $sql=$_SESSION['q'];
						//echo $sql;
				  	 	include("includes/paging2.php");  
					
						$result=mysqli_query($mysqli,$sql);
						$count=mysqli_num_rows($result);
				 	  if($count == 0)
                                           {
                                       ?>
                  <p class="norecords">No Members <?php if($action=="show")echo ' with this filter.';?></p>
                  
                  <?php  }
								  else{?>
                                   
                 <form name="members" id="members" method="post"> 
                 <table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td height="45">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="120"><label  for="checkall">  <a href="#" onClick="checkedAll(); return false;">Select All </a> / <a href="#" onClick="clearAll(); return false;">Clear All</a></label></td>
    <td width="506"><input type="button"value="Delete members" name="delete_member" id="delete_member" onClick="confirm2()" class="btn"  />&nbsp;&nbsp;&nbsp; <select name="pstatus2" id="pstatus2" class="span12" style="width:120px">
                                  <option value="" selected="">Select Status</option>
                                  <option  value="1">Active</option>
                                  <option  value="2">Block</option>
                             </select><input type="button" value="Update Status " name="paymentactive" id="paymentactive" class="btn"  onclick="confirm1();" />&nbsp;
      <input type="hidden" value="<?php echo $count;?>" name="count" />
      </td>
    <td width="267"  align="right"> </td>
  </tr>
</table>
                </td>
              </tr>
                                  <tr>
                                  <td> 
                  <table width="100%" class="table table-hover  table_vam table-black">
                    <thead>
									<tr>
										<th class="table_checkbox"></th>
										<th>SNo</th>
										<th width="150">Name </th> 
                                       
                                        <th>Email Id</th>
                                        <th>Phone</th>
                                        <th width="80">IP</th>
                                        <th style="font-size:11px">Contacts</th>
                                        <th style="font-size:11px">Referrals</th>
                                        <th style="width:95px">Reg.&nbsp;Date</th>
                                        <th>Status</th>
                                        <th style="font-size:11px">Genuine</th>
                                        <th style="width:80px">Action</th>
									</tr>
								</thead>
                    <?php 
		  $cnt2=0;
                                           while($row=mysqli_fetch_assoc($result))
                                           {  $cnt++;$cnt2++; ?>
                    <tr>
                      <td><input type="checkbox" name="checkbox<?php echo $cnt2;?>" id="checkbox<?php echo $cnt2;?>" value="<?php echo $row['id'];?>"/></td>
                      <td><?php echo $cnt;?></td>
                      <td><a href="view-member-details.php?id=<?php echo $row['id'];?>"  class="details" rel="colorbox2"><?php echo $row['name']; ?></a></td>
                      
                      <td><?php echo $row['email'];?></td>
                      <td><?php echo $row['phone'];?></td>
                      <td><?php echo $row['ip_address'];?></td>
                      <td><?php
					  $cc=contactscount($row['id']);
                      if($cc>0)echo '<a href="day-contacts.php?mid='.$row['id'].'">'.$cc.'</a>';
					  else
					  echo $cc;?></td>
                      <td><?php
					  $rc=referralcount($row['id']);
                      if($rc>0)echo '<a href="referrals.php?mid='.$row['id'].'">'.$rc.'</a>';
					  else
					  echo $rc;?></td>
                      <td><?php echo dateformat($row['datecreated']);?></td>
                      <td ><i class="pointer <?php if($row['status2']==1)echo 'icon-ok';else if($row['status2']==0)echo 'icon-remove';else echo 'icon-ban-circle';?>" id="statusimg_<?php echo $row['id'];?>" onClick="change_statusb('users','<?php echo $row['id'];?>');" title="change status"></i></td>
                      <td ><img src="<?php echo ($row['genuine'] != 0) ? '../images/ico_activate.gif' : '../images/ico_deactivate.gif';?>" alt="Status" title="Status" id="statusig_<?php echo $row['id'];?>"  onClick="change_statusg('users','<?php echo $row['id'];?>');" class="pointer"/></td>      
                      <td style="text-align:center"><a href="send-mail.php?mid=<?php echo $row['id'];?>" ><i class="icon-envelope"></i></a>
                      &nbsp;&nbsp;<a class="sepV_a" href="member-details.php?id=<?php  echo $row['id'];?>&action=edit" title="Edit"><i class="icon-pencil"></i></a>
                      <a href="#" class="memberdelete" id="<?php echo $row['id'];?>" title="Delete"><i class="icon-trash"></i></a></td>
                     </tr>
                    <?php } ?>
                  </table>                 </td>
              </tr>
                <tr>
                      <td style="padding:10px"><?php include("includes/paging.php"); ?></td>
                    </tr></table></form> 
                    <?php }?>
                                  
                                  <p>Active Users (<i class="icon-ok"></i>), Inactive Users (<i class="icon-remove"></i>), Blocked Users (<i class="icon-ban-circle"></i>)</p>
                             
<?php include("includes/footer.php");?> 
</body>
</html>