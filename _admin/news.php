<?php
include("includes/app_top.php");
$pcat="Miscellaneous";
$pagetitle="News";
$getid = getid('id');$pid = getid('pid');$t=get('t');
checkAdminLogin();
checkState();

 if ($action == "addnews")
{
$imgsrc='';
if($_FILES['ufile']['name']!="")
{
$path1= "../pictures/news/". $_FILES['ufile']['name'];
$imgsrc=$_FILES['ufile']['name'];
$a=copy($_FILES['ufile']['tmp_name'], $path1);
if(!$a)
 tep_redirect(tep_href_link($pagename,'action1=err'));
}
$orderno=($_POST['orderno']!='')?cleanQuery($_POST['orderno']):0;
    $query = "insert into news(description,state_id,  orderno, imgsrc,datemodified) VALUE ('".cleanQuery($_POST['description'])."', '".cleanQuery($_POST['stateid'])."', ".$orderno.",'$imgsrc','$date')";
    mysqli_query($mysqli, $query);
  // echo $query;
   tep_redirect(tep_href_link($pagename, 'action1=add&action=add'));
}
if($action=="change")
  {
$imgsrc=return_field('news','id',$getid,'imgsrc');    
if($_FILES['ufile']['name']!="")
{
$path1= "../pictures/news/". $_FILES['ufile']['name'];
$imgsrc=$_FILES['ufile']['name'];
$a=copy($_FILES['ufile']['tmp_name'], $path1);
if(!$a)
 tep_redirect(tep_href_link($pagename,'action1=err'));
}
$orderno=($_POST['orderno2']!='')?cleanQuery($_POST['orderno2']):20;  
$query="update news set description='" . cleanQuery($_POST['description']). "', orderno=".$orderno.",  imgsrc='$imgsrc', datemodified='$date'  where id=".$getid;
mysqli_query($mysqli, $query);
      tep_redirect(tep_href_link($pagename,'action1=update'));
}

?>
 
<?php include("includes/styles.php");?>
<?php include("includes/colorbox.php");?>
<script type="text/javascript">
function validate(form){
if (form.description.value=='') {alert('Please enter news description'); form.description.focus(); return false}

return true;
}
function validate(form){
if (form.description.value=='') {alert('Please enter news description'); form.description.focus(); return false}

return true;
}

</script>
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
<div class="pageHeadingBlock ">
     <div class="grayBackground">
     <div class="fR t-r spcT_c">
     <a href="<?php echo $pagename;?>?action=add" class="btn btn-small btn-primary">Add News</a>
           
      </div>
     <h3 class="title">News</h3>
      <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
     </div>
  </div>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="main-text">
          
           <tr>
                    <td colspan="8"><div id="messages"> 
           <?php
if($action1=="success") { echo '<div class="alert alert-success">Deleted Successfully.</div>';} 

if($action1=="err") { echo '<div class="alert alert-error">Something Error. </div>';}?></div></td>
                  </tr>
            <tr>
                                 <td><?php
if($action=="add") { ?>
                                     <form action="<?php echo $pagename;?>?action=addnews" method="post" name="frmadd" id="frmadd" onSubmit="return validate(this);" enctype="multipart/form-data">
                                       <div class="box-bg-rt" style="width:450px; margin:0 auto"><br />
						
                                         <table width="100%" border="0" cellspacing="0" cellpadding="3" class="table table_vam table-black bN">
                                          <thead>
                                           <tr>
                                             <th align="right">Add News</th>
                                             <th>&nbsp;</th>
                                           </tr>
                                           </thead>
                                           <tr>
                                             <td width="38%" align="right">Description : </td>
                                             <td width="62%">
                                             <textarea name="description"></textarea>
                                             <span class="red">*</span>                                              </td>
                                           </tr>
                                          <tr>
                                             <td align="right">Order No :&nbsp;</td>
                                             <td><input type="text" name="orderno" id="orderno"   value=""/>
                                             <input type="hidden" name="stateid" value="<?php echo $stateid;?>"/>
                                             </td>
                                           </tr>
                                           <tr>
                       <td align="right">Home page image :&nbsp;</td>
                       <td><input  name="ufile" type="file" id="ufile" /></td>
                     </tr> <tr>
                                             <td height="47">&nbsp;</td>
                                             <td><input type="submit" name="register" value="Submit" id="Button1" class="btn btn-primary" />
                                              <input type="button" name="cancel" value="Cancel" class="btn btn-inverse" onClick="location.href='<?php echo $pagename;?>'" /></td>
                                           </tr>
                                         </table>
                                       </div>
                                     </form>
                                   <?php }?> 
                                     <?php
