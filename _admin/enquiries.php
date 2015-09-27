<?php
include("includes/app_top.php");
$pcat="Website";
$pagetitle="Enquiries";
$getid = getid('id');
checkAdminLogin();
checkState();
if($action =="delete2")
  { 
$count= (int)$_POST['count'];

for ($i = 1; $i <= $count; $i++)
 {
$cb='checkbox'.$i;
$ppid=$_POST[$cb];
if($ppid!="")
{
  $query="delete from enquiries where id=" . $ppid;
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
	var aa= document.getElementById('enquiries');
	for (var i =0; i < aa.elements.length; i++) 
	{
	 aa.elements[i].checked = false;
	}
      }

function checkedAll() {
	var aa= document.getElementById('enquiries');
	for (var i =0; i < aa.elements.length; i++) 
	{
	 aa.elements[i].checked = true;
	}
      }	
function validatecb(form)
{
var aa= document.getElementById('enquiries');
var selected=0;
for (var i =0; i < aa.elements.length; i++) 
{
	if(aa.elements[i].checked==true)
	selected=selected+1;
}
if(selected==0)
{
alert("Select atleast one checkbox of enquiry");
exit();
return false;
}
}
function confirm2()
{
validatecb('document.enquiries');
 var1=confirm("Do you want to Delete the selected enquiries?");
    if(var1)
	{
 var2=confirm("Deleted enquiries cannot recover. Are you sure to delete?");
    if(var2)
	{
document.getElementById('enquiries').action="<?php echo $pagename;?>?action=delete2";
document.getElementById('enquiries').submit();
}}
} 
</script>        
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
 <div class="pageHeadingBlock ">
        	<div class="grayBackground">
        	<h3 class="title">Enquiries</h3>
            <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
        	</div>
        </div>
        
        <div class="clearfix sepH_b"></div>

<div  align="right" style="padding-bottom:5px;"><a href="export-enquiries.php">Export Details to Excel</a></div>
 <form name="enquiries" id="enquiries" method="post"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="main-text" align="center">
                 <tr>
                       <td><div id="messages">
                         <?php
if($action1=="success4") { echo '<div class="alert alert-success">Deleted Selected Enquiries.</div>';} 
if($action1=="err") { echo '<div class="alert alert-error">Something Error. </div>';}?>
                       </div></td>
                     </tr><?php
                           $sql="select * from enquiries order by datesent desc";  
											 include("includes/paging2.php");  
											  $result=mysqli_query($mysqli, $sql); 
											   $count=mysqli_num_rows($result);
											  ?>
                     <tr><td>
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="70"><label  for="checkall">  <a href="#" onClick="checkedAll(); return false;">Select All </a> / <a href="#" onClick="clearAll(); return false;">Clear All</a></label></td>
    <td width="506"><input type="button" value="Delete Enquiries" class="btn" onClick="confirm2()" />
      <input type="hidden" value="<?php echo $count;?>" name="count" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
</table>
                     </td></tr>
                     <tr>
                       <td>                       
                       <table width="100%"  class="table table-hover  table_vam table-black">
                           <thead>
                           <tr>
                           
                             <th>#</th>
                             <th width="35"  >No.</th>
                             <th width="450"  >Name</th>
                             <th width="300">Email</th>
                             <th width="90"> Date Came</th>
                             <th>Action</th>
                           </tr>
                           </thead>
                           <?php   
                                      if(mysqli_num_rows($result) == 0)
                                           {
                                       ?>
                           <tr>
                             <td  class="norecords" colspan="6">No Enquiries</td>
                           </tr >
                           <?php  }
								  $cnt2=0;
                                         
                                           while($row=mysqli_fetch_assoc($result))
                                           {  $cnt++;$cnt2++;
                                       ?>
                           <tr>
                              <td><input type="checkbox" name="checkbox<?php echo $cnt2;?>" id="checkbox<?php echo $cnt2;?>" value="<?php echo $row['id'];?>"/></td>
                             <td><?php  echo $cnt; ?></td>
                             <td ><?php echo $row['name']; ?> </td>
                             <td><?php echo $row['email']; ?></td>
                             <td><?php echo dateformat($row['datesent']); ?></td>
                             
                             <td>
                             <a href="view-enquiry.php?id=<?php echo $row['id'];?>" class="details" rel="colorbox"><i class="icon-eye-open"></i></a>
							 <a href="#" class="enquirydelete" id="<?php echo $row['id'];?>" title="Delete"><i class="icon-trash"></i></a>
							 </td>
                           </tr>
                           <?php    } 										  
                                       ?>
                       </table></td>
                     </tr>
                     <tr>
                       <td><?php
include("includes/paging.php"); ?>
                       </td>
                     </tr>
                     <tr>
                       <td >&nbsp;</td>
                     </tr>
                   
           </table> 
           </form>
	<?php include("includes/footer.php");?>
</body>
</html>
