<?php include("includes/app_top.php");
$stcat='Admin';
$pagetitle="Admins";
$getid = getid('id');
checkAdminLogin();
if(!stristr($_SESSION['access'],"a"))
  tep_redirect(tep_href_link('profile.php','action1=err'));
 
if($action=="add2")
{
$password=sha1(cleanQuery($_POST['password']));
$username=cleanQuery($_POST['username']);
$email=cleanQuery($_POST['email']);
$designation=cleanQuery($_POST['designation']);
 $query="insert into admins (username, password, email, designation, datemodified) VALUES ('$username', '$password', '$email', '$designation','$date')";
mysqli_query($mysqli, $query);
tep_redirect(tep_href_link($pagename,'action1=success'));
} 
if($action=="change")
{
$password=cleanQuery($_POST['password2']);
$username=cleanQuery($_POST['username2']);
$email=cleanQuery($_POST['email2']);
$designation=cleanQuery($_POST['designation2']);
$query="update admins set username='$username', email='$email', designation='$designation', datemodified='$date' where id=".$getid;
mysqli_query($mysqli, $query);
if($password!='')
{
$password2=sha1($password);
$query2="update admins set password='".$password2."' where id=".$getid;
mysqli_query($mysqli, $query2);
}
tep_redirect(tep_href_link($pagename,'action1=success1'));
}
if($action=="achange")
{
if(is_array($_POST["accesslevel2"])==true)
					$accesslevelStr = implode("",$_POST["accesslevel2"]);
				 else  
					$accesslevelStr = $_POST["accesslevel2"];
$query="update admins set access='" . $accesslevelStr . "', datemodified='".$date."'  where id=". $getid;
mysqli_query($mysqli, $query);
tep_redirect(tep_href_link($pagename,'action1=success2'));
}
?>
<?php include("includes/styles.php");?> 
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="text12" align="center">
                 <tr><td> 
                 <div class="pageHeadingBlock ">
                    <div class="grayBackground">
                    <div class="fR t-r">
                            <a onClick="displayadd();" class="btn btn-small btn-primary coursesMenu">Add Admin</a>
                        </div>
                    <h3 class="title">Administrator</h3>
                    
                    </div>
                </div>
                 </td></tr>
   
                 <tr>
                   <td  ><table width="100%" border="0"  cellpadding="0" cellspacing="0">  <tr>
                                 <td height="34" align="right"><strong><a  > </a>&nbsp;</strong></td>
                               </tr>
                                <tr>
                                 <td><div id="messages"><?php
if($action1=="success") { echo '<div class="alert alert-success">Added new Admin Successfully.</div>';}?>
<?php
if($action1=="success1") { echo '<div class="alert alert-success">Updated Admin details Successfully.</div>';}?>
<?php
if($action1=="success2") { echo '<div class="alert alert-success">Updated Admin Access options Successfully.</div>';}?>
                        <?php
if($action1=="err") { echo '<div class="alert alert-error">Something Error. </div>';}?></div></td>
                               </tr>
                                <tr>
                                 <td> <div id="addrecord" style="display:none">
                                     <form action="admins.php?action=add2" method="post" name="frmadd" id="frmadd">
                                      <div class="box-bg-rt" style="width:400px; margin:0 auto">
										<table width="100%" border="0" cellspacing="0" cellpadding="3" class="table table_vam table-black bN">
                                            <thead>
                                            <tr>
                                             <th width="150" align="right">Add Admin user</th>
                                             <th >&nbsp;</th>
                                           </tr>
                                           </thead>
                                           <tr>
                                             <td align="right"> User Name :&nbsp;</td>
                                             <td><input type="text" name="username"    value=""/>                                             </td>
                                           </tr>
                                           <tr>
                                             <td align="right"> Password :&nbsp;</td>
                                             <td><input type="text" name="password"   value=""/>                                             </td>
                                           </tr>
                                           <tr>
                                             <td align="right"> Email :&nbsp;</td>
                                             <td><input type="text" name="email"   value=""/>                                             </td>
                                           </tr>
                                             <tr>
                                             <td align="right"> Designation :&nbsp;</td>
                                             <td><input type="text" name="designation"   value=""/>                                             </td>
                                           </tr>
                                           <tr>
                                             <td>&nbsp;</td>
                                             <td><input type="submit" name="register" value="Submit" id="Button1" class="btn btn-primary sepV_c" /><a  onclick="closeadd();" class="btn btn-inverse" >Cancel</a></td>
                                           </tr>
                                           <tr>
                                             <td>&nbsp;</td>
                                             <td>&nbsp;</td>
                                           </tr>
                                         </table>
                                       </div>
                                     </form>
                                   </div>  <?php
if($action=="aedit") { ?>
                                     <?php $access=return_field('admins','id',$getid,'access');?>
                                     <form action="<?php echo $pagename;?>?action=achange&id=<?php echo $getid;?>" method="post"  name="frmadd" id="frmadd">
                                       <div class="box-bg-rt" style="width:400px; margin:0 auto">
						
                                         <table width="100%" border="0" cellspacing="0" cellpadding="3" class="table table_vam table-black bN">
                                             <thead>
                                             <tr>
                                             <th align="left" colspan="2">Change Admin User Access Rights</th>
                                           </tr>
                                           </thead>
                                           
                                            <?php 
											$sql="SELECT  * FROM  `states`";  
											$result=mysqli_query($mysqli, $sql);
											 while($row=mysqli_fetch_assoc($result)) {
											?>
                                            <tr>
                                            <td align="center"><input type="checkbox"  name="accesslevel2[]" value="<?php echo $row['access'];?>"  <?php if(stristr($access,$row['access'])){ echo "checked"; }?> /></td>
                                            <td>Manage <?php echo $row['name'];?></td>
                                           </tr>
                                           <?php }?>  
                                           <tr>
                                             <td colspan="2" align="center"><input type="submit" name="register" value="Submit" id="Button1" class="btn btn-primary sepV_b" /><a class="close_editbox btn btn-inverse" > Cancel </a></td>
                                           </tr>
                                           
                                         </table>
                                       </div>
                                     </form>
                                   <?php }?>
                                     <?php
