<?php include("includes/app_top.php");
checkUserLogin();
$res5=mysqli_query($mysqli, "SELECT * from innerpages where state_id=".$stateid." and filename='objective.php'");
$row5=mysqli_fetch_assoc($res5);
?>
<?php include("includes/styles.php");?>
</head>
<body class="bgwhite">
<h1><?php echo $row5['heading'];?></h1>
<?php echo $row5['description'];?>
</body>
</html>