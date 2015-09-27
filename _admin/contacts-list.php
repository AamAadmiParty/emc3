<?php include("includes/app_top.php");
$pagetitle2="Today's Contacted List";
$contacts="";
checkUserLogin();

?>
<?php include("includes/styles.php");?>

</head>
<body>
 <?php include("includes/header.php");?> 
<div class="division-1">
           <h1><?php echo $pagetitle2;?></h1>
           <br />
           <?php $query1="
		   
		   SELECT * from contacts where `userid` =".$_SESSION["userid"]. " and date(contacts.contactdate) = '" .$date2."'"; 			
		   		$res1=mysqli_query($mysqli, $query1);
				
			if(mysqli_num_rows($res1) == 0)
                                           {
                                       ?>
                               <p class="norecords">No Contacts retrieved today.</p>
                                <?php  }
								else
								{ ?>
									 <table class="tblclass" width="100%">
    	<tr>
        <th>S.no</th>
        <th>Person Name</th>
        <th>Contact No</th>
		<th>Email Id</th>
        <th>State</th>
        <th>Is Called</th>
        <th>Address</th>
        <th>Date Taken</th>
        </tr>
        <?php
						   $cnt=0;
								 while($row=mysqli_fetch_assoc($res))
                                           {  $cnt++;
                                       ?>
        <tr>
        	<td width="35"><?php echo $cnt ?></td>
        	<td width="120"><?php echo $row['person_name'];?></td>
            <td width="100"><?php echo $row['contact'];?></td>
            <td width="150"><?php echo $row['email'];?></td>
            <td width="100"><?php echo $row['state'];?></td>
            <td width="60"><?php echo ($row['iscalled']==1)?'Yes':'No';?></td>
            <td ><?php echo $row['address'];?></td>
             <td width="120"><?php echo $row['datetaken'];?></td>
        </tr>
        <?php } ?>
    </table><?php }?>
</div>
 <?php include("includes/footer.php");?>           
           </body>
</html>