if($action=="edit") { ?>
                                     <?php $query="select * from admins where id=". $getid; 
				 
				$res=mysqli_query($mysqli, $query);
              $row=mysqli_fetch_assoc($res);?>
                                     <form action="<?php echo $pagename;?>?action=change&id=<?php echo $getid;?>" method="post"  name="frmadd" id="frmadd">
                                         <div class="box-bg-rt" style="width:450px; margin:0 auto">
											<table width="100%" border="0" cellspacing="0" cellpadding="3" class="table table_vam table-black bN">
                                           <thead>
                                            <tr>
                                             <th width="38%" align="right">Edit Admin user</th>
                                             <th width="62%">&nbsp;</th>
                                           </tr>
                                           
                                           <tr>
                                             <td align="right"> User Name :&nbsp;</td>
                                             <td><input type="text" name="username2"    value="<?php echo $row['username'];?>"/>                                             </td>
                                           </tr>
                                             <tr>
                                             <td align="right"> Password :&nbsp;</td>
                                             <td><input type="text" name="password2"   value=""/>                                             </td>
                                           </tr>
                                           <tr>
                                             <td colspan="2" align="center"><span class="base">(Enter new password to change. Else leave blank)</span></td>
                                           </tr>
                                           <tr>
                                             <td align="right"> Email :&nbsp;</td>
                                             <td><input type="text" name="email2"   value="<?php echo $row['email'];?>"/>                                             </td>
                                           </tr>
                                              <tr>
                                             <td align="right"> Designation :&nbsp;</td>
                                             <td><input type="text" name="designation2"   value="<?php echo $row['designation'];?>"/>                                             </td>
                                           </tr>
                                           <tr>
                                             <td>&nbsp;</td>
                                             <td><input type="submit" name="register" value="Submit" id="Button1" class="btn btn-primary sepV_b" /><a class="close_editbox btn btn-inverse" > Cancel </a></td>
                                           </tr>
                                           
                                         </table>
                                       </div>
                                     </form>
                                   <?php }?></td>
                               </tr>
                               <tr>
                                 <td >&nbsp;</td>
                               </tr>
                               <tr>
                                 <td ><table width="100%"  class="table table-hover  table_vam table-black" >
                                     <thead>
                                     <tr >
                                       <th width="40" align="center" >No.</th>
                                       <th    style="text-align:left" > Name</th>
                                       <th width="240" >Designation</th>
                                       <th width="80" >Last Login </th>
                                       <th width="60" >Status</th>
                                       <th width="55" >Access</th>
                                       <th width="90" >Action</th>
                                     </tr>
                                     </thead>
                                     <?php                                           
					 
                                             $sql="select * from admins order by username";  
                                           $result=mysqli_query($mysqli, $sql);
										   
					  if(mysqli_num_rows($result) == 0)
                                           {
                                       ?>
                                     <tr>
                                       <td class="norecords" colspan="7">No Admins </td>
                                   </tr >
                                     <?php  }
									   
                                           $cnt = 0;
                                           while($row=mysqli_fetch_assoc($result))
                                           {
										   $cnt=$cnt+1;
                                       ?>
                                     <tr>
                                       <td valign="top" ><?php  echo $cnt; ?></td>
                                       <td style="text-align:left"><?php  echo $row['username']; ?></td>
                                       <td > 
                                         <?php  echo $row['designation']; ?>                               </td>
                                       <td ><?php  echo dateformat($row['lastlogin']); ?></td>
                                       
                                    <?php if(!stristr($row['access'],"a")){?>  <td >
                                    <i class="pointer <?php echo ($row['status2'] != 0) ? 'icon-ok' : 'icon-ban-circle';?>" id="statusimg_<?php echo $row['id'];?>" onClick="change_status('admins','<?php echo $row['id'];?>');" title="change status"></i>
                                    </td> 
                                    <td><a href="admins.php?action=aedit&id=<?php  echo $row['id'];?>">Access</a> </td>
                                       <td> <a href="send-mail.php?aid=<?php echo $row['id'];?>"><i class="icon-envelope"></i></a>&nbsp;&nbsp;<a href="admins.php?action=edit&id=<?php  echo $row['id'];?>#a" title="Edit"><i class="icon-pencil"></i></a>
									   <a href="#" class="admindelete" id="<?php echo $row['id'];?>" title="Delete"><i class="icon-trash"></i></a>
									   <?php  }else {  echo '<td colspan="2" align="center"><b>Super Admin</b></a></td><td> <a href="admins.php?action=edit&id='.$row['id'].'#a" title="Edit"><i class="icon-pencil"></i></a>';}?> </td>
                                     </tr>
                                     <?php     }										  
                                       ?>
                                 </table></td>
                               </tr>
                              
                             
                             </table></td>
                 </tr>
           </table> 
	<?php include("includes/footer.php");?>
</body>
</html>
