<?php
include("includes/app_top.php");
$pcat="Contacts";
$pagetitle="Categories";
$getid = getid('id');

checkAdminLogin();
checkState(); 
 if($action=="addcategory")
  {
    $query="insert into categories (catname,state_id,datemodified,volunteer,booth,buzz,`call`,jansabha,donate) VALUE ('".cleanQuery($_POST['categoryname'])."','".cleanQuery($_POST['stateid'])."','$date',".cleanQuery($_POST['volunteer']).",".cleanQuery($_POST['booth']).",".cleanQuery($_POST['buzz']).",".cleanQuery($_POST['call']).",".cleanQuery($_POST['jansabha']).",".cleanQuery($_POST['donate']).")";
    mysqli_query($mysqli, $query);
    tep_redirect(tep_href_link($pagename,'action1=add&action=add'));
}             
 if($action=="change")
  {
    $query="update categories set catname='".cleanQuery($_POST['categoryname2'])."',state_id='".cleanQuery($_POST['stateid2'])."',datemodified='".$date."',volunteer=".cleanQuery($_POST['volunteer2']).",booth=".cleanQuery($_POST['booth2']).",buzz=".cleanQuery($_POST['buzz2']).",`call`=".cleanQuery($_POST['call2']).",jansabha=".cleanQuery($_POST['jansabha2']).",donate=".cleanQuery($_POST['donate2'])." where id=".$getid;
    mysqli_query($mysqli, $query);
    tep_redirect(tep_href_link($pagename,'action1=update'));
}
?>
<?php include("includes/styles.php");?>
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
<div class="pageHeadingBlock ">
        	<div class="grayBackground">
        	<div class="fR t-r spcT_b">            	
                <a onClick="displayadd();"  class="btn btn-primary coursesMenu">Add Category</a>
            </div>
            <h3 class="title">Categories</h3>
            <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
        	</div>
        </div>
        
        <div class="clearfix sepH_b"></div>

<table width="100%" border="0"  cellpadding="0" cellspacing="0" class="">  
                 
                                 <tr>
                                 <td> <div id="addrecord" style="display:none">
                                     <form action="categories.php?action=addcategory" method="post" name="frmadd" id="frmadd">

 										<div class="box-bg-rt" style="width:400px; margin:0 auto">
						
                                         <table width="100%" border="0" cellspacing="0" cellpadding="3" class="table table_vam table-black bN">
                                           <thead>
                                           <tr>
                                             <th align="right">Add Category</th>
                                             <th>&nbsp;</th>
                                           </tr>
                                           </thead>
                                           
                                           <tr>
                                             <td width="38%" align="right">Category   Name :&nbsp;</td>
                                             <td width="62%"><input type="text" name="categoryname" id="categoryname"   value=""/>
                                             <input type="hidden" name="stateid"  value="<?php echo $stateid;?>"/>
                                             </td>
                                           </tr>

                                           <tr>
                                             <td width="38%" align="right">Volunteer&nbsp;</td>
                                             <td width="62%">
                                             <input type="radio" name="volunteer" id="volunteer1" value="1">Yes &nbsp;&nbsp;
                                             <input type="radio" name="volunteer" id="volunteer2" value="0" checked="checked"> No
                                             </td>
                                           </tr>
                                           <tr>
                                             <td width="38%" align="right">Booth Activites&nbsp;</td>
                                             <td width="62%">
                                             <input type="radio" name="booth" id="booth1" value="1">Yes &nbsp;&nbsp;
                                             <input type="radio" name="booth" id="booth2" value="0" checked="checked"> No
                                             </td>
                                           </tr>
                                           <tr>
                                             <td width="38%" align="right">Buzz Campaign&nbsp;</td>
                                             <td width="62%">
                                             <input type="radio" name="buzz" id="buzz1" value="1">Yes &nbsp;&nbsp;
                                             <input type="radio" name="buzz" id="buzz2" value="0" checked="checked"> No
                                             </td>
                                           </tr>
                                           <tr>
                                             <td width="38%" align="right">Pledge to Call&nbsp;</td>
                                             <td width="62%">
                                             <input type="radio" name="call" id="call1" value="1">Yes &nbsp;&nbsp;
                                             <input type="radio" name="call" id="call2" value="0" checked="checked"> No
                                             </td>
                                           </tr>
                                           <tr>
                                             <td width="38%" align="right">Organize Jan Sabha&nbsp;</td>
                                             <td width="62%">
                                             <input type="radio" name="jansabha" id="jansabha1" value="1">Yes &nbsp;&nbsp;
                                             <input type="radio" name="jansabha" id="jansabha2" value="0" checked="checked"> No
                                             </td>
                                           </tr>
                                           <tr>
                                             <td width="38%" align="right">Donate&nbsp;</td>
                                             <td width="62%">
                                             <input type="radio" name="donate" id="donate1" value="1">Yes &nbsp;&nbsp;
                                             <input type="radio" name="donate" id="donate2" value="0" checked="checked"> No
                                             </td>
                                           </tr>
                                           <tr>
                                             <td>&nbsp;</td>
                                             <td><input type="submit" name="register" value="Submit" id="Button1" class="btn btn-primary" />
                                               &nbsp;&nbsp;<a onClick="closeadd();" class="btn btn-inverse" >Cancel</a></td>
                                           </tr>
                                           
                                         </table>
                                       </div>
                                     </form>
                                   </div> 
                                     <?php
