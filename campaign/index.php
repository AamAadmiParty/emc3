<?php include("includes/app_top.php");
$starttime = microtime(true);
$campaign = $_SESSION['campaign'];
$campaigninfo = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT *, if(now()<date_add(date_sub(election_date,interval 2 day),interval 18 hour),0,1) as cutoff,DATE_FORMAT(date_add(date_sub(election_date,interval 2 day),interval 18 hour),'%M %D, %Y at %l%p') as cutoff_time from campaigns where name='$campaign'"));
$constituency = $campaigninfo['constituency'];
$youtube = $campaigninfo['youtube_url'];
$cutoff = intval($campaigninfo['cutoff']);
$cutoff_time = $campaigninfo['cutoff_time'];

if(isset($_SESSION["userid"]))
  {
    header("location:details.php");
    exit();
}
//$a1=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where catid=".$categoryid));
//$r1=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled!=0 and iscalled!=3 and catid=".

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $pagetitle;?></title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/reset.css" type="text/css" />
<link rel="stylesheet" href="../css/styles.css" type="text/css" />
<script type="text/javascript" language="javascript" src="../js/jqueryv.js"></script>
<script type="text/javascript" src="../js/jquery.jcountdown1.3.3.js"></script>
<link href="../css/countdown2.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">

<?php
    $interval = 3600;
    $filename = "cache/topcallers.cache";
    if (file_exists($filename) && (time() - $interval) < filemtime($filename)) {
        readfile($filename);
    }
    else
    {
        ob_start();
        ?>
<?php
$cities;
$latitudes;
$longitudes;
$fullquery = "select city,latitude,longitude from locations where country!='PAKISTAN'";
$result = $mysqli->query($fullquery) or die($mysqli->error.__LINE__);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cities[] = $row['city'];
        $latitudes[] = $row['latitude'];
        $longitudes[] = $row['longitude'];
    }
}?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script>
var cities = <?php echo json_encode($cities); ?>;
var latitudes = <?php echo json_encode($latitudes); ?>;
var longitudes = <?php echo json_encode($longitudes); ?>;
var citymap = {};
for (var i = 0; i < cities.length; i++) {
    citymap[cities[i]] = {
    center: new google.maps.LatLng(latitudes[i], longitudes[i]),
    population: 1000000
    };
}

var cityCircle;

