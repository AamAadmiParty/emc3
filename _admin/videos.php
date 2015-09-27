<?php
include("includes/app_top.php");
$pcat="Website";
$pagetitle="Videos";
$getid = getid('id');$pid = getid('pid');$t=get('t');
checkAdminLogin();
checkState();
 if ($action == "addvideo")
{
$orderno=($_POST['orderno']!='')?cleanQuery($_POST['orderno']):20;
    $query = "insert into videos(heading,  orderno, youtube, datemodified) VALUE ('".cleanQuery($_POST['heading'])."', ".$orderno.",'".cleanQuery($_POST['videoid'])."','$date')";
    mysqli_query($mysqli, $query);
  // echo $query;
   tep_redirect(tep_href_link($pagename, 'action1=add&action=add'));
}
if($action=="change")
  {
$orderno=($_POST['orderno2']!='')?cleanQuery($_POST['orderno2']):20;  
$query="update videos set heading='" . cleanQuery($_POST['heading2']). "', orderno=".$orderno.", youtube='" . cleanQuery($_POST['videoid2']). "', datemodified='$date'  where id=".$getid;
mysqli_query($mysqli, $query);
      tep_redirect(tep_href_link($pagename,'action1=update'));
}
if($action =="f")
  { 
  $query="update videos set ishome=0";
  mysqli_query($mysqli, $query);
  $query="update videos set ishome=1 where id=".$getid;
  mysqli_query($mysqli, $query);
  //echo $query;
  tep_redirect(tep_href_link($pagename,'action1=success2'));
 }
?>
 
<?php include("includes/styles.php");?>
<?php include("includes/colorbox.php");?>
<script type="text/javascript">
function validate1(form){
if (form.heading.value=='') {alert('Please enter video heading'); form.heading.focus(); return false}
if (form.videoid.value=='') {alert('Please enter youtube video id'); form.videoid.focus(); return false}
return true;
}
function validatevideo2(form){
if (form.heading2.value=='') {alert('Please enter video heading'); form.heading2.focus(); return false}
if (form.videoid2.value=='') {alert('Please enter youtube video id'); form.videoid2.focus(); return false}
return true;
}
function vtype(id)
{
for(i=0;i<=4;i++)
{
  document.getElementById("v"+i).style.display="none";
}
  document.getElementById("v"+id).style.display="block";
}
</script>
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
<div class="pageHeadingBlock ">
     <div class="grayBackground">
     <div class="fR t-r spcT_c">
     <a href="<?php echo $pagename;?>?action=add" class="btn btn-small btn-primary coursesMenu">Add Video</a>
           
      </div>
     <h3 class="title">Videos</h3>
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
if($action1=="success2") { echo '<div class="alert alert-success">Updated video status.</div>';} 
if($action1=="err") { echo '<div class="alert alert-error">Something Error. </div>';}?></div></td>
                  </tr>
            <tr>
                                 <td><?php
