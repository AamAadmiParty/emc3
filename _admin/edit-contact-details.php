<?php
include("includes/app_top.php");

checkAdminLogin();
checkState();
$getid= getid('id');
if ($action == "update")
{
$query="update contacts set contact='".cleanQuery($_POST['contact'])."', iscalled=".cleanQuery($_POST['iscalled']).",vote=".cleanQuery($_POST['vote']).",comments='".cleanQuery($_POST['comments'])."', contactdate='".cleanQuery($_POST['contactdate'])."' where id=".$getid;
mysqli_query($mysqli, $query);
tep_redirect(tep_href_link($pagename,'action1=success&id='.$getid));
}

?>
<?php include("includes/styles.php");?>
</head>
<body class="bgwhite">
<div class="division-1">
<h1>Contact Details</h1>
<div id="messages"><?php
if($action1=="success") { echo '<div class="alert alert-success">Updated member contact details.</div>';}?>
</div>
<?php $query="select * from contacts where id=". $getid." limit 1";
				$res=mysqli_query($mysqli, $query);
              $row=mysqli_fetch_assoc($res);			 
			  ?> <form name="frmadd" action="<?php echo $pagename;?>?action=update&id=<?php echo $getid;?>"  enctype="multipart/form-data" method="post">
                              <table width="100%" border="0" cellspacing="0" cellpadding="5">
                              
              <tr> <td width="200"  >Contact Phone</td>
                <td><input type="text" name="contact"   value="<?php echo $row['contact'];?>"/></td>
              </tr> 
              
              <tr> <td  >Is Called</td>
                <td><select  name="iscalled" id="confirmed" />
                   <option value="No">No</option>
                        <option value="1" <?php if($row['iscalled']=='1')echo 'selected="selected"';?> >Yes</option>
                        <option value="4" <?php if($row['iscalled']=='4')echo 'selected="selected"';?> >Not Reached</option>
                         <option value="2" <?php if($row['iscalled']=='2')echo 'selected="selected"';?> >Wrong Number</option>
                          <option value="3" <?php if($row['iscalled']=='3')echo 'selected="selected"';?> > Call Later</option>
                        </select></td>
              </tr>
              <tr> <td  >Vote</td>
                <td>  <select  name="vote" id="confirmed" />
                   
                        <option value="1" <?php if($row['vote']=='1')echo 'selected="selected"';?> >Yes</option>
                        <option value="0" <?php if($row['vote']=='0')echo 'selected="selected"';?> >No</option>
                         <option value="2" <?php if($row['vote']=='2')echo 'selected="selected"';?> >Undecided</option>
                        </select></td>
              </tr>
               <tr> <td  >Date Called</td>
                <td><input type="text" name="contactdate"   value="<?php echo $row['contactdate'];?>"/> </td>
              </tr>
              <tr>
                <td  >Comments</td>
                <td><textarea name="comments" rows="3" ><?php echo $row['comments'];?></textarea></td>
              </tr>
              <tr>
                <td  >&nbsp;</td>
                <td><input type="submit" name="register" value="Update" id="Button1" class="btn btn-primary sepV_b" /></td>
              </tr>
              
        </table></form>
</div> 
</body>
</html>
