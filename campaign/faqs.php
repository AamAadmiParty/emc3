<?php include("includes/app_top.php");
checkUserLogin();
?>
<?php include("includes/styles.php");?>
<?php include("../includes/colorbox.php");?>

</head>
<body>
 <?php include("includes/header.php");?> 
            <div class="division-1 clearfix">
           <h1>FAQS</h1>
             <ul class="clearfix list m0 column-row">
<?php $sql="select * from videos where status2=1 and state_id=".$stateid." order by id desc"; 	
include("includes/paging2.php");	  
								$res=mysqli_query($mysqli, $sql);
								if(mysqli_num_rows($res) == 0)
							   echo '<p class="norecords">No FAQS</p>';
								$cnt=0;							   
							   while($row=mysqli_fetch_assoc($res))
														   { $cnt++; ?>
<li class="column-3">
 <div class="clearfix lrp4 bp4">
	<iframe src="http://www.youtube.com/embed/<?php echo $row['youtube']; ?>?rel=0"   width="100%" height="230" frameborder="0"  allowfullscreen=""></iframe>
	<p align="center"><?php echo $row['heading']; ?></p>
    </div>
</li>        <?php }?>                                                   
</ul>
           </div>
 <?php include("includes/footer.php");?>           
           </body>
</html>
