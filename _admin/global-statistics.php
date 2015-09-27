<?php include("includes/app_top.php");
$stcat='Admin';
$pagetitle="Global Statistics";
$getid = getid('id');
checkAdminLogin();
if(!stristr($_SESSION['access'],"a"))
  tep_redirect(tep_href_link('profile.php','action1=err'));
?>
<?php include("includes/styles.php");?>
<script language="javascript" type="text/javascript" src="flot/jquery.js"></script>
<script language="javascript" type="text/javascript" src="flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="flot/jquery.flot.time.js"></script>
<script language="javascript" type="text/javascript" src="flot/jquery.flot.pie.js"></script>
<script language="javascript" type="text/javascript" src="flot/jquery.flot.stack.js"></script>
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
<?php
    $tables = "(";
    $query = "SELECT * from campaigns where name not like '%vep%' order by constituency";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tables .= "select `".$row['name']."`.*, '".$row['constituency']."' as campaign from ".$row['name']." as `".$row['name']."` union ";
        }
    }
    $table = substr("$tables", 0, -7).") A";
    
    $users1 = array();
    $query = "select unix_timestamp(date(datecreated))*1000 as date,count(*) as cnt from users where date(datecreated)>20140310 group by date(datecreated)";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $users1[] = array( $row['date'], $row['cnt'] );
        }
    }
    
    $users2 = array();
    $query = "select unix_timestamp(date)*1000 as date, count(*) as cnt from (select date(contactdate) as date,userid from ".$table." where date(contactdate)>20140310 group by date(contactdate),userid) B group by date;";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $users2[] = array( $row['date'], $row['cnt'] );
        }
    }
    
    $calls1a = array();
    $calls1b = array();
    $calls1c = array();
    $calls1d = array();
    $query = "select unix_timestamp(date(contactdate))*1000 as date, iscalled, count(*) as cnt from ".$table." where date(contactdate)>20140310 and iscalled>0 group by date(contactdate),iscalled;";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['iscalled']==1)
                $calls1a[] = array( $row['date'], $row['cnt'] );
            if ($row['iscalled']==2)
                $calls1b[] = array( $row['date'], $row['cnt'] );
            if ($row['iscalled']==3)
                $calls1c[] = array( $row['date'], $row['cnt'] );
            if ($row['iscalled']==4)
                $calls1d[] = array( $row['date'], $row['cnt'] );
        }
    }
    $calls1A = array( "label" => "Call Completed", "color" => 3, "data" => $calls1a );
    $calls1B = array( "label" => "Wrong Number", "color" => 2, "data" => $calls1b );
    $calls1C = array( "label" => "Call Later", "color" => 1, "data" => $calls1c );
    $calls1D = array( "label" => "Not Reached", "color" => 0, "data" => $calls1d );
    $calls2 = array();
    
    $query = "select iscalled, count(*) as cnt from ".$table." where date(contactdate)>20140310 and iscalled>0 group by iscalled;";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['iscalled']==1)
                $calls2[] = array( "label" => "Call Completed", "color" => 3, "data" => $row['cnt'] );
            if ($row['iscalled']==2)
                $calls2[] = array( "label" => "Wrong Number", "color" => 2, "data" => $row['cnt'] );
            if ($row['iscalled']==3)
                $calls2[] = array( "label" => "Call Later", "color" => 1, "data" => $row['cnt'] );
            if ($row['iscalled']==4)
                $calls2[] = array( "label" => "Not Reached", "color" => 0, "data" => $row['cnt'] );
        }
    }
    
    $votes1a = array();
    $votes1b = array();
    $votes1c = array();
    $query = "select unix_timestamp(date(contactdate))*1000 as date, vote, count(*) as cnt from ".$table." where date(contactdate)>20140310 and iscalled=1 group by date(contactdate),vote;";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['vote']==0)
                $votes1a[] = array( $row['date'], $row['cnt'] );
            if ($row['vote']==1)
                $votes1b[] = array( $row['date'], $row['cnt'] );
            if ($row['vote']==2)
                $votes1c[] = array( $row['date'], $row['cnt'] );
        }
    }
    $votes1A = array( "label" => "No", "color" => 2, "data" => $votes1a );
    $votes1B = array( "label" => "Yes", "color" => 3, "data" => $votes1b );
    $votes1C = array( "label" => "Undecided", "color" => 0, "data" => $votes1c );
    $votes2 = array();
    $query = "select vote, count(*) as cnt from ".$table." where date(contactdate)>20140310 and iscalled=1 group by vote;";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['vote']==0)
                $votes2[] = array( "label" => "No", "color" => 2, "data" => $row['cnt'] );
            if ($row['vote']==1)
                $votes2[] = array( "label" => "Yes", "color" => 3, "data" => $row['cnt'] );
            if ($row['vote']==2)
                $votes2[] = array( "label" => "Undecided", "color" => 0, "data" => $row['cnt'] );
        }
    }

    $campaign1 = array();
    $query = "select unix_timestamp(date(contactdate))*1000 as date, campaign, count(*) as cnt from ".$table." where date(contactdate)>20140310 and iscalled=1 group by date(contactdate),campaign;";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $c = $row['campaign'];
            if (!array_key_exists($c,$campaign1))
                $campaign1[$c] = array( "label" => $c, "data" => array() );
            $campaign1[$c]['data'][] = array( $row['date'], $row['cnt'] );
        }
    }
    
    $campaign2 = array();
    $query = "select unix_timestamp(date(contactdate))*1000 as date, campaign, count(*) as cnt from ".$table." where date(contactdate)>20140310 and iscalled=1 group by date(contactdate),campaign;";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $c = $row['campaign'];
            if (!array_key_exists($c,$campaign2))
                $campaign2[$c] = array( "label" => $c, "data" => array() );
            $campaign2[$c]['data'][] = array( $row['date'], $row['cnt'] );
        }
    }
    
    $usage1 = "<table style='width:80%'><tr><th style='text-align:left;width:40%;'>Campaign</th><th style='text-align:right;width:20%;'>Called</th><th style='text-align:right;width:20%;'>Total Nums</th><th style='text-align:right;width:20%;'>Usage (In %)</th></tr>";
    $query = "SELECT name,constituency from campaigns order by constituency";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $perc = 0;
            $usage1 .= "<tr><td>".$row['constituency']."</td>";
            $query2 = "select count(*) as cnt from ".$row['name']." where iscalled=1";
            $result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
            if($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $usage1 .= "<td style='text-align: right;'>".$row2['cnt']."</td>";
                    $perc = $row2['cnt'];
                }
            }
            $query2 = "select count(*) as cnt from ".$row['name']." where iscalled!=1";
            $result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
            if($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $usage1 .= "<td style='text-align: right;'>".$row2['cnt']."</td>";
                    $perc = $perc*100/($perc+$row2['cnt']);
                }
            }
            $usage1 .= "<td style='text-align: right;'>".intval($perc)."%</td></tr>";
        }
    }
    $usage1 .= "</table>";
    
    
    $usage2 = "<table style='width:80%'><tr><th style='text-align:left;width:40%'>Campaign</th><th style='text-align:right;width:20%;'>Yes</th><th style='text-align:right;width:20%;'>No/Undec</th><th style='text-align:right;width:20%;'>Yes %</th></tr>";
    $query = "SELECT name,constituency from campaigns order by constituency";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $perc = 0;
            $usage2 .= "<tr><td>".$row['constituency']."</td>";
            $query2 = "select count(*) as cnt from ".$row['name']." where vote=1 and iscalled=1";
            $result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
            if($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $usage2 .= "<td style='text-align: right;'>".$row2['cnt']."</td>";
                    $perc = $row2['cnt'];
                }
            }
            $query2 = "select count(*) as cnt from ".$row['name']." where vote!=1 and iscalled=1";
            $result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
            if($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $usage2 .= "<td style='text-align: right;'>".$row2['cnt']."</td>";
                    $perc = $perc*100/($perc+$row2['cnt']);
                }
            }
            $usage2 .= "<td style='text-align: right;'>".intval($perc)."%</td></tr>";
        }
    }
    $usage2 .= "</table>";
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%"><b>New User Registrations</b><br/><div id="users1" style="width:100%;height:300px;"></div></td>
    <td width="50%"><b>Active Users</b><br/><div id="users2" style="width:100%;height:300px;"></div></td>
  </tr>
  <tr><td>&nbsp;</td><td></td></tr>
  <tr>
    <td width="50%"><b>Calls Made Over Time</b><br/><div id="calls1" style="width:100%;height:300px;"></div></td>
    <td width="50%"><b>Calls Made Overall</b><br/><div id="calls2" style="width:100%;height:300px;"></div></td>
  </tr>
  <tr><td>&nbsp;</td><td></td></tr>
  <tr>
    <td width="50%"><b>Responses Over Time</b><br/><div id="votes1" style="width:100%;height:300px;"></div></td>
    <td width="50%"><b>Responses Overall</b><br/><div id="votes2" style="width:100%;height:300px;"></div></td>
  </tr>
  <tr><td>&nbsp;</td><td></td></tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%"><b>Call Volume by Campaign</b><br/><div id="campaign1" style="width:100%;height:500px;"></div></td>
  </tr>
  <tr><td>&nbsp;</td><td></td></tr>
  <tr>
    <td width="100%"><b>Active Users by Campaign</b><br/><div id="campaign2" style="width:100%;height:500px;"></div></td>
  </tr>
  <tr><td>&nbsp;</td><td></td></tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%"><b>Usage By Constituency</b><br/><?php echo $usage1; ?></div></td>
    <td width="50%"><b>Responses By Constituency</b><br/><?php echo $usage2; ?></div></td>
  </tr>
  <tr><td>&nbsp;</td><td></td></tr>
