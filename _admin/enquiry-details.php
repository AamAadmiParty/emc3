<?php include("includes/app_top.php");
$getid=getid('id');
checkAdminLogin();
checkState();
 if($action=="update")
  {
$comments=cleanQuery($_POST['comments']);
$query="update enquiries set admincomments='" . $comments. "' where id=".$getid;
 mysqli_query($mysqli, $query);
    tep_redirect(tep_href_link($pagename,'action1=success&id='.$getid));
}
?>
<?php include("includes/styles.php");?> 
</head>
<body>
<?php include("includes/header.php");?>
<h1>Enquiry Details</h1>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="text9">

                  <tr> 
                    <td align="right" height="30" style="font-weight:bold"><a href="enquiries.php">Back to Enquiries</a>&nbsp; | &nbsp;&nbsp;<a href="send-mail.php?eid=<?php echo $getid;?>">Reply Mail</a></td> 
      </tr> 
                                  <tr>

                    <td><div id="messages"><?php 
if($action1=="success") { echo '<div class="alert alert-success">Updated Comments Successfully</div>';}
if($action1=="success2") { echo '<div class="alert alert-success">Updated Enquiry Details Successfully</div>';}
?></div></td>

                  </tr>

                  <tr>

                    <td><?php $query="select * from enquiries where id=". $getid." limit 1"; 
					$res=mysqli_query($mysqli, $query);
					$row=mysqli_fetch_assoc($res);
					?>              </td>

                  </tr>

                  <tr>

                    <td> <table width="100%" align="center" cellpadding="5" cellspacing="0"  class="main-text">

              <tbody>

      
                <tr>

                  <td width="158"   > Name</td>

                  <td width="14">:</td>

                  <td width="724"><?php echo $row['name'];?></td>
                </tr>

                <tr>

                  <td   >Email Address </td>

                  <td>:</td>

                  <td><?php echo $row['email'];?></td>
                </tr>


                <tr>
                  <td  >Message</td>
                  <td>:</td>
                  <td><?php echo $row['comments'];?></td>
                </tr>
                <tr>

                  <td>Date Sent </td>

                  <td>:</td>

                  <td><?php echo $row['datesent'];?></td>
                </tr>
              </tbody>

            </table>
                    <form name="appointment" action="<?php echo $pagename;?>?action=update&id=<?php echo $getid;?>" method="post"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="main-text">

                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>

                        <td width="19%"><strong>Admin Comments</strong></td>

                        <td width="81%"><textarea name="comments" rows="8"  class="input" id="comments" style="width:400px"><?php echo $row['admincomments'];?></textarea></td>
                      </tr>

                      <tr>

                        <td>&nbsp;</td>

                        <td><input class="button2" name="button" type="submit" value="Update" /></td>
                      </tr>

                    </table>
            </form></td>

                  </tr>

        

                </table>
<?php include("includes/footer.php");?>
</body>
</html>
