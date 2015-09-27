<?php
include("includes/app_top.php");
checkAdminLogin();
checkState();
$pcat="Members";
$pagetitle="Email Templates";
$getid = getid('id');
if($action=="add")
{
$description=cleanQuery($_POST['description']);
$heading=cleanQuery($_POST['heading']);
$stateid=cleanQuery($_POST['stateid']);
$subject=cleanQuery($_POST['subject2']);

$query="insert into email_templates (subject, heading,state_id, description, datemodified) VALUES ('$subject', '$heading','$stateid', '$description', '$date')";
mysqli_query($mysqli,$query);
//echo $query;
tep_redirect(tep_href_link($pagename,'action1=success'));
}

if($action=="edit")
  {
$description=cleanQuery($_POST['description2']);
$heading=cleanQuery($_POST['heading2']);
$subject=cleanQuery($_POST['subject3']);
//$mailtype=cleanQuery($_POST['mailtype2']);
$query="update email_templates set description='" . $description . "', subject='" . $subject . "', heading='" . $heading. "',   datemodified='".$date."'  where id=". $getid;
mysqli_query($mysqli,$query);
tep_redirect(tep_href_link($pagename,'action1=success2&id='.$getid));
}
?>
<?php include("includes/styles.php");?>  
<script language="javascript">
 function checkval()
  {
    if(document.getElementById('subject2').value=="")
    {
     alert("Please enter subject");
     document.getElementById('subject2').focus();
     return false;
    }
	  if(document.getElementById('heading').value=="")
    {
     alert("Please enter heading");
     document.getElementById('heading').focus();
     return false;
    }
  }
</script>
<?php include("includes/ckeditor.php");
?>

</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
<div class="pageHeadingBlock ">
        	<div class="grayBackground">
            
            <div class="fR t-r p_b">
                    <a href="notifications.php" class="clearfix">&larr; back to Email Templates</a>
                     <?php if($getid!='')echo ' <a href="'.$pagename.'" class="btn btn-primary">Add Email Templates</a>';?>
                </div>
                
        	<h3 class="title"><?php echo ($getid!="")?'Edit':'Add';?> Notification</h3>
             <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
        	</div>
        </div>
                                   <?php if($getid==""){?><table width="100%" border="0"  cellpadding="0" cellspacing="0">
<tr>
                    <td>
					<div id="messages">
					<?php
if($action1=="success") { echo '<div class="alert alert-success">Added notification Successfully.</div>';}
if($action1=="err") { echo '<div class="alert alert-error">Something Error. </div>';}?>
</div>
</td>
                  </tr>
                  <tr><td colspan="2">&nbsp;</td></tr>
          <tr>
            <td>  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="text9">
                  
                
                  <tr>
                    <td><form name="frmadd" action="<?php echo $pagename;?>?action=add"  enctype="multipart/form-data"  onsubmit="return checkval();" method="post">
					 <table width="100%" border="0" cellspacing="0" cellpadding="3" class="text9" align="center">
                  
                       <tr valign="top" >
                         <td height="59" align="right">Subject :&nbsp;</td>
                         <td><textarea name="subject2"  id="subject2" ></textarea>
                         <input type="hidden" name="stateid" value="<?php echo $stateid;?>" />
                         </td>
                       </tr>
                       <tr valign="top"  >
                         <td height="59" align="right">Heading : </td>
                         <td><textarea name="heading"  id="heading"></textarea></td>
                       </tr>
                  
                       <tr>
                         <td colspan="2" align="center"> <textarea cols="80" id="description" name="description" rows="10"></textarea>
                         <script type="text/javascript">
						 CKEDITOR.replace( 'description',{ contentsCss : '../css/editor.css'}); 
                     </script></td>
                       </tr>
                 
                     <tr>
                    <td width="38%">&nbsp;</td>
                    <td width="62%"><input type="submit" name="add" value="Submit" id="add" class="button2 btn btn-primary sepV_b" /><input type="button" onClick="location.href='notifications.php'" class="button2 btn btn-inverse eql-pad"  value="Cancel"/></td>
                  </tr>
                </table>
					 					    
			</form></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  
                
                </table></td>
          </tr>
          
          
        </table><?php } else {?><table width="100%" border="0"  cellpadding="0" cellspacing="0">
           <tr>
                    <td >
					<div id="messages">
					<?php
if($action1=="success2") { echo '<div class="alert alert-success">Updated notification Successfully.</div>';}
if($action1=="err") { echo '<div class="alert alert-error">Something Error. </div>';}?>
</div>
</td>
                  </tr>
          <tr>
            <td>  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="text9">
                  
                
                  <tr>
                    <td><?php $query="select * from email_templates where id=".$getid;  
				$res=mysqli_query($mysqli,$query);
              $row=mysqli_fetch_assoc($res);
			 
			  ?><form name="frmadd" action="<?php echo $pagename;?>?action=edit&id=<?php echo $getid;?>"  enctype="multipart/form-data" method="post">
					 <div  ><table width="100%" border="0" cellspacing="0" cellpadding="3" class="text9" align="center">
                  	
                       <tr >
                         <td align="right">&nbsp;</td>
                         <td>&nbsp;</td>
                       </tr>
                       <tr >
                         <td align="right"> Subject :&nbsp;</td>
                         <td>
                         <textarea name="subject3"  id="subject3" ><?php echo $row['subject']; ?></textarea>
                         </td>
                       </tr>
                       <tr valign="top" >
                         <td   align="right">Heading : </td>
                         <td> <textarea name="heading2"  id="heading2" ><?php echo $row['heading']; ?></textarea>
                         </td>
                       </tr>
                  
                       <tr>
                         <td colspan="2" align="center">
                           <textarea cols="80" id="description2" name="description2"  rows="10"><?php echo $row['description'];?></textarea>
                         <script type="text/javascript">
						 CKEDITOR.replace( 'description2',{ contentsCss : '../css/editor.css'}); 
                     </script>					</td>
                       </tr>
                    
                  <tr>
                    <td width="38%">&nbsp;</td>
                    <td width="62%"><input type="submit" name="update" value="Submit" id="update" class="button2 btn btn-primary sepV_b" />
                   <input type="button" onClick="location.href='notifications.php'" class="button2 btn btn-inverse eql-pad"  value="Cancel"/></td>
                  </tr>
                </table>
					 </div>						    
			</form></td>
                  </tr>
                 
                 
                </table></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
        </table><?php }?>
                                   <?php include("includes/footer.php");?> 
</body>
</html>