</table>

<script id="source">
$(function () {
  function showTooltip(x, y, contents) {
    $('<div id="tooltip">' + contents + '</div>').css( {
    position: 'absolute',
    display: 'none',
    top: y + 20,
    left: x - 20,
    border: '1px solid #fdd',
    padding: '2px',
    'background-color': '#fee',
    opacity: 0.80
    }).appendTo("body").fadeIn(200);
  }
  var previousPoint = null;
  
  function onPlotHover(event, pos, item) {
     if (item) {
        if (previousPoint != item.dataIndex) {
            previousPoint = item.dataIndex;
            $("#tooltip").remove();
            var x = item.datapoint[0].toFixed(2),y = item.datapoint[1].toFixed(0);
            var date = new Date(item.datapoint[0]);
            var formattedTime = date.getDate()+' '+months[date.getMonth()]+' '+date.getFullYear();
            showTooltip(item.pageX, item.pageY,formattedTime+" - "+y+"<br />"+item.series.label);
        }
     }
  }
  
  function labelFormatter(label, series) {
    return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + Math.round(series.percent) + "%<br/>(" + series.data[0][1] + ")</div>";
  }
  
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  var options = {
  xaxis: { mode: "time", tickLength: 5, timeformat: "%b-%d", minTickSize: [1, "day"] },
  series: { lines: { show: true}, points: {show: true} },
  grid: { hoverable: true }
  };
  var options2 = { 
  series: { pie: { show: true, 
  label: { show: true, radius: 1/2, formatter: labelFormatter, background: { opacity: 0.5, color: "#000" } } }}
  };
  var options3 = {
  xaxis: { mode: "time", tickLength: 5, timeformat: "%b-%d", minTickSize: [1, "day"] },
  series: { lines: { show: true}, points: {show: true} },
  grid: { hoverable: true },
  legend: { show: false }
  };
  
  var d1 = <?php echo json_encode($users1); ?>;
  var p1 = $.plot($("#users1"), [d1], options);
  $("#users1").bind("plothover",onPlotHover);
  
  var d2 = <?php echo json_encode($users2); ?>;
  var p2 = $.plot($("#users2"), [d2], options);
  $("#users2").bind("plothover",onPlotHover);

  var d3a = <?php echo json_encode($calls1A); ?>;
  var d3b = <?php echo json_encode($calls1B); ?>;
  var d3c = <?php echo json_encode($calls1C); ?>;
  var d3d = <?php echo json_encode($calls1D); ?>;
  var p3 = $.plot($("#calls1"), [d3a,d3b,d3c,d3d], options);
  $("#calls1").bind("plothover",onPlotHover);
  
  var d4 = <?php echo preg_replace( "/\"(\d+)\"/", '$1', json_encode($calls2)); ?>;
  var p4 = $.plot($("#calls2"), d4, options2);
  
  var d5a = <?php echo json_encode($votes1A); ?>;
  var d5b = <?php echo json_encode($votes1B); ?>;
  var d5c = <?php echo json_encode($votes1C); ?>;
  var p5 = $.plot($("#votes1"), [d5a,d5b,d5c], options);
  $("#votes1").bind("plothover",onPlotHover);
  
  var d6 = <?php echo preg_replace( "/\"(\d+)\"/", '$1', json_encode($votes2)); ?>;
  var p6 = $.plot($("#votes2"), d6, options2);
  
  var d7 = <?php echo json_encode(array_values($campaign1)); ?>;
  var p7 = $.plot($("#campaign1"), d7, options3);
  $("#campaign1").bind("plothover",onPlotHover);
  
  var d8 = <?php echo json_encode(array_values($campaign2)); ?>;
  var p8 = $.plot($("#campaign2"), d8, options3);
  $("#campaign2").bind("plothover",onPlotHover);
});
</script>
<?php include("includes/footer.php");?>
</body>
</html>
