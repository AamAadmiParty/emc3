<!DOCTYPE html>
<?php include("includes/app_top.php");
$getid= getid('rid');
checkUserLogin(); 
?>
<?php include("includes/styles.php");?>
<?php include("../includes/colorbox.php");?>
<link rel="stylesheet" href="../css/styles.css" type="text/css" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php include("includes/header.php");?>
<div class="division-1">
    <h1>CERTIFICATE (Save And Share Proudly!)</h1>
    <canvas id="certificate" width="920" height="498"
    style="border:1px solid #000000;">
    </canvas>
</div>
<?php include("includes/footer.php");?>
<script>
window.onload = function(){
    var canvas = document.getElementById("certificate");
    var context = canvas.getContext("2d");
    var imageObj = new Image();
    imageObj.onload = function(){
        context.drawImage(imageObj, 0, 0);
        context.font = "22pt Apple Chancery";
        context.textAlign = 'center';
        context.fillStyle = '#AD2127';
        context.fillText(<?php echo json_encode($_SESSION['user']); ?>, 660, 180);
        context.fillText("<?php echo json_encode($overall); ?>", 562, 317);
        var d = new Date();
        context.fillText(d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear(), 698, 362);
    };
    imageObj.src = "images/call4delhi/ccc.png";
};
</script>
</body>
</html>