<?php
include("includes/app_top.php");
$pcat="Website";
$pagetitle="state";
$getid = getid('id');

checkAdminLogin();
if($action=="add")
{
$description=cleanQuery($_POST['description']);
$heading=cleanQuery($_POST['name']);
$tablename=cleanQuery($_POST['tablename']);
$pagetitle=cleanQuery($_POST['pagetitle']);
$description=str_replace("\"../images/","\"images/",$description);
$query="insert into states (name,tablename,pagetitle, description,sitename, datemodified) VALUES ('$heading','$tablename','$pagetitle','$description', '".cleanQuery($_POST['sitename'])."', '$date')";
mysqli_query($mysqli, $query);
tep_redirect(tep_href_link($pagename,'action1=success'));
}

if($action=="edit")
  {
$access=cleanQuery($_POST['access']);
$description=cleanQuery($_POST['description2']);
$heading=cleanQuery($_POST['name']);
$tablename=cleanQuery($_POST['tablename']);
$pagetitle=cleanQuery($_POST['pagetitle']);
$description=str_replace("\"../images/","\"images/",$description);
$query="update states set description='" . $description . "',access='" . $access. "', sitename='" . cleanQuery($_POST['sitename']). "',tablename='" .$tablename. "',pagetitle='" .$pagetitle. "',  name='" . $heading. "',   datemodified='".$date."'  where id=". $getid;
mysqli_query($mysqli, $query);
tep_redirect(tep_href_link($pagename,'action1=success&id='.$getid));
}
?>
<?php include("includes/styles.php");?>
<script language="javascript">
 function checkval(form)
  {
    if(form.name.value=="")
    {
     alert("Please enter State name");form.name.focus();
     return false;
    }
	if(form.tablename.value=="")
    {
     alert("Please enter Table name");form.tablename.focus();
     return false;
    }
	if(form.access.value=="")
    {
     alert("Please enter access code");form.access.focus();
     return false;
    }
  }
</script>
<?php include("includes/ckeditor.php");?>
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
<div class="pageHeadingBlock ">
        	<div class="grayBackground">
        	<div class="fR t-r ">
            	<a href="states.php" class="clearfix">&larr;back to States</a>
       <?php if($getid!='')echo ' <a href="'.$pagename.'" class="btn btn-primary">Add  State</a>';?>
            </div>
            <h3 class="title"><?php echo ($getid!="")?'Edit':'Add';?> State</h3>
            
        	</div>
        </div>
        
        <div class="clearfix sepH_b"></div>
     <h2></h2>
      <?php if($getid==""){?><table width="100%" border="0"  cellpadding="0" cellspacing="0"><tr>
            <td height="35" align="right"></td>
          </tr>  <tr>
                    <td><div id="messages"><?php
if($action1=="success") { echo '<div class="alert alert-success">Added State Successfully.</div>';}?>
                        <?php
if($action1=="err") { echo '<div class="alert alert-error">Something Error. </div>';}?></div></td>
                  </tr>
          <tr>
            <td>  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="text9">
                  
                
                  <tr>
                    <td><form name="frmadd" action="<?php echo $pagename;?>?action=add"  enctype="multipart/form-data"  onsubmit="return checkval(this);" method="post">
					 <table width="100%" border="0" cellspacing="0" cellpadding="3" class="text9" align="center">
                  
                  <tr>
                    <td width="38%" align="right">State   Name :&nbsp;</td>
                    <td width="62%"> 
                      <input type="text" name="name"   value="" /> 
                      <span class="red">*</span> </td>
                  </tr>
                   <tr>
                    <td width="38%" align="right">Table   Name :&nbsp;</td>
                    <td width="62%"> 
                      <input type="text" name="tablename"   value="" /> 
                      <span class="red">*</span> </td>
                  </tr>
                
                  <tr>
                    <td width="38%" align="right">Site   Name :&nbsp;</td>
                    <td width="62%"> 
                      <input type="text" name="sitename"   value="" /> 
                      </td>
                  </tr>
                  <tr>
                    <td width="38%" align="right">Page Title :&nbsp;</td>
                    <td width="62%"> 
                      <input type="text" name="pagetitle"   value="" /> 
                      </td>
                  </tr>
                  <tr>
                                    <td align="right">Volunteer/called person information  :&nbsp;<br />
                                    (Text with link)</td>
                   <td> <textarea cols="80" id="description" name="description" rows="10"></textarea>
				</td>
                    </tr>
                 
                     <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="add" value="Submit" id="add" class="btn btn-primary" />&nbsp;&nbsp;<a href="states.php" class="btn btn-inverse" >Cancel</a></td>
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
                    <td><div id="messages"><?php
if($action1=="success") { echo '<div class="alert alert-success">Updated page Successfully.</div>';}?>
                        <?php
if($action1=="err") { echo '<div class="alert alert-error">Something Error. </div>';}?></div></td>
                  </tr>
          <tr>
            <td>  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="text9">
                  
                
                  <tr>
                    <td><?php $query="select * from states where id=".$getid; 
		  
				$res=mysqli_query($mysqli, $query);
              $row=mysqli_fetch_assoc($res);
			 
			  ?><form name="frmadd" action="<?php echo $pagename;?>?action=edit&id=<?php echo $getid;?>"  enctype="multipart/form-data" method="post">
					 <div  ><table width="100%" border="0" cellspacing="0" cellpadding="3" class="text9" align="center">
                  <tr>
                    <td width="38%" align="right">State   Name :&nbsp;</td>
                    <td width="62%"> 
                      <input type="text" name="name"   value="<?php echo $row['name']; ?>" /> 
                      <span class="red">*</span> </td>
                  </tr>
                   <tr>
                    <td width="38%" align="right">Table   Name :&nbsp;</td>
                    <td width="62%"> 
                      <input type="text" name="tablename"   value="<?php echo $row['tablename']; ?>" /> 
                      <span class="red">*</span> </td>
                  </tr>
                   <tr>
                    <td width="38%" align="right">Access Code :&nbsp;</td>
                    <td width="62%"> 
                      <input type="text" name="access" id="access" value="<?php echo $row['access']; ?>" /> 
                      <span class="red">*</span> </td>
                  </tr>
                  <tr>
                    <td width="38%" align="right">Site   Name :&nbsp;</td>
                    <td width="62%"> 
                      <input type="text" name="sitename"   value="<?php echo $row['sitename']; ?>" /> 
                      </td>
                  </tr>
                  <tr>
                    <td width="38%" align="right">Page Title :&nbsp;</td>
                    <td width="62%"> 
                      <input type="text" name="pagetitle"   value="<?php echo $row['pagetitle']; ?>" /> 
                      </td>
                  </tr>
                  <tr>
                  <td align="right">Volunteer/called person information  :&nbsp;<br />
(Text with link)</td>
                   <td>
				     <textarea cols="80" id="description2" name="description2"  rows="10"><?php
					 $description=str_replace("\"images/","\"../images/",$row['description']);
					  echo $description;?></textarea>
</td>
                    </tr>
                    
                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="update" value="Submit" id="update" class="btn btn-primary" />&nbsp;&nbsp;<a href="states.php" class="btn btn-inverse" >Cancel</a></td>
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
