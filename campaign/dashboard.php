<!DOCTYPE html>

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

<link rel="stylesheet" href="../css/styles.css" type="text/css" />
    
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">

</head>
<body>
<?php include("includes/header.php");?>
<div class="division-1">
<h1>LEADERBOARDS</h1>
<b style="color:red;">TO SEE FULL CALL CAMPAIGN STATISTICS (EMC3 + TOLLFREE), PLEASE GOTO: </b><b><a href="../reports/" target="_blank">http://myaap.in/callreport</a></b></br></br>

<?php 
if($action=="show")
$keyword=cleanQuery($_POST['keyword']);
else
$keyword='';?>
<form name="search" method="post" action="dashboard.php?action=show" onSubmit="return validatefilter(this)" class="coursesMenu">
    <div class="row-fluid"> Filter By Name or Location:
        <input type="text" name="keyword" id="keyword" class="input span12" style="width:200px"  value="<?php echo $keyword;?>" placeholder="Keyword" />
        <button class="leftformbt" style="font-size:13px; padding:4px 10px;">Search</button>
        <button class="leftformbt" style="font-size:13px; padding:4px 10px;"><a style="color:white;" href="dashboard.php">Clear</a></button>
    </div>
</form>
<?php
$interval = 900;
$filename = "cache/leaderboard.cache";
if ($keyword=='' && file_exists($filename) && (time() - $interval) < filemtime($filename)) {
    readfile($filename);
}
else {
ob_start();

$totalcontacts=0;
$daycontacts=0;
$r1=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count($tablename.`id`) as cnt FROM $tablename INNER JOIN `users` ON $tablename.`userid` = `users`.`id` where (users.ip_city like '%$keyword%' or users.ip_state like '%$keyword%' or users.ip_country like '%$keyword%' or users.team like '%$keyword%' or users.name like '%$keyword%')"));
$r2=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count($tablename.`id`) as cnt FROM $tablename INNER JOIN `users` ON $tablename.`userid` = `users`.`id` where (users.ip_city like '%$keyword%' or users.ip_state like '%$keyword%' or users.ip_country like '%$keyword%' or users.team like '%$keyword%' or users.name like '%$keyword%') and date($tablename.contactdate) ='$date2'"));
?>
<p>Total Called Overall: <?php echo $r1['cnt'];?></p>
<p>Total Called Today: <?php echo $r2['cnt'];?></p>
    
<div class="division-1" style="min-height:350px; padding:0px; margin:0px;">
    <div class="background" style="float: left; width: 300px; padding:0px; margin:0px;">
        <h3 style="margin:0px; font-size:20px; color:red; text-align:center;">BY COUNTRY</h3>
        <table class="reference" style="font-family: Arial, Helvetica, sans-serif; font-size:13px;">
        <tr><th>#</th><th>Caller</th><th>Calls</th></tr>
        <?php
            $fullquery = "select * from (select U.ip_country as country, sum(T.count) as count from ( select userid,count(*) as count from $tablename where userid!=0  group by userid) T, users U where T.userid=U.id and U.ip_country is not null and (U.ip_city like '%$keyword%' or U.ip_state like '%$keyword%' or U.ip_country like '%$keyword%' or U.team like '%$keyword%' or U.name like '%$keyword%') group by U.ip_country) X order by count desc limit 10";
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
    <div class="background" style="float: left; width: 300px; padding:0px; margin:0px;">
        <h3 style="margin:0px; font-size:20px; color:red; text-align:center;">BY STATE</h3>
        <table class="reference" style="font-family: Arial, Helvetica, sans-serif; font-size:13px;">
        <tr><th>#</th><th>Caller</th><th>Calls</th></tr>
        <?php
            $fullquery = "select * from (select U.ip_state as state, sum(T.count) as count from ( select userid,count(*) as count from $tablename where userid!=0 group by userid) T, users U where T.userid=U.id and U.ip_state is not null and (U.ip_city like '%$keyword%' or U.ip_state like '%$keyword%' or U.ip_country like '%$keyword%' or U.team like '%$keyword%' or U.name like '%$keyword%') group by U.ip_state) X order by count desc limit 10;";
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
    <div class="background" style="float: left; width: 300px; padding:0px; margin:0px;">
        <h3 style="margin:0px; font-size:20px; color:red; text-align:center;">BY CITY</h3>
        <table class="reference" style="font-family: Arial, Helvetica, sans-serif; font-size:13px;">
        <tr><th>#</th><th>Caller</th><th>Calls</th></tr>
        <?php
            $fullquery = "select * from (select U.ip_city as city, sum(T.count) as count from ( select userid,count(*) as count from $tablename where userid!=0 group by userid) T, users U where T.userid=U.id and U.ip_city is not null and (U.ip_city like '%$keyword%' or U.ip_state like '%$keyword%' or U.ip_country like '%$keyword%' or U.team like '%$keyword%' or U.name like '%$keyword%') group by U.ip_city) X order by count desc limit 10;";
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
</div>
<div class="division-1" style="min-height:2800px; padding:0px; margin:0px;">
    <div class="background" style="float: left; width: 300px; padding:0px; margin:0px;">
        <h3 style="margin:0px; font-size:20px; color:red; text-align:center;">ALL-TIME</h3>
        <table class="reference" style="font-family: Arial, Helvetica, sans-serif; font-size:13px;">
        <tr><th>#</th><th>Caller</th><th>Calls</th></tr>
        <?php
            $fullquery = "select * from (select substr(U.name,1,26) as name, sum(X.count) as count from ( select userid,count(*) as count from $tablename where userid!=0  group by userid) X, users U where X.userid=U.id and (U.ip_city like '%$keyword%' or U.ip_state like '%$keyword%' or U.ip_country like '%$keyword%' or U.team like '%$keyword%' or U.name like '%$keyword%') group by X.userid) Z order by count desc limit 100";
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
    <div class="background" style="float: left; width: 300px; padding:0px; margin:0px;">
        <h3 style="margin:0px; font-size:20px; color:red; text-align:center;">TODAY</h3>
        <table class="reference" style="font-family: Arial, Helvetica, sans-serif; font-size:13px;">
        <tr><th>#</th><th>Caller</th><th>Calls</th></tr>
        <?php
            $fullquery = "select * from (select substr(U.name,1,26) as name, sum(X.count) as count from ( select userid,count(*) as count from $tablename where userid!=0 and date(contactdate)=date(now()) group by userid) X, users U where X.userid=U.id and (U.ip_city like '%$keyword%' or U.ip_state like '%$keyword%' or U.ip_country like '%$keyword%' or U.team like '%$keyword%' or U.name like '%$keyword%')  group by X.userid) Z order by count desc limit 100";
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
    <div class="background" style="float: left; width: 300px; padding:0px; margin:0px;">
        <h3 style="margin:0px; font-size:20px; color:red; text-align:center;">YESTERDAY</h3>
        <table class="reference" style="font-family: Arial, Helvetica, sans-serif; font-size:13px;">
        <tr><th>#</th><th>Caller</th><th>Calls</th></tr>
        <?php
            $fullquery = "select * from (select substr(U.name,1,26) as name, sum(X.count) as count from ( select userid,count(*) as count from $tablename where userid!=0 and date(contactdate)=date_sub(date(now()),interval 1 day) group by userid) X, users U where X.userid=U.id and (U.ip_city like '%$keyword%' or U.ip_state like '%$keyword%' or U.ip_country like '%$keyword%' or U.team like '%$keyword%' or U.name like '%$keyword%')  group by X.userid) Z order by count desc limit 100";
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
</div>
</div>
</div>
</div>
<?php
$buff = ob_get_contents();
if ($keyword=='') {
    $file = fopen($filename, "w");
    fwrite($file, $buff);
    fclose($file);
}
ob_end_flush();
}
?>
<?php include("includes/footer.php");?>
</body>
</html>
