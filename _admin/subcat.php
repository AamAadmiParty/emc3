<?php
include("includes/app_top.php");
$pcat="Members";
$pagetitle="Categories";
$getid = getid('id');
$catid = isset($_GET['cid']) ? $_GET['cid'] : $_SESSION['catid'];
if($catid!='')
$_SESSION['catid']=$catid;
$catname=return_field('categories','id',$catid,'catname');

checkAdminLogin();
checkState();



 if($action=="addcategory")
  {  
   $sql="select scname from subcat where scname= '" . cleanQuery($_POST['categoryname']) ."' and catid=".$catid;
     $result=mysqli_query($mysqli, $sql);
$orderno=($_POST['orderno']!='')?cleanQuery($_POST['orderno']):0;
	  if(mysqli_num_rows($result) == 0)
{					  
$query="insert into subcat (scname, orderno, catid, datemodified) VALUE ('".cleanQuery($_POST['categoryname'])."',$orderno, $catid, '$date')";
   mysqli_query($mysqli, $query);
  tep_redirect(tep_href_link($pagename,'action1=add&action=add'));
}
else
{
tep_redirect(tep_href_link($pagename,'action1=adderr'));
}
}             
 if($action=="change")
  {
$orderno=($_POST['orderno2']!='')?cleanQuery($_POST['orderno2']):0;
$category=$_POST['category'];  
$query="update subcat set scname='" . cleanQuery($_POST['categoryname2']) . "', orderno=".$orderno.",   catid=".$category."  where id=".$getid;
mysqli_query($mysqli, $query);
      tep_redirect(tep_href_link($pagename,'action1=update2'));
}
 
?>
<?php include("includes/styles.php");?>
<script type="text/javascript">
function checkval(form)
 {
    if(form.categoryname.value==""){ alert("Please enter category name");form.categoryname.focus();return false;}
  }
function checkval2(form)
 {
    if(form.categoryname2.value==""){ alert("Please enter category name");form.categoryname2.focus();return false;}
  }

</script>
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
<div class="pageHeadingBlock ">
        	<div class="grayBackground">
        	<div class="fR t-r spcT_b">
            	<a href="categories.php" class="clearfix">&larr; back to Categories</a>
                <a  onclick="displayadd();" class="btn btn-primary coursesMenu">Add Sub Category</a>
            </div>
            <h3 class="title"><?php echo $catname;?></h3>
            <div class="sectionTabNav clearfix">
            	
            </div>
        	</div>
        </div>
        
        <div class="clearfix sepH_b"></div>

<table width="100%" border="0"  cellpadding="0" cellspacing="0">  
               
                  <tr>
                                 <td  ><div id="messages"><?php
if($action1=="update") { echo '<div class="alert alert-success">Updated category.</div>';}
if($action1=="adderr") { echo '<div class="alert alert-error">Already this sub category have.</div>';}
if($action1=="err") { echo '<div class="alert alert-error">Something Error. </div>';}?></div></td>
                               </tr>
                                <tr>
                                 <td><div id="addrecord" style="display:none">
                                     <form action="subcat.php?action=addcategory" method="post" name="frmadd" id="frmadd" onSubmit="return checkval(this);" >
                                       <div class="box-bg-rt" style="width:400px; margin:0 auto">
										 <table width="100%" border="0" cellspacing="0" cellpadding="3" class="table table_vam table-black bN">
                                          <thead>
                                           <tr>
                                             <th align="right">Add Sub Category</th>
                                             <th>&nbsp;</th>
                                           </tr>
                                           </thead>
                                           <tr>
                                             <td width="38%" align="right">Category   Name :&nbsp;</td>
                                             <td width="62%"><input type="text" name="categoryname" id="categoryname"   value=""/>                                             </td>
                                           </tr>
                                           
                                           <tr>
                                             <td align="right">Order No :&nbsp;</td>
                                             <td><input type="text" name="orderno" id="orderno"   value=""/></td>
                                           </tr>
                                           
                                           <tr>
                                             <td>&nbsp;</td>
                                             <td><input type="submit" name="register" value="Submit" id="Button1" class="btn btn-primary" />
                                               &nbsp;&nbsp;<a onClick="closeadd();" class="btn btn-inverse" >Cancel</a></td>
                                           </tr>
                                           
                                         </table>
                                       </div>
                                     </form>
                                  </div></td>
                               </tr>
                               <tr>
                                 <td><a name="edit" id="edit"></a>
                                     <?php
