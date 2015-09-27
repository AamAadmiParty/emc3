<?php
include("includes/app_top.php");
$pcat="Website";
$pagetitle="Videos";
$getid = get('id') ;

checkAdminLogin();
checkState();
 
if($action=="add")
{
$orderno=($_POST['orderno']!='')?cleanQuery($_POST['orderno']):1;
$pageurl=conurl(cleanQuery($_POST['pageurl']));
    $query = "insert into videos(heading, person, catid, orderno, video, datemodified, pagetitle, description, keywords, metadesc, pageurl) VALUES ('".cleanQuery($_POST['heading'])."','".cleanQuery($_POST['person'])."', ".$_POST['category'].",".$orderno.",'".cleanQuery($_POST['videoid'])."','$date','".cleanQuery($_POST['pagetitle'])."','".cleanQuery($_POST['description'])."', '".cleanQuery($_POST['metakeywords'])."', '".cleanQuery($_POST['metadesc'])."','$pageurl')";
    mysqli_query($mysqli, $query);
tep_redirect(tep_href_link($pagename,'action1=success'));
}

if($action=="edit")
  {
$orderno=($_POST['orderno2']!='')?cleanQuery($_POST['orderno2']):1;
$pageurl=conurl(cleanQuery($_POST['pageurl2']));
$query="update videos set description='" . cleanQuery($_POST['description2']). "',  catid=" . $_POST['category2']. ", pageurl='" . $pageurl. "', video='" . cleanQuery($_POST['videoid2']). "', person='" . cleanQuery($_POST['person2']). "', pagetitle='" . cleanQuery($_POST['pagetitle2']). "',  keywords='" . cleanQuery($_POST['metakeywords2']) . "', metadesc='" . cleanQuery($_POST['metadesc2']) . "',  orderno= ".$orderno.", heading='" . cleanQuery($_POST['heading2']). "',   datemodified='".$date."'  where id=". $getid;
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
     alert("Please enter page name");form.pagename.focus();
     return false;
    }
  }
