<?php
include("includes/app_top.php");
$pcat="Website";
$pagetitle="Inner Pages";
$getid = getid('id');

checkAdminLogin();
checkState();
if($action=="add")
{
$description=cleanQuery($_POST['description']);
$heading=cleanQuery($_POST['heading']);
$stateid=cleanQuery($_POST['stateid']);
$description=str_replace("\"../images/","\"images/",$description);
$description=str_replace("\"../pictures/","\"pictures/",$description);
$description=str_replace("\"../downloads/","\"downloads/",$description);
$query="insert into innerpages (heading, pagetitle, description, metakeywords, metadesc, filename,state_id, datemodified) VALUES ('$heading','".cleanQuery($_POST['pagetitle'])."','$description', '".cleanQuery($_POST['metakeywords'])."', '".cleanQuery($_POST['metadesc'])."', '".cleanQuery($_POST['filename'])."','".$stateid."','$date')";
mysqli_query($mysqli, $query);
tep_redirect(tep_href_link($pagename,'action1=success'));
}

if($action=="edit")
  {
$description=cleanQuery($_POST['description2']);
$heading=cleanQuery($_POST['heading2']);
$stateid=cleanQuery($_POST['stateid']);
$description=str_replace("\"../images/","\"images/",$description);
$description=str_replace("\"../downloads/","\"downloads/",$description);
$description=str_replace("\"../pictures/","\"pictures/",$description);
$query="update innerpages set description='" . $description . "', pagetitle='" . cleanQuery($_POST['pagetitle2']). "',filename='" . cleanQuery($_POST['filename2']). "',  metakeywords='" . cleanQuery($_POST['metakeywords2']) . "', metadesc='" . cleanQuery($_POST['metadesc2']) . "', heading='" . $heading. "',state_id='" . $stateid. "',   datemodified='".$date."'  where id=". $getid;
mysqli_query($mysqli, $query);
tep_redirect(tep_href_link($pagename,'action1=success&id='.$getid));
}
?>
<?php include("includes/styles.php");?>
<script language="javascript">
 function checkval(form)
  {
    if(form.heading.value=="")
    {
     alert("Please enter page name");form.heading.focus();
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
        	<div class="fR t-r spcT_c">
            	<a href="innerpages.php" class="clearfix">&larr;back to Pages</a>
       <?php if($getid!='')echo ' <a href="'.$pagename.'" class="btn btn-primary">Add  Page</a>';?>
            </div>
            <h3 class="title"><?php echo ($getid!="")?'Edit':'Add';?> Inner Page</h3>
            <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
        	</div>
        </div>
        
        <div class="clearfix sepH_b"></div>
     <h2></h2>
      <?php if($getid==""){?><table width="100%" border="0"  cellpadding="0" cellspacing="0"><tr>
            <td height="35" align="right"></td>
          </tr>  <tr>
                    <td><div id="messages"><?php
if($action1=="success") { echo '<div class="alert alert-success">Added page Successfully.</div>';}?>
                        <?php
if($action1=="err") { echo '<div class="alert alert-error">Something Error. </div>';}?></div></td>
                  </tr>
          <tr>
            <td>  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="text9">
                  
                
                  <tr>
                    <td><form name="frmadd" action="<?php echo $pagename;?>?action=add"  enctype="multipart/form-data"  onsubmit="return checkval(this);" method="post">
					 <table width="100%" border="0" cellspacing="0" cellpadding="3" class="text9" align="center">
                  
                  <tr>
                    <td width="38%" align="right">Page   Name :&nbsp;</td>
                    <td width="62%"> 
                      <input type="text" name="heading" value="" /> 
                      <span class="red">*</span> </td>
                  </tr>
                   
                   <tr>
                    <td align="right">Page   Title :&nbsp;</td>
                    <td><textarea name="pagetitle" rows="3" ></textarea>
                        <span class="red">*</span> </td>
                  </tr>
                  <tr>
                    <td align="right">Meta Keywords :&nbsp;</td>
                    <td><textarea name="metakeywords" rows="3" ></textarea></td>
                  </tr>
                  <tr>
                    <td align="right">Meta Description  :&nbsp;</td>
                    <td><textarea name="metadesc" rows="3" ></textarea></td>
                  </tr>
  				

                  <tr>
                    <td align="right"><strong>(OR) </strong>File Name (Manual create this page):&nbsp;</td>
                    <td><input name="filename" type="text"   value="" /><input name="stateid" type="hidden"   value="<?php echo $stateid;?>" /></td>
                  </tr>
                  <tr>
                   <td colspan="2" align="center"> <textarea cols="80" id="description" name="description" rows="10"></textarea>
					<script type="text/javascript">
	var editor = CKEDITOR.replace( 'description',{ contentsCss : '../css/editor.css'} );
	CKFinder.setupCKEditor( editor, 'ckfinder/' );	 
		</script></td>
                    </tr>
                 
                     <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="add" value="Submit" id="add" class="btn btn-primary" />&nbsp;&nbsp;<a href="innerpages.php" class="btn btn-inverse" >Cancel</a></td>
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
                    <td><?php $query="select * from innerpages where id=".$getid; 
		  
				$res=mysqli_query($mysqli, $query);
              $row=mysqli_fetch_assoc($res);
			 
			  ?><form name="frmadd" action="<?php echo $pagename;?>?action=edit&id=<?php echo $getid;?>"  enctype="multipart/form-data" method="post">
					 <div  ><table width="100%" border="0" cellspacing="0" cellpadding="3" class="text9" align="center">
                  
                  <tr>
                    <td width="38%" align="right">Page   Name :&nbsp;</td>
                    <td width="62%"> 
                      <input type="text" name="heading2"    value="<?php echo $row['heading']; ?>"/>                     </td>
                  </tr>
                     
                     <tr>
                    <td align="right">Page   Title :&nbsp;</td>
                    <td><textarea name="pagetitle2" rows="3"  ><?php echo $row['pagetitle'];?></textarea>
                        <span class="red">*</span> </td>
                  </tr>
                  <tr>
                    <td align="right">Meta Keywords :&nbsp;</td>
                    <td><textarea name="metakeywords2" rows="3"  ><?php echo $row['metakeywords'];?></textarea></td>
                  </tr>
                  <tr>
                    <td align="right">Meta Description  :&nbsp;</td>
                    <td><textarea name="metadesc2" rows="3"  ><?php echo $row['metadesc'];?></textarea></td>
                  </tr>
  
                  <tr>
                    <td align="right"><strong>(OR) </strong>File Name :&nbsp;</td>
                    <td><input name="filename2" type="text"   value="<?php echo $row['filename'];?>" />
                    <input name="stateid" type="hidden"   value="<?php echo $stateid;?>" />
                    </td>
                  </tr>
                  <tr>
                   <td colspan="2" align="center">
				     <textarea cols="80" id="description2" name="description2"  rows="10"><?php
					 $description=str_replace("\"images/","\"../images/",$row['description']);
					 $description=str_replace("\"pictures/","\"../pictures/",$description);					 
					 $description=str_replace("\"downloads/","\"../downloads/",$description);
					  echo $description;?></textarea>
                    <script type="text/javascript">
	var editor = CKEDITOR.replace( 'description2',{ contentsCss : '../css/editor.css'} );
	CKFinder.setupCKEditor( editor, 'ckfinder/' );	 
		</script>					</td>
                    </tr>
                    
                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="update" value="Submit" id="update" class="btn btn-primary" />&nbsp;&nbsp;<a href="innerpages.php" class="btn btn-inverse" >Cancel</a></td>
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