if($action=="edit") { ?>
                                     <?php $query="select * from categories where id=". $getid; 
				 
                                     $res=mysqli_query($mysqli, $query);
                                     $row=mysqli_fetch_assoc($res);?>
                                     <form action="categories.php?action=change&amp;id=<?php echo $getid;?>" method="post" enctype="multipart/form-data" name="frmadd" id="frmadd">
                                       <div class="box-bg-rt" style="width:400px; margin:0 auto">
										<table width="100%" border="0" cellspacing="0" cellpadding="3" class="table table_vam table-black bN"> 
                                         <thead>
                                         <tr>
                                           <th align="right">Edit Category</th>
                                           <th>&nbsp;</th>
                                         </tr>
                                         </thead>
                                         <tr>
                                           <td width="38%" align="right">Category  Name :&nbsp;</td>
                                           <td width="62%"><input type="text" name="categoryname2" id="categoryname2"   value="<?php echo $row["catname"];?>"/>
                                           <input type="hidden" name="stateid2"  value="<?php echo $stateid;?>"/>
                                           </td>
                                         </tr>

                                         <tr>
                                           <td width="38%" align="right">Volunteer&nbsp;</td>
                                             <td width="62%">
                                             <input type="radio" name="volunteer2" id="volunteer21" value="1" <?php echo ($row['volunteer']==1 ? 'checked="checked"' : '');?>>Yes &nbsp;&nbsp;
                                             <input type="radio" name="volunteer2" id="volunteer22" value="0" <?php echo ($row['volunteer']==0 ? 'checked="checked"' : '');?>> No
                                             </td>
                                         </tr>
                                         <tr>
                                           <td width="38%" align="right">Booth Activities&nbsp;</td>
                                             <td width="62%">
                                             <input type="radio" name="booth2" id="booth21" value="1" <?php echo ($row['booth']==1 ? 'checked="checked"' : '');?>>Yes &nbsp;&nbsp;
                                             <input type="radio" name="booth2" id="booth22" value="0" <?php echo ($row['booth']==0 ? 'checked="checked"' : '');?>> No
                                             </td>
                                         </tr>
                                         <tr>
                                           <td width="38%" align="right">Buzz Campaign&nbsp;</td>
                                             <td width="62%">
                                             <input type="radio" name="buzz2" id="buzz21" value="1" <?php echo ($row['buzz']==1 ? 'checked="checked"' : '');?>>Yes &nbsp;&nbsp;
                                             <input type="radio" name="buzz2" id="buzz22" value="0" <?php echo ($row['buzz']==0 ? 'checked="checked"' : '');?>> No
                                             </td>
                                         </tr>
                                         <tr>
                                           <td width="38%" align="right">Pledge to Call&nbsp;</td>
                                             <td width="62%">
                                             <input type="radio" name="call2" id="call21" value="1" <?php echo ($row['call']==1 ? 'checked="checked"' : '');?>>Yes &nbsp;&nbsp;
                                             <input type="radio" name="call2" id="call22" value="0" <?php echo ($row['call']==0 ? 'checked="checked"' : '');?>> No
                                             </td>
                                         </tr>
                                         <tr>
                                           <td width="38%" align="right">Organize Jan Sabha&nbsp;</td>
                                             <td width="62%">
                                             <input type="radio" name="jansabha2" id="jansabha2" value="1" <?php echo ($row['jansabha']==1 ? 'checked="checked"' : '');?>>Yes &nbsp;&nbsp;
                                             <input type="radio" name="jansabha2" id="jansabha2" value="0" <?php echo ($row['jansabha']==0 ? 'checked="checked"' : '');?>> No
                                             </td>
                                         </tr>
                                         <tr>
                                           <td width="38%" align="right">Donate&nbsp;</td>
                                             <td width="62%">
                                             <input type="radio" name="donate2" id="donate21" value="1" <?php echo ($row['donate']==1 ? 'checked="checked"' : '');?>>Yes &nbsp;&nbsp;
                                             <input type="radio" name="donate2" id="donate22" value="0" <?php echo ($row['donate']==0 ? 'checked="checked"' : '');?>> No
                                             </td>
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
                                 <td   align="center"><div id="messages">
                        <?php
if($action1=="add") { echo '<div class="alert alert-success">Added Category.</div>';}
if($action1=="update") { echo '<div class="alert alert-success">Updated Category.</div>';}						
if($action1=="err") { echo '<div class="alert alert-error">Something Error. </div>';}?></div></td>
                               </tr>  
                               <tr>
                                 <td >&nbsp;</td>
                               </tr>
                               <tr>
                                 <td ><table width="100%"  class="table table-hover  table_vam table-black" >
                                     <thead>
                                     <tr >
                                       <th width="47" align="center" >No.</th>
                                       <th width="222">Category Name</th>
                                       <th width="45" >Volunteer</th>
                                       <th width="45" >Booth</th>
                                       <th width="45" >Buzz</th>
                                       <th width="45" >Call</th>
                                       <th width="45" >Sabha</th>
                                       <th width="45" >Donate</th>
                                       <th width="115">Category Items</th>
                                       <th width="70" >Action</th>
                                     </tr>
                                     </thead>
                                     <?php                                           
					 
                                             $sql="select * from categories where state_id=".$stateid;                                             
                                           
                                           $result=mysqli_query($mysqli, $sql);
										   
					  if(mysqli_num_rows($result) == 0)
                                           {
                                       ?>
                                     <tr>
                                       <td class="norecords" colspan="4">No Categories</td>
                                     </tr >
                                     <?php  }
									   
                                           $cnt = 0;
                                           while($row=mysqli_fetch_assoc($result))
                                           {
										   $cnt  =$cnt+1;
                                       ?>
                                     <tr>
                                       <td valign="top" width="47"><?php  echo $cnt; ?></td>
                                       <td style="text-align:left"><?php  echo $row['catname']; ?></td>
                                       <td style="text-align:left"><?php  echo ($row['volunteer']==1 ? 'Yes' : 'No'); ?></td>
                                       <td style="text-align:left"><?php  echo ($row['booth']==1 ? 'Yes' : 'No'); ?></td>
                                       <td style="text-align:left"><?php  echo ($row['buzz']==1 ? 'Yes' : 'No'); ?></td>
                                       <td style="text-align:left"><?php  echo ($row['call']==1 ? 'Yes' : 'No'); ?></td>
                                       <td style="text-align:left"><?php  echo ($row['jansabha']==1 ? 'Yes' : 'No'); ?></td>
                                       <td style="text-align:left"><?php  echo ($row['donate']==1 ? 'Yes' : 'No'); ?></td>
                                       <td ><a href="contacts.php?cid=<?php echo $row['id'];?>">Contacts</a></td>
                                       <td><a href="<?php echo $pagename;?>?action=edit&id=<?php  echo $row['id'];?>" title="Edit"><i class="icon-pencil"></i></a>
									   <a href="#" class="catdelete" id="<?php echo $row['id'];?>" title="Delete"><i class="icon-trash"></i></a>
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
