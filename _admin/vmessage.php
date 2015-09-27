<?php
include("includes/app_top.php");

checkAdminLogin();
checkState();
$getid= getid('id');



if($action =="change")
{
$query="update volunteer set  comments='" . cleanQuery($_POST['comments']). "' where id=".$getid;
 mysqli_query($mysqli, $query);
//echo $query;
tep_redirect(tep_href_link($pagename,'action1=update&id='.$getid));
}
?>
<?php include("includes/styles.php");?>
</head>
<body style="background-image:none; background-color:#FFFFFF"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0"   class="main-text" align="center">
          <tr>
            <td><h1>View Volunteers Message</h1></td>
          </tr> 
         <tr>
            <td> <?php $query="SELECT * from volunteer where id =". $getid." limit 1";
				$res=mysqli_query($mysqli, $query);
				//echo $query;
              $row=mysqli_fetch_assoc($res);			 
			  ?>
           <div id="messages"><?php
if($action1=="update") { echo '<div class="alert alert-success">Updated details.</div>';}

?></div>                                   
              <form action="vmessage.php?action=change&id=<?php echo $getid;?>" method="post" >   <table class="mgrey2" border="0" cellpadding="6" cellspacing="0" width="100%">
                <tbody>
                  <tr >
                    <td width="158"    ><strong> Name : </strong></td>
                    <td width="724"><?php if($row['userid']!='')echo return_field('users','id',$row['userid'],'name');?></td>
                  </tr> 
  <tr >
                    <td   ><strong>Email : </strong></td>
                    <td  ><?php echo $row['email'];?></td>
                  </tr> 
                  <tr >
                    <td   ><strong>Message : </strong></td>
                    <td  ><?php echo nl2br($row['message']);?></td>
                  </tr> 
                   
                    <tr valign="top">
                    <td  ><strong>Date Sent : </strong></td>
                    <td  ><?php echo $row['datesent'];?></td>
                 </tr><tr>
				  <tr> <td  >Admin Comments</td>
                <td><textarea name="comments"><?php echo $row['comments'];?></textarea></td>
              </tr>   
              <tr>
              	<td>&nbsp;</td>
                <td><input type="submit" class="btn btn-primary" value="Update" /></td>
              </tr>  
                </tbody>
            </table>
			</form>
			</td>
          </tr> 
        </table>
</body>
</html>
