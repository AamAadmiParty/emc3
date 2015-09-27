<?php
include("includes/app_top.php");
$pcat="Website";
$pagetitle="Profile";
checkAdminLogin();
checkState();

?>
<?php include("includes/styles.php");?>
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
<div class="pageHeadingBlock ">
        	<div class="grayBackground">
        	<h3 class="title">Reports</h3>
            <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
        	</div>
        </div>
        
        <div class="clearfix sepH_b"></div>
 <?php 
$res1=mysqli_query($mysqli, "SELECT id from users where date(datecreated) ='".$date2. "'");
$res2=mysqli_query($mysqli, "SELECT id from users where date(datecreated) ='".$date2. "' and status2=1");
$res3=mysqli_query($mysqli, "SELECT id from users where date(datecreated) ='".$date2. "' and status2=0");
$res4=mysqli_query($mysqli, "SELECT id from users");
$res5=mysqli_query($mysqli, "SELECT id from users where status2=1");
$res6=mysqli_query($mysqli, "SELECT id from users where status2=0");
echo 'Total users Registered Today : '.mysqli_num_rows($res1);
echo '<br/>Total Active Registered users Today : '.mysqli_num_rows($res2);
echo '<br/>Total Inactive Registered users Today : '.mysqli_num_rows($res3);
echo '<br/><br/>Total users Registered : '.mysqli_num_rows($res4);
echo '<br/>Total Active Registered users  : '.mysqli_num_rows($res5);
echo '<br/>Total Inactive Registered users : '.mysqli_num_rows($res6);
?>
<br />
<br />
<h2>Contacts</h2>

<?php $query="
SELECT
  count(`contacts`.`id`) as cnt, categories.catname, `contacts`.`catid`, (select count(id) from contacts as sc where sc.catid=contacts.catid and sc.userid!=0) as ucount 
FROM
  `contacts`  LEFT JOIN
  `categories` ON `contacts`.`catid` = `categories`.`id`  GROUP BY
 `contacts`.`catid` order by categories.id desc";		
		   		//echo $query;		
				$res=mysqli_query($mysqli, $query);
				$count
				
			 ?>
  
         <?php 
		   if(mysqli_num_rows($res) == 0)
                                           {
                                       ?>
                               <p class="norecords">No Contacts</p>
                                <?php  }
								else
								{ ?>
									 <table class="table table-hover  table_vam table-black" width="500">
    	<thead>
        <tr>
        <th>S.no</th>
        <th>Contacts Category Name</th>
        <th>Total Contacts</th>
        <th>Called Contacts</th>
		</tr>
        </thead>
		<?php
						   $cnt=0;
								 while($row=mysqli_fetch_assoc($res))
                                           {  $cnt++;
                                       ?>
        <tr>
        	<td width="35"><?php echo $cnt ?></td>
        	<td width="200"><?php echo $row['catname'];?></td>
            <td  ><?php echo $row['cnt'];?></td>
            <td  ><?php echo $row['ucount'];?></td>
            
        </tr>
        <?php } ?>
    </table><?php }?>
	<?php include("includes/footer.php");?>
</body>
</html>
