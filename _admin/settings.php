<?php
include("includes/app_top.php");
$pcat="Miscellaneous";
$pagetitle="Settings";
checkAdminLogin();
checkState();
if(!stristr($_SESSION['access'],"a"))
  tep_redirect(tep_href_link('profile.php','action1=err'));
 

if($action=='savedb')
{
backup_tables();
$query="update settings set dblastbackup='". $date2."'";
mysqli_query($mysqli, $query);
tep_redirect(tep_href_link($pagename,'action1=success2'));
} 
if($action=='cache')
{
EmptyDir('../cache');
 tep_redirect(tep_href_link($pagename,'action1=success3'));

} 

if($action=="update")
  {
$query="update settings set adminemail='".cleanQuery($_POST['adminemail'])."',state_id='".cleanQuery($_POST['stateid'])."',  sitename='".cleanQuery($_POST['sitename'])."', siteurl='".cleanQuery($_POST['siteurl'])."', records=".cleanQuery($_POST['records']).",call_later=".cleanQuery($_POST['call_later']).",daylimit=".cleanQuery($_POST['daylimit']).", description='".cleanQuery($_POST['description'])."', facebook='".cleanQuery($_POST['facebook'])."',category=".cleanQuery($_POST['category']).", twitter='".cleanQuery($_POST['twitter'])."', datemodified='".$date."'  where state_id=".$stateid;
mysqli_query($mysqli, $query);
tep_redirect(tep_href_link($pagename,'action1=success'));
}
?>
<?php include("includes/styles.php");?>
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
<div class="pageHeadingBlock ">
                    <div class="grayBackground">                    
                    <h3 class="title">Settings</h3>
                    <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
                    </div>
                </div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="text12" align="center">
          <tr>
            <td style="padding:10px 0">
			<div id="messages">
			<?php
if($action1=="success") { echo '<div class="alert alert-success">Updated settings Successfully.</div>';}?>
<?php
if($action1=="success2") { echo '<div class="alert alert-success">Database backup done Successfully.</div>';}if($action1=="success3") { echo '<div class="alert alert-success">Cachec Cleared Successfully.</div>';}if($action1=="err") { echo '<div class="error">Something Error. </div>';}?>
</div>
</td>
          </tr>
          <tr>
            <td height="55" style="line-height:22px"><?php
					 $query="select * from settings where state_id=".$stateid; 				 
		$res=mysqli_query($mysqli, $query);
              $row=mysqli_fetch_assoc($res);?><a href="<?php echo $pagename;?>?action=savedb">Click here for backup the database.</a> Store latest database in backupdb folder with <a href="<?php echo $pagename;?>?action=savedb"><u>db-backup-today date</u>.</a><br />
Database Last backup : <b><?php echo date("m-d-Y", strtotime($row['dblastbackup']));?>.</b></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
           <tr>
            <td><a href="<?php echo $pagename;?>?action=cache"><strong>Click here to Clear Cache</strong></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td ><form name="form1" action="<?php echo $pagename;?>?action=update" onSubmit="return validate(this)" method="post"> 
                    <table class="tblstyle2" width="100%" cellpadding="5" > 
                      
                      <tr>
                        <td width="159">Admin Email</td>
                        <td width="773"> 
                          <input size="30" name="adminemail" value="<?php echo $row['adminemail'];?>" type="text" />
                          <input name="stateid" value="<?php echo $stateid;?>" type="hidden" />  
                        </td>
                      </tr>
                      <tr>
                         <td>Site Name</td>
                         <td><input size="30" name="sitename" value="<?php echo $row['sitename'];?>" type="text" /></td>
                       </tr>         
                     
                        <tr>
                         <td>Site URL</td>
                         <td><input size="30" name="siteurl" value="<?php echo $row['siteurl'];?>" type="text" /></td>
                       </tr> 
                         <tr>
                            <td>Category</td>
                            <td><select name="category"  id="category"  >
                        <?php
                                          $sql2 = "select * from categories where state_id=$stateid order by  catname asc";
                                          $result2 = mysqli_query($mysqli,$sql2);
                                          while ($row2 = mysqli_fetch_assoc($result2))
                                          {
                                            ?>
                        <option  value="<?php echo $row2['id'];?>" <?php if($row2['id']==$row['category'])echo ' selected="selected"';?> ><?php echo $row2['catname'];?> </option>
                        <?php }?>
                      </select></td>
                          </tr>
                       
                             <tr>
                         <td>Additional Info with Link (Show in get Details)</td>
                         <td><textarea name="description" cols="30" rows="3"><?php echo $row['description'];?></textarea></td>
                       </tr> <tr>
                         <td>Records per page</td>
                         <td><input size="30" name="records" value="<?php echo $row['records'];?>" type="text" /></td>
                       </tr>
                        <tr>
                         <td>Per Day Contacts Limit </td>
                         <td><input size="30" name="daylimit" value="<?php echo $row['daylimit'];?>" type="text" /></td>
                       </tr> 
                         <tr>
                         <td>Call Later Limit </td>
                         <td><input size="30" name="call_later" value="<?php echo $row['call_later'];?>" type="text" /></td>
                       </tr> 
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td  colspan="2"><strong>Social Bookmark Links</strong></td>
                          </tr>
                          <tr>
                            <td>Facebook Link</td>
                            <td><input size="30" name="facebook" value="<?php echo $row['facebook'];?>" type="text" /></td>
                          </tr>
                          <tr>
                            <td>Twitter Link</td>
                            <td><input size="30" name="twitter" value="<?php echo $row['twitter'];?>" type="text" /></td>
                          </tr>
                          
                       <tr>
                        <td>&nbsp;</td>
                        <td><input class="btn btn-primary" name="button2" type="submit" value="Update" /></td>
                      </tr>
                    </table>
            </form></td>
          </tr>
        
           </table>
	<?php include("includes/footer.php");?>
</body>
</html>
