<?php
include("includes/app_top.php");
$getid= getid('id');
checkUserLogin();
?>
<?php include("includes/styles.php");?>
</head>
<body style="background-image:none; background-color:#FFFFFF"> 
 <?php $query="select profile, name, lastname from committees where id=". $getid." limit 1";
				$res=mysqli_query($mysqli, $query);
              $row=mysqli_fetch_assoc($res);			 
			  ?>
              <table width="98%" border="0" cellpadding="0" cellspacing="0" class="main-text" align="center">
          <tr>
            <td><h1><?php echo $row['name'].' '.$row['lastname'].' Profile';?></h1></td>
          </tr> 
          <tr>
            <td><?php echo $row['profile'];?></td>
          </tr> 
        </table>
</body>
</html>
