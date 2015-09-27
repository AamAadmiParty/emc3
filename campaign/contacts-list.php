<?php include("includes/app_top.php");
$pagetitle2="Contacts";
checkUserLogin();
?>
<?php include("includes/styles.php");?>
<?php include("../includes/colorbox.php");?>
</head>
<body>
<?php include("includes/header.php");?>

<div class="division-1">
<h1><?php echo $pagetitle2;?></h1>
<br />
<?php
if($action=="show")
    $keyword=cleanQuery($_POST['keyword']);
else
    $keyword='';?>

<form name="search" method="post" action="contacts-list.php?action=show" onSubmit="return validatefilter(this)" class="coursesMenu">
    <div class="row-fluid">Search filter:
        <input type="text" name="keyword" id="keyword" class="input span12" style="width:200px"  value="<?php echo $keyword;?>" placeholder="Keyword" />
        <button class="leftformbt" style="font-size:13px; padding:4px 10px;">Search</button>
        <button class="leftformbt" style="font-size:13px; padding:4px 10px;"><a style="color:white;" href="contacts-list.php">Clear</a></button>
    </div>
</form>

           <?php $query="SELECT * from $tablename where `userid` =".$_SESSION["userid"]. " and (contact like '%$keyword%' or comments like '%$keyword%') order by contactdate desc";
		   		$res=mysqli_query($mysqli, $query);
				
		if(mysqli_num_rows($res) == 0)
           {
       ?>
<p class="norecords">No Call History</p>
<?php  }
else
{ ?>
     <table class="tblclass" width="100%">
    	<tr>
        <th>S.no</th>
        <th>Call Time</th>
        <th>Phone Number</th>
		<th>Talked?</th>
        <th>Vote for AAP?</th>
        <th>Comments</th>
        <th>Edit</th>
    	</tr>
        <?php
						   $cnt=0;
								 while($row=mysqli_fetch_assoc($res))
                                           {  $cnt++;
                                       ?>
        <tr>
        	<td width="40"><?php echo $cnt ?></td>
            <td width="140"><?php echo $row['contactdate'];?></td>
        	<td width="120"><?php echo $row['contact'];?></td>
            <td width="80"><?php echo $row['iscalled']=="1"?'Yes':'No';?></td>
            <td width="100"><?php echo $row['iscalled']=="1"?$vote4aap[$row['vote']]:'';?></td>
            <td width="326"><?php echo $row['comments'];?></td>
            <td width="40"><a href="details.php?action=m2&cid=<?php echo $row['id'];?>" title="Edit"><img src="../images/edit2.png" alt="Edit" title="Edit"  class="img-wrap"/></a></td>
        </tr>
        <?php } ?>
    </table>
		  <?php }?>
</div>
 <?php include("includes/footer.php");?>           
           </body>
</html>
