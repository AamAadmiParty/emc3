<?php include("includes/app_top.php");
    $pagetitle2="View Profile";
    checkUserLogin();
    ?>
<?php include("includes/styles.php");?>
<?php include("../includes/colorbox.php");?>
</head>
<body>
<?php include("includes/header.php");?>
<div class="division-1">
<h1><?php echo $pagetitle2;?></h1>
<p align="right"><a href="edit-profile.php" title="Edit Profile"><strong>Edit Profile</strong></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="change-password.php" title="Change Password"><strong>Change Password</strong></a></p>

<?php $query="select * from users where id=". $_SESSION['userid'];
				$res=mysqli_query($mysqli,$query);
    $row=mysqli_fetch_assoc($res);?>
<table width="100%" border="0" cellspacing="0" cellpadding="5">

<tr valign="top">
<td colspan="2"><div class="heading3">Personal Details:</div></td>
</tr> <tr> <td width="120"  >Name<span class="required"> </span> </td>
<td  ><?php echo $row['name'];?></td>
</tr>
<tr> <td  > Email Id  </td>
<td><?php echo $row['email'];?></td>
</tr>
<tr> <td  >Gender</td>
<td><?php echo $row['gender'];?></td>
</tr>
<tr valign="top">
<td colspan="2"><div class="heading3">Contact Details:</div></td>
</tr>
<tr>

<td>Phone No : </td><td><?php echo $row['countrycode'];?> <?php echo $row['phone'];?></td>

</tr>
<tr> <td  >State</td>
<td><?php echo $row['state'];?></td>
</tr>
<tr> <td  >City</td>
<td><?php echo $row['city'];?></td>
</tr>
<tr> <td  >Country</td>
<td><?php echo $row['country'];?></td>
</tr>
<tr valign="top">
<td colspan="2"><div class="heading3">Campaign Details:</div></td>
</tr>
<tr>

<td>Dataset : </td><td><?php echo return_field('categories','id',$categoryid,'description');?></td>

</tr>
</table>

</div></div>
<?php include("includes/footer.php");?>
</body>
</html>