if($action=="edit") {  
 $query="select * from news where id=". $getid; 
				 
				$res=mysqli_query($mysqli, $query);
              $row=mysqli_fetch_assoc($res);?>
                                     <form action="<?php echo $pagename;?>?action=change&amp;id=<?php echo $getid;?>" method="post" name="frmadd" id="frmadd" onSubmit="return validate2(this)" enctype="multipart/form-data">
                                       <div class="box-bg-rt" style="width:450px; margin:0 auto"><br />
						
                                         <table width="100%" border="0" cellspacing="0" cellpadding="3" class="table table_vam table-black bN"> 
                                         <thead>
                                         <tr>
                                           <th width="33%" align="right">Edit News</th>
                                           <th width="67%">&nbsp;</th>
                                         </tr>
                                         </thead>
                                         <tr>
                                           <td align="right">Description : </td>
                                           <td>
                                           <textarea name="description"><?php echo $row['description'];?></textarea>
                                           
                                               <span class="red">*</span> </td>
                                         </tr>
                                         
                                           <tr>
                                           <td align="right">Order No :&nbsp;</td>
                                           <td><input type="text" name="orderno2" id="orderno2"   value="<?php echo $row["orderno"];?>"/></td>
                                         </tr>
                                          <tr>
                       <td align="right">Picture :&nbsp;</td>
                       <td><input  name="ufile" type="file" id="ufile" /></td>
                     </tr>
                                         <tr>
                                           <td height="44">&nbsp;</td>
                                           <td><input type="submit" name="submit" value="Submit" id="Button1" class="btn btn-primary" />
                                             <input type="button" name="cancel" value="Cancel" class="btn btn-inverse" onClick="location.href='<?php echo $pagename;?>'" /></td>
                                         </tr>
                                       </table>
                                       </div>
                                     </form>
                                   <?php }?></td>
                                   
                               </tr> 
                               <tr>
            <td height="50"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                
                <td ><form name="search" method="post" action="news.php?action=filter" onSubmit="return validate4(this)" class="mN"><strong>Keyword :</strong>
                <input type="text" name="keyword" id="keyword" class="input coursesMenu" style="width:150px"  value="<?php if($action=='filter')echo $_POST['keyword'];?>"/>
                 &nbsp; <input type="submit" name="register" value="Search" id="Button1" class="btn btn-primary" />
                  <a href="<?php echo $pagename;?>" class="btn btn-inverse" >Clear</a>
                </form></td>
               
              </tr>
            </table>
                               <tr>
           
                    <td colspan="2"><table width="100%"  class="table table-hover  table_vam table-black">
                    <thead>
                            <tr>
                              <th width="50" align="center" >No.</th>
                              <th align="center"  width="130">Picture</th>
                              <th  align="left">News</th>
                              <th width="150">Date Modified</th>
                              <th width="70">Order No</th>
                              
                              <th width="100">Status</th>
                              <th width="85">Action</th>
                            </tr>
                            </thead>
                            <?php                
                                            $sql="SELECT * FROM  `news` where state_id=".$stateid;
											if($action=="filter")
											{
											$keyword=cleanQuery($_POST['keyword']);
											$sql= $sql." and description like '%".$keyword."%'"; 
											}
											$sql=$sql." order by orderno asc";
											//echo $sql;
											  include("includes/paging2.php");
                                            $result=mysqli_query($mysqli, $sql);
											
					  if(mysqli_num_rows($result) == 0)
                                           {
                                       ?>
                            <tr>
                              <td  class="norecords" colspan="9">No News  <?php if($action=="filter")echo " with this filter";?></td>
                            </tr >
                            <?php  }
								   
                                           while($row=mysqli_fetch_assoc($result))
                                           { $cnt++;  
										     $imagesrc = "../pictures/news/". $row['imgsrc'];
                                       ?>
                            <tr>
                              <td ><?php  echo $cnt; ?></td>
                                <td>
                                    <?php 	 	if (file_exists($imagesrc)&&$row['imgsrc']!="") 
													{ 
													?>
                                    <a href="<?php echo $imagesrc;?>" class="col" title="<?php echo $row['title']; ?>"  ><img src="<?php echo $imagesrc; ?>" width="50" border="0"/></a>                                    
													<?php }
													?>                                                    </td>
                              <td style="text-align:left"><?php echo $row['description']; ?></td>
                              <td><?php  echo $row['datemodified']; ?></td>
                              <td><?php  echo $row['orderno']; ?></td>
                              
                              <td align="center">
                              <i class="pointer <?php echo ($row['status2'] != 0) ? 'icon-ok' : 'icon-ban-circle';?>" id="statusimg_<?php echo $row['id'];?>" onClick="change_status('news','<?php echo $row['id'];?>');" title="change status"></i>                              </td>
                              <td align="center"><a href="<?php echo $pagename;?>?action=edit&id=<?php  echo $row['id'];?>" title="Edit"><i class="icon-pencil"></i></a>
							  <a href="#" class="newsdelete" id="<?php echo $row['id'];?>" title="Delete"><i class="icon-trash"></i></a>							  </td>
                            </tr>
                            <?php   } 										  
                                       ?>
                      </table></td>
                  </tr>
                
                  <tr>
                    <td style="padding:12px 0" colspan="2"><?php
					if($pid!='')$_SESSION['pagingid']='?pid='.$pid;
include("includes/paging.php"); ?>                    </td>
                  </tr> 
               
                            </table> 
	<?php include("includes/footer.php");?>
</body>
</html>
