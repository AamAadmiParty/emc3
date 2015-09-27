<?php
include("includes/app_top.php");

checkAdminLogin();
checkState();
$getid= getid('id');

if($action =="change")
{
$query="update users set  comments='" . cleanQuery($_POST['comments']). "' where id=".$getid;
 mysqli_query($mysqli, $query);
//echo $query;
tep_redirect(tep_href_link($pagename,'action1=update&id='.$getid));
}
?>
<?php include("includes/styles.php");?>
</head>
<body class="bgwhite">
<h1>View Member Details</h1>
<?php $query="select * from users where id=". $getid." limit 1";
				$res=mysqli_query($mysqli, $query);
              $row=mysqli_fetch_assoc($res);			 
			  ?> 
               <div id="messages"><?php
if($action1=="update") { echo '<div class="alert alert-success">Updated details.</div>';}

?></div>                                   
              <form action="view-member-details.php?action=change&amp;id=<?php echo $getid;?>" method="post" >
                              <table width="100%" border="0" cellspacing="0" cellpadding="5">
 
  <tr valign="top">
                                        <td colspan="2"><strong>Personal Details:</strong></td>
    </tr> <tr> <td width="200"  >Name<span class="required"> </span> </td>
                                          <td  ><?php echo $row['name'];?></td>
              </tr>
              <tr> <td  > Email Id  </td>
                <td><?php echo $row['email'];?></td>
              </tr>
              
              
              <tr> <td  >Gender</td>
                <td><?php echo $row['gender'];?></td>
              </tr>
              
             
              
              <tr valign="top">
                                        <td colspan="2"><strong>Contact Details:</strong></td>
 </tr>  
 
  <tr>
                  
                    <td>Phone No : </td><td><?php echo $row['phone'];?></td> 
                    
    </tr> 
              <tr> <td  >City</td>
                <td><?php echo $row['city'];?></td>
              </tr>  
              <tr> <td  >State</td>
                <td><?php echo $row['state'];?></td>
              </tr>
                <tr> <td  >Country</td>
                <td><?php echo $row['country'];?></td>
              </tr> 
         <tr valign="top">
            <td colspan="2"><strong>Other Details:</strong></td>
    </tr>
                <tr> <td  >Reg. Date</td>
                <td><?php echo $row['datecreated'];?></td>
              </tr> 
                <tr> <td  >Last Login</td>
                <td><?php echo $row['lastlogin'];?></td>
              </tr>
              <tr> <td  >Last IP Address</td>
                <td><a href="http://www.ip-tracker.org/locator/ip-lookup.php?ip=<?php echo $row['ip_address'];?>" target="_blank"><?php echo $row['ip_address'];?></a></td>
              </tr> 
                <tr> <td  >Member Status</td>
                <td><?php echo $mstatus[$row['status2']];?></td>
              </tr>    
              <tr> <td>Trusted/Verified?</td>
                <td><?php echo $mstatus[$row['genuine']];?></td>
              </tr>
                <tr>
                  <td  >Total Contacts Done </td>
                  <td><?php echo contactscount($row['id']);?></td>
                </tr>
                <tr> <td  >Admin Comments</td>
                <td><textarea name="comments"><?php echo $row['comments'];?></textarea></td>
              </tr>   
              <tr>
              	<td>&nbsp;</td>
                <td><input type="submit" class="btn btn-primary" value="Update" /></td>
              </tr> 
</table> 
</form>
</body>
</html>