</script>
<?php include("includes/ckeditor.php");
?>
<?php include("includes/colorbox.php");?>
</head>
<body class="admin">
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
<div class="pageHeadingBlock ">
     <div class="grayBackground clearfix">
     <div class="fR t-r">
           <a href="videos.php" class="clearfix">&larr;back to Vidoes</a>
           <a href="subcat.php?cid=1" class="btn btn-small btn-primary coursesMenu">Video Categories</a>
     </div>
     <h3 class="title"><?php echo ($getid!="")?'Edit':'Add';?> Video</h3>
     </div>
  </div>
     <h2></h2>
      <?php if($getid==""){?><table width="100%" border="0"  cellpadding="0" cellspacing="0"><tr>
                    <td><div id="messsages"><?php
if($action1=="success") { echo '<div class="alert alert-success">Added video Successfully.</div>';}?>
                        <?php
if($action1=="err") { echo '<div class="alert alert-error">Something Error. </div>';}?></div></td>
                  </tr>
          <tr>
            <td>  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="text9">
                  
                
                  <tr>
                    <td><form name="frmadd" action="<?php echo $pagename;?>?action=add"  enctype="multipart/form-data"  onsubmit="return checkval(this);" method="post">
					 <table width="100%" border="0" cellspacing="0" cellpadding="3" class="text9" align="center">
                  
                  <tr>
                    <td width="38%" align="right">Heading :&nbsp;</td>
                    <td width="62%"> 
                      <input type="text" name="heading"   value=""  onBlur="this.form.pageurl.value=this.value;"/> 
                      <span class="red">*</span> </td>
                  </tr>
                       <tr>
                        <td align="right">Speaker Name &amp; Designation:&nbsp;</td>
                        <td><input type="text" name="person"   value=""/></td>
                      </tr> <tr>
                                             <td  align="right">Category :&nbsp;</td>
                                             <td ><select name="category" class="input" id="category">
                                                <option value="0">Select</option>
                                                 <?php
                                          $sql2 = "select * from subcat where catid=1 order by orderno";
                                          $result2 = mysqli_query($mysqli, $sql2);
                                          while ($row2 = mysqli_fetch_assoc($result2))
                                          {
                                            ?>
                                                 <option  value="<?php echo $row2['id'];?>"> <?php echo $row2['scname'];?> </option>
                                                 <?php }?>
                                             </select></td>
                                           </tr> <tr>
                    <td align="right">Meta Page   Title :&nbsp;</td>
                    <td><textarea name="pagetitle" rows="3" ></textarea>
                        <span class="red">*</span> </td>
                  </tr>  <tr>
                    <td align="right">Meta Keywords :&nbsp;</td>
                    <td><textarea name="metakeywords" rows="3" ></textarea></td>
                  </tr>
                  <tr>
                    <td align="right">Meta Description  :&nbsp;</td>
                    <td><textarea name="metadesc" rows="3" ></textarea></td>
                  </tr>

                    <tr>
                                             <td align="right">Youtube ID : </td>
                                             <td><input type="text" name="videoid"  class="input"  value=""/> <span class="red">*</span> </td>
                                           </tr>
                                          <tr>
                    <td height="32" colspan="2" align="center" class="bld-txt" style="font-size:11px"><strong class="blue11">Ex: </strong>http://www.youtube.com/watch?v=<span class="blue-bold"><strong>L7AAz9nSOyY</strong></span> (Video id is - <span class="blue-bold"><strong>L7AAz9nSOyY</strong></span>)</td>
                    </tr>   <tr>
                                             <td align="right">Order No :&nbsp;</td>
                                             <td><input type="text" name="orderno" id="orderno"   value=""/></td>
                                           </tr>
                    <tr>
                      <td align="right">Page URL :&nbsp;</td>
                      <td><input name="pageurl" type="text"   value="" /></td>
                    </tr>
                    <tr>
                   <td colspan="2" align="center"> <textarea cols="80" id="description" name="description" rows="10"></textarea>
					<script type="text/javascript">
	var editor = CKEDITOR.replace( 'description',{ contentsCss : '../styles/editor.css'} );
	CKFinder.setupCKEditor( editor, 'ckfinder/' ) ;	 
		</script></td>
                    </tr>
                 
                     <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="add" value="Submit" id="add" class="btn btn-primary" />&nbsp;&nbsp;<a href="videos.php" class="btn btn-inverse" >Cancel</a></td>
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
if($action1=="success") { echo '<div class="alert alert-success">Updated Video Successfully.</div>';}?>
                        <?php
if($action1=="err") { echo '<div class="alert alert-error">Something Error. </div>';}?></div></td>
                  </tr>
          <tr>
            <td>  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="text9">
                  
                
                  <tr>
                    <td><?php $query="select * from videos where id=".$getid; 
		  
				$res=mysqli_query($mysqli, $query);
              $row=mysqli_fetch_assoc($res);
			 
			  ?><form name="frmadd" action="<?php echo $pagename;?>?action=edit&id=<?php echo $getid;?>"  enctype="multipart/form-data" method="post">
					 <div  ><table width="100%" border="0" cellspacing="0" cellpadding="3" class="text9" align="center">
                  
                 <tr>
                                           <td align="right">Heading : </td>
                                           <td><input type="text" name="heading2"  class="input"  value="<?php echo $row['heading'];?>"/>
                                               <span class="red">*</span> </td>
                                         </tr>
                                            <tr>
                        <td align="right">Speaker Name &amp; Designation:&nbsp;</td>
                        <td><input type="text" name="person2"   value="<?php echo $row['person'];?>"/></td>
                      </tr><tr>
                                           <td  align="right">Category :&nbsp;</td>
                                           <td><select name="category2" class="input" id="category2">
                                                        <option value="0">Select</option>

                                               <?php
                                          $sql2 = "select * from subcat where catid=1 order by orderno";
                                          $result2 = mysqli_query($mysqli, $sql2);
                                          while ($row2 = mysqli_fetch_assoc($result2))
                                          {
                                            ?>
                                               <option  value="<?php echo $row2['id'];?>" <?php if($row2['id']==$row['catid'])echo 'selected="selected"';?>> <?php echo $row2['scname'];?> </option>
                                               <?php }?>
                                           </select></td>
                                         </tr> <tr>
                    <td align="right">Page   Title :&nbsp;</td>
                    <td><textarea name="pagetitle2" rows="3" ><?php echo $row['pagetitle'];?></textarea>
                        <span class="red">*</span> </td>
                  </tr>
  <tr>
                    <td align="right">Meta Keywords :&nbsp;</td>
                    <td><textarea name="metakeywords2" rows="3" ><?php echo $row['keywords'];?></textarea></td>
                  </tr>
                  <tr>
                    <td align="right">Meta Description  :&nbsp;</td>
                    <td><textarea name="metadesc2" rows="3" ><?php echo $row['metadesc'];?></textarea></td>
                  </tr>
                 
                                         <tr>
                                           <td align="right">Youtube ID : </td>
                                           <td><input type="text" name="videoid2"  class="input"  value="<?php echo $row['video'];?>"/>
                                               <span class="red">*</span> </td>
                                         </tr>
                                          <tr>
                    <td height="32" colspan="2" align="center" class="bld-txt" style="font-size:11px"><strong class="blue11">Ex: </strong>http://www.youtube.com/watch?v=<span class="blue-bold"><strong>L7AAz9nSOyY</strong></span> (Video id is - <span class="blue-bold"><strong>L7AAz9nSOyY</strong></span>)</td>
                    </tr>   <tr>
                                           <td align="right">Order No :&nbsp;</td>
                                           <td><input type="text" name="orderno2" id="orderno2"   value="<?php echo $row["orderno"];?>"/></td>
                                         </tr>
                                         
                  <tr>
                    <td align="right">Page URL :&nbsp;</td>
                    <td><input name="pageurl2" type="text"   value="<?php echo $row['pageurl'];?>" /></td>
                  </tr>
                  <tr>
                   <td colspan="2" align="center">
				     <textarea cols="80" id="description2" name="description2"  rows="10"><?php
					 $description=str_replace("\"images/","\"../images/",$row['description']);
					  echo $description;?></textarea>
                    <script type="text/javascript">
	var editor = CKEDITOR.replace( 'description2',{ contentsCss : '../styles/editor.css'} );
	CKFinder.setupCKEditor( editor, 'ckfinder/' ) ;	 
		</script>					</td>
                    </tr>
                    
                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="update" value="Submit" id="update" class="btn btn-primary" />&nbsp;&nbsp;<a href="videos.php" class="btn btn-inverse" >Cancel</a></td>
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
