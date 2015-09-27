<?php include("includes/app_top.php");
$pagetitle2="Get Contact Details";
$contacts="";
checkUserLogin();

?>
<?php include("includes/styles.php");?>

</head>
<body>
 <?php include("includes/header.php");?> 
<div class="division-1">
           <h1><?php echo $pagetitle2;?></h1>
           <br /> <br /> 
         <p>
         Click below button to retrieve contact details.
         </p>
         
         
           <form method="post">
           <input name="submit" type="submit" class="button2" id="submit" value="Get Contact" />
           </form>
            <br /> <br />
           <?php
           if(isset($_POST['submit'])&&$_POST['submit']!="")
{
	$r="select id from usercontacts where userid=".$_SESSION["userid"]." and datetaken='$date2'";
	$re=mysqli_query($mysqli, $r);
	if(mysqli_num_rows($re) < 20)
	{
	//$sql="select * FROM CONTACTS where id not in (SELECT contactid FROM usercontacts where userid=" .$_SESSION["userid"].") ORDER BY RAND() LIMIT 1";
	$sql1="select * from  ".$tablename."   where status2=1 order by rand() limit 1";
//	echo $sql;
	$res=mysqli_query($mysqli, $sql1);
	if(mysqli_num_rows($res) >0)
	{
    $row=mysqli_fetch_assoc($res);	
	$query="insert into usercontacts (contactid,userid,datetaken)values(".$row['id'].",".$_SESSION['userid'].",'$date')";
	mysqli_query($mysqli, $query);
	?>
    <!---->
   
	<table class="tblclass" width="50%">
    	<tr>
        <th>S.no</th>
        <th>Person Name</th>
        <th>Conatct Number</th>
        <th>City</th>
        </tr>
        <tr>
        	<td width="35">1</td>
        	<td width="100"><?php echo $row['person_name'];?></td>
            <td width="150"><?php echo $row['contact'];?></td>
            <td width="150"><?php echo $row['city'];?></td>
        </tr>
    </table>
<?php
}
else
{
?>
    <p class="error">No contacts have to retrieve. Will update soon.</p>
<?php
}
}
else
{
	?>
    <p class="error">Per day maximum 20 contacts only can get. Limit exceeded.</p>
    <?php
}
}

?>

</div>
 <?php include("includes/footer.php");?>           
           </body>
</html>