if($action=="edit") { ?>
                                     <?php $query="select * from subcat  where id=". $getid; 
				 
				$res=mysqli_query($mysqli, $query);
              $row=mysqli_fetch_assoc($res);?>
                                     <form action="subcat.php?action=change&amp;id=<?php echo $getid;?>" method="post" enctype="multipart/form-data" name="frmadd" id="frmadd" onSubmit="return checkval2(this);">
                                        <div class="box-bg-rt" style="width:400px; margin:0 auto">
						
                                         <table width="100%" border="0" cellspacing="0" cellpadding="3" class="table bN  table_vam table-black"> 
                                         <thead>
                                           <tr>
                                             <th align="right">Edit Sub Category</th>
                                             <th>&nbsp;</th>
                                           </tr>
                                           </thead>
                                         <tr>
                                           <td width="38%" align="right">Category  Name :&nbsp;</td>
                                           <td width="62%"><input type="text" name="categoryname2" id="categoryname"   value="<?php echo $row["scname"];?>"/>                                           </td>
                                         </tr>
                                         
                                         <tr>
                                           <td align="right">Category :&nbsp;</td>
                                           <td><select name="category" >
                                             <option value="" selected="selected">Select</option>
                                             <?php
                              $sql2 = "select * from  categories";
                              $result2 = mysqli_query($mysqli, $sql2);
                              while ($row2 = mysqli_fetch_assoc($result2))
                              {
                                ?>
                                             <option  value="<?php echo $row2['id'];?>" <?php if($row2['id']==$row['catid'])echo 'selected="selected"';?>><?php echo $row2['catname'];?> </option>
                                             <?php }?>
                                           </select></td>
                                         </tr>
                                         <tr>
                                           <td align="right">Order No :&nbsp;</td>
                                           <td><input type="text" name="orderno2" id="orderno2"   value="<?php echo $row["orderno"];?>"/></td>
                                         </tr>
                                         
                                         <tr>
                                           <td>&nbsp;</td>
                                           <td><input type="submit" name="submit" value="Submit" id="Button1" class="btn btn-primary" />
                                             &nbsp;&nbsp;<a class="close_editbox btn btn-inverse" > Cancel </a></td>
                                         </tr>
                                         
                                       </table>
                                       </div>
                                     </form>
                                   <?php }?></td>
                               </tr> 
                               <tr>
                                 <td height="15" align="right">&nbsp;</td>
                               </tr>
                               <tr>
                                 <td ><table width="100%"  class="table table-hover  table_vam table-black" >
                                     <thead>
                                     <tr >
                                       <th width="44" align="center" >No.</th>
                                       <th   >Sub Category Name</th>
                                       <th width="120" >Category</th>
                                       <th width="65" >Order No</th>
                                       <th width="60" >Action</th>
                                     </tr>
                                     </thead>
                                     <?php                                           
					 
                                             $sql="select * from subcat  where catid=".$catid." order by orderno, scname";                                             
                                         
                                           $result=mysqli_query($mysqli, $sql);
										   
					  if(mysqli_num_rows($result) == 0)
                                           {
                                       ?>
                                     <tr>
                                       <td class="norecords" colspan="5">No Sub Categories in <?php echo $catname;?></td>
                                     </tr >
                                     <?php  }
									   
                                           $cnt = 0;
                                           while($row=mysqli_fetch_assoc($result))
                                           {
										   $cnt  =$cnt+1;
                                       ?>
                                     <tr>
                                       <td valign="top" width="44"><?php  echo $cnt; ?></td>
                                       <td style="text-align:left"><?php  echo $row['scname']; ?></td>
                                       <td > <?php echo $catname;?></td>
                                       <td ><?php  echo $row['orderno']; ?></td>
                                       <td><a href="<?php echo $pagename;?>?action=edit&id=<?php  echo $row['id'];?>" title="Edit"><i class="icon-pencil"></i></a>
                                       <a href="#" class="scdelete" id="<?php echo $row['id'];?>" title="Delete"><i class="icon-trash"></i></a>
									   </td>
                                     
                                     </tr>
                                     <?php     }										  
                                       ?>
                                 </table></td>
                               </tr> 
                              
                             </table> 
	<?php include("includes/footer.php");?>
</body>
</html>
