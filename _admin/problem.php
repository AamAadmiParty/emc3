<?php
include("includes/app_top.php");

checkAdminLogin();
checkState();
$getid= getid('id');
?>
<?php include("includes/styles.php");?>
</head>
<body style="background-image:none; background-color:#FFFFFF"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0"   class="main-text" align="center">
          <tr>
            <td><h1>View Report Problems</h1></td>
          </tr> 
         <tr>
            <td> <?php $query="SELECT `problems`.*,users.name FROM `problems` INNER JOIN `users` where problems . id =". $getid." limit 1";
				$res=mysqli_query($mysqli, $query);
				//echo $query;
              $row=mysqli_fetch_assoc($res);			 
			  ?>
              <table class="mgrey2" border="0" cellpadding="6" cellspacing="0" width="100%">
                <tbody>
                  <tr >
                    <td width="158"    ><strong> Name : </strong></td>
                    <td width="724"><?php echo $row['name'];?></td>
                  </tr> 

                  <tr >
                    <td   ><strong>Problem : </strong></td>
                    <td  ><?php echo nl2br($row['report']);?></td>
                  </tr> 
                   
                    <tr valign="top">
                    <td  ><strong>Date Sent : </strong></td>
                    <td  ><?php echo $row['datesent'];?></td>
                  
                  
                </tbody>
            </table></td>
          </tr> 
        </table>
</body>
</html>
