<?php
include("includes/app_top.php");
$pcat="Members";
$pagetitle="Members";
checkAdminLogin();

$getid = getid('id');
$uid = getid('uid'); 

if($action=="sm")
{
					$count=(int)$_POST['count'];
			$emails="";		
					 for ($i = 1; $i <= $count; $i++)
  {
  $cb='checkbox'.$i;
if(isset($_POST[$cb]))  
{
$checkedmail=return_field('members','member_number',$_POST[$cb],'email');
$emails=$emails. $checkedmail.', ';
}}
$_SESSION['emails2']=$emails;
tep_redirect('send-mail.php');
}



if($action=="paymentconfirm")
{
$count= (int)$_POST['count'];

for ($i = 1; $i <= $count; $i++)
 {
$cb='checkbox'.$i;
//echo $_POST[$cb].', ';
$memberid=$_POST[$cb];
if($memberid!="")
{
$sql= "select * from members where member_number='" . $memberid."'";
        $res= mysqli_query($mysqli,$sql);
        $row= mysqli_fetch_assoc($res);
$oid=getlatestorderid($memberid);
/*if($row['registration_type']==2)
$expiredate="2050-12-31";
else
$expiredate=$thisyear."-12-31";
*/
$regtype=$row['membertype'];
$regdetails='';

$query="update orders set payment_status=1, activeby=" . $_SESSION['adminid']. ", expirydate='$expiredate', activedate='$date', ordermodified='$date' where id=".$oid;
mysqli_query($mysqli,$query);

$regdetails=$regdetails.'<p><b style="color:#336633">Registration Details:</b></p><table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr valign="top">
                                        <td colspan="2"><b>Personal Details:</b></td>
                                        </tr> <tr> <td width="212"  > Name</td>
                                          <td   >'.$row['firstname'].' '.$row['lastname'].' '.$row['middlename'].'</td>
              </tr>
              <tr>
                <td  >Profession</td>
                <td>'.$row['profession'].'</td>
              </tr>
              <tr> <td  >Spouse Name</td>
                <td>'.$row['spouse_name'].' </td>
              </tr>
              <tr>
                <td  >Spouse Profession</td>
                <td>'.$row['spouse_profession'].'</td>
              </tr>
			     <tr>
                <td  >Phone</td>
                <td>'.$row['phone'].'</td>
              </tr>
			  <tr>
                <td  >Mobile</td>
                <td>'.$row['mobile'].'</td>
              </tr>
			  <tr>
                <td  >Fax</td>
                <td>'.$row['fax'].'</td>
              </tr>
			  
			     <tr>
                <td  >Email</td>
                <td>'.$row['email'].'</td>
              </tr>
              <tr valign="top">
                                        <td colspan="2"><b>Contact Details:</b></td>
                                        </tr><tr> <td  >Address</td>
                <td>'.$row['address'].'</td>
              </tr>
              <tr> <td  >City</td>
                <td>'.$row['city'].'</td>
              </tr>
              <tr> <td  >State</td>
                <td>'.$row['state'].'</td>
              </tr>
              <tr> <td  >Zip Code</td>
                <td>'.$row['zip'].'</td>
              </tr>
              
				<tr>
                <td  height="10" ></td>
                <td></td>
              </tr> 
				<tr>
                <td  >Payment Method</td>
                <td>'. $row['payment_method'].'</td>
              </tr> 
			  <tr>
                <td  >comments</td>
                <td>'. $row['comments'].'</td>
              </tr>  
               <tr>
                <td  >Amount</td>
                <td>'.$row['amount'].'</td>
              </tr>';
		      
                  $regdetails=$regdetails.' <tr valign="top">
                            <td colspan="2"><div class="heading3">Children Details:</div></td>
                                        </tr>
              <tr valign="top">
                <td colspan="2">';                 
				 $query="select * from childrens where memberid='". $row['member_number']."' order by name";
				$res2=mysqli_query($mysqli,$query);
			  if(mysqli_num_rows($res2)>0){
                $regdetails=$regdetails.'<table width="100%" border="1" bordercolor="#cccccc" cellpadding="5" cellspacing="0" style="border-collapse:collapse">
                  <tr>
                    <th width="150"  height="24">Name</th>
                    <th width="70">Age</th>
                    
                  </tr>';
                   while($row2=mysqli_fetch_assoc($res2))
                                           { 
                  $regdetails=$regdetails.'<tr>
                    <td  height="24">'.$row2['name'].'</td>
                    <td>'.$row2['age'].'</td>
                    
                  </tr>'; }
                $regdetails=$regdetails.'</table>';
                } else $regdetails=$regdetails.'No Children Details';
				$regdetails=$regdetails.'</td>
              </tr>
</table><br/><br/>';							

$sql2= "select * from email_templates where id=2";
        $res2= mysqli_query($mysqli,$sql2);
        $row2= mysqli_fetch_assoc($res2);
					
		$esubject2 = $row2['subject'];
		$esubject2 = str_replace("[SITENAME]",$sitename,$esubject2);		
	 
		$emailtext2 = $row2['description'];
		$emailtext2 = str_replace("[MTYPE]",$regtype,$emailtext2);
		$emailtext2 = str_replace("[MEMBERNAME]",$membername,$emailtext2);
		$emailtext2 = str_replace("[MEMBER_NUMBER]",$row['member_number'],$emailtext2);		
		$emailtext2 = str_replace("[REGISTRATION_DETAILS]",$regdetails,$emailtext2);		
		$emailtext2 = str_replace("[SOCIAL_ICONS_MAIL]",$socialicons_mail,$emailtext2);
		$emailtext2 = str_replace("[SITENAME]",$sitename,$emailtext2);
		$emailtext2 = str_replace("[SITEURL]",$siteurl,$emailtext2);		
		$emailtext2 = str_replace("[ADMINEMAIL]",$adminemail,$emailtext2);

$email=$row['email'];			
@mail("$email", $esubject2, $emailtext2, "From: $membershipemail\r\nReply-to: $membershipemail\r\nContent-type: text/html; charset=utf-8");	
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
//echo $_POST[$cb].', ';
$memberid=$_POST[$cb];
if($memberid!="")
{
$memberid=$_POST[$cb];  

  $query="delete from members where member_number='" . $memberid."'";
  mysqli_query($mysqli,$query);  
  
 }
 }  tep_redirect(tep_href_link($pagename,'action1=success4'));

} 
 
?>
<?php include("includes/styles.php");?>
<?php include("../includes/colorbox.php");?>
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
</script>
<script type="text/javascript">
 function validatefilter(form)
{
if((form.date1.value!="" && form.date2.value=="")||(form.date1.value=="" && form.date2.value!=""))
    {
     alert("Please select dates of from and to");
     form.date1.focus();return false;
    }
if (!IsNumeric(form.expireon.value) && form.expireon.value!="") {alert('Valid only numeric'); form.expireon.focus(); return false}
	
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
 var1=confirm("Do you want to Delete the selected members?");
    if(var1)
	{
 var2=confirm("Deleted members cannot recover. Are you sure to delete this member with family, orders delete ?");
    if(var2)
	{
document.getElementById('members').action="<?php echo $pagename;?>?action=delete2";
document.getElementById('members').submit();
}}
}
function confirm3()
{
validatecb('document.members');
document.getElementById('members').action="<?php echo $pagename;?>?action=sm";
document.getElementById('members').submit();
}

function confirm1()
{
validatecb('document.members');
document.getElementById('members').action="<?php echo $pagename;?>?action=paymentconfirm";
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
            <?php if(stristr($_SESSION['access'],"n")){?><a href="export-members.php">Export Showing Members to Excel</a><?php }?>
            </div>
        	<h3 class="title">Members</h3>
            <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
        	</div>
        </div>
        
        <div class="clearfix sepH_b"></div>
        <?php if(!stristr($_SESSION['access'],"n")){?>
       <p class="norecords">Cannot access this page. </p>
       <?php } 
	   else { ?>
        <div id="messages"><?php if($action1=="success2") { echo '<div class="alert alert-success">Deleted Registration.</div>';}
			 if($action1=="success5") { echo '<div class="alert alert-success">Renewal done the selected members.</div>';}
			  if($action1=="success4") { echo '<div class="alert alert-success">Deleted Selected Members.</div>';}
			  if($action1=="success6") { echo '<div class="alert alert-success">Payment Status Active and sent confirm mail to Selected Members.</div>';}
			if($action1=="update") { echo '<div class="alert alert-success">Updated Member status.</div>';}
?></div>
        <div class="grayBackground nobL nobR">
        
        <div id="filterReg" class="ui-accordion">
	    <h4><b>Filter Registrations</b></h4>
	    <div>
		<div class="filedsetInner clearfix">
               
                    <div class="row-fluid">
                    <form name="search" method="post" action="members.php?action=show" onSubmit="return validatefilter(this)" class="coursesMenu">
                        	<div class="span2"><?php if($action=="show")
						  { $keyword=cleanQuery($_POST['keyword']);$date1=$_POST['date1'];$date2=$_POST['date2'];$pstatus=$_POST['pstatus']; $membership=$_POST['membership']; } else {  $date1="";$date2="";$keyword="";$pstatus='';$membership='';}
						  ?>
                            
                                <label>Membership Type <span class="fieldReq">*</span></label>
									<select name="membership" class="input" style="width:150px">
									<option value="">All</option>
									<?php  for($i =1; $i < count($membership_types); $i++) { 
echo "<option value=\"" . $membership_types[$i] . "\"";
if($membership==$membership_types[$i])echo " selected='selected'";
echo ">" . $membership_types[$i] ."</option>";	
}?></select>
                            </div>
                            <div class="span3">
                            	<label for="from" >Date of Registration  <span class="fieldReq">*</span></label>
									<div class="row-fluid">
                                    <span class="span5"><input type="text" name="date1" id="date1" class="span12 datepicker" placeholder="From" value="<?php echo $date1;?>"></span>
                                    <span class="span2"><div class="tC p_b sml">to</div></span>
                                    <span class="span5"><input type="text" name="date2" id="date2" class="span12 datepicker" placeholder="To" value="<?php echo $date2;?>"> </span>
                                    </div>
                            </div>
                            <div class="span3 f_error">
                            <label>Search Member <span class="fieldReq">*</span></label>
                            
                            <input type="text" name="keyword" id="keyword" class="input span12"  value="<?php echo $keyword;?>" placeholder="Member ID / Name / Spouse / City" />
                            </div>
                            
                            <div class="span2">
                        	<label>Payment Status<span class="fieldReq">*</span></label>
                            <select name="pstatus" class="span12" style="width:120px">
                                  <option value="" selected="">All</option>
                                  <option  value="0" <?php if($pstatus=="0")echo 'selected="selected"';?>>Pending</option>
                                  <option  value="1" <?php if($pstatus=="1")echo 'selected="selected"';?>>Apporved</option>
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
						   $sql="SELECT * from members where 1";

						  if($action=="show")
						  {
						  if($keyword!="")
						  $sql=$sql . " and  (firstname LIKE '%".$keyword."%' or lastname LIKE '%".$keyword."%' or spouse_name LIKE '%".$keyword."%'  or member_number='".$keyword."'  or email='".$keyword."' or city='".$keyword."')";
						  if($membership!="")
						  $sql=$sql." and membertype='".$membership."' ";
						  if($pstatus!="")
						  $sql=$sql." and payment_status=".$pstatus;
						  if ($date1 != '' && $date2 != '')
                                {
                                  $sql = $sql." and datesent between '".$date1."' and '".$date2."  23:59:00'";
                                }								 
						 }
						 $_SESSION['q2']=$sql;
						  if($sort!="")
						  {
						  if($sort=="firstname" || $sort=="city")
						 $sql=$sql. " order by ".$sort." ".$st;
						 else
						 $sql=$sql. " order by ".$sort." ".$st;
						 }
						  else						  
						  $sql=$sql. " order by datesent desc";
						 $_SESSION['q']=$sql;
						 }
						 
						 else
						 $sql=$_SESSION['q'];
						
				  	 	include("includes/paging2.php");  
					
						$result=mysqli_query($mysqli,$sql);
						$count=mysqli_num_rows($result);
				 	  if($count == 0)
                                           {
                                       ?>
                  <tr>
                    <td class="underprocess" style="padding:60px 0" >No Members <?php  
					 if($action=="show")echo ' with this filter.';?></td>
                  </tr>
                  <?php  }
								  else{?>
                                  <tr>
                <td >   
                 <form name="members" id="members" method="post"> 
                 <table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td height="45">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="120"><label  for="checkall">  <a href="#" onClick="checkedAll(); return false;">Select All </a> / <a href="#" onClick="clearAll(); return false;">Clear All</a></label></td>
    <td width="506"><input type="button" value="Mail to Members" name="mailmembers" id="mailmembers" class="btn" onClick="confirm3();" />&nbsp;<input type="button" value="Payment Confirm" name="paymentactive" id="paymentactive" class="btn"  onclick="confirm1();" />&nbsp;<input type="button" value="Delete Members" name="deletemembers" id="deletemembers" class="btn" onClick="confirm2()" />
      <input type="hidden" value="<?php echo $count;?>" name="count" /></td>
    <td width="267"  align="right"><strong>Sort by : </strong>
                  <select name="sortby" id="sortby" class="input" style="width:auto"  onchange="MM_jumpMenu('parent',this,0)">
                    <option value="" selected="selected">Select</option>
                    <option value="<?php echo $pagename;?>?sort=member_number&st=asc" <?php if($sort=="member_number"&&$st=="asc")echo 'selected="selected"';?>>Member Id Asc</option>
                    <option value="<?php echo $pagename;?>?sort=member_number&st=desc" <?php if($sort=="member_number"&&$st=="desc")echo 'selected="selected"';?>>Member Id  Desc</option>
                    <option value="<?php echo $pagename;?>?sort=firstname&st=asc" <?php if($sort=="firstname"&&$st=="asc")echo 'selected="selected"';?>>First Name Asc</option>
                    <option value="<?php echo $pagename;?>?sort=firstname&st=desc" <?php if($sort=="firstname"&&$st=="desc")echo 'selected="selected"';?>>First Name Desc</option>
                    <option value="<?php echo $pagename;?>?sort=expirydate&st=asc" <?php if($sort=="expirydate"&&$st=="asc")echo 'selected="selected"';?>>Date Expre Asc</option>
                    <option value="<?php echo $pagename;?>?sort=expirydate&st=desc" <?php if($sort=="expirydate"&&$st=="desc")echo 'selected="selected"';?>>Date Expire Desc</option>
                    <option value="<?php echo $pagename;?>?sort=city&st=asc" <?php if($sort=="city"&&$st=="asc")echo 'selected="selected"';?>>City Asc</option>
                    <option value="<?php echo $pagename;?>?sort=city&st=desc" <?php if($sort=="city"&&$st=="desc")echo 'selected="selected"';?>>City Desc</option>
                    <option value="<?php echo $pagename;?>?sort=mtype&st=asc" <?php if($sort=="mtype"&&$st=="asc")echo 'selected="selected"';?>>Membership Type Asc</option>
                    <option value="<?php echo $pagename;?>?sort=mtype&st=desc" <?php if($sort=="mtype"&&$st=="desc")echo 'selected="selected"';?>>Membership Type Desc</option>
                  </select></td>
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
										<th>S. No</th>
										<th>Member ID</th>
										<th>First Name </th>
										<th>Last Name</th>
                                        <th>Location</th>
                                        <th>Membership</th>
                                        <th> Date Sent</th>
                                        <th>Payment Method</th>
                                        <th>P Status</th>
                                        <th>Action</th>
									</tr>
								</thead>
                    <?php 
		  $cnt2=0;
                                           while($row=mysqli_fetch_assoc($result))
                                           {  $cnt++;$cnt2++; ?>
                    <tr>
                      <td><input type="checkbox" name="checkbox<?php echo $cnt2;?>" id="checkbox" value="<?php echo $row['member_number'];?>"/></td>
                      <td><?php echo $cnt;?></td>
                      <td><a href="view-member-details.php?mid=<?php echo $row['member_number'];?>" class="profile"><?php echo $row['member_number'];?></a></td>                      <td><?php echo $row['firstname'];?></td>
                      <td><?php echo $row['lastname'];?></td>
                      <td><?php echo $row['city'];?></td>
                      <td><?php echo $row['membertype'];?></td>
                      <td><?php echo dateformat($row['datesent']);?></td>
                      <td ><?php echo $row['payment_method'];?></td>
                      <td ><span class="text-success"><?php  echo ($row['payment_status']==0)?'No':'Yes';?></span></td>
                            
                      <td style="text-align:center"><a href="send-mail.php?mid=<?php echo $row['id'];?>" ><i class="icon-envelope"></i></a>
                      &nbsp;&nbsp;<a class="sepV_a" href="member-details.php?id=<?php  echo $row['member_number'];?>&action=edit" title="Edit"><i class="icon-pencil"></i></a>
                      <a href="#" class="memberdelete" id="<?php echo $row['id'];?>" title="Delete"><i class="icon-trash"></i></a></td>
                     </tr>
                    <?php } ?>
                  </table>                 </td>
              </tr>
                <tr>
                      <td style="padding:10px"><?php include("includes/paging.php"); ?></td>
                    </tr></table></form></td></tr>
                    <?php }?>
                                  </table> 
                                   <?php }?>
<?php include("includes/footer.php");?> 
</body>
</html>