function initialize() {
    // Create the map.
    var mapOptions = {
    zoom: 2,
    center: new google.maps.LatLng(10.06,16.73),
    mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    var map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);

    // Construct the circle for each value in citymap.
    // Note: We scale the area of the circle based on the population.
    for (var city in citymap) {
        var populationOptions = {
        strokeColor: '#FF0000',
        strokeOpacity: 0.75,
        strokeWeight: 0.8,
        fillColor: '#FF0000',
        fillOpacity: 0.55,
        map: map,
        center: citymap[city].center,
        radius: Math.sqrt(citymap[city].population) * 100
        };
        // Add the circle for this city to the map.
        cityCircle = new google.maps.Circle(populationOptions);
    }
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>
<body>
<div class="header clear_left container">
  <div class="logo f-l"><a href="../index.php"><img src="../images/aap-logo.png" alt="AAM ADMI PARTY" title="AAM ADMI PARTY" /></a></div>

   <div class="f-r header-content">
        <p><span style="color:#FF6600;"><?php echo $constituency; ?> - Citizen Call Campaign</span></p>
        <p><span>1</span> Call  <strong>=</strong>  YOUR <span>1</span> Minute <strong> =</strong>  <span>1</span> vote for better india</p>
   </div>     
  </div>
<div class="main clear_left" style="border-bottom:0px; padding-bottom:0px;">
    <div class="container">
        <div class=" citizen f-l">
            <?php if(!$cutoff) { ?>
            <div class="notice1">
                As per Election Commission norms,<br />the Call Campaign for <?php echo $constituency; ?> will Officially Close on<br />
                <?php echo $cutoff_time; ?> IST<br />
                Please call as much as you can before the cutoff!
            </div>
            <?php } else { ?>
            <div class="notice2">
                As Per Election Commission norms,<br />The Call Campaign For <?php echo $constituency; ?> Was Officially Closed As Of<br />
                <?php echo $cutoff_time; ?> IST
            </div>
            <?php } ?>

            <div class="background" style="margin:0px;">
                <h3 style="color:#FF6600;">What is the Citizen Call Campaign?</h3>
                <p>A Tele Door-to-Door Campaign meant for those AAP supporters who cannot campaign on the ground.</p>
                <div class="middle-4 clear_left">
                      <ul>
                        <li class="phone">
                          <p><img src="../images/tab.png" alt="" title=""><span>Volunteers<br>
                            (Worldwide)</span></p>
                        </li>
                        <li class="phone-2">
                          <p><img src="../images/no-1.png" alt="" title=""><span><small>CALL</small><br>
                            A <?php echo $constituency; ?> Voter</span></p>
                        </li>
                        <li class="phone1">
                          <p><img src="../images/no-2.png" alt="" title=""><span><small>INFORM</small><br>
                            AAP &amp; <?php echo $constituency; ?> Elections</span></p>
                        </li>
                        <li class="phone-3">
                          <p><img src="../images/no-3.png" alt="" title=""><span><small>APPEAL</small><br>
                            Vote for AAP</span></p>
                        </li>
                        <li class="last1">
                          <p><img src="../images/tab.png" alt="" title=""><span>Voters<br>
                            (<?php echo $constituency; ?>)</span></p>
                        </li>
                      </ul>
                </div>
                <ul class="list">
                  <li>Register and login to get detailed instructions on how to interact with voters.</li>
                  <li>Get voter numbers inside and call them directly.</li>
                  <li>OR call 1800-200-9424  (India only) / +911203803405 to get routed to voters.</li>
                </ul>
            </div>
        </div>

        <div class="f-r right-bar">
            <div class="register-1"><h5 style="padding:17px;"><a href="registration.php">REGISTER HERE</a></h5></div>
            <div class="login"><p align="center"><span>Already Registered?</span></p>
            <div class="register-2"><h5><a href="login.php">LOGIN HERE</a></h5></div>
            </div>
            <p class="facebook2" > <a href="https://www.facebook.com/aapcalldelhi" target="_blank">Join &quot;AAP - Call Delhi&quot;</a></strong></p>
            <div class="background" style="height:130px; text-align:center; padding:10px;">
            <label style="font-weight:bold; color:#008234;">Three Ways To Call Voters</label></br></br>
            Get Numbers Inside</br>
            <label style="font-weight:bold; color:#008234;">OR</label><br/>
            Toll-Free 1800-200-9424</br>
            <label style="font-weight:bold; color:#008234;">OR</label><br/>Toll +911203803405
            </div>
        </div>
    </div>
</div>
<div class="main clear_left" style="border-top:0px; padding-top:0px;">
    <div class="container">
        <div class="background" style="padding-left:13px;">
            <object type="text/html" data="../reports/leaderboard.php"
                style="width:100%; height:380px;">
            </object>
        </div>
    </div>
</div>
<div class="main clear_left" style="border-top:0px; padding-top:0px;">
    <div class="container">
        <div class="background" style="margin-top:0px;">
            <h3 style="color: #008234; font-size: 24px; margin-bottom: 10px;">Where are supporters calling from?</h3>
            <div id="map-canvas" style="height:500px;"></div>
        </div>
    </div>
</div>

<div class="footer clear_left">

  <div class="foot container"><p class="f-l footer-content"><span>1</span> Call  <strong>=</strong>  YOUR <span>1</span> Minute <strong> =</strong>  <span>1</span> vote for better india</p>

    <h1 class="f-r copy-rights">&copy; 2014, AAP</h1>
  </div>
</div>
<?php
    $buff = ob_get_contents();
    $file = fopen($filename, "w")  or die('fopen failed');
    fwrite($file, $buff);
    fclose($file);
    ob_end_flush();
}?>
</body>
</html>