if($action=="add") { ?>
                                     <form action="<?php echo $pagename;?>?action=addvideo" method="post" name="frmadd" id="frmadd" onSubmit="return validate1(this);">
                                       <div class="box-bg-rt" style="width:450px; margin:0 auto"><br />
						
                                         <table width="100%" border="0" cellspacing="0" cellpadding="3" class="table table_vam table-black bN">
                                          <thead>
                                           <tr>
                                             <th align="right">Add Video</th>
                                             <th>&nbsp;</th>
                                           </tr>
                                           </thead>
                                           <tr>
                                             <td width="38%" align="right">Heading : </td>
                                             <td width="62%"><input type="text" name="heading"  class="input"  value=""/> <span class="red">*</span>                                              </td>
                                           </tr>
                                           
                                             <tr>
                                             <td align="right" width="38%">Youtube ID : </td>
                                             <td><input type="text" name="videoid"  class="input"  value=""/> <span class="red">*</span> </td>
                                           </tr>
                                          <tr>
                    <td height="32" colspan="2" align="center" class="bld-txt" style="font-size:11px"><strong class="blue11">Ex: </strong>http://www.youtube.com/watch?v=<span class="blue-bold"><strong>L7AAz9nSOyY</strong></span> (Video id is - <span class="blue-bold"><strong>L7AAz9nSOyY</strong></span>)</td>
                    </tr> 
                                        
                    
                    <tr>
                                             <td align="right">Order No :&nbsp;</td>
                                             <td><input type="text" name="orderno" id="orderno"   value=""/></td>
                                           </tr>
                                           <tr>
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
 $query="select * from videos where id=". $getid; 
				 
				$res=mysqli_query($mysqli, $query);
              $row=mysqli_fetch_assoc($res);?>
                                     <form action="<?php echo $pagename;?>?action=change&amp;id=<?php echo $getid;?>" method="post" name="frmadd" id="frmadd" onSubmit="return validate2(this)">
                                       <div class="box-bg-rt" style="width:450px; margin:0 auto"><br />
						
                                         <table width="100%" border="0" cellspacing="0" cellpadding="3" class="table table_vam table-black bN"> 
                                         <thead>
                                         <tr>
                                           <th width="33%" align="right">Edit Video</th>
                                           <th width="67%">&nbsp;</th>
                                         </tr>
                                         </thead>
                                         <tr>
                                           <td align="right">Heading : </td>
                                           <td><input type="text" name="heading2"  class="input"  value="<?php echo $row['heading'];?>"/>
                                               <span class="red">*</span> </td>
                                         </tr>
                                         
                                         <tr>
                                           <td align="right">Youtube ID : </td>
                                           <td><input type="text" name="videoid2"  class="input"  value="<?php echo $row['youtube'];?>"/>
                                               <span class="red">*</span> </td>
                                         </tr>
                                          <tr>
                    <td height="32" colspan="2" align="center" class="bld-txt" style="font-size:11px"><strong class="blue11">Ex: </strong>http://www.youtube.com/watch?v=<span class="blue-bold"><strong>L7AAz9nSOyY</strong></span> (Video id is - <span class="blue-bold"><strong>L7AAz9nSOyY</strong></span>)</td>
                    </tr>   <tr>
                                           <td align="right">Order No :&nbsp;</td>
                                           <td><input type="text" name="orderno2" id="orderno2"   value="<?php echo $row["orderno"];?>"/></td>
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
                
                <td ><form name="search" method="post" action="videos.php?action=filter" onSubmit="return validate4(this)" class="mN"><strong>Keyword :</strong>
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
                              <th  align="left">Heading</th>
                              
                              <th width="70">Order No</th>
                              <th width="150">Video</th>
                              <th width="100">Default Video</th>
                              <th width="100">Status</th>
                              <th width="85">Action</th>
                            </tr>
                            </thead>
                            <?php                
                                            $sql="SELECT * FROM  `videos`";
											if($action=="filter")
											{
											$keyword=cleanQuery($_POST['keyword']);
											$sql= $sql." where heading like '%".$keyword."%'"; 
											}
											
											if($t=="home")											 
											$sql=$sql." where ishome=1";
											$sql=$sql." order by orderno asc";
											//echo $sql;
											  include("includes/paging2.php");
                                            $result=mysqli_query($mysqli, $sql);
											
					  if(mysqli_num_rows($result) == 0)
                                           {
                                       ?>
                            <tr>
                              <td  class="norecords" colspan="8">No Videos  <?php if($action=="filter")echo " with this filter";?></td>
                            </tr >
                            <?php  }
								   
                                           while($row=mysqli_fetch_assoc($result))
                                           { $cnt++;  
                                       ?>
                            <tr>
                              <td ><?php  echo $cnt; ?></td>
                              <td style="text-align:left"><?php echo $row['heading']; ?></td>
                              <td><?php  echo $row['orderno']; ?></td>
                              <td align="center"><a href="youtube.php?id=<?php echo $row['youtube'];?>"  class="video2" title="<?php echo $row['heading'];?>" rel="colorbox2" ><img src='http://i1.ytimg.com/vi/<?php echo $row['youtube'];?>/default.jpg' width="100" height="75"></a></td>
                              <td align="center"><?php echo ($row['ishome']==1)?'<span class="red">Default Video</span>':'<a href="videos.php?action=f&id='.$row['id'].'">Make it as Default ?</a>';?></td>
                              <td align="center">
                              <i class="pointer <?php echo ($row['status2'] != 0) ? 'icon-ok' : 'icon-ban-circle';?>" id="statusimg_<?php echo $row['id'];?>" onClick="change_status('videos','<?php echo $row['id'];?>');" title="change status"></i>
                              </td>
                              <td align="center"><a href="<?php echo $pagename;?>?action=edit&id=<?php  echo $row['id'];?>" title="Edit"><i class="icon-pencil"></i></a>
							  <a href="#" class="videodelete" id="<?php echo $row['id'];?>" title="Delete"><i class="icon-trash"></i></a>
							  </td>
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
