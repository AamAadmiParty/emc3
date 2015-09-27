<?php
include("includes/app_top.php");

checkAdminLogin();
checkState();
$getid= getid('id');

?>
<?php include("includes/styles.php");?>
</head>
<body class="bgwhite">
<div class="division-1">
<h1>Other Contact Details</h1>
<?php $query="select * from other_contacts where id=". $getid." limit 1";
				$res=mysqli_query($mysqli, $query);
              $row=mysqli_fetch_assoc($res);			 
			  ?> 
                              <table width="100%" border="0" cellspacing="0" cellpadding="5">
                              
              <tr> <td width="200"  >Contact Phone</td>
                <td><?php echo $row['contact'];?></td>
              </tr>
              
              <tr> <td  >Is Called</td>
                <td><?php if($row['iscalled']!=0)echo $getconnected[$row['iscalled']];?></td>
              </tr>
              <tr> <td  >Vote</td>
                <td><?php echo $vote4aap[$row['vote']];?></td>
              </tr>
               <tr> <td  >Date Called</td>
                <td><?php echo $row['contactdate'];?></td>
              </tr>
              <tr>
                <td  >Comments</td>
                <td><?php echo $row['comments'];?></td>
              </tr>
        </table>
</div>
</body>
</html>
