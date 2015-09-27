<?php include("includes/app_top.php");
$getid= getid('rid');
checkUserLogin(); 
?>
<?php include("includes/styles.php");?>
<?php include("../includes/colorbox.php");?>
<script type="text/javascript">  
function validatefilter() {	
if(document.getElementById('keyword').value=='') {
alert("Enter keyword");
document.getElementById('keyword').focus();
return false;
}
} 
</script>
<STYLE type="text/css">
table.reference,table.tecspec{
	border-collapse:collapse;width:100%;
}

table.reference tr:nth-child(odd)	{background-color:#FFE0C2;}
table.reference tr:nth-child(even)	{background-color:#CFE7CD;}

table.reference tr.fixzebra			{background-color:#FFE0C2;}

table.reference th{
	color:#ffffff;background-color:#335C33;border:1px solid #335C33;padding:3px;vertical-align:top;text-align:left;
}

table.reference th a:link,table.reference th a:visited{
	color:#ffffff;
}

table.reference th a:hover,table.reference th a:active{
	color:#EE872A;
}

table.reference td{
	border:1px solid #d4d4d4;padding:3px;padding-top:3px;padding-bottom:3px;vertical-align:top;white-space:nowrap;
}
</STYLE>
</head>
<body>
<?php include("includes/header.php");?>
            <div class="division-1">
           <h1>LEADERBOARDS</h1>


           <?php 
		   if($action=="show")
		   $keyword=cleanQuery($_POST['keyword']);
		   else
		   $keyword='';?>
         <form name="search" method="post" action="dashboard.php?action=show" onSubmit="return validatefilter(this)" class="coursesMenu">
        <div class="row-fluid">  Enter City/State/Country/Team to get Filtered Results of That Area:
           <input type="text" name="keyword" id="keyword" class="input span12" style="width:200px"  value="<?php 	 echo $keyword;?>" placeholder="Keyword" /> <button class="leftformbt" style="font-size:13px; padding:4px 10px;">Search</button></div></form>

<?php
$totalcontacts=0;
$daycontacts=0;
$r1=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(".$tablename.".`id`) as cnt FROM ".$tablename." INNER JOIN `users` ON ".$tablename.".`userid` = `users`.`id` where (users.ip_city like '%$keyword%' or users.ip_state like '%$keyword%' or users.ip_country like '%$keyword%' or users.team like '%$keyword%')"));
$r2=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(".$tablename.".`id`) as cnt FROM ".$tablename." INNER JOIN `users` ON ".$tablename.".`userid` = `users`.`id` where (users.ip_city like '%$keyword%' or users.ip_state like '%$keyword%' or users.ip_country like '%$keyword%' or users.team like '%$keyword%') and date($tablename.contactdate) ='$date2'"));
?>
<p>Total Called Overall: <?php echo $r1['cnt'];?></p>
<p>Total Called Today: <?php echo $r2['cnt'];?></p>
    
<div class="division-1">
    <table>
    <tr><td style="vertical-align:top;">
    <div class="background">
        <h3 style="margin:0px; font-size:20px; color:red; text-align:center;">BY COUNTRY</h3>
        <table class="reference" style="font-family: Arial, Helvetica, sans-serif; font-size:13px;">
        <tr><th>#</th><th>Caller</th><th>Calls</th></tr>
        <?php
            $fullquery = "select * from (select U.ip_country as country, sum(T.count) as count from ( select userid,count(*) as count from ".$tablename." where userid!=0  group by userid) T, users U where T.userid=U.id and U.ip_country is not null and (U.ip_city like '%$keyword%' or U.ip_state like '%$keyword%' or U.ip_country like '%$keyword%' or U.team like '%$keyword%') group by U.ip_country) X order by count desc limit 10";
            $result = $mysqli->query($fullquery) or die($mysqli->error.__LINE__);
            if($result->num_rows > 0) {
                $rank = 0;
                while($row = $result->fetch_assoc()) {
                    $rank++;
                    $num = "<td>".$rank."</td>";
                    if ($rank==1)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-1.png" alt="" height="16" width="16"></td>';
                    if ($rank==2)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-2.png" alt="" height="16" width="16"></td>';
                    if ($rank==3)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-3.png" alt="" height="16" width="16"></td>';
                    echo "<tr>".$num."<td>".$row['country']."</td><td>".$row['count']."</td></tr>";
                }
            }?>
        </table>
    </div>
    </td><td style="vertical-align:top;">
    <div class="background">
        <h3 style="margin:0px; font-size:20px; color:red; text-align:center;">BY STATE</h3>
        <table class="reference" style="font-family: Arial, Helvetica, sans-serif; font-size:13px;">
        <tr><th>#</th><th>Caller</th><th>Calls</th></tr>
        <?php
            $fullquery = "select * from (select U.ip_state as state, sum(T.count) as count from ( select userid,count(*) as count from ".$tablename." where userid!=0 group by userid) T, users U where T.userid=U.id and U.ip_state is not null and (U.ip_city like '%$keyword%' or U.ip_state like '%$keyword%' or U.ip_country like '%$keyword%' or U.team like '%$keyword%') group by U.ip_state) X order by count desc limit 10;";
            $result = $mysqli->query($fullquery) or die($mysqli->error.__LINE__);
            if($result->num_rows > 0) {
                $rank = 0;
                while($row = $result->fetch_assoc()) {
                    $rank++;
                    $num = "<td>".$rank."</td>";
                    if ($rank==1)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-1.png" alt="" height="16" width="16"></td>';
                    if ($rank==2)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-2.png" alt="" height="16" width="16"></td>';
                    if ($rank==3)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-3.png" alt="" height="16" width="16"></td>';
                    echo "<tr>".$num."<td>".$row['state']."</td><td>".$row['count']."</td></tr>";
                }
            }?>
        </table>
    </div>
    </td><td style="vertical-align:top;">
    <div class="background">
        <h3 style="margin:0px; font-size:20px; color:red; text-align:center;">BY CITY</h3>
        <table class="reference" style="font-family: Arial, Helvetica, sans-serif; font-size:13px;">
        <tr><th>#</th><th>Caller</th><th>Calls</th></tr>
        <?php
            $fullquery = "select * from (select U.ip_city as city, sum(T.count) as count from ( select userid,count(*) as count from ".$tablename." where userid!=0 group by userid) T, users U where T.userid=U.id and U.ip_city is not null and (U.ip_city like '%$keyword%' or U.ip_state like '%$keyword%' or U.ip_country like '%$keyword%' or U.team like '%$keyword%') group by U.ip_city) X order by count desc limit 10;";
            $result = $mysqli->query($fullquery) or die($mysqli->error.__LINE__);
            if($result->num_rows > 0) {
                $rank = 0;
                while($row = $result->fetch_assoc()) {
                    $rank++;
                    $num = "<td>".$rank."</td>";
                    if ($rank==1)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-1.png" alt="" height="16" width="16"></td>';
                    if ($rank==2)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-2.png" alt="" height="16" width="16"></td>';
                    if ($rank==3)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-3.png" alt="" height="16" width="16"></td>';
                    echo "<tr>".$num."<td>".$row['city']."</td><td>".$row['count']."</td></tr>";
                }
            }?>
        </table>
    </div>
    </td></tr>
    <tr><td style="vertical-align:top;">
    <div class="background">
        <h3 style="margin:0px; font-size:20px; color:red; text-align:center;">ALL-TIME</h3>
        <table class="reference" style="font-family: Arial, Helvetica, sans-serif; font-size:13px;">
        <tr><th>#</th><th>Caller</th><th>Calls</th></tr>
        <?php
            $fullquery = "select * from (select U.name as name, sum(X.count) as count from ( select userid,count(*) as count from ".$tablename." where userid!=0  group by userid) X, users U where X.userid=U.id and (U.ip_city like '%$keyword%' or U.ip_state like '%$keyword%' or U.ip_country like '%$keyword%' or U.team like '%$keyword%') group by X.userid) Z order by count desc limit 100";
            $result = $mysqli->query($fullquery) or die($mysqli->error.__LINE__);
            if($result->num_rows > 0) {
                $rank = 0;
                while($row = $result->fetch_assoc()) {
                    $rank++;
                    $num = "<td>".$rank."</td>";
                    if ($rank==1)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-1.png" alt="" height="16" width="16"></td>';
                    if ($rank==2)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-2.png" alt="" height="16" width="16"></td>';
                    if ($rank==3)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-3.png" alt="" height="16" width="16"></td>';
                    echo "<tr>".$num."<td>".$row['name']."</td><td>".$row['count']."</td></tr>";
                }
            }?>
        </table>
    </div>
    </td><td style="vertical-align:top;">
    <div class="background">
        <h3 style="margin:0px; font-size:20px; color:red; text-align:center;">TODAY</h3>
        <table class="reference" style="font-family: Arial, Helvetica, sans-serif; font-size:13px;">
        <tr><th>#</th><th>Caller</th><th>Calls</th></tr>
        <?php
            $fullquery = "select * from (select U.name as name, sum(X.count) as count from ( select userid,count(*) as count from ".$tablename." where userid!=0 and date(contactdate)=date(convert_tz(now(),'America/Los_Angeles','Asia/Calcutta')) group by userid) X, users U where X.userid=U.id and (U.ip_city like '%$keyword%' or U.ip_state like '%$keyword%' or U.ip_country like '%$keyword%' or U.team like '%$keyword%')  group by X.userid) Z order by count desc limit 100";
            $result = $mysqli->query($fullquery) or die($mysqli->error.__LINE__);
            if($result->num_rows > 0) {
                $rank = 0;
                while($row = $result->fetch_assoc()) {
                    $rank++;
                    $num = "<td>".$rank."</td>";
                    if ($rank==1)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-1.png" alt="" height="16" width="16"></td>';
                    if ($rank==2)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-2.png" alt="" height="16" width="16"></td>';
                    if ($rank==3)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-3.png" alt="" height="16" width="16"></td>';
                    echo "<tr>".$num."<td>".$row['name']."</td><td>".$row['count']."</td></tr>";
                }
            }?>
        </table>
    </div>
    </td><td style="vertical-align:top;">
    <div class="background">
        <h3 style="margin:0px; font-size:20px; color:red; text-align:center;">YESTERDAY</h3>
        <table class="reference" style="font-family: Arial, Helvetica, sans-serif; font-size:13px;">
        <tr><th>#</th><th>Caller</th><th>Calls</th></tr>
        <?php
            $fullquery = "select * from (select U.name as name, sum(X.count) as count from ( select userid,count(*) as count from ".$tablename." where userid!=0 and date(contactdate)=date_sub(date(convert_tz(now(),'America/Los_Angeles','Asia/Calcutta')),interval 1 day) group by userid) X, users U where X.userid=U.id and (U.ip_city like '%$keyword%' or U.ip_state like '%$keyword%' or U.ip_country like '%$keyword%' or U.team like '%$keyword%')  group by X.userid) Z order by count desc limit 100";
            $result = $mysqli->query($fullquery) or die($mysqli->error.__LINE__);
            if($result->num_rows > 0) {
                $rank = 0;
                while($row = $result->fetch_assoc()) {
                    $rank++;
                    $num = "<td>".$rank."</td>";
                    if ($rank==1)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-1.png" alt="" height="16" width="16"></td>';
                    if ($rank==2)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-2.png" alt="" height="16" width="16"></td>';
                    if ($rank==3)
                        $num = '<td style="margin:0;padding:2px;"><img src="../images/medal-3.png" alt="" height="16" width="16"></td>';
                    echo "<tr>".$num."<td>".$row['name']."</td><td>".$row['count']."</td></tr>";
                }
            }?>
        </table>
    </div>
    </td></tr>
</table>
</div>


   </div>

    </div></div>
 <?php include("includes/footer.php");?>           
           </body>
</html